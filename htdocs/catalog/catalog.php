<?php
#
# (c) C4G, Santosh Vempala, Ruban Monu and Amol Shintre
# Main page for showing list of test/specimen types in catalog, with options to add/modify
#
include("../users/accesslist.php");
if( !(isAdmin(get_user_by_id($_SESSION['user_id'])) && in_array(basename($_SERVER['PHP_SELF']), $adminPageList)) )
	header( 'Location: home.php' );

include("redirect.php");
include("includes/header.php");
LangUtil::setPageId("catalog");

putUILog('catalog', 'X', basename($_SERVER['REQUEST_URI'], ".php"), 'X', 'X', 'X');
$dialog_id = "dialog_deletecatalog";
?>



<?php
$user = get_user_by_id($_SESSION['user_id']);
if(is_super_admin($user) || is_country_dir($user))
{
	# Allow deletion of all catalog data
	?>
	<a href="javascript:load_right_pane('remove_data_div');" class='menu_option' id='remove_data_div_menu'>
		<?php echo LangUtil::$pageTerms['MENU_REMOVEDATA']; ?>
	</a>
	<br><br>
<?php
}
?>
<!-- BEGIN PAGE TITLE & BREADCRUMB-->		
						<h3>
						</h3>
						<ul class="breadcrumb">
							<li><i class='icon-cogs'></i> Test Catalog
							</li>
						</ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
				<!-- END PAGE HEADER-->
<!-- BEGIN ROW-FLUID-->   
<div class="row-fluid">
<div class="span12 sortable">
	<div id='rm_msg' class='clean-orange' style='display:none;width:200px;'>
		<?php echo LangUtil::$generalTerms['MSG_DELETED']; ?>&nbsp;&nbsp;<a href="javascript:toggle('rm_msg');"><?php echo LangUtil::$generalTerms['CMD_HIDE']; ?></a>
	</div>
	<div id='test_types_div' class='content_div'>
		<div class="portlet box green">
		<div class="portlet-title">
			<h4><i class="icon-reorder"></i><?php echo LangUtil::$generalTerms['TEST_TYPES']; ?></h4>
			<div class="tools">
				<a href="javascript:;" class="collapse"></a>
				
			</div>
		</div>
		<div class="portlet-body">
		<p style="text-align: right;"><a rel='facebox' href='#TestType_tc'>Page Help</a></p>
		 <a href='test_type_new.php' class="btn blue-stripe" title='Add a New Test Type'><i class='icon-plus'></i> <?php echo LangUtil::$generalTerms['ADDNEW']; ?></a>
		<br><br>
		<div id='tdel_msg' class='clean-orange' style='display:none;'>
			<?php echo LangUtil::$generalTerms['MSG_DELETED']; ?>&nbsp;&nbsp;<a href="javascript:toggle('tdel_msg');"><?php echo LangUtil::$generalTerms['CMD_HIDE']; ?></a>
		</div>
		<?php $page_elems->getTestTypeTable($_SESSION['lab_config_id']); ?>
		</div>
		</div>
	</div>
	
	<div id='specimen_types_div' class='content_div'>
	<div class="portlet box green">
		<div class="portlet-title">
			<h4><i class="icon-reorder"></i><?php echo LangUtil::$generalTerms['SPECIMEN_TYPES']; ?></h4>
			<div class="tools">
				<a href="javascript:;" class="collapse"></a>
				
			</div>
		</div>
		<div class="portlet-body">
		<p style="text-align: right;"><a rel='facebox' href='#SpecimenType_tc'>Page Help</a></p>
		<a href='specimen_type_new.php' class="btn blue-stripe" title='Click to Add a New Specimen Type'><i class='icon-plus'></i> <?php echo LangUtil::$generalTerms['ADDNEW']; ?></a>
		<br><br>
		<div id='sdel_msg' class='clean-orange' style='display:none;'>
			<?php echo LangUtil::$generalTerms['MSG_DELETED']; ?>&nbsp;&nbsp;<a href="javascript:toggle('sdel_msg');"><?php echo LangUtil::$generalTerms['CMD_HIDE']; ?></a>
		</div>
		<?php $page_elems->getSpecimenTypeTable($_SESSION['lab_config_id']); ?>
		</div>
	</div>
	</div>

	<!--Drugs Div-->
	<div id='drug_types_div' class='content_div'>
    <div class="portlet box green">
		<div class="portlet-title">
			<h4><i class="icon-reorder"></i><?php echo LangUtil::$generalTerms['DRUG_TYPES']; ?></h4>
			<div class="tools">
				<a href="javascript:;" class="collapse"></a>
				
			</div>
		</div>
		<div class="portlet-body">
		<p style="text-align: right;"><a rel='facebox' href='#TestCategory_tc'>Page Help</a></p>
		<a href='javascript:add_drug();' class="btn blue-stripe" title='Click to Add a New Drug'><i class='icon-plus'></i> <?php echo LangUtil::$generalTerms['ADDNEW']; ?></a>
		<br><br>
		<div id='dtdel_msg' class='clean-orange' style='display:none;'>
			<?php echo LangUtil::$generalTerms['MSG_DELETED']; ?>&nbsp;&nbsp;<a href="javascript:toggle('dtdel_msg');"><?php echo LangUtil::$generalTerms['CMD_HIDE']; ?></a>
		</div>
		<?php $page_elems->getDrugTypesTable($_SESSION['lab_config_id']); ?>
		</div>
	</div>
	</div>
	<!--End Drugs Div-->

