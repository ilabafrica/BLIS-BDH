<?php
#
# Main page for modifying an existing organism
#
include("redirect.php");
include("includes/header.php");
include("includes/ajax_lib.php");
LangUtil::setPageId("catalog");


$organism = get_organism_by_id($_REQUEST['oid']);
?>
<br>

<div class="portlet box green">
		<div class="portlet-title">
			<h4><i class="icon-reorder"></i><?php echo LangUtil::$pageTerms['EDIT_ORGANISM']; ?></h4>
			<div class="tools">
				<a href="javascript:;" class="collapse"></a>
				
			</div>
		</div>
		<div class="portlet-body">
		<br>
<a href="catalog.php?show_o=1"><?php echo LangUtil::$generalTerms['CMD_CANCEL']; ?></a>
<br><br>
<?php
if($organism == null)
{
?>
	<div class='sidetip_nopos'>
	<?php echo LangUtil::$generalTerms['MSG_NOTFOUND']; ?>
	</div>
<?php
	include("includes/footer.php");
	return;
}
$page_elems->getOrganismInfo($organism->name, true);
?>
<br>
<br>
<div class='pretty_box'>
<form name='edit_organism_form' id='edit_organism_form' action='ajax/organism_update.php' method='post'>
<input type='hidden' name='oid' id='oid' value='<?php echo $_REQUEST['oid']; ?>'></input>
	<table cellspacing='4px'>
		<tbody>
			<tr valign='top'>
				<td style='width:150px;'><?php echo LangUtil::$generalTerms['NAME']; ?><?php $page_elems->getAsterisk(); ?></td>
				<td><input type='text' name='name' id='name' class='span12 m-wrap' value='<?php echo $organism->getName(); ?>' class='uniform_width'></input></td>
			</tr>
			<tr valign='top'>
				<td><?php echo LangUtil::$generalTerms['DESCRIPTION']; ?></td>
				<td><textarea type='text' name='description' id='description' class='span12 m-wrap'><?php echo trim($organism->description); ?></textarea></td>
			</tr>

			<tr>
				<td></td>
				<td>
                
                <div class="form-actions">

                      <input class='btn yellow' type='button' value='<?php echo LangUtil::$generalTerms['CMD_SUBMIT']; ?>' onclick='javascript:update_organism();'></input>
                      <a href='catalog.php?show_o=1' class='btn'> <?php echo LangUtil::$generalTerms['CMD_CANCEL']; ?></a>
                </div>
               	<span id='update_organism_progress' style='display:none;'>
						<?php $page_elems->getProgressSpinner(LangUtil::$generalTerms['CMD_SUBMITTING']); ?>
					</span>
				</td>
			</tr>
		</tbody>
	</table>
    
</form>
</div>
		
				</div>
	</div>

<div id='drug_help' style='display:none'>
<small>
Use Ctrl+F to search easily through the list. Ctrl+F will prompt a box where you can enter the test name you are looking for.
</small>
</div>
<script type='text/javascript'>
function update_organism()
{
	if($('#name').attr("value").trim() == "")
	{
		alert("<?php echo LangUtil::$pageTerms['TIPS_MISSING_ORGANISMNAME']; ?>");
		return;
	}
	$('#update_organism_progress').show();
	$('#edit_organism_form').ajaxSubmit({
		success: function(msg) {
			$('#update_organism_progress').hide();
			window.location="organism_updated.php?oid=<?php echo $_REQUEST['oid']; ?>";
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