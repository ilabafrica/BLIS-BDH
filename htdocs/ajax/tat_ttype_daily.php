<?php
	#
	# Main page for creating weekly TAT progression charts
	# Called via Ajax from reports_tat.php 
	#

	include("../includes/user_lib.php");
	include("../includes/db_lib.php");
	include("../includes/stats_lib.php");
	include("../includes/page_elems.php");

	LangUtil::setPageId("reports");

	$page_elems = new PageElems();

	$date_from = $_REQUEST['df'];
	$date_to = $_REQUEST['dt'];
	
	$include_pending = false;
	$labNamesArray = array();

	if($_REQUEST['p'] == 1)
		$include_pending = true;

	$test_type_id = $_REQUEST['tt'];
	$testTypeId = $test_type_id;
	$test_category_id = $_REQUEST['tc'];
	$lab_config_id = $_REQUEST['l'];

	if( strstr($lab_config_id,",") )
		$lab_config_ids = explode(",",$lab_config_id);
	else if ( $lab_config_id != 0 )
		$lab_config_ids[] = $lab_config_id;

	$stat_list = array();
		
	/* All Tests & All Labs */ 
	if ( $test_type_id == 0 && $lab_config_id == 0 ) { 
		$site_list = get_site_list($_SESSION['user_id']);

		foreach( $site_list as $key => $value) {
			$lab_config = get_lab_config_by_id($key);
			$labName = $lab_config->name;
			$namesArray[] = $labName;
			$stat_list = StatsLib::getTatDailyProgressionStats($lab_config, $test_type_id, $date_from, $date_to, $include_pending, $test_category_id);
			ksort($stat_list);
			$stat_lists[] = $stat_list;
			unset($stat_list);
		}
	}
	/* All Tests for Single Lab */
	else if ( $test_type_id == 0 && count($lab_config_ids) == 1 ) {
		$lab_config = get_lab_config_by_id($lab_config_id);
		$labName = $lab_config->name;
		$namesArray[] = $labName;
		$stat_list = StatsLib::getTatDailyProgressionStats($lab_config, $test_type_id, $date_from, $date_to, $include_pending, $test_category_id);
		ksort($stat_list);
		$stat_lists[] = $stat_list;
	}
	/* All Tests for Multiple Labs */
	else if ( $test_type_id == 0 && count($lab_config_ids) > 1 ) {
		foreach( $lab_config_ids as $key) {
			$lab_config = LabConfig::getById($key);
			$namesArray[] = $lab_config->name;
			$stat_list = StatsLib::getTatDailyProgressionStats($lab_config, $test_type_id, $date_from, $date_to, $include_pending);
			ksort($stat_list); 
			$stat_lists[] = $stat_list;
			unset($stat_list);
		}
	}
	else {
		/* Build Array Map with Lab Id as Key and Test Id as corresponding Value, if using aggregation */
		$testIds = array();
		if( strstr($test_type_id,";") ) {
			$labIdTestIds = explode(";",$test_type_id);
			foreach( $labIdTestIds as $labIdTestId) {
					$labIdTestIdsSeparated = explode(":",$labIdTestId);
					$labId = $labIdTestIdsSeparated[0];
					$testId = $labIdTestIdsSeparated[1];
					$testIds[$labId] = $testId;
			}	
		}
		else {
				$testIds[$lab_config_id] = $test_type_id;
		}
		
		/* Single Test for All Labs */
		if ( $test_type_id != 0 && $lab_config_id == 0 ) {
			$site_list = get_site_list($_SESSION['user_id']);

			foreach( $site_list as $key => $value) {
				$lab_config = LabConfig::getById($key);
				$test_type_id = $testIds[$lab_config->id];
				$namesArray[] = $lab_config->name;
				$stat_list = StatsLib::getTatDailyProgressionStats($lab_config, $test_type_id, $date_from, $date_to, $include_pending);
				ksort($stat_list); 
				$stat_lists[] = $stat_list;
				unset($stat_list);
			}
		}
		/* Single Test for Single Lab */
		else if ( $test_type_id != 0 && count($lab_config_ids) == 1 ) {
			$lab_config = get_lab_config_by_id($lab_config_id);
			$test_type_id = $testIds[$lab_config->id];
			$labName = $lab_config->name;
			$namesArray[] = $labName;
			$stat_list = StatsLib::getTATDailyStats($lab_config, $test_type_id, $date_from, $date_to, $include_pending);
			ksort($stat_list);
			$stat_lists[] = $stat_list;
		}
		/* Single Test for Multiple Labs */
		else if ( $test_type_id != 0 && count($lab_config_ids) > 1 ) {
			
			foreach( $lab_config_ids as $key) {
				$lab_config = LabConfig::getById($key);
				$test_type_id = $testIds[$lab_config->id];
				$namesArray[] = $lab_config->name;
				$stat_list = StatsLib::getTatDailyProgressionStats($lab_config, $test_type_id, $date_from, $date_to, $include_pending);
				ksort($stat_list); 
				$stat_lists[] = $stat_list;
				unset($stat_list);
			}
		}
	}

	$testETAT = 0;
	$progressData = array();
	$waitingTimeData = array();
	foreach($stat_lists as $stat_list) {
		foreach($stat_list as $key => $value) {
			$waitValue = round($value[1],2);
			$formattedValue = round($value[0],2);
			$formattedDate = bcmul($key,1000);
			$progressData[] = array($formattedDate,$formattedValue);
			$waitingTimeData[] = array($formattedDate,$waitValue);
			$testETAT = $value[2]; //In Hours
		}
		$progressTrendsData[] = $progressData;
		$progressTrendsData[] = $waitingTimeData;
		unset($progressData);
	}
	# Obtain stats as date_collected(millisec ts) => tat value

	# Build chart with time series
	$div_id = "tplaceholder_".$testTypeId;
	$ylabel_id = "tylabel_".$testTypeId;
	$legend_id = "tlegend_".$testTypeId;

	?>
	<script type='text/javascript'>
		var progressTrendsData = new Array();
		var expectedTAT = new Array;
		// var namesArray = <?php echo json_encode($namesArray); ?>;
		var namesArray = new Array("Expected TAT", "Actual TAT", "Waiting Time");
		var progressTrendsDataTemp = <?php echo json_encode($progressTrendsData); ?>;

		var values, value1, value2;
		/* Convert the string timestamps to floatvalue timestamps */
		for(var j=0;j<progressTrendsDataTemp.length;j++) {
			var i = 0;
			if( progressTrendsDataTemp[j][i]) {
				progressTrendsData[j] = new Array();
				while ( progressTrendsDataTemp[j][i] ) {
					values = progressTrendsDataTemp[j][i];
					value1 = parseFloat(values[0]);
					value2 = values[1];
					progressTrendsData[j][i] = [value1, value2];
					i++;
				}
			}
		}
		
		for(var i=0;i<progressTrendsData[0].length;i++) {
			tmp = (progressTrendsData[0][i]);
			expectedTAT[i] = [tmp[0], <?php echo $testETAT; ?>];
		}

		var options = {
		chart: {
			 renderTo: 'trendsDiv',
			 type: 'spline'
		  },
		  title: {
			 text: <?php echo "'".LangUtil::$pageTerms['MENU_TAT']."'"; ?>//'TurnAroundTime Rate'
		  },
		  xAxis: {
			 type: 'datetime',
			 dateTimeLabelFormats: { 
				month: '%e. %b',
				year: '%b'
			 },
		  },
		  yAxis: {
			 title: {
				text: 'TurnAround Time (Hours)'
			 },
		  },
		  tooltip: {
			 formatter: function() {
			 	hrs = Math.floor(this.y);
			 	yshow = "";
			 	mins = Math.round((this.y - hrs)*60);
			 	if(hrs < 1){
			 		yshow = mins + " Minutes";
			 	}else if(mins == 0){
			 		yshow = hrs + " Hours";
			 	}else{
			 		yshow = hrs + " Hours " + mins + " Minutes";
			 	}
			   return '<b>'+ this.series.name +'</b><br/>' + Highcharts.dateFormat('%e. %b', this.x) +': '+ yshow;
			 }
		  },
		  series: []
	   };

		// namesArray.push("Waiting Time");
		// namesArray.unshift("Expected TAT");
		progressTrendsData.unshift(expectedTAT);
		
		for(var i=0;i<namesArray.length;i++) {
			if (progressTrendsData[i].length > 0) {
				options.series.push({
					name: namesArray[i],
					data: progressTrendsData[i]
				});
			}
		}
		Highcharts.setOptions({
		    global: {
		        useUTC: false
		    }
		});
		new Highcharts.Chart(options);

	</script>

	<div id="trendsDiv" style="width: 800px; height: 400px; margin: 0 auto"></div>
	<?php

	if($testTypeId != 0) {
		# Show table of graph data

			$table_id = 'graph-data-table-'.$testTypeId;
			$count['TOTAL'] = 0;
			$count['GT_TAT'] = 0;
			$count['TARGET_TAT'] = 0;
			$graph_data = "";
			foreach($stat_list as $key=>$graph_records)
			{
				foreach($graph_records[4] as $datum)
				{
					$spec_id = substr($datum['category'], 0, 3)."-".$datum['specimen_id'];
					$time_r = $datum['ts'];
					$time_c = $datum['ts_collected'];
					$time_f = $datum['ts_completed'];
					$count['TOTAL']++;
					if((($time_f-$time_c)/60/60)>$datum['target_tat'])$count['GT_TAT']++;
					$count['TARGET_TAT'] = $datum['target_tat'];

					$graph_data .= "<tr><td>".$count['TOTAL']."</td>";
					$graph_data .= "<td>$spec_id</td>";
					$graph_data .= "<td>".$datum['specimen_type']."</td>";
					$graph_data .= "<td>".$datum['test_name']."</td>";
					$graph_data .= "<td>".date("Y-m-d H:i:s", $datum['ts'])."</td>";
					$graph_data .= "<td>".round(($time_c-$time_r)/60, 2)."</td>";
					$graph_data .= "<td>".round(($time_f-$time_c)/60, 2)."</td></tr>";
				}
			}
			$graph_summary_style = "style='width:320px;font-size:1.1em;border:1px solid #cdcdcd;margin:5px;padding:5px 15px;'";
			?>
			<div class='sidetip_nopos' <?php echo $graph_summary_style; ?>>
				<div>
					<span>Target TAT:</span>
					<span style='float:right;'><?php echo $count['TARGET_TAT']; ?> Hours</span>
				</div>
				<div>
					<span>Total Number of Specimen in Interval:</span>
					<span style='float:right;'><?php echo $count['TOTAL']; ?></span>
				</div>
				<div>
					<span>Specimen Exceeding Target TAT:</span>
					<span style='float:right;'><?php echo $count['GT_TAT']; ?></span>
				</div>
				<a href="javascript:toggle('<?php echo $table_id; ?>');">
					View/Hide Details &raquo;</a>
			</div>
			
			<table class='tablesorter' id='<?php echo $table_id; ?>' style='display:none;'>
				<thead>
					<tr>
						<th style="padding:5px;">#</th>
						<th><?php echo LangUtil::$generalTerms['SPECIMEN_ID']; ?></th>
						<th><?php echo LangUtil::$generalTerms['TYPE']; ?></th>
						<th><?php echo LangUtil::$generalTerms['TESTS']; ?></th>
						<th><?php echo LangUtil::$generalTerms['C_DATE']; ?></th>
						<th>Waiting Time (Mins)</th>
						<th>TAT (Mins)</th>
					</tr>
				</thead>
				<tbody>
					<?php echo $graph_data; ?>
				</tbody>
			</table>
			<script type='text/javascript'>
				$(function () {
					$('#<?php echo $table_id; ?>').tablesorter();
				});
			</script>
			<br>
		<?php
	}
?>
