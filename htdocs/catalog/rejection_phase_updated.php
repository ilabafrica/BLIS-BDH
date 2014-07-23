<?php
#
# Shows confirmation for specimen type updation
#
include("redirect.php");
include("includes/header.php"); 
LangUtil::setPageId("catalog");
?>
<br>

<div class="portlet box green">
	<div class="portlet-title">
		<h4><i class="icon-reorder"></i><?php echo "Specimen Rejection Phase Updated"; ?></h4>
		<div class="tools">
			<a href="javascript:;" class="collapse"></a>
			
		</div>
	</div>
	<div class="portlet-body">
	<br>
<a href='catalog.php?show_rp=1'>&laquo; <?php echo LangUtil::$pageTerms['CMD_BACK_TOCATALOG']; ?></a>
<br><br>
<?php 
$rejection_phase = get_rejection_phase_by_id($_REQUEST['rp']);
$page_elems->getRejectionPhaseInfo($rejection_phase->name); 
?>
</div>
		
				</div>
	</div>
<?php 
include("includes/scripts.php");
$script_elems->enableDatePicker();
$script_elems->enableJQuery();
$script_elems->enableJQueryForm();
$script_elems->enableTokenInput();
$script_elems->enableFacebox();
include("includes/footer.php"); ?>