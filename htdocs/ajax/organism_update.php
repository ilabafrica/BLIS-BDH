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

# Fetch compatible drug types
$drugs_list = array();

$catalog_drugs_list = get_drug_types_catalog($lab_config_id, $reff);
foreach($catalog_drugs_list as $drugs_typeid=>$drugs_name)
{
    if(isset($_REQUEST['d_type_'.$drugs_typeid]))
    {
        $drugs_list[] = $drugs_typeid;
    }
}
# End fetch compatible drug types
update_organism($updated_entry, $drugs_list);

# Update locale XML and generate PHP list again.
if($CATALOG_TRANSLATION === true)
	update_organism_xml($updated_entry->organismId, $updated_entry->name);
?>