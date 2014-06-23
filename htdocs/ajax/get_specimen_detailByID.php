<?php
#
#Get Specimen details after accepting
#
include("../includes/db_lib.php");
$specimenId = $_REQUEST['sid'];
$specimen = Specimen::getById($specimenId);
echo $specimen->ts_collected;

?>