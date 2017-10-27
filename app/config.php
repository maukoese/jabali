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
$server["dbtype"] = "MySQL";
$server["dbport"] = "80";
$server["dbip"] = "::1";

define( "_ROOT", "http://localhost/jabali" );
define( "_DBPREFIX", "db_" );
define( "JBLSALT", "30a8841b21ba6a063a95e8f84507eb2501cc0a8536d41152beb915e7238990dc10b5c7791e3a93a9" );
define( "JBLAUTH", "MDI0OWE1NTZiMjQ3NTFkOWNmNTA4Mzc0OWNmZTI4YjQzOGY2NjQ4Y2M1Yzk3YTVhMDdjN2RiN2RkNmJhYTRkNTlhNGJlYzI5YzZjNjFhMDU=" );