<?php
#
# Deletes a specimen rejection phase from DB
# Sets disabled flag to true instead of deleting the record
# This maintains info for samples that were linked to this test type previously
#

include("../includes/db_lib.php");


$phase_id = $_REQUEST['rp'];
SpecimenRejectionPhases::deleteById($phase_id);
?>
