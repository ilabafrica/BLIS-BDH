<?php
#
# Main page for printing daily specimen records
#
include("redirect.php");
include("includes/db_lib.php");
include("includes/script_elems.php");
include("includes/page_elems.php");
LangUtil::setPageId("reports");

# Utility function
function get_records_to_print($lab_config, $cat_code, $date_from, $date_to, $ref_status, $facility)
{
	$saved_db = DbUtil::switchToLabConfig($lab_config->id);
	$retval = array();
	if($cat_code != 0){
		$query_string =
		"SELECT s.*, t.* FROM specimen s, test_category tc, test_type tt, specimen_custom_data scd, test t WHERE
		(t.specimen_id=s.specimen_id AND t.test_type_id=tt.test_type_id AND tt.test_category_id=tc.test_category_id
		AND s.specimen_id = scd.specimen_id AND scd.field_id = 1 AND s.specimen_id = scd.specimen_id AND tc.test_category_id=$cat_code AND s.status_code_id=6 
		AND s.date_collected BETWEEN '$date_from' AND '$date_to');";

			if ($ref_status == 2 or $ref_status == 3){
					$query_string =
					"SELECT s.*, t.* FROM specimen s, test_category tc, test_type tt, specimen_custom_data scd, test t WHERE
					(t.specimen_id=s.specimen_id AND t.test_type_id=tt.test_type_id AND tt.test_category_id=tc.test_category_id
					AND s.specimen_id = scd.specimen_id AND scd.field_id = 1 AND s.referred_to = $ref_status AND s.specimen_id = scd.specimen_id 
					AND tc.test_category_id=$cat_code AND s.date_collected BETWEEN '$date_from' AND '$date_to');";

				if($facility){
					$query_string =
					"SELECT s.*, t.* FROM specimen s, test_category tc, test_type tt, specimen_custom_data scd, test t WHERE
					(t.specimen_id=s.specimen_id AND t.test_type_id=tt.test_type_id AND tt.test_category_id=tc.test_category_id 
					AND s.specimen_id = scd.specimen_id AND scd.field_id = 1 AND s.referred_to = $ref_status AND s.specimen_id = scd.specimen_id 
					AND tc.test_category_id=$cat_code and scd.field_value like '%$facility%'
					AND s.date_collected BETWEEN '$date_from' AND '$date_to');";
				}
			}
			else if($facility){
				$query_string =
				"SELECT s.*, t.* FROM specimen s, test_category tc, test_type tt, specimen_custom_data scd, test t WHERE ".
				" (t.specimen_id=s.specimen_id AND t.test_type_id=tt.test_type_id AND tt.test_category_id=tc.test_category_id ".
				"AND s.specimen_id = scd.specimen_id AND scd.field_id = 1 AND s.specimen_id = scd.specimen_id AND tc.test_category_id=$cat_code 
				AND scd.field_value like '%$facility%' AND s.date_collected BETWEEN '$date_from' AND '$date_to');";
			}
	}

	else if ($cat_code == 0){
		$query_string =
			"SELECT s.*, t.* FROM specimen s, specimen_custom_data scd, test t ".
			"WHERE s.specimen_id = scd.specimen_id AND scd.field_id = 1 AND s.specimen_id = t.specimen_id AND 
			 s.date_collected BETWEEN '$date_from' AND '$date_to' ";

		if ($ref_status == 2 or $ref_status == 3){
			$query_string =
			"SELECT s.*, t.* FROM specimen s, specimen_custom_data scd, test t ".
			"WHERE s.specimen_id = scd.specimen_id AND scd.field_id = 1 AND s.specimen_id = t.specimen_id AND s.referred_to = $ref_status AND 
			 s.date_collected BETWEEN '$date_from' AND '$date_to' ";

			 if($facility){
				$query_string =
				"SELECT s.*, t.* FROM specimen s, specimen_custom_data scd, test t 
				WHERE s.specimen_id = scd.specimen_id AND scd.field_id = 1 AND s.specimen_id = t.specimen_id and scd.field_value like '%$facility%'
				AND s.referred_to = $ref_status AND s.date_collected BETWEEN '$date_from' AND '$date_to' ";
			}
		}
		else if($facility){
				$query_string =
				"SELECT s.*, t.* FROM specimen s, specimen_custom_data scd, test t ".
				"WHERE s.specimen_id = scd.specimen_id AND scd.field_id = 1 AND s.specimen_id = t.specimen_id and scd.field_value like '%$facility%'
				AND s.date_collected BETWEEN '$date_from' AND '$date_to' ";
		}
	}

	$resultset = query_associative_all($query_string, $row_count);
	//echo $query_string.'<br>';
		
	foreach($resultset as $record)
	{
		$specimen = Specimen::getObject($record);
		$test = Test::getObject($record);

		$retval[] = $specimen;
		$retvalTest[] = $test;
	}
	$retvalComplete = array();
	$retvalComplete['specimen'] = $retval;
	$retvalComplete['test'] = $retvalTest;
	DbUtil::switchRestore($saved_db);
	return $retvalComplete;
}

