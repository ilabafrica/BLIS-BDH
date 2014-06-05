<?php
#
# Main page for listing all options for a lab configuration
# Used by the Lab Admin periodically to change settings
#

include("redirect.php");
include("includes/new_image.php");
include("includes/header.php");
include("includes/random.php");
include("includes/libdata.php");
include("includes/stats_lib.php");
LangUtil::setPageId("lab_config_home");

$imported_users = null
?>


<div id='Summary_config' class='right_pane' style='display:none;margin-left:10px;'>
	<ul>
	<?php 
	if(LangUtil::$pageTerms['TIPS_SUMMARY_1'] != '-') {
		echo "<li>";
		echo LangUtil::$pageTerms['TIPS_SUMMARY_1'];
		echo "</li>";
	}	
	if(LangUtil::$pageTerms['TIPS_SUMMARY_2']!="-") {
		echo "<li>"; 
		echo LangUtil::$pageTerms['TIPS_SUMMARY_2'];
		echo "</li>";
	}
	if(LangUtil::$pageTerms['TIPS_SUMMARY_3']!="-") {
		echo "<li>"; 
		echo LangUtil::$pageTerms['TIPS_SUMMARY_3'];
		echo "</li>"; 
	}	
	?>	
	</ul>	
</div>

<div id='Tests_config' class='right_pane' style='display:none;margin-left:10px;'>
	<h2><u><?php echo LangUtil::$pageTerms['MENU_LABCONFIG']; ?></u></h2>
	<h3><?php echo LangUtil::$pageTerms['MENU_TESTS']; ?></h3>
	<p>This has the following options:</p>
	<ul>
		<?php
		if(LangUtil::$pageTerms['TIPS_SPECIMENTESTTYPES']!="-") {
			echo "<li>";
			echo LangUtil::$pageTerms['TIPS_SPECIMENTESTTYPES'];
			echo "</li>";
		}	
		if(LangUtil::$pageTerms['TIPS_TARGETTAT']!="-") {
			echo "<li>"; 
			echo LangUtil::$pageTerms['TIPS_TARGETTAT'];
			echo "</li>";
		}
		if(LangUtil::$pageTerms['TIPS_RESULTINTERPRETATION']!="-") {
			echo "<li>"; 
			echo LangUtil::$pageTerms['TIPS_RESULTINTERPRETATION'];
			echo "</li>"; 
		}
		?>
	</ul>
</div>

<div id='Billing_config' class='right_pane' style='display:none;margin-left:10px;'>
    <u>This has the following options</u>
    <ul>
        <li>Enable Billing: Toggles whether or not your lab uses the billing engine.</li>
        <li>Currency Name: Denotes what name will be used when printing monetary amounts in the billing engine.</li>
        <li>Currency Delimiter: Denotes what is used to separate 'dollars' from 
            'cents' when printing monetary amounts in the billing engine.  For example, the '.' in 10.50</li>
    </ul>
</div>

<div id='IR_rc' class='right_pane' style='display:none;margin-left:10px;'>
	<ul>
			<li><?php echo LangUtil::$pageTerms['TIPS_INFECTIONREPORT']; ?></li>
		</ul>
	</div>	
	
	<div id='DRS_rc' class='right_pane' style='display:none;margin-left:10px;'>
	<ul>
			<li><?php echo LangUtil::$pageTerms['TIPS_DAILYREPORTSETTINGS']; ?></li>
		</ul>
	</div>
	
	<div id='WS_rc' class='right_pane' style='display:none;margin-left:10px;'>
		<ul>
			<li><?php echo LangUtil::$pageTerms['TIPS_WORKSHEETS']; ?></li>
		</ul>
	</div>
	
	<div id='UserAccounts_config' class='right_pane' style='display:none;margin-left:10px;'>
	<ul>	
		<?php
		if(LangUtil::$pageTerms['TIPS_USERACCOUNTS_1']!="-") {
			echo "<li>";
			echo LangUtil::$pageTerms['TIPS_USERACCOUNTS_1'];
			echo "</li>";
		}	
		if(LangUtil::$pageTerms['TIPS_USERACCOUNTS_2']!="-") {
			echo "<li>"; 
			echo LangUtil::$pageTerms['TIPS_USERACCOUNTS_2'];
			echo "</li>";
		}
		if(LangUtil::$pageTerms['TIPS_USERACCOUNTS_3']!="-") {
			echo "<li>"; 
			echo LangUtil::$pageTerms['TIPS_USERACCOUNTS_3'];
			echo "</li>"; 
		}
		?>
	</ul>
	</div>
	
	<div id='RegistrationFields_config' class='right_pane' style='display:none;margin-left:10px;'>
	<ul>	
		<?php
		if(LangUtil::$pageTerms['TIPS_REGISTRATIONFIELDS_1']!="-") {
			echo "<li>";
			echo LangUtil::$pageTerms['TIPS_REGISTRATIONFIELDS_1'];
			echo "</li>";
		}	
		if(LangUtil::$pageTerms['TIPS_REGISTRATIONFIELDS_2']!="-") {
			echo "<li>"; 
			echo LangUtil::$pageTerms['TIPS_REGISTRATIONFIELDS_2'];
			echo "</li>";
		}
		if(LangUtil::$pageTerms['TIPS_REGISTRATIONFIELDS_3']!="-") {
			echo "<li>"; 
			echo LangUtil::$pageTerms['TIPS_REGISTRATIONFIELDS_3'];
			echo "</li>"; 
		}
		?>
	</ul>
	</div>

        <!--NC3065-->
        
        <div id='search_config' class='right_pane' style='display:none;margin-left:10px;'>
	<ul>	
		<?php
		
			echo "<li>";
			echo " Toggle Patient Number or Patient's Age to be displayed as part of Search Results";
			echo "</li>";
                        echo "<li>";
			echo " Choosing to display Patient Number and/or Patient's Age as part of Search results slows down the time taken to search ";
			echo "</li>";
                        
                        
		
		?>
	</ul>
	</div>
        
        <div id='barcode_config' class='right_pane' style='display:none;margin-left:10px;'>
	<ul>	
		<?php
		
			echo "<li>";
			echo " Configure your settings for barcode formats";
			echo "</li>";
                        echo "<li>";
			echo " Width and Height are the dimensions of the bars ";
			echo "</li>";
                        echo "<li>";
			echo " Text size os the for the code printed underneath the barcodes";
			echo "</li>";
                       
                        
                        
		
		?>
	</ul>
	</div>
        
        <!---NC3065-->
	
	<div id='SetupNet' class='right_pane' style='display:none;margin-left:10px;'>
	<ul>
			<li><?php echo LangUtil::$pageTerms['TIPS_SETUPNETWORK_3']; ?></li>
	</ul><br>
			<i><?php echo LangUtil::$pageTerms['TIPS_SETUPNETWORK_4']; ?></i>
	</div>
	
	<div id='Revert' class='right_pane' style='display:none;margin-left:10px;'>
	<ul>
		<li><?php echo LangUtil::$pageTerms['TIPS_REVERT']; ?></li>
	</ul>
	</div>

<div id='new_help' style='display:none'>
<small>
<u>Add New</u> lets you add new registration fields as required for the lab.
</small>
</div>

<?php
$lab_config_id = $_REQUEST['id'];
$user = get_user_by_id($_SESSION['user_id']);
if ( !((is_country_dir($user)) || (is_super_admin($user)) ) ) {
	$saved_db = DbUtil::switchToGlobal();
	$query = "SELECT lab_config_id FROM lab_config WHERE admin_user_id = ".$_SESSION['user_id'];
	$record = query_associative_one($query);
	$labId = $record['lab_config_id'];
	if($labId != $lab_config_id) {
		echo "You are not authorized to access the configuration";
		include("includes/footer.php");
		die();
	}
	DbUtil::switchRestore($saved_db);
}

$lab_config = LabConfig::getById($lab_config_id);
if($lab_config == null)
{
	?>
	<br><br>
	<div class='sidetip_nopos'>
	<?php echo LangUtil::$generalTerms['MSG_NOTFOUND']; ?>
	</div>
	<?php
	include("includes/footer.php");
	return;
}
?>
<!-- BEGIN PAGE TITLE & BREADCRUMB-->       
                        <h3></h3>
                        <ul class="breadcrumb">
                            <li><a href="#"><i class='icon-wrench'></i> Lab Configuration</a>
                            <span class="icon-angle-right"></span></li>
                            <li><a href="#"></a></li>
                        </ul>
                        <!-- END PAGE TITLE & BREADCRUMB-->
                    </div>
                </div>
                <!-- END PAGE HEADER-->
<!-- BEGIN ROW-FLUID-->  

    <div class="portlet box green right_pane" id="search_div" style="display: none">
        <div class="portlet-title" >
                                <h4><i class="icon-reorder"></i>Configure Fields for search results</h4>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse"></a>
                                    <a data-toggle="modal" class="config"></a>
                                </div>
        </div>
        <div class="portlet-body">

            <div id='search' style='margin-left:10px;'>
                    <p style="text-align: right;"><a rel='facebox' href='#search_config'>Page Help</a></p>
                        <div id='searchfield_msg' class='clean-orange' style='display:none;width:350px;'>
                        </div>
                        <form id='searchfields_form' name='searchfields_form' action='ajax/search_config_update.php' method='post'>
                        <input type='hidden' name='lab_config_id' value='<?php echo $lab_config->id; ?>'></input>                   
                            <?php $page_elems->getSearchFieldsCheckboxes($lab_config->id); ?>
                        <br><br>
                        <input type='button' class="btn green" value='<?php echo LangUtil::$generalTerms['CMD_SUBMIT']; ?>' onclick='submit_searchconfig()'>
                        </input>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <!--span id='st_types_progress' style='display:none;'-->
                                            <span id='searchfields_progress' style='display:none;'>
    
                            <?php $page_elems->getProgressSpinner(LangUtil::$generalTerms['CMD_SUBMITTING']); ?>
                        </span>
                        </form>
            </div>
        </div>
       </div>

       <div class="portlet box green right_pane" id="abbreviations_div" style="display: none">
        <div class="portlet-title" >
                                <h4><i class="icon-reorder"></i>Abbreviations</h4>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse"></a>
                                    <a data-toggle="modal" class="config"></a>
                                </div>
        </div>
        <div class="portlet-body">
            <div id='abbreviation' style='margin-left:10px;'>
                        
                        <p style="text-align: right;"><a rel='facebox' href='#search_config'>Page Help</a></p>
                        <h4>List of abbreviations and their full words</h4>
                        <a href="javascript:void(0)" id="addNewAbbrevRow" class="btn blue-stripe" onclick="addAbbreviationRow()">Add new abbreviation</a>
                        <p></p>

                        <table id="abbrev_table" class="table table-striped table-bordered table-hover" style="width:600px">
                        <thead>
                            <th> Abbreviation </th>
                            <th> Full word </th>
                            <th> Edit </th>
                            <th> Delete </th>
                        </thead>
                        <tbody id="tbody">
                        <?php 
                        $abbwords = Abbreviations::getAllAbbreviations();
                        foreach ($abbwords as $abbword) { ?>
                        <tr id="row_<?php echo $abbword->id ?>">
                            <td id="abb_<?php echo $abbword->id ?>"><?php echo $abbword->abbreviation ?></td>
                            <td id="word_<?php echo $abbword->id ?>"><?php echo $abbword->word ?></td>
                            <td><a class="btn mini" href="javascript:void(0)" id="edit_<?php echo $abbword->id ?>" onclick="makeRowEditable(<?php echo $abbword->id .", '". $abbword->abbreviation ."', '". $abbword->word ."'"?> )">Edit</a></td>
                            <td id="deleteCell_<?php echo $abbword->id ?>"><a href="javascript:void(0)" id="delete_<?php echo $abbword->id ?>" onclick="confirm(<?php echo $abbword->id ?>)" class="btn mini">Delete</a></td>
                        </tr>
                        <?php } ?>
                        <tbody>
                        </table>
                        
                            
            </div>
        </div>
       </div>


<div class="portlet box green right_pane" id="verify_div" style="display: none">
        <div class="portlet-title" >
                                <h4><i class="icon-reorder"></i>Force verification</h4>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse"></a>
                                    <a data-toggle="modal" class="config"></a>
                                </div>
        </div>
        <div class="portlet-body">
            <div id='verify' style='margin-left:10px;'>
                        
                        <p style="text-align: right;"><a rel='facebox' href='#search_config'>Page Help</a></p>
                        <h4>This setting allows you to send results ONLY after verification</h4>
                        </br>
                        <p></p>
                        <?php
                            $lab_config_id = get_lab_config_id_global_admin($_SESSION['user_id']);
                            $lab_config = get_lab_config_by_id($lab_config_id);
                        ?>
                        <form action="ajax/force_verify.php" method="post" name="forcev" id="forceverify">
                        <table id="verify_table" class="table table-striped table-bordered table-hover" style="width:600px">
                            <tr>
                                <td>Enable </td> 
                                <td><input type="checkbox" id="chkbx" name="enabled" <?php if($lab_config->forceVerify == 1){ echo 'checked="checked"'; }  ?>/></td>
                            </tr>
                            <tr>
                                <td>Start time  </td> 
                                <td>
                                    <div class="input-append bootstrap-timepicker-component">
                                    <input class="m-wrap m-ctrl-small timepicker-24" name="start_time" type="text" value='' id="startt"/>
                                    <span class="add-on"><i class="icon-time"></i></span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>End time </td> 
                                <td>
                                    <div class="input-append bootstrap-timepicker-component">
                                    <input class="m-wrap m-ctrl-small timepicker-24" name="end_time" type="text" value='' id='endt' />
                                    <span class="add-on"><i class="icon-time"></i></span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Verify on Weekends </td> 
                                <td>
                                Yes  <input type="radio" id="yesv" name="weekend" value="Yes" <?php if($lab_config->verifyOnWeekends == 1) {echo 'checked="checked"';} ?> > <br>
                                 No <input type="radio" id="nov" name="weekend" value="No"  <?php if($lab_config->verifyOnWeekends == 0) {echo 'checked="checked"';} ?> >
                                </td>
                            </tr>
                            <tr>
                            <td></td>
                            <td><input type="button" id="sendback" class="btn" onclick="submit_forcevalidate()" value="Save" /> <span style="display:none;" id="succes">&nbsp;&nbsp; Record Updated!</span></td>
                            </tr>
                        </table>
                        </form>
                            
            </div>
    </div>
</div>       

