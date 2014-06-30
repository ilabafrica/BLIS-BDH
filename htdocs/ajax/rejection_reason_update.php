<?php
#
# Main page for test category type info
# Called via Ajax from test_category_edit.php
#

include("../includes/db_lib.php");
include("../lang/lang_xml2php.php");

putUILog('rejection_reason_update', 'X', basename($_SERVER['REQUEST_URI'], ".php"), 'X', 'X', 'X');

$updated_entry = new SpecimenRejectionReasons();
$updated_entry->reasonId = $_REQUEST['rr'];
$updated_entry->code = $_REQUEST['reason_code'];
$updated_entry->description = $_REQUEST['reason_description'];
$updated_entry->phase = $_REQUEST['reason_phase'];
$reff = 1;
update_rejection_reason($updated_entry);
# Update locale XML and generate PHP list again.
if($CATALOG_TRANSLATION === true)
	update_rejection_reason_xml($updated_entry->reasonId, $updated_entry->code, $updated_entry->description);
?>