$page_elems = new PageElems();
$script_elems = new ScriptElems();
$script_elems->enableJQuery();
$script_elems->enableTableSorter();
$script_elems->enableDragTable();

$date_from = get_request_variable('yf')."-".get_request_variable('mf')."-".get_request_variable('df');
$date_to = get_request_variable('yt')."-".get_request_variable('mt')."-".get_request_variable('dt');
$lab_config_id = get_request_variable('l');
$cat_code = get_request_variable('c');
$ref_status = get_request_variable('rs');
$facility = get_request_variable('facility');

$uiinfo = "from=".$date_from."&to=".$date_to."&ct=".$cat_code."&tt=".$ttype;
putUILog('daily_log_specimens', $uiinfo, basename($_SERVER['REQUEST_URI'], ".php"), 'X', 'X', 'X');

$lab_config = get_lab_config_by_id($lab_config_id);
$test_types = get_lab_config_test_types($lab_config_id);

$report_id = $REPORT_ID_ARRAY['reports_dailyspecimens.php'];
$report_config = $lab_config->getReportConfig($report_id);

$margin_list = $report_config->margins;
for($i = 0; $i < count($margin_list); $i++)
{
	$margin_list[$i] = ($SCREEN_WIDTH * $margin_list[$i] / 100);
}

if($cat_code != 0)
{
	# Fetch all tests belonging to this category (aka lab section)
	$cat_test_types = TestType::getByCategory($cat_code);
	$cat_test_ids = array();
	foreach($cat_test_types as $test_type)
		$cat_test_ids[] = $test_type->testTypeId;
	$matched_test_ids = array_intersect($cat_test_ids, $test_types);
	$test_types = array_values($matched_test_ids);
}
?>
<script type='text/javascript'>
function export_as_word(div_id)
{
	var content = $('#'+div_id).html();
	$('#word_data').attr("value", content);
	$('#word_format_form').submit();
}

function report_fetch()
{ 	var yt= <?php echo get_request_variable('yt');?>;
	var yf=<?php echo get_request_variable('yf');?>;
	var mt=<?php echo get_request_variable('mt');?>;
	var mf=<?php echo get_request_variable('mf');?>;
	var dt=<?php echo get_request_variable('dt');?>;
	var df=<?php echo get_request_variable('df');?>;
	var l=<?php echo get_request_variable('l');?>;
	var cat_code=<?php echo get_request_variable('c');?>;
	var ttype=<?php echo get_request_variable('t');?>;
	var ip = 0;
	var p=0;
	if($('#ip').is(":checked"))
		ip = 1;
	if($('#p').is(":checked"))
		p = 1;
	var url = "reports_dailyspecimens.php?yt="+yt+"&mt="+mt+"&dt="+dt+"&yf="+yf+"&mf="+mf+"&df="+df+"&l="+l+"&c="+cat_code+"&t="+ttype+"&ip="+ip+"&p="+p;
	window.open(url);
	}

