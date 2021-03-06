<?php
#
# Main page for printing daily patient records
#
include("redirect.php");
include("includes/db_lib.php");
include("includes/script_elems.php");
include("includes/page_elems.php");
LangUtil::setPageId("reports");


$page_elems = new PageElems();
$script_elems = new ScriptElems();
$script_elems->enableJquery();
$script_elems->enableTableSorter();
$script_elems->enableDragTable();

$date_from = $_REQUEST['yf']."-".$_REQUEST['mf']."-".$_REQUEST['df'];
$date_to = $_REQUEST['yt']."-".$_REQUEST['mt']."-".$_REQUEST['dt'];
$lab_config_id = $_REQUEST['l'];

$uiinfo = "from=".$date_from."&to=".$date_to;
putUILog('daily_log_patients', $uiinfo, basename($_SERVER['REQUEST_URI'], ".php"), 'X', 'X', 'X');

$lab_config = get_lab_config_by_id($lab_config_id);
$saved_db = DbUtil::switchToLabConfig($lab_config_id);
//$patient_list = Patient::getByAddDate($date_from);
//$patient_list = Patient::getByAddDateRange($date_from, $date_to);
$patient_list = Patient::getReportedByRegDateRange($date_from, $date_to);
$patient_list_U=Patient::getUnReportedByRegDateRange($date_from, $date_to);
//$patient_list = Patient::getByRegDateRange($date_from, $date_to);
DbUtil::switchRestore($saved_db);
$report_id = $REPORT_ID_ARRAY['reports_dailypatients.php'];
$report_config = $lab_config->getReportConfig($report_id);

$margin_list = $report_config->margins;
for($i = 0; $i < count($margin_list); $i++)
{
	$margin_list[$i] = ($SCREEN_WIDTH * $margin_list[$i] / 100);
}
?>
<script type='text/javascript'>
function export_as_word(div_id)
{
	var content = $('#'+div_id).html();
	$('#word_data').attr("value", content);
	$('#word_format_form').submit();
}

function print_content(div_id)
{
	var DocumentContainer = document.getElementById(div_id);
	var WindowObject = window.open("", "PrintWindow", "toolbars=no,scrollbars=yes,status=no,resizable=yes");
	var html_code = DocumentContainer.innerHTML;
	var do_landscape = $("input[name='do_landscape']:checked").attr("value");
	if(do_landscape == "Y")
		html_code += "<style type='text/css'> #report_config_content {-moz-transform: rotate(-90deg) translate(-300px); } </style>";
	WindowObject.document.writeln(html_code);
	WindowObject.document.close();
	WindowObject.focus();
	WindowObject.print();
	WindowObject.close();
	//javascript:window.print();
}

$(document).ready(function(){
	$('#report_content_table5').tablesorter();
});
</script>
<form name='word_format_form' id='word_format_form' action='export_word.php' method='post' target='_blank'>
	<input type='hidden' name='data' value='' id='word_data' />
</form>
<input type='radio' name='do_landscape' value='N' <?php
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
<h5 style="text-align:center;"><?php echo $report_config->headerText; ?></h5>
<h4 style="text-align:center;"><?php echo $report_config->titleText."Patients Records"; ?></h4>
<!--<?php echo LangUtil::$generalTerms['FACILITY']; ?>: <?php echo $lab_config->getSiteName(); ?>
 | -->
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
 ?>
  
<?php
if( (count($patient_list) == 0 || $patient_list == null) && (count($patient_list_U) == 0 || $patient_list_U == null) )
{
	echo LangUtil::$pageTerms['TIPS_NONEWPATIENTS'];
	return;
}

