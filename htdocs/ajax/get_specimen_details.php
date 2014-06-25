<?php
#
#Get Specimen details after received
#
include("../includes/db_lib.php");
$labNo = $_REQUEST['labno'];


$test = Test::getByExternalLabno($labNo);
$specimen = Specimen::getById($test->specimenId);
 echo $test->specimenId."%".$test->testId."%".$specimen->getLabSection();

?>