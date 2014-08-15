<?php
#
# Restores an organism from DB
# This maintains info for samples that were linked to this test type previously
#

include("../includes/db_lib.php");


$organism_id = $_REQUEST['oid'];
Organism::restoreById($organism_id);
?>
