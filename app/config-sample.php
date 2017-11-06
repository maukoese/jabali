<?php 
/**
* @package Jabali - The Plug-N-Play Framework
* @subpackage App Configuration File
* @link https://docs.jabalicms.org/configuration/
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
* @param _DBPRFIX A prefix to be added before all database tables. 
* Allows multiple Jabali installations on same database.
* @param JBLSALT A unique, app-specific string for authentication.
* @param JBLAUTH Used in conjuction with JBLSALT for authentication and 
* prevention of Cross-site Request Forgery(CSRF). Also unique and app-specific
**/

$server["dbhost"] = "localhost";
$server["dbuser"] = "root";
$server["dbpass"] = "";
$server["dbname"] = "jabali";
$server["dbtype"] = "MySQL";
$server["dbport"] = "80";
$server["dbip"] = "::1";

define( "_ROOT", "http://localhost/jabali" );
define( "_DBPREFIX", "jdb_" );
define( "JBLSALT", "f75ccd43b4254baa6716d7dd096eb912" );
define( "JBLAUTH", "a4bceb3c7a1c0660d67c1853e204345340bd0df0" );