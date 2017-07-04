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
include 'inc/class.actions.php';
$action = new _hActions;
$action -> connectDB();

session_start(); 

if ( isset( $_POST['login'] ) && $_POST['user'] != "" && $_POST['password'] != "" ) {
  call_user_func_array(array($action, 'loginUser'), array());
}

if ( isset( $_POST['create'] ) ) {
  call_user_func_array(array($action, 'registerUser'), array());
}

if ( isset( $_POST['reset'] ) && $_POST['h_password'] !== "" ) {
  call_user_func_array(array($action, 'resetPass'), array());
}

if ( isset( $_GET['q'] ) ) {
  $actions = array( 'login', 'reset', 'register', 'forgot' );

  if ( !is_file( $_GET['q'] ) && !is_dir( $_GET['q'] ) && in_array($_GET['q'], $actions) ) {
    call_user_func_array( array( $action, $_GET['q'] ), array() );
  } else {
    call_user_func_array( array($action, 'fetchPosts' ), array( 'article', $_GET['q'] ) );
  }
} else {
  call_user_func_array( array($action, 'home' ), array() );
}

include 'footer.php'; ?>