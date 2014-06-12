<?php
# (c) C4G, Santosh Vempala, Ruban Monu and Amol Shintre
# Contains DB connection parameters
# Include in db_mysql_lib.php
#

if(session_id() == "")
	session_start();
	
# Flag for toggling between local machine, portable version and arc server
$ON_DEV = 1;
$ON_ARC = 2;
$ON_PORTABLE = 3;

$SERVER = $ON_DEV;
/*
 * Language Definitions Folder Path Settings
 */
$LOCAL_PATH = "../locale/";
if($SERVER == $ON_ARC)
{
	$LOCAL_PATH = "../local/";
}

/*
 * Database Settings
 */

$DB_HOST = "localhost";
$DB_USER = "root";
$GLOBAL_DB_NAME="blis_revamp_prod";

$DB_NAME = $GLOBAL_DB_NAME;	

$DB_PASS = "";

//@lisAdmin#

if($SERVER == $ON_DEV)
{
	$DB_PASS = "";
}
else if($SERVER == $ON_ARC)
{
	$DB_PASS = "";
}
else if($SERVER == $ON_PORTABLE)
{
	$DB_PASS = "";
}

if(isset($_SESSION['username']))
{
	# User has logged in
	if($_SESSION['db_name'] == "")
		# Admin level user - keep global DB instance
		$DB_NAME = $GLOBAL_DB_NAME;
	else
		# Technician user - Narrow down to local instance
		$DB_NAME = $_SESSION['db_name'];
}
?>
