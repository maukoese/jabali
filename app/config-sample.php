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
$server["dbtype"] = "MySQLDB";
$server["dbport"] = "80";
$server["dbip"] = "::1";

define( "_ROOT", "http://localhost/jabali" );
define( "_DBPREFIX", "db_" );
define( "JBLSALT", "d29f9444fd8e6fac9c7aa2bb4ecbe6744b40515d2e6d38692fa8a5d702e461ffd920f5b6bd7e9959" );
define( "JBLAUTH", "NGJjODFkODRkN2YyMzZjODU4NWEyNGI4ZDQ2N2ExZjM0YjQ0MjJkYjIzYTllMDY1MzYxYTc1NDQ0MjQ2NTI5N2RjMDgxMTA2OWYwMTk3NDQ=" );