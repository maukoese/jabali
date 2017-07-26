<?php
/**
* @package Jabali Framework
* @subpackage Home
* @link https://docs.mauko.co.ke/jabali/home
* @author Mauko Maunde
* @version 0.17.06
**/
date_default_timezone_set( "Africa/Nairobi" );
$dbfile = 'inc/config.php';
if ( !file_exists( $dbfile) ) {
  header( "Location: ./setup.php" );
}

$year = date( "Y" );
$month = date( "m" );
$day = date( "d" );
$directory = "uploads/$year/$month/$day/";

if ( !is_dir( $directory) ) {
  mkdir( $directory, 755, true );
}

include 'inc/config.php';
include 'inc/jabali.php';
connectDb();
include 'inc/classes/class.actions.php';
global $action;
$action = new _hActions;
$action -> connectDB();

if ( isset( $_POST['login'] ) && $_POST['user'] != "" && $_POST['password'] != "" ) {
  call_user_func_array(array($action, 'loginUser'), array());
}

if ( isset( $_POST['create'] ) ) {
  call_user_func_array(array($action, 'registerUser'), array());
}

if ( isset( $_POST['reset'] ) && $_POST['h_password'] !== "" ) {
  call_user_func_array(array($action, 'resetPass'), array());
}

$url = $_SERVER['REQUEST_URI'];

if ( is_localhost() ) { 
	$url = ltrim( $url, 'localhost/jabali' );
} else { 
	$url = $_SERVER['REQUEST_URI'] . '/'; 
}

$elements = split('/', $url );

if( empty( $elements[0] ) ) {
	call_user_func_array( array( $action, 'home' ), array() );
} else {
	$match = $elements[0];
	switch ( $match ) {
		case "login":
			call_user_func_array(array( $action, 'login' ), array() );
			break;
		case 'register':
			call_user_func_array(array( $action, 'register' ), array() );
			break;
		case 'reset':
			call_user_func_array(array( $action, 'reset' ), array() );
			break;
		case 'forgot':
			call_user_func_array(array( $action, 'forgot' ), array() );
			break;
		case "blog":
			call_user_func_array(array( $action, 'blog' ), array() );
			break;
		case 'category':
			call_user_func_array( array($action, 'category' ), array( $elements[1] ) );
			break;
		case 'tag':
			call_user_func_array( array($action, 'tags' ), array( $elements[1] ) );
			break;
		default:
			call_user_func_array( array($action, 'fetchPosts' ), array( $elements[1] ) );
	}
}

include 'footer.php';