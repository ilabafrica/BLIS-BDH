<?php
#
# Adds a new organism to catalog in DB
#
include("redirect.php");
include("includes/db_lib.php");
include("lang/lang_xml2php.php");


putUILog('organism_add', 'X', basename($_SERVER['REQUEST_URI'], ".php"), 'X', 'X', 'X');


$organism_description = $_REQUEST['organism_desc'];

	# Add new organism
	$new_organism_name = $_REQUEST['organism_name'];
	$new_organism_id = add_organism($new_organism_name, $organism_description);

header("location: organism_added.php?o=$new_organism_name");
?>