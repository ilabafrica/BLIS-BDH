<?php
#
# Main page for organism upadating
# Called via Ajax from organism_edit.php
#

include("../includes/db_lib.php");
include("../lang/lang_xml2php.php");

putUILog('organism_update', 'X', basename($_SERVER['REQUEST_URI'], ".php"), 'X', 'X', 'X');

$updated_entry = new Organism();
$updated_entry->organismId = $_REQUEST['oid'];
$updated_entry->name = $_REQUEST['name'];
$updated_entry->description = $_REQUEST['description'];
$reff = 1;
update_organism($updated_entry);
# Update locale XML and generate PHP list again.
if($CATALOG_TRANSLATION === true)
	update_organism_xml($updated_entry->organismId, $updated_entry->name);
?>