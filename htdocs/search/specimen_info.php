<?php
#
# Main page for showing specimen info
#
$is_modal=false;
if(isset($_REQUEST['modal']))$is_modal=true;

if(!$is_modal){
	include("redirect.php");
	include("includes/header.php");
}else if ($is_modal){
	require_once("../includes/db_lib.php");
	require_once("../includes/page_elems.php");
	require_once("../includes/script_elems.php");
	$script_elems = new ScriptElems();
	$page_elems = new PageElems();
}
LangUtil::setPageId("specimen_info");
$sid = $_REQUEST['sid'];
$status = get_specimen_status($sid);
$script_elems->enableDatePicker();
$script_elems->enableTableSorter();
$specimen = get_specimen_by_id($sid);
$test_type = get_test_type_by_name($specimen->getTestNames());
$test = get_test_by_specimen_id($specimen->specimenId);
?>
<?php if(!$is_modal){?>
<!-- BEGIN PAGE TITLE & BREADCRUMB-->       
                        <h3>
                        </h3>
                        <ul class="breadcrumb">
                            <li>
                                <i class="icon-download-alt"></i>
                                <a href="index.php">Home</a> 
                            </li>
                        </ul>
                        <!-- END PAGE TITLE & BREADCRUMB-->
                    </div>
                </div>
                <!-- END PAGE HEADER-->
<?php }
if($is_modal){
    $sid_link = "spec_link_$sid";
?>
<div class="modal-header">
	<a id="<?php echo $sid_link; ?>" href="javascript:close_modal('<?php echo $sid_link; ?>');" class="close"></a>
	<h4><i class="icon-info-sign"></i> Specimen Details</h4>
</div>
<?php }?>
             <div class="row-fluid">
                <div class="span12 sortable">

                    <div class="portlet box green" id="specimenresult_div">
                   <?php 
                    if(!$is_modal){?>
                        <div class="portlet-title" >
                            <h4><i class="icon-reorder"></i> <?php echo LangUtil::getTitle(); ?> </h4>           
                        </div>
                   <?php }?>
                          <div class="portlet-body" >
                                <?php 
                                if(!$is_modal){
									?>
									<br>
                                 <a href='javascript:history.go(-1);' class="btn">&laquo; <?php echo LangUtil::$generalTerms['CMD_BACK']; ?></a>
                                 <br><br>
                                 <?php }?>
                                
                                <?php
                                if(isset($_REQUEST['vd']))
                                {
                                    # Directed from specimen_verify_do.php
                                    ?>
                                    <span class='clean-orange' id='msg_box'>
                                        <?php echo LangUtil::$pageTerms['TIPS_VERIFYDONE']; ?> &nbsp;&nbsp;<a href="javascript:toggle('msg_box');"><?php echo LangUtil::$generalTerms['CMD_HIDE']; ?></a>&nbsp;&nbsp;
                                    </span>
                                    <?php
                                }
                                else if(isset($_REQUEST['re']))
                                {
                                    # Directed form specimen_result_do.php
                                    ?>
                                    <span class='clean-orange' id='msg_box'>
                                        <?php echo LangUtil::$pageTerms['TIPS_ENTRYDONE']; ?> &nbsp;&nbsp;<a href="javascript:toggle('msg_box');"><?php echo LangUtil::$generalTerms['CMD_HIDE']; ?></a>&nbsp;&nbsp;
                                    </span>
                                    <?php   
                                }
                                
                                ?>
                                <table>
                                    <tr valign='top'>
                                        <td>
                                        <?php $page_elems->getSpecimenInfo($sid); ?>
                                        </td>
                                        <td>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        </td>
                                        <td>
                                            <?php $page_elems->getSpecimenTaskList($sid); ?>
                                        </td>
                                    </tr>
                                </table>
                                <span id='fetch_progress_bar' style='display:none;'>
                                                    <?php $page_elems->getProgressSpinner(LangUtil::$generalTerms['CMD_SEARCHING']); ?>
                                                </span> 
                                <div class='result_form_pane' id='result_form_pane_<?php echo $sid; ?>'>
                                        </div>
                                <br>
                                <hr />
                                <b><?php 
                                if($status != Specimen::$STATUS_REJECTED){
                                    echo LangUtil::$pageTerms['REGDTESTS']; ?></b><br>
                                
                                <?php 
                                    $page_elems->getSpecimenTestsTable($sid); 
                                }
                                else{
                                    echo '<h4>Specimen Rejection Report</h4>'; ?></b><br>
                                
                                <?php 
                                    $page_elems->getSpecimenRejectionDetails($sid);
                                }
                                ?>
                                <hr />
                                <?php if ($test_type->showCultureWorkSheet) {?>
                                <br />
                                <h5>CULTURE OBSERVATIONS AND WORKUP</h5>
                                <table class="table table-bordered table-advanced table-condensed">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Initials</th>
                                                <th>Observations and work-up</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbbody_<?php echo $test->testId ?>">
                                        <?php 
                                            $obsv = Culture::getAllObservations($test->testId);
                                            if($obsv != null){
                                            foreach ($obsv as  $Observation) { ?>
                                                <tr>
                                                <td><?php echo $Observation->time_stamp; ?></td>
                                                <td><?php echo get_username_by_id($Observation->userId) ?></td>
                                                <td><?php echo $Observation->observation ?></td>
                                                <td></td>
                                                </tr>
                                                <?php } 
                                            }
                                            else { ?>
                                                <tr>
                                                <td colspan="3"><?php echo "No Observations have been entered yet."; ?></td>
                                                </tr>
                                                <?php
                                            }
                                            ?>          
                                        </tbody>
                                </table>
                                <!-- Begin checkboxes for possible organisms to be isolated -->
                                <br />
                                <h5>SUSCEPTIBILITY RESULTS</h5>
                                <?php 
                                    $pathogens = get_compatible_organisms($test->testTypeId);
                                    $page_elems->getOrganismsCheckboxesForCultureReport($test->testTypeId, $test->testId);
                                    $checked = false;
                                    $isolations = get_isolated_organisms($test->testId); 
                                ?>
                                <!-- End possible organisms checkboxes -->
                                <!-- Begin Drug Susceptibility Tests table -->
                                <br />
                                <div class="portlet box grey ">
                                                    <div class="portlet-title">
                                                        <i class="fa fa-reorder"></i> <h5>SUSCEPTIBILITY TEST RESULTS</h5>
                                                    </div>
                                                    <div class="portlet-body form">
                                                    <?php foreach ($pathogens as $id) {
                                                        $pathogen = $id;
                                                        $organism = get_organism_by_id($pathogen);
                                                        foreach($isolations as $pathogenId){
        
                                                         if ($pathogen==$pathogenId)
                                                            $checked =true;
                                                        }
                                                    ?>
                                                    <form role="form" id="drugs_susceptibility_<?php echo $pathogen; ?>" <?php if($checked){ ?>style="display:block;"<?php }else{ ?>style="display:none;"<?php } ?>>
                                                            <div class="form-body">
                                                                <table class="table table-bordered table-advanced table-condensed">
                                                                    <thead>
                                                                        <tr>
                                                                            <th colspan="3"><?php echo "Organism: ".$organism->name; ?></th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Drug</th>
                                                                            <th>Zone (mm)</th>
                                                                            <th>Interpretation (S,I,R)</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="enteredResults_<?php echo $pathogen; ?>">
                                                                    <?php 
                                                                        $test_type_id = get_test_type_id_from_test_id($test->testId);
                                                                        $drug = get_compatible_drugs($pathogen);
                                                                        if($drug != null){
                                                                            foreach ($drug as  $drugs) { $drugs_value = DrugType::getById($drugs);
                                                                            $sensitivity = DrugSusceptibility::getDrugSusceptibility($test->testId, $pathogen, $drugs);
                                                                            ?>
                                                                            <tr>
                                                                            <input type="hidden" name="test[]" id="test[]" value="<?php echo $test->testId; ?>">
                                                                            <input type="hidden" name="drug[]" id="drug[]" value="<?php echo $drugs; ?>">
                                                                            <input type="hidden" name="organism[]" id="organism[]" value="<?php echo $pathogen; ?>">
                                                                            <td><?php echo $drugs_value->name; ?></td>
                                                                            <td><?php if($sensitivity!=null){echo $sensitivity['zone'];} ?></td>
                                                                            <td><?php echo $sensitivity['interpretation']; ?></td>
                                                                            </tr>
                                                                            <?php } 
                                                                            }
                                                                            else{
                                                                            ?>
                                                                            <tr>
                                                                            <td colspan="4"><?php echo "No Drugs linked to this test. Please consult the Lab In-Charge." ?></td>
                                                                            </tr>
                                                                            <?php } ?>          
                                                                    </tbody>
                                                                    
                                                            </table>
                                                            </div>
                                                        </form>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                <!-- End Drug Susceptibility Tests table -->

                                <?php
                                } //End Show worksheet conditionally
                                ?>
                          </div>
                  </div>
              </div>
           </div>   

<script type='text/javascript'>
function fetch_specimen2(specimen_id)
{
    
    $('#fetch_progress_bar').show();
    var pg=1;
    var url = 'ajax/specimen_form_fetch.php';
    //var target_div = "fetch_specimen";
    $('.result_form_pane').html("");
    var target_div = "result_form_pane_"+specimen_id;
    $("#"+target_div).load(url, 
        {sid: specimen_id , page_id:pg}, 
        function() 
        {
            $('#fetch_progress_bar').hide();
            $("#fetched_specimen").show();
        }
    );
}
</script>

<?php if(!$is_modal){
	include("includes/footer.php"); 
}else if($is_modal){
?>
<div class="modal-footer">
<button type="button" data-dismiss="modal" class="btn" onclick='javascript:remove_modal("specimen_info");'>Close</button>
</div>
<?php 
}
?>