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

// if ( isset( $_GET['q'] ) ) {
//   $actions = array( 'login', 'reset', 'register', 'forgot' );

//   if ( !is_file( $_GET['q'] ) && !is_dir( $_GET['q'] ) && in_array($_GET['q'], $actions) ) {
//     call_user_func_array( array( $action, $_GET['q'] ), array() );
//   } else {
//     call_user_func_array( array($action, 'fetchPosts' ), array( 'article', $_GET['q'] ) );
//   }
// } else {
//   call_user_func_array( array($action, 'home' ), array() );
// }

// $path = ltrim( $_SERVER['REQUEST_URI'], '/' );
// $elements = explode('/', $path );
// $actions = array( 'login', 'reset', 'register', 'forgot' );
// if ( empty( $elements[0] ) ) {
//   call_user_func_array( array($action, 'home' ), array() );
// } else {
//   switch( array_shift( $elements ) ) {
//     case $actions:
//       call_user_func_array( array( $action, $elements[1] ), array() );
//       break;
//     default: 
//     header( 'HTTP/1/404 Not Found');
//   }
// }

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
$url = ltrim( $_SERVER['REQUEST_URI'] . '/' ); 
} else { 
$url = $_SERVER['REQUEST_URI'] . '/'; 
}

$element = ltrim('/', $url);
$elements = explode('/', $element);
$actions = array( 'login', 'reset', 'register', 'forgot' );
$act = in_array( $act, $actions );

if(empty($elements[0])) {
	call_user_func_array( array( $action, 'home' ), array() );
} else switch(array_shift($elements)) {
    case $act:
    call_user_func_array( array( $action, $act ), array() );
        break;
    case 'blog':
    echo $elements;
    echo "<br>";
    echo $elements[0];
    	call_user_func_array( array($action, 'fetchPosts' ), array( 'article', 'blog' ) );
    	break;
}
include 'footer.php';