<!--Specimen Rejection Div-->
	<div id='specimen_rejection_div' class='content_div'>
      <div class="portlet box green">
		<div class="portlet-title">
			<h4><i class="icon-reorder"></i><?php echo LangUtil::$generalTerms['SPECIMEN_REJECTION']; ?></h4>
			<div class="tools">
				<a href="javascript:;" class="collapse"></a>
				
			</div>
		</div>
		<div class="portlet-body" >
            <!--BEGIN TABS-->
           <div class="tabbable tabbable-custom">
               <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab_1_1" data-toggle="tab">Specimen Rejection Phases</a></li>
                                    <li><a href="#tab_1_2" data-toggle="tab">Specimen Rejection Reasons</a></li>
                                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1_1">
                    	<p style="text-align: right;"><a rel='facebox' href='#TestCategory_tc'>Page Help</a></p>
						<a href='javascript:add_phase();' class="btn blue-stripe" title='Click to Add a New Drug'><i class='icon-plus'></i> <?php echo LangUtil::$generalTerms['ADDNEW']; ?></a>
						<br><br>
						<div id='pdel_msg' class='clean-orange' style='display:none;'>
							<?php echo LangUtil::$generalTerms['MSG_DELETED']; ?>&nbsp;&nbsp;<a href="javascript:toggle('pdel_msg');"><?php echo LangUtil::$generalTerms['CMD_HIDE']; ?></a>
						</div>
						<?php $page_elems->getRejectionPhaseTable($_SESSION['lab_config_id']); ?>                    
                    </div>
                    <div class="tab-pane" id="tab_1_2">
                        <p style="text-align: right;"><a rel='facebox' href='#TestCategory_tc'>Page Help</a></p>
						<a href='javascript:add_reason();' class="btn blue-stripe" title='Click to Add a New Drug'><i class='icon-plus'></i> <?php echo LangUtil::$generalTerms['ADDNEW']; ?></a>
						<br><br>
						<div id='rdel_msg' class='clean-orange' style='display:none;'>
							<?php echo LangUtil::$generalTerms['MSG_DELETED']; ?>&nbsp;&nbsp;<a href="javascript:toggle('rdel_msg');"><?php echo LangUtil::$generalTerms['CMD_HIDE']; ?></a>
						</div>
						<?php $page_elems->getRejectionReasonTable($_SESSION['lab_config_id']); ?>              
                    </div>
           		</div>
 			</div>                                
           <!--END TABS-->
        </div>
	</div>
	</div>
	<!--End Specimen Rejection Div-->