function print_content(div_id)
{
	var DocumentContainer = document.getElementById(div_id);
	var WindowObject = window.open("", "PrintWindow", "toolbars=no,scrollbars=yes,status=no,resizable=yes");
	var html_code = DocumentContainer.innerHTML;
	var do_landscape = $("input[name='do_landscape']:checked").attr("value");
	if(do_landscape == "Y")
		html_code += "<style type='text/css'> #report_config_content {-moz-transform: rotate(-90deg) translate(-300px); } </style>";WindowObject.document.writeln(html_code);
	WindowObject.document.close();
	WindowObject.focus();
	WindowObject.print();
	WindowObject.close();
	//javascript:window.print();
}

$(document).ready(function(){
	$('#report_content_table4').tablesorter();
});
</script>
<form name='word_format_form' id='word_format_form' action='export_word.php' method='post' target='_blank'>
	<input type='hidden' name='data' value='' id='word_data' />
</form>
		<input type='radio' name='do_landscape' value='N'<?php
		if($report_config->landscape == false) echo " checked ";
		?>>Portrait</input>
		&nbsp;&nbsp;
		<input type='radio' name='do_landscape' value='Y' <?php
		if($report_config->landscape == true) echo " checked ";
		?>>Landscape</input>&nbsp;&nbsp;
<input type='button' onclick="javascript:print_content('export_content');" value='<?php echo LangUtil::$generalTerms['CMD_PRINT']; ?>'></input>
&nbsp;&nbsp;&nbsp;&nbsp;
<input type='button' onclick="javascript:export_as_word('export_content');" value='<?php echo LangUtil::$generalTerms['CMD_EXPORTWORD']; ?>'></input>
&nbsp;&nbsp;&nbsp;&nbsp;
<?php if(get_request_variable('ip')==1){?><input type='checkbox' name='ip' id='ip' checked ></input> <?php echo "All Tests"; ?>
<?php } else{?><input type='checkbox' name='ip' id='ip'></input> <?php echo "All Tests"; }?>
&nbsp;&nbsp;&nbsp;&nbsp;
<?php if(get_request_variable('p')==1){?><input type='checkbox' name='p' id='p' checked ></input> <?php echo "Only Pending"; ?>
<?php } else{?><input type='checkbox' name='p' id='p'></input> <?php echo "Only Pending"; }?>
&nbsp;&nbsp;&nbsp;&nbsp;
<input type='button' onclick="javascript:report_fetch();" value='<?php echo LangUtil::$generalTerms['CMD_VIEW']; ?>'></input>
&nbsp;&nbsp;&nbsp;&nbsp;
<input type='button' onclick="javascript:window.close();" value='<?php echo LangUtil::$generalTerms['CMD_CLOSEPAGE']; ?>'></input>
&nbsp;&nbsp;&nbsp;&nbsp;
<?php $page_elems->getTableSortTip(); ?>
<hr>

<div id='export_content'>
<link rel='stylesheet' type='text/css' href='css/table_print.css' />
<style type='text/css'>
	<?php $page_elems->getReportConfigCss($margin_list, false); ?>
</style>
<div id='report_config_content'>
<!-- Logo -->
<div id="docbody" name="docbody">

<div id='logo' >

<?php

# If hospital logo exists, include it

$logo_path = "../logos/logo_".$lab_config_id.".png";

$logo_path2 = "../ajax/logo_".$lab_config_id.".png";

$logo_path1="../../logo_".$lab_config_id.".png";





if(file_exists($logo_path1) === true)

{	copy($logo_path1,$logo_path);

	?>

	<img src='<?php echo "logos/logo_".$lab_config_id.".png"; ?>' alt="Bungoma District Hospital" height='140px'></src>

	<?php

}

else if(file_exists($logo_path) === true)

{

?>
<img src='<?php echo "logos/logo_".$lab_config_id.".png"; ?>' alt="Bungoma District Hospital" height='140px' style='float:left;' width='140px'></src>

	<img src='<?php echo "logos/logo_".$lab_config_id.".png"; ?>' alt="Bungoma District Hospital" height='140px' style='float:right; padding-right:10px;' width='140px'></src>

	<?php

}

?>