<div class="portlet box green right_pane" id="worksheet_config_div" style="display: none">
        <div class="portlet-title" >
                                <h4><i class="icon-reorder"></i><?php echo LangUtil::$pageTerms['MENU_WORKSHEETCONFIG']; ?></h4>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse"></a>
                                    <a data-toggle="modal" class="config"></a>
                                </div>
        </div>
        <div class="portlet-body">
            <div id='worksheet_config' style='margin-left:10px;'>
                <p style="text-align: right;"><a rel='facebox' href='#WS_rc'>Page Help</a></p>
                    <div id='worksheet_config_msg' class='clean-orange' style='display:none;width:350px;'>
                    </div>
                    <br>
                    <form id='worksheet_config_form' name='worksheet_config_form' action='ajax/report_config_update.php' method='post'>
                        <table>
                            <tbody>
                                <tr valign='top'>
                                    <td><?php echo LangUtil::$generalTerms['LAB_SECTION']; ?></td>
                                    <td>
                                        <select name='cat_code' id='cat_code12' class='uniform_width'>
                                            <option value="0"><?php echo LangUtil::$generalTerms['ALL']; ?></option>
                                            <?php $page_elems->getTestCategorySelect(); ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr valign='top'>
                                    <td><?php echo LangUtil::$generalTerms['TEST_TYPE']; ?></td>
                                    <td>
                                        <select id='test_type12' name='t_type' class='uniform_width'>
                                            <?php $page_elems->getTestTypesSelect($lab_config->id); ?>
                                        </select>
                                    </td>
                            </tr>
                            <tr valign='top'>
                                <td></td>
                                <td>
                                    <input type='button' class="btn green" onclick='javascript:fetch_worksheet_config();' value='<?php echo LangUtil::$generalTerms['CMD_SEARCH']; ?>'></input>
                                    &nbsp;&nbsp;&nbsp;
                                    <span id='worksheet_fetch_progress' style='display:none'>
                                        <?php $page_elems->getProgressSpinner(LangUtil::$generalTerms['CMD_SEARCHING']); ?>
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </form>
                    <br>
                    <div id='worksheet_config_content'>
                    </div>
                    <br>
                    <?php echo LangUtil::$pageTerms['CUSTOM_WORKSHEETS']; ?>
                    <?php $page_elems->getCustomWorksheetTable($lab_config); ?>
                    <br>
                    <small><a href='worksheet_custom_new.php?id=<?php echo $lab_config->id; ?>'><?php echo LangUtil::$pageTerms['NEW_CUSTOMWORKSHEET']; ?> &raquo;</a></small>
                </div>
        </div>
    </div>

<div class="portlet box green right_pane" id="report_config_div" style="display: none">
        <div class="portlet-title" >
                                <h4><i class="icon-reorder"></i><?php echo LangUtil::$pageTerms['MENU_REPORTCONFIG']; ?></h4>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse"></a>
                                    <a data-toggle="modal" class="config"></a>
                                </div>
        </div>
        <div class="portlet-body">
            <div  id='report_config' style='margin-left:10px;'>
                <p style="text-align: right;"><a rel='facebox' href='#DRS_rc'>Page Help</a></p>
                    <br>
                    <div id='report_config_msg' class='clean-orange' style='display:none;width:350px;'>
                    </div>
                    <br>
                    <form id='report_config_form' name='report_config_form' action='' method='post'>
                        <?php echo LangUtil::$generalTerms['REPORT_TYPE']; ?>
                        &nbsp;&nbsp;
                        <select name='report_type' id='report_type11'>
                            <option value='1'><?php echo $LANG_ARRAY['reports']['MENU_PATIENT']; ?></option>
                            <?php
                            if($SHOW_SPECIMEN_REPORT === true)
                            {
                                ?>
                                <option value='2'><?php echo $LANG_ARRAY['reports']['MENU_SPECIMEN']; ?></option>
                                <?php
                            }
                            if($SHOW_TESTRECORD_REPORT === true)
                            {
                                ?>
                                <option value='3'><?php echo $LANG_ARRAY['reports']['MENU_TESTRECORDS']; ?></option>
                                <?php
                            }
                            if($SHOW_REJECTIONRECORD_REPORT === true)
                            {
                                ?>
                                <option value='267'><?php echo $LANG_ARRAY['reports']."Specimen Rejection"; ?></option>
                                <?php
                            }
                            ?>
                            <option value='4'><?php echo $LANG_ARRAY['reports']['MENU_DAILYLOGS']."-".LangUtil::$generalTerms['SPECIMENS']; ?></option>
                            <option value='6'><?php echo $LANG_ARRAY['reports']['MENU_DAILYLOGS']."-".LangUtil::$generalTerms['PATIENTS']; ?></option>
                            <option value='267'><?php echo $LANG_ARRAY['reports']['MENU_DAILYLOGS']."-"."Specimen Rejection"; ?></option>
                        </select>
                        &nbsp;&nbsp;
                        <input type='button' class="btn green" id='report_config_button' value="<?php echo LangUtil::$generalTerms['CMD_SEARCH']; ?>" onclick="javascript:fetch_report_config();"></input>
                        &nbsp;&nbsp;
                        <span id='report_config_fetch_progress' style='display:none;'>
                            <?php $page_elems->getProgressSpinner(LangUtil::$generalTerms['CMD_SEARCHING']); ?>
                        </span>
                        <br><br>
                        
                    </form> 
                </div>
                <div id='report_config_content'>                 
                </div>
        </div>
    </div>

<div class="portlet box green right_pane" id="grouped_count_div" style="display: none">
        <div class="portlet-title" >
                                <h4><i class="icon-reorder"></i>Test/Specimen Count/Grouped Reports</h4>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse"></a>
                                    <a data-toggle="modal" class="config"></a>
                                </div>
        </div>
        <div class="portlet-body">
            <div id='grouped_count' style='margin-left:10px;'>
                <p style="text-align: right;"><a rel='facebox' href='#IR_rc'>Page Help</a></p>
                     | <a href='javascript:toggle_grouped_count_report();' id='grouped_count_edit_link'><?php echo LangUtil::$generalTerms['CMD_EDIT']; ?></a>
                    <br>
                    <div id='grouped_count_msg' class='clean-orange' style='display:none;width:350px;'>
                    </div>
                    <br>
                    <div id='grouped_count_report_summary'>
                        <?php echo $page_elems->getGroupedCountReportSummary($lab_config); ?>
                    </div>
                    <div id='grouped_count_report_form_div' style='display:none;'>
                        <form id='grouped_count_report_form' name='grouped_count_report_form' action='ajax/grouped_count_reports_update.php' method='post'>
                            <?php $page_elems->getGroupedCountReportConfigureForm($lab_config); ?>
                        </form> 
                        
                    </div>
            </div>
        </div>
</div>

<div class="portlet box green right_pane" id="agg_report_div" style="display: none">
        <div class="portlet-title" >
                                <h4><i class="icon-reorder"></i><?php echo LangUtil::$pageTerms['MENU_INFECTION']; ?></h4>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse"></a>
                                    <a data-toggle="modal" class="config"></a>
                                </div>
        </div>
        <div class="portlet-body">
            <div id='agg_report' style='margin-left:10px;'>
                <p style="text-align: right;"><a rel='facebox' href='#IR_rc'>Page Help</a></p>
                    <a href='javascript:toggle_disease_report();' id='agg_edit_link'><?php echo LangUtil::$generalTerms['CMD_EDIT']; ?></a>
                    <br />
                    <div id='agg_msg' class='clean-orange' style='display:none;width:350px;'>
                    </div>
                    <br>
                    <div id='agg_report_summary'>
                        <?php echo $page_elems->getAggregateReportSummary($lab_config); ?>
                    </div>
                    <div id='agg_report_form_div' style='display:none;'>
                        <form id='agg_report_form' name='agg_report_form' action='ajax/report_agg_update.php' method='post'>
                            <?php $page_elems->getAggregateReportConfigureForm($lab_config); ?>
                        </form> 
                        <form id='agg_preview_form' style='display:none;' name='agg_preview_form' action='report_disease_preview.php' method='post' target='_blank'>                    
                            <?php # This form is cloned from agg_report_form in javascript:agg_preview() function ?>
                        </form>
                    </div>
                </div>
        </div>
</div>


<div class="portlet box green right_pane" id="barcode_div" style="display: none">
        <div class="portlet-title" >
                                <h4><i class="icon-reorder"></i>Configure Barcode Format Settings</h4>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse"></a>
                                    <a data-toggle="modal" class="config"></a>
                                </div>
        </div>
        
        <div class="portlet-body">
                <div id='barcode' style='margin-left:10px;'>
                <p style="text-align: right;"><a rel='facebox' href='#barcode_config'>Page Help</a></p>
                 
                    <div id='barcodefield_msg' class='clean-orange' style='display:none;width:350px;'>
                    </div>
                    <form id='barcodefields_form' name='barcodefields_form' action='ajax/update_barcode_settings.php' method='post'>
                    <input type='hidden' name='lab_config_id' value='<?php echo $lab_config->id; ?>'></input>                   
                        <?php $page_elems->getBarcodeFields($lab_config->id);
                                                //$page_elems->getSearchFieldsCheckboxes($lab_config->id); ?>
                    <br><br>
                    <input type='button' class="btn green" value='<?php echo LangUtil::$generalTerms['CMD_SUBMIT']; ?>' onclick='submit_barcodeconfig()'>
                    </input>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <!--span id='st_types_progress' style='display:none;'-->
                                        <span id='barcodefields_progress' style='display:none;'>

                        <?php $page_elems->getProgressSpinner(LangUtil::$generalTerms['CMD_SUBMITTING']); ?>
                    </span>
                    </form>
                </div>
        </div>
</div>

<!--  -div class="portlet box green right_pane" id="users_div" style="display: none">
        <div class="portlet-title" >
                                <h4><i class="icon-reorder"></i><?php echo LangUtil::$pageTerms['MENU_USERS']; ?></h4>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse"></a>
                                    <a data-toggle="modal" class="config"></a>
                                </div>
        </div>
        
        <div class="portlet-body">
                <div  style='margin-left:10px;'>
                    <?php
                    $reload_url = "lab_config_home.php?id=$lab_config_id";
                    ?>
                    <p style="text-align: right;"><a rel='facebox' href='#UserAccounts_config'>Page Help</a></p>
                   
                     <a rel='facebox' href='lab_user_new.php?ru=<?php echo $reload_url; ?>&lid=<?php echo $lab_config_id; ?>'><?php echo LangUtil::$generalTerms['CMD_ADDNEWACCOUNT']; ?></a>
                    <br><br>
                    <div id='user_acc_msg' class='clean-orange' style='display:none;width:350px;'>
                    </div>
                    <div id='user_list_table'>
                    <?php
                    $user_list = $lab_config->getUsers();
                    $page_elems->getLabUsersTable($user_list, $lab_config_id);
                    ?>
                    </div>
                </div>
        </div>
</div-->

