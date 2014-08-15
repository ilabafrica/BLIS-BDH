<?php
#
# Restores a drug type from DB
# This maintains info for samples that were linked to this test type previously
#

include("../includes/db_lib.php");


$drug_id = $_REQUEST['did'];
DrugType::restoreById($drug_id);
?>
