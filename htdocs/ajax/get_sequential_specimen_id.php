<?php
include("../includes/db_lib.php");

$real_specimen_id = $_REQUEST['s'];
echo get_sequential_specimen_id($real_specimen_id);
?>