<div class="portlet box green right_pane" id="fields_div" style="display: none">
        <div class="portlet-title" >
                                <h4><i class="icon-reorder"></i><?php echo LangUtil::$pageTerms['MENU_CUSTOM']; ?></h4>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse"></a>
                                    <a data-toggle="modal" class="config"></a>
                                </div>
        </div>
        
        <div class="portlet-body">
            <div class='config_reg_details' style='margin-left:10px;'>
                    <p style="text-align: right;"><a rel='facebox' href='#RegistrationFields_config'>Page Help</a></p>
                     <a href='javascript:toggle_ofield_div();' id='ofield_toggle_link'><?php echo LangUtil::$generalTerms['CMD_EDIT']; ?></a>
                    <br><br>
                    <div id='cfield_msg' class='clean-orange' style='display:none;width:350px;'>
                    </div>
                    <div id='ofield_summary' class='pretty_box'>
                    <?php $page_elems->getRegistrationFieldsSummary($lab_config); ?>
                    </div>
                    <div id='ofield_form_div' style='display:none;'>
                    <form id='otherfields_form' name='otherfields_form' action='ajax/ofield_update.php' method='post'>
                    <input type='hidden' value='<?php echo $_REQUEST['id']; ?>' name='lab_config_id'></input>
                    <table class='hor-minimalist-b' style='width:auto;'>
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr valign='top'>
                                <td><?php echo LangUtil::$generalTerms['PATIENTS']; ?> - <?php echo LangUtil::$generalTerms['PATIENT_ID']; ?></td>
                                <td>
                                    <input type='checkbox' name='use_pid' id='use_pid' <?php
                                    if($lab_config->pid != 0)
                                        echo " checked ";
                                    ?>>
                                    </input>
                                    <span id='use_pid_mand' style='display:none;'>
                                        &nbsp;&nbsp;
                                        <?php echo LangUtil::$generalTerms['MSG_MANDATORYFIELD']; ?>?
                                        &nbsp;&nbsp;
                                        <input type='radio' name='use_pid_radio' value='Y' <?php
                                        if($lab_config->pid == 2)
                                            echo " checked ";
                                        ?>><?php echo LangUtil::$generalTerms['YES']; ?></input>
                                        &nbsp;&nbsp;
                                        <input type='radio' name='use_pid_radio' value='N' <?php
                                        if($lab_config->pid != 2)
                                            echo " checked ";
                                        ?>><?php echo LangUtil::$generalTerms['NO']; ?></input>
                                    </span>
                                </td>
                            </tr>
                            <tr valign='top'>
                                <td><?php echo LangUtil::$generalTerms['PATIENTS']; ?> - <?php echo LangUtil::$generalTerms['ADDL_ID']; ?></td>
                                <td>
                                    <input type='checkbox' name='use_p_addl' id='use_p_addl' <?php
                                    if($lab_config->patientAddl != 0)
                                        echo " checked ";
                                    ?>>
                                    </input>
                                    <span id='use_p_addl_mand' style='display:none;'>
                                        &nbsp;&nbsp;
                                        <?php echo LangUtil::$generalTerms['MSG_MANDATORYFIELD']; ?>?
                                        &nbsp;&nbsp;
                                        <input type='radio' name='use_p_addl_radio' value='Y' <?php
                                        if($lab_config->patientAddl == 2)
                                            echo " checked ";
                                        ?>><?php echo LangUtil::$generalTerms['YES']; ?></input>
                                        &nbsp;&nbsp;
                                        <input type='radio' name='use_p_addl_radio' value='N' <?php
                                        if($lab_config->patientAddl != 2)
                                            echo " checked ";
                                        ?>><?php echo LangUtil::$generalTerms['NO']; ?></input>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo LangUtil::$generalTerms['PATIENTS']; ?> - <?php echo LangUtil::$generalTerms['PATIENT_DAILYNUM']; ?></td>
                                <td>
                                    <input type='checkbox' name='use_dnum' id='use_dnum'<?php
                                    
                                                                        if($lab_config->dailyNum == 1 || $lab_config->dailyNum == 2 || $lab_config->dailyNum == 11 || $lab_config->dailyNum == 12)
                                        echo " checked ";
                                    ?>>
                                    </input>
                                    <span id='use_dnum_mand' style='display:none;'>
                                        &nbsp;&nbsp;
                                        <?php echo LangUtil::$generalTerms['MSG_MANDATORYFIELD']; ?>?
                                        &nbsp;&nbsp;
                                        <input type='radio' name='use_dnum_radio' value='Y'<?php
                                        if($lab_config->dailyNum == 2 || $lab_config->dailyNum == 12)
                                            echo " checked ";
                                        ?>><?php echo LangUtil::$generalTerms['YES']; ?></input>
                                        &nbsp;&nbsp;
                                        <input type='radio' name='use_dnum_radio' value='N' <?php
                                        if($lab_config->dailyNum != 2 && $lab_config->dailyNum != 12)
                                            echo " checked ";
                                        ?> ><?php echo LangUtil::$generalTerms['NO']; ?></input>
                                        &nbsp;&nbsp;
                                        <?php echo LangUtil::$generalTerms['MSG_RESET']; ?>
                                        <select name='dnum_reset' id='dnum_reset'>
                                            <option value='<?php echo LabConfig::$RESET_DAILY; ?>'><?php echo LangUtil::$pageTerms['DAILY']; ?></option>
                                            <option value='<?php echo LabConfig::$RESET_WEEKLY; ?>'><?php echo LangUtil::$pageTerms['WEEKLY']; ?></option>
                                            <option value='<?php echo LabConfig::$RESET_MONTHLY; ?>'><?php echo LangUtil::$pageTerms['MONTHLY']; ?></option>
                                            <option value='<?php echo LabConfig::$RESET_YEARLY; ?>'><?php echo LangUtil::$pageTerms['YEARLY']; ?></option>
                                        </select>
                                        
                                    </span>
                                </td>
                            </tr>
                            <tr style='display:none;'>
                                <td><?php echo LangUtil::$generalTerms['PATIENTS']; ?> - <?php echo LangUtil::$generalTerms['NAME']; ?></td>
                                <td>
                                    <input type='checkbox' name='use_pname' id='use_pname'<?php
                                    if($lab_config->pname != 0)
                                        echo " checked ";
                                    ?>>
                                    </input>
                                    <span id='use_pname_mand' style='display:none;'>
                                        &nbsp;&nbsp;
                                        <?php echo LangUtil::$generalTerms['MSG_MANDATORYFIELD']; ?>?
                                        &nbsp;&nbsp;
                                        <input type='radio' name='use_pname_radio' value='Y'<?php
                                        if($lab_config->pname == 2)
                                            echo " checked ";
                                        ?>><?php echo LangUtil::$generalTerms['YES']; ?></input>
                                        &nbsp;&nbsp;
                                        <input type='radio' name='use_pname_radio' value='N' <?php
                                        if($lab_config->pname != 2)
                                            echo " checked ";
                                        ?>><?php echo LangUtil::$generalTerms['NO']; ?></input>
                                    </span>
                                </td>
                            </tr>
                            <tr style='display:none;'>
                                <td><?php echo LangUtil::$generalTerms['PATIENTS']; ?> - <?php echo LangUtil::$generalTerms['GENDER']; ?></td>
                                <td>
                                    <input type='checkbox' name='use_sex' id='use_sex' <?php
                                    if($lab_config->sex != 0)
                                        echo " checked ";
                                    ?>>
                                    </input>
                                    <span id='use_sex_mand' style='display:none;'>
                                        &nbsp;&nbsp;
                                        <?php echo LangUtil::$generalTerms['MSG_MANDATORYFIELD']; ?>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo LangUtil::$generalTerms['PATIENTS']; ?> - <?php echo LangUtil::$generalTerms['DOB']; ?></td>
                                <td>
                                    <input type='checkbox' name='use_dob' id='use_dob'<?php
                                    if($lab_config->dob != 0)
                                        echo " checked ";
                                    ?>>
                                    </input>
                                    <span id='use_dob_mand' style='display:none;'>
                                        &nbsp;&nbsp;
                                        <?php echo LangUtil::$generalTerms['MSG_MANDATORYFIELD']; ?>?
                                        &nbsp;&nbsp;
                                        <input type='radio' name='use_dob_radio' value='Y'<?php
                                        if($lab_config->dob == 2)
                                            echo " checked ";
                                        ?>><?php echo LangUtil::$generalTerms['YES']; ?></input>
                                        &nbsp;&nbsp;
                                        <input type='radio' name='use_dob_radio' value='N' <?php
                                        if($lab_config->dob != 2)
                                            echo " checked ";
                                        ?> ><?php echo LangUtil::$generalTerms['NO']; ?></input>
                                    </span>
                                </td>
                            </tr>
                            <tr style='display:none;'>
                                <td><?php echo LangUtil::$generalTerms['PATIENTS']; ?> - <?php echo LangUtil::$generalTerms['AGE']; ?></td>
                                <td>
                                    <input type='checkbox' name='use_age' id='use_age'<?php
                                                                        if($lab_config->age == 1 || $lab_config->age == 2 || $lab_config->age == 11 || $lab_config->age == 12)
                                    
                                        echo " checked ";
                                    ?>>
                                    </input>
                                    <span id='use_age_mand' style='display:none;'>
                                        &nbsp;&nbsp;
                                        <?php echo LangUtil::$generalTerms['MSG_MANDATORYFIELD']; ?>?
                                        &nbsp;&nbsp;
                                        <input type='radio' name='use_age_radio' value='Y'<?php
                                        if($lab_config->age == 2 || $lab_config->age == 12)
                                            echo " checked ";
                                        ?>><?php echo LangUtil::$generalTerms['YES']; ?></input>
                                        &nbsp;&nbsp;
                                        <input type='radio' name='use_age_radio' value='N' <?php
                                        if($lab_config->age != 2 && $lab_config->age != 12)
                                            echo " checked ";
                                        ?> ><?php echo LangUtil::$generalTerms['NO']; ?></input>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo LangUtil::$generalTerms['PATIENTS']; ?> - <?php echo 'Complete Age Display Limit'; ?></td>
                                <td>
                                    <input type='text' name='ageLimit' id='ageLimit' size='3' maxlength='3' value='<?php echo $lab_config->ageLimit; ?>'>
                                    </input>
                                    <?php echo LangUtil::$generalTerms['YEARS'] ?>
                                </td>
                            </tr>
                            <tr valign='top' style='display:none;'>
                                <td><?php echo LangUtil::$generalTerms['SPECIMENS']; ?> - <?php echo LangUtil::$generalTerms['SPECIMEN_ID']; ?></td>
                                <td>
                                    <input type='checkbox' name='use_sid' id='use_sid'<?php
                                    //if($lab_config->sid != 0)
                                    if(true)
                                        echo " checked ";
                                    ?>>
                                    </input>
                                    <span id='use_sid_mand' style='display:none;'>
                                        &nbsp;&nbsp;
                                        <?php echo LangUtil::$generalTerms['MSG_MANDATORYFIELD']; ?>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo LangUtil::$generalTerms['SPECIMENS']; ?> - <?php echo LangUtil::$generalTerms['SPECIMEN_ID']; ?></td>
                                <td>
                                    <input type='checkbox' name='use_s_addl' id='use_s_addl'<?php
                                    if($lab_config->specimenAddl != 0)
                                        echo " checked ";
                                    ?>>
                                    </input>
                                    <span id='use_s_addl_mand' style='display:none;'>
                                        &nbsp;&nbsp;
                                        <?php echo LangUtil::$generalTerms['MSG_MANDATORYFIELD']; ?>?
                                        &nbsp;&nbsp;
                                        <input type='radio' name='use_s_addl_radio' value='Y'<?php
                                        if($lab_config->specimenAddl == 2)
                                            echo " checked ";
                                        ?>><?php echo LangUtil::$generalTerms['YES']; ?></input>
                                        &nbsp;&nbsp;
                                        <input type='radio' name='use_s_addl_radio' value='N' <?php
                                        if($lab_config->specimenAddl != 2)
                                            echo " checked ";
                                        ?>><?php echo LangUtil::$generalTerms['NO']; ?></input>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo LangUtil::$generalTerms['SPECIMENS']; ?> - <?php echo LangUtil::$generalTerms['COMMENTS']; ?></td>
                                <td>
                                    <input type='checkbox' name='use_comm' id='use_comm'<?php
                                    if($lab_config->comm != 0)
                                        echo " checked ";
                                    ?>>
                                    </input>
                                    <span id='use_comm_mand' style='display:none;'>
                                        &nbsp;&nbsp;
                                        <?php echo LangUtil::$generalTerms['MSG_MANDATORYFIELD']; ?>?
                                        &nbsp;&nbsp;
                                        <input type='radio' name='use_comm_radio' value='Y'<?php
                                        if($lab_config->comm == 2)
                                            echo " checked ";
                                        ?>><?php echo LangUtil::$generalTerms['YES']; ?></input>
                                        &nbsp;&nbsp;
                                        <input type='radio' name='use_comm_radio' value='N' <?php
                                        if($lab_config->comm != 2)
                                            echo " checked ";
                                        ?>><?php echo LangUtil::$generalTerms['NO']; ?></input>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo LangUtil::$generalTerms['SPECIMENS']; ?> - <?php echo LangUtil::$generalTerms['R_DATE']; ?></td>
                                <td>
                                    <input type='checkbox' name='use_rdate' id='use_rdate'<?php
                                    if($lab_config->rdate != 0)
                                        echo " checked ";
                                    ?>>
                                    </input>
                                    <span id='use_rdate_mand' style='display:none;'>
                                        &nbsp;&nbsp;
                                        <?php echo LangUtil::$generalTerms['MSG_MANDATORYFIELD']; ?>?
                                        &nbsp;&nbsp;
                                        <input type='radio' name='use_rdate_radio' value='Y'<?php
                                        if($lab_config->rdate == 2)
                                            echo " checked ";
                                        ?>><?php echo LangUtil::$generalTerms['YES']; ?></input>
                                        &nbsp;&nbsp;
                                        <input type='radio' name='use_rdate_radio' value='N' <?php
                                        if($lab_config->rdate != 2)
                                            echo " checked ";
                                        ?>><?php echo LangUtil::$generalTerms['NO']; ?></input>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo LangUtil::$generalTerms['SPECIMENS']; ?> - <?php echo LangUtil::$generalTerms['REF_OUT']; ?></td>
                                <td>
                                    <input type='checkbox' name='use_refout' id='use_refout'<?php
                                    if($lab_config->refout != 0)
                                        echo " checked ";
                                    ?>>
                                    </input>
                                    <span id='use_refout_mand' style='display:none;'>
                                        &nbsp;&nbsp;
                                        <?php echo LangUtil::$generalTerms['MSG_MANDATORYFIELD']; ?>?
                                        &nbsp;&nbsp;
                                        <input type='radio' name='use_refout_radio' value='Y'<?php
                                        if($lab_config->refout == 2)
                                            echo " checked ";
                                        ?>><?php echo LangUtil::$generalTerms['YES']; ?></input>
                                        &nbsp;&nbsp;
                                        <input type='radio' name='use_refout_radio' value='N' <?php
                                        if($lab_config->refout != 2)
                                            echo " checked ";
                                        ?>><?php echo LangUtil::$generalTerms['NO']; ?></input>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo LangUtil::$generalTerms['SPECIMENS']; ?> - <?php echo LangUtil::$generalTerms['DOCTOR']; ?></td>
                                <td>
                                    <input type='checkbox' name='use_doctor' id='use_doctor'<?php
                                    if($lab_config->refout != 0)
                                        echo " checked ";
                                    ?>>
                                    </input>
                                    <span id='use_doctor_mand' style='display:none;'>
                                        &nbsp;&nbsp;
                                        <?php echo LangUtil::$generalTerms['MSG_MANDATORYFIELD']; ?>?
                                        &nbsp;&nbsp;
                                        <input type='radio' name='use_doctor_radio' value='Y'<?php
                                        if($lab_config->refout == 2)
                                            echo " checked ";
                                        ?>><?php echo LangUtil::$generalTerms['YES']; ?></input>
                                        &nbsp;&nbsp;
                                        <input type='radio' name='use_doctor_radio' value='N' <?php
                                        if($lab_config->refout != 2)
                                            echo " checked ";
                                        ?>><?php echo LangUtil::$generalTerms['NO']; ?></input>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo LangUtil::$generalTerms['DATE_FORMAT']; ?></td>
                                <td>
                                    <select name='dformat' id='dformat'>
                                        <?php $page_elems->getDateFormatSelect($lab_config); ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <input type='button' value='<?php echo LangUtil::$generalTerms['CMD_UPDATE']; ?>' onclick='javascript:submit_otherfields();'>
                                    </input>
                                    &nbsp;&nbsp;&nbsp;
                                    <span id='otherfields_progress' style='display:none;'>
                                        <?php echo $page_elems->getProgressSpinner(LangUtil::$generalTerms['CMD_SUBMITTING']); ?>
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    </form>
                    </div>
                    
                    <br>
                    <?php echo LangUtil::$pageTerms['CUSTOMFIELDS']." - ".LangUtil::$generalTerms['SPECIMENS']; ?>
                     | <a href='cfield_new.php?lid=<?php echo $lab_config_id; ?>'><?php echo LangUtil::$generalTerms['ADDNEW']; ?></a>[<a href='#new_help' rel='facebox'>?</a>]
                    <div id='specimen_custom_field_list'>
                    <?php 
                    $custom_field_list = get_lab_config_specimen_custom_fields($lab_config->id);
                    $page_elems->getCustomFieldTable($lab_config->id, $custom_field_list, 1); 
                    ?>
                    </div>
                    
                    <br>
                    <?php echo LangUtil::$pageTerms['CUSTOMFIELDS']." - ".LangUtil::$generalTerms['PATIENTS']; ?>
                     | <a href='cfield_new.php?lid=<?php echo $lab_config_id; ?>'><?php echo LangUtil::$generalTerms['ADDNEW']; ?></a> [<a href='#new_help' rel='facebox'>?</a>]
                    <div id='patient_custom_field_list'>
                    <?php 
                    $custom_field_list = get_lab_config_patient_custom_fields($lab_config->id);
                    $page_elems->getCustomFieldTable($lab_config->id, $custom_field_list, 2); 
                    ?>
                    </div>
                    
                    <br>
                    <?php echo LangUtil::$pageTerms['CUSTOMFIELDS']." - Lab Titles"; ?>
                     | <a href='cfield_new.php?lid=<?php echo $lab_config_id; ?>'><?php echo LangUtil::$generalTerms['ADDNEW']; ?></a> [<a href='#new_help' rel='facebox'>?</a>]
                    <div id='labtitle_custom_field_list'>
                    <?php 
                    $custom_field_list = get_lab_config_labtitle_custom_fields($lab_config->id);
                    $page_elems->getCustomFieldTable($lab_config->id, $custom_field_list, 3); 
                    ?>
                    </div>
                   
                </div>
                
        </div>
  </div>      






<div id='Tests_config' class='right_pane' style='display:none;margin-left:10px;'>
    <h2><u><?php echo LangUtil::$pageTerms['MENU_LABCONFIG']; ?></u></h2>
    <h3><?php echo LangUtil::$pageTerms['MENU_TESTS']; ?></h3>
    <p>This has the following options:</p>
    <ul>
        <?php
        if(LangUtil::$pageTerms['TIPS_SPECIMENTESTTYPES']!="-") {
            echo "<li>";
            echo LangUtil::$pageTerms['TIPS_SPECIMENTESTTYPES'];
            echo "</li>";
        }   
        if(LangUtil::$pageTerms['TIPS_TARGETTAT']!="-") {
            echo "<li>"; 
            echo LangUtil::$pageTerms['TIPS_TARGETTAT'];
            echo "</li>";
        }
        if(LangUtil::$pageTerms['TIPS_RESULTINTERPRETATION']!="-") {
            echo "<li>"; 
            echo LangUtil::$pageTerms['TIPS_RESULTINTERPRETATION'];
            echo "</li>"; 
        }
        ?>
    </ul>
