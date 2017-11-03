<?php
/**
* @package Jabali Framework
* @subpackage Initialization
* @link https://docs.jabalicms.org/init/
* @author Mauko Maunde
* @since 0.17.09
**/

/**
* Load app configuration
**/
require_once ( 'app/config.php' );

/**
* Script Directories.
**/
define( '_ABS_', __DIR__ );
define( '_ABSAD_', _ABS_ . '/admin/' );
define( '_ABSRES_', _ABS_ . '/app/' );
define( '_ABSX_', _ABSRES_ . 'modules/' );
define( '_ABSTHEMES_', _ABSRES_ . 'themes/' );
define( '_ABSVIEWS_', _ABSRES_ . 'views/' );
define( '_ABSDB_', _ABSRES_ . 'data/bases/' );
define( '_ABSUP_', _ABS_ . '/uploads/' );
define( '_ABSTEMP_', _ABSUP_. 'temp/' );

/**
* URL Paths.
**/
define( '_ADMIN', _ROOT .'/admin/' );
define( '_RES', _ROOT .'/app/' );
define( '_UPLOADS', _ROOT .'/uploads/' );
define( '_X', _RES .'/modules/' );
define( '_THEMES', _RES.'themes/' );

/**
* Assets
**/
define( '_ASSETS', _ROOT.'/'.'app/assets/' );
define( '_STYLES', _ASSETS.'css/' );
define( '_SCRIPTS', _ASSETS.'js/' );
define( '_IMAGES', _ASSETS.'images/' );
define( '_FONTS', _ASSETS.'fonts/' );

/**
*
**/
define( '_LOGIN', _ROOT.'/signin/' );
define( '_REGISTER', _ROOT.'/register/' );
define( '_API', _ROOT.'/api/' );

/**
*
**/
define( '_EMAIL', 'jabali@mauko.co.ke' );
define( '_PHONE', '+254 20 440 4993' );

spl_autoload_register( function( $class ) {
	$classf = str_replace( "Jabali\\", "", $class );
	$classd = strtolower( str_replace( "\\", "/", $classf ) );

	require_once ( 'app/' . $classd . '.php');
});

/**
* Load external libraries
**/
require_once('app/lib/guzzle/vendor/autoload.php');
require_once('app/lib/phpmailer/vendor/autoload.php');

/**
* Load common Jabali functions
**/
require_once ( 'app/functions.php' );

/**
* Load correct database, according to type selected in cofiguration file.
**/
switch ( $server["dbtype"] ) {
	case 'MySQL':
		$GLOBALS['JBLDB'] = new Jabali\Data\Access\Layers\MySQLDB( $server["dbhost"] , $server["dbuser"] , $server["dbpass"] , $server["dbname"] );
		break;

	case 'SQLite':
		$GLOBALS['JBLDB'] = new Jabali\Data\Access\Layers\SQLiteDB( $server["dbname"] );
		break;

	case 'PostgreSQL':
		$GLOBALS['JBLDB'] = new Jabali\Data\Access\Layers\PostgreDB( $server["dbhost"] , $server["dbuser"] , $server["dbpass"] , $server["dbname"], $server["dbport"] );
		break;

	default:
		$GLOBALS['JBLDB'] = new Jabali\Data\Access\Layers\MySQLDB( $server["dbhost"] , $server["dbuser"] , $server["dbpass"] , $server["dbname"] );
		break;
}

/**
* Flush $server variable so configuration details are not available beyond this point
**/
unset( $server );

/**
* Set default timezone.
**/
if ( isOption ( 'timezone' ) ) {
	date_default_timezone_set( getOption ( 'timezone' ) );
} else {
	date_default_timezone_set( 'Africa/Nairobi' );
}

/**
* Autoload Classes
**/

$GLOBALS['USERS'] = new Jabali\Data\Access\Objects\Users;
$GLOBALS['POSTS'] = new Jabali\Data\Access\Objects\Posts;
//$GLOBALS['RESOURCES'] = new Jabali\Data\Access\Objects\Resources;
//$GLOBALS['COMMENTS'] = new Jabali\Data\Access\Objects\Comments;
//$GLOBALS['MESSAGES'] = new Jabali\Data\Access\Objects\Messages;
$GLOBALS['OPTIONS'] = new Jabali\Data\Access\Objects\Options;
$GLOBALS['GUZZLE'] = new \GuzzleHttp\Client;
$GLOBALS['MAILER'] = new \PHPMailer\PHPMailer\PHPMailer;

$GLOBALS['gposts'] = $GLOBALS['POSTS'] -> sweep();
$GLOBALS['gpost'] = null;
$GLOBALS['gpost_count'] = 0;
$GLOBALS['gpost_index'] = 0;

$hGlobal = new Jabali\Lib\Uniform();
$hOpt = new Jabali\Classes\Options();
$hMenu = new Jabali\Classes\Menus();
$hForm = new Jabali\Classes\Forms();
$hUser = new Jabali\Classes\Users();
$hPost = new Jabali\Classes\Posts();
$hResource = new Jabali\Classes\Resources();
$hMessage = new Jabali\Classes\Messages();
$hComment = new Jabali\Classes\Comments();
$hWidget = new Jabali\Classes\Widgets();
$hSocial = new Jabali\Classes\Social();

/**
* Create directories if the don't exist
**/
$GLOBALS['GRules'] = array();
$GLOBALS['GActions'] = array();
$GLOBALS['GSettings'] = array();
$GLOBALS['GSettingsField'] = array();

$GLOBALS['GTypes'] = array();
if ( isOption ( 'usertypes' ) ) {
	$GLOBALS['GTypes']['users'] = getOption( 'usertypes' );
	$GLOBALS['GTypes']['posts'] = getOption( 'posttypes' );
	$GLOBALS['GTypes']['resources'] = getOption( 'resourcetypes');
	$GLOBALS['GTypes']['comments'] = getOption( 'commenttypes');
	$GLOBALS['GTypes']['messages'] = getOption( 'messagetypes');
}

/**
* Load color skins.
**/
$GLOBALS['SKINS'] = loadSkins();

/**
* Load Theme Functions
**/
$GLOBALS['GThemePage'] = array();

/**
* Load Extensions Functions
**/
$GLOBALS['GExtPage'] = array();

if ( !isset( $_SESSION['CSRF'] ) ) {
	$_SESSION['CSRF'] = md5( date("Y-m-d") );
}

define( 'CSRF', $_SESSION['CSRF'] );

if ( $_SERVER['REQUEST_METHOD'] !== "GET" ) {
	if ( !isset( $_REQUEST['csrf_token'] ) || $_REQUEST['csrf_token'] !== $_SESSION['CSRF'] ) {
		header( 'HTTP/1.1 403 Forbidden' );
		exit();
	}
}

if ( isOption ( 'modules' ) ) {
	$exts = getOption( 'modules' );
	foreach ( $exts as $ext ) {
	require_once _ABSX_.$ext.'/'.$ext.'.php';
	}
}

if ( isOption ( 'activetheme' ) ) {
	$GLOBALS['GTheme'] = getOption( 'activetheme' );
	$themefile = _ABSTHEMES_ . $GLOBALS['GTheme'] . '/' . $GLOBALS['GTheme'] . '.php';
} else {
	$themefile = _ABSTHEMES_ . '/eventually/eventually.php';
}

if ( file_exists( $themefile ) ){
	require_once( $themefile );
}