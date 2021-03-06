<?php
#
# Main page for adding new test category
#
include("redirect.php");
include("includes/header.php");
LangUtil::setPageId("quality");
?>
<br>
<b><?php echo "New Quality Control Category"; ?></b>
| <a href='quality.php?show_qcc=1'><?php echo LangUtil::$generalTerms['CMD_CANCEL']; ?></a>
<br><br>
<div class='pretty_box'>
<form name='new_quality_control_category_form' id='new_quality_control_category_form' action='quality_control_category_add.php' method='post'>
<table class='smaller_font'>
<tr>
<td style='width:150px;'><?php echo LangUtil::$generalTerms['NAME']; ?><?php $page_elems->getAsterisk(); ?></td>
<td><input type='text' name='category_name' id='category_name' class='uniform_width' /></td>
</tr>
</table>
<br><br>
<input type='button' onclick='check_input();' value='<?php echo LangUtil::$generalTerms['CMD_SUBMIT']; ?>' />
&nbsp;&nbsp;&nbsp;&nbsp;
<a href='quality.php?show_qcc=1'> <?php echo LangUtil::$generalTerms['CMD_CANCEL']; ?></a>
</form>
</div>
<div id='quality_control_category_help' style='display:none'>
<small>
Use Ctrl+F to search easily through the list. Ctrl+F will prompt a box where you can enter the test category you are looking for.
</small>
</div>
<?php include("includes/scripts.php");
$script_elems->enableLatencyRecord();
$script_elems->enableDatePicker();
$script_elems->enableJQueryForm();
?>
<script type='text/javascript'>
function check_input()
{
	// Validate
	var category_name = $('#category_name').val();
	if(category_name == "")
	{
		alert("<?php echo "Error: Missing quality control category name"; ?>");
		return;
	}
	// All OK
	$('#new_quality_control_category_form').submit();
}

</script>

<?php include("includes/footer.php"); ?>