?>
<br>
<b>Reported</b>
<?php if(count($patient_list) > 0 ) { ?>
<table class='print_entry_border draggable' id='report_content_table5' style='width:97%; margin-bottom:5px;'>
<thead>
	<tr valign='top'>
		<?php
		if($report_config->usePatientId == 1)
		{
		?>
			<th><?php echo LangUtil::$generalTerms['PATIENT_ID']; ?></th>
		<?php
		}
		if($report_config->useDailyNum == 1)
		{
		?>
			<th><?php echo LangUtil::$generalTerms['PATIENT_DAILYNUM']; ?></th>
		<?php
		}
		if($report_config->usePatientAddlId == 1)
		{
		?>
			<th><?php echo LangUtil::$generalTerms['ADDL_ID']; ?></th>
		<?php
		}
		if($report_config->usePatientName == 1)
		{
		?>
			<th><?php echo LangUtil::$generalTerms['NAME']; ?></th>
		<?php
		}
		if($report_config->useAge == 1)
		{
		?>
			<th><?php echo LangUtil::$generalTerms['AGE']; ?></th>
		<?php
		}
		if($report_config->useGender == 1)
		{
		?>			
			<th><?php echo LangUtil::$generalTerms['GENDER']; ?></th>
		<?php
		}
		if($report_config->useDob == 1)
		{
		?>
			<th><?php echo LangUtil::$generalTerms['DOB']; ?></th>
		<?php 
		}
		if($report_config->useTest == 1)
		{
		?>
			<th><?php echo LangUtil::$generalTerms['TESTS']; ?></th>
		<?php
		}
		# Patient Custom fields here
		$custom_field_list = $lab_config->getPatientCustomFields();
		foreach($custom_field_list as $custom_field)
		{
			if(in_array($custom_field->id, $report_config->patientCustomFields))
			{	
				$field_name = $custom_field->fieldName;				
				echo "<th>";
				echo $field_name;
				echo "</th>";
			}
		}
		?>
	</tr>
</thead>
<tbody>
	<?php
	$count = 0;
	foreach($patient_list as $patient)
	{
		$count++;
		?>
		<tr>
		<?php
		if($report_config->usePatientId == 1)
		{
		?>
			<td><?php echo $patient->getSurrogateId(); ?></td>
		<?php
		}
		if($report_config->useDailyNum == 1)
		{
		?>
			<td><?php echo $patient->getDailyNum(); ?></td>
		<?php
		}
		if($report_config->usePatientAddlId == 1)
		{
		?>
			<td><?php echo $patient->getAddlId(); ?></td>
		<?php
		}
		if($report_config->usePatientName == 1)
		{
		?>
			<td><?php echo $patient->name; ?></td>
		<?php
		}
		if($report_config->useAge == 1)
		{
		?>
			<td><?php echo $patient->getAge(); ?></td>
		<?php
		}
		if($report_config->useGender == 1)
		{
		?>			
			<td><?php echo $patient->sex; ?></td>
		<?php
		}
		if($report_config->useDob == 1)
		{
		?>
			<td><?php echo $patient->getDob(); ?></td>
		<?php 
		}
		if($report_config->useTest == 1)
		{
		?>
			<td><?php echo $patient->getAssociatedTests($date_from, $date_to); ?></td>
		<?php
		}
		# Patient Custom fields here
		$custom_field_list = $lab_config->getPatientCustomFields();
		foreach($custom_field_list as $custom_field)
		{
			if(in_array($custom_field->id, $report_config->patientCustomFields))
			{	
				$field_name = $custom_field->fieldName;				
				$custom_data = get_custom_data_patient_bytype($patient->patientId, $custom_field->id);
				echo "<td>";
				if($custom_data == null)
				{
					echo "-";
				}
				else
				{
					$field_value = $custom_data->getFieldValueString($lab_config->id, 2);
					if(trim($field_value) == "")
						$field_value = "-";
					echo $field_value;
				}
				echo "</td>";					
			}
		}
		?>
		</tr>
		<?php
	}
}
?>
<b><?php echo LangUtil::$pageTerms['TOTAL_PATIENTS']; ?>: <?php echo count($patient_list); ?></b>
	</tbody>
