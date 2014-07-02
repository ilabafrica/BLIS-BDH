<?php

/**
 *  Receive requests for drug susceptibility and sends to db_lib.php for processing
 * 	 
*/


require_once("../includes/db_lib.php");
 
//print_r($_POST);// you will get an array of all the values
$test = $_POST['test'];
$drug = $_POST['drug'];
$organism = $_POST['organism'];
$zone = $_POST['zone'];
$interpretation = $_POST['interpretation'];
$action = $_REQUEST['action'];
$testId = $_REQUEST['testId'];
$organismId = $_REQUEST['organismId'];

/*Get user ID*/
$userId = $_SESSION['user_id'];
//print_r(count(array_values ($test)));
for($i=0; $i<count($test); $i++){
	$exists[$i] = DrugSusceptibility::getDrugSusceptibility($test[$i],$organism[$i],$drug[$i]);
	if($exists[$i]){
		DrugSusceptibility::updateSusceptibility($userId,$test[$i],$organism[$i],$drug[$i],$zone[$i],$interpretation[$i]);
	}else{
		DrugSusceptibility::addSusceptibility($userId,$test[$i],$organism[$i],$drug[$i],$zone[$i],$interpretation[$i]);
	}
	
}
if ($action == "results"){
	$susceptibility = DrugSusceptibility::getDrugSuceptibilityResults($testId, $organismId);
	foreach ($susceptibility as $drugSusceptibility) {
		$drugSusceptibility->drugName = DrugType::getDrugNameById($drugSusceptibility->drugId);
		$drugSusceptibility->pathogen = get_organism_by_id($organismId)->name;
	}

	echo json_encode($susceptibility);
	}
	//echo "Successfully saved!"

?>