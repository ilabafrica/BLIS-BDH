<?php
#
# Adds a new test type to catalog in DB
#
include("redirect.php");

include("includes/header.php");
include("includes/stats_lib.php");
include("lang/lang_xml2php.php");
include("../users/accesslist.php");

LangUtil::setPageId("stocks");

$view_update = 1;
$view_add = 1;
$view_edit = 0;
putUILog('view_stock', 'X', basename($_SERVER['REQUEST_URI'], ".php"), 'X', 'X', 'X');

if(is_admin(get_user_by_id($_SESSION['user_id']))) {
            $view_edit = 1;
            //header( 'Location: home.php' );
}
$lid = $_SESSION['$lab_config_id'];
?>


<!-- BEGIN PAGE TITLE & BREADCRUMB-->		
						<h3>
						</h3>
						<ul class="breadcrumb">
							<li>
								<i class="icon-truck"></i>
								Inventory
							</li>
						</ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
				<!-- END PAGE HEADER-->
 				<!-- BEGIN REGISTRATION PORTLETS-->   
<div class="row-fluid">
<div class="span12 sortable">
<p style="text-align: right;"><a rel='facebox' href='#view_stocks_help'>Page Help</a></p>
<div id="barcodeSearch" >
Barcode Scan Search: <input type="text" id="barcode_search_field" name="barcode_search_field" />
<input type="button" id="barcode_search_button" name="barcode_search_button" value="Search" onclick='getBarcodeSearchResults()' /> <div id="error_empty" style="display: none;"><small>&nbsp;Cannot be empty</small></div>    
<div id="barcode_search_result">

</div>

</div>
<br>
<a href='inv_new_reagent.php'> <?php echo "Add Reagent" ; ?></a> &nbsp;|&nbsp;<a href='generate_barcode.php'> <?php echo "Generate Barcodes" ; ?></a> &nbsp;| &nbsp;<b> <?php echo LangUtil::$pageTerms['Current_Inventory']; ?></b>
<table class='tablesorter' id='current_inventory'  style='width:600px'>
	<thead>
		<tr align='center'>
			<th> <?php echo LangUtil::$pageTerms['Reagent']; ?></th>
			<th> <?php echo LangUtil::$pageTerms['Quantity']; ?></th>
                        <th><?php echo "Unit"; ?></th>
                        <?php if($view_update == 1){ ?>
                        <th><?php 
                            echo "Update";
                            ?></th>
                        <?php } ?>
                        <?php if($view_add == 1){ ?>
                        <th><?php 
                            echo "Add";
                            ?></th>
                        <?php } ?>
                        <?php if($view_edit == 1){ ?>
                        <th><?php 
                            echo "Edit";
                            ?></th>
                        <?php } ?>
                       
		</tr>
	</thead>
<?php

    $reagents_list = Inventory::getAllReagents($lid);
    foreach($reagents_list as $reagent) {
?>  <tbody>
		<tr align='center'>
			<td><?php echo $reagent['name'];?></td>
			<td><?php 
                        
                            $quant = Inventory::getQuantity($lid, $reagent['id']);
                            if($quant == '')
                                echo "0";
                            else 
                                echo $quant;
                        ?></td>
			<td><?php 
                        $uni = $reagent['unit'];
                            if($uni == '')
                                echo "units";
                            else 
                                echo $uni;
                            ?></td>
                        <?php if($view_update == 1){ ?>
                        <td><?php 
                            echo "<a href='stock_lots.php?id=".$reagent['id']."'> Log Stock Usage</a>";
                            ?></td>
                        <?php } ?>
                        <?php if($view_add == 1){ ?>
                        <td><?php 
                            echo "<a href='inv_new_stock.php?id=".$reagent['id']."'> Add Stock</a>";
                            ?></td>
                        <?php } ?>
                        <?php if($view_edit == 1){ ?>
                        <td><?php 
                            echo "<a href='edit_stock.php?id=".$reagent['id']."'> Edit Details</a>";
                            ?></td>
                        <?php } ?>
                        
		</tr>
<?php 
	} 
?>
	</tbody>
</table>

<div id='view_stocks_help' class='right_pane' style='display:none;margin-left:10px;'>
<ul>	
        <?php

                echo "<li>";
                echo " Displays Inventory of all Reagents";
                echo "</li>";
                echo "<li>";
                echo " New Reagents can be added from the 'Add Reagents' link ";
                echo "</li>";
                echo "<li>";
                echo " New stocks (lots) can be added for indiviual reagents using 'Add Stocks' link ";
                echo "</li>";
                echo "<li>";
                echo " Signed out qunatities of stocks can be logged in using the 'Log Stock Usage' link";
                echo "</li>";
                echo "<li>";
                echo " Administrators can edit Reagent and Stock details";
                echo "</li>";



        ?>
</ul>
</div>

</div>
<!-- END SPAN 12 -->
</div>
<?php include("includes/scripts.php");?>
<?php
$script_elems->bindEnterToClick("#barcode_search_field", "#barcode_search_button");
$script_elems->enableFlotBasic();
$script_elems->enableFlipV();
$script_elems->enableTableSorter();
$script_elems->enableJQueryForm();
$script_elems->enableDatePicker();
$script_elems->enableTableSorter();
$script_elems->enableLatencyRecord();
?>

<script type='text/javascript'>
	$(document).ready(function(){
             $("#barcode_search_field").focus();

			$('#current_inventory').tablesorter();
	});

function getBarcodeSearchResults()
{
    var code = $('#barcode_search_field').val();
    if(code == '')
    {
        $('#error_empty').show();
        return;
    }
    //alert(code);
    $('#barcode_search_result').html('');
    var url = "inventory/get_barcode_scan_results.php?code="+code;
    $('#barcode_search_result').load(url);
}
</script>
<?php
include("includes/footer.php");
?>