<!--Organisms Div-->
	<div id='organism_types_div' class='content_div'>
    <div class="portlet box green">
		<div class="portlet-title">
			<h4><i class="icon-reorder"></i><?php echo LangUtil::$generalTerms['ORGANISMS']; ?></h4>
				<div class="tools">
				<a href="javascript:;" class="collapse"></a>
				
			</div>
		</div>
		<div class="portlet-body">
		<p style="text-align: right;"><a rel='facebox' href='#Organism_tc'>Page Help</a></p>
		<a href='javascript:add_organism();' class="btn blue-stripe" title='Click to Add a New Organism'><i class='icon-plus'></i> <?php echo LangUtil::$generalTerms['ADDNEW']; ?></a>
		<br><br>
		<div id='odel_msg' class='clean-orange' style='display:none;'>
			<?php echo LangUtil::$generalTerms['MSG_DELETED']; ?>&nbsp;&nbsp;<a href="javascript:toggle('odel_msg');"><?php echo LangUtil::$generalTerms['CMD_HIDE']; ?></a>
		</div>
		<?php $page_elems->getOrganismsTable($_SESSION['lab_config_id']); ?>
		</div>
	</div>
	</div>
	<!--End Organisms Div-->
    
    <div id='test_categories_div' class='content_div'>
    <div class="portlet box green">
		<div class="portlet-title">
			<h4><i class="icon-reorder"></i><?php echo "Lab Sections"; ?></h4>
			<div class="tools">
				<a href="javascript:;" class="collapse"></a>
				
			</div>
		</div>
		<div class="portlet-body">
		<p style="text-align: right;"><a rel='facebox' href='#TestCategory_tc'>Page Help</a></p>
		<a href='javascript:add_section();' class="btn blue-stripe" title='Add New Test Category'><i class='icon-plus'></i> <?php echo LangUtil::$generalTerms['ADDNEW']; ?></a>
		<br><br>
		<div id='sdel_msg' class='clean-orange' style='display:none;'>
			<?php echo LangUtil::$generalTerms['MSG_DELETED']; ?>&nbsp;&nbsp;<a href="javascript:toggle('tcdel_msg');"><?php echo LangUtil::$generalTerms['CMD_HIDE']; ?></a>
		</div>
		<?php $page_elems->getTestCategoryTable($_SESSION['lab_config_id']); ?>
		</div>
	</div>
	</div>
    
       
	<div id='TestType_tc' class='right_pane' style='display:none;margin-left:10px;'>
		<ul>
			<li><?php echo LangUtil::$pageTerms['TIPS_TC_TESTTYPE_1']; ?></li>
			<li><?php echo LangUtil::$pageTerms['TIPS_TC_TESTTYPE_2']; ?></li>
			<li><?php echo LangUtil::$pageTerms['TIPS_TC_TESTTYPE_3']; ?></li>
		</ul>
	</div>
		
	<div id='SpecimenType_tc' class='right_pane' style='display:none;margin-left:10px;'>
		<ul>
			<li><?php echo LangUtil::$pageTerms['TIPS_TC_SPECIMENTYPE_1']; ?></li>
			<li><?php echo LangUtil::$pageTerms['TIPS_TC_SPECIMENTYPE_2']; ?></li>
			<li><?php echo LangUtil::$pageTerms['TIPS_TC_SPECIMENTYPE_3']; ?></li>
		</ul>
	</div>

	<div id='DrugType_tc' class='right_pane' style='display:none;margin-left:10px;'>
		<ul>
			<li><?php echo LangUtil::$pageTerms['TIPS_TC_DRUGTYPE_1']; ?></li>
			<li><?php echo LangUtil::$pageTerms['TIPS_TC_DRUGTYPE_2']; ?></li>
			<li><?php echo LangUtil::$pageTerms['TIPS_TC_DRUGTYPE_3']; ?></li>
		</ul>
	</div>
    
    <div id='TestCategory_tc' class='right_pane' style='display:none;margin-left:10px;'>
		<ul>
			<li><?php echo LangUtil::$pageTerms['TIPS_TC_TESTCATEGORY_1']; ?></li>
			<li><?php echo LangUtil::$pageTerms['TIPS_TC_TESTCATEGORY_2']; ?></li>
			<li><?php echo LangUtil::$pageTerms['TIPS_TC_TESTCATEGORY_3']; ?></li>
		</ul>
	</div>
	
	<?php
	if(is_super_admin($user) || is_country_dir($user))
	{
	?>
		<div id='remove_data_div' class='content_div'>
			<b><?php echo LangUtil::$pageTerms['MENU_REMOVEDATA']; ?></b> |
			<a href='javascript:hide_right_pane()'><?php echo LangUtil::$generalTerms['CMD_CANCEL']; ?></a>
			<br><br>
			<?php
			$message = LangUtil::$pageTerms['TIPS_REMOVEDATA'];
			$ok_function = "delete_catalog_data();";
			$cancel_function = "hide_right_pane();";
			$page_elems->getConfirmDialog($dialog_id, $message, $ok_function, $cancel_function);
			?>
			<span id='remove_data_progress' style='display:none;'>
				<br>
				&nbsp;<?php $page_elems->getProgressSpinner(" ".LangUtil::$generalTerms['CMD_SUBMITTING']); ?>
			</span>
		</div>
	<?php
	}
	?>