</div>

<div id='Billing_config' class='right_pane' style='display:none;margin-left:10px;'>
    <u>This has the following options</u>
    <ul>
        <li>Enable Billing: Toggles whether or not your lab uses the billing engine.</li>
        <li>Currency Name: Denotes what name will be used when printing monetary amounts in the billing engine.</li>
        <li>Currency Delimiter: Denotes what is used to separate 'dollars' from 
            'cents' when printing monetary amounts in the billing engine.  For example, the '.' in 10.50</li>
    </ul>
</div>

<div id='IR_rc' class='right_pane' style='display:none;margin-left:10px;'>
    <ul>
            <li><?php echo LangUtil::$pageTerms['TIPS_INFECTIONREPORT']; ?></li>
        </ul>
    </div>  
    
    <div id='DRS_rc' class='right_pane' style='display:none;margin-left:10px;'>
    <ul>
            <li><?php echo LangUtil::$pageTerms['TIPS_DAILYREPORTSETTINGS']; ?></li>
        </ul>
    </div>
    
    <div id='WS_rc' class='right_pane' style='display:none;margin-left:10px;'>
        <ul>
            <li><?php echo LangUtil::$pageTerms['TIPS_WORKSHEETS']; ?></li>
        </ul>
    </div>
    
    <div id='UserAccounts_config' class='right_pane' style='display:none;margin-left:10px;'>
    <ul>    
        <?php
        if(LangUtil::$pageTerms['TIPS_USERACCOUNTS_1']!="-") {
            echo "<li>";
            echo LangUtil::$pageTerms['TIPS_USERACCOUNTS_1'];
            echo "</li>";
        }   
        if(LangUtil::$pageTerms['TIPS_USERACCOUNTS_2']!="-") {
            echo "<li>"; 
            echo LangUtil::$pageTerms['TIPS_USERACCOUNTS_2'];
            echo "</li>";
        }
        if(LangUtil::$pageTerms['TIPS_USERACCOUNTS_3']!="-") {
            echo "<li>"; 
            echo LangUtil::$pageTerms['TIPS_USERACCOUNTS_3'];
            echo "</li>"; 
        }
        ?>
    </ul>
    </div>
    
    <div id='RegistrationFields_config' class='right_pane' style='display:none;margin-left:10px;'>
    <ul>    
        <?php
        if(LangUtil::$pageTerms['TIPS_REGISTRATIONFIELDS_1']!="-") {
            echo "<li>";
            echo LangUtil::$pageTerms['TIPS_REGISTRATIONFIELDS_1'];
            echo "</li>";
        }   
        if(LangUtil::$pageTerms['TIPS_REGISTRATIONFIELDS_2']!="-") {
            echo "<li>"; 
            echo LangUtil::$pageTerms['TIPS_REGISTRATIONFIELDS_2'];
            echo "</li>";
        }
        if(LangUtil::$pageTerms['TIPS_REGISTRATIONFIELDS_3']!="-") {
            echo "<li>"; 
            echo LangUtil::$pageTerms['TIPS_REGISTRATIONFIELDS_3'];
            echo "</li>"; 
        }
        ?>
    </ul>
    </div>

        <!--NC3065-->
        
        <div id='search_config' class='right_pane' style='display:none;margin-left:10px;'>
    <ul>    
        <?php
        
            echo "<li>";
            echo " Toggle Patient Number or Patient's Age to be displayed as part of Search Results";
            echo "</li>";
                        echo "<li>";
            echo " Choosing to display Patient Number and/or Patient's Age as part of Search results slows down the time taken to search ";
            echo "</li>";
                        
                        
        
        ?>
    </ul>
    </div>
        
        <div id='barcode_config' class='right_pane' style='display:none;margin-left:10px;'>
    <ul>    
        <?php
        
            echo "<li>";
            echo " Configure your settings for barcode formats";
            echo "</li>";
                        echo "<li>";
            echo " Width and Height are the dimensions of the bars ";
            echo "</li>";
                        echo "<li>";
            echo " Text size os the for the code printed underneath the barcodes";
            echo "</li>";
                       
                        
                        
        
        ?>
    </ul>
    </div>
        
        <!---NC3065-->
    
    <div id='SetupNet' class='right_pane' style='display:none;margin-left:10px;'>
    <ul>
            <li><?php echo LangUtil::$pageTerms['TIPS_SETUPNETWORK_3']; ?></li>
    </ul><br>
            <i><?php echo LangUtil::$pageTerms['TIPS_SETUPNETWORK_4']; ?></i>
    </div>
    
    <div id='Revert' class='right_pane' style='display:none;margin-left:10px;'>
    <ul>
        <li><?php echo LangUtil::$pageTerms['TIPS_REVERT']; ?></li>
    </ul>
    </div>

<div id='new_help' style='display:none'>
<small>
<u>Add New</u> lets you add new registration fields as required for the lab.
</small>
</div>
  
<div class="portlet box green right_pane" id="test_div" style="display: none">
        <div class="portlet-title" >
                                <h4><i class="icon-reorder"></i>Tests</h4>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse"></a>
                                    <a href="#portlet-config" data-toggle="modal" class="config"></a>
                                </div>
        </div>
        
        <div class="portlet-body" >
            <!--BEGIN TABS-->
                       <div class="tabbable tabbable-custom">
                           <ul class="nav nav-tabs">
                                                <li class="active"><a href="#tab_1_1" data-toggle="tab">Specimen/Test Types </a></li>
                                                <li><a href="#tab_1_2" data-toggle="tab">Turnaround Time </a></li>
                                                <li><a href="#tab_1_3" data-toggle="tab">Results Interpretation </a></li>
                                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_1_1">
                                                    <div class='st_pane' id='st_types_div' style='margin-left:10px;'>
                                                        <p style="text-align: right;"><a rel='facebox' href='#Tests_config'>Page Help</a></p>
                                                            
                                                            <div id='sttypes_msg' class='clean-orange' style='display:none;width:350px;'>
                                                            </div>
                                                            <form id='st_types_form' name='st_types_form' action='ajax/st_types_update.php' method='post'>
                                                            <input type='hidden' name='lid' value='<?php echo $lab_config->id; ?>'></input>                 
                                                            <?php echo LangUtil::$generalTerms['SPECIMEN_TYPES']; ?>
                                                            <small><a id='stype_link' href='javascript:stype_toggle();'><?php echo LangUtil::$generalTerms['CMD_SHOW']; ?></a></small>
                                                            <div class='pretty_box' id='stype_box' style='display:none'>
                                                            <b><u><?php echo LangUtil::$generalTerms['SPECIMEN_TYPES']; ?></u></b>
                                                                <?php $page_elems->getSpecimenTypeCheckboxes($lab_config->id); ?>
                                                            </div>
                                                            <br>
                                                            <br>
                                                            <?php echo LangUtil::$generalTerms['TEST_TYPES']; ?>
                                                            <small><a id='ttype_link' href='javascript:ttype_toggle();'><?php echo LangUtil::$generalTerms['CMD_SHOW']; ?></a></small>
                                                            <div class='pretty_box' id='ttype_box' style='display:none'>
                                                            <b><u><?php echo LangUtil::$generalTerms['TEST_TYPES']; ?></u></b>
                                                                                
                                                                                <?php
                                                                                //NC3065
                                                                                
                                                                                $user = get_user_by_id($_SESSION['user_id']);
                                                                                if(is_super_admin($user) || is_country_dir($user))
                                                                                {
                                                                                    $page_elems->getTestTypeCheckboxes_dir($lab_config->id);
                                                                                }
                                                                                else
                                                                                {
                                                                                    $page_elems->getTestTypeCheckboxes($lab_config->id); 
                                                                                }
                                                                                //NC3065
                                                            ?>
                                                                                
                                                                                 <?php //$page_elems->getTestTypeCheckboxes($lab_config->id); ?>
                                                                                
                                                            </div>
                                                            <br><br>
                                                            <input type='button' class="btn green" value='<?php echo LangUtil::$generalTerms['CMD_SUBMIT']; ?>' onclick='checkandsubmit_st_types()'>
                                                            </input>
                                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                                            <span id='st_types_progress' style='display:none;'>
                                                                          
                                                                <?php $page_elems->getProgressSpinner(LangUtil::$generalTerms['CMD_SUBMITTING']); ?>
                                                            </span>
                                                            </form>
                                                        </div>
                                                </div>
                                <div class="tab-pane" id="tab_1_2">
                                                    <div class='target_tat' id='target_tat_div' style='margin-left:10px;'>
                                                        <p style="text-align: right;"><a rel='facebox' href='#Tests_config'>Page Help</a></p>
                                                            <b><?php echo LangUtil::$pageTerms['MENU_TAT']; ?></b>
                                                             | <a href="javascript:toggletatdivs();" id='toggletat_link'><?php echo LangUtil::$generalTerms['CMD_EDIT']; ?></a>
                                                            <br><br>
                                                            <div id='tat_msg' class='clean-orange' style='display:none;width:350px;'>
                                                            </div>
                                                            <div id='goal_tat_list'>
                                                            <?php $page_elems->getGetGoalTatTable($lab_config->id); ?>
                                                            </div>
                                                            <form id='goal_tat_form' style='display:none' name='goal_tat_form' action='ajax/lab_config_tat_update.php' method='post'>
                                                                <?php $page_elems->getGoalTatForm($lab_config->id); ?>
                                                                <input type='button' value='<?php echo LangUtil::$generalTerms['CMD_SUBMIT']; ?>' onclick='javascript:submit_goal_tat();'></input>
                                                                &nbsp;&nbsp;&nbsp;
                                                                <small><a href='javascript:toggletatdivs();'><?php echo LangUtil::$generalTerms['CMD_CANCEL']; ?></a></small>
                                                                &nbsp;&nbsp;&nbsp;
                                                                <span id='tat_progress_spinner' style='display:none;'>
                                                                    <?php $page_elems->getProgressSpinner(LangUtil::$generalTerms['CMD_SUBMITTING']); ?>
                                                                </span>
                                                            </form>
                                                        </div>
                                                </div>
                                            <div class="tab-pane" id="tab_1_3">
                                                 <p style="text-align: right;"><a rel='facebox' href='#Tests_config'>Page Help</a></p><br/>
                                                     <?php echo LangUtil::$generalTerms['TEST_TYPE']; ?>
                                                        &nbsp;&nbsp;&nbsp;
                                                        <select name='ttype' id='ttype'>
                                                            <?php $page_elems->getTestTypesSelect($lab_config->id); ?>
                                                        </select>
                                                        &nbsp;&nbsp;&nbsp;
                                                        <input type='button' onclick='javascript:fetch_remarks_form();' value='<?php echo LangUtil::$generalTerms['CMD_SEARCH']; ?>'></input>
                                                        &nbsp;&nbsp;
                                                        <span id='remarks_fetch_progress' style='display:none;'>
                                                            <?php $page_elems->getProgressSpinner(LangUtil::$generalTerms['CMD_SEARCHING']); ?>
                                                        </span>
                                                        &nbsp;
                                                        <span id='updated_msg' class='clean-orange' style='display:none;width:140px;'>
                                                            <?php echo LangUtil::$generalTerms['MSG_UPDATED']; ?>
                                                        </span>
                                                        
                                                        <br><br>
                                                        <div id='remarks_form_pane'>
                                                        </div>
                                                </div>
                       </div>
             </div>                                
                       <!--END TABS-->
         </div>
     </div>  
            <div class="row-fluid">
                <div class="span12 sortable">
	                 
	                   
