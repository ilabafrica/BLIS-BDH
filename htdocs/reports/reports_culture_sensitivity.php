<?php
#
# Main page for showing disease report and options to export
# Called via POST from reports.php
#
include("redirect.php");
include("includes/db_lib.php");
include("includes/stats_lib.php");
include("includes/script_elems.php");
LangUtil::setPageId("reports");

include("../users/accesslist.php");
 if(!(isLoggedIn(get_user_by_id($_SESSION['user_id']))))
    header( 'Location: home.php' );

$script_elems = new ScriptElems();
$script_elems->enableJQuery();
?>
<script type='text/javascript'>
function export_as_word()
{
    var html_data = $('#report_content').html();
    $('#word_data').attr("value", html_data);
    //$('#export_word_form').submit();
    $('#word_format_form').submit();
}

function print_content(div_id)
{
    var DocumentContainer = document.getElementById(div_id);
    var WindowObject = window.open("", "PrintWindow", "toolbars=no,scrollbars=yes,status=no,resizable=yes");
    WindowObject.document.writeln(DocumentContainer.innerHTML);
    WindowObject.document.close();
    WindowObject.focus();
    WindowObject.print();
    WindowObject.close();
    //javascript:window.print();
}
</script>
<form name='word_format_form' id='word_format_form' action='export_word.php' method='post' target='_blank'>
    <input type='hidden' name='data' value='' id='word_data' />
    <input type='hidden' name='lab_id' value='<?php echo $lab_config_id; ?>' id='lab_id'>
    <input type='button' onclick="javascript:print_content('report_content');" value='<?php echo LangUtil::$generalTerms['CMD_PRINT']; ?>'></input>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <input type='button' onclick="javascript:export_as_word();" value='<?php echo LangUtil::$generalTerms['CMD_EXPORTWORD']; ?>'></input>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <input type='button' onclick="javascript:window.close();" value='<?php echo LangUtil::$generalTerms['CMD_CLOSEPAGE']; ?>'></input>
</form>
<hr>

<div id='report_content'>
<link rel='stylesheet' type='text/css' href='css/table_print.css' />
<b><?php echo "Culture Report"; ?></b>
<br><br>
<?php
$lab_config_id = $_REQUEST['location'];
$lab_config = LabConfig::getById($lab_config_id);
if($lab_config == null)
{
    echo LangUtil::$generalTerms['MSG_NOTFOUND'];
    return;
}
$date_from = $_REQUEST['from-report-date'];
$date_to = $_REQUEST['to-report-date'];
$uiinfo = "from=".$date_from."&to=".$date_to;
putUILog('reports_culture_sensitivity', $uiinfo, basename($_SERVER['REQUEST_URI'], ".php"), 'X', 'X', 'X');

?>
<table>
    <tbody>
        <tr>
            <td><?php echo LangUtil::$generalTerms['FACILITY']; ?>:</td>
            <td><?php echo $lab_config->getSiteName(); ?></td>
        </tr>
        <tr>
            <td><?php echo LangUtil::$pageTerms['REPORT_PERIOD']; ?>:</td>
            <td>
            <?php
            if($date_from == $date_to)
            {
                echo DateLib::mysqlToString($date_from);
            }
            else
            {   
                echo DateLib::mysqlToString($date_from)." to ".DateLib::mysqlToString($date_to);
            }
            ?>
            </td>
        </tr>
        
        
    </tbody>
</table>
<?php
    $test_types_list = get_test_types_for_culture($lab_config->id);
    $orgs = get_organisms_catalog($lab_config->id);
?>
<br>
<table class="reports-specimen-count">
    <thead>
        <tr>
            <th rowspan='2'><?php echo "Organism"; ?></th>
            <?php
            echo "<th colspan='".count($test_types_list)."'>"."Specimen Type"."</th>";
            echo "<th rowspan='2'>"."Total"."</th>";
            ?>
                        
        </tr>
        <tr>
            <?php       
            foreach($test_types_list as $test_type_id)
            {
                $specimen_type_id = TestType::getSpecimenIdByTestName($test_type_id);
                $specimen_type = get_specimen_type_by_id($specimen_type_id);
                echo "<th>".$specimen_type->name."</th>";
            }
            ?>
        <tr>
    </thead>
    <tbody>
        <?php
            foreach($orgs as $key=>$value)
            {
                $total = get_culture_susceptibility_count_total($lab_config_id, $key, $date_from, $date_to);
                    
                echo "<tr valign='top' class='range-data'>";
                echo "<td class='specimen-name'>$value</td>";
                
                foreach($test_types_list as $test_type_id) {
                    $count = get_culture_susceptibility_count_by_organism($lab_config_id, $key, $test_type_id, $date_from, $date_to);
                    echo "<td>".$count."</td>";
                }
                echo "<td>".$total."</td";
                # Group by age set to true: Fetch age slots from DB
                
                echo "</tr>";
                } 
        ?>
 <!-- ********************************************************************** -->
    
    </tbody>
</table>
<br><br><br>
............................................
</div>