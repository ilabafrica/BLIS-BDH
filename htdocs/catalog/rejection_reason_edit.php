<?php
#
# Main page for modifying an existing specimen type
#
include("redirect.php");
include("includes/header.php");
include("includes/ajax_lib.php");
LangUtil::setPageId("catalog");


$rejection_reason = get_rejection_reason_by_id($_REQUEST['rr']);
?>
<br>

<div class="portlet box green">
		<div class="portlet-title">
			<h4><i class="icon-reorder"></i><?php echo "Edit Specimen Rejection Reason"; ?></h4>
			<div class="tools">
				<a href="javascript:;" class="collapse"></a>
				
			</div>
		</div>
		<div class="portlet-body">
		<br>
<a href="catalog.php?show_rr=1"><?php echo LangUtil::$generalTerms['CMD_CANCEL']; ?></a>
<br><br>
<?php
if($rejection_reason == null)
{
?>
	<div class='sidetip_nopos'>
	<?php echo LangUtil::$generalTerms['MSG_NOTFOUND']; ?>
	</div>
<?php
	include("includes/footer.php");
	return;
}
$page_elems->getRejectionReasonInfo($rejection_reason->reasonId, true);
?>
<br>
<br>
<div class='pretty_box'>
<form name='edit_rejection_reason_form' id='edit_rejection_reason_form' action='ajax/rejection_reason_update.php' method='post'>
<input type='hidden' name='rr' id='rr' value='<?php echo $_REQUEST['rr']; ?>'></input>
	<table cellspacing='4px'>
		<tbody>
			<tr valign='top'>
				<td style='width:150px;'><?php echo LangUtil::$generalTerms['NAME']; ?><?php $page_elems->getAsterisk(); ?></td>
				<td><input type='text' name='reason_code' id='reason_code' class='span12 m-wrap' value='<?php echo $rejection_reason->code; ?>' class='uniform_width'></input></td>
			</tr>
			<tr valign='top'>
				<td><?php echo LangUtil::$generalTerms['DESCRIPTION']; ?></td>
				<td><textarea type='text' name='reason_description' id='reason_description' class='span12 m-wrap'><?php echo $rejection_reason->description; ?></textarea></td>
			</tr>

			<tr valign='top'>
				<td><?php echo "Specimen Rejection Phase"; ?></td>
				<td><select name="reason_phase" id="reason_phase"><?php $page_elems->getRejectionPhasesSelect(); ?></select></td>
			</tr>

			<tr>
				<td></td>
				<td>
                
                <div class="form-actions">

                      <input class='btn yellow' type='button' value='<?php echo LangUtil::$generalTerms['CMD_SUBMIT']; ?>' onclick='javascript:update_rejection_reason();'></input>
                      <a href='catalog.php?show_rr=1' class='btn'> <?php echo LangUtil::$generalTerms['CMD_CANCEL']; ?></a>
                </div>
               	<span id='update_rejection_reason_progress' style='display:none;'>
						<?php $page_elems->getProgressSpinner(LangUtil::$generalTerms['CMD_SUBMITTING']); ?>
					</span>
				</td>
			</tr>
		</tbody>
	</table>
    
</form>
</div>
<div id='test_help' style='display:none'>
<small>
Use Ctrl+F to search easily through the list. Ctrl+F will prompt a box where you can enter the test name you are looking for.
</small>
</div>
<script type='text/javascript'>
function update_rejection_reason()
{
	if($('#reason_description').attr("value").trim() == "")
	{
		alert("<?php echo 'Missing Rejection Reason Description.'; ?>");
		return;
	}
	$('#update_rejection_reason_progress').show();
	$('#edit_rejection_reason_form').ajaxSubmit({
		success: function(msg) {
			$('#update_rejection_reason_progress').hide();
			window.location="rejection_reason_updated.php?rr=<?php echo $_REQUEST['rr']; ?>";
		}
	});
}
</script>
<?php 
include("includes/scripts.php");
$script_elems->enableDatePicker();
$script_elems->enableJQuery();
$script_elems->enableJQueryForm();
$script_elems->enableTokenInput();
$script_elems->enableFacebox();
include("includes/footer.php"); ?>