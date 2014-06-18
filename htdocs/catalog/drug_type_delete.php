<?php
#
# Deletes a drug type from DB
# Sets disabled flag to true instead of deleting the record
# This maintains info for samples that were linked to this test type previously
#

include("../includes/db_lib.php");


$drug_type_id = $_REQUEST['id'];
DrugType::deleteById($drug_type_id);

DbUtil::switchRestore($saved_db);
SessionUtil::restore($saved_session);

header("Location: catalog.php?dtdel");
?>