</div>
</div>
<div class='modal container hide fade' id='form' role="dialog" data-backdrop="static">
	
</div>
<!-- END ROW-FLUID-->  
<?php include("includes/scripts.php");
require_once("includes/script_elems.php");
$script_elems = new ScriptElems();
$script_elems->enableDatePicker();
?>
<script type='text/javascript'>
$(document).ready(function(){
	$('.content_div').hide();
	$('#test_types_div').hide();
	$('#specimen_types_div').hide();
	$('#test_categories_div').show();
	$('#specimen_rejection_div').hide();
	<?php
	if(isset($_REQUEST['show_t']))
	{
		?>
		load_right_pane('test_types_div');
		<?php
	}
	else if(isset($_REQUEST['show_s']))
	{
		?>
		load_right_pane('specimen_types_div');
		<?php
	}
	else if(isset($_REQUEST['show_d']))
	{
		?>
		load_right_pane('drug_types_div');
		<?php
	}
	else if(isset($_REQUEST['show_o']))
	{
		?>
		load_right_pane('organism_types_div');
		<?php
	}
	else if(isset($_REQUEST['show_tc']))
	{
		?>
		load_right_pane('test_categories_div');
		<?php
	}
	else if(isset($_REQUEST['show_rp']))
	{
		?>
		load_right_pane('specimen_rejection_div');
		<?php
	}
	else if(isset($_REQUEST['show_rr']))
	{
		?>
		load_right_pane('specimen_rejection_div');
		<?php
	}
	else if(isset($_REQUEST['tdel']))
	{
		?>
		$('#tdel_msg').show();
		load_right_pane('test_types_div');
		<?php
	}
	else if(isset($_REQUEST['dtdel']))
	{
		?>
		$('#dtdel_msg').show();
		load_right_pane('drug_types_div');
		<?php
	}
	else if(isset($_REQUEST['odel']))
	{
		?>
		$('#odel_msg').show();
		load_right_pane('organism_types_div');
		<?php
	}
	else if(isset($_REQUEST['sdel']))
	{
		?>
		$('#sdel_msg').show();
		load_right_pane('specimen_types_div');
		<?php
	}
	else if(isset($_REQUEST['tcdel']))
	{
		?>
		$('#sdel_msg').show();
		load_right_pane('test_categories_div');
		<?php
	}
	else if(isset($_REQUEST['pdel']))
	{
		?>
		$('#pdel_msg').show();
		load_right_pane('specimen_rejection_div');
		<?php
	}
	else if(isset($_REQUEST['rdel']))
	{
		?>
		$('#rdel_msg').show();
		load_right_pane('specimen_rejection_div');
		<?php
	}
	else if (isset($_REQUEST['rm']))
	{
		?>
		$('#rm_msg').show();
		<?php
	}
	?>
});

function load_right_pane(div_id)
{
	$('#rm_msg').hide();
	$('div.content_div').hide();
	$('#'+div_id).show();
	$('.menu_option').removeClass('current_menu_option');
	$('#'+div_id+'_menu').addClass('current_menu_option');
}

function hide_right_pane()
{
	$('div.content_div').hide();
	$('.menu_option').removeClass('current_menu_option');
}

