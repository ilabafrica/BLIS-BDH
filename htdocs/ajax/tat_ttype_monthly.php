<?php
	#
	# Main page for creating Monthly TAT progression charts
	# Called via Ajax from reports_tat.php 
	# We only handle one lab (No multiple labs)
	#

	include("../includes/user_lib.php");
	include("../includes/db_lib.php");
	include("../includes/stats_lib.php");

	LangUtil::setPageId("reports");

	global $TURNAROUND_REPORT; # Default TAT Report configs

	$date_from = $_REQUEST['df'];
	$date_to = $_REQUEST['dt'];
	
	$include_pending = false;
	if($_REQUEST['p'] == 1)	$include_pending = true;

	$test_type_id = $_REQUEST['tt'];
	$test_category_id = $_REQUEST['tc'];
	$lab_config_id = $_REQUEST['l'];

	if( strstr($lab_config_id,",") )
		$lab_config_ids = explode(",",$lab_config_id);
	else if ( $lab_config_id != 0 )
		$lab_config_ids[] = $lab_config_id;

	$stat_list = array();

	$show_in_hours = true;
	if(strcmp(strtolower($TURNAROUND_REPORT['Y_AXIS_UNIT']), "days") == 0)$show_in_hours = false;
		
	/* All Tests for Single Lab */
	if ( $test_type_id == 0 && count($lab_config_ids) == 1 ) {
		$lab_config = get_lab_config_by_id($lab_config_id);
		$stat_list = StatsLib::getTATMonthlyStats($lab_config, $test_type_id, $date_from, $date_to, $include_pending, $test_category_id);
		ksort($stat_list);
		$stat_lists[] = $stat_list;
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
		
		/* Single Test for Single Lab */
		if ( $test_type_id != 0 && count($lab_config_ids) == 1 ) {
			$lab_config = get_lab_config_by_id($lab_config_id);
			$test_type_id = $testIds[$lab_config->id];
			$stat_list = StatsLib::getTATMonthlyStats($lab_config, $test_type_id, $date_from, $date_to, $include_pending);
			ksort($stat_list);
			$stat_lists[] = $stat_list;
		}
	}

	$testETAT = 0; //Test Estimated TAT
	$progressData = array();
	$waitingTimeData = array();

	foreach($stat_lists as $stat_list) {
		foreach($stat_list as $key => $value) {
			$displayDate = bcmul($key,1000);
			$waitValue = round($value[1],2);
			$TATValue = round($value[0],2);
			$testETAT = $value[2];

			if (!$show_in_hours) {	// Show in days.
				$waitValue = $waitValue/24;
				$TATValue = $TATValue/24;
				$testETAT = $testETA/24;
			}
			$progressData[] = array($displayDate, $TATValue);
			$waitingTimeData[] = array($displayDate, $waitValue);
		}
		$progressTrendsData[] = $progressData;
		$progressTrendsData[] = $waitingTimeData;
		unset($progressData);
	}

	# Build chart with time series
	?>
	<script type='text/javascript'>
		var progressTrendsData = new Array();
		var expectedTAT = new Array;
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
				text: <?php echo "'Time Taken (" . ($show_in_hours?'Hours':'Days') . ")'"; ?>
			 },
		  },
		  tooltip: {
			 formatter: function() {
			 	dhVal = parseInt(<?php echo ($show_in_hours)?"1":"24"; ?>);
			 	tVal = this.y * dhVal;
			 	hrs = Math.floor(tVal);
			 	mins = Math.round((tVal - hrs)*60);
			 	yshow = "";
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
<!-- <pre><?php print_r($stat_lists); ?></pre> -->
	<div id="trendsDiv"></div>
	<?php

	if($test_type_id != 0) {
		# Show table of graph data

			$table_id = 'graph-data-table-'.$test_type_id;
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
					$count['EXCEED_STYLE'] = "";
					if((($time_f-$time_c)/60/60)>$datum['target_tat']){ //Exceeded Target TAT
						$count['GT_TAT']++;
						$count['EXCEED_STYLE'] = " class='label label-important' title='Exceeded target TAT'";
					}
					$count['TARGET_TAT'] = $datum['target_tat'];

					$graph_data .= "<tr><td>".$count['TOTAL']."</td>";
					$graph_data .= "<td>$spec_id</td>";
					$graph_data .= "<td>".$datum['specimen_type']."</td>";
					$graph_data .= "<td>".$datum['test_name']."</td>";
					$graph_data .= "<td>".date("Y-m-d H:i:s", $time_c)."</td>";
					$graph_data .= "<td>".round(($time_c-$time_r)/60, 2)."</td>";
					$graph_data .= "<td><span".$count['EXCEED_STYLE'].">".round(($time_f-$time_c)/60, 2)."</span></td></tr>";
				}
			}
			?>
			<div class="graph-data container-fluid">
				<div class='sidetip_nopos graph-summary row'>
					<div class="span8">
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
					</div>
					<div class="span4">
						<a class="btn btn-default" href="javascript:toggle('<?php echo $table_id; ?>');">
							View/Hide Details &raquo;</a>
					</div>
				</div>
				<table class='tablesorter graph-data-table' id='<?php echo $table_id; ?>' style='display:none;'>
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
			</div>
			<script type='text/javascript'>
				$(function () {
					$('#<?php echo $table_id; ?>').tablesorter();
				});
			</script>
		<?php
	}
?>
