<?php

//Save froce verify settings to the lab config table

require_once("../includes/db_lib.php");

$force_verify = get_request_variable("force_verify", null);
$starttime = get_request_variable("startt", null);
$endtime = get_request_variable("endt", null);
$verify_on_weekends = get_request_variable("verify_on_weekends", null);

$action = get_request_variable("a", null);

if ($action == "settings") {
	get_forceverify_settings();
}
else {
	update_forceverify();
}

function update_forceverify(){

	if($starttime == null || $endtime == null || $verify_on_weekends == null ){
		return null;
	}

	$lab_config = new LabConfig(); 

	$lab_config->force_verify = $force_verify; 
	$lab_config->starttime = $starttime;
	$lab_config->endtime = $endtime ;
	$lab_config->verify_on_weekends = $verify_on_weekends;

	LabConfig::update_force_verify();

}

function get_forceverify_settings(){
	//Get labconfig id of which we are admin to. 
	$lab_config_id = get_lab_config_id_global_admin($_SESSION['user_id']);
	$lab_config = get_lab_config_by_id($lab_config_id);
	echo json_encode($lab_config);
}
?>