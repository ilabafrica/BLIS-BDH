<?php
include("redirect.php");
include("../includes/db_lib.php");

/*
echo "<pre>";
print_r($_POST);
echo "</pre>";
*/

putUILog('ret_tests', 'X', basename($_SERVER['REQUEST_URI'], ".php"), 'X', 'X', 'X');

$lid = $_SESSION['lab_config_id'];
$sp = $_POST['specs'];
$count = count($sp);
for($i = 0; $i < $count; $i++)
{
    retrieve_specimens($lid, $sp[$i]);
}

$url = "Location:../".$_POST['url'];
header( $url );

?>
