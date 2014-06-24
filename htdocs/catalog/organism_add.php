<?php
#
# Adds a new organism to catalog in DB
#
include("redirect.php");
include("includes/db_lib.php");
include("lang/lang_xml2php.php");


putUILog('organism_add', 'X', basename($_SERVER['REQUEST_URI'], ".php"), 'X', 'X', 'X');

$reff = 1;
$organism_description = $_REQUEST['organism_desc'];

# Add new organism
$new_organism_name = $_REQUEST['organism_name'];
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
echo json_encode($drugs_list);
# End fetch compatible drug types
$new_organism_id = add_organism($new_organism_name, $organism_description, $drugs_list);

header("location: organism_added.php?o=$new_organism_name");
?>