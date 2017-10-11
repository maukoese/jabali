<?php 
/**
* @package Jabali Framework
* @subpackage Server Configuration File
* @link https://docs.mauko.co.ke/jabali/configuration
* @author Mauko Maunde
* @since 0.17.04
**/

$server["dbhost"] = "localhost";
$server["dbuser"] = "root";
$server["dbpass"] = "";
$server["dbname"] = "jabali";
$server["dbtype"] = "MySQLDB";
$server["dbport"] = "80";
$server["dbip"] = "::1";

define( "_ROOT", "http://localhost/jabali" );
define( "_DBPREFIX", "db_" );
define( "JBLSALT", "d29f9444fd8e6fac9c7aa2bb4ecbe6744b40515d2e6d38692fa8a5d702e461ffd920f5b6bd7e9959" );
define( "JBLAUTH", "NGJjODFkODRkN2YyMzZjODU4NWEyNGI4ZDQ2N2ExZjM0YjQ0MjJkYjIzYTllMDY1MzYxYTc1NDQ0MjQ2NTI5N2RjMDgxMTA2OWYwMTk3NDQ=" );