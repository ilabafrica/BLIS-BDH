drug_type_id<?php
#
# Deletes an organism from DB
# Sets disabled flag to true instead of deleting the record
# This maintains info for samples that were linked to this test type previously
#

include("../includes/db_lib.php");


$organism_id = $_REQUEST['id'];
Organism::deleteById($organism_id);

DbUtil::switchRestore($saved_db);
SessionUtil::restore($saved_session);

header("Location: catalog.php?odel");
?>