</table>
<br><br><br><br>
<b>Unreported</b>
<table class='print_entry_border draggable' id='report_content_table5' style='width:97%; margin-bottom:5px;'>
<?php if( count($patient_list_U) > 0 ) { ?>
<thead>
	<tr valign='top'>
		<?php
		if($report_config->usePatientId == 1)
		{
		?>
			<th><?php echo LangUtil::$generalTerms['PATIENT_ID']; ?></th>
		<?php
		}
		if($report_config->useDailyNum == 1)
		{
		?>
			<th><?php echo LangUtil::$generalTerms['PATIENT_DAILYNUM']; ?></th>
		<?php
		}
		if($report_config->usePatientAddlId == 1)
		{
		?>
			<th><?php echo LangUtil::$generalTerms['ADDL_ID']; ?></th>
		<?php
		}
		if($report_config->usePatientName == 1)
		{
		?>
			<th><?php echo LangUtil::$generalTerms['NAME']; ?></th>
		<?php
		}
		if($report_config->useAge == 1)
		{
		?>
			<th><?php echo LangUtil::$generalTerms['AGE']; ?></th>
		<?php
		}
		if($report_config->useGender == 1)
		{
		?>			
			<th><?php echo LangUtil::$generalTerms['GENDER']; ?></th>
		<?php
		}
		if($report_config->useDob == 1)
		{
		?>
			<th><?php echo LangUtil::$generalTerms['DOB']; ?></th>
		<?php 
		}
		# Patient Custom fields here
		$custom_field_list = $lab_config->getPatientCustomFields();
		foreach($custom_field_list as $custom_field)
		{
			if(in_array($custom_field->id, $report_config->patientCustomFields))
			{	
				$field_name = $custom_field->fieldName;				
				echo "<th>";
				echo $field_name;
				echo "</th>";
			}
		}
		?>
	</tr>
</thead>
<?php } ?>
<tbody>
	<?php
	$count = 0;
	foreach($patient_list_U as $patient)
	{
		$count++;
		?>
		<tr>
		<?php
		if($report_config->usePatientId == 1)
		{
		?>
			<td><?php echo $patient->getSurrogateId(); ?></td>
		<?php
		}
		if($report_config->useDailyNum == 1)
		{
		?>
			<td><?php echo $patient->getDailyNum(); ?></td>
		<?php
		}
		if($report_config->usePatientAddlId == 1)
		{
		?>
			<td><?php echo $patient->getAddlId(); ?></td>
		<?php
		}
		if($report_config->usePatientName == 1)
		{
		?>
			<td><?php echo $patient->name; ?></td>
		<?php
		}
		if($report_config->useAge == 1)
		{
		?>
			<td><?php echo $patient->getAge(); ?></td>
		<?php
		}
		if($report_config->useGender == 1)
		{
		?>			
			<td><?php echo $patient->sex; ?></td>
		<?php
		}
		if($report_config->useDob == 1)
		{
		?>
			<td><?php echo $patient->getDob(); ?></td>
		<?php 
		}
		# Patient Custom fields here
		$custom_field_list = $lab_config->getPatientCustomFields();
		foreach($custom_field_list as $custom_field)
		{
			if(in_array($custom_field->id, $report_config->patientCustomFields))
			{	
				$field_name = $custom_field->fieldName;				
				$custom_data = get_custom_data_patient_bytype($patient->patientId, $custom_field->id);
				echo "<td>";
				if($custom_data == null)
				{
					echo "-";
				}
				else
				{
					$field_value = $custom_data->getFieldValueString($lab_config->id, 2);
					if(trim($field_value) == "")
						$field_value = "-";
					echo $field_value;
				}
				echo "</td>";					
			}
		}
		?>
		</tr>
		<?php
	}
	?><b><?php echo LangUtil::$pageTerms['TOTAL_PATIENTS']; ?>: <?php echo count($patient_list_U); ?></b>
	</tbody>
</table>

<br>
<?php # Line for Signature ?>
.............................
<br><?php echo $report_config->footerText; ?>
</div>
</div>