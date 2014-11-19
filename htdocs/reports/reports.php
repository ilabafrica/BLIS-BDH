<?php 
include("redirect.php");
include("includes/header.php");
LangUtil::setPageId("reports");
db_get_current();
?>

<!-- BEGIN PAGE TITLE & BREADCRUMB-->		
						<h3>
						</h3>
						<ul class="breadcrumb">
							<li><i class='icon-wrench'></i> Reports
							</li>
						</ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
				<!-- END PAGE HEADER-->
<div class='batch_results_subdiv_help' id='batch_results_subdiv_help' style='display:none;'>
	<?php
		//$tips_string = LangUtil::$pageTerms['TIPS_INFECTIONSUMMARY'];
		$tips_string = "If you cannot see any information other than Test Name, Results and the Skip Option, please tell your administrator to configure it from Worksheet Configuration";
		$page_elems->getSideTip(LangUtil::$generalTerms['TIPS'], $tips_string);
	?>
</div>

<!-- BEGIN ROW-FLUID-->   
<div class="row-fluid">
<div class="span12 sortable">
    
<div class="col-lg-7">
<div class="panel panel-primary">
    
    <div class="portlet box blue reports_subdiv" id="user_stats_div" style="display: none">
        <div class="portlet-title" >
                                <h4><i class="icon-reorder"></i><?php echo "User Statistics"; ?></h4>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse"></a>
                                    <a data-toggle="modal" class="config"></a>
                                </div>
        </div>
    <div class="portlet-body" style="height: 400px">
                    <div id='user_stats'>

                    <div class="span3" style="position: absolute;top: 150px;right: 30px;">
                        <!-- BEGIN Portlet PORTLET-->
                        <div class="">
                                            <div class="well text-success">
                                            <?php
                                            //User Statistics
                                            $tips_string = "Display user specific statistics and user activity logs.";
                                            $page_elems->getSideTip(LangUtil::$generalTerms['TIPS'], $tips_string);
                                            echo "<br><br><br>";
                                            ?>
                                                
                                            </div>
                                        </div>
                    </div>
                        <?php $userStats = new UserStats(); ?>
                        <form name="user_stats_form" id="user_stats_form" action="reports_user_stats_all.php" method='post' target='_blank'>
                                    <table cellpadding="4px">
                            
                                <tr valign='top'>
                                    <td><?php echo LangUtil::$generalTerms['FROM_DATE']; ?> </td>
                                    <td>
                                     <div class="input-append date date-picker" data-date="<?php echo date("Y-m-d"); ?>" data-date-format="yyyy-mm-dd"> 
                                           <input class="m-wrap m-ctrl-medium" size="16" name="from-report-date" id="from-date-us" type="text" value="<?php echo date("Y-m-d"); ?>"><span class="add-on"><i class="icon-calendar"></i></span>
                                    </div>
                                    </td>
                                </tr>
                                <tr valign='top'>
                                    <td><?php echo LangUtil::$generalTerms['TO_DATE']; ?> </td>
                                    <td>
                                    <div class="input-append date date-picker" data-date="<?php echo date("Y-m-d"); ?>" data-date-format="yyyy-mm-dd"> 
                                           <input class="m-wrap m-ctrl-medium" size="16" name="to-report-date" id="to-date-us" type="text" value="<?php echo date("Y-m-d"); ?>"><span class="add-on"><i class="icon-calendar"></i></span>
                                    </div>
                                    </td>
                                </tr>
                                
                                                <tr valign='top'>
                                    <td><?php echo "Stat Type" ?></td>
                                     <td>
                                         <div class="controls">
                                            <label class="radio">
                                                <span><input type='radio' id='stat_type' name='stat_type' value='a' onclick="user_radio(1)">
                                                    Collective User Stats
                                                </span>
                                             </label>
                                             
                                             <label class="radio">
                                                <span><input type="radio"  id='stat_type' name='stat_type' value='i' onclick="user_radio(2)">
                                                    Individual User Logs
                                                </span>
                                             </label>
                                         </div>
                                    </td>
                                </tr>
                                       </table>         
                                      <div id='user_stats_all' style='display:none;'>
                                          <table cellpadding="4px">
                                <tr valign='top'>
                                    <td><?php echo LangUtil::$pageTerms['COUNT_TYPE'] ?></td>
                                        <td>
                                           <div class="controls">
                                               
                                            <label class="checkbox">
                                                <span><input type='checkbox' id='count_type_pr' name='count_type_pr' value='Yes' checked>
                                                    Patients Registered
                                            </span>
                                            </label>
                                            <label class="checkbox">
                                                <span><input type='checkbox' id='count_type_sr' name='count_type_sr' value='Yes' checked>
                                                    Specimens Registered
                                            </span>
                                            </label>
                                            <label class="checkbox">
                                                <span><input type='checkbox' id='count_type_tr' name='count_type_tr' value='Yes' checked>
                                                    Tests Registered
                                            </span>
                                            </label>
                                            <label class="checkbox">
                                                <span><input type='checkbox' id='count_type_re' name='count_type_re' value='Yes' checked>
                                                    Results Entered
                                            </span>
                                            </div>
                                        <br>
                                                                
                                    </td>
                                </tr>
                                                <tr>
                                    <td></td>
                                    <td>
                                        <br>
                                        <!--<div class="form-actions">-->
                                        <input type='submit' id='user_stats_all_submit_button' class='btn blue' value='<?php echo LangUtil::$generalTerms['CMD_SUBMIT']; ?>'>
                                        </input>
                                        <!--</div>-->
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        <span id='specimen_count_progress_spinner' style='display:none'>
                                            <?php //$page_elems->getProgressSpinner(LangUtil::$generalTerms['CMD_FETCHING']); ?>
                                        </span>
                                    </td>
                                </tr>
                                             </table>
                                    </div>
                                    <div id='user_stats_individual' style='display:none;'>
                                    <table cellpadding="4px">
                            <?php
                            $site_list = get_site_list($_SESSION['user_id']);
                            //if(count($site_list) == 1)
                                        if(true)
                            {
                                //foreach($site_list as $key=>$value)
                                    //echo "<input type='hidden' name='location' id='location7' value='$key'></input>";
                                            $lab_config_id = $_SESSION['lab_config_id'];
                                               echo "<input type='hidden' name='location' id='location7' value='$lab_config_id'></input>";
                            
                                                $user_ids = array();
                                                array_push($user_ids, $userStats->getAdminUser($lab_config_id));
                                                $user_ids_others =  $userStats->getAllUsers($lab_config_id);
                                                foreach($user_ids_others as $uids)
                                                     array_push($user_ids, $uids);
                                                //print_r($user_ids);
                                        ?>
                                                <tr>
                                    <td><?php echo "User"; ?> </td>
                                    <td>
                                        <select name='user_id' id='user_id' class='uniform_width'>
                                        <?php foreach($user_ids as $uid) {?>
                                           <option value='<?php echo $uid; ?>'><?php echo get_username_by_id($uid); ?></option>    
                                        <?php } ?>
                                                                </select>
                                    </td>
                                </tr>
                                        <?php
                                        }
                            else
                            {
                            ?>
                                <tr>
                                    <td><?php echo LangUtil::$generalTerms['FACILITY']; ?> </td>
                                    <td>
                                        <select name='location' id='location7' class='uniform_width'>
                                        <option value='0'><?php echo LangUtil::$generalTerms['ALL']; ?></option>    
                                        <?php
                                            $page_elems->getSiteOptions();
                                        ?>
                                        </select>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                                
                                <tr valign='top'>
                                    <td><?php echo "Log Type"; ?></td>
                                    <td>
                                        <div class="controls">
                                            <label class="radio">
                                                <span><input type="radio"  id='log_type' name='log_type' value='1' checked>  
                                                   Patients Registry</span>
                                                </label>
                                            <label class="radio">
                                                <span>
                                                    <input type="radio"  id='log_type' name='log_type' value='2'>
                                                    Specimens Registry
                                                </span>
                                            </label>
                                            <label class="radio">
                                                <span>
                                                    <input type="radio"  id='log_type' name='log_type' value='3'>
                                                    Tests Registry
                                                </span>
                                            </label>
                                            <label class="radio">
                                                <span>
                                                    <input type="radio"  id='log_type' name='log_type' value='4'>
                                                    Results Entry
                                                </span>
                                            </label>
                                            <label class="radio">
                                                <span>
                                                    <input type="radio"  id='log_type' name='log_type' value='5'>
                                                    Inventory Transaction
                                                </span>
                                            </label>
                                        </div>                                      
                                        <br>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <br>
                                        <input type='submit' class="btn blue" id='user_stats_individual_submit_button' value='<?php echo LangUtil::$generalTerms['CMD_SUBMIT']; ?>'>
                                        </input>
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        <span id='specimen_count_progress_spinner' style='display:none'>
                                            <?php //$page_elems->getProgressSpinner(LangUtil::$generalTerms['CMD_FETCHING']); ?>
                                        </span>
                                    </td>
                                </tr>
                            </table>
                                    </div>
                        </form>
                    </div>
    </div>
    
    </div>
    
    
    <div class="portlet box blue reports_subdiv" id="disease_report_div" style="display: none">
        <div class="portlet-title" >
                                <h4><i class="icon-reorder"></i><?php echo LangUtil::$pageTerms['MENU_INFECTIONREPORT']; ?></h4>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse"></a>
                                    <a data-toggle="modal" class="config"></a>
                                </div>
        </div>
    <div class="portlet-body" style="height: 400px">
            <div id='disease_report'>
            <div class="span4" style="position: absolute;top: 150px;right: 30px;">
                        <!-- BEGIN Portlet PORTLET-->
                        <div class="">
                                            <div class="well text-success">
                                            <?php
                                            //Infection report
                                            $tips_string = "Select Date range and lab section to view the Infection report";
                                            $page_elems->getSideTip(LangUtil::$generalTerms['TIPS'], $tips_string);
                                            echo "<br><br>";
                                            ?>
                                                
                                            </div>
                                        </div>
                    </div>
                <br><br>
            <form id='disease_report_form' action='report_disease.php' method='post' target='_blank'>
            <table>
                <tbody>
                <?php
                $site_list = get_site_list($_SESSION['user_id']);
                if(count($site_list) == 1)
                {
                    foreach($site_list as $key=>$value)
                        echo "<input type='hidden' name='location' id='location14' value='$key'></input>";
                }
                else
                {
                ?>
                    <tr class="location_row" id="location_row">
                        <td><?php echo LangUtil::$generalTerms['FACILITY']; ?> &nbsp;&nbsp;&nbsp;</td>
                        <td>
                            <select name='location' id='location14' class='uniform_width'>
                            <option value='0'><?php echo LangUtil::$generalTerms['ALL']; ?></option>
                            <?php
                                $page_elems->getSiteOptions();
                            ?>
                            </select>
                        </td>
                    </tr>
                <?php
                }
                ?>
                    <tr class="sdate_row" id="sdate_row" valign='top'>
                        <td><?php echo LangUtil::$generalTerms['FROM_DATE']; ?> </td>
                        <td>
                        <div class="input-append date date-picker" data-date="<?php echo date("Y-m-d"); ?>" data-date-format="yyyy-mm-dd"> 
                                <input class="m-wrap m-ctrl-medium" size="16" name="from-report-date" id="from-date-dr" type="text" value="<?php echo date("Y-m-d"); ?>"><span class="add-on"><i class="icon-calendar"></i></span>
                         </div>
                    </tr>
                    <tr class="edate_row" id="edate_row" valign='top'>
                        <td><?php echo LangUtil::$generalTerms['TO_DATE']; ?>&nbsp;&nbsp;&nbsp;</td>
                        <td>
                        <div class="input-append date date-picker" data-date="<?php echo date("Y-m-d"); ?>" data-date-format="yyyy-mm-dd"> 
                                <input class="m-wrap m-ctrl-medium" size="16" name="to-report-date" id="to-date-dr" type="text" value="<?php echo date("Y-m-d"); ?>"><span class="add-on"><i class="icon-calendar"></i></span>
                         </div>
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo LangUtil::$generalTerms['LAB_SECTION']; ?> &nbsp;&nbsp;&nbsp;</td>
                        <td>
                            <select name='cat_code' id='cat_code14' class='uniform_width'>
                            <option value='0'><?php echo LangUtil::$generalTerms['ALL']; ?></option>
                            <?php
                                    $site_list = get_site_list($_SESSION['user_id']);
                                    if(count($site_list) == 1) 
                                        $page_elems->getTestCategorySelect();
                                    else {
                                        $page_elems->getTestCategoryCountrySelect();
                                    }
                            ?>
                            </select>
                        </td>
                    </tr>
                    <?php
                    $site_list = get_site_list($_SESSION['user_id']);
                    if(count($site_list) == 1) {
                        foreach($site_list as $key=>$value)
                            echo "<input type='hidden' name='location' id='location14' value='$key'></input>";
                    }
                    else { ?>
                    <tr class="location_row" id="location_row">
                        <td><?php echo LangUtil::$generalTerms['FACILITY']; ?> &nbsp;&nbsp;&nbsp;</td>
                        <td id='locationAggregation'>
                            <input type='checkbox' name='locationAgg' id='locationAgg' value='0'><?php echo LangUtil::$generalTerms['ALL']; ?></input>
                            <?php
                                $page_elems->getSiteOptionsCheckBoxes("locationAgg");
                            ?>
                        </td><br>
                    </tr>
                    <?php
                    }
                    ?>
                    <tr>
                        <td></td>
                        <td>
                            <br>
                            <input type='button' class="btn blue" value='<?php echo LangUtil::$generalTerms['CMD_SUBMIT']; ?>' onclick='javascript:get_disease_report()'></input>
                            &nbsp;&nbsp;&nbsp;
                            <span id='disease_report_progress_spinner'  style='display:none;'>
                                <?php $page_elems->getProgressSpinner(LangUtil::$generalTerms['CMD_FETCHING']); ?>
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
            </form>
        </div>
    </div>
            
    </div>
    
    
    <div class="portlet box blue reports_subdiv" id="tat_div" style="display: none">
        <div class="portlet-title" >
                                <h4><i class="icon-reorder"></i><?php echo LangUtil::$pageTerms['MENU_TAT']; ?></h4>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse"></a>
                                    <a data-toggle="modal" class="config"></a>
                                </div>
        </div>
    <div class="portlet-body" style="height: 400px">
            <div id='tat'  >  

                <div class="span5" style="position: absolute;top: 150px;right: 30px;">
                        <!-- BEGIN Portlet PORTLET-->
                        <div class="">
                                            <div class="well text-success">
                                            <?php
                                            //Turnaround time
                                            $tips_string = "Select the date interval to view the average test-wise turn-around times for the lab test reports.";
                                            $page_elems->getSideTip(LangUtil::$generalTerms['TIPS'], $tips_string);
                                            echo "<br><br><br>";
                                            ?>
                                                
                                            </div>
                                        </div>
                    </div>

                <br>
            <form name="tat_form" id="tat_form" action="reports_tat.php" method='post'>
                <table cellpadding="4px">
                <?php
                $site_list = get_site_list($_SESSION['user_id']);
                if(count($site_list) == 1)
                {
                    foreach($site_list as $key=>$value)
                        echo "<input type='hidden' name='location' id='location5' value='$key'></input>";
                }
                else
                {
                ?>
                    <tr>
                        <td><?php echo LangUtil::$generalTerms['FACILITY']; ?> </td>
                        <td>
                            <select name='location' id='location5' class='uniform_width'>
                            <option value='0'><?php echo LangUtil::$generalTerms['ALL']; ?></option>    
                            <?php
                                $page_elems->getSiteOptions();
                            ?>
                            </select>
                        </td>
                    </tr>
                <?php
                }
                ?>
                    <tr valign='top'>
                        <td><?php echo LangUtil::$generalTerms['FROM_DATE']; ?> </td>
                        <td>
                        <div class="input-append date date-picker" data-date="<?php echo date("Y-m-d"); ?>" data-date-format="yyyy-mm-dd"> 
                                <input class="m-wrap m-ctrl-medium" size="16" name="from-report-date" id="from-date-tat" type="text" value="<?php echo date("Y-m-d"); ?>"><span class="add-on"><i class="icon-calendar"></i></span>
                         </div>
                        </td>
                    </tr>
                    <tr valign='top'>
                        <td><?php echo LangUtil::$generalTerms['TO_DATE']; ?> </td>
                        <td>
                        <div class="input-append date date-picker" data-date="<?php echo date("Y-m-d"); ?>" data-date-format="yyyy-mm-dd"> 
                                <input class="m-wrap m-ctrl-medium" size="16" name="to-report-date" id="to-date-tat" type="text" value="<?php echo date("Y-m-d"); ?>"><span class="add-on"><i class="icon-calendar"></i></span>
                         </div>
                        </td>
                    </tr>
                    <tr valign='top'>
                        <td><?php echo LangUtil::$pageTerms['MSG_INCLUDEPENDING']; ?> </td>
                        <td>
                            <div class="controls">
                                <label class="radio">
                                    <span><input type="radio"   name='pending' value='Y' checked>  <?php echo LangUtil::$generalTerms['YES']; ?></span>
                                    </label>
                                </div>
                                <div class="controls">
                                <label class="radio">
                                    <span>
                                        <input type="radio"  name='pending' value='N'> <?php echo LangUtil::$generalTerms['NO']; ?>
                                    </span>
                                </label>
                            </div>
                            
                        </td>
                    </tr>
        
                    <tr>
                        <td></td>
                        <td>
                            <br>
                            <input type='button' class="btn blue" id='tat_submit_button' value='<?php echo LangUtil::$generalTerms['CMD_SUBMIT']; ?>' onclick="javascript:get_tat_report();"></input>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <span id='tat_progress_spinner' style='display:none;'>
                                <?php //$page_elems->getProgressSpinner(LangUtil::$generalTerms['CMD_FETCHING']); ?>
                            </span>
                        </td>
                    </tr>
                </table>
            </form>
    </div>
    </div>
    
    </div>
    
    
    
    <div class="portlet box blue reports_subdiv" id="specimen_count_div" style="display: none">
        <div class="portlet-title" >
                                <h4><i class="icon-reorder"></i>Specimen counts</h4>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse"></a>
                                    <a data-toggle="modal" class="config"></a>
                                </div>
        </div>
    <div class="portlet-body" style="height: 400px">
                <div id='specimen_count'>
                <div class="span3" style="position: absolute;top: 150px;right: 30px;">
                        <!-- BEGIN Portlet PORTLET-->
                        <div class="">
                                            <div class="well text-success">
                                            <?php
                                            $tips_string = "Select date range and type of count required";
                                            $page_elems->getSideTip(LangUtil::$generalTerms['TIPS'], $tips_string);
                                            echo "<br><br>";
                                            ?>
                                                
                                            </div>
                                        </div>
                    </div>
                    
        <br>
        <form name="specimen_count_form" id="specimen_count_form" action="reports_specimencount.php" method='post'>
            <table cellpadding="4px">
            <?php
            $site_list = get_site_list($_SESSION['user_id']);
            if(count($site_list) == 1)
            {
                foreach($site_list as $key=>$value)
                    echo "<input type='hidden' name='location' id='location7' value='$key'></input>";
            }
            else
            {
            ?>
                <tr>
                    <td><?php echo LangUtil::$generalTerms['FACILITY']; ?> </td>
                    <td>
                        <select name='location' id='location7' class='uniform_width'>
                        <option value='0'><?php echo LangUtil::$generalTerms['ALL']; ?></option>    
                        <?php
                            $page_elems->getSiteOptions();
                        ?>
                        </select>
                    </td>
                </tr>
            <?php
            }
            ?>
                <tr valign='top'>
                    <td><?php echo LangUtil::$generalTerms['FROM_DATE']; ?> </td>
                    <td>
                    <div class="input-append date date-picker" data-date="<?php echo date("Y-m-d"); ?>" data-date-format="yyyy-mm-dd"> 
                            <input class="m-wrap m-ctrl-medium" size="16" name="from-report-date" id="from-date-count" type="text" value="<?php echo date("Y-m-d"); ?>"><span class="add-on"><i class="icon-calendar"></i></span>
                     </div>
                    </td>
                </tr>
                <tr valign='top'>
                    <td><?php echo LangUtil::$generalTerms['TO_DATE']; ?> </td>
                    <td>
                    <div class="input-append date date-picker" data-date="<?php echo date("Y-m-d"); ?>" data-date-format="yyyy-mm-dd"> 
                            <input class="m-wrap m-ctrl-medium" size="16" name="to-report-date" id="to-date-count" type="text" value="<?php echo date("Y-m-d"); ?>"><span class="add-on"><i class="icon-calendar"></i></span>
                     </div>
                    </td>
                </tr>
                
                <tr valign='top'>
                    <td><?php echo LangUtil::$pageTerms['COUNT_TYPE']; ?></td>
                    <td>
                        <div class="controls">
                        <label class="radio">
                            <span><input type="radio"  id='count_type' name='count_type' value='2' checked>  <?php echo LangUtil::$pageTerms['COUNT_TEST']." (Ungrouped)"; ?></span>
                            </label>
                        </div>
                        <div class="controls">
                        <label class="radio">
                            <span>
                                <input type="radio"  id='count_type' name='count_type' value='4'> <?php echo LangUtil::$pageTerms['COUNT_TEST']." (Grouped)"; ?>
                            </span>
                        </label>
                        </div>
                        <div class="controls">
                        <label class="radio">
                            <span>
                                <input type="radio"  id='count_type' name='count_type' value='1'>  <?php echo LangUtil::$pageTerms['COUNT_SPECIMEN']." (Ungrouped)"; ?>
                            </span>
                        </label>
                        </div>
                        <div class="controls">
                        <label class="radio">
                            <span>
                                <input type="radio" id='count_type' name='count_type' value='5'>  <?php echo LangUtil::$pageTerms['COUNT_SPECIMEN']." (Grouped)"; ?>
                            </span>
                        </label>
                        </div>
                        <div class="controls">
                        <label class="radio">
                            <span>
                                <input type="radio" id='count_type' name='count_type' value='3'> Doctor Statistics
                            </span>
                        </label>
                        </div>
                    </td>
                </tr>
                
                <tr>
                    <td></td>
                    <td>
                        <br>
                        <input type='button' class="btn blue" id='specimen_count_submit_button' value='<?php echo LangUtil::$generalTerms['CMD_SUBMIT']; ?>' onclick='javascript:get_count_report()'>
                        </input>
                        <!--
                        --Merged into single submit button--
                        <input type='button' id='specimen_count_submit_button' value='Specimen Count' onclick="javascript:get_specimen_count_report();"></input>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <input type='button' value='Test Count' onclick="javascript:get_tests_done_report2();"></input>
                        -->
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <span id='specimen_count_progress_spinner' style='display:none'>
                            <?php $page_elems->getProgressSpinner(LangUtil::$generalTerms['CMD_FETCHING']); ?>
                        </span>
                    </td>
                </tr>
            </table>
        </form>
    </div>
    </div>
        
    </div>
    
	<div class="portlet box blue reports_subdiv" id="test_history_div" style="display: none">
        <div class="portlet-title" >
                                <h4><i class="icon-reorder"></i>Patient Report</h4>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse"></a>
                                    <a data-toggle="modal" class="config"></a>
                                </div>
        </div>
    <div class="portlet-body" style="height: 400px">           
        <div id='test_history'>
            <div class='reports_subdiv_help' id='test_history_div_help' style='display:none'>
                
                <div class="span4" style="position: absolute;top: 150px;right: 30px;">
                        <!-- BEGIN Portlet PORTLET-->
                        <div class="">
                                            <div class="well text-success">
                                            <?php
                                            $tips_string = "Select Patient Name, Number or ID to retrieve patient's lab reports";
                                            $page_elems->getSideTip(LangUtil::$generalTerms['TIPS'], $tips_string);
                                            echo "<br><br>";
                                            ?>
                                                
                                            </div>
                                        </div>
                    </div>
                    
                    
            </div>
            <form name='test_history_form' id='test_history_form'>
                <table cellpadding='4px'>
                <?php
                $site_list = get_site_list($_SESSION['user_id']);
                if(count($site_list) == 1)
                {
                    foreach($site_list as $key=>$value)
                        echo "<input type='hidden' name='location' id='location8' value='$key'></input>";
                }
                else
                {
                ?>
                    <tr class="location_row" id="location_row">
                        <td><?php echo LangUtil::$generalTerms['FACILITY']; ?></td>
                        <td>
                            <select name='location' id='location8' class='uniform_width'>
                            <option value='0'><?php echo LangUtil::$generalTerms['ALL']; ?></option>
                            <?php
                                $page_elems->getSiteOptions();
                            ?>
                            </select>
                        </td>
                    </tr>
                <?php
                }
                ?>
                    <tr>
                    <?php
                        /*echo "<td>
                        <select name='p_attrib' id='p_attrib' style='font-family:Tahoma;'>
                            <?php $page_elems->getPatientSearchAttribSelect(); ?>
                        </select>

                        </td>";*/
                        ?>
                        <td>
                            <input type='text' name='patient_id' id='patient_id8' placeholder='Enter Search Value e.g. Wasike or 220412' class='uniform_width'></input>
                        </td>
                    
                        <td>
                            <input type='button' class="btn blue" id='submit_button8' name='test_history_button' value='<?php echo LangUtil::$generalTerms['CMD_SEARCH']; ?>' onclick='search_patient_history();'></input>
                            &nbsp;&nbsp;&nbsp;
                            <span id='test_history_progress_spinner'  style='display:none;'>
                                <?php $page_elems->getProgressSpinner(LangUtil::$generalTerms['CMD_SEARCHING']); ?>
                            </span>
                        </td>
                    </tr>
                </table>
                <br>
                <div id='phistory_list'>
                </div>
            </form>
        </div>
    </div>
    </div>
    
    <div class="portlet box blue reports_subdiv" id="daily_report_div" style="display: none">
        <div class="portlet-title" >
                                <h4><i class="icon-reorder"></i>Daily Log</h4>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse"></a>
                                    <a data-toggle="modal" class="config"></a>
                                </div>
        </div>
    <div class="portlet-body" style="height: 400px">   
    <div id='daily_report'>
    <div class="span3" style="position: absolute;top: 150px;right: 30px;">
                        <!-- BEGIN Portlet PORTLET-->
                        <div class="">
                                            <div class="well text-success">
                                            <?php
                                            //Daily Log
                                            $tips_string = LangUtil::$pageTerms['TIPS_DAILYLOGS'];
                                            $page_elems->getSideTip(LangUtil::$generalTerms['TIPS'], $tips_string);
                                            echo "<br><br>";
                                            ?>
                                                
                                            </div>
                                        </div>
                    </div>
        <table cellpadding='4px'>
            <tbody>
            <?php
            $site_list = get_site_list($_SESSION['user_id']);
            if(count($site_list) == 1)
            {
                foreach($site_list as $key=>$value)
                    echo "<input type='hidden' name='location' id='location13' value='$key'></input>";
            }
            else
            {
            ?>
                <tr class="location_row" id="location_row">
                    <td><?php echo LangUtil::$generalTerms['FACILITY']; ?> &nbsp;&nbsp;&nbsp;</td>
                    <td>
                        <select name='location' id='location13' class='uniform_width' onchange='handleChange(this)'>
                        <option value='0'><?php echo LangUtil::$generalTerms['ALL']; ?></option>
                        <?php
                            $page_elems->getSiteOptions();
                        ?>
                        </select>
                    </td>
                </tr>
            <?php
            }
            ?>
                <tr>
                    <td><?php echo LangUtil::$generalTerms['FROM_DATE']; ?></td>
                    <td>
                        <div class="input-append date date-picker" data-date="<?php echo date("Y-m-d"); ?>" data-date-format="yyyy-mm-dd"> 
                            <input class="m-wrap m-ctrl-medium" size="16" name="from-report-date" id="from-date" type="text" value="<?php echo date("Y-m-d"); ?>"><span class="add-on"><i class="icon-calendar"></i></span>
                        </div>
                    </td>
                </tr>
                
                <tr>
                    <td><?php echo LangUtil::$generalTerms['TO_DATE']; ?></td>
                    <td>
                    <div class="input-append date date-picker" data-date="<?php echo date("Y-m-d"); ?>" data-date-format="yyyy-mm-dd"> 
                            <input class="m-wrap m-ctrl-medium" size="16" name="to-report-date" id="to-date" type="text" value="<?php echo date("Y-m-d"); ?>"><span class="add-on"><i class="icon-calendar"></i></span>
                     </div>
                    </td>
                </tr>
                
                <tr valign='top'>
                    <td><?php echo LangUtil::$generalTerms['RECORDS']; ?> &nbsp;&nbsp;&nbsp;</td>
                    <td>
                        <div class="controls">
                        <label class="radio">
                            <span><input type='radio'  name='rectype13' id="testRec" value='1' checked> <?php echo LangUtil::$generalTerms['RECORDS_TEST']; ?></span>
                            </label>
                        </div>
                        <div class="controls">
                        <label class="radio">
                            <span>
                                <input type="radio" name='rectype13' id="patRec" value='2'> <?php echo LangUtil::$generalTerms['RECORDS_PATIENT']; ?>
                            </span>
                        </label>
                        </div>
                        <div class="controls">
                        <label class="radio">
                            <span>
                                <input type="radio" name='rectype13' value='3'> <?php echo "Rejected Specimen"; ?>
                            </span>
                        </label>
                        </div>
                        <div class="controls">
                        <label class="radio">
                            <span>
                                <input type="radio" name='rectype13' id="refRec" value='4'> <?php echo "Referred Specimen"; ?>
                            </span>
                        </label>
                        </div>
                    </td>
                </tr>
                <tr id='cat_row13'>
                    <td><?php echo LangUtil::$generalTerms['LAB_SECTION']; ?> &nbsp;&nbsp;&nbsp;</td>
                    <td>
                        <select name='cat_code' id='cat_code13' class='uniform_width'>
                            <option value='0'><?php echo LangUtil::$generalTerms['ALL']; ?></option>
                            <?php
                            if( is_country_dir( get_user_by_id($_SESSION['user_id'] ) ) )
                                $page_elems->getTestCategoryCountrySelect();
                            else {
                                $page_elems->getTestCategorySelect();
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr id='ttype_row13'>
                    <td><?php echo LangUtil::$generalTerms['TEST']; ?></td>
                    <td>
                        <select name='ttype' id='ttype13' class='uniform_width'>
                            <option value='0'><?php echo LangUtil::$generalTerms['ALL']; ?></option>
                        </select>
                    </td>
                </tr>
                <tr id='status_row13'>
                    <td>Referred in/out? </td>
                    <td>
                       <div class="controls">
                            <label class="radio">
                                <span><input type='radio' id='status_referral1' name='status_referral' value='2'>
                                    In
                                </span>
                             </label>
                             
                             <label class="radio">
                                <span><input type="radio"  id='status_referral2' name='status_referral' value='3'>
                                    Out
                                </span>
                             </label>
                         </div>
                    </td>
                </tr>
                <tr id='hosp_row13'>
                    <td>Facility referred</td>
                    <td>
                        <select name='ttype' id='facility13' class='uniform_width'>
                            <option value='0'><?php echo LangUtil::$generalTerms['ALL']; ?></option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type='button' class="btn blue" value='<?php echo LangUtil::$generalTerms['CMD_SUBMIT']; ?>' onclick='javascript:print_daily_log()'></input>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    </div>
    </div>
    
    <div class="portlet box blue reports_subdiv" id="summary_div" style="display: none">
        <div class="portlet-title" >
                                <h4><i class="icon-reorder"></i>Prevalence rate</h4>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse"></a>
                                    <a data-toggle="modal" class="config"></a>
                                </div>
        </div>
        <div class="portlet-body" style="height: 400px"> 
        <div id='prevalence_rate' >
            <?php echo getStartDate();?>

            <div class="span4" style="position: absolute;top: 150px;right: 30px;">
                        <!-- BEGIN Portlet PORTLET-->
                        <div class="">
                                            <div class="well text-success">
                                            <?php
                                            //Prevelance Rate
                                            $tips_string = "Select the date range to view the infection graph and prevalence rates.";
                                            $page_elems->getSideTip(LangUtil::$generalTerms['TIPS'], $tips_string);
                                            echo "<br><br><br>";
                                            ?>
                                                
                                            </div>
                                        </div>
                    </div>

            <form name="get_summary" id="get_summary" action="reports_infection.php" method='post'>
            <table cellpadding="4px">
            <?php
            $site_list = get_site_list($_SESSION['user_id']);
            if(count($site_list) == 1)
            {
                foreach($site_list as $key=>$value)
                echo "<input type='hidden' name='location' id='location2' value='$key'></input>";
            }
            else
            {

            ?>
            
                <tr class="location_row" id="location_row">
                <td><?php echo LangUtil::$generalTerms['FACILITY']; ?> </td>
                <td>
                    <select name='location' id='location2' class='uniform_width'>
                    <option value='0'><?php echo LangUtil::$generalTerms['ALL']; ?></option>
                    <?php
                        $page_elems->getSiteOptions();
                    ?>
                    </select>
                </td>
                </tr>
            <?php
            }
            ?>
                <tr valign='top'>
                    <td><?php echo LangUtil::$generalTerms['FROM_DATE']; ?> </td>
                    <td>
                   <div class="input-append date date-picker" data-date="<?php echo date("Y-m-d"); ?>" data-date-format="yyyy-mm-dd"> 
                            <input class="m-wrap m-ctrl-medium" size="16" name="from-report-date" id="from-date-prev" type="text" value="<?php echo date("Y-m-d"); ?>"><span class="add-on"><i class="icon-calendar"></i></span>
                     </div>
                    </td>
                </tr>
                <tr valign='top'>
                    <td><?php echo LangUtil::$generalTerms['TO_DATE']; ?> </td>
                    <td>
                    <div class="input-append date date-picker" data-date="<?php echo date("Y-m-d"); ?>" data-date-format="yyyy-mm-dd"> 
                            <input class="m-wrap m-ctrl-medium" size="16" name="to-report-date" id="to-date-prev" type="text" value="<?php echo date("Y-m-d"); ?>"><span class="add-on"><i class="icon-calendar"></i></span>
                     </div>
                    </td>
                </tr>
            <?php
            if ( count($site_list) > 1 ) { ?>
                <tr id='testType'>
                    <td><?php echo LangUtil::$generalTerms['TEST_TYPE']; ?></td>
                    <td>
                        <select name='ttype' id='ttype' class='uniform_width' onchange='changeAvailableLocations(this)'>
                            <option value='0'><?php echo LangUtil::$generalTerms['ALL']; ?></option>
                            <?php
                                $page_elems->getTestTypesCountrySelect();
                            ?>
                        </select>
                    </td>
                </tr>
                <tr class="location_row_aggregate" id="location_row_aggregate">
                    <td><?php echo LangUtil::$generalTerms['FACILITY']; ?> &nbsp;&nbsp;&nbsp;</td>
                    <td id='locationAggregation'>
                        <input type='checkbox' name='locationAgg' id='locationAgg' value='0'><?php echo LangUtil::$generalTerms['ALL']; ?></input>
                        <?php
                            $page_elems->getSiteOptionsCheckBoxes("locationAgg");
                        ?>
                    </td>
                </tr>
                <?php
            } else {
                foreach($site_list as $key=>$value)
                echo "<input type='hidden' name='location' id='location2' value='$key'></input>";
            }
            ?>
                <tr>
                    <td style="visibility: hidden">
                       <input type="radio" name="summary_type" id="summary_type" VALUE="C"  style="display: none" checked="" autocomplete="on" />
                        &nbsp;&nbsp;
                        <input type="radio" name="summary_type" style="display:none;" VALUE="M" autocomplete="on"/>
                    </td>
                    <td>
                        <br>
                        <input type="button" class="btn blue" value="<?php echo LangUtil::$generalTerms['CMD_SUBMIT']; ?>" onclick="get_summary_fn(0);"/>
                        &nbsp;&nbsp;
                        <!--<input type="button" value="View Monthly" onclick="get_summary_fn(1);"/>-->
                        <!--<br><br>-->
                        <span id='summary_progress_bar'  style='display:none;'>
                            <?php $page_elems->getProgressSpinner(LangUtil::$generalTerms['CMD_FETCHING']); ?>
                        </span>
                    </td>
                </tr>
            </table>
        </form>
    </div>
    </div>
    </div>
    
        
<table name="page_panes" cellpadding="10px">
	<tr valign='top'>	
	<td id="right_pane" class="right_pane" valign='top'>
	<div id='reports_div' style='display:none;' class='reports_subdiv'>
		<b>Patient Results Report</b>
		<br><br>
		<form name="get_patient_report" id="get_patient_report" action="reports_patient.php" method='post'>
			<table cellpadding="4px">
				<tr class="location_row" id="location_row">
					<td><?php echo LangUtil::$generalTerms['FACILITY']; ?> </td>
					<td>
						<?php
						$site_list = get_site_list($_SESSION['user_id']);
						if(count($site_list) == 1)
						{
							foreach($site_list as $key=>$value)
								echo "<input type='hidden' name='location' id='location' value='$key'></input>";
						}
						else
						{
						?>
							<select name='location' id='location' class='uniform_width'>
							<option value='0'><?php echo LangUtil::$generalTerms['ALL']; ?></option>
							<?php
								$page_elems->getSiteOptions();
							?>
							</select>
						<?php
						}
						?>
					</td>
				</tr>
			
				<?php
				$today = date("Y-m-d");
				$today_array = explode("-", $today);
				$monthago_date = date("Y-m-d", strtotime(date("Y-m-d", strtotime($today)) . " -270 days"));//getStartDate();
				$monthago_array = explode("-", $monthago_date);
				?>
			
				<tr class="type_row" id="type_row">
					<td><?php echo LangUtil::$generalTerms['TEST_TYPE']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td> 
					<td>
						<SELECT NAME="t_type" id="t_type" class='uniform_width'>
							<OPTION VALUE='' selected='selected'>Select..</option>
						</SELECT>
					</td>
				</tr>
				
				<tr class="sdate_row" id="sdate_row" valign='top'>
					<td><?php echo LangUtil::$generalTerms['FROM_DATE']; ?> </td>
					<td>
					<?php
// 						$name_list = array("yyyy_from", "mm_from", "dd_from");
// 						$id_list = $name_list;
// 						$value_list = $monthago_array;
// 						$page_elems->getDatePicker($name_list, $id_list, $value_list); 
					?>
					</td>
				</tr>
			
				<tr class="edate_row" id="edate_row" valign='top'>
					<td><?php echo LangUtil::$generalTerms['TO_DATE']; ?>&nbsp;&nbsp;&nbsp;</td>
					<td>
					<?php
// 						$name_list = array("yyyy_to", "mm_to", "dd_to");
// 						$id_list = $name_list;
// 						$value_list = $today_array;
// 						$page_elems->getDatePicker($name_list, $id_list, $value_list); 
					?>
					</td>
				</tr>
				
				<tr>
					<td>
					</td>
					<td>
						<br>
						<input type="button"  class="btn blue" value="<?php echo LangUtil::$generalTerms['CMD_SUBMIT']; ?>" onclick="get_patient_reports();"/>
						&nbsp;&nbsp;&nbsp;&nbsp;
						<span id='report_progress_bar' style='display:none;'>
							<?php //$page_elems->getProgressSpinner(LangUtil::$generalTerms['CMD_FETCHING']); ?>
						</span>
					</td>
				</tr>
			</table>
		</form>
	</div>
	
	
	
	<div id='pending_tests_div'  style='display:none;' class='reports_subdiv'>
		<b><?php echo LangUtil::$pageTerms['MENU_PENDINGTESTS']; ?></b>
		<?php
		if($SHOW_TESTRECORD_REPORT === true)
		{
			?>
			 |
			<a href='javascript:show_print_form()'><?php echo LangUtil::$pageTerms['MENU_TESTRECORDS']; ?></a>
			<?php
		}
		?>
		<br><br>
		<form name="pending_tests_form" id="pending_tests_form" action="reports_pending.php" method='post'>
			<table cellpadding="4px">
			<?php
			$site_list = get_site_list($_SESSION['user_id']);
			if(count($site_list) == 1)
			{
				foreach($site_list as $key=>$value)
					echo "<input type='hidden' name='location' id='location3' value='$key'></input>";
			}
			else
			{
			?>
				<tr class="location_row" id="location_row">
					<td><?php echo LangUtil::$generalTerms['FACILITY']; ?> </td>
					<td>
						<select name='location' id='location3' class='uniform_width'>
						<option value='0'><?php echo LangUtil::$generalTerms['ALL']; ?></option>
						<?php
								$page_elems->getSiteOptions();
						?>
						</select>
					</td>
				</tr>
			<?php
			}
			?>
				<tr>
					<td><?php echo LangUtil::$generalTerms['TEST_TYPE']; ?></td>
					<td>
						<select name='test_type' id='t_type3' class='uniform_width'>
							<OPTION VALUE='' selected='selected'>Select..</option>
						</select>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<br>
						<input type='button'  class="btn blue" id='pending_submit_button' value='<?php echo LangUtil::$generalTerms['CMD_SUBMIT']; ?>' onclick="javascript:get_pending_report();"></input>
						&nbsp;&nbsp;&nbsp;&nbsp;
						<span id='pending_progress_spinner' style='display:none;'>
							<?php //$page_elems->getProgressSpinner(LangUtil::$generalTerms['CMD_FETCHING']); ?>
						</span>
					</td>
				</tr>
			</table>
		</form>
	</div>
	
	<div id='doctors_stats_div' style='display:none;' class='reports_subdiv'>
		<b>Test Count Report</b>
		<br><br>
		<form name="doctors_stats_form" id="doctors_stats_form" action="doctor_stats.php" method='post'>
		<table cellpadding="4px">
		<?php
			$site_list = get_site_list($_SESSION['user_id']);
			if(count($site_list) == 1)
			{
				foreach($site_list as $key=>$value)
					echo "<input type='hidden' name='location' id='location8' value='$key'></input>";
			}

			else
			{
			?>
			<tr>
					<td><?php echo LangUtil::$generalTerms['FACILITY']; ?> </td>
					<td>
						<select name='location' id='location8' class='uniform_width'>
						<option value='0'><?php echo LangUtil::$generalTerms['ALL']; ?></option>
						<?php
							$page_elems->getSiteOptions();
						?>
						</select>
					</td>
				</tr>
			<?php
			}
			?>
				<tr valign='top'>
					<td><?php echo LangUtil::$generalTerms['FROM_DATE']; ?> </td>
					<td>
					<div class="input-append date date-picker" data-date="<?php echo date("Y-m-d"); ?>" data-date-format="yyyy-mm-dd"> 
                            <input class="m-wrap m-ctrl-medium" size="16" name="from-report-date" id="from-date-doctordiv" type="text" value="<?php echo date("Y-m-d"); ?>"><span class="add-on"><i class="icon-calendar"></i></span>
                     </div>
					</td>
				</tr>
				<tr valign='top'>
					<td><?php echo LangUtil::$generalTerms['TO_DATE']; ?> </td>
					<td>
					<div class="input-append date date-picker" data-date="<?php echo date("Y-m-d"); ?>" data-date-format="yyyy-mm-dd"> 
                            <input class="m-wrap m-ctrl-medium" size="16" name="to-report-date" id="to-date-doctordiv" type="text" value="<?php echo date("Y-m-d"); ?>"><span class="add-on"><i class="icon-calendar"></i></span>
                     </div>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
					<br>
						<input type='button' class="btn blue" id='tests_done_submit_button' value='<?php echo LangUtil::$generalTerms['CMD_SUBMIT']; ?>' onclick="javascript:get_doctor_stats();"></input>
						&nbsp;&nbsp;&nbsp;&nbsp;
						<span id='tests_done_progress_spinner' style='display:none'>
							<!--<?php // $page_elems->getProgressSpinner(LangUtil::$generalTerms['CMD_FETCHING']); ?>-->
						</span>
					</td>
				</tr>
			</table>
		</form>
	</div>
	
	<div id='tests_done_div' style='display:none;' class='reports_subdiv'>
		<b>Test Count Report</b>
		<br><br>
		<form name="tests_done_form" id="tests_done_form" action="reports_tests_done.php" method='post'>
		<table cellpadding="4px">
		<?php
			$site_list = get_site_list($_SESSION['user_id']);
			if(count($site_list) == 1)
			{
				foreach($site_list as $key=>$value)
					echo "<input type='hidden' name='location' id='location4' value='$key'></input>";
			}
			else
			{
			?>
			<tr>
					<td><?php echo LangUtil::$generalTerms['FACILITY']; ?> </td>
					<td>
						<select name='location' id='location4' class='uniform_width'>
						<option value='0'><?php echo LangUtil::$generalTerms['ALL']; ?></option>
						<?php
							$page_elems->getSiteOptions();
						?>
						</select>
					</td>
				</tr>
			<?php
			}
			?>
				<tr valign='top'>
					<td><?php echo LangUtil::$generalTerms['FROM_DATE']; ?> </td>
					<td>
					 <div class="input-append date date-picker" data-date="<?php echo date("Y-m-d"); ?>" data-date-format="yyyy-mm-dd"> 
                            <input class="m-wrap m-ctrl-medium" size="16" name="from-report-date" id="from-date-testdone" type="text" value="<?php echo date("Y-m-d"); ?>"><span class="add-on"><i class="icon-calendar"></i></span>
                     </div>
					</td>
				</tr>
				<tr valign='top'>
					<td><?php echo LangUtil::$generalTerms['TO_DATE']; ?> </td>
					<td>
					 <div class="input-append date date-picker" data-date="<?php echo date("Y-m-d"); ?>" data-date-format="yyyy-mm-dd"> 
                            <input class="m-wrap m-ctrl-medium" size="16" name="to-report-date" id="to-date-testdone" type="text" value="<?php echo date("Y-m-d"); ?>"><span class="add-on"><i class="icon-calendar"></i></span>
                     </div>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
					<br>
						<input type='button'  class="btn blue" id='tests_done_submit_button' value='<?php echo LangUtil::$generalTerms['CMD_SUBMIT']; ?>' onclick="javascript:get_tests_done_report();"></input>
						&nbsp;&nbsp;&nbsp;&nbsp;
						<span id='tests_done_progress_spinner' style='display:none'>
							<?php // $page_elems->getProgressSpinner(LangUtil::$generalTerms['CMD_FETCHING']); ?>
						</span>
					</td>
				</tr>
			</table>
		</form>
	</div>
	
        <div id='testcount_grouped_div' style='display:none;' class='reports_subdiv'>
		<b>Test Count Report</b>
		<br><br>
		<form name="testcount_grouped_form" id="testcount_grouped_form" action="reports_testcount_grouped.php" method='post' target='_blank'>
		<table cellpadding="4px">
		<?php
			$site_list = get_site_list($_SESSION['user_id']);
			if(count($site_list) == 1)
			{
				foreach($site_list as $key=>$value)
					echo "<input type='hidden' name='location' id='location44' value='$key'></input>";
			}
			else
			{
			?>
			<tr>
					<td><?php echo LangUtil::$generalTerms['FACILITY']; ?> </td>
					<td>
						<select name='location' id='location44' class='uniform_width'>
						<option value='0'><?php echo LangUtil::$generalTerms['ALL']; ?></option>
						<?php
							$page_elems->getSiteOptions();
						?>
						</select>
					</td>
				</tr>
			<?php
			}
			?>
				<tr valign='top'>
					<td><?php echo LangUtil::$generalTerms['FROM_DATE']; ?> </td>
					<td>
					<div class="input-append date date-picker" data-date="<?php echo date("Y-m-d"); ?>" data-date-format="yyyy-mm-dd"> 
                            <input class="m-wrap m-ctrl-medium" size="16" name="from-report-date" id="from-date-testcgrouped" type="text" value="<?php echo date("Y-m-d"); ?>"><span class="add-on"><i class="icon-calendar"></i></span>
                     </div>
					</td>
				</tr>
				<tr valign='top'>
					<td><?php echo LangUtil::$generalTerms['TO_DATE']; ?> </td>
					<td>
					<div class="input-append date date-picker" data-date="<?php echo date("Y-m-d"); ?>" data-date-format="yyyy-mm-dd"> 
                            <input class="m-wrap m-ctrl-medium" size="16" name="to-report-date" id="to-date-testcgrouped" type="text" value="<?php echo date("Y-m-d"); ?>"><span class="add-on"><i class="icon-calendar"></i></span>
                     </div>
				</tr>
				<tr>
					<td></td>
					<td>
					<br>
						<input type='button' class="btn blue" id='testcount_grouped_submit_button' value='<?php echo LangUtil::$generalTerms['CMD_SUBMIT']; ?>' onclick="javascript:get_tests_done_report();" ></input>
						&nbsp;&nbsp;&nbsp;&nbsp;
						<span id='tests_done_progress_spinner' style='display:none'>
							<?php // $page_elems->getProgressSpinner(LangUtil::$generalTerms['CMD_FETCHING']); ?>
						</span>
					</td>
				</tr>
			</table>
		</form>
	</div>
            
        <div id='specimencount_grouped_div' style='display:none;' class='reports_subdiv'>
		<b>Test Count Report</b>
		<br><br>
		<form name="specimencount_grouped_form" id="specimencount_grouped_form" action="reports_specimencount_grouped.php" method='post' target='_blank'>
		<table cellpadding="4px">
		<?php
			$site_list = get_site_list($_SESSION['user_id']);
			if(count($site_list) == 1)
			{
				foreach($site_list as $key=>$value)
					echo "<input type='hidden' name='location' id='location444' value='$key'></input>";
			}
			else
			{
			?>
			<tr>
					<td><?php echo LangUtil::$generalTerms['FACILITY']; ?> </td>
					<td>
						<select name='location' id='location444' class='uniform_width'>
						<option value='0'><?php echo LangUtil::$generalTerms['ALL']; ?></option>
						<?php
							$page_elems->getSiteOptions();
						?>
						</select>
					</td>
				</tr>
			<?php
			}
			?>
				<tr valign='top'>
					<td><?php echo LangUtil::$generalTerms['FROM_DATE']; ?> </td>
					<td>
					<div class="input-append date date-picker" data-date="<?php echo date("Y-m-d"); ?>" data-date-format="yyyy-mm-dd"> 
                            <input class="m-wrap m-ctrl-medium" size="16" name="from-report-date" id="from-date-scgrouped" type="text" value="<?php echo date("Y-m-d"); ?>"><span class="add-on"><i class="icon-calendar"></i></span>
                     </div>
					</td>
				</tr>
				<tr valign='top'>
					<td><?php echo LangUtil::$generalTerms['TO_DATE']; ?> </td>
					<td>
					<div class="input-append date date-picker" data-date="<?php echo date("Y-m-d"); ?>" data-date-format="yyyy-mm-dd"> 
                            <input class="m-wrap m-ctrl-medium" size="16" name="to-report-date" id="to-date-scgrouped" type="text" value="<?php echo date("Y-m-d"); ?>"><span class="add-on"><i class="icon-calendar"></i></span>
                     </div>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
					<br>
						<input type='button' class="btn blue" id='specimencount_grouped_submit_button' value='<?php echo LangUtil::$generalTerms['CMD_SUBMIT']; ?>' onclick="javascript:get_tests_done_report();" ></input>
						&nbsp;&nbsp;&nbsp;&nbsp;
						<span id='tests_done_progress_spinner' style='display:none'>
							<?php // $page_elems->getProgressSpinner(LangUtil::$generalTerms['CMD_FETCHING']); ?>
						</span>
					</td>
				</tr>
			</table>
		</form>
	</div>
            
	
	
	<div id='tat_aggregate_div' style='display:none;' class='reports_subdiv'>
		<b><?php echo LangUtil::$pageTerms['MENU_TAT']; ?></b>
		<br><br>
                <form name="tat_aggregate_form" id="tat_aggregate_form" action="geo_report_dir_tat.php" method='post'>
			<table cellpadding="4px">
				<tr valign='top'>
					<td><?php echo LangUtil::$generalTerms['FROM_DATE']; ?> </td>
					<td>
					<?php
// 						$name_list = array("yyyy_from", "mm_from", "dd_from");
// 						$id_list = array("yyyy_from5", "mm_from5", "dd_from5");
// 						$value_list = $monthago_array;
// 						$page_elems->getDatePicker($name_list, $id_list, $value_list);
					?>
					</td>
				</tr>
				<tr valign='top'>
					<td><?php echo LangUtil::$generalTerms['TO_DATE']; ?> </td>
					<td>
					<?php
// 						$name_list = array("yyyy_to", "mm_to", "dd_to");
// 						$id_list = array("yyyy_to5", "mm_to5", "dd_to5");
// 						$value_list = $today_array;
// 						$page_elems->getDatePicker($name_list, $id_list, $value_list);
					?>
					</td>
				</tr>
				
                                <tr id='testType'>
					<td><?php echo LangUtil::$generalTerms['TEST']; ?></td>
					<td>
						<select name='testTypeCountry' id='testTypeCountry' class='uniform_width' onchange='changeAvailableLocations(this)'>
							<!--<option value='0'><?php echo LangUtil::$generalTerms['ALL']; ?></option>-->
						<?php
							$page_elems->getTestTypesCountrySelect();
						?>
						</select>
					</td>
				</tr>
				<tr class="location_row_aggregate" id="location_row_aggregate">
					<td><?php echo LangUtil::$generalTerms['FACILITY']; ?> &nbsp;&nbsp;&nbsp;</td>
					<td id='locationAggregation'>
						<!--<input type='checkbox' name='locationAgg' id='locationAgg' value='0'><?php echo LangUtil::$generalTerms['ALL']; ?></input>-->
						<?php
							$page_elems->getSiteOptionsCheckBoxes("locationAgg[]");
						?>
					</td>
				</tr>
				<!--<tr valign='top'>
					<td><?php echo LangUtil::$pageTerms['MSG_INCLUDEPENDING']; ?> </td>
					<td>
						<input type='radio' value='Y' name='pending'><?php echo LangUtil::$generalTerms['YES']; ?></input>
						<input type='radio' value='N' name='pending' checked><?php echo LangUtil::$generalTerms['NO']; ?></input>
					</td>
				</tr>
				<tr valign='top'>
					<td><?php echo "Time Division"; ?></td>
					<td>
					<select name='tattype' id='tattype' style='font-family:Tahoma;'>
						<option value='m'><?php echo LangUtil::$pageTerms['PROGRESSION_M']; ?></option>
						<option value='w' selected><?php echo LangUtil::$pageTerms['PROGRESSION_W']; ?></option>
						<option value='d'><?php echo LangUtil::$pageTerms['PROGRESSION_D']; ?></option>
					</select>
					</td>
				</tr>-->
				<tr>
					<td></td>
					<td>
						<br>
						<input type='button' class="btn blue" id='tat_submit_button' value='<?php echo LangUtil::$generalTerms['CMD_SUBMIT']; ?>' onclick="javascript:submit_tat_aggregate_form();"></input>
						&nbsp;&nbsp;&nbsp;&nbsp;
						<span id='tat_progress_spinner' style='display:none;'>
							<?php //$page_elems->getProgressSpinner(LangUtil::$generalTerms['CMD_FETCHING']); ?>
						</span>
					</td>
				</tr>
			</table>
		</form>
	</div>
	
	<div id='print_div' style='display:none;' class='reports_subdiv'>
		<span id='test_report_title'><b><?php echo LangUtil::$pageTerms['MENU_TESTRECORDS']; ?></b></span> | <span id='view_pending_title'><a href='javascript:show_pending_tests_form()'><?php echo LangUtil::$pageTerms['MENU_PENDINGTESTS']; ?></a></span>
		<br><br>
		<form name="get_print" id="get_print" method="post" action="reports_print.php" target="_blank">
			<table cellpadding="4px">
			<?php
			$site_list = get_site_list($_SESSION['user_id']);
			if(count($site_list) == 1)
			{
				foreach($site_list as $key=>$value)
					echo "<input type='hidden' name='location' id='location6' value='$key'></input>";
			}
			else
			{
			?>
				<tr class="location_row" id="location_row">
					<td><?php echo LangUtil::$generalTerms['FACILITY']; ?> </td>
					<td>
						<select name='location' id='location6' class='uniform_width'>
						<option value='0'><?php echo LangUtil::$generalTerms['ALL']; ?></option>
						<?php
							$page_elems->getSiteOptions();
						?>
						</select>
					</td>
				</tr>
			<?php
			}
			?>
				
				<tr class="type_row" id="type_row">
					<td><?php echo LangUtil::$generalTerms['TEST_TYPE']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td> 
					<td>
						<SELECT NAME="t_type" id="t_type6" class='uniform_width'>
							<OPTION VALUE='' selected='selected'><?php echo LangUtil::$generalTerms['CMD_SELECT']; ?>..</option>
						</SELECT>
					</td>
				</tr>
		
				<tr class="sdate_row" id="sdate_row" valign='top'>
					<td><?php echo LangUtil::$generalTerms['FROM_DATE']; ?> </td>
					<td>
					<?php
// 						$name_list = array("yyyy_from", "mm_from", "dd_from");
// 						$id_list = array("yyyy_from6", "mm_from6", "dd_from6");
// 						$value_list = $monthago_array;
// 						$page_elems->getDatePicker($name_list, $id_list, $value_list);
					?>
					</td>
				</tr>
			
				<tr class="edate_row" id="edate_row" valign='top'>
					<td><?php echo LangUtil::$generalTerms['TO_DATE']; ?>&nbsp;&nbsp;&nbsp;</td>
					<td>
					<?php
// 						$name_list = array("yyyy_to", "mm_to", "dd_to");
// 						$id_list = array("yyyy_to6", "mm_to6", "dd_to6");
// 						$value_list = $today_array;
// 						$page_elems->getDatePicker($name_list, $id_list, $value_list);
					?>
					</td>
				</tr>
				<tr>
					<td>
					</td>
					<td>
						<br>
						<input type="button" class="btn blue"  value="<?php echo LangUtil::$generalTerms['CMD_SUBMIT']; ?>" onclick="get_print_page();" />
						&nbsp;&nbsp;&nbsp;&nbsp;
						<span id='print_progress_bar' style='display:none;'>
							<?php //$page_elems->getProgressSpinner(LangUtil::$generalTerms['CMD_FETCHING']); ?>
						</span>
					</td>
				</tr>
			</table>
		</form>
	</div>
	
	
	
        
    
    
	<div id='test_report_div' class='reports_subdiv'  style='display:none'>
		<b>Single Test Report</b>
		<br><br>
		<form name='test_report_form' id='test_report_form' action='reports_test.php' method='post' target='_blank'>
			<table cellpadding='4px'>
			<?php
			$site_list = get_site_list($_SESSION['user_id']);
			if(count($site_list) == 1)
			{
				foreach($site_list as $key=>$value)
					echo "<input type='hidden' name='location' id='location9' value='$key'></input>";
			}
			else
			{
			?>
				<tr class="location_row" id="location_row">
					<td><?php echo LangUtil::$generalTerms['FACILITY']; ?> </td>
					<td>
						<select name='location' id='location9' class='uniform_width'>
						<option value='0'><?php echo LangUtil::$generalTerms['ALL']; ?></option>
						<?php
							$page_elems->getSiteOptions();
						?>
						</select>
					</td>
				</tr>
			<?php
			}
			?>
				<tr>
					<td><?php echo LangUtil::$generalTerms['SPECIMEN_ID']; ?></td>
					<td>
						<input type='text' name='specimen_id' id='specimen_id9' class='uniform_width'></input>
					</td>
				</tr>
				<tr>
					<td><?php echo LangUtil::$generalTerms['TEST_TYPE']; ?></td>
					<td>
						<SELECT NAME="t_type" id="t_type9" class='uniform_width'>
							<OPTION VALUE='' selected='selected'>Select..</option>
						</SELECT>
					</td>
				</tr>				
				<tr>
					<td></td>
					<td>
						<input type='button' class="btn blue"  name='test_report_button' value='<?php echo LangUtil::$generalTerms['CMD_SUBMIT']; ?>' onclick='javascript:get_test_report();'></input>
						&nbsp;&nbsp;&nbsp;
						<span id='test_report_progress_spinner'  style='display:none;'>
							<?php $page_elems->getProgressSpinner(LangUtil::$generalTerms['CMD_FETCHING']); ?>
						</span>
					</td>
				</tr>
			</table>
		</form>
	</div>
	
	<div id='session_report_div' class='reports_subdiv' style='display:none'>
		<b><?php echo LangUtil::$pageTerms['MENU_SPECIMEN']; ?></b>
		<br><br>
		<form name='session_report_form' id='session_report_form' action='reports_session.php' method='post' target='_blank'>
			<table cellpadding='4px'>
			<?php
			$site_list = get_site_list($_SESSION['user_id']);
			if(count($site_list) == 1)
			{
				foreach($site_list as $key=>$value)
					echo "<input type='hidden' name='location' id='location11' value='$key'></input>";
			}
			else
			{
			?>
				<tr class="location_row" id="location_row">
					<td><?php echo LangUtil::$generalTerms['FACILITY']; ?> </td>
					<td>
						<select name='location' id='location11' class='uniform_width'>
						<option value='0'><?php echo LangUtil::$generalTerms['ALL']; ?></option>	
						<?php
							$page_elems->getSiteOptions();
						?>
						</select>
					</td>
				</tr>
			<?php
			}
			?>
				<tr>
					<td>
					<select id='specimen_attrib' name='specimen_attrib'>
						<option value='1'><?php echo LangUtil::$generalTerms['SPECIMEN_ID']; ?></option>
						<option value='2'><?php echo LangUtil::$generalTerms['ACCESSION_NUM']; ?></option>
						<option value='3'><?php echo LangUtil::$generalTerms['PATIENT_ID']; ?></option>
						<option value='4'><?php echo LangUtil::$generalTerms['PATIENT_NAME']; ?></option>
					</select>
					</td>
					<td>
						<input type='text' name='session_num' id='session_num' class='uniform_width'></input>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<input type='button'  class="btn blue" id='submit_button11' name='session_report_button' value='<?php echo LangUtil::$generalTerms['CMD_SUBMIT']; ?>' onclick='javascript:get_session_report();'></input>
						&nbsp;&nbsp;&nbsp;
						<span id='session_report_progress_spinner'  style='display:none;'>
							<?php $page_elems->getProgressSpinner(LangUtil::$generalTerms['CMD_FETCHING']); ?>
						</span>
					</td>
				</tr>
			</table>
		</form>
		<div id='specimens_fetched'>
		</div>
	</div>
	
	
            
	<div id='daily_report_div' class='reports_subdiv' style='display:none'>
		<b><?php echo LangUtil::$pageTerms['MENU_DAILYLOGS']; ?></b>
		<br><br>
		<table cellpadding='4px'>
			<tbody>
			<?php
			$site_list = get_site_list($_SESSION['user_id']);
			if(count($site_list) == 1)
			{
				foreach($site_list as $key=>$value)
					echo "<input type='hidden' name='location' id='location13' value='$key'></input>";
			}
			else
			{
			?>
				<tr class="location_row" id="location_row">
					<td><?php echo LangUtil::$generalTerms['FACILITY']; ?> &nbsp;&nbsp;&nbsp;</td>
					<td>
						<select name='location' id='location13' class='uniform_width' onchange='handleChange(this)'>
						<option value='0'><?php echo LangUtil::$generalTerms['ALL']; ?></option>
						<?php
							$page_elems->getSiteOptions();
						?>
						</select>
					</td>
				</tr>
			<?php
			}
			?>
				<tr>
					<td><?php echo LangUtil::$generalTerms['FROM_DATE']; ?></td>
					<td>
					<?php		
// 					$today = date("Y-m-d");
// 					$value_list = explode("-", $today);
// 					$name_list = array("daily_yyyy", "daily_mm", "daily_dd");
// 					$id_list = $name_list;
// 					$page_elems->getDatePicker($name_list, $id_list, $value_list, true);
					?>
					</td>
				</tr>
				
				<tr>
					<td><?php echo LangUtil::$generalTerms['TO_DATE']; ?></td>
					<td>
					<?php		
// 					$name_list = array("daily_yyyy_to", "daily_mm_to", "daily_dd_to");
// 					$id_list = $name_list;
// 					$page_elems->getDatePicker($name_list, $id_list, $value_list, true);
					?>
					</td>
				</tr>
				
				<tr valign='top'>
					<td><?php echo LangUtil::$generalTerms['RECORDS']; ?> &nbsp;&nbsp;&nbsp;</td>
					<td>
						<input type='radio' name='rectype13' value='1' >
							<?php echo LangUtil::$generalTerms['RECORDS_TEST']; ?>
						</input>
						<br>
						<input type='radio' name='rectype13' value='2'>
							<?php echo LangUtil::$generalTerms['RECORDS_PATIENT']; ?>
						</input>
                        <input type='radio' name='rectype13' value='3'>
                            <?php echo "Rejected Specimen"; ?>
                        </input>
					</td>
				</tr>
				<tr id='cat_row13'>
					<td><?php echo LangUtil::$generalTerms['LAB_SECTION']; ?> &nbsp;&nbsp;&nbsp;</td>
					<td>
						<select name='cat_code' id='cat_code13' class='uniform_width'>
							<option value='0'><?php echo LangUtil::$generalTerms['ALL']; ?></option>
							<?php
							if( is_country_dir( get_user_by_id($_SESSION['user_id'] ) ) )
								$page_elems->getTestCategoryCountrySelect();
							else {
								$page_elems->getTestCategorySelect();
							}
							?>
						</select>
					</td>
				</tr>
				<tr id='ttype_row13'>
					<td><?php echo LangUtil::$generalTerms['TEST']; ?></td>
					<td>
						<select name='ttype' id='ttype13' class='uniform_width'>
							<option value='0'><?php echo LangUtil::$generalTerms['ALL']; ?></option>
						</select>
					</td>
				</tr>
				
				<tr>
					<td></td>
					<td>
						<input type='button' class="btn blue" value='<?php echo LangUtil::$generalTerms['CMD_SUBMIT']; ?>' onclick='javascript:print_daily_log()'></input>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	
	<div id='billing_report_div' class='reports_subdiv' style='display:none'>
		<b><?php echo "Bill Generation"; ?></b>
		<br><br>
		<form name='preport_form' id='preport_form'>
			<table cellpadding='4px'>
			
				<tr>
					<td>
					<select name='p_attrib' id='p_attrib15'>
						<option value='1'><?php echo LangUtil::$generalTerms['PATIENT_NAME']; ?></option>
						<option value='2'><?php echo LangUtil::$generalTerms['PATIENT_DAILYNUM']; ?></option>
						<option value='0'><?php echo LangUtil::$generalTerms['PATIENT_ID']; ?></option>
					</select>
					</td>
					<td>
						<input type='text' name='patient_id' id='patient_id15' class='uniform_width'></input>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<input type='button' class="btn blue" id='submit_button15' name='preport_button' value='<?php echo LangUtil::$generalTerms['CMD_SEARCH']; ?>' onclick='search_preport();'></input>
						&nbsp;&nbsp;&nbsp;
						<span id='preport_progress_spinner'  style='display:none;'>
							<?php $page_elems->getProgressSpinner(LangUtil::$generalTerms['CMD_SEARCHING']); ?>
						</span>
					</td>
				</tr>
			</table>
			<br>
			<div id='preport_list'>
			</div>
                        </form>
	</div>
	
	<div id='prevalance_aggregate_div' class='reports_subdiv' style='display:none'>
		<b><?php echo LangUtil::$pageTerms['MENU_INFECTIONSUMMARY'];  ?></b>
		<br><br>
                <form name="country_aggregate_form" id="country_aggregate_form" action="geo_report_dir_prev.php" method='post'>
			<table>
				<tr class="sdate_row" id="sdate_row" valign='top'>
					<td><?php echo LangUtil::$generalTerms['FROM_DATE']; ?> </td>
					<td>
					<?php
// 						$name_list = array("yyyy_from", "mm_from", "dd_from");
// 						$id_list = array("yyyy_from15", "mm_from15", "dd_from15");
// 						$value_list = $monthago_array;
// 						$page_elems->getDatePicker($name_list, $id_list, $value_list);
					?>
					</td>
				</tr>
				<tr class="edate_row" id="edate_row" valign='top'>
					<td><?php echo LangUtil::$generalTerms['TO_DATE']; ?>&nbsp;&nbsp;&nbsp;</td>
					<td>
					<?php
// 						$name_list = array("yyyy_to", "mm_to", "dd_to");
// 						$id_list = array("yyyy_to15", "mm_to15", "dd_to15");
// 						$value_list = $today_array;
// 						$page_elems->getDatePicker($name_list, $id_list, $value_list);
					?>
					</td>
				</tr>
                               
				<tr id='ttype_row16'>
					<td><?php echo LangUtil::$generalTerms['TEST']; ?></td>
					<td>
						<select name='testTypeCountry' id='testTypeCountry' class='uniform_width' onchange='changeAvailableLocations(this)'>
							<!--<option value='0'><?php echo LangUtil::$generalTerms['ALL']; ?></option>-->
						<?php
							$page_elems->getTestTypesCountrySelect();
						?>
						</select>
					</td>
				</tr>
				
				<tr class="location_row_aggregate" id="location_row_aggregate">
					<td><?php echo LangUtil::$generalTerms['FACILITY']; ?> &nbsp;&nbsp;&nbsp;</td>
					<td id='locationAggregation'>
						<?php /*
						<select name='location' id='locationAggregation' class='uniform_width'>
						<option value='0'><?php echo LangUtil::$generalTerms['ALL']; ?></option>
						<?php
							$page_elems->getSiteOptions();
						?>
						</select> */
						?>
						<!--<input type='checkbox' name='locationAgg' id='locationAgg' value='0'><?php echo LangUtil::$generalTerms['ALL']; ?></input>-->
						<?php
							$page_elems->getSiteOptionsCheckBoxes("locationAgg[]");
						?>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<br>
                                                <input type='button' class="btn blue"  id='prev_submit_button' value='<?php echo LangUtil::$generalTerms['CMD_SUBMIT']; ?>' onclick="javascript:get_aggregate_report();" ></input>
						
						&nbsp;&nbsp;&nbsp;
						<span id='aggregate_report_progress_spinner'  style='display:none;'>
							<?php $page_elems->getProgressSpinner(LangUtil::$generalTerms['CMD_FETCHING']); ?>
						</span>
					</td>
				</tr>
		</table>
		</form>
	</div>
	
	<div id='control_report_div' class='reports_subdiv' style='display:none'>
		<b><?php echo LangUtil::$pageTerms['MENU_CONTROLREPORT']; ?></b>
		<br><br>
		<form id='control_report_form' action='control_report.php' method='post'>
		<table>
			<tbody>
			<tr valign='top'>
				<td><?php echo LangUtil::$generalTerms['TEST_TYPE']; ?> &nbsp;&nbsp;&nbsp;</td>
				<td>
					<select id='verify_test_type_control' name='t_type' class='uniform_width'>
						<option value=""><?php echo LangUtil::$generalTerms['SELECT_ONE']; ?>..</option>
						<?php $page_elems->getTestTypesSelect($_SESSION['lab_config_id']); ?>
					</select>
					<span id='control_testing_error' class='error_string' style='display:none;'>
						<?php echo LangUtil::$generalTerms['MSG_SELECT_TTYPE']; ?>
					</span>
				</td>
			</tr>
			<tr class="sdate_row" id="sdate_row" valign='top'>
					<td><?php echo LangUtil::$generalTerms['FROM_DATE']; ?> </td>
					<td>
					<?php
// 						$name_list = array("yyyy_from", "mm_from", "dd_from");
// 						$id_list = array("yyyy_from15", "mm_from15", "dd_from15");
// 						$value_list = $monthago_array;
// 						$page_elems->getDatePicker($name_list, $id_list, $value_list);
					?>
					</td>
			</tr>
			<tr class="edate_row" id="edate_row" valign='top'>
					<td><?php echo LangUtil::$generalTerms['TO_DATE']; ?>&nbsp;&nbsp;&nbsp;</td>
					<td>
					<?php
// 						$name_list = array("yyyy_to", "mm_to", "dd_to");
// 						$id_list = array("yyyy_to15", "mm_to15", "dd_to15");
// 						$value_list = $today_array;
// 						$page_elems->getDatePicker($name_list, $id_list, $value_list);
					?>
					</td>
				</tr>
			<tr>
				<td></td>
				<td>
				<br>
				<input type='button' class="btn blue" value='<?php echo LangUtil::$generalTerms['CMD_SUBMIT']; ?>' onclick='javascript:get_control_report()'></input>
				&nbsp;&nbsp;&nbsp;
				<span id='stock_report_progress_spinner'  style='display:none;'>
					<?php $page_elems->getProgressSpinner(LangUtil::$generalTerms['CMD_FETCHING']); ?>
				</span>
				</td>
			</tr>
			</tbody>
		</table>
		</form>
	</div>	
	
	

	<div id='infection_aggregate_div' class='reports_subdiv' style='display:none'>
		<b><?php echo LangUtil::$pageTerms['MENU_INFECTIONREPORT']; ?></b>
		<br><br>
		<form id='infection_aggregate_form' action='infection_aggregate.php' method='post' target='_blank'>
		<table>
			<tbody>	
				<tr class="sdate_row" id="sdate_row" valign='top'>
					<td><?php echo LangUtil::$generalTerms['FROM_DATE']; ?> </td>
					<td>
					<?php
// 						$name_list = array("yyyy_from", "mm_from", "dd_from");
// 						$id_list = array("yyyy_from14", "mm_from14", "dd_from14");
// 						$value_list = $monthago_array;
// 						$page_elems->getDatePicker($name_list, $id_list, $value_list);
					?>
					</td>
				</tr>
				<tr class="edate_row" id="edate_row" valign='top'>
					<td><?php echo LangUtil::$generalTerms['TO_DATE']; ?>&nbsp;&nbsp;&nbsp;</td>
					<td>
					<?php
						$name_list = array("yyyy_to", "mm_to", "dd_to");
						$id_list = array("yyyy_to14", "mm_to14", "dd_to14");
						$value_list = $today_array;
						$page_elems->getDatePicker($name_list, $id_list, $value_list);
					?>
					</td>
				</tr>
				<tr>
					<td><?php echo LangUtil::$generalTerms['LAB_SECTION']; ?> &nbsp;&nbsp;&nbsp;</td>
					<td>
						<select name='cat_code' id='cat_code14' class='uniform_width'>
						<option value='0'><?php echo LangUtil::$generalTerms['ALL']; ?></option>
						<?php //$page_elems->getTestCategoryTypesCountrySelect(); ?>
						</select>
					</td>
				</tr>
				<tr class="location_row" id="location_row">
					<td><?php echo LangUtil::$generalTerms['FACILITY']; ?> &nbsp;&nbsp;&nbsp;</td>
					<td id='locationAggregation'>
						<input type='checkbox' name='locationAgg' id='locationAgg' value='0'><?php echo LangUtil::$generalTerms['ALL']; ?></input>
						<?php
							$page_elems->getSiteOptionsCheckBoxes("locationAgg[]");
						?>
					</td><br>
				</tr>
				<tr>
					<td></td>
					<td>
						<br>
						<input type='button' class="btn blue" value='<?php echo LangUtil::$generalTerms['CMD_SUBMIT']; ?>' onclick='javascript:get_infection_report_aggregate()'></input>
						&nbsp;&nbsp;&nbsp;
						<span id='infection_aggregate_progress_spinner'  style='display:none;'>
							<?php $page_elems->getProgressSpinner(LangUtil::$generalTerms['CMD_FETCHING']); ?>
						</span>
					</td>
				</tr>
			</tbody>
		</table>
		</form>
	</div>	
	
	<div id='patient_report_div' class='reports_subdiv' style='display:none'>
		<b><?php echo LangUtil::$pageTerms['MENU_PATIENT']; ?></b>
		<br><br>
		<form name='preport_form' id='preport_form'>
			<table cellpadding='4px'>
			<?php
			$site_list = get_site_list($_SESSION['user_id']);
			if(count($site_list) == 1)
			{
				foreach($site_list as $key=>$value)
					echo "<input type='hidden' name='location' id='location15' value='$key'></input>";
			}
			else
			{
			?>
				<tr class="location_row" id="location_row15">
					<td><?php echo LangUtil::$generalTerms['FACILITY']; ?></td>
					<td>
						<select name='location' id='location15' class='uniform_width'>
						<option value='0'><?php echo LangUtil::$generalTerms['ALL']; ?></option>
						<?php
							$page_elems->getSiteOptions();
						?>
						</select>
					</td>
				</tr>
			<?php
			}
			?>
				<tr>
					<td>
					<select name='p_attrib' id='p_attrib15'>
						<option value='1'><?php echo LangUtil::$generalTerms['PATIENT_NAME']; ?></option>
						<option value='2'><?php echo LangUtil::$generalTerms['PATIENT_DAILYNUM']; ?></option>
						<option value='0'><?php echo LangUtil::$generalTerms['PATIENT_ID']; ?></option>
					</select>
					</td>
					<td>
						<input type='text' name='patient_id' id='patient_id15' class='uniform_width'></input>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<input type='button' class="btn blue" id='submit_button15' name='preport_button' value='<?php echo LangUtil::$generalTerms['CMD_SEARCH']; ?>' onclick='search_preport();'></input>
						&nbsp;&nbsp;&nbsp;
						<span id='preport_progress_spinner'  style='display:none;'>
							<?php $page_elems->getProgressSpinner(LangUtil::$generalTerms['CMD_SEARCHING']); ?>
						</span>
					</td>
				</tr>
			</table>
			<br>
			<div id='preport_list'>
			</div>
	</div>
	
	<div id='infection_report_settings_div' class='reports_subdiv'  style='display:none;'>
		<p style="text-align: right;"><a rel='facebox' href='#IR_rc'>Page Help</a></p>
		<b><?php echo "Infection Report Settings"; ?></b>
		 | <a href='javascript:toggleInfectionReportSettings();' id='agg_edit_link'><?php echo LangUtil::$generalTerms['CMD_EDIT']; ?></a>
		<br><br>
		<div id='report_updated_msg' class='clean-orange' style='display:none;width:350px;'>
		</div>
		<br>
		<div id='infection_report_settings_summary'>
			<?php echo $page_elems->getInfectonReportSummary(); ?>
		</div>
		<div id='infection_report_settings_form_div' style='display:none;'>
			<form id='infection_report_settings_preview_form' style='display:none;' name='infection_report_settings_preview_form' action='report_disease_preview.php' method='post' target='_blank'>					
				<?php # This form is cloned from agg_report_form in javascript:agg_preview() function ?>
			</form>
			<form id='infection_report_settings_form' name='infection_report_settings_form' action='ajax/infection_report_settings_update.php' method='get'>
				<?php $page_elems->getInfectionReportConfigureForm(); ?>
			</form>	
		</div>
	</div>
				
	
	<?php 
	# Space for additional report forms after this
	# PLUG_FORM_DIV
	?>
	
	</td>
	</tr>
</table>




<div class='reports_subdiv_help' id='reports_div_help' style='display:none'>
<?php
	$tips_string = "";
	$page_elems->getSideTip(LangUtil::$generalTerms['TIPS'], $tips_string);
?>
</div>
<div class='reports_subdiv_help' id='session_report_div_help2' style='display:none'>
<?php
	$tips_string = LangUtil::$pageTerms['TIPS_SPECIMEN'];
	$page_elems->getSideTip(LangUtil::$generalTerms['TIPS'], $tips_string);
?>
</div>
<div class='reports_subdiv_help' id='pending_tests_div_help' style='display:none'>
<?php
	$tips_string = LangUtil::$pageTerms['TIPS_PENDINGTESTS'];
	$page_elems->getSideTip(LangUtil::$generalTerms['TIPS'], $tips_string);
?>
</div>
<div class='reports_subdiv_help' id='stock_report_div_help' style='display:none'>
<?php
	//Turnaround time
	$tips_string = "Access previous inventory data.";
	$page_elems->getSideTip(LangUtil::$generalTerms['TIPS'], $tips_string);
?>
</div>
<div class='reports_subdiv_help' id='tests_done_div_help' style='display:none'>
<?php
	$tips_string = "Select Date Interval to view number of Tests Performed over the specified duration.";
	$page_elems->getSideTip(LangUtil::$generalTerms['TIPS'], $tips_string);
?>
</div>
<div class='reports_subdiv_help' id='testcount_grouped_div_help' style='display:none'>
<?php
	$tips_string = "Select Date Interval to view number of Tests Performed over the specified duration, grouped by age, gender and lab section.";
	$page_elems->getSideTip(LangUtil::$generalTerms['TIPS'], $tips_string);
?>
</div>
<div class='reports_subdiv_help' id='specimencount_grouped_div_help' style='display:none'>
<?php
	$tips_string = "Select Date Interval to view number of Specimens Analyzed over the specified duration, grouped by age and gender.";
	$page_elems->getSideTip(LangUtil::$generalTerms['TIPS'], $tips_string);
?>
</div>
<div class='reports_subdiv_help' id='print_div_help' style='display:none'>
<?php
	$tips_string = LangUtil::$pageTerms['TIPS_TESTRECORDS'];
	$page_elems->getSideTip(LangUtil::$generalTerms['TIPS'], $tips_string);
?>
</div>
<div class='reports_subdiv_help' id='prevalance_aggregate_div_help' style='display:none'>
<?php
	$tips_string = "Select a test, the date range and facilities for which a which the report should be generated";
	$page_elems->getSideTip(LangUtil::$generalTerms['TIPS'], $tips_string);
?>
</div>
<div class='reports_subdiv_help' id='tat_aggregate_div_help' style='display:none'>
<?php
	$tips_string = "Select a test, the date range, the time division for data collection and facilities for which a which the report should be generated";
	$page_elems->getSideTip(LangUtil::$generalTerms['TIPS'], $tips_string);
?>
</div>
<div class='reports_subdiv_help' id='infection_aggregate_div_help' style='display:none'>
<?php
	$tips_string = "Select a lab section, the date range and facilities for which a which the report should be generated";
	$page_elems->getSideTip(LangUtil::$generalTerms['TIPS'], $tips_string);
?>
</div>

</div>
</div>
</div>
</div>

<?php 
include("includes/scripts.php");
require_once("includes/script_elems.php");
$script_elems = new ScriptElems();
$script_elems->enableDatePicker();
?>
<script type='text/javascript' src="facebox/facebox.js"></script>
<script type='text/javascript'>
$(document).ready(function(){
	$("input[name='rage']").change(function() {
		toggle_agegrouplist();
	});
    $('#status_row13').hide();
    $('#hosp_row13').hide();
	$('.reports_subdiv').hide();
	$('.reports_subdiv_help').hide();
	$("#location").change(function () { get_test_types('location', 't_type') });
	$("#location3").change(function () { get_test_types('location3', 't_type3') });
	$("#location6").change(function () { get_test_types('location6', 't_type6') });
	$("#location9").change(function () { get_test_types('location9', 't_type9') });
	$("#location10").change(function () { get_test_types_withall('location10', 't_type10') });
	$("#location11").change(function () { get_usernames('location11', 'username11') });
	$("input[name='rectype13']").change( function() {
        if($('#testRec').is(':checked')) { 
            $('#cat_row13').show();
            $('#ttype_row13').show();
            $('#status_row13').hide();
            $('#hosp_row13').hide();
        }
        else if($('#patRec').is(':checked')) { 
             $('#cat_row13').hide();
            $('#ttype_row13').hide();
            $('#status_row13').hide();
            $('#hosp_row13').hide();
        }
        else if($('#refRec').is(':checked')){
            $('#status_row13').show();
            $('#hosp_row13').show();
            $('#ttype_row13').hide();
        }
        else{
            $('#cat_row13').show();
            $('#ttype_row13').hide();
            $('#status_row13').hide();
            $('#hosp_row13').hide();
        }
		
	});
	$('#cat_code13').change( function() { get_test_types_bycat() });
	$("#reportTypeSelect").change( function() {
		var selectedReport = $("#reportTypeSelect").val();
		if ( selectedReport == "infectionReport" ) {
			$('#ttype_row16').hide();
			$('#labSection_row').show();
		}
		else {
			$('#labSection_row').hide();
			$('#ttype_row16').show();
		}
	});
	get_test_types('location', 't_type');
	get_test_types('location3', 't_type3');
	get_test_types('location6', 't_type6');
	get_test_types('location9', 't_type9');
	get_test_types_withall('location10', 't_type10');
	get_usernames('location11', 'username11');
	get_test_types_bycat();
	<?php
	if(isset($_REQUEST['show_d']))
	{
		?>
		show_disease_form();
		<?php
	}
	else if (isset($_REQUEST['show_p']))
	{
		?>
		show_summary_form();
		<?php
	}
	else if (isset($_REQUEST['show_p_agg']))
	{
		?>
		show_selection("prevalance_aggregate");
		<?php
	}
	else if (isset($_REQUEST['show_t'])) 
	{
		?>
		show_tat_form();
		<?php
	}
	else if (isset($_REQUEST['show_c']))
	{
		?>
		show_specimen_count_form();
		<?php
	}
        else if (isset($_REQUEST['show_ust']))
	{
		?>
                    $('#user_stats_div').show();
		<?php
	}
	else if (isset($_REQUEST['show_t_agg']))
	{
		?>
		show_tat_aggregate_form();
		<?php
	}
	else if (isset($_REQUEST['show_agg'])) 
	{
		?>
		show_selection('country_aggregate');
		<?php
	}
	else if (isset($_REQUEST['infrepupdated'])) { ?>
		$('#report_updated_msg').html("<?php echo LangUtil::$generalTerms['MSG_UPDATED']; ?>&nbsp;&nbsp;&nbsp;<a href=\"javascript:toggle('report_updated_msg');\"><?php echo LangUtil::$generalTerms['CMD_HIDE']; ?></a>");
		$('#report_updated_msg').show();
		show_selection("infection_report_settings");
	<?php 
    }
	else 
	{
	?>
        show_test_history_form();
        <?php
	}
    ?>
});

function changeAvailableLocations(dropdown) {
	var index  = dropdown.selectedIndex;
    var selectValue = dropdown.options[index].value;
	$('#locationAggregation').load('ajax/locations_bytests.php?l='+selectValue+'&checkBoxName=locationAgg[]');
}

function handleChange(dropdown) {
	if( dropdown.value != 0 ) {
		get_test_types_bycat();
		
	}
}

function getTestCategories(locationCode) {
	$('#cat_code13').load('ajax/tests_selectbysection.php?l='+locationCode);
}

function get_test_types_bycat()
{
	var cat_code = $('#cat_code13').attr("value");
	var location_code = $('#location13').attr("value");
	$('#ttype13').load('ajax/tests_selectbycat.php?c='+cat_code+'&l='+location_code);
}

function get_test_types(location_elem, t_type_elem) 
{
	$.getJSON("ajax/tests_select.php",{site: $('#'+location_elem).val()}, function(j){
		var options = '';
		for (var i = 0; i < j.length; i++) {
			options += '<option value="' + j[i].optionValue + '">' + j[i].optionDisplay + '</option>';
		}
		$("select#"+t_type_elem).html(options);
    })
}

function get_test_types_withall(location_elem, t_type_elem) 
{
	$.getJSON("ajax/tests_select.php",{site: $('#'+location_elem).val()}, function(j){
		var options = '';
		options += '<option value="0">All</option>';
		for (var i = 0; i < j.length; i++) {
			options += '<option value="' + j[i].optionValue + '">' + j[i].optionDisplay + '</option>';
		}
		$("select#"+t_type_elem).html(options);
    })
}

function get_usernames(location_elem, username_elem)
{
	$.getJSON("ajax/users_select.php",{site: $('#'+location_elem).val()}, function(j){
		var options = '';
		for (var i = 0; i < j.length; i++) {
			options += '<option value="' + j[i].optionValue + '">' + j[i].optionDisplay + '</option>';
		}
		$("select#"+username_elem).html(options);
    })
}

function show_report_form()
{
	//Not in use
	$('.reports_subdiv').hide();
	$('.reports_subdiv_help').hide();
	$('#reports_div').show();
	$('#reports_div_help').show();
}

function show_summary_form()
{
	$('.reports_subdiv').hide();
	$('.reports_subdiv_help').hide();
	$('#summary_div').show();
	$('#summary_div_help').show();
	$('.menu_option').removeClass('current_menu_option');
	$('#summary_menu').addClass('current_menu_option');
}

function show_pending_tests_form()
{
	$('.reports_subdiv').hide();
	$('.reports_subdiv_help').hide();
	$('#pending_tests_div').show();
	$('#pending_tests_div_help').show();
	$('.menu_option').removeClass('current_menu_option');
	$('#pending_tests_menu').addClass('current_menu_option');
}

function show_tat_form()
{
	$('.reports_subdiv').hide();
	$('.reports_subdiv_help').hide();
	$('#tat_div').show();
	$('#tat_div_help').show();
	$('.menu_option').removeClass('current_menu_option');
	$('#tat_menu').addClass('current_menu_option');
}

function show_tests_done_form()
{
	$('.reports_subdiv').hide();
	$('.reports_subdiv_help').hide();
	$('#tests_done_div').show();
	$('#tests_done_div_help').show();
	$('.menu_option').removeClass('current_menu_option');
	$('#tests_done_menu').addClass('current_menu_option');
}

function show_testcount_grouped_form()
{
	$('.reports_subdiv').hide();
	$('.reports_subdiv_help').hide();
	$('#testcount_grouped_div').show();
	$('#testcount_grouped_help').show();
	$('.menu_option').removeClass('current_menu_option');
	$('#testcount_grouped_menu').addClass('current_menu_option');
}

function show_specimencount_grouped_form()
{
	$('.reports_subdiv').hide();
	$('.reports_subdiv_help').hide();
	$('#specimencount_grouped_div').show();
	$('#specimencount_grouped_help').show();
	$('.menu_option').removeClass('current_menu_option');
	$('#specimencount_grouped_menu').addClass('current_menu_option');
}


function show_print_form()
{
	$('.reports_subdiv').hide();
	$('.reports_subdiv_help').hide();
	$('#print_div').show();
	$('#print_div_help').show();	
	$('.menu_option').removeClass('current_menu_option');
	$('#print_menu').addClass('current_menu_option');
}

function show_specimen_count_form()
{
	$('.reports_subdiv').hide();
	$('.reports_subdiv_help').hide();
	$('#specimen_count_div').show();
	$('#specimen_count_div_help').show();
	$('.menu_option').removeClass('current_menu_option');
	$('#specimen_count_menu').addClass('current_menu_option');
}

function show_billing_form()
{
	$('.reports_subdiv').hide();
	$('.reports_subdiv_help').hide();
	$('#billing_report_div').show();
	$('#billing_report_div_help').show();
      	$('.menu_option').removeClass('current_menu_option');
        $('#billing_report_menu').addClass('current_menu_option');
}

function show_test_history_form()
{
	$('.reports_subdiv').hide();
	$('.reports_subdiv_help').hide();
	$('#test_history_div').show();
	$('#test_history_div_help').show();
	$('.menu_option').removeClass('current_menu_option');
	$('#test_history_menu').addClass('current_menu_option');
}

function show_test_report_form()
{
	$('.reports_subdiv').hide();
	$('.reports_subdiv_help').hide();
	$('#test_report_div').show();
	$('#test_report_div_help').show();
	$('.menu_option').removeClass('current_menu_option');
	$('#test_report_menu').addClass('current_menu_option');
}

function show_specimen_report_form()
{
	$('.reports_subdiv').hide();
	$('.reports_subdiv_help').hide();
	$('#specimen_report_div').show();
	$('#specimen_report_div_help').show();
	$('.menu_option').removeClass('current_menu_option');
	$('#specimen_report_menu').addClass('current_menu_option');
}

function show_user_log_form()
{
	$('.reports_subdiv').hide();
	$('.reports_subdiv_help').hide();
	$('#user_log_div').show();
	$('#user_log_div_help').show();
	$('.menu_option').removeClass('current_menu_option');
	$('#user_log_menu').addClass('current_menu_option');
}

function show_patient_report_form()
{
	$('.reports_subdiv').hide();
	$('.reports_subdiv_help').hide();
	$('#patient_report_div').show();
	$('#patient_report_div_help').show();
	$('.menu_option').removeClass('current_menu_option');
	$('#patient_report_menu').addClass('current_menu_option');
}

function show_session_report_form()
{
	$('.reports_subdiv').hide();
	$('.reports_subdiv_help').hide();
	$('#session_report_div').show();
	$('#session_report_div_help').show();
	$('.menu_option').removeClass('current_menu_option');
	$('#session_report_menu').addClass('current_menu_option');
}

function show_specimen_log_form()
{
	$('.reports_subdiv').hide();
	$('.reports_subdiv_help').hide();
	$('#specimen_log_div').show();
	$('#specimen_log_div_help').show();
	$('.menu_option').removeClass('current_menu_option');
	$('#specimen_log_menu').addClass('current_menu_option');
}

function show_daily_report_form()
{
	$('.reports_subdiv').hide();
	$('.reports_subdiv_help').hide();
	$('#daily_report_div').show();
	$('#daily_report_div_help').show();
	$('.menu_option').removeClass('current_menu_option');
	$('#daily_report_menu').addClass('current_menu_option');
}

function show_disease_form()
{
	$('.reports_subdiv').hide();
	$('.reports_subdiv_help').hide();
	$('.menu_option').removeClass('current_menu_option');
	$('#disease_report_div').show();
	$('#disease_report_div_help').show();
	$('#disease_report_menu').addClass('current_menu_option');
}
function show_stock_form()
{
	$('.reports_subdiv').hide();
	$('.reports_subdiv_help').hide();
	$('.menu_option').removeClass('current_menu_option');
	$('#stock_report_div').show();
	$('#stock_report_menu').addClass('current_menu_option');
}

function show_control_test_form() 
{
	$('.reports_subdiv').hide();
	$('.reports_subdiv_help').hide();
	$('.menu_option').removeClass('current_menu_option');
	$('#control_report_div').show();
	$('#control_report_menu').addClass('current_menu_option');
	
}

function show_selection(divName) {
	$('.reports_subdiv').hide();
	$('.reports_subdiv_help').hide();
	$('#'+divName+'_div').show();
	$('#'+divName+'_div_help').show();
	$('.menu_option').removeClass('current_menu_option');
	$('#pending_tests_menu').addClass('current_menu_option');
}

function show_user_stats_submenu(divID) {
	if(divID == 1)
        {
            $('#user_stats_all').show();
            $('#ustats_a').removeClass('ustats_link_u');
            $('#ustats_a').addClass('ustats_link_v');
            $('#ustats_i').removeClass('ustats_link_v');
            $('#ustats_i').addClass('ustats_link_u');
            $('#user_stats_individual').hide();
        }
        else if(divID == 2)
        {
            $('#user_stats_all').hide();
            $('#ustats_i').removeClass('ustats_link_u');
            $('#ustats_i').addClass('ustats_link_v');
            $('#ustats_a').removeClass('ustats_link_v');
            $('#ustats_a').addClass('ustats_link_u');
            $('#user_stats_individual').show();
        }
        
}

function user_radio(divID) {
	if(divID == 1)
        {
            $("#user_stats_form").attr("action", "reports_user_stats_all.php");
            $("#user_stats_form").attr("target", "_self");
            $('#user_stats_all').show();
            $('#user_stats_individual').hide();
        }
        else if(divID == 2)
        {
            $("#user_stats_form").attr("action", "reports_user_stats_individual.php");
            $("#user_stats_form").attr("target", "_blank");
            $('#user_stats_all').hide();
            $('#user_stats_individual').show();
        }
        
}

function toggleInfectionReportSettings()
{
	$('#infection_report_settings_summary').toggle();
	$('#infection_report_settings_form_div').toggle();
	var curr_link_text = $('#agg_edit_link').html();
	if(curr_link_text == "<?php echo LangUtil::$generalTerms['CMD_EDIT']; ?>")
		$('#agg_edit_link').html("<?php echo LangUtil::$generalTerms['CMD_CANCEL']; ?>");
	else
		$('#agg_edit_link').html("<?php echo LangUtil::$generalTerms['CMD_EDIT']; ?>");
}

function toggle_agegrouplist()
{
	$('#agegrouprow').toggle();
}

function agg_checkandsubmit()
{
	$('#agg_progress_spinner').show();
	$('#agg_progress_spinner').hide();
	$('#infection_report_settings_form').ajaxSubmit({
		success: function() {
			$('#agg_progress_spinner').hide();
			window.location="reports.php?infrepupdated=1";
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

function get_patient_reports()
{
	var t_type = $("#t_type").attr("value");
	var location = $("#location").attr("value");
	var yyyy_from = $("#yyyy_from").attr("value");
	var mm_from = $("#mm_from").attr("value");
	var dd_from = $("#dd_from").attr("value");
	var yyyy_to = $("#yyyy_to").attr("value");
	var mm_to = $("#mm_to").attr("value");
	var dd_to = $("#dd_to").attr("value");
	if(location == "")
	{
		alert("<?php echo LangUtil::$generalTerms['TIPS_SELECTSITE']; ?>");
		return;
	}
	else if(t_type == "")
	{
		alert("<?php echo LangUtil::$generalTerms['TIPS_INCOMPLETEINFO']; ?>");
		return;
	}
	else if(checkDate(yyyy_from, mm_from, dd_from) == false)
	{
		alert("<?php echo LangUtil::$generalTerms['TIPS_DATEINVALID']; ?>");
		return;
	}
	else if(checkDate(yyyy_to, mm_to, dd_to) == false)
	{
		alert("<?php echo LangUtil::$generalTerms['TIPS_DATEINVALID']; ?>");
		return;
	}
	else
	{
		if(
		isNaN(yyyy_from) || 
		isNaN(yyyy_to) ||
		isNaN(mm_from) ||
		isNaN(mm_to) ||
		isNaN(dd_from) ||
		isNaN(dd_to)
		)
		{
			$("#mm_from").val("");
			$("#dd_from").val("");
			$("#yyyy_from").val("");
			$("#mm_to").val("");
			$("#dd_to").val("");
			$("#yyyy_to").val("");
		}
		$('#report_progress_bar').show();
		$("#get_patient_report").submit();
	}
}
function get_aggregate_report() {
	var t_type = $("#ttype_row16").attr("value");
	var location = $("#location").attr("value");
	var yyyy_from = $("#yyyy_from").attr("value");
	var mm_from = $("#mm_from").attr("value");
	var dd_from = $("#dd_from").attr("value");
	var yyyy_to = $("#yyyy_to").attr("value");
	var mm_to = $("#mm_to").attr("value");
	var dd_to = $("#dd_to").attr("value");

	if(location == "")
	{
		alert("<?php echo LangUtil::$generalTerms['TIPS_SELECTSITE']; ?>");
		return;
	}
	else if(t_type == "")
	{
		alert("<?php echo LangUtil::$generalTerms['TIPS_INCOMPLETEINFO']; ?>");
		return;
	}
	else if(checkDate(yyyy_from, mm_from, dd_from) == false)
	{
		alert("<?php echo LangUtil::$generalTerms['TIPS_DATEINVALID']; ?>");
		return;
	}
	else if(checkDate(yyyy_to, mm_to, dd_to) == false)
	{
		alert("<?php echo LangUtil::$generalTerms['TIPS_DATEINVALID']; ?>");
		return;
	}
	else
	{
		if(
		isNaN(yyyy_from) || 
		isNaN(yyyy_to) ||
		isNaN(mm_from) ||
		isNaN(mm_to) ||
		isNaN(dd_from) ||
		isNaN(dd_to)
		)
		{
			$("#mm_from").val("");
			$("#dd_from").val("");
			$("#yyyy_from").val("");
			$("#mm_to").val("");
			$("#dd_to").val("");
			$("#yyyy_to").val("");
		}
		$('#aggregate_report_progress_spinner').show();
		$("#country_aggregate_form").submit();
	}
}

function agegrouplist_append()
{
	var html_code = "&nbsp;&nbsp;<input type='text' name='age_l[]' class='range_field'></input>-<input type='text' name='age_u[]' class='range_field'></input>";
	$('#agegrouplist_inner').append(html_code);
}

function add_slot(span_id, field_name1, field_name2)
{
	var html_code = "&nbsp;&nbsp;&nbsp;<input type='text' class='range_field' name='"+field_name1+"[]' value=''></input>-<input type='text' class='range_field' name='"+field_name2+"[]' value=''></input>";
	$('#'+span_id).append(html_code);
}

function get_summary_fn(all_sites_flag)
{
    if(all_sites_flag == 0)
	{
		//View Cumulative
		//Change checkbox value to "C"
		$('input[name=summary_type]:checked').attr('value', 'C');
	}
	else if(all_sites_flag == 1)
	{
		//Change checkbox value to "M"
		$('input[name=summary_type]:checked').attr('value', 'M');
	}
	else if(all_sites_flag == 2)
	{
		//View across all available sites
		//Change checkbox value to "L"
		$('input[name=summary_type]:checked').attr('value', 'L');
	}
	var location = $("#location2").attr("value");
	
	var from_date = $("#from-date-prev").attr("value");
    var to_date = $("#to-date-prev").attr("value");
    
    dateFromArray = from_date.split("-");
    yyyy_from = dateFromArray[0];
    mm_from = dateFromArray[1];
    dd_from = dateFromArray[2];
    
    dateToArray = to_date.split("-");
    yyyy_to = dateToArray[0];
    mm_to = dateToArray[1];
    dd_to = dateToArray[2];
   
	if(location == "")
	{
		alert("<?php echo LangUtil::$generalTerms['TIPS_SELECTSITE']; ?>");
		return;
	}
	else if(checkDate(yyyy_from, mm_from, dd_from) == false)
	{
		alert("<?php echo LangUtil::$generalTerms['TIPS_DATEINVALID']; ?>");
		return;
	}
	else if(checkDate(yyyy_to, mm_to, dd_to) == false)
	{
		alert("<?php echo LangUtil::$generalTerms['TIPS_DATEINVALID']; ?>");
		return;
	}
	if(
		isNaN(yyyy_from) || 
		isNaN(yyyy_to) ||
		isNaN(mm_from) ||
		isNaN(mm_to) ||
		isNaN(dd_from) ||
		isNaN(dd_to)
		)
	{
		$("#mm_from2").val("");
		$("#dd_from2").val("");
		$("#yyyy_from2").val("");
		$("#mm_to2").val("");
		$("#dd_to2").val("");
		$("#yyyy_to2").val("");
	}
	$('#summary_progress_bar').show();
	$("#get_summary").submit();	
}

function get_pending_report()
{
	var location = $("#location3").attr("value");
	var t_type = $("#t_type3").attr("value");
	if(location == "")
	{
		alert("<?php echo LangUtil::$generalTerms['TIPS_SELECTSITE']; ?>");
	}
	else if(t_type == "")
	{
		alert("<?php echo LangUtil::$generalTerms['TIPS_INCOMPLETEINFO']; ?>");
	}
	else
	{
		$('#pending_progress_spinner').show();
		$('#pending_tests_form').submit();
	}
}


function get_tests_done_report()
{	
	var location = $("#location4").attr("value");
	var yyyy_from = $("#yyyy_from4").attr("value");
	var mm_from = $("#mm_from4").attr("value");
	var dd_from = $("#dd_from4").attr("value");
	var yyyy_to = $("#yyyy_to4").attr("value");
	var mm_to = $("#mm_to4").attr("value");
	var dd_to = $("#dd_to4").attr("value");
	if(location == "")
	{
		alert("<?php echo LangUtil::$generalTerms['TIPS_SELECTSITE']; ?>");
		return;
	}
	else if(checkDate(yyyy_from, mm_from, dd_from) == false)
	{
		alert("<?php echo LangUtil::$generalTerms['TIPS_DATEINVALID']; ?>");
		return;
	}
	else if(checkDate(yyyy_to, mm_to, dd_to) == false)
	{
		alert("<?php echo LangUtil::$generalTerms['TIPS_DATEINVALID']; ?>");
		return;
	}
	if(
		isNaN(yyyy_from) || 
		isNaN(yyyy_to) ||
		isNaN(mm_from) ||
		isNaN(mm_to) ||
		isNaN(dd_from) ||
		isNaN(dd_to)
		)
	{
		$("#mm_from4").val("");
		$("#dd_from4").val("");
		$("#yyyy_from4").val("");
		$("#mm_to4").val("");
		$("#dd_to4").val("");
		$("#yyyy_to4").val("");
	}
	$('#tests_done_progress_spinner').show();
	$('#tests_done_form').submit();
}

function get_doctor_stats()
{
	var location = $("#location7").attr("value");
	var from_date = $("#from-date-count").attr("value");
    var to_date = $("#to-date-count").attr("value");
    
    dateFromArray = from_date.split("-");
    yyyy_from = dateFromArray[0];
    mm_from = dateFromArray[1];
    dd_from = dateFromArray[2];
    
    dateToArray = to_date.split("-");
    yyyy_to = dateToArray[0];
    mm_to = dateToArray[1];
    dd_to = dateToArray[2];
	
	$("#location8").attr("value", location);
	$("#from-date-doctordiv").attr("value", from_date);
	$("#to-date-doctordiv").attr("value", to_date);
	
	
	if(location == "")
	{
		alert("<?php echo LangUtil::$generalTerms['TIPS_SELECTSITE']; ?>");
		return;
	}
	else if(checkDate(yyyy_from, mm_from, dd_from) == false)
	{
		alert("<?php echo LangUtil::$generalTerms['TIPS_DATEINVALID']; ?>");
		return;
	}
	else if(checkDate(yyyy_to, mm_to, dd_to) == false)
	{
		alert("<?php echo LangUtil::$generalTerms['TIPS_DATEINVALID']; ?>");
		return;
	}
	if(
		isNaN(yyyy_from) || 
		isNaN(yyyy_to) ||
		isNaN(mm_from) ||
		isNaN(mm_to) ||
		isNaN(dd_from) ||
		isNaN(dd_to)
		)
	{
		$("#from-date-doctordiv").val("");
		$("#to-date-doctordiv").val("");
	}
	$('#specimen_count_progress_spinner').show();
	$('#doctors_stats_form').submit();


}
function get_tests_done_report2()
{
	
	var location = $("#location7").attr("value");
	
	var from_date = $("#from-date-count").attr("value");
    var to_date = $("#to-date-count").attr("value");
    
    dateFromArray = from_date.split("-");
    yyyy_from = dateFromArray[0];
    mm_from = dateFromArray[1];
    dd_from = dateFromArray[2];
    
    dateToArray = to_date.split("-");
    yyyy_to = dateToArray[0];
    mm_to = dateToArray[1];
    dd_to = dateToArray[2];
	
    $("#location4").attr("value", location);
    
	$("#from-date-testdone").attr("value", from_date);		
	$("#to-date-testdone").attr("value", to_date);
		
	if(location == "")
	{
		alert("<?php echo LangUtil::$generalTerms['TIPS_SELECTSITE']; ?>");
		return;
	}
	else if(checkDate(yyyy_from, mm_from, dd_from) == false)
	{
		alert("<?php echo LangUtil::$generalTerms['TIPS_DATEINVALID']; ?>");
		return;
	}
	else if(checkDate(yyyy_to, mm_to, dd_to) == false)
	{
		alert("<?php echo LangUtil::$generalTerms['TIPS_DATEINVALID']; ?>");
		return;
	}
	if(
		isNaN(yyyy_from) || 
		isNaN(yyyy_to) ||
		isNaN(mm_from) ||
		isNaN(mm_to) ||
		isNaN(dd_from) ||
		isNaN(dd_to)
		)
	{
		$("#from-date-testdone").val("");
		$("#to-date-testdone").val("");
	}
	$('#specimen_count_progress_spinner').show();
	$('#tests_done_form').submit();
}

function get_testcount_grouped()
{
	
	var location = $("#location7").attr("value");
	
	var from_date = $("#from-date-count").attr("value");
    var to_date = $("#to-date-count").attr("value");
    
    dateFromArray = from_date.split("-");
    yyyy_from = dateFromArray[0];
    mm_from = dateFromArray[1];
    dd_from = dateFromArray[2];
    
    dateToArray = to_date.split("-");
    yyyy_to = dateToArray[0];
    mm_to = dateToArray[1];
    dd_to = dateToArray[2];
    
	$("#location44").attr("value", location);
	$("#from-date-testcgrouped").attr("value", from_date);
	$("#to-date-testcgrouped").attr("value", to_date);	
	
	if(location == "")
	{
		alert("<?php echo LangUtil::$generalTerms['TIPS_SELECTSITE']; ?>");
		return;
	}
	else if(checkDate(yyyy_from, mm_from, dd_from) == false)
	{
		alert("<?php echo LangUtil::$generalTerms['TIPS_DATEINVALID']; ?>");
		return;
	}
	else if(checkDate(yyyy_to, mm_to, dd_to) == false)
	{
		alert("<?php echo LangUtil::$generalTerms['TIPS_DATEINVALID']; ?>");
		return;
	}
	if(
		isNaN(yyyy_from) || 
		isNaN(yyyy_to) ||
		isNaN(mm_from) ||
		isNaN(mm_to) ||
		isNaN(dd_from) ||
		isNaN(dd_to)
		)
	{
		$("#from-date-testcgrouped").val("");
		$("#to-date-testcgrouped").val("");
	}
	//$('#specimen_count_progress_spinner').show();
	$('#testcount_grouped_form').submit();
}

function get_specimencount_grouped()
{
	
	var location = $("#location7").attr("value");
	
	var from_date = $("#from-date-count").attr("value");
    var to_date = $("#to-date-count").attr("value");
    
    dateFromArray = from_date.split("-");
    yyyy_from = dateFromArray[0];
    mm_from = dateFromArray[1];
    dd_from = dateFromArray[2];
    
    dateToArray = to_date.split("-");
    yyyy_to = dateToArray[0];
    mm_to = dateToArray[1];
    dd_to = dateToArray[2];
    
	$("#location444").attr("value", location);
	$("#from-date-scgrouped").attr("value", from_date);
	$("#to-date-scgrouped").attr("value", to_date);
	
	if(location == "")
	{
		alert("<?php echo LangUtil::$generalTerms['TIPS_SELECTSITE']; ?>");
		return;
	}
	else if(checkDate(yyyy_from, mm_from, dd_from) == false)
	{
		alert("<?php echo LangUtil::$generalTerms['TIPS_DATEINVALID']; ?>");
		return;
	}
	else if(checkDate(yyyy_to, mm_to, dd_to) == false)
	{
		alert("<?php echo LangUtil::$generalTerms['TIPS_DATEINVALID']; ?>");
		return;
	}
	if(
		isNaN(yyyy_from) || 
		isNaN(yyyy_to) ||
		isNaN(mm_from) ||
		isNaN(mm_to) ||
		isNaN(dd_from) ||
		isNaN(dd_to)
		)
	{
		$("#from-date-scgrouped").val("");
		$("#from-date-scgrouped").val("");
	}
	//$('#specimen_count_progress_spinner').show();
	$('#specimencount_grouped_form').submit();
}


function get_tat_report()
{
	var location = $("#location5").attr("value");
	
	var from_date = $("#from-date-tat").attr("value");
    var to_date = $("#to-date-tat").attr("value");
    
    dateFromArray = from_date.split("-");
    yyyy_from = dateFromArray[0];
    mm_from = dateFromArray[1];
    dd_from = dateFromArray[2];
    
    dateToArray = to_date.split("-");
    yyyy_to = dateToArray[0];
    mm_to = dateToArray[1];
    dd_to = dateToArray[2];
	
	if(location == "")
	{
		alert("<?php echo LangUtil::$generalTerms['TIPS_SELECTSITE']; ?>");
		return;
	}
	else if(checkDate(yyyy_from, mm_from, dd_from) == false)
	{
		alert("<?php echo LangUtil::$generalTerms['TIPS_DATEINVALID']; ?>");
		return;
	}
	else if(checkDate(yyyy_to, mm_to, dd_to) == false)
	{
		alert("<?php echo LangUtil::$generalTerms['TIPS_DATEINVALID']; ?>");
		return;
	}
	if(
		isNaN(yyyy_from) || 
		isNaN(yyyy_to) ||
		isNaN(mm_from) ||
		isNaN(mm_to) ||
		isNaN(dd_from) ||
		isNaN(dd_to)
		)
	{
		$("#from-date-tat").val("");
		$("#to-date-tat").val("");
	}
	$('#tat_progress_spinner').show();
	$('#tat_form').submit();
}

function submit_tat_aggregate_form() {
	var location = $("#location5").attr("value");
	var yyyy_from = $("#yyyy_from5").attr("value");
	var mm_from = $("#mm_from5").attr("value");
	var dd_from = $("#dd_from5").attr("value");
	var yyyy_to = $("#yyyy_to5").attr("value");
	var mm_to = $("#mm_to5").attr("value");
	var dd_to = $("#dd_to5").attr("value");
	if(location == "")
	{
		alert("<?php echo LangUtil::$generalTerms['TIPS_SELECTSITE']; ?>");
		return;
	}
	else if(checkDate(yyyy_from, mm_from, dd_from) == false)
	{
		alert("<?php echo LangUtil::$generalTerms['TIPS_DATEINVALID']; ?>");
		return;
	}
	else if(checkDate(yyyy_to, mm_to, dd_to) == false)
	{
		alert("<?php echo LangUtil::$generalTerms['TIPS_DATEINVALID']; ?>");
		return;
	}
	if(
		isNaN(yyyy_from) || 
		isNaN(yyyy_to) ||
		isNaN(mm_from) ||
		isNaN(mm_to) ||
		isNaN(dd_from) ||
		isNaN(dd_to)
		)
	{
		$("#mm_from5").val("");
		$("#dd_from5").val("");
		$("#yyyy_from5").val("");
		$("#mm_to5").val("");
		$("#dd_to5").val("");
		$("#yyyy_to5").val("");
	}
	$('#tat_progress_spinner').show();
	$('#tat_aggregate_form').submit();
}
function get_print_page()
{
	var location = $("#location6").attr("value");
	var t_type = $("#t_type6").attr("value");
	var yyyy_from = $("#yyyy_from6").attr("value");
	var mm_from = $("#mm_from6").attr("value");
	var dd_from = $("#dd_from6").attr("value");
	var yyyy_to = $("#yyyy_to6").attr("value");
	var mm_to = $("#mm_to6").attr("value");
	var dd_to = $("#dd_to6").attr("value");
	if(location == "")
	{
		alert("<?php echo LangUtil::$generalTerms['TIPS_SELECTSITE']; ?>");
		return;
	}
	else if(t_type == "")
	{
		alert("<?php echo LangUtil::$generalTerms['TIPS_INCOMPLETEINFO']; ?>");
		return;
	}
	else if(checkDate(yyyy_from, mm_from, dd_from) == false)
	{
		alert("<?php echo LangUtil::$generalTerms['TIPS_DATEINVALID']; ?>");
		return;
	}
	else if(checkDate(yyyy_to, mm_to, dd_to) == false)
	{
		alert("<?php echo LangUtil::$generalTerms['TIPS_DATEINVALID']; ?>");
		return;
	}
	//$('#print_progress_bar').show();
	$('#get_print').submit();
}

function get_count_report()
{
	var count_type = $("input[name='count_type']:checked").attr("value");
	if(count_type == 1)
	{
		get_specimen_count_report();
	}
	else if(count_type == 2)
	{
		get_tests_done_report2();
	}
	else if(count_type==3)
	{
	
	get_doctor_stats();
	}
        else if(count_type==4)
	{
	
            get_testcount_grouped();
	}
        else if(count_type==5)
	{
	
            get_specimencount_grouped();
	}
}

function get_specimen_count_report()
{
	var location = $("#location7").attr("value");
	
	var from_date = $("#from-date-count").attr("value");
    var to_date = $("#to-date-count").attr("value");
    
    dateFromArray = from_date.split("-");
    yyyy_from = dateFromArray[0];
    mm_from = dateFromArray[1];
    dd_from = dateFromArray[2];
    
    dateToArray = to_date.split("-");
    yyyy_to = dateToArray[0];
    mm_to = dateToArray[1];
    dd_to = dateToArray[2];
	
	
	if(location == "")
	{
		alert("<?php echo LangUtil::$generalTerms['TIPS_SELECTSITE']; ?>");
		return;
	}
	else if(checkDate(yyyy_from, mm_from, dd_from) == false)
	{
		alert("<?php echo LangUtil::$generalTerms['TIPS_DATEINVALID']; ?>");
		return;
	}
	else if(checkDate(yyyy_to, mm_to, dd_to) == false)
	{
		alert("<?php echo LangUtil::$generalTerms['TIPS_DATEINVALID']; ?>");
		return;
	}
	if(
		isNaN(yyyy_from) || 
		isNaN(yyyy_to) ||
		isNaN(mm_from) ||
		isNaN(mm_to) ||
		isNaN(dd_from) ||
		isNaN(dd_to)
		)
	{
		$("#mm_from7").val("");
		$("#dd_from7").val("");
		$("#yyyy_from7").val("");
		$("#mm_to7").val("");
		$("#dd_to7").val("");
		$("#yyyy_to7").val("");
	}
	$('#specimen_count_progress_spinner').show();
	$('#specimen_count_form').submit();
}

function get_test_history_report()
{
	var location = $("#location8").attr("value");
	if(location == "")
	{
		alert("<?php echo LangUtil::$generalTerms['TIPS_SELECTSITE']; ?>");
		return;
	}
	var pid = $('#patient_id8').attr("value");
	if(pid == "")
	{
		alert("<?php echo LangUtil::$generalTerms['TIPS_INCOMPLETEINFO']; ?>");
		return;
	}
	//$('#test_history_progress_spinner').show();
	$('#test_history_form').submit();
}

function search_patient_history()
{
	var location = $("#location8").attr("value");
	var search_attrib = $('#p_attrib').attr("value");
	var pid = $('#patient_id8').attr("value");
	if(pid == "")
	{
		alert("<?php echo LangUtil::$generalTerms['TIPS_INCOMPLETEINFO']; ?>");
		return;
	}
	$('#test_history_progress_spinner').show();
	var url = 'ajax/search_p_dyn.php';
	$("#phistory_list").load(url, 
		{q: pid, a: search_attrib, l: location }, 
		function()
		{
			$('#test_history_progress_spinner').hide();
			$('#phistory_list').show();
		}
	);
}

function search_preport()
{
	var location = $("#location15").attr("value");
	var search_attrib = $('#p_attrib15').attr("value");
	var pid = $('#patient_id15').attr("value");
	if(pid == "")
	{
		alert("<?php echo LangUtil::$generalTerms['TIPS_INCOMPLETEINFO']; ?>");
		return;
	}
	$('#preport_progress_spinner').show();
	var url = 'ajax/preport_checkboxes.php';
	$("#preport_list").load(url, 
		{q: pid, a: search_attrib, l: location }, 
		function() {
			$('#preport_progress_spinner').hide();
			$('#preport_list').show();
			$('#preport_table').tablesorter({sortList: [[4,1]]});
			$('#location151').attr("value", location);
		}
	);
}

function submit_preport()
{
	//Validate
	var checkbox_list = $('.sp_checkbox');
	var none_selected = true;
	for(var i = 0; i < checkbox_list.length; i++)
	{
		if(checkbox_list[i].checked == true)
		{
			none_selected = false;
			break;
		}		
	}
	if(none_selected == true)
	{
		alert("No tests selected.");
		return;
	}
	//All okay
	$('#preport_selected_form').submit();
}

function get_test_report()
{
	var location = $("#location9").attr("value");
	var sid = $('#specimen_id9').attr("value");
	if(location == "")
	{
		alert("<?php echo LangUtil::$generalTerms['TIPS_SELECTSITE']; ?>");
		return;
	}
	if(sid == "")
	{
		alert("<?php echo LangUtil::$generalTerms['TIPS_INCOMPLETEINFO']; ?>");
		return;
	}
	$('#test_report_form').submit();
}

function get_specimen_report()
{
	var location = $('#location10').attr("value");
	var sid = $('#specimen_id10').attr("value");
	var ttype = $('#t_type10').attr("value");
	if(location == "")
	{
		alert("<?php echo LangUtil::$generalTerms['TIPS_SELECTSITE']; ?>");
		return;
	}
	if(sid == "")
	{
		alert("<?php echo LangUtil::$generalTerms['TIPS_INCOMPLETEINFO']; ?>");
		return;
	}
	if(ttype == 0)
	{
		$('#specimen_report_form').submit();
	}
	else
	{
		$('#location9').attr("value", location);
		$('#specimen_id9').attr("value", sid);
		$('#t_type9').attr("value", ttype);
		$('#test_report_form').submit();
	}
}

function get_user_log_report()
{
	var location = $('#location11').attr("value");
	var user = $('#username11').attr("value");
	if(location == "")
	{
		alert("<?php echo LangUtil::$generalTerms['TIPS_SELECTSITE']; ?>");
		return;
	}
	if(user == "")
	{
		alert("<?php echo LangUtil::$generalTerms['TIPS_INCOMPLETEINFO']; ?>");
		return;
	}
	$('#user_log_form').submit();
}

function get_session_report()
{
	var location = $('#location11').attr("value").trim();
	var s_attrib = $('#specimen_attrib').attr("value");
	var sid = $('#session_num').attr("value").trim();
	if(location == "")
	{
		alert("<?php echo LangUtil::$generalTerms['TIPS_SELECTSITE']; ?>");
		return;
	}
	if(sid == "")
	{
		alert("<?php echo LangUtil::$generalTerms['TIPS_INCOMPLETEINFO']; ?>");
		return;
	}
	var params = $('#session_report_form').formSerialize();
	var url = "ajax/reports_specimen_entries.php?"+params;
	$('#session_report_progress_spinner').show();
	$('#specimens_fetched').load(url, function() {
		$('#session_report_progress_spinner').hide();
	});
}

function get_specimen_log()
{
	var location = $('#location12').attr("value");
	var sid = $('#specimen_id12').attr("value");
	if(location == "")
	{
		alert("<?php echo LangUtil::$generalTerms['TIPS_SELECTSITE']; ?>");
		return;
	}
	if(sid == "")
	{
		alert("<?php echo LangUtil::$generalTerms['TIPS_INCOMPLETEINFO']; ?>");
		return;
	}
	$('#specimen_log_form').submit();
}

function print_daily_patients()
{
	var l = $("#location13").attr("value");
	var from_date = $("#from-date").attr("value");
    var to_date = $("#to-date").attr("value");
	
	dateFromArray = from_date.split("-");
    yf = dateFromArray[0];
    mf = dateFromArray[1];
    df = dateFromArray[2];
    
    dateToArray = to_date.split("-");
    yt = dateToArray[0];
    mt = dateToArray[1];
    dt = dateToArray[2];
	
	if(checkDate(yt, mt, dt) == false || checkDate(yf, mf, df) == false)
	{
		alert("<?php echo LangUtil::$generalTerms['TIPS_DATEINVALID']; ?>");
		return;
	}
	var url = "reports_dailypatients.php?yt="+yt+"&mt="+mt+"&dt="+dt+"&yf="+yf+"&mf="+mf+"&df="+df+"&l="+l;
	window.open(url);
}

function print_daily_specimens()
{
	var l = $("#location13").attr("value");
	var from_date = $("#from-date").attr("value");
	var to_date = $("#to-date").attr("value");
	
	dateFromArray = from_date.split("-");
    yf = dateFromArray[0];
    mf = dateFromArray[1];
    df = dateFromArray[2];
    
    dateToArray = to_date.split("-");
    yt = dateToArray[0];
    mt = dateToArray[1];
    dt = dateToArray[2];
	
	if(checkDate(yf, mf, dt) == false || checkDate(yt, mt, dt) == false)
	{
		alert("<?php echo LangUtil::$generalTerms['TIPS_DATEINVALID']; ?>");
		return;
	}
	var cat_code = $('#cat_code13').attr("value");
	var ttype = $('#ttype13').attr("value");
	var ip= 0;
	var p=0;
	var url = "reports_dailyspecimens.php?yt="+yt+"&mt="+mt+"&dt="+dt+"&yf="+yf+"&mf="+mf+"&df="+df+"&l="+l+"&c="+cat_code+"&t="+ttype+"&ip="+ip;
	window.open(url);
}

function print_daily_rejections()
{
    var l = $("#location13").attr("value");
    var from_date = $("#from-date").attr("value");
    var to_date = $("#to-date").attr("value");
    
    dateFromArray = from_date.split("-");
    yf = dateFromArray[0];
    mf = dateFromArray[1];
    df = dateFromArray[2];
    
    dateToArray = to_date.split("-");
    yt = dateToArray[0];
    mt = dateToArray[1];
    dt = dateToArray[2];
    
    if(checkDate(yf, mf, dt) == false || checkDate(yt, mt, dt) == false)
    {
        alert("<?php echo LangUtil::$generalTerms['TIPS_DATEINVALID']; ?>");
        return;
    }
    var cat_code = $('#cat_code13').attr("value");
    var ttype = $('#ttype13').attr("value");
    var ip= 0;
    var p=0;
    var url = "reports_dailyrejections.php?yt="+yt+"&mt="+mt+"&dt="+dt+"&yf="+yf+"&mf="+mf+"&df="+df+"&l="+l+"&c="+cat_code+"&t="+ttype+"&ip="+ip;
    window.open(url);
}

function print_daily_log()
{
	var record_type = $("input[name='rectype13']:checked").attr("value");
	if(record_type == 1)
	{
		print_daily_specimens();
	}
	else if(record_type == 2)
	{
		print_daily_patients();
	}
    else if(record_type == 3)
    {
        print_daily_rejections();
    }
    else if(record_type == 4)
    {
        print_daily_referrals();
    }
}

function print_daily_referrals(){
    var l = $("#location13").attr("value");
    var from_date = $("#from-date").attr("value");
    var to_date = $("#to-date").attr("value");
    
    dateFromArray = from_date.split("-");
    yf = dateFromArray[0];
    mf = dateFromArray[1];
    df = dateFromArray[2];
    
    dateToArray = to_date.split("-");
    yt = dateToArray[0];
    mt = dateToArray[1];
    dt = dateToArray[2];
    
    if(checkDate(yf, mf, dt) == false || checkDate(yt, mt, dt) == false)
    {
        alert("<?php echo LangUtil::$generalTerms['TIPS_DATEINVALID']; ?>");
        return;
    }
    var cat_code = $('#cat_code13').attr("value");
    var ref_status = $("input[name='status_referral']:checked").attr("value");
    var ip= 0;
    var p=0;
    var url = "daily_referrals.php?yt="+yt+"&mt="+mt+"&dt="+dt+"&yf="+yf+"&mf="+mf+"&df="+df+"&l="+l+"&c="+cat_code+"&rs="+ref_status+"&ip="+ip;
    window.open(url);
}

function get_stock_report()
{
	// Validate
	var l = $("#location15").attr("value");
	var y_from = $("#yyyy_from15").attr("value");
	var m_from = $("#mm_from15").attr("value");
	var d_from = $("#dd_from15").attr("value");
	var y_to = $("#yyyy_to15").attr("value");
	var m_to = $("#mm_to15").attr("value");
	var d_to = $("#dd_to15").attr("value");
	var cat_code = $("#cat_code15").attr("value");
	
	if(checkDate(y_from, m_from, d_from) == false)
	{
		alert("<?php echo LangUtil::$generalTerms['TIPS_DATEINVALID']; ?>");
		return;
	}
	
	if(checkDate(y_to, m_to, d_to) == false)
	{ 
		alert("<?php echo LangUtil::$generalTerms['TIPS_DATEINVALID']; ?>");
		return;
	}
	// All okay
	
	$('#stock_report_form').submit();
}

function get_control_report() 
{
	// Validate
	var dateError = "From date cannot be beyond To date";
	var l = $("#location15").attr("value");
	var y_from = $("#yyyy_from15").attr("value");
	var m_from = $("#mm_from15").attr("value");
	var d_from = $("#dd_from15").attr("value");
	var y_to = $("#yyyy_to15").attr("value");
	var m_to = $("#mm_to15").attr("value");
	var d_to = $("#dd_to15").attr("value");
	var cat_code = $("#cat_code15").attr("value");
	
	if(checkDate(y_from, m_from, d_from) == false)
	{
		alert("<?php echo LangUtil::$generalTerms['TIPS_DATEINVALID']; ?>");
		return;
	}
	
	if(checkDate(y_to, m_to, d_to) == false)
	{ 
		alert("<?php echo LangUtil::$generalTerms['TIPS_DATEINVALID']; ?>");
		return;
	}
	
	$('#control_testing_error').hide();
	var test_type_id = $('#verify_test_type_control').attr("value");
	if(test_type_id == "")
	{	 
		$('#control_testing_error').show();
		return;
	}
	// All okay
	
	//$('#control_report_form').submit();
}

function get_infection_report_aggregate() {
	var l = $("#location14").attr("value");
	var y_from = $("#yyyy_from14").attr("value");
	var m_from = $("#mm_from14").attr("value");
	var d_from = $("#dd_from14").attr("value");
	var y_to = $("#yyyy_to14").attr("value");
	var m_to = $("#mm_to14").attr("value");
	var d_to = $("#dd_to14").attr("value");
	var cat_code = $('#cat_code14').attr("value");
	if(checkDate(y_from, m_from, d_from) == false)
	{
		alert("<?php echo LangUtil::$generalTerms['TIPS_DATEINVALID']; ?>");
		return;
	}
	if(checkDate(y_to, m_to, d_to) == false)
	{
		alert("<?php echo LangUtil::$generalTerms['TIPS_DATEINVALID']; ?>");
		return;
	}
	// All okay
	$('#infection_aggregate_form').submit();
}

function get_disease_report()
{
	// Validate
	var l = $("#location14").attr("value");
	
	var from_date = $("#from-date-dr").attr("value");
    var to_date = $("#to-date-dr").attr("value");
    
    dateFromArray = from_date.split("-");
    y_from = dateFromArray[0];
    m_from = dateFromArray[1];
    d_from = dateFromArray[2];
    
    dateToArray = to_date.split("-");
    y_to = dateToArray[0];
    m_to = dateToArray[1];
    d_to = dateToArray[2];

	var cat_code = $('#cat_code14').attr("value");
	if(checkDate(y_from, m_from, d_from) == false)
	{
		alert("<?php echo LangUtil::$generalTerms['TIPS_DATEINVALID']; ?>");
		return;
	}
	if(checkDate(y_to, m_to, d_to) == false)
	{
		alert("<?php echo LangUtil::$generalTerms['TIPS_DATEINVALID']; ?>");
		return;
	}
	// All okay
	$('#disease_report_form').submit();
}

function show_custom_report_form(report_id)
{
	var url_string = "report_custom.php?rid="+report_id;
	window.location = url_string;
}
</script>
<?php 
$script_elems->bindEnterToClick("#patient_id8", "#submit_button8");
$script_elems->bindEnterToClick("#session_num", "#submit_button11");
$script_elems->bindEnterToClick("#specimen_id10", "#submit_button10");
$script_elems->bindEnterToClick("#specimen_id12", "#submit_button12");
$script_elems->bindEnterToClick("#patient_id15", "#submit_button15");
?>
<?php include("includes/footer.php"); ?>
