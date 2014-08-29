<?php
/**
 * This file is called by result_view.php after Verification of a test 
 * It updates result_returned to zero to allow the result be sent back to sanitas. 
 */

include("../includes/db_lib.php");
include("../ajax/push_results.php");


$test_id = get_request_variable("test_id", null);
if($test_id == null){
	//Abort 
	return 0;
}

$test = Test::getById($test_id);

$resclean = null;

if(strpos($test->decodeResult(), ":" ) == false){
    $result = $test->getResultClean();
    $to_replace = array("</b>");
    $resclean = str_replace($to_replace, "", $result);
}
update_after_verification($test_id, $resclean);
//Update parent
send_result_to_externalS();


?>