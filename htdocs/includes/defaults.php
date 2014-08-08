<?php
#
# (c) C4G, Santosh Vempala, Ruban Monu and Amol Shintre
# Contains defaults for missing or incomplete DB tables and other system parameters
# Included at the beginning on includes/db_lib.php
#

# System version number displayed on page title and footer
$VERSION = "2.5";

# Debug mode
$DEBUG = false;

# Default language for the system
# Used to fetch appropriate locale file from lang/$DEFAULT_LANG.php
$DEFAULT_LANG = "default";

# Lab Id Starts for various countries
$labIdArray = array(
	"Cameroon" => 1,
	"Ghana" => 1001,
	"Uganda" => 2001,
	"Tanzania" => 3001,
	 "Drc" =>4001
);

# Default target turnaround time value (in Hours) for tests if not yet specified by lab admin
# Can be modified by lab admin on config/lab_config_home.php
$DEFAULT_TARGET_TAT = 1;

# Default turnaround time value (in Hours) for tests that are still pending
# Can be modified by lab admin on config/lab_config_home.php
$DEFAULT_PENDING_TAT = 2;

# SPECIMEN_ID Format [CATSEQUENTIAL|CATAUTO|AUTO]
# CATSEQUENTIAL - Each category maintains its own sequence of numbers PAR-1...PAR-n (Default)
# CATAUTO - The ID is composed of the category prefix and the specimen_id field of the specimen table
# AUTO - The specimen_id field of the specimen table
$SPEC_ID_FORMAT = 'CATAUTO';

# Auto logout after user inactivity
# Session times out and redirects to login page
# Refer to js/auto_logout.js
$AUTO_LOGOUT = false;

# Turn on or off Catalog translation
# If true, name strings are fetched from local strings instead of DB
$CATALOG_TRANSLATION = false;

# Report IDs for daily reports
$REPORT_ID_ARRAY = array(
	"reports_testhistory.php" => 1,
	"reports_specimen.php" => 1,
	"reports_print.php" => 1,
	"reports_dailyspecimens.php" => 1,
	"reports_dailypatients.php" => 1,
	"worksheet.php" => 5,
	"reports_billing_specific.php" => 1
);

# Default max width of the window (in pixels)
$SCREEN_WIDTH = 1000;

#List of available date formats in PHP
$DATE_FORMAT_LIST = array(
	"d-m-Y", 
	"m-d-Y", 
	"Y-m-d"
);

$DATE_FORMAT_PRETTY_LIST = array(
	"dd-mm-yyyy", 
	"mm-dd-yyyy", 
	"yyyy-mm-dd"
);

# Default date format used when no entry found in lab configuration (enter one from $DATE_FORMAT_LIST)
$DEFAULT_DATE_FORMAT = "d-m-Y";

# Flags for showing/hiding report options (reports.php)
$SHOW_SPECIMEN_REPORT = false;
$SHOW_TESTRECORD_REPORT = false;
$SHOW_PENDINGTEST_REPORT = false;

# Flags for showing/hiding results entry options (results_entry.php)
$SHOW_REPORT_RESULTS = false;

#
# Debugging related flags
#

# Log all SQL queries with timestamp and other info.
# Dumped into /log directory
$LOG_QUERIES = true;

# Length of patient ID hash (generated from name, sex, date of birth)
$PATIENT_HASH_LENGTH = 40;

# Disable updating of patient profile by users
$DISABLE_UPDATE_PATIENT_PROFILE = false;

$TURNAROUND_REPORT = array(
	'Y_AXIS_UNIT'=>'Hours'
	);
?>