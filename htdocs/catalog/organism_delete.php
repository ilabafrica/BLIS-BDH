<?php
#
# Deletes an organism from DB
# Sets disabled flag to true instead of deleting the record
# This maintains info for samples that were linked to this test type previously
#

include("../includes/db_lib.php");


$organism_id = $_REQUEST['oid'];
Organism::deleteById($organism_id);
?>
