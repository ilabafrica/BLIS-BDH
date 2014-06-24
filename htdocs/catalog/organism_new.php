<?php
#
# Main page for adding new organism
#
include("redirect.php");
include("../includes/page_elems.php");
require_once("includes/script_elems.php");
$script_elems = new ScriptElems();
$page_elems = new PageElems();

LangUtil::setPageId("catalog");
?>
<script type='text/javascript'>
function check_input()
{
	// Validate
	var organism_name = $('#organism_name').val();
	if(organism_name == "")
	{
		alert("<?php echo LangUtil::$pageTerms['TIPS_MISSING_ORGANISMNAME']; ?>");
		return;
	}
	// All OK
	$('#new_organism_form').submit();
}

</script>
<div class="portlet box green">
	<div class="portlet-title">
		<h4><i class="icon-reorder"></i><?php echo LangUtil::$pageTerms['NEW_ORGANISM']; ?></h4>
		<div class="tools">
			<a href="javascript:;" class="collapse"></a>
			
		</div>
	</div>
	<div class="portlet-body">
		<a style='margin-left:5px;' href='catalog.php?show_o=1'><?php echo LangUtil::$generalTerms['CMD_CANCEL']; ?></a><p></p>
		<div class='pretty_box' style='margin-left:5px;' >
			<form name='new_organism_form' id='new_organism_form' action='organism_add.php' method='post'>
				<table cellspacing='4px' class="table table-bordered table-hover">
					<tbody>
						<tr valign='top'>
							<td style='width:150px;'><?php echo LangUtil::$generalTerms['NAME']; ?><?php $page_elems->getAsterisk(); ?></td>
							<td><input type='text' name='organism_name' id='organism_name' class='span4 m-wrap' /></td>
						</tr>
						<tr valign='top'>
							<td><?php echo LangUtil::$generalTerms['DESCRIPTION']; ?></td>
							<td><textarea name='organism_desc' id='organism_desc' class='span4 m-wrap'></textarea></td>
						</tr>
						<tr valign='top' class='drugsClass'>
			                <td><?php echo LangUtil::$generalTerms['COMPATIBLE_DRUGS']; ?><?php $page_elems->getAsterisk(); ?>  [<a href='#drugs_help' rel='facebox'>?</a>] </td>
			                <td><?php $page_elems->getDrugsCheckboxes($lab_config_id, false,$organism->organismId); ?><br></td>
						</tr>
					</tbody>
				</table>
				<div class="form-actions">
	              <button type="submit" onclick='check_input();' class="btn blue"><?php echo LangUtil::$generalTerms['CMD_SUBMIT']; ?></button>
	              <a href='catalog.php?show_o=1' class='btn'> <?php echo LangUtil::$generalTerms['CMD_CANCEL']; ?></a>
              	</div>
			</form>
		</div>
	</div>
</div>

