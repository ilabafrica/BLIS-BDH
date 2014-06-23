<?php
#
# Shows turnaround time report for a site/location and date interval 
#
include("redirect.php");
include("includes/header.php");
include("includes/stats_lib.php");
LangUtil::setPageId("reports");
$lab_config_id = get_request_variable('location', '301'); //301  is Bungoma - Hardcoded
$defaultDate = date("Y-m-d", time());
$date_from = get_request_variable('from-report-date', $defaultDate);
$date_to = get_request_variable('to-report-date', $defaultDate);
$include_pending = get_request_variable('pending', false);
$uiinfo = "from=".$date_from."&to=".$date_to."&ip=".($include_pending?"Y":"N");
putUILog('reports_tat', $uiinfo, basename($_SERVER['REQUEST_URI'], ".php"), 'X', 'X', 'X');

?>
 <!-- BEGIN PAGE TITLE & BREADCRUMB-->       
            <h3>
            </h3>
            <ul class="breadcrumb">
                <li>
                    <i class="icon-home"></i>
                    <a href="index.html">Home</a> 
                    <span class="icon-angle-right"></span>
                </li>
                <li><a href="#">Reports</a>
                <span class="icon-angle-right"></span></li>
                <li><a href="#"></a></li>
            </ul>
            <!-- END PAGE TITLE & BREADCRUMB-->
        </div>
    </div>
    <!-- END PAGE HEADER-->
    
    <!-- BEGIN ROW-FLUID-->                   
<div class="row-fluid">
<div class="span12 sortable">

    <div class="portlet box green" id="prevalence_div">
        <div class="portlet-title" >
            <h4><i class="icon-reorder"></i><?php echo LangUtil::$pageTerms['MENU_TAT']; ?></h4>
            <a href='reports.php?show_t' style="float:right; color:#ffffff;">
                &laquo; <?php echo LangUtil::$pageTerms['MSG_BACKTOREPORTS']; ?></a>
        </div>
        
          <div class="portlet-body" >
              
                <?php
                $lab_config = get_lab_config_by_id($lab_config_id);
                $site_list = get_site_list($_SESSION['user_id']);
                if($lab_config != null && count($site_list) != 1)
                {
                    ?>
                    | <?php echo LangUtil::$generalTerms['FACILITY'] ?>: <?php echo $lab_config->getSiteName(); ?>
                    <?php
                }
                ?>
                 
                <?php
                if($lab_config == null)
                {
                    ?>
                    <div class='sidetip_nopos'>
                        <?php echo LangUtil::$generalTerms['MSG_NOTFOUND']; ?> <a href='javascript:history.go(-1);'>&laquo; <?php echo LangUtil::$generalTerms['CMD_BACK']; ?></a>
                    </div>
                    <?php
                    return;
                }
                
                DbUtil::switchToLabConfig($lab_config_id);
                ?>
                <div class="container-fluid graph-filter">
                    <div class="row">
                        <div class="span12">
                            <span class="tat-label"><?php echo LangUtil::$generalTerms['FROM_DATE']; ?></span>
                            <div class="input-append date date-picker" data-date="<?php echo date("Y-m-d"); ?>" data-date-format="yyyy-mm-dd"> 
                                <input class="m-wrap m-ctrl-medium" size="16" name="from-report-date" id="from-date-tat" type="text" value="<?php echo $date_from ?>"><span class="add-on"><i class="icon-calendar"></i></span>
                            </div>
                            <span class="tat-label"><?php echo LangUtil::$generalTerms['TO_DATE']; ?></span>
                            <div class="input-append date date-picker" data-date="<?php echo date("Y-m-d"); ?>" data-date-format="yyyy-mm-dd"> 
                                <input class="m-wrap m-ctrl-medium" size="16" name="to-report-date" id="to-date-tat" type="text" value="<?php echo $date_to ?>"><span class="add-on"><i class="icon-calendar"></i></span>
                             </div></div><br>
                    </div>
                    <div class="row">
                        <div class="span12">
                            <span class="tat-label"><?php echo LangUtil::$generalTerms['LAB_SECTION']; ?></span>
                            <select name='cat_code' id='cat_code13' class='uniform_width'>
                                <option value='0'><?php echo LangUtil::$generalTerms['ALL']; ?></option>
                                <?php
                                    $page_elems->getTestCategorySelect();
                                ?>
                            </select>
                            <span class="tat-label"><?php echo LangUtil::$generalTerms['TEST_TYPE']; ?></span>
                            <select name='ttype' id='ttype' style='font-family:Tahoma;'>
                                <option value='0'><?php echo LangUtil::$generalTerms['ALL']; ?></option>
                                <?php $page_elems->getTestTypesSelect($lab_config->id); ?>
                            </select>
                            <span class="tat-label">Interval</span>
                            <select name='tattype' id='tattype' style='font-family:Tahoma;'>
                                <option value='m'><?php echo LangUtil::$pageTerms['PROGRESSION_M']; ?></option>
                                <option value='w' selected><?php echo LangUtil::$pageTerms['PROGRESSION_W']; ?></option>
                                <option value='d'><?php echo LangUtil::$pageTerms['PROGRESSION_D']; ?></option>
                            </select>
                        <a href="javascript:void(0);" class="btn" onclick='javascript:view_tat();'>
                            <?php echo LangUtil::$generalTerms['CMD_VIEW']; ?></a>
                        <span id='progress_spinner' style='display:none'>
                            <?php $page_elems->getProgressSpinner(LangUtil::$generalTerms['CMD_FETCHING']); ?></span>
                        </div>
                    </div>
                </div>
                <span style="display:none;"><input type="checkbox" id='pending_chk' name='pending' />
                        <?php echo LangUtil::$pageTerms['MSG_INCLUDEPENDING']; ?></span>
                <?php
                $stat_list = StatsLib::getTatStats($lab_config, $date_from, $date_to);
                if(count($stat_list) == 0)
                {
                    ?>
                    <br>
                    <div class='sidetip_nopos'>
                    <?php echo LangUtil::$pageTerms['TIPS_NOTATTESTS']; ?>
                    </div>
                    <?php
                }
                ?>
                <div id='stats_testwise_div'></div>
                <div id='stats_cumul_div'></div>
          </div>
     </div>