function delete_catalog_data()
{
	$('#remove_data_progress').show();
	var url_string = "ajax/catalog_deletedata.php";
	$.ajax({
		url: url_string, 
		success: function () {
			$('#remove_data_progress').hide();
			window.location='catalog.php?rm';
		}
	});
}
function add_section(){
	var el = jQuery('.portlet .tools a.reload').parents(".portlet");
	App.blockUI(el);
	
	var url = 'catalog/test_category_new.php';
	$('#form').html("");
	var target_div = "form";
	$("#"+ target_div).load(url, 
		{lab_config: "" }, 
		function() 
		{
			$('#'+target_div).modal('show');
			App.unblockUI(el);
		}
	);
	
}

function add_drug(){
	var el = jQuery('.portlet .tools a.reload').parents(".portlet");
	App.blockUI(el);
	
	var url = 'catalog/drug_type_new.php';
	$('#form').html("");
	var target_div = "form";
	$("#"+ target_div).load(url, 
		{lab_config: "" }, 
		function() 
		{
			$('#'+target_div).modal('show');
			App.unblockUI(el);
		}
	);
	
}

function add_organism(){
	var el = jQuery('.portlet .tools a.reload').parents(".portlet");
	App.blockUI(el);
	
	var url = 'catalog/organism_new.php';
	$('#form').html("");
	var target_div = "form";
	$("#"+ target_div).load(url, 
		{lab_config: "" }, 
		function() 
		{
			$('#'+target_div).modal('show');
			App.unblockUI(el);
		}
	);
	
}

function add_phase(){
	var el = jQuery('.portlet .tools a.reload').parents(".portlet");
	App.blockUI(el);
	
	var url = 'catalog/rejection_phase_new.php';
	$('#form').html("");
	var target_div = "form";
	$("#"+ target_div).load(url, 
		{lab_config: "" }, 
		function() 
		{
			$('#'+target_div).modal('show');
			App.unblockUI(el);
		}
	);
	
}

function add_reason(){
	var el = jQuery('.portlet .tools a.reload').parents(".portlet");
	App.blockUI(el);
	
	var url = 'catalog/rejection_reason_new.php';
	$('#form').html("");
	var target_div = "form";
	$("#"+ target_div).load(url, 
		{lab_config: "" }, 
		function() 
		{
			$('#'+target_div).modal('show');
			App.unblockUI(el);
		}
	);
	
}

function delete_test_category(tc_id){
	var confirmed = confirm('This action is irreversible. \nAre you sure you would you like to proceed?');
	if(confirmed) {
		var url_string = "ajax/test_category_delete.php";
		$.ajax({
			url: 'ajax/test_category_delete.php',
			data: { id: tc_id }
			})
			.done(function () {
				alert('The Test Category was successfully deleted.');
				window.location='catalog.php?rm';
			});
	}
}

function disable_rejection_phase(phase_id)
{

		var el = jQuery('.portlet .tools a.reload').parents(".portlet");
		App.blockUI(el);
		
  		var url = 'rejection_phase_delete.php';
  		$.post(url, 
		{rp: phase_id}, 
		function(result) 
		{
			$('#state_'+phase_id).removeClass('btn red mini');
			$('#action_'+phase_id).removeClass('btn mini green-stripe');
			$('#status_'+phase_id).removeClass('label label-sm label-success');
			$('#status_'+phase_id).addClass('label label-sm label');
			$('#status_'+phase_id).html('Disabled');
			$('#state_'+phase_id).html(''+
					'<a href="javascript:enable_rejection_phase('+phase_id+');"'+ 
					'title="Click to enable this Specimen rejection phase" class="btn green mini">'+
					'<i class="icon-ok"></i> Enable</a>');
			$('#action_'+phase_id).html(''+
					'<a href="#"'+ 
					'title="Click to Edit Rejection Phase Info" class="btn mini green-stripe" disabled>'+
					'<i class="icon-pencil"></i> <?php echo LangUtil::$generalTerms['CMD_EDIT']; ?> </a>');
			App.unblockUI(el);
		}
	);
}