<table>
	<tbody>
		<tr valign='top'>
			<td>
                                <div class='right_pane' id='blis_update_div' style='display:none;margin-left:10px;'>
				<p style="text-align: right;"><a rel='facebox' href='#Summary_config'>Page Help</a></p>
				<b><?php echo "BLIS Update"; ?></b>
					<br><br>
                                        <input type="Button" id="update_button" name="update_button" value="Start Update" onclick="javascript:blis_update_t()"/>
                                        <br>
                                        <div id='update_spinner' style='display:none;'>
                                        <?php
					$spinner_message = "Updating to C4G BLIS v2.2"."<br>";
                                        $page_elems->getProgressSpinnerBig($spinner_message);
                                        ?>
                                        </div>
                                        <br>
                                        <div id='update_success' class='clean-orange' style='display:none;width:350px;'>
                                            Update to v2.2 Successful!
                                        </div>
                                        <div id='update_failure' class='clean-error' style='display:none;width:350px;'>
                                            Update to v2.2 Failed! Try Again.
                                        </div>
				</div>
				
				
			
                                <!--NC3065-->
                                
                
                                
                                
                                
                                <!--NC3065-->

                            
				<div class='right_pane' id='users_div' style='display:none;width:inherit ;'>
				<div class="portlet box green">
					<div class="portlet-title">
						<h4><i class="icon-reorder"></i><?php echo LangUtil::$pageTerms['MENU_USERS']; ?></h4>
							<div class="tools">
							<a href="javascript:;" class="collapse"></a>
							</div>
					</div>
					<div class="portlet-body">
					<?php
					$reload_url = "lab_config_home.php?id=$lab_config_id";
					?>
					<p style="text-align: right;"><a rel='facebox' href='#UserAccounts_config'>Page Help</a></p>
					 <a rel='facebox' class="btn blue-stripe" href='lab_user_new.php?ru=<?php echo $reload_url; ?>&lid=<?php echo $lab_config_id; ?>'>
					 <i class='icon-plus'></i> 
					 <?php echo LangUtil::$generalTerms['CMD_ADDNEWACCOUNT']; ?>
					 </a>
					 <a class="btn blue-stripe" href='javascript:import_users();'>
					 <i class='icon-download'></i> 
					 <?php echo 'Import from HMIS/EMR' ?>
					 </a>
					<br><br>
					<div id='user_acc_msg' class='clean-orange' style='display:none;width:350px;'>
					</div>
					<div id='user_list_table'>
					<?php
					$user_list = $lab_config->getUsers();
					$page_elems->getLabUsersTable($user_list, $lab_config_id);
					?>
					</div>
					<div class='modal container hide fade' id='import_users' role="dialog" data-backdrop="static">
						<div id='specimen_types_div' class='content_div'>
						<div class="portlet box green">
							<div class="portlet-title">
								<h4><i class="icon-reorder"></i><?php echo 'Sanitas Users' ?></h4>
							</div>
							<div class="portlet-body">
							<table class='table table-striped table-condensed table-hover' id="result">
							</table>
							<br>
							<a href="javascript:import_users();" class="btn green">Ok</a>
							
						</div>
						</div>
					</div>
				</div>
				</div>
				</div>
					
				<div class='right_pane' id='inventory_div' style='display:none;margin-left:10px;'>
				</div>
                                
                                <div class='right_pane' id='billing_div' style='display:none;margin-left:10px;'>
                                         
                                    <p style="text-align: right;"><a rel='facebox' href='#Billing_config'>Page Help</a></p>
                                    <div id='billing_msg' class='clean-orange' style='display:none;width:350px;'>
                                    </div>
                                    <form id='billing_form' name='billing_form' action='ajax/billing_update.php' method='post'>
                                        <input type='hidden' name='lid' value='<?php echo $lab_config->id; ?>'></input>
                                        <div class="pretty_box">
                                        <?php
                                            if (is_billing_enabled($_SESSION['lab_config_id'])) {
                                                $checkbox = "checked";
                                            } else {
                                                $checkbox = "";
                                            }
                                            $old_currency = get_currency_type_from_lab_config_settings();
                                        ?>
                                        <input type="checkbox" value="enable_billing" name="enable_billing" <?php echo $checkbox ?>/><?php echo "Enable Billing"; ?>
                                        <br><br>
                                        <?php echo "Currency Name:"; ?>
                                        <input type="text" name="currency_name" value="<?php echo get_currency_type_from_lab_config_settings() ?>" />
                                        <br><br>
                                        <?php echo "Currency Delimiter:"; ?>
                                        <input type="text" name="currency_delimiter" value="<?php echo get_currency_delimiter_from_lab_config_settings() ?>" size="1" maxlength="1" />
                                        <br><br>
                                        Currency will display as: 00<?php echo get_currency_delimiter_from_lab_config_settings(); ?>00 <?php echo get_currency_type_from_lab_config_settings() ?>
                                        </div>
                                        <br>
                                        <input type="button" value="Update" onclick="submit_billing_update()" />

                                        <span id='billing_progress' style='display:none;'>
                                            <?php $page_elems->getProgressSpinner(LangUtil::$generalTerms['CMD_SUBMITTING']); ?>
					</span>
                                    </form>
                                </div>
				
				
				<div class='right_pane' id='network_setup_div' style='display:none;margin-left:10px;'>
				<p style="text-align: right;"><a rel='facebox' href='#SetupNet'>Page Help</a></p>
				Setup can be accessed from BlisSetup.html in the main folder.
				</div>
				
                            <div class='right_pane' id='view_stocks_help'  style='display:none;margin-left:10px;'>
                                    <ul>	
                                            <?php

                                                    echo "<li>";
                                                    echo " Toggle Patient Number or Patient's Age to be displayed as part of Search Results";
                                                    echo "</li>";
                                                    echo "<li>";
                                                    echo " Choosing to display Patient Number and/or Patient's Age as part of Search results slows down the time taken to search ";
                                                    echo "</li>";



                                            ?>
                                    </ul>
                                    </div>

                                
                                
				<div class='right_pane' id='del_config_div' style='display:none;margin-left:10px;'>
					<b><?php echo LangUtil::$pageTerms['MENU_DEL']; ?></b>
					<br><br>
					<div class='clean-orange' style='width:350px;'>
					'<?php echo $lab_config->getSiteName(); ?>' - <?php echo LangUtil::$pageTerms['TIPS_LABDELETE']; ?>
					<br><br>
					<input type='button' onclick='javascript:delete_config();' value='<?php echo LangUtil::$generalTerms['CMD_OK']; ?>'>
					&nbsp;&nbsp;&nbsp;
					<input type='button' onclick="javascript:right_load(1, 'site_info_div');" value='<?php echo LangUtil::$generalTerms['CMD_CANCEL']; ?>'>
					</div>
				</div>
				
				<div class='right_pane' id='change_admin_div' style='display:none;margin-left:10px;'>
					<b><?php echo LangUtil::$pageTerms['MENU_MGR']; ?></b>
					<br><br>
					<div id='admin_msg' class='clean-orange' style='display:none;width:350px;'>
					</div>
					<br>
					<select name='lab_admin' id='lab_admin' class='uniform_width'>
					<?php 
						# Fetch list of existing lab admins 
						$page_elems->getAdminUserOptions();
					?>
					</select>
					<br><br>
					<input type='button' onclick='javascript:change_admin();' value='<?php echo LangUtil::$generalTerms['CMD_SUBMIT']; ?>'>
					&nbsp;&nbsp;&nbsp;
					<small><a href="javascript:right_load(1, 'site_info_div');"><?php echo LangUtil::$generalTerms['CMD_CANCEL']; ?></a></small>
				</div>
                                
				<div class='right_pane' id='misc_div' style='display:none;margin-left:10px;'>
					<b><?php echo LangUtil::$pageTerms['MENU_GENERAL']; ?></b>
					<br><br>
					<div id='misc_msg' class='clean-orange' style='display:none;width:350px;'>
					</div>
					<form id='misc_form' name='misc_form' action='ajax/lab_config_miscupdate.php' method='get'>
						<table cellspacing='10px'>
							<tbody>
								<tr>
									<td><?php echo LangUtil::$generalTerms['FACILITY']; ?> &nbsp;&nbsp;&nbsp;&nbsp;</td>
									<td>
										<input type='text' name='name' id='name9' class='uniform_width' value='<?php echo $lab_config->name; ?>'>
										</input>
										<input type='hidden' name='lid' value='<?php echo $lab_config->id; ?>'></input>
									</td>
								</tr>
								<tr>
									<td><?php echo LangUtil::$generalTerms['LOCATION']; ?></td>
									<td>
										<input type='text' name='loc' id='loc9' class='uniform_width' value='<?php echo $lab_config->location; ?>'>
										</input>
									</td>
								</tr>
								<tr valign='top'>
									<td>Database</td>
									<td>
										<input type='radio' class='dboption' name='dboption' value='1'>Populate Random Data</input><br>
										<input type='radio' class='dboption' name='dboption' value='2'>Clear Random Data</input><br>
										<input type='radio' class='dboption' name='dboption' value='0' checked>Keep Unchanged</input>
										<br><br>
										<div class='clean-orange dboption_help uniform_width' id='dboption_help_1' style='display:none'>
										Populate Random Data - Creates new random records for patients and specimens
										</div>
										<div class='clean-orange dboption_help uniform_width' id='dboption_help_2' style='display:none'>
										Clear Random Data - Clears all random data about patients and specimens
										</div>
									</td>
								</tr>
								<tr valign='top' class='random_params' style='display:none;'>
									<td>Total Patients</td>
									<td>
										<input type='text' class='uniform_width' name='num_p' value='<?php echo $MAX_NUM_PATIENTS/2; ?>'></input>
									</td>
								</tr>
								<tr valign='top' class='random_params' style='display:none;'>
									<td>Total Specimens</td>
									<td>
										<input type='text' class='uniform_width' name='num_s' value='<?php echo "2000"; #$MAX_NUM_SPECIMENS/2; ?>'></input>
									</td>
								</tr>
								<tr>
									<td></td>
									<td>
										<input type='button' name='misc_form_button' id='misc_form_button' value='<?php echo LangUtil::$generalTerms['CMD_SUBMIT']; ?>' onclick='javascript:misc_checkandsubmit();'>
										</input>
										&nbsp;&nbsp;&nbsp;
										<small><a href="javascript:right_load(1, 'site_info_div');"><?php echo LangUtil::$generalTerms['CMD_CANCEL']; ?></a></small>
										&nbsp;&nbsp;&nbsp;
										<span id='misc_progress' style='display:none'>
											<?php $page_elems->getProgressSpinner(LangUtil::$generalTerms['CMD_SUBMITTING']); ?>
										</span>
									</td>
								</tr>
								<tr>
									<td></td>
									<td>
										<span id='misc_errormsg' class='clean-error' style='display:none' >
										</span>
									</td>
								</tr>
								<tr>
									<td></td>
									<td>
										
									</td>
								</tr>
							</tbody>
						</table>
					</form>			
				</div>
				
				
				
				<div class='right_pane' id='backup_revert_div' style='display:none;margin-left:10px;'>
					<p style="text-align: right;"><a rel='facebox' href='#Revert'>Page Help</a></p>
					<b><?php echo LangUtil::$pageTerms['MENU_REVERT']; ?></b>
					<br><br>
					<div id='backup_revert_msg' class='clean-orange' style='display:none;width:350px;'>
					</div>
					<br>
					<form id='backup_revert_form' name='backup_revert_form' action='data_backup_revert.php' method='post'>
						<input type='hidden' name='lid' value='<?php echo $lab_config->id; ?>'></input>
						<table>
							<tbody>
								<tr valign='top'>
									<td><?php echo LangUtil::$pageTerms['BACKUP_LOCATION']; ?></td>
									<td>
										<?php $page_elems->getBackupRevertRadio("backup_path", $lab_config->id); ?>
									</td>
								</tr>
								<tr valign='top'>
									<td><?php echo LangUtil::$pageTerms['INCLUDE_LANGUAGE_SETTINGS']; ?>?</td>
									<td>
										<input type='radio' name='do_lang' id='do_lang' value='Y'><?php echo LangUtil::$generalTerms['YES']; ?></input>
										<input type='radio' name='do_lang' value='N' checked><?php echo LangUtil::$generalTerms['NO']; ?></input>
									</td>
								</tr>
								<tr valign='top'>
									<td><?php echo LangUtil::$pageTerms['BACKUP_CURRENT_VERSION']; ?></td>
									<td>
										<input type='radio' name='do_currbackup' id='do_currbackup' value='Y' checked><?php echo LangUtil::$generalTerms['YES']; ?></input>
										<input type='radio' name='do_currbackup' value='N'><?php echo LangUtil::$generalTerms['NO']; ?></input>
									</td>
								</tr>
								<tr valign='top'>
									<td></td>
									<td>
										<input type='button' onclick='javascript:backup_revert_submit();' value='<?php echo LangUtil::$generalTerms['CMD_SUBMIT']; ?>'></input>
										&nbsp;&nbsp;&nbsp;
										<span id='backup_revert_progress' style='display:none'>
											<?php $page_elems->getProgressSpinner(LangUtil::$generalTerms['CMD_SUBMITTING']); ?>
										</span>
									</td>
								</tr>
							</tbody>
						</table>
					</form>
	
					<br><br>
					<div class='clean-orange' id='revert_done_msg' style='width:300px' style='display:none;'>
						<?php echo LangUtil::$pageTerms['TIPS_REVERTDONE']; ?>
					</div>
				</div>
				
				<div class='right_pane' id='update_database_div' style='display:none;margin-left:10px;'>
					<p style="text-align: right;"><a rel='facebox' href='#Revert'>Page Help</a></p>
					<b><?php echo "Update Data"; ?></b>
					<br><br>
					<form id='update_database_form' name='update_database_form' action='export/update_database.php' method='get'>
						<input type='hidden' name='lid' value='<?php echo $lab_config->id; ?>'></input>
						<table>
							<tbody>
								<tr valign='top'>
									<td><?php echo 'BACKUP_LOCATION'; ?></td>
									<td>
										<?php $page_elems->getBackupRevertRadio("backup_path", $lab_config->id); ?>
									</td>
								</tr>
								<tr valign='top'>
									<td><?php echo 'BACKUP_CURRENT_VERSION'; ?></td>
									<td>
										<input type='radio' name='do_currbackup' id='do_currbackup' value='Y' checked><?php echo LangUtil::$generalTerms['YES']; ?></input>
										<input type='radio' name='do_currbackup' value='N'><?php echo LangUtil::$generalTerms['NO']; ?></input>
									</td>
								</tr>
								<tr valign='top'>
									<td></td>
									<td>
										<input type='button' onclick='javascript:update_database_submit();' value='<?php echo LangUtil::$generalTerms['CMD_SUBMIT']; ?>'></input>
										&nbsp;&nbsp;&nbsp;
										<span id='update_database_progress' style='display:none'>
											<?php $page_elems->getProgressSpinner(LangUtil::$generalTerms['CMD_SUBMITTING']); ?>
										</span>
									</td>
								</tr>
							</tbody>
						</table>
					</form>
					<br><br>
					<div id='update_success' class='clean-orange' style='display:none;width:350px;'>
						Updated Successfully&nbsp;&nbsp;&nbsp;<a href="javascript:toggle_div('update_success');"--><?php echo LangUtil::$generalTerms['CMD_HIDE']; ?></a>
					</div>
					<div id='update_failure' class='clean-orange' style='display:none;width:350px;'>
						Update Failed&nbsp;&nbsp;&nbsp;<a href="javascript:toggle_div('update_failure');"><?php echo LangUtil::$generalTerms['CMD_HIDE']; ?></a>
					</div>
				</div>
                                
                                <div class='right_pane' id='import_config_div' style='display:none;margin-left:10px;'>
					<p style="text-align: right;"><a rel='facebox' href='#importconfig'>Page Help</a></p>
					<b><?php echo "Import Configuration"; ?></b>
					<br><br>
					<form id='import_config_form' name='import_config_form' action='ajax/import_config.php' method='get'>
						<input type='hidden' name='lid' value='<?php echo $lab_config->id; ?>'></input>
						<table>
							<tbody>
                                                            <tr valign='top'>
                                                                <td><?php echo '- Select the facility from which you want to import data:'; ?></td>
									<td>
										<?php echo ""; ?>
									</td>
								</tr>
                                                                <tr valign='top'>
                                                                <td><?php
                                                                    //$site_list = get_site_list($_SESSION['user_id']);
                                                                    //print_r($site_list);
                                                                    //echo "<input type='checkbox' name='".$elem_name."[]' id='$elem_id' value='$key'>$value</input>";
                                                                    ?>
                                                                    <select name='location' id='location2' class='uniform_width' onchange="javascript:get_testbox2(this.value);">
                                                                    <option value='0'><?php echo 'Select Facility'; ?></option>
                                                                    <?php
                                                                        $page_elems->getSiteOptions();
                                                                    ?>
                                                                    </select>
                                                                    
                                                                        
                                                                </td>
									<td>
										<?php //echo $lab_config->id; ?>
									</td>
								</tr>
                                                                <tr valign='top'>
                                                                <td>
                                                                    <div id='test_list_by_site'>
                                                                        <?php //echo 'Select Facility to dispay its test catalog '?>
                                                                        </div>
                                                                </td>
									<td>
										<?php echo ""; ?>
									</td>
								</tr>
                                                                <tr valign='top'>
                                                                <td><?php echo '- Select the configuration data you want to import:'; ?></td>
									<td>
										<?php echo ""; ?>
									</td>
								</tr>
								
								<tr valign='top'>
									<td><?php echo 'Import test catalog'; ?></td>
									<td>
										<input type='checkbox' id="import_tc" name='import_tc' >
                                                                                </input>
									</td>
								</tr>
								<tr valign='top'>
									<td><?php echo 'Import specimen catalog'; ?></td>
									<td>
										<input type='checkbox' id="import_sc" name='import_sc' >
                                                                                </input>
									</td>
								</tr>
                                                                <tr valign='top'>
									<td><?php echo 'Import Statistic Report settings'; ?></td>
									<td>
										<input type='checkbox' id="import_sr" name='import_sr' >
                                                                                </input>
									</td>
								</tr>
                                                                <tr valign='top'>
									<td><?php echo 'Import Patient Report configurations and Worksheets'; ?></td>
									<td>
										<input type='checkbox' id="import_pw" name='import_pw' >
                                                                                </input>
									</td>
								</tr>
                                                                <tr valign='top'>
									<td></td>
									<td>
										<input type='button' onclick='javascript:update_database_submit();' value='<?php echo LangUtil::$generalTerms['CMD_SUBMIT']; ?>'></input>
										&nbsp;&nbsp;&nbsp;
										<span id='update_database_progress' style='display:none'>
											<?php $page_elems->getProgressSpinner(LangUtil::$generalTerms['CMD_SUBMITTING']); ?>
										</span>
									</td>
								</tr>
							</tbody>
						</table>
					</form>
					<br><br>
					<div id='update_success' class='clean-orange' style='display:none;width:350px;'>
						Updated Successfully&nbsp;&nbsp;&nbsp;<a href="javascript:toggle_div('update_success');"--><?php echo LangUtil::$generalTerms['CMD_HIDE']; ?></a>
					</div>
					<div id='update_failure' class='clean-orange' style='display:none;width:350px;'>
						Update Failed&nbsp;&nbsp;&nbsp;<a href="javascript:toggle_div('update_failure');"><?php echo LangUtil::$generalTerms['CMD_HIDE']; ?></a>
					</div>
				</div>
				
				
				
				<div class='right_pane' id='language_div' style='display:none;margin-left:10px;'>
					<div id='language_contents'></div>
					<?php
						//include('lang/lang_edit.php'); 
					?>
				</div>
			</td>
		</tr>
	</tbody>