</div>
</div>     

<?php
include("includes/scripts.php");
$script_elems->enableFlotBasic();
$script_elems->enableFlipV();
$script_elems->enableTableSorter();
$script_elems->enableLatencyRecord();
$script_elems->enableDatePicker();
?>
<script type="text/javascript" src="js/highcharts.js"></script>
<script type='text/javascript'>
$(document).ready(function(){
    <?php
    if($include_pending === true)
    {
        ?>
        $('#pending_chk').attr('checked', true);
        <?php
    }
    ?>
    view_testwise_weekly();
    $('#cat_code13').change( function() { get_test_types_bycat() });
    $('#progress_spinner').hide();
});
function get_test_types_bycat()
{
    var cat_code = $('#cat_code13').attr("value");
    //TODO: Remove Hardcoded for BGM below 301
    $('#ttype').load('ajax/tests_selectbycat.php?c='+cat_code+'&l=301');
}

function toggle_stat_table()
{
    $('#stat_table').toggle();
    var linktext = $('#showtablelink').text();
    if(linktext.indexOf("<?php echo LangUtil::$pageTerms['MSG_SHOWTABLE']; ?>") != -1)
        $('#showtablelink').text("<?php echo LangUtil::$pageTerms['MSG_HIDETABLE']; ?>");
    else
        $('#showtablelink').text("<?php echo LangUtil::$pageTerms['MSG_SHOWTABLE']; ?>");
}

function view_cumul()
{
    $('#progress_spinner').show();
    $('#stats_testwise_div').hide();
    $('#stats_cumul_div').show();
    $('#progress_spinner').hide();
}

