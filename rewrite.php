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


/**
* @package Jabali Framework
* @subpackage Home
* @link https://docs.mauko.co.ke/jabali/home
* @author Mauko Maunde
* @version 0.17.06
**/
include 'inc/jabali.php';
connectDb();

$protocol = ((!empty( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] != 'off' ) || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
if ( is_localhost() ) { 
	$url = $_SERVER['REQUEST_URI'];
} else { 
	$url = $_SERVER['REQUEST_URI'] . '/'; 
}

$elements = explode('/', $url );
$actions = array( 'login', 'reset', 'register', 'forgot' );

if(empty($elements[0])) {
	call_user_func_array( array( $action, 'home' ), array() );
} elseif ( in_array( $elements[0], $actions ) ) {
	echo $elements[0];
	call_user_func_array( array( $action, $elements[0] ), array() );
} else {
	call_user_func_array( array($action, 'fetchPosts' ), array( 'article', $elements[0] ) );
}

include 'footer.php';