function enable_rejection_phase(phase_id)
{

		var el = jQuery('.portlet .tools a.reload').parents(".portlet");
		App.blockUI(el);
		
  		var url = 'ajax/rejection_phase_enable.php';
  		$.post(url, 
		{rp: phase_id}, 
		function(result) 
		{
			$('#state_'+phase_id).removeClass('btn green mini');
			$('#action_'+phase_id).removeClass('btn mini green-stripe');
			$('#status_'+phase_id).removeClass('label label-sm label');
			$('#status_'+phase_id).addClass('label label-sm label-success');
			$('#status_'+phase_id).html('Enabled');
			$('#state_'+phase_id).html(''+
					'<a href="javascript:disable_rejection_phase('+phase_id+');"'+ 
					'title="Click to disable this Specimen rejection phase" class="btn red mini">'+
					'<i class="icon-remove"></i> Disable</a>');
			$('#action_'+phase_id).html(''+
					'<a href="rejection_phase_edit.php?rp='+phase_id+'"'+ 
					'title="Click to Edit Rejection Phase Info" class="btn mini green-stripe">'+
					'<i class="icon-pencil"></i> <?php echo LangUtil::$generalTerms['CMD_EDIT']; ?> </a>');
			App.unblockUI(el);
		}
	);
}

function disable_rejection_reason(reason_id)
{

		var el = jQuery('.portlet .tools a.reload').parents(".portlet");
		App.blockUI(el);
		
  		var url = 'rejection_reason_delete.php';
  		$.post(url, 
		{rr: reason_id}, 
		function(result) 
		{
			$('#state_'+reason_id).removeClass('btn red mini');
			$('#action_'+reason_id).removeClass('btn mini green-stripe');
			$('#status_'+reason_id).removeClass('label label-sm label-success');
			$('#status_'+reason_id).addClass('label label-sm label');
			$('#status_'+reason_id).html('Disabled');
			$('#state_'+reason_id).html(''+
					'<a href="javascript:enable_rejection_reason('+reason_id+');"'+ 
					'title="Click to enable this Specimen rejection Reason" class="btn green mini">'+
					'<i class="icon-ok"></i> Enable</a>');
			$('#action_'+reason_id).html(''+
					'<a href="#"'+ 
					'title="Click to Edit Rejection Reason Info" class="btn mini green-stripe" disabled>'+
					'<i class="icon-pencil"></i> <?php echo LangUtil::$generalTerms['CMD_EDIT']; ?> </a>');
			App.unblockUI(el);
		}
	);
}

function enable_rejection_reason(reason_id)
{

		var el = jQuery('.portlet .tools a.reload').parents(".portlet");
		App.blockUI(el);
		
  		var url = 'ajax/rejection_reason_enable.php';
  		$.post(url, 
		{rr: reason_id}, 
		function(result) 
		{
			$('#state_'+reason_id).removeClass('btn green mini');
			$('#action_'+reason_id).removeClass('btn mini green-stripe');
			$('#status_'+reason_id).removeClass('label label-sm label');
			$('#status_'+reason_id).addClass('label label-sm label-success');
			$('#status_'+reason_id).html('Enabled');
			$('#state_'+reason_id).html(''+
					'<a href="javascript:disable_rejection_reason('+reason_id+');"'+ 
					'title="Click to disable this Specimen rejection Reason" class="btn red mini">'+
					'<i class="icon-remove"></i> Disable</a>');
			$('#action_'+reason_id).html(''+
					'<a href="rejection_reason_edit.php?rp='+reason_id+'"'+ 
					'title="Click to Edit Rejection Reason Info" class="btn mini green-stripe">'+
					'<i class="icon-pencil"></i> <?php echo LangUtil::$generalTerms['CMD_EDIT']; ?> </a>');
			App.unblockUI(el);
		}
	);
}

//Functions to disable/enable drug types
function disable_drug_type(drug_id)
{

		var el = jQuery('.portlet .tools a.reload').parents(".portlet");
		App.blockUI(el);
		
  		var url = 'drug_type_delete.php';
  		$.post(url, 
		{did: drug_id}, 
		function(result) 
		{
			$('#state_'+drug_id).removeClass('btn red mini');
			$('#action_'+drug_id).removeClass('btn mini green-stripe');
			$('#status_'+drug_id).removeClass('label label-sm label-success');
			$('#status_'+drug_id).addClass('label label-sm label');
			$('#status_'+drug_id).html('Disabled');
			$('#state_'+drug_id).html(''+
					'<a href="javascript:enable_drug_type('+drug_id+');"'+ 
					'title="Click to enable this Drug" class="btn green mini">'+
					'<i class="icon-ok"></i> Enable</a>');
			$('#action_'+drug_id).html(''+
					'<a href="#"'+ 
					'title="Click to Edit Drug Info" class="btn mini green-stripe" disabled>'+
					'<i class="icon-pencil"></i> <?php echo LangUtil::$generalTerms['CMD_EDIT']; ?> </a>');
			App.unblockUI(el);
		}
	);
}

