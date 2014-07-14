<?php
#
# Restores a specimen rejection reason from DB
# Sets disabled flag to true instead of deleting the record
# This maintains info for samples that were linked to this test type previously
#

include("../includes/db_lib.php");


$reason_id = $_REQUEST['rr'];
SpecimenRejectionReasons::restoreById($reason_id);
?>