</div>
<!-- Logo -->
<?php $align=$report_config->alignment_header;?>
<h5 style="text-align:center;"><?php echo $report_config->headerText; ?></h5>
<h4 style="text-align:center;"><?php echo $report_config->titleText."Referral Register"; ?></h4>
</div>
<?php
 if($date_from == $date_to)
 {
	echo LangUtil::$generalTerms['DATE'].": ".DateLib::mysqlToString($date_from);
 }
 else
 {
	echo LangUtil::$generalTerms['FROM_DATE'].": ".DateLib::mysqlToString($date_from);
	echo " | ";
	echo LangUtil::$generalTerms['TO_DATE'].": ".DateLib::mysqlToString($date_to);
 }
$record_list = array();
$retval = get_records_to_print($lab_config, $cat_code, $date_from, $date_to, $ref_status, $facility);
$record_list[] = $retval['specimen'];
$record_list_test = $retval['test'];

$total_tests = 0;
foreach($record_list as $record)
{
	$total_tests += count($record);
}
?>	
<br>
 <?php if($cat_code != 0){ echo LangUtil::$generalTerms['LAB_SECTION']; ?>: <?php }
	if($cat_code == 0)
	{
		//echo LangUtil::$generalTerms['ALL'];
	}
	else
	{
		$cat_name = get_test_category_name_by_id($cat_code);
		echo $cat_name;
	}
	 
if(count($test_types) == 0)
{
	?>
	<br><br>
	<b><?php echo $cat_name; ?></b> <?php echo LangUtil::$pageTerms['TIPS_RECNOTFOUND']; ?>
	<?php # Line for Signature ?>
	<br><br>
	.............................
	<h4><?php echo $report_config->footerText; ?></h4>
	<?php
	return;
}

?>

<?php
$no_match = true;
foreach($record_list as $record)
{
	if($record == null)
		continue;
	if(count($record) == 0)
		continue;
	if(count($record[0]) != 0)
	{
		$no_match = false;
		break;
	}
}
if($no_match === true)
{
	?>
	<?php echo LangUtil::$pageTerms['TIPS_RECNOTFOUND']; ?>
	<?php # Line for Signature ?>
	<br><br>
	.............................
	<h4><?php echo $report_config->footerText; ?></h4>
	<?php
	return;
}
?>
<table class='print_entry_border draggable' id='report_content_table4' style='width:97%; margin-bottom:5px;'>
<thead>
		<tr valign='top'>
			<?php
			echo "<th>"."Date Received"."</th>";
			echo "<th>"."Time Received"."</th>";
			echo "<th>"."Specimen ID"."</th>";
			echo "<th>"."Specimen Name"."</th>";
			echo "<th>"."Test"."</th>";
			echo "<th>"."Results"."</th>";
			echo "<th>"."Reffered"."</th>";
			echo "<th>"."Facility"."</th>";
			?>
		</tr>
	</thead>
	<tbody>
	
	<?php
	$count = 1;
	# Loop here
	//ho "rl".count($record_list);
	foreach($record_list as $key1=>$record_set_array)
	{ //ho "eeel".count($record_set_array);
		foreach($record_set_array as $key2=>$record_set)
		{
		if(count($record_set) == 0)
			continue;
		$specimen = $record_set;
		$test = $record_list_test[$key2];
		$specimenCustomData = get_custom_data_specimen_bytype($specimen->specimenId, 1)
		?>
		<tr valign='top'>
			<?php
			echo "<td>".$specimen->dateCollected."</td>";
			echo "<td>".$specimen->timeCollected."</td>";
			echo "<td>".get_sequential_specimen_id($specimen->specimenId)."</td>";
			echo "<td>".get_specimen_name_by_id($specimen->specimenTypeId)."</td>";
			echo "<td>".$test->getTestName()."</td>";
			echo "<td>".$test->decodeResult()."</td>";
			echo "<td>"; 
				if($specimen->referredTo == 2){
					echo "In"; }
				else if($specimen->referredTo == 3){
					 echo "Out"; } 
			echo "</td>";
			echo "<td>".$specimenCustomData->fieldValue."</td>";
			?>
		</tr>
		<?php
		$count++;
		}
	}
	?>
	</tbody>
	</table>
		<?php echo "Total Specimens"; ?>: <?php echo $total_tests; ?> 


	<br>
	<?php

?>

<?php # Line for Signature ?>
.............................
<br><?php echo $report_config->footerText; ?>
<?php include('specimen_rejection_report_footer.php'); ?>
</div>
</div>