function enable_drug_type(drug_id)
{

		var el = jQuery('.portlet .tools a.reload').parents(".portlet");
		App.blockUI(el);
		
  		var url = 'ajax/drug_type_enable.php';
  		$.post(url, 
		{did: drug_id}, 
		function(result) 
		{
			$('#state_'+drug_id).removeClass('btn green mini');
			$('#action_'+drug_id).removeClass('btn mini green-stripe');
			$('#status_'+drug_id).removeClass('label label-sm label');
			$('#status_'+drug_id).addClass('label label-sm label-success');
			$('#status_'+drug_id).html('Enabled');
			$('#state_'+drug_id).html(''+
					'<a href="javascript:disable_drug_type('+drug_id+');"'+ 
					'title="Click to disable this Drug" class="btn red mini">'+
					'<i class="icon-remove"></i> Disable</a>');
			$('#action_'+drug_id).html(''+
					'<a href="drug_type_edit.php?did='+drug_id+'"'+ 
					'title="Click to Edit Drug Info" class="btn mini green-stripe">'+
					'<i class="icon-pencil"></i> <?php echo LangUtil::$generalTerms['CMD_EDIT']; ?> </a>');
			App.unblockUI(el);
		}
	);
}
//Functions to disable/enable organisms
function disable_organism(organism_id)
{

		var el = jQuery('.portlet .tools a.reload').parents(".portlet");
		App.blockUI(el);
		
  		var url = 'organism_delete.php';
  		$.post(url, 
		{oid: organism_id}, 
		function(result) 
		{
			$('#state_'+organism_id).removeClass('btn red mini');
			$('#action_'+organism_id).removeClass('btn mini green-stripe');
			$('#status_'+organism_id).removeClass('label label-sm label-success');
			$('#status_'+organism_id).addClass('label label-sm label');
			$('#status_'+organism_id).html('Disabled');
			$('#state_'+organism_id).html(''+
					'<a href="javascript:enable_organism('+organism_id+');"'+ 
					'title="Click to enable this Organism" class="btn green mini">'+
					'<i class="icon-ok"></i> Enable</a>');
			$('#action_'+organism_id).html(''+
					'<a href="#"'+ 
					'title="Click to Edit Organism Info" class="btn mini green-stripe" disabled>'+
					'<i class="icon-pencil"></i> <?php echo LangUtil::$generalTerms['CMD_EDIT']; ?> </a>');
			App.unblockUI(el);
		}
	);
}

function enable_organism(organism_id)
{

		var el = jQuery('.portlet .tools a.reload').parents(".portlet");
		App.blockUI(el);
		
  		var url = 'ajax/organism_enable.php';
  		$.post(url, 
		{oid: organism_id}, 
		function(result) 
		{
			$('#state_'+organism_id).removeClass('btn green mini');
			$('#action_'+organism_id).removeClass('btn mini green-stripe');
			$('#status_'+organism_id).removeClass('label label-sm label');
			$('#status_'+organism_id).addClass('label label-sm label-success');
			$('#status_'+organism_id).html('Enabled');
			$('#state_'+organism_id).html(''+
					'<a href="javascript:disable_organism('+organism_id+');"'+ 
					'title="Click to disable this Organism" class="btn red mini">'+
					'<i class="icon-remove"></i> Disable</a>');
			$('#action_'+organism_id).html(''+
					'<a href="organism_edit.php?oid='+organism_id+'"'+ 
					'title="Click to Edit Organism Info" class="btn mini green-stripe">'+
					'<i class="icon-pencil"></i> <?php echo LangUtil::$generalTerms['CMD_EDIT']; ?> </a>');
			App.unblockUI(el);
		}
	);
}

</script>
<?php include("includes/footer.php"); ?>