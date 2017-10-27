<?php
session_start();
if ( isset( $_GET['logout'] ) ) {
  session_destroy();
}

if ( !file_exists( 'app/config.php' ) ) {
  header( "Location: ./setup.php" );
}

require 'init.php';
updatingJabali();

$year = date( "Y" );
$month = date( "m" );
$day = date( "d" );
$directory = "uploads/$year/$month/$day/";

if ( !is_dir( $directory) ) {
  mkdir( $directory, 0775, true );
}

if ( isset( $_POST['login'] ) && $_POST['user'] != "" && $_POST['password'] != "" ) {
  $USERS -> login();
}

if ( isset( $_POST['create'] ) ) {
  $USERS -> register();
}

if ( isset( $_POST['reset'] ) && $_POST['password'] !== "" ) {
  $USERS -> forgot();
}

if ( isset( $_POST['forgot'] ) && $_POST['email'] !== "" ) {
  $USERS ->reset();
}

if ( isset( $_POST['contact'] ) && $_POST['email'] !== "" ) {
  $MAILER ->send();
}

if ( isset( $_SESSION[JBLSALT.'Code' ] ) ) {
	$GStyles = $GLOBALS['JBLDB'] -> query( "SELECT style FROM ". _DBPREFIX ."users  WHERE id='".$_SESSION[JBLSALT.'Code']."'" );
	if ( $GStyles -> num_rows > 0 ) {
		$f = array();
		while ( $s = mysqli_fetch_assoc( $GStyles )) {
			$f[] = $s;
		}
		if ( $f[0]['style'] !== "" ) {
			$key = $f[0]['style'];
		} else {
			$key = "zahra";
		}
	} else {
		$key = "zahra";
	}
} else {
	$key = "zahra";
}

$GUSkin = $GLOBALS['SKINS'][$key];
$GLOBALS['GPrimary'] = $GUSkin['primary'];
$GLOBALS['GAccent'] = $GUSkin['accent'];
$GLOBALS['GTextP'] = $GUSkin['textp'];
$GLOBALS['GTextS'] = $GUSkin['texts'];

if ( is_localhost() && ( $_SERVER['DOCUMENT_ROOT'] !== __DIR__ ) ) {
	$dir = '/'.basename( __DIR__ ).'/';
	$l = strlen( $dir );
	$url = substr($_SERVER['REQUEST_URI'], $l );
} else {
  $url = ltrim( '/', $_SERVER['REQUEST_URI'] );
}

$action = new Jabali\Classes\Actions;
$elements = explode('/', $url );
$match = $elements[0];
array_shift( $elements );

if( empty( $match ) || $match == "?logout" ) {
	getHeader();
	if ( getOption( 'homepage' ) == "posts" ) {
		echo( '<title> Home [ '. getOption( 'name' ) .' ]</title>' );
		$action -> blog();
	} else {
		$action -> fetchPosts( getOption( 'homepage' ) );
	}
	getFooter();
} elseif ( in_array( $match, $GLOBALS['GRules'])) {
	rewriteRules( $match, $elements );
} else switch ( $match ) {
	case "login":
		if ( isset( $_SESSION[JBLSALT.'Code'] ) ) {
			header( 'Location: '. _ROOT .'/admin/index?page=my dashboard' );
			exit();
		} else {
			$action -> login( $elements[0] );
		}
		break;
	case "register":
		$action -> register( $elements[0] );
		break;
	case "admin":
		header( "Location: /admin/index?page=my dashboard");
		break;
	case "dashboard":
		header( "Location: /admin/index?page=my dashboard");
		break;
	case "reset":
		theHeader();
		$action -> reset( $elements[0], $elements[1] );
		theFooter();
		break;
	case "forgot":
		$action -> forgot();
		break;
	case 'portfolio':
		getHeader();
		$action -> portfolio( $elements );
		getFooter();
		break;
	case "authors":
		getHeader();
		$action -> authors( $elements[0] );
		getFooter();
		break;
	case "categories":
		getHeader();
		$action -> category( $elements[0] );
		getFooter();
		break;
	case "comments":
		getHeader();
		$action -> comments( $elements );
		getFooter();
		break;
	case "tags":
		getHeader();
		$action -> tag( $elements[0] );
		getFooter();
		break;
	case "users":
		getHeader();
		$action -> users( $elements[0] );
		getFooter();
		break;
	case "api":
		restApi( $elements );
		break;
	case "feed":
		rssFeed( $elements[0] );
		break;
	case 'manifest':
		header('Content-Type:Application/json' );
		$manifest = manifest();
		echo json_encode( $manifest );
		break;
	default:
		getHeader();
		$action -> fetchPosts( $match );
		getFooter();
}