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
		<h4><i class="icon-reorder"></i><?php echo "Specimen Rejection Reason Updated"; ?></h4>
		<div class="tools">
			<a href="javascript:;" class="collapse"></a>
			
		</div>
	</div>
	<div class="portlet-body">
	<br>
<a href='catalog.php?show_rr=1'>&laquo; <?php echo LangUtil::$pageTerms['CMD_BACK_TOCATALOG']; ?></a>
<br><br>
<?php 
$rejection_reason = get_rejection_reason_by_id($_REQUEST['rr']);
$page_elems->getRejectionReasonInfo($rejection_reason->reasonId); 
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