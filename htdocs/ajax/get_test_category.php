<?php
#
#Get Specimen details after receiving request
#
include("../includes/db_lib.php");
$labNo = $_REQUEST['labno'];

$specimen = Specimen::getLabSectionByextLabNo($labNo);
echo $specimen->bench.'%'.$specimen->specimenId;

?>