function view_testwise_monthly()
{
    var date_from = $("#from-date-tat").attr("value");
    var date_to = $("#to-date-tat").attr("value");
    
    dateFromArray = date_from.split("-");
    yf = dateFromArray[0];
    mf = dateFromArray[1];
    df = dateFromArray[2];
    
    dateToArray = date_to.split("-");
    yt = dateToArray[0];
    mt = dateToArray[1];
    dt = dateToArray[2];
    
    var include_pending = 0;
    if($('#pending_chk').is(':checked'))
    {
        include_pending = 1;
    }
    if(checkDate(yf, mf, df) == false)
    {
        alert("<?php echo LangUtil::$generalTerms['TIPS_DATEINVALID']; ?>");
        return;
    }
    if(checkDate(yt, mt, dt) == false)
    {
        alert("<?php echo LangUtil::$generalTerms['TIPS_DATEINVALID']; ?>");
        return;
    }
    $('#progress_spinner').show();
    var ttype = $('#ttype').attr("value");
    var tcat = $('#cat_code13').attr("value");
    var url_string = "ajax/tat_ttype_monthly.php?tt="+ttype+"&tc="+tcat+"&df="+date_from+"&dt="+date_to+"&l=<?php echo $lab_config_id; ?>&p="+include_pending;
    $('#stats_testwise_div').load(url_string, function() {
        $('#stats_testwise_div').show();
        $('#stats_cumul_div').hide();
        $('#progress_spinner').hide();
    });
}

function view_testwise_weekly()
{
    var date_from = $("#from-date-tat").attr("value");
    var date_to = $("#to-date-tat").attr("value");
    
    dateFromArray = date_from.split("-");
    yf = dateFromArray[0];
    mf = dateFromArray[1];
    df = dateFromArray[2];
    
    dateToArray = date_to.split("-");
    yt = dateToArray[0];
    mt = dateToArray[1];
    dt = dateToArray[2];
    
    var include_pending = 0;
    if($('#pending_chk').is(':checked'))
    {
        include_pending = 1;
    }
    if(checkDate(yf, mf, df) == false)
    {
        alert("<?php echo LangUtil::$generalTerms['TIPS_DATEINVALID']; ?>");
        return;
    }
    if(checkDate(yt, mt, dt) == false)
    {
        alert("<?php echo LangUtil::$generalTerms['TIPS_DATEINVALID']; ?>");
        return;
    }
    $('#progress_spinner').show();
    var ttype = $('#ttype').attr("value");
    var tcat = $('#cat_code13').attr("value");
    var url_string = "ajax/tat_ttype_weekly.php?tt="+ttype+"&tc="+tcat+"&df="+date_from+"&dt="+date_to+"&l=<?php echo $lab_config_id; ?>&p="+include_pending;
    $('#stats_testwise_div').load(url_string, function() {
        $('#stats_testwise_div').show();
        $('#stats_cumul_div').hide();
        $('#progress_spinner').hide();
    });
}

function view_testwise_daily()
{
    var date_from = $("#from-date-tat").attr("value");
    var date_to = $("#to-date-tat").attr("value");
    
    dateFromArray = date_from.split("-");
    yf = dateFromArray[0];
    mf = dateFromArray[1];
    df = dateFromArray[2];
    
    dateToArray = date_to.split("-");
    yt = dateToArray[0];
    mt = dateToArray[1];
    dt = dateToArray[2];
    
    var include_pending = 0;
    if($('#pending_chk').is(':checked'))
    {
        include_pending = 1;
    }
    if(checkDate(yf, mf, df) == false)
    {
        alert("<?php echo LangUtil::$generalTerms['TIPS_DATEINVALID']; ?>");
        return;
    }
    if(checkDate(yt, mt, dt) == false)
    {
        alert("<?php echo LangUtil::$generalTerms['TIPS_DATEINVALID']; ?>");
        return;
    }
    $('#progress_spinner').show();
    var ttype = $('#ttype').attr("value");
    var tcat = $('#cat_code13').attr("value");
    var url_string = "ajax/tat_ttype_daily.php?tt="+ttype+"&tc="+tcat+"&df="+date_from+"&dt="+date_to+"&l=<?php echo $lab_config_id; ?>&p="+include_pending;
    $('#stats_testwise_div').load(url_string, function() {
        $('#stats_testwise_div').show();
        $('#stats_cumul_div').hide();
        $('#progress_spinner').hide();
    });
}

function view_tat()
{
    var tat_type = $('#tattype').attr("value");
    if(tat_type == 'm')
        view_testwise_monthly();
    else if(tat_type == 'w')
        view_testwise_weekly();
    else if(tat_type == 'd')
        view_testwise_daily();      
}
</script>
<?php include("includes/footer.php"); ?>