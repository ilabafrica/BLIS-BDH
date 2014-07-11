<?php
#
# Deletes a specimen rejection phase from DB
# Sets disabled flag to true instead of deleting the record
# This maintains info for samples that were linked to this test type previously
#

include("../includes/db_lib.php");


$reason_id = $_REQUEST['rr'];
SpecimenRejectionReasons::deleteById($reason_id);

DbUtil::switchRestore($saved_db);
SessionUtil::restore($saved_session);

header("Location: catalog.php?rdel");
?>