</table>
</div>
</div>
<?php 
include("includes/scripts.php");
require_once("includes/script_elems.php");
$script_elems->enableTableSorter();
$script_elems->enableJQueryForm();
$script_elems->enableDatePicker();
?>
<script type="text/javascript" src="js/jquery.ui.js"></script>
<script type="text/javascript" src="js/dialog/jquery.ui.core.js"></script>
<script type="text/javascript" src="js/dialog/jquery.ui.dialog.js"></script>
<script type='text/javascript'>

<?php $page_elems->getCompatibilityJsArray("st_map", $lab_config_id); ?>

$(document).ready(function(){
    $("#inventory_div").load("view_stocks.php");;
	$("input[name='rage']").change(function() {
		toggle_agegrouplist();
	});
	$('#revert_done_msg').hide();
	$('#cat_code12').change( function() { get_test_types_bycat() });
	get_test_types_bycat
	<?php
	if(isset($_REQUEST['show_u']))
	{
		# Preload user accounts pane
		?>
		right_load(3, 'users_div');
		<?php		
	}
	else if(isset($_REQUEST['show_f']))
	{
		# Preload custom fields pane
		?>
		right_load(4, 'fields_div');
		<?php
	}
	else if(isset($_REQUEST['show_i']))
	{
		# Preload the inventory pane
		?>
		right_load(15, 'inventory_div');
		<?
	}
	else if(isset($_REQUEST['set_locale']))
	{
		$locale = $_REQUEST['locale'];
		?>
		language_div_load();
		<?php
	}
	else
	{
		$locale = $_SESSION['locale'];
		?>
		right_load(1, 'test_div');
		<?php
	}
	
	if(isset($_REQUEST['aupdate']))
	{
		# Show user account updated message
		?>
		$('#user_acc_msg').html("'<?php echo $_REQUEST['aupdate']; ?>' - <?php echo LangUtil::$generalTerms['MSG_ACC_UPDATED']; ?>&nbsp;&nbsp;&nbsp;<a href=\"javascript:toggle('user_acc_msg');\"><?php echo LangUtil::$generalTerms['CMD_HIDE']; ?></a>");
		$('#user_acc_msg').show();
		<?php
	}
	else if(isset($_REQUEST['adel']))
	{
		# Show user account deleted message
		?>
		$('#user_acc_msg').html("<?php echo LangUtil::$generalTerms['MSG_ACC_DELETED']; ?>&nbsp;&nbsp;&nbsp;<a href=\"javascript:toggle('user_acc_msg');\"><?php echo LangUtil::$generalTerms['CMD_HIDE']; ?></a>");
		$('#user_acc_msg').show();
		<?php
	}
	else if(isset($_REQUEST['aadd']))
	{
		# Show user account added message
		?>
		$('#user_acc_msg').html("'<?php echo $_REQUEST['aadd']; ?>' - <?php echo LangUtil::$generalTerms['MSG_ACC_ADDED']; ?>&nbsp;&nbsp;&nbsp;<a href=\"javascript:toggle('user_acc_msg');\"><?php echo LangUtil::$generalTerms['CMD_HIDE']; ?></a>");
		$('#user_acc_msg').show();
		<?php
	}
	else if(isset($_REQUEST['tupdate']))
	{
		# Show TAT values updated message
		?>
		$('#tat_msg').html("<?php echo LangUtil::$generalTerms['MSG_UPDATED']; ?>&nbsp;&nbsp;&nbsp;<a href=\"javascript:toggle('tat_msg');\"><?php echo LangUtil::$generalTerms['CMD_HIDE']; ?></a>");
		$('#tat_msg').show();
		right_load(5, 'target_tat_div');
		<?php
	}
	else if(isset($_REQUEST['fupdate']))
	{
		# Show custom field updated message
		?>
		$('#cfield_msg').html("<?php echo LangUtil::$generalTerms['MSG_UPDATED']; ?>&nbsp;&nbsp;&nbsp;<a href=\"javascript:toggle('cfield_msg');\"><?php echo LangUtil::$generalTerms['CMD_HIDE']; ?></a>");
		$('#cfield_msg').show();
		right_load(4, 'fields_div');
		<?php
	}
	else if(isset($_REQUEST['fadd']))
	{
		# Show custom field added message
		?>
		$('#cfield_msg').html("<?php echo LangUtil::$generalTerms['MSG_ADDED']; ?>&nbsp;&nbsp;&nbsp;<a href=\"javascript:toggle('cfield_msg');\"><?php echo LangUtil::$generalTerms['CMD_HIDE']; ?></a>");
		$('#cfield_msg').show();
		right_load(4, 'fields_div');
		<?php
	}
	else if(isset($_REQUEST['stupdate']))
	{
		# Show custom field updated message
		?>
		$('#sttypes_msg').html("<?php echo LangUtil::$generalTerms['MSG_UPDATED']; ?>&nbsp;&nbsp;&nbsp;<a href=\"javascript:toggle('sttypes_msg');\"><?php echo LangUtil::$generalTerms['CMD_HIDE']; ?></a>");
		$('#sttypes_msg').show();
		right_load(2, 'st_types_div');
		<?php
	}
        else if(isset($_REQUEST['billingupdate']))
        {
                ?>
                $('#billing_msg').html("<?php echo LangUtil::$generalTerms['MSG_UPDATED']; ?>&nbsp;&nbsp;&nbsp;<a href=\"javascript:toggle('billing_msg');\"><?php echo LangUtil::$generalTerms['CMD_HIDE']; ?></a>");
		$('#billing_msg').show();
                right_load(22, 'billing_div');
                <?php
        }
	else if(isset($_REQUEST['adupdate']))
	{
		# Show custom field updated message
		?>
		$('#admin_msg').html("<?php echo LangUtil::$generalTerms['MSG_UPDATED']; ?>&nbsp;&nbsp;&nbsp;<a href=\"javascript:toggle('admin_msg');\"><?php echo LangUtil::$generalTerms['CMD_HIDE']; ?></a>");
		$('#admin_msg').show();
		right_load(7, 'change_admin_div');
		<?php
	}
	else if(isset($_REQUEST['aggupdate']))
	{
		# Show custom field updated message
		?>
		$('#agg_msg').html("<?php echo LangUtil::$generalTerms['MSG_UPDATED']; ?>&nbsp;&nbsp;&nbsp;<a href=\"javascript:toggle('agg_msg');\"><?php echo LangUtil::$generalTerms['CMD_HIDE']; ?></a>");
		$('#agg_msg').show();
		right_load(8, 'agg_report_div');
		<?php
	}
        else if(isset($_REQUEST['grouped_count_update']))
	{
		# Show custom field updated message
		?>
		$('#grouped_count_msg').html("<?php echo LangUtil::$generalTerms['MSG_UPDATED']; ?>&nbsp;&nbsp;&nbsp;<a href=\"javascript:toggle('grouped_count_msg');\"><?php echo LangUtil::$generalTerms['CMD_HIDE']; ?></a>");
		$('#grouped_count_msg').show();
		right_load(36, 'grouped_count_div');
		<?php
	}
	else if(isset($_REQUEST['miscupdate']))
	{
		# Show general settings updated message
		?>
		$('#misc_msg').html("<?php echo LangUtil::$generalTerms['MSG_UPDATED']; ?>&nbsp;&nbsp;&nbsp;<a href=\"javascript:toggle('misc_msg');\"><?php echo LangUtil::$generalTerms['CMD_HIDE']; ?></a>");
		$('#misc_msg').show();
		right_load(9, 'misc_div');
		<?php
	}
	else if(isset($_REQUEST['langupd']))
	{
		# Show locale updated message
		?>
		$('#main_msg').html("<?php echo LangUtil::$pageTerms['MSG_LANGUPDATED']; ?>&nbsp;&nbsp;&nbsp;<a href=\"javascript:toggle('main_msg');\"><?php echo LangUtil::$generalTerms['CMD_HIDE']; ?></a>");
		$('#main_msg').show();
		<?php
	}
	else if(isset($_REQUEST['ofupdate']))
	{
		# Show other fields updated message
		?>
		$('#cfield_msg').html("<?php echo LangUtil::$generalTerms['MSG_UPDATED']; ?>&nbsp;&nbsp;&nbsp;<a href=\"javascript:toggle('cfield_msg');\"><?php echo LangUtil::$generalTerms['CMD_HIDE']; ?></a>");
		$('#cfield_msg').show();
		right_load(4, 'fields_div');
		<?php
	}
        //NC3065
        else if(isset($_REQUEST['sfcupdate']))
	{
		# Show other fields updated message
		?>
		$('#searchfield_msg').html("<?php echo LangUtil::$generalTerms['MSG_UPDATED']; ?>&nbsp;&nbsp;&nbsp;<a href=\"javascript:toggle('searchfield_msg');\"><?php echo LangUtil::$generalTerms['CMD_HIDE']; ?></a>");
		$('#searchfield_msg').show();
		right_load(21, 'search_div');
		<?php
	}
        else if(isset($_REQUEST['brcupdate']))
	{
		# Show other fields updated message
		?>
		$('#barcodefield_msg').html("<?php echo LangUtil::$generalTerms['MSG_UPDATED']; ?>&nbsp;&nbsp;&nbsp;<a href=\"javascript:toggle('barcodefield_msg');\"><?php echo LangUtil::$generalTerms['CMD_HIDE']; ?></a>");
		$('#barcodefield_msg').show();
		right_load(28, 'barcode_div');
		<?php
	}
        //-NC3065
	else if(isset($_REQUEST['rcfgupdate']))
	{
		# Show report config updated message
		?>
		$('#report_config_msg').html("<?php echo LangUtil::$generalTerms['MSG_UPDATED']; ?>&nbsp;&nbsp;&nbsp;<a href=\"javascript:toggle('report_config_msg');\"><?php echo LangUtil::$generalTerms['CMD_HIDE']; ?></a>");
		$('#report_config_msg').show();
		var report_type=<?php echo $_REQUEST['rcfgupdate']; ?>;
		right_load(11, 'report_config_div');
		$('#report_type11').attr("value", report_type);
		//fetch_report_config();
		fetch_report_summary();
		<?php
	}

	else if(isset($_REQUEST['wcfgupdate']))
	{
		# Show report config updated message
		?>
		$('#worksheet_config_msg').html("<?php echo LangUtil::$generalTerms['MSG_UPDATED']; ?>&nbsp;&nbsp;&nbsp;<a href=\"javascript:toggle('worksheet_config_msg');\"><?php echo LangUtil::$generalTerms['CMD_HIDE']; ?></a>");
		$('#worksheet_config_msg').show();
		<?php 
		$post_parts = explode(",", $_REQUEST['wcfgupdate']); 
		?>
		right_load(12, 'worksheet_config_div');
		$('#cat_code12').attr("value", "<?php echo $post_parts[0]; ?>");
		$('#test_type12').attr("value", "<?php echo $post_parts[1]; ?>");
		fetch_worksheet_summary();
		<?php
	}
        else if(isset($_REQUEST['importupdate']))
	{
		# Show report config updated message
		?>
		$('#worksheet_config_msg').html("<?php echo LangUtil::$generalTerms['MSG_UPDATED']; ?>&nbsp;&nbsp;&nbsp;<a href=\"javascript:toggle('worksheet_config_msg');\"><?php echo LangUtil::$generalTerms['CMD_HIDE']; ?></a>");
		$('#worksheet_config_msg').show();
		<?php 
		$post_parts = explode(",", $_REQUEST['wcfgupdate']); 
		?>
		right_load(12, 'worksheet_config_div');
		$('#cat_code12').attr("value", "<?php echo $post_parts[0]; ?>");
		$('#test_type12').attr("value", "<?php echo $post_parts[1]; ?>");
		fetch_worksheet_summary();
		<?php
	}
	else if( isset($_REQUEST['revert']) ) {
		if( isset($_REQUEST['updateChange'])) { ?>
			right_load(18, 'update_database_div');
			<?php 
				if($_REQUEST['revert'] == 1) { ?>
					$('#update_success').show();
				<?php } else { ?>
					$('#update_failure').show();
			<?php }
		} else { ?>
			right_load(13, 'backup_revert_div');
			<?php if($_REQUEST['revert'] == 1) { ?>
				//$('#backup_revert_msg').html("<?php #echo LangUtil::$generalTerms['MSG_UPDATED']; ?>&nbsp;&nbsp;&nbsp;<a href=\"javascript:toggle('backup_revert_msg');\"><?php #echo LangUtil::$generalTerms['CMD_HIDE']; ?></a>");
				$('#revert_done_msg').show();
				<?php
				} else { ?>
					$('#backup_revert_msg').html("<?php echo LangUtil::$generalTerms['ERROR']; ?>&nbsp;&nbsp;&nbsp;<a href=\"javascript:toggle('backup_revert_msg');\"><?php echo LangUtil::$generalTerms['CMD_HIDE']; ?></a>");
					$('#backup_revert_msg').show();
				<?php
				}
		}
	}
	?>
	$('#lab_admin').attr("value", "<?php echo $lab_config->adminUserId; ?>");
	/*$('.stype_entry').change(function() {
		check_compatible();
	});
	*/
	$('.dboption').change(function() {
		toggle_dboption_help();
	});
	stype_toggle();
    getForceVerifySettings();
});

