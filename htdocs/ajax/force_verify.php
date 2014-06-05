<?php

//Save froce verify settings to the lab config table

require_once("../includes/db_lib.php");

$force_verify = get_request_variable("enabled", 0);
$starttime = get_request_variable("start_time", null);
$endtime = get_request_variable("end_time", null);
$verify_on_weekends = get_request_variable("weekend", null);

$action = get_request_variable("a", null);

if ($action == "settings") {
	get_forceverify_settings();
}
else {
	update_forceverify();
}

function update_forceverify(){

	global $force_verify, $starttime, $endtime, $verify_on_weekends;
	if($starttime == null || $endtime == null || $verify_on_weekends == null ){
		return null;
	}

	$lab_config = new LabConfig();
	$lab_config->force_verify = $force_verify;
	$lab_config->starttime = $starttime;
	$lab_config->endtime = $endtime ;
	$lab_config->verify_on_weekends = $verify_on_weekends;

	$lab_config_id = get_lab_config_id_global_admin($_SESSION['user_id']);
	$response = LabConfig::update_force_verify($lab_config, $lab_config_id);

	if(isset($response)){
		echo 'Success';
	}
}

function get_forceverify_settings(){
	//Get labconfig id of which we are admin to. 
	$lab_config_id = get_lab_config_id_global_admin($_SESSION['user_id']);
	$lab_config = get_lab_config_by_id($lab_config_id);
	echo json_encode($lab_config);
}
?>