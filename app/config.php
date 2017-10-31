<?php 
/**
* @package Jabali Framework
* @subpackage Server Configuration File
* @link https://docs.mauko.co.ke/jabali/configuration
* @author Mauko Maunde
* @since 0.17.04
*
* @param $server["dbhost"] The name of your host, usually localhost
* @param $server["dbuser"] Your server username
* @param $server["dbpass"] Your server password
* @param $server["dbname"] The name of the database to use
* @param $server["dbtype"] The type of database management system. Jabali supports
* @param $server["dbport"] Port through which to communicate with server
* @param $server["dbip"] IP address of the server
* 
* @param _ROOT The app's home/root url
* @param _DBPRFIX A prefix to be added before all database tables. Allows multiple Jabali installations on same database.
* @param JBLSALT A unique, app-specific string for authentication.
* @param JBLAUTH Used in conjuction with JBLSALT for authentication and Cross-site Request Forgery(CSRF). Also unique and app-specific
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