/**
 * Gets current force verify settings and sticks them to the UI for possible
 *  manipulation by the user
 * @return {JSON} lab_config json_encoded array.
 */
function getForceVerifySettings(){
    $.getJSON('ajax/force_verify.php?a=settings', function(data)
        {
            //Put this data in UI
            $('#startt').val(data.starttime);
            $('#endt').val(data.endtime);
        });
}


function submit_forcevalidate()
{
    //validate
    $("#forceverify").ajaxSubmit();
    $("#succes").show();
}

/**
 * Takes content of the cell and puts it in a input tag, for editing
 * @param  {int} id   Id of the record
 * @param  {String} abb  Abbreviation 
 * @param  {String} word Word for the abbreviation
 * @return {void}     no return 
 */
function makeRowEditable(id, abb, word)
        {
            var abbId = 'abb_'+id;
            var wordId = 'word_'+id;
            var editId = 'edit_'+id;
            $('#'+abbId).html("<input value='"+abb+"' id='"+abbId+"_ct'></input>");
            $('#'+wordId).html("<input value='"+word+"' id='"+wordId+"_ct'></input>");

            $('#'+editId).attr("onclick","updateRow('"+id+"', 'update')");
            $('#'+editId).html("Update");
        }
/**
 * Function for manipulating abbreviations. Add edit delete.
 * Sends data to ajax/manipulateAbbreviations for handlinf
 * @param  {int} id  Id of the row being manipulated
 * @param  {String} action The type of action add update delete
 * @return {void}    No return
 */
function updateRow(id, action)
        {
            var abbInputId = 'abb_'+id+'_ct';
            var wordInputId = 'word_'+id+'_ct';
            var editLinkId = 'edit_'+id;

            var abbCellId = 'abb_'+id;
            var wordCellId = 'word_'+id;
            if (action == "update")
                {
                    abbrv = $('#'+abbInputId).val();
                    wrd = $('#'+wordInputId).val();           
                }
            else if (action == "add") 
            {
                  abbrv = $('#abb').val(); 
                  wrd = $('#word').val();
            }
             else 
            {
                  abbrv = ''; 
                  wrd = '';
            }
            
            $.ajax({
                type: 'POST',
                url: 'ajax/manipulateAbbreviations.php',
                data: {id: id, abb: abbrv, word: wrd, action: action},
                success : function(data){
                if (action == "update") {
                    $('#'+abbCellId).html(abbrv);
                    $('#'+wordCellId).html(wrd);
                    $('#'+editLinkId).attr("onclick","makeRowEditable('"+id+"','"+abbrv+"','"+wrd+"') ");
                    $('#'+editLinkId).html("Edit");
                }
                else if (action == "add"){
                    abbrevRow = "<tr id='row_"+data+"'>"
                        +"<td id='abb_"+data+"'>"+abbrv+"</td>"
                        +"<td id='word_"+data+"'>"+wrd+"</td>"
                        +"<td><a id='edit_"+data+"' class='btn mini' href='javascript:void(0)' onclick='makeRowEditable(&quot;"+data+"&quot;,&quot;"+abbrv+"&quot;,&quot;"+wrd+"&quot;)'>Edit </a></td>"
                        +"<td id='deleteCell_"+data+"'><a id='delete_"+data+"' href='javascript:void(0)' onclick='confirm("+data+")' class='btn mini' >Delete</a></td>"
                        +"</tr>";
                    $("#new_row").replaceWith(abbrevRow);    
                } 
                else if(action == "delete"){
                     row = "row_"+id;
                     $('#'+row).remove();        
                }   
                    $("#addNewAbbrevRow").attr("onclick", "addAbbreviationRow()");
                }
            });
        }

function confirm(id){
        
        cellDelete = "<a href='javascript:void(0)' class='btn mini' onclick='updateRow("+id+", &apos;delete&apos;)'>"
        +"Are you Sure</a> <a href='javascript:void(0)' class='btn mini' onclick='cancelDelete("+id+")'> Cancel</a>" ;
        $('#delete_'+id).replaceWith(cellDelete);
}

function cancelDelete(id){
        $('#deleteCell_'+id).html("<a href='javascript:void(0)' id='delete_"+id+"' class='btn mini' onclick='confirm("+id+")'>delete</a>");
}

function addAbbreviationRow() {
        
        abbrevRow = "<tr id='new_row'>"
            +"<td id='abb_new'> <input value='' id='abb'></input> </td>"
            +"<td id='word_new'> <input value='' id='word'></input> </td>"
            +"<td><a id='edit_new' class='btn mini' href='javascript:void(0)' onclick='updateRow(0, &quot;add&quot;)'>Add </a></td>"
            +"<td><p id='delete_new' class='btn mini disabled'>Delete</p></td>"
        +"</tr>";
        $("#tbody").prepend(abbrevRow);
        $("#addNewAbbrevRow").attr("onclick", "javascript:void(0)");

}

function performDbUpdate() {
	$.ajax({
		type : 'POST',
		url : 'update/updateDB.php',
		success : function (param) {
			$('#updating').hide();
			if ( param=="true" ) {
				$('#updateSuccess').show();
				setTimeout("location.href='home.php'",5000);
			} else {
				$('#updateFailure').show();
			}
		}
	});
}

function get_testbox2(stype_id)
{
	//var stype_val = $('#'+stype_id).attr("value");
        var stype_val = stype_id;
        $('#test_list_by_site').show();
	if(stype_val == "")
	{
		$('#test_list_by_site').html("-<?php echo 'Select Facility to display its Test Catalog here'; ?>-");
		return;
	}
	$('#test_list_by_site').html("<?php $page_elems->getProgressSpinner(LangUtil::$generalTerms['CMD_FETCHING']); ?>");
	$('#test_list_by_site').load(
		"ajax/test_list_by_site.php", 
		{
			site_id: stype_val
		}
	);
}

function toggle_div(div_name) {
	$("#"+div_name).hide();
}

function inventory_load()
{
    //$("#inventory_div").load("view_stock.php");
    right_load(15, 'inventory_div');
}

function performUpdate()
{
	$('#updating').show();
	$.ajax({
		type : 'POST',
		url : 'ajax/update.php',
		success : function(data) {
			if ( data=="true" ) {
				performDbUpdate();
			}
			else {
				$('#updating').hide();
				$('#updateFailure').show();
			}
		}
	});
}

function test_setup()
{   
    right_load(2, "test_div");
}

function specimen_rejection_setup()
{   
    right_load(2, "specimen_rejection_div");
}

function report_setup()
{
if(document.getElementById('report_setup').style.display =='none')
$('#report_setup').show();
else
$('#report_setup').hide();

}

function check_compatible()
{
}

function blis_update_t()
{
    $('#update_button').hide();
    $('#update_spinner').show();
    setTimeout( "blis_update();", 5000); 
}

function blis_update()
{
    
    $.ajax({
		type : 'POST',
		url : 'update/blis_update.php',
		success : function(data) {
			if ( data=="true" ) {
                            $('#update_failure').hide();
                            $('#update_spinner').hide();
                            $('#update_success').show();
			}
			else {
                                $('#update_success').hide();

                                $('#update_spinner').hide();
				$('#update_failure').show();
			}
		}
	});
        
    $('#update_button').show();
}

function right_load(option_num, div_id)
{
	$('#name9').attr("value", "<?php echo $lab_config->name; ?>");
	$('#loc9').attr("value", "<?php echo $lab_config->location; ?>");
	$('#misc_errormsg').hide();
	$('.right_pane').hide();
	$('.menu_option').removeClass('current_menu_option');
	$('#'+div_id).show();
	$('#option'+option_num).addClass('current_menu_option');
	if ( option_num == 16 ) {
		//performUpdate();
	}
}

function language_div_load() {
	$('#misc_errormsg').hide();
	$('.right_pane').hide();
	$('.menu_option').removeClass('current_menu_option');
	$('#language_div').show();
	$('#option19').addClass('current_menu_option');
}

function ask_to_delete_user(user_id)
{
	var div_id = 'delete_confirm_'+user_id;
	$('#'+div_id).show();
}

function delete_user(user_id)
{
	var url_string = "ajax/lab_user_delete.php?uid="+user_id;
	var reload_url = "lab_config_home.php?id=<?php echo $lab_config_id; ?>&show_u=1&adel=1";
	$.ajax({ url: url_string, async: false, success: function() {
		window.location=reload_url;
	}});
}

function submit_goal_tat()
{
	$('#tat_progress_spinner').show();
	$('#goal_tat_form').ajaxSubmit({
		success: function() {
			$('#tat_progress_spinner').hide();
			window.location="lab_config_home.php?id=<?php echo $lab_config->id; ?>&tupdate=1";
		}
	});
}

function toggletatdivs()
{
	$('#goal_tat_list').toggle();
	$('#goal_tat_form').toggle();
	var curr_link_text = $('#toggletat_link').html();
	if(curr_link_text == "<?php echo LangUtil::$generalTerms['CMD_EDIT']; ?>")
		$('#toggletat_link').html("<?php echo LangUtil::$generalTerms['CMD_CANCEL']; ?>");
	else
		$('#toggletat_link').html("<?php echo LangUtil::$generalTerms['CMD_EDIT']; ?>");
}

function toggle_disease_report()
{
	$('#agg_report_summary').toggle();
	$('#agg_report_form_div').toggle();
	var curr_link_text = $('#agg_edit_link').html();
	if(curr_link_text == "<?php echo LangUtil::$generalTerms['CMD_EDIT']; ?>")
		$('#agg_edit_link').html("<?php echo LangUtil::$generalTerms['CMD_CANCEL']; ?>");
	else
		$('#agg_edit_link').html("<?php echo LangUtil::$generalTerms['CMD_EDIT']; ?>");
}


function toggle_grouped_count_report()
{
	$('#grouped_count_report_summary').toggle();
	$('#grouped_count_report_form_div').toggle();
	var curr_link_text = $('#grouped_count_edit_link').html();
	if(curr_link_text == "<?php echo LangUtil::$generalTerms['CMD_EDIT']; ?>")
		$('#grouped_count_edit_link').html("<?php echo LangUtil::$generalTerms['CMD_CANCEL']; ?>");
	else
		$('#grouped_count_edit_link').html("<?php echo LangUtil::$generalTerms['CMD_EDIT']; ?>");
}


function toggle_ofield_div()
{
	$('#ofield_summary').toggle();
	$('#ofield_form_div').toggle();
	var curr_link_text = $('#ofield_toggle_link').html();
	if(curr_link_text == "<?php echo LangUtil::$generalTerms['CMD_EDIT']; ?>")
		$('#ofield_toggle_link').html("<?php echo LangUtil::$generalTerms['CMD_CANCEL']; ?>");
	else
		$('#ofield_toggle_link').html("<?php echo LangUtil::$generalTerms['CMD_EDIT']; ?>");
}

function stype_toggle()
{
	$('#stype_box').toggle();
	if($('#stype_link').html() == "Show")
	{
		$('#stype_link').html("Hide");		
	}
	else
	{
		$('#stype_link').html("Show");
	}
}

function ttype_toggle()
{
	$('#ttype_box').toggle();
	if($('#ttype_link').html() == "Show")
	{
		$('#ttype_link').html("Hide");		
	}
	else
	{
		$('#ttype_link').html("Show");
	}
}

function checkandsubmit_st_types()
{
	//Validate
	var stype_entries = $('.stype_entry');
	var stype_selected = false;
	for(var i = 0; i < stype_entries.length; i++)
	{
		if(stype_entries[i].checked)
		{
			stype_selected = true;
			break;
		}
	}
	if(stype_selected == false)
	{
		alert("<?php echo LangUtil::$pageTerms['TIPS_SPECIMENSNOTSELECTED']; ?>");
		return;
	}
	var ttype_entries = $('.ttype_entry');
	var ttype_selected = false;
	for(var i = 0; i < ttype_entries.length; i++)
	{
		if(ttype_entries[i].checked)
		{
			ttype_selected = true;
			break;
		}
	}
	if(ttype_selected == false)
	{
		alert("<?php echo LangUtil::$pageTerms['TIPS_TESTSNOTSELECTED']; ?>");
		return;
	}
	//All okay
	$('#st_types_progress').show();
	$('#st_types_form').ajaxSubmit({success:function(){
			$('#st_types_progress').hide();
			window.location="lab_config_home.php?id=<?php echo $lab_config->id; ?>&stupdate=1";
		}
	});
}

function submit_billing_update()
{
        //Submit stuff to the db here.
        $('#billing_progress').show();
	$('#billing_form').ajaxSubmit({success:function(){
			$('#billing_progress').hide();
			window.location="lab_config_home.php?id=<?php echo $lab_config->id; ?>&billingupdate=1";
		}
	});
}

function delete_config()
{
	var url_string ='ajax/lab_config_delete.php?id=<?php echo $lab_config->id; ?>';
	$.ajax({ url: url_string, async: false, success: function(){
			window.location="lab_configs.php?msg=<?php echo base64_encode($lab_config->getSiteName()." deleted"); ?>";
		}
	});
}

function change_admin()
{
	var admin_user_id = $('#lab_admin').attr('value');
	var url_string = 'ajax/lab_admin_change.php?lid=<?php echo $lab_config->id; ?>&uid='+admin_user_id;
	$.ajax({ url: url_string, async: false, success: function(){
			window.location="lab_config_home.php?id=<?php echo $lab_config->id; ?>&adupdate=1";
		}
	});
}

function agg_checkandsubmit()
{
	//Validate
	//TODO
	//All okay
	$('#agg_progress_spinner').show();
	$('#agg_report_form').ajaxSubmit({
		success: function() {
			$('#agg_progress_spinner').hide();
			window.location="lab_config_home.php?id=<?php echo $lab_config->id; ?>&aggupdate=1";
		}
	});
}

function grouped_checkandsubmit()
{
	//Validate
	//TODO
	//All okay
	$('#grouped_count_progress_spinner').show();
	$('#grouped_count_report_form').ajaxSubmit({
		success: function() {
			$('#grouped_count_progress_spinner').hide();
			window.location="lab_config_home.php?id=<?php echo $lab_config->id; ?>&grouped_count_update=1";
		}
	});
}

function agg_preview()
{
	// Shows preview of infection report in a separate window
	// Clone fields from disease report form to preview form
	$('#agg_preview_form').html($('#agg_report_form').clone(true).html());
	$('#agg_preview_form').submit();
}

function toggle_agegrouplist()
{
	$('#agegrouprow').toggle();
}

function agegrouplist_append()
{
	var html_code = "&nbsp;&nbsp;<input type='text' name='age_l[]' class='range_field'></input>-<input type='text' name='age_u[]' class='range_field'></input>";
	$('#agegrouplist_inner').append(html_code);
}

function t_agegrouplist_append()
{
	var html_code = "&nbsp;&nbsp;<input type='text' name='age_l[]' class='range_field'></input>-<input type='text' name='age_u[]' class='range_field'></input>";
	$('#t_agegrouplist_inner').append(html_code);
}

function s_agegrouplist_append()
{
	var html_code = "&nbsp;&nbsp;<input type='text' name='sp_age_l[]' class='range_field'></input>-<input type='text' name='sp_age_u[]' class='range_field'></input>";
	$('#s_agegrouplist_inner').append(html_code);
}

function add_slot(span_id, field_name1, field_name2)
{
	var html_code = "&nbsp;&nbsp;&nbsp;<input type='text' class='range_field' name='"+field_name1+"[]' value=''></input>-<input type='text' class='range_field' name='"+field_name2+"[]' value=''></input>";
	$('#'+span_id).append(html_code);
}

function misc_checkandsubmit()
{
	//Validate
	$('#misc_errormsg').html("");
	$('#misc_errormsg').hide();
	var name = $('#name9').attr("value");
	var location = $('#loc9').attr("value");
	var err_msg = "";
	if(name.trim() == "")
		err_msg = "<?php echo LangUtil::$generalTerms['TIPS_INCOMPLETEINFO']; ?>";
	else if(location.trim() == "")
		err_msg = "<?php echo LangUtil::$generalTerms['TIPS_INCOMPLETEINFO']; ?>";
	if(err_msg != "")
	{
		$('#misc_errormsg').html(err_msg);
		$('#misc_errormsg').show();
		return;
	}	
	//All okay
	$('#misc_progress').show();
	$('#misc_form').submit();
	/*
	$('#misc_form').ajaxSubmit({
		success: function() {
			$('#misc_progress').hide();
			window.location="lab_config_home.php?id=<?php echo $lab_config->id; ?>&miscupdate=1";
		}
	});
	*/
}

function toggle_dboption_help()
{
	var dboption_val = $("input[name='dboption']:checked").attr("value");
	$('.dboption_help').hide();
	$('.random_params').hide();
	if(dboption_val != 0)
	{
		$('#dboption_help_'+dboption_val).show();
	}
	if(dboption_val == 1)
	{
		$('.random_params').show();
	}
}

function submit_otherfields()
{
	$('#otherfields_progress').show();
	$('#otherfields_form').ajaxSubmit({
		success: function() {
			$('#otherfields_progress').hide();
			window.location="lab_config_home.php?id=<?php echo $lab_config->id; ?>&ofupdate=1";
		}
	});
}

//NC3065
function submit_searchconfig()
{
	$('#searchfields_progress').show();
	$('#searchfields_form').ajaxSubmit({
		success: function() {
			$('#searchfields_progress').hide();
			window.location="lab_config_home.php?id=<?php echo $lab_config->id; ?>&sfcupdate=1";
		}
	});
}
function submit_barcodeconfig()
{
	$('#barcodefields_progress').show();
	$('#barcodefields_form').ajaxSubmit({
		success: function() {
			$('#barcodefields_progress').hide();
			window.location="lab_config_home.php?id=<?php echo $lab_config->id; ?>&brcupdate=1";
		}
	});
}
//-NC3065

function backup_data()
{
	var r=confirm("Do you want to backup?");
	if(r==true)
		$('#backup_form').submit();
	else
		{}
}

function fetch_report_config()
{
	var report_type = $("#report_type11").attr("value");
	var url_string = "ajax/report_config_fetch.php?l=<?php echo $lab_config->id; ?>&rt="+report_type;
	$('#report_config_fetch_progress').show();
	$('#report_config_content').load(url_string, function() {
		$('#report_config_fetch_progress').hide();
	});
}

function hide_report_config()
{
	$('#report_config_content').html("");
}


function fetch_report_summary()
{
	var report_type = $("#report_type11").attr("value");
	var url_string = "ajax/report_config_summary.php?l=<?php echo $lab_config->id; ?>&rt="+report_type;
	$('#report_config_fetch_progress').show();
	$('#report_config_content').load(url_string, function() {
		$('#report_config_fetch_progress').hide();
	});
}

function update_file()
{ 
var report_id = $('#report_type11').attr("value");
	$('#submit_report_config_progress').show();
	$('#report_config_submit_form').ajaxSubmit({
		success: function() {
			$('#submit_report_config_progress').hide();
			window.location="lab_config_home.php?id=<?php echo $lab_config->id; ?>&rcfgupdate="+report_id;
		}
	});
}
 function update_report_config()
{ 
	var report_id = $('#report_type11').attr("value");
	$('#submit_report_config_progress').show();
	$('#report_config_submit_form').ajaxSubmit({
		success: function() {
		$('#submit_report_config_progress').hide();
			window.location="lab_config_home.php?id=<?php echo $lab_config->id; ?>&rcfgupdate="+report_id;
		}
	});
}
function get_test_types_bycat()
{
	var cat_code = $('#cat_code12').attr("value");
	var location_code = <?php echo $lab_config->id; ?>;
	$('#test_type12').load('ajax/tests_selectbycat.php?c='+cat_code+'&l='+location_code+'&all_no');
}

function fetch_worksheet_config()
{
	var cat_code = $('#cat_code12').attr("value");
	var t_type = $('#test_type12').attr("value");
	var url_string = "ajax/worksheet_config_fetch.php?l=<?php echo $lab_config->id; ?>&c="+cat_code+"&t="+t_type;
	$('#worksheet_fetch_progress').show();
	$('#worksheet_config_content').load(url_string, function() {
		$('#worksheet_fetch_progress').hide();
	});
}

function hide_worksheet_config()
{
	$('#worksheet_config_content').html("");
}

function fetch_worksheet_summary()
{
	var cat_code = $('#cat_code12').attr("value");
	var t_type = $('#test_type12').attr("value");
	var url_string = "ajax/worksheet_config_summary.php?l=<?php echo $lab_config->id; ?>&c="+cat_code+"&t="+t_type;
	$('#worksheet_fetch_progress').show();
	$('#worksheet_config_content').load(url_string, function() {
		$('#worksheet_fetch_progress').hide();
	});
}

function update_worksheet_config()
{
	var cat_code = $('#cat_code12').attr("value");
	var t_type = $('#test_type12').attr("value");
	$('#submit_worksheet_config_progress').show();
	$('#worksheet_config_submit_form').ajaxSubmit({
		success: function() {
			$('#submit_worksheet_config_progress').hide();
			window.location="lab_config_home.php?id=<?php echo $lab_config->id; ?>&wcfgupdate="+cat_code+","+t_type;
		}
	});
}

function backup_revert_submit()
{
	// Validate
	// All okay
	$('#backup_revert_progress').show();
	$('#backup_revert_form').submit();
}

function update_database_submit() {
	$('#update_database_progress').show();
	$('#update_database_form').ajaxSubmit(function success(data) {
		window.location = data;
	});

}

function add_title_line()
{
	var html_code = "<input type='text' name='title[]' value='' class='uniform_width_more'></input><br>";
	$('#title_lines').append(html_code);
}

function right_load_1(option_num, div_id)
{
//	$('#misc_errormsg').hide();
	$('.right_pane').hide();
	$('.menu_option').removeClass('current_menu_option');
	$('#'+div_id).show();
	$('#option'+option_num).addClass('current_menu_option');
	
}
</script>
<script type='text/javascript'>
$(document).ready(function(){
	$('#dnum_reset').attr("value", "<?php echo $lab_config->dailyNumReset; ?>");
});										
</script>
<script type='text/javascript'>
$(document).ready(function(){
	if($('#use_pid').is(':checked'))
	{
		$('#use_pid_mand').show();
	}
	if($('#use_p_addl').is(':checked'))
	{
		$('#use_p_addl_mand').show();
	}
	if($('#use_s_addl').is(':checked'))
	{
		$('#use_s_addl_mand').show();
	}
	if($('#use_dnum').is(':checked'))
	{
		$('#use_dnum_mand').show();
	}
	if($('#use_sex').is(':checked'))
	{
		$('#use_sex_mand').show();
	}
	if($('#use_age').is(':checked'))
	{
		$('#use_age_mand').show();
	}
	if($('#use_dob').is(':checked'))
	{
		$('#use_dob_mand').show();
	}
	if($('#use_pid').is(':checked'))
	{
		$('#use_pid_mand').show();
	}
	if($('#use_sid').is(':checked'))
	{
		$('#use_sid_mand').show();
	}
	if($('#use_rdate').is(':checked'))
	{
		$('#use_rdate_mand').show();
	}
	if($('#use_refout').is(':checked'))
	{
		$('#use_refout_mand').show();
	}
	if($('#use_doctor').is(':checked'))
	{
		$('#use_doctor_mand').show();
	}
	if($('#use_pname').is(':checked'))
	{
		$('#use_pname_mand').show();
	}
	if($('#use_comm').is(':checked'))
	{
		$('#use_comm_mand').show();
	}
	$('#use_pid').click(function() {
		if($('#use_pid').is(':checked'))
		{
			$('#use_pid_mand').show();
		}
		else
		{
			$('#use_pid_mand').hide();
		}
	});
	$('#use_p_addl').click(function() {
		if($('#use_p_addl').is(':checked'))
		{
			$('#use_p_addl_mand').show();
		}
		else
		{
			$('#use_p_addl_mand').hide();
		}
	});
	$('#use_dnum').click(function() {
		if($('#use_dnum').is(':checked'))
		{
			$('#use_dnum_mand').show();
		}
		else
		{
			$('#use_dnum_mand').hide();
		}
	});
	$('#use_s_addl').click(function() {
		if($('#use_s_addl').is(':checked'))
		{
			$('#use_s_addl_mand').show();
		}
		else
		{
			$('#use_s_addl_mand').hide();
		}
	});
	$('#use_dnum').click(function() {
		if($('#use_dnum').is(':checked'))
		{
			$('#use_dnum_mand').show();
		}
		else
		{
			$('#use_dnum_mand').hide();
		}
	});
	$('#use_dob').click(function() {
		if($('#use_dob').is(':checked'))
		{
			$('#use_dob_mand').show();
		}
		else
		{
			$('#use_dob_mand').hide();
		}
	});
	$('#use_sid').click(function() {
		if($('#use_sid').is(':checked'))
		{
			$('#use_sid_mand').show();
		}
		else
		{
			$('#use_sid_mand').hide();
		}
	});
	$('#use_sex').click(function() {
		if($('#use_sex').is(':checked'))
		{
			$('#use_sex_mand').show();
		}
		else
		{
			$('#use_sex_mand').hide();
		}
	});
	$('#use_age').click(function() {
		if($('#use_age').is(':checked'))
		{
			$('#use_age_mand').show();
		}
		else
		{
			$('#use_age_mand').hide();
		}
	});
	$('#use_refout').click(function() {
		if($('#use_refout').is(':checked'))
		{
			$('#use_refout_mand').show();
		}
		else
		{
			$('#use_refout_mand').hide();
		}
	});
	$('#use_doctor').click(function() {
		if($('#use_doctor').is(':checked'))
		{
			$('#use_doctor_mand').show();
		}
		else
		{
			$('#use_doctor_mand').hide();
		}
	});
	$('#use_rdate').click(function() {
		if($('#use_rdate').is(':checked'))
		{
			$('#use_rdate_mand').show();
		}
		else
		{
			$('#use_rdate_mand').hide();
		}
	});
	$('#use_comm').click(function() {
		if($('#use_comm').is(':checked'))
		{
			$('#use_comm_mand').show();
		}
		else
		{
			$('#use_comm_mand').hide();
		}
	});
	$('#use_pname').click(function() {
		if($('#use_pname').is(':checked'))
		{
			$('#use_pname_mand').show();
		}
		else
		{
			$('#use_pname_mand').hide();
		}
	});
});

function fetch_remarks_form()
{
    $('#updated_msg').hide();
    var ttype = $("#ttype").attr("value");
    $('#remarks_fetch_progress').show();
    var url_string = "ajax/remarks_form_fetch.php?lid=<?php echo $lab_config->id; ?>&ttype="+ttype;
    $('#remarks_form_pane').load( url_string, {}, function() {
        $('#remarks_fetch_progress').hide();
    });
}

function add_remarks_row(measure_id, range_type)
{
    var html_code = "";
    if(range_type == <?php echo Measure::$RANGE_NUMERIC; ?>)
    {
        html_code = "<tr><td><input type='hidden' name='id_"+measure_id+"[]' value=-2 class='uniform_width_less input-mini'></input>";
        html_code += "<input type='text' name='range_l_"+measure_id+"[]' value='' class='uniform_width_less input-mini'></input>";
        html_code += "-<input type='text' name='range_u_"+measure_id+"[]' value='' class='uniform_width_less input-mini'></input></td>";
        html_code += "<td><input type='text' name='age_l_"+measure_id+"[]' value='' class='uniform_width_less input-mini'></input>";
        html_code += "-<input type='text' name='age_u_"+measure_id+"[]' value='' class='uniform_width_less input-mini'></input></td>";
        html_code += "<td><input type='text' name='gender_"+measure_id+"[]' value='' size='1px' class='input-mini'></input></td>";
        html_code += "<td><input type='text' name='remarks_"+measure_id+"[]' value='' class='uniform_width input-mini'></input></td></tr>";
    }
    var target_table_id = "remarks_table_"+measure_id;
    $('#'+target_table_id).append(html_code);
}

function submit_remarks_form()
{
    //Validate
    var numeric_fields = $(".numeric_range");
    for(var i = 0; i < numeric_fields.length; i++)
    {
        var elem = numeric_fields[i];
        var val = elem.value;
        if(val.trim() != "")
        {
            if(val.trim() != "+" && val.trim() != "-" && isNaN(val))
            {
                //alert("<?php echo LangUtil::$generalTerms['ERROR'].": ".LangUtil::$generalTerms['RANGE']; ?>");
                //return;
            }
        }
    }
    //All okay
    $('#remarks_submit_progress').show();
    $('#remarks_form').ajaxSubmit({ success: function() {
            $('#remarks_submit_progress').hide();
            hide_remarks_form();
            $('#updated_msg').show();
        }
    });
}

function hide_remarks_form()
{
    $('#remarks_form_pane').html("");
}

function import_users(){
	var jsonUrl = '192.168.1.9:8888/sanitas/bliss/getUsers?api_key=ZUJ5EDTBY';
	var importURL='ajax/import_users.php';
	$('#import_users').modal('show');
	var el = jQuery('.portlet .tools a.reload').parents(".portlet");
	App.blockUI(el);
	$.getJSON(  
			importURL,  
	        {url:jsonUrl},  
	        function(json) { 
	        	$('#result').html('');
		         var thead = '<thead><th>User ID</th><th>Username</th><th>Role name</th></thead>';
	        	 $('#result').append(thead);
	        	 var tr;
	             for (var i = 0; i < json.length; i++) {
	                 tr = $('<tr/>');
	                 tr.append("<td>" + json[i].id + "</td>");
	                 tr.append("<td>" + json[i].username + "</td>");
	                 tr.append("<td>" + json[i].roleName + "</td>");
	                 $('#result').append(tr);
	             }
	             $.post(
	             importURL,
	             {users_data:json},
	             function (){
	             }
	    	             
	    	     );
	            App.unblockUI(el);
	            
	        }  
	    ); 
}

</script>
<?php include("includes/footer.php"); ?>

