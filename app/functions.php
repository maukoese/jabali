<?php 
/**
* @package Jabali Framework
* @subpackage Common functions
* @link https://docs.jabalicms.org/functions
* @author Mauko Maunde
* @since 0.17.09
**/

/**
* Default Date/Timezone
**/

/**
* Install main instance of Jabali
**/
function installSQLDB() {
	$prefix = _DBPREFIX;

	$tables = array();
	$tables[] = <<<SQL
		CREATE TABLE IF NOT EXISTS {$prefix}users
		( id INT AUTO_INCREMENT,
		authkey VARCHAR(100),
		author VARCHAR(12),
		author_name VARCHAR(20), 
		avatar VARCHAR(100),
		categories VARCHAR(20),  
		company VARCHAR(100),
		created DATETIME,
		custom VARCHAR(150),
		details TEXT,
		email  VARCHAR(50) UNIQUE,
		excerpt TEXT,
		gender VARCHAR(8),
		level VARCHAR(12),
		link VARCHAR(100),
		location VARCHAR(50),
		name VARCHAR(100),
		password VARCHAR(50),
		phone VARCHAR(20),
		social TEXT,
		state VARCHAR(20),
		style VARCHAR(100),
		ilk VARCHAR(20),
		updated DATE,
		username VARCHAR(20) UNIQUE,
		PRIMARY KEY(id, username)
		)
SQL;

	$tables[] = <<<SQL
		CREATE TABLE IF NOT EXISTS {$prefix}resources (
		id INT AUTO_INCREMENT,
		name VARCHAR(100),
		author VARCHAR(12),
		avatar VARCHAR(20),
		author_name VARCHAR(20), 
		company VARCHAR(20),
		created DATETIME,
		custom VARCHAR(12),
		details TEXT,
		email  VARCHAR(50),
		authkey VARCHAR(100),
		level VARCHAR(12),
		link VARCHAR(100),
		location VARCHAR(50),
		excerpt TEXT,
		phone VARCHAR(20),
		social VARCHAR(500),
		state VARCHAR(20),
		ilk VARCHAR(50),
		updated DATE,
		PRIMARY KEY(id)
		)
SQL;

	$tables[] = <<<SQL
		CREATE TABLE IF NOT EXISTS {$prefix}messages(
		id INT AUTO_INCREMENT,
		authkey VARCHAR(100),
		name VARCHAR(100),
		author VARCHAR(20),
		author_name VARCHAR(20),
		created DATETIME,
		details TEXT,
		email  VARCHAR(50),
		for VARCHAR(20),
		level VARCHAR(12),
		link VARCHAR(100),
		phone VARCHAR(20),
		state VARCHAR(20),
		ilk VARCHAR(50),
		PRIMARY KEY(id)
		)
SQL;

	$tables[] = <<<SQL
		CREATE TABLE IF NOT EXISTS {$prefix}comments(
		id INT AUTO_INCREMENT,
		authkey VARCHAR(100),
		name VARCHAR(100),
		author VARCHAR(20),
		author_name VARCHAR(20),
		created DATETIME,
		details TEXT,
		email  VARCHAR(50),
		for VARCHAR(20),
		level VARCHAR(12),
		link VARCHAR(100),
		state VARCHAR(20),
		ilk VARCHAR(50),
		updated DATE,
		PRIMARY KEY(id)
		)
SQL;

	$tables[] = <<<SQL
		CREATE TABLE IF NOT EXISTS {$prefix}posts(
		name VARCHAR(300),
		author VARCHAR(20),
		author_name VARCHAR(100),
		avatar VARCHAR(100),
		categories VARCHAR(20),
		id INT AUTO_INCREMENT,
		created DATETIME,
		details TEXT,
		gallery VARCHAR(500),
		authkey VARCHAR(100),
		level VARCHAR(12),
		link VARCHAR(100),
		excerpt TEXT,
		readings VARCHAR(500),
		state VARCHAR(20),
		subtitle VARCHAR(100),
		slug VARCHAR(300) UNIQUE,
		tags VARCHAR(50),
		template VARCHAR(50),
		ilk VARCHAR(50),
		updated DATE,
		PRIMARY KEY(id)
		)
SQL;

	$tables[] = <<<SQL
		CREATE TABLE IF NOT EXISTS {$prefix}options (
		id INT AUTO_INCREMENT,
		name VARCHAR(200),
		code VARCHAR(100) UNIQUE,
		details TEXT,
		updated DATETIME,
		PRIMARY KEY(id, code)
		)
SQL;

	$tables[] = <<<SQL
		CREATE TABLE IF NOT EXISTS {$prefix}menus (
		id INT AUTO_INCREMENT,
		author VARCHAR(20),
		avatar VARCHAR(100),
		code VARCHAR(100) UNIQUE,
		parent VARCHAR(20),
		link VARCHAR(100),
		location VARCHAR(100),
		name VARCHAR(200),
		ilk VARCHAR(50),
		state VARCHAR(50),
		updated DATETIME,
		PRIMARY KEY(id, code)
		)
SQL;

	foreach ($tables as $table ) {
		$GLOBALS['JBLDB'] -> execute( $table );
	}
} 
 

function is_localhost() {
	$whitelist = array( '127.0.0.1', '::1' );
	if ( in_array( $_SERVER['REMOTE_ADDR'], $whitelist) )
	    return true;
}

/**
* Include Function
**/
function getFile( $path, $file ) {

	include $path.$file.'.php';
}

/**
* Load stylesheets
**/
function loadStyle( $link, $theme = false ) {
	if ( $theme !== false ) {
	 	$themes = _THEMES.$theme.'/assets/';
	 } else {
	 	$themes = '';
	 } ?>

	<link rel="stylesheet" type="text/css" href="<?php echo $themes.$link; ?>"><?php 
}

/**
* Load Javascript
**/
function loadScript( $link, $theme = false ) {
	if ( $theme !== false ) {
	 	$themes = _THEMES.$theme.'/assets/';
	 } else {
	 	$themes = '';
	 } ?>

	<script type="text/javascript" src="<?php echo $themes.$link; ?>"></script><?php 
}

/**
* Load Javascript
**/
function loadImage( $link, $theme = false, $width = 250, $alt = '', $class = "" ) {
	if ( $theme !== false ) {
	 	$themes = _THEMES.$theme.'/assets/';
	 } else {
	 	$themes = '';
	 } ?>

	<img src="<?php echo $themes.$link; ?>" width="<?php echo( $width ); ?>" alt="<?php echo( $alt )?>" class="<?php echo $class; ?>" /><?php 
}
/**
* Load stylesheets
**/
function loadStyles( $links, $theme = false ) {
	if ( $theme !== false ) {
	 	$themes = $theme;
	 } else {
	 	$themes = false;
	 }

	 foreach ( $links as $link ) {
	 	loadStyle( $link, $themes );
	 }
}

/**
* Load Javascript
**/
function loadScripts( $links, $theme = false ) {
	if ( $theme !== false ) {
	 	$themes = $theme;
	 } else {
	 	$themes = false;
	 }

	 foreach ( $links as $link ) {
	 	loadScript( $link, $themes );
	 }
}

/**
* Display home logo
**/
function frontlogo( $width = "250px;", $class = "" ) {
	
	echo '<a class = "'.$class.'" href="' ._ROOT. '"><img src="' . getOption( 'homelogo' ) . '" width="' . $width . '"></a>';
}

/**
* Display main logo
**/
function headerLogo( $width = "150px;", $class = ""  ) {
	
	echo '<a class = "'.$class.'" href="' ._ROOT. '"><img src="' . getOption( 'headerlogo' ) . '" width="' . $width . '"></a>';
}

function _shout_( $what, $type = "alert" ) {
	switch ( $type ) {
	 	case 'alert':
	 		$color = "blue";
	 		break;
	 	case 'warning':
	 		$color = "orange";
	 		break;
	 	case 'error':
	 		$color = "red";
	 		break;
	 	case 'success':
	 		$color = "green";
	 		break;
	 	default:
	 		$color = "blue";
	 		break;
	 } ?>
	<div class="row alert" id="alert_box">
	  <div class="col s12 m12">
	    <div class="card <?php echo $color; ?> darken-1">
	      <div class="row">
	        <div class="col s12 m10">
	          <div class="card-content white-text">
	            <p><?php echo $what; ?></p>
	        </div>
	      </div>
	      <div class="col s12 m2">
	        <i class="fa fa-times" id="alert_close" aria-hidden="true" style="position: absolute; right: 10px; top: 10px; font-size: 20px; color: white; cursor:pointer;"></i>
	      </div>
	    </div>
	   </div>
	  </div>
	</div><?php
}

/**
* Window Alert
**/
function showAlert( $alert ) {
	?><script>
	function showText() {
	    alert( "<?php echo $alert; ?>" );
	}

	showText();
	</script><?php 
}

/**
* Window Confirm
**/
function showConf( $message, $yes, $no, $where ) {
	?><script>
	function confirmAcion() {
    var txt;
    if ( confirm( "<?php echo $message; ?>" ) == true ) {
        txt = "<?php echo $yes; ?>";
    } else {
        txt = "<?php echo $no; ?>";
    }
    document.getElementById( "<?php echo $where; ?>" ).innerHTML = txt;
	}

	confirmAcion();
	</script><?php 
}


/**
* Check if user has appropriate permisions
**/
function isCap( $cap ) {
	if ( $_SESSION[JBLSALT.'Cap'] == $cap ) {
		return true;
	} else {
		return false;
	}
}

function isAuthor( $author ) {
	if ( $_SESSION[JBLSALT.'Code'] == $author ) {
		return true;
	} else {
		return false;
	}
}

function emailExists( $email ) {
	$theEmail = $GLOBALS['JBLDB'] -> query( "SELECT email  FROM ". _DBPREFIX ."users WHERE email  ='".$email."'" );
	if ( $theEmail -> num_rows > 0 ) {
		return true;
	} else {
		return false;
	}
}

/**
* Check if user is viewing own profile
**/
function isProfile( $cap ) {
	if ( $_SESSION[JBLSALT.'Code'] == $_GET['view'] ) {
		return true;
	} else {
		return false;
	}
}


/**
* 
**/
function uploadFile( $file ) {
	$year = date('Y' );
	$month = date('m' );
	$day = date('d' );
	$uploads = _UPLOADS . "$year/$month/$day/";
	$upload = $uploads . basename( $file );
	$uploadOk = 1;

	if ( file_exists( $upload) ) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
	}

	move_uploaded_file( $file, $upload);

}

/**
* 
**/
function getMsgCount() {
    $getMessages = $GLOBALS['JBLDB'] -> query( "SELECT * FROM ". _DBPREFIX ."messages WHERE (state = 'unread' AND for = '".$_SESSION[JBLSALT.'Code']."' )" );
    if ( $getMessages ){
	    if ( $GLOBALS['JBLDB'] -> numRows( $getMessages ) > 0 ) {
	      echo $GLOBALS['JBLDB'] -> numRows( $getMessages );
	    } else {
	      echo( '0' );
	    }
	} else {
		echo( '0' );
	}
}

/**
* 
**/
function getNoteCount() {
	$getMessages = $GLOBALS['JBLDB'] -> query( "SELECT * FROM ". _DBPREFIX ."comments" );
    if ( $getMessages ){
	    if ( $GLOBALS['JBLDB'] -> numRows( $getMessages ) > 0 ) {
	      echo $GLOBALS['JBLDB'] -> numRows( $getMessages );
		} else {
		  	echo( '0' );
		}
	} else {
		echo( '0' );
	}
}

function loadSkins(){
	$skins = array();
	$skins['zahra'] = array( "name" => "Zahra's Fade", "primary" => "teal", "accent" => "red", "textp" => "white", "texts" => "black" );
	$skins['love'] = array( "name" => "Love, Olive", "primary" => "cyan", "accent" => "magenta", "textp" => "white", "texts" => "black" );
	$skins['wiz'] = array( "name" => "Wiz' o' Oz", "primary" => "yellow", "accent" => "black", "textp" => "white", "texts" => "black" );
	$skins['pint'] = array( "name" => "The Bluepint", "primary" => "blue", "accent" => "pink", "textp" => "white", "texts" => "black" );
	$skins['stack'] = array( "name" => "Needle In A Haystack", "primary" => "grey", "accent" => "brown", "textp" => "white", "texts" => "black" );
	$skins['indie'] = array( "name" => "Indie Go", "primary" => "indigo", "accent" => "brown", "textp" => "white", "texts" => "black" );
	$skins['haze'] = array( "name" => "Purple Haze", "primary" => "purple", "accent" => "green", "textp" => "white", "texts" => "black" );
	$skins['hot'] = array( "name" => "Red Hot", "primary" => "red", "accent" => "blue", "textp" => "white", "texts" => "black" );
	$skins['princess'] = array( "name" => "Princess Zahra", "primary" => "pink", "accent" => "cyan", "textp" => "white", "texts" => "black" );
	$skins['sky'] = array( "name" => "Blue Sky", "primary" => "blue", "accent" => "brown", "textp" => "white", "texts" => "black" );
	$skins['greene'] = array( "name" => "Robert Greene", "primary" => "green", "accent" => "red", "textp" => "white", "texts" => "black" );
	$skins['vegan'] = array( "name" => "I'm Vegan", "primary" => "light-green", "accent" => "green", "textp" => "white", "texts" => "black" );
	$skins['lemon'] = array( "name" => "Life's Lemons", "primary" => "lime", "accent" => "brown", "textp" => "white", "texts" => "black" );
	$skins['wait'] = array( "name" => "The Wait", "primary" => "amber", "accent" => "brown", "textp" => "white", "texts" => "black" );
	$skins['orange'] = array( "name" => "Orange Tan", "primary" => "orange", "accent" => "yellow", "textp" => "white", "texts" => "black" );
	$skins['sun'] = array( "name" => "Orange Sun", "primary" => "orange", "accent" => "cyan", "textp" => "white", "texts" => "black" );
	$skins['earth'] = array( "name" => "Down To Earth", "primary" => "brown", "accent" => "orange", "textp" => "white", "texts" => "black" );
	$skins['ghost'] = array( "name" => "Ghosting Blues", "primary" => "blue-grey", "accent" => "red", "textp" => "white", "texts" => "black" );
	$skins['bred'] = array( "name" => "Born & Bred", "primary" => "black", "accent" => "red", "textp" => "white", "texts" => "black" );
	$skins['prince'] = array( "name" => "Dark Prince", "primary" => "purple", "accent" => "lime", "textp" => "white", "texts" => "black" );
	$skins['peachy'] = array( "name" => "Peachy", "primary" => "peachpuff", "accent" => "maroon", "textp" => "white", "texts" => "black" );
	$skins['queen'] = array( "name" => "Queen Bee", "primary" => "purple", "accent" => "light-green", "textp" => "white", "texts" => "black" );
	$skins['madge'] = array( "name" => "Madge Sony", "primary" => "madge", "accent" => "sony", "textp" => "white", "texts" => "black" );
	$skins['yvy'] = array( "name" => "Madge Sony", "primary" => "ebony", "accent" => "purple", "textp" => "white", "texts" => "black" );
	$skins['fuchsia'] = array( "name" => "Fuchsia", "primary" => "pink", "accent" => "purple", "textp" => "white", "texts" => "black" );
	$skins['creamy'] = array( "name" => "Cream Pie", "primary" => "cream", "accent" => "yellow", "textp" => "white", "texts" => "black" );
	$skins['grace'] = array( "name" => "Grace", "primary" => "silver", "accent" => "gold", "textp" => "black", "texts" => "black" );
	$skins['nude'] = array( "name" => "Nude Strip", "primary" => "nude", "accent" => "red", "textp" => "white", "texts" => "black" );
	$skins['christian'] = array( "name" => "Christian Gold", "primary" => "silver", "accent" => "gold", "textp" => "black", "texts" => "black" );
	$skins['snow'] = array( "name" => "Snow White", "primary" => "white", "accent" => "snow", "textp" => "black", "texts" => "black" );
	$skins['mshindi'] = array( "name" => "Mshindi", "primary" => "yellow", "accent" => "orange", "textp" => "black", "texts" => "black" );
	$skins['olive'] = array( "name" => "Olive Branches", "primary" => "olive", "accent" => "blue", "textp" => "black", "texts" => "black" );
	$skins['hues'] = array( "name" => "Khaki Pants", "primary" => "khaki", "accent" => "blue", "textp" => "black", "texts" => "black" );
	$skins['high'] = array( "name" => "High & Mighty", "primary" => "cream", "accent" => "turquoise", "textp" => "black", "texts" => "black" );
	$skins['muddle'] = array( "name" => "Muddle", "primary" => "mudd", "accent" => "red", "textp" => "black", "texts" => "black" );
	$skins['nana'] = array( "name" => "Nana", "primary" => "pink", "accent" => "magenta", "textp" => "black", "texts" => "black" );
	$skins['sly'] = array( "name" => "Sly", "primary" => "yellow", "accent" => "brown", "textp" => "black", "texts" => "black" );
	$skins['blues'] = array( "name" => "Blue Indians", "primary" => "cyan", "accent" => "indigo", "textp" => "black", "texts" => "black" );

	return $skins;
}

/**
* 
**/
function primaryColor() {
	echo $GLOBALS['GPrimary'];
}

/**
* 
**/
function secondaryColor() {
	echo $GLOBALS['GAccent'];
}

/**
* 
**/
function textColor() {
	echo $GLOBALS['GTextP'];
}

/**
* 
**/
function textSColor() {
	echo $GLOBALS['GTextS'];
}

/**
* 
**/
function getOption( $code ) {
	$option = "";
    $getOptions = $GLOBALS['JBLDB'] -> query( "SELECT * FROM ". _DBPREFIX ."options WHERE code='".$code."'" );
    if ( $GLOBALS['JBLDB'] -> numRows($getOptions) > 0 ) {
        while ( $siteOption = $GLOBALS['JBLDB'] -> fetchArray($getOptions) ) { 
			if ( substr( $siteOption['details'], 0,1 ) == "[" || substr( $siteOption['details'], 0,1 ) == "{" ) {
				$option = json_decode( $siteOption['details'], true );
			} else {
				$option = $siteOption['details'];
			}
        }
    }
    
    return $option;
}

/**
* 
**/
function showOption( $code ) {
    $getOptions = $GLOBALS['JBLDB'] -> query( "SELECT * FROM ". _DBPREFIX ."options WHERE code='".$code."'" );
    if ( $GLOBALS['JBLDB'] -> numRows($getOptions) > 0 ) {
        while ( $siteOption = $GLOBALS['JBLDB'] -> fetchArray($getOptions) ) { 
            echo( $siteOption['details'] );
        }
    }
}

/**
* 
**/
function isOption( $code ) {
    $getOptions = $GLOBALS['JBLDB'] -> query( "SELECT * FROM ". _DBPREFIX ."options WHERE code='".$code."'" );
    if ( $getOptions && $GLOBALS['JBLDB'] -> numRows($getOptions) > 0 ) {
        return true;
    } else {
    	return false;
    }
}

function theHeader() {
	require_once( _ABSRES_ . 'views/header.php' );
	echo( 
		'<style>
			.toast{
				bottom: 5px;
				right: 5px;
			}
		</style>' );
}

function theFooter() {
	require_once( _ABSRES_ . 'views/footer.php' );
}

function getHeader() {
	require_once( _ABSTHEMES_ . getOption( 'activetheme' ) . '/header.php' );
	echo( 
		'<style>
			.toast{
				bottom: 5px;
				right: 5px;
				position: absolute;
				color: green;
			}
			.etoast{
				bottom: 5px;
				right: 5px;
				position: absolute;
				color: red;
			}
		</style>' );
}

function getFooter() {
	$theme = getOption( 'activetheme' );
	require_once( _ABSTHEMES_ . getOption( 'activetheme' ) . '/footer.php' );
}


/**
* 
**/
function showTitle( $class ) { ?>
    <title><?php

    $class = ucwords( $class );
	//Viewing
	if ( isset( $_GET['view'] ) ) {
		if ( $_GET['view'] == "list" ) {
			if ( isset( $_GET['type'] ) ) {
				echo $_GET['type']."s List";
			} else {
				echo $class."s List";
			}
		} elseif ( $_GET['view'] == "pending" ) {
			echo "Pending ".$class;
		} else {
			if ( isset( $_GET['key'] ) ) {
				echo $_GET['key'];
			} else {
				echo $class;
			}
		} 

	//Creating 
	} elseif ( isset( $_GET['create'] ) ) {
		if ( isset( $_GET['key'] ) ) {
			echo "Create ".$_GET['key'];
		} else {
			echo "Create ".$class;
		}

	//Deleting
	} elseif ( isset( $_GET['delete'] ) ) {
		if ( isset( $_GET['key'] ) ) {
			echo "Delete ".$_GET['key'];
		} else {
			echo "Delete ".$class;
		}

	// Editing
	} elseif ( isset( $_GET['edit'] ) ) {
		if ( isset( $_GET['key'] ) ) {
			echo "Edit ".$_GET['key'];
		} else {
			echo "Edit ".$class;
		}
	}?> 
	- <?php
	showOption( 'name' ); ?>
    </title><?php
}


/**
* 
**/
function headTitle( $text ) {
    echo( '<title>'.ucwords( $text ).' - '.getOption( 'name' ).'</title>' );
}

/**
* 
**/
function tableHeader( $collums ) { ?>
	<div class="mdl-cell mdl-cell--12-col">
		<table class="table pmd-table mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>">
			<thead>
				<tr><?php
				foreach ($collums as $collum ) { ?>
					<th class="mdl-data-table__cell--non-numeric"><?php echo( strtoupper( $collum ) ); ?></th><?php
				} ?>
				</tr>
			</thead>
			<tbody><?php
	}

/**
* 
**/
function tableBody( $results, $fields, $names, $error = "No Records Found") {
	if ( $results !== null ) {
		$data = array_combine( $fields, $names );
		foreach ( $data as $field => $name ) {
			echo '<td class="mdl-data-table__cell--non-numeric" data-title="' . $name . '">'. $results[$field] .'</td>';
		}
	} else {
		echo '<td class="mdl-data-table__cell--non-numeric" data-title="Error">'. $error .'</td>';
	}
}

/**
* 
**/
function tableFooter() { ?>

			</tbody>
		</table>
	</div><?php
}

//$field = array ( "length" => "" "class" => "", "type" => "", "name" => "", "id" => "", "placeholder" => "", "value" => "");
//$fields = $field1, $field2;
//form( $name, , , ,, array( $fields ) );
//
function form( $name, $enctype = 'multipart/form-data', $method = 'POST', $action = '', $class = null, $fields = null ){ ?>
	<form enctype="<?php echo( $enctype ); ?>" name="<?php echo( $name ); ?>" method="<?php echo( $method ); ?>" action="<?php echo( $action ); ?>" class="<?php echo( $class ); ?>">
	<?php foreach ($fields as $field ) { ?>
		<div class="input field <?php echo( $field['length'] ); ?>">
		<i class="<?php echo( $field['icon-class'] ); ?>"><?php echo( $field['icon'] ); ?></i>
			<<?php echo( $field['genre'] ); ?> class="<?php echo( $field['class'] ); ?>" type="<?php echo( $field['type'] ); ?>" name="<?php echo( $field['name'] ); ?>" placeholder="<?php echo( $field['placeholder'] ); ?>" value=""><?php echo( $field['value'] ); ?></<?php echo( $field['genre'] ); ?>>
		</div>
	<?php } ?>
	</form><?php
}

/**
* 
**/
function isEmail( $data ) {
  if ( filter_var( $data, FILTER_VALIDATE_EMAIL) ) {
    return true;
  } else {
    return false;
  }
}

/**
* 
**/
function newButton( $class, $type, $icon ) {
	echo '<a href="./'.$class.'?create='.$type.'" class="addfab mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
  <i class="material-icons">'.$icon.'</i></a>';
}

function generateCode() {
	$code = md5(date('l jS \of F Y h:i:s A').rand(10,1000) );
	return $code;
}

function recordExists( $record ) {
	$link = $GLOBALS['JBLDB'] -> query( "SELECT slug FROM ". _DBPREFIX ."posts WHERE slug = '".$record."'" );
	if ( $link -> num_rows > 0 ) {
		return true;
	} else {
		return false;
	}
}

function error404( $id = "error-404", $code = "404", $message = 'The page you are looking for can\'t be found. Go home by <a href=".">Clicking here.</a>', $class = "error-container" ) { ?>
	<title>Error 404 - <?php showOption( 'name' ); ?></title>
	<?php if ( file_exists( _ABSTHEMES_ . getOption( 'activetheme' ) .'/templates/404.php' ) ):
		require_once( _ABSTHEMES_ . getOption( 'activetheme' ) .'/templates/404.php' );
	else:
		$code = <<<HTML
		<center>
			<div class="{$class}">
				<h1>{$code}</h1>
				<h2>{$message}</h2>
				<br>
				<br>
			</div>
		</center>
HTML;
		echo( $code);
	endif;
}

function snuffle() {

	exit();
}

function isActiveX( $ext ) {
	if ( getOption( 'modules' ) !== "" ) {
		$exts = getOption( 'modules' );
	} else {
		$exts = "{'zahra':'zahra'}";
	}
	if ( in_array( $ext, $exts ) ) {
	return true;
  }
}

function activeTheme( $theme ) {
	if ( getOption( 'activetheme' ) == $theme ) {
		return true;
	} else {
		return false;
	}
}

function LoadActiveX( $ext ) {
    require_once _ABSX_.$ext.'/'.$ext.'.php';
}

function timeZones() {
  $zones_array = array();
  $timestamp = time();
  foreach(timezone_identifiers_list() as $key => $zone) {
    date_default_timezone_set($zone);
    $zones_array[$key]['zone'] = $zone;
    $zones_array[$key]['diff_from_GMT'] = 'UTC/GMT ' . date('P', $timestamp);
  }
  return $zones_array;
}

function add_shortcode($tag, $callback) {

    return Classes\Shortcodes::instance()->register($tag, $callback);
}

function do_shortcode($str) {

    return Classes\Shortcodes::instance()->doShortcode($str);
}

function addMeta( $name, $content ){
	echo '<link name="' . $name . '" content="' . $content . '" >';
}


/**
* Adds cross-site request forgery (CSRF) protection
**/
function csrf(){
	echo '<input type="hidden" name="csrf_token" value="' . CSRF . '" />';
}

function serviceWorker(){ ?>
	<script>
	if ('serviceWorker' in navigator) {
	  window.addEventListener('load', function() {
	    navigator.serviceWorker.register('wacka.js').then(function(registration) {
	      // Registration was successful
	      console.log('ServiceWorker registration successful with scope: ', registration.scope);
	    }, function(err) {
	      // registration failed :(
	      console.log('ServiceWorker registration failed: ', err);
	    });
	  });
	} 
</script><?php
}

function addAction( $hook, $callable, $args ){
	if ( !isset( $GLOBALS['GActions'][$hook] ) ) {
		$GLOBALS['GActions'][$hook] = array();
	}

	$GLOBALS['GActions'][$hook][] = array( $callable, $args );
}

function doActions( $hook ){

	if ( isset( $GLOBALS['GActions'][$hook] ) ) {
		foreach ($GLOBALS['GActions'][$hook] as $callable ) {
			$callback = $callable[0];
			$args = $callable[1];

			if ( !is_array( $args ) ) {
			 	$args = array( $args );
			}

			call_user_func_array($callback, $args );
		}
	}
}

function doHeader(){
	doActions( 'header' );
}

function doFooter(){
	doActions( 'footer' );
}

function addRule( $rule, $callback ){
	if ( !isset( $GLOBALS['GRules'][$rule] ) ) {
		$GLOBALS['GRules'][$rule] = $callback;
	}
}

function rewriteRules( $rule, $args ){
	$callback = $GLOBALS['GRules'][$rule];

	if ( isset( $callback ) ) {
		call_user_func_array($callback, $args );
	}
}

function addSetting( $page, $label = "Options", $callable = "echo", $args = "" ){
	if ( !isset( $GLOBALS['GSettings'][$page] ) ) {
		$GLOBALS['GSettings'][$page] = array();
	}

	$GLOBALS['GSettings'][$page][] = array( $callable, $args, $label );
}

function doSetting( $page ){
	$actions = $GLOBALS['GSettings'][$page];

	if ( isset( $actions ) ) {
		foreach ($actions as $callable ) {
			$callback = $callable[0];
			$args = $callable[1];

			if ( !is_array( $args ) ) {
			 	$args = array( $args );
			}

			call_user_func_array($callback, $args );
		}
	}
}

function addSettingField( $page, $name, $label = null, $type = "text", $icon = "label", $attrs = null ){
	if ( !isset( $GLOBALS['GSettingsField'][$page] ) ) {
		$GLOBALS['GSettingsField'][$page] = array();
	}

	if ( is_null( $label ) ) {
		$label = $name;
	}

	$GLOBALS['GSettingsField'][$page][$name] = array( $type, $label, $icon, $attrs );
}

function renderSettingsForm( $page ){
	echo '<title>'.$GLOBALS['GSettings'][$page][0][2].'</title>';
	echo '<form class="mdl-cell mdl-cell--8-col '.$GLOBALS['GPrimary'].' mdl-card" name="'.$page.'" method="POST" action"" >
		<div class="mdl-card__supporting-text">';
	foreach ($GLOBALS['GSettingsField'][$page] as $name => $field ) {
		doSettingFields( $name, $field );
	}
	csrf();
	echo '<input type="hidden" name="settings" value="'. $page .'">';
	echo '
		<button class="mdl-button mdl-button--fab mdl-button--colored alignright" type="submit"><i class="material-icons">save</i></button>
		</div></form>';
	echo '<form class="mdl-cell mdl-cell--4-col '.$GLOBALS['GPrimary'].' mdl-card" method="POST" action"" ><div class="mdl-card__title">
	<div class="mdl-card__title-text">
		Ads go here</div>
	</div>
	</div>
	<div class="mdl-card__supporting-text"></div>
	</form>';
}

function doSettingFields( $name, $field ){
		$type = $field[0];
		$label = $field[1];
		$icon = $field[2];
		$attrs = $field[3];

		if ( !is_null( $attrs ) ) {
			foreach ($attrs as $attr => $val) {
				implode(" ", $attr . '="'. $val .'"' );
			}
		}
		switch ( $type ) {
			case 'text':
				echo '<div class="input-field">
				<i class="material-icons prefix">'. $icon .'</i>
				<input type="text" id="'. $name .'" name="'. $name .'" value="'. getOption( $name ) .'">
				<label for="'. $name .'" class="center-align">'. ucwords( $label ) .'</label>
				</div>';
				break;
			case 'checkbox':
				echo '<div class="">
				<input type="checkbox" id="'. $name .'" name="'. $name .'" value="'. getOption( $name ) .'"'. getOption( $name ).'>
				<label for="'. $name .'" class="center-align">'. ucwords( $label ) .'</label>
				</div>';
				break;
			case 'radio':
				echo '<div class="">
				<input type="radio" id="'. $name .'" name="'. $name .'" value="'. getOption( $name ) .'">
				<label for="'. $name .'" class="center-align">'. ucwords( $label ) .'</label>
				</div>';
				break;
			case 'textarea':
				echo '<div class="input-field">
				<i class="material-icons prefix">'. $icon .'</i>
				<textarea class="materialize-textarea" name="'. $name .'">'.getOption( $name ) .'</textarea>
				<label for="'. $name .'" class="center-align">'. ucwords( $label ) .'</label>
				</div>';
				break;
				case 'switch':
				echo '<div class="switch">
			    <label>
			      Off
			      <input type="checkbox">
			      <span class="lever"></span>'. $name .'
			      </label>
			  </div>';
			  	break;
				case 'file':
				echo '<div class="file-field input-field">
			      <div class="btn mdl-button--colored">
			        <span class="material-icons">file_upload</span>
			        <input type="file">
			      </div>
			      <div class="file-path-wrapper">
			        <input name="'. $name .'" class="file-path validate" type="text" value="'. ucwords( $label ) .'">
			      </div>
			    </div>';
			  	break;
			
			default:
				echo '<div class="input-field">
				<i class="material-icons prefix">label</i>
				<input type="text" id="'. $name .'" name="'. $name .'" value="'. getOption( $name ) .'">
				<label for="'. $name .'" class="center-align">'. ucwords( $name ) .'</label>
				</div>';
				break;
	}
}

/**
* Recursively copy directories
**/
function reCopy( $src, $dest ){
	if ( is_dir( $dest ) ) {
		die( "A directory by that name already exists.");
	} else {
		mkdir( $dest );
	}

	if ( is_dir( $src ) ) {
		$dir = opendir( $src );

		while ( false !== ( $file = readdir( $dir ) ) ) {
			if ( $file !== "." && $file !== ".." ) {
				if ( is_dir( $src.'/'.$file ) ) {
					reCopy( $src.'/'.$file, $dest.'/'.$file );
				} else {
					copy( $src.'/'.$file, $dest.'/'.$file );
				}
			}
		}

		closedir( $dir );
	}
}

/**
* Recursively copy directories
**/
function copyr( $source, $dest ){
    if (is_link($source)) {
        return symlink(readlink($source), $dest);
    }
    
    if (is_file($source)) {
        return copy($source, $dest);
    }

    if (!is_dir($dest)) {
        mkdir($dest);
    }

    $dir = dir($source);
    while (false !== $entry = $dir->read()) {
        if ($entry == '.' || $entry == '..') {
            continue;
        }
        
        copyr("$source/$entry", "$dest/$entry");
    }

    $dir->close();
    return true;
}

/**
* Recursively delete directories
**/
function rrmdir( $src ){
	$dir = opendir( $dir );
	while ( false !== ( $file = readdir( $dir ) ) ) {
		if ( ( $file != "." ) && ( $file !=".." ) ) {
			$full = $scr . '/' . $file;
			if ( is_dir( $full ) ) {
				rrmdir( $full );
			} else {
				unlink( $full );
			}
		}
	}
}

function renderView( $view, $data = "" ){
	require_once( _ABSVIEWS_.$view.'.php' );
}

function restApi( $elements ){
	if ( !empty( $elements[0] && $elements[0] !== "themes" ) ) {
		$table = strtoupper( $elements[0] );
		$table = $GLOBALS[$table];
	}
	
	$data = file_get_contents("php://input");
	header('Content-Type:Application/json' );

	if ( empty( $elements[0] ) ) {
		$d = array( "name" => getOption( 'name' ). ' API', "description" => getOption( 'description' ), "details" => getOption( 'about' ), "version" => "1.0" , "date" => date( 'Y-m-d H:i:s'), "generator" => "Jabali v.17.10" );
		echo json_encode( $d ) ;
	} elseif ( $elements[0] == "themes") {
			$themes = array();
            $path = _ABSTHEMES_;
            if ( is_dir( $path ) ) {
              $dir = new DirectoryIterator($path);
              foreach ($dir as $fileinfo) {
                  if ($fileinfo->isDir() && !$fileinfo->isDot()) {
                      $themef = $fileinfo->getFilename();
		              $theme = file_get_contents( _ABSTHEMES_.$themef."/".$themef.".json" );
		              $theme = json_decode( $theme, true );

		              $themes[$themef] = $theme;
                  }
              }
            }

            if ( !empty( $elements[1] ) ) {
            	$themes = $themes[$elements[1]];
            }
			echo json_encode( $themes ) ;
	} else {
		if ( empty( $elements[1] ) ) {
			echo json_encode( $table -> sweep() );
		} else switch ( $elements[1] ) {
			case 'create':
				$details = json_decode( $data, true );
				foreach ($details as $field => $value) {
					$table -> $field = $value;
				}
				
				echo json_encode( $table -> create() );
				break;

			case 'update':
				$details = json_decode( $data, true );
				foreach ($details as $field => $value) {
					$table -> $field = $value;
				}
				
				echo json_encode( $table -> update() );
				break;
			
			case 'delete':
				$details = json_decode( $data, true );
				echo json_encode( (array) $table -> delete( /*$details['id']*/ $elements[2] ) );
				break;

			case 'view':
				if ( empty( $elements[2] ) ) {
					 echo json_encode( $table -> sweep() );
				} elseif ( is_numeric( $elements[2] ) ) {
					echo json_encode( $table -> getId( $elements[2] ) );
				} else {
					if ( empty( $elements[3] ) ) {
						$type = substr( $elements[2], 0,-1);
						echo json_encode( $table -> getTypes( $type ) );
					} else {
						if ( empty( $elements[4] ) ) {
							if ( is_numeric( $elements[3] ) ) {
								echo json_encode( $table -> getYear( $elements[3] ) );
							} elseif ( $elements[3] == "writers") {
								echo json_encode( listWriters() );
							} elseif ( $elements[3] == "categories") {
								echo json_encode( listCategories() );
							} elseif ( $elements[3] == "tags" ) {
								echo json_encode( listTags() );
							} elseif ( $elements[3] == "portfolio") {
								echo json_encode( listPortfolio() );
							} else {

							}
						} else {

							if ( is_numeric( $elements[3] ) ) {
								if ( empty( $elements[5] ) ) {
									$table -> getMonth( $elements[3], $elements[4] );
								} else {
									$table -> getDay( $elements[3], $elements[4], $elements[5]);
								}
							} elseif ( $elements[3] == "writers") {
								$table -> getWriters( $elements[4] );
							} elseif ( $elements[3] == "categories") {
								$table -> getCategories( $elements[4] );
							} elseif ( $elements[3] == "tags") {
								$table -> getTags( $elements[4] );
							} elseif ( $elements[3] == "portfolio") {
								if ( $elements[4] == "clients" ) {
									$table -> getClients( $elements[5] );
								} elseif ( $elements[4] == "projects" ) {
									 $table -> getProjects( $elements[5] ); 
								}
							} else {

							}
						}
					}
				}
				break;
			default:
				echo json_encode( $table -> getId( $elements[1] ) );
				break;
		}
	}
}

function isLocalhost() {
    $whitelist = array( '127.0.0.1', '::1' );
    if ( in_array( $_SERVER['REMOTE_ADDR'], $whitelist) ) {
        return true;
    }
}

function isTheme ( $theme) {
    $themes = $GLOBALS['JBLDB'] -> query( "SELECT style FROM ". _DBPREFIX ."users WHERE id = '".$_SESSION[JBLSALT.'Code']."'" );
    if ( $GLOBALS['JBLDB'] -> numRows($themes) > 0) {
        while ( $mytheme = $GLOBALS['JBLDB'] -> fetchArray( $themes) ) {
            if ( $theme == $mytheme['style'] ) {
                echo 'checked';
            }
        }
    }
}

function intallTheme( $source ) {
	$install = new ZipArchive();
	$xT = $install -> open( $source );
	if ( $xT === TRUE ) {
	  $install -> extractTo( _ABSTHEMES_ );
	  echo( 'Extracting theme files' );
	  $install -> close();
	} else {
	  _shout_( "Could not install theme!", "error" );
	}
}

/**
* @param $type - File type
* @param $class - Class of file
* @param $package - Package name
**/

function fileContents( $type, $package = null, $class = null ){
	if ( is_null( $package ) ) {
		$package = array();
		$package['name'] = "Jabali";
		$package['author'] = "Mauko Maunde";
		$package['website'] = "https://jabalicms.org";
		$package['version'] = "17.11";
	}
	switch ( $type ) {
		case 'php':
			$comments = "<?php ";
			$comments .= "\n\n";
			$comments .= "/**\n";
			$comments .= "* @package Jabali \n";
			$comments .= "* @subpackage ". $package['name'] ."\n";
			$comments .= "* @author ". $package['author'] ."\n";
			$comments .= "* @link ". $package['website'] ."\n";
			$comments .= "* @since ". $package['version'] ."\n";
			$comments .= "**/\n";
			break;
		
		case 'css':
			$comments = "/*\n";
			$comments .= "*Package Jabali \n";
			$comments .= "*Subpackage ". $package['name'] ."\n";
			$comments .= "*Author ". $package['author'] ."\n";
			$comments .= "*Link ". $package['website'] ."\n";
			$comments .= "*Since ". $package['version'] ."\n";
			$comments .= "*/\n";
			break;
		
		case 'js':
			$comments = "/*\n";
			$comments .= "*Package Jabali \n";
			$comments .= "*Subpackage ". $package['name'] ."\n";
			$comments .= "*Author ". $package['author'] ."\n";
			$comments .= "*Link ". $package['website'] ."\n";
			$comments .= "*Since ". $package['version'] ."\n";
			$comments .= "*/\n";
			break;
		
		default:
			$comments = "<?php ";
			$comments .= "\n\n";
			$comments .= "/**\n";
			$comments .= "* @package Jabali \n";
			$comments .= "* @subpackage ". $package['name'] ."\n";
			$comments .= "* @author ". $package['author'] ."\n";
			$comments .= "* @link ". $package['website'] ."\n";
			$comments .= "* @since ". $package['version'] ."\n";
			$comments .= "**/\n";
			break;
	}

	return $comments;
}

function hasPosts(){
	if ( $GLOBALS['gpost_index'] <= $GLOBALS['gpost_count'] ) {
		$GLOBALS['gpost_count'] = count( $GLOBALS['gposts'] )-1;
		return true;
	} else {
		$GLOBALS['gpost_count'] = 0;
		return false;
	}
}

function thePost(){
	if ( $GLOBALS['gpost_index'] > $GLOBALS['gpost_count'] ) {
		return false;
	}

	$GLOBALS['gpost'] = $GLOBALS['gposts'][ $GLOBALS['gpost_index'] ];
	$GLOBALS['gpost_index']++;
	
	return $GLOBALS['gpost'];
}

function resetLoop( $callback = "sweep", $args = [] )
{	if ( !is_array( $args ) ) {
		$args = array( $args );
	}
	$GLOBALS['gposts'] = call_user_func_array( array($GLOBALS['POSTS'], $callback ), $args );
	$GLOBALS['gpost'] = null;
	$GLOBALS['gpost_count'] = 0;
	$GLOBALS['gpost_index'] = 0;
}

function theTitle(){
	echo $GLOBALS['gpost']['name'];
}

function theLink( $text = "read more", $class = "" ){
	echo ( '<a href="'.$GLOBALS['gpost']['link'].'" class = "'.$class.'" >'. $text . '</a>');
}

function theContent(){
	echo $GLOBALS['gpost']['details'];
}

function theExcerpt( $length = "250"){
	echo substr( $GLOBALS['gpost']['details'], 0, $length ).' ...';
}

function theId(){
	echo $GLOBALS['gpost']['id'];
}

function theSlug(){
	echo $GLOBALS['gpost']['slug'];
}
 
function theCategories( $class = '' ){
	$tags = $GLOBALS['gpost']['categories'];
	$tags = explode(", ", $tags );
	$tagged = array(); 
	foreach ($tags as $tag ) {
		$tagged[] = ' <a class="'.$class.'" href="'._ROOT.'/categories/'.$tag.'">'.ucwords( $tag ).'</a> ';
	}

	$tags = implode(' ', $tagged );
	echo $tags;
}

function postCategories( $class = '' ){
	$tags = $GLOBALS['gpost']['categories'];
	$tags = explode(", ", $tags );
	$tagged = array(); 
	foreach ($tags as $tag ) {
		$tagged[] = $tag;
	}

	$tags = implode(' ', $tagged );
	echo $tags;
}

function theTags( $class = '' ){
	$tags = $GLOBALS['gpost']['tags'];
	$tags = explode(", ", $tags );
	$tagged = array(); 
	foreach ($tags as $tag ) {
		$tagged[] = '<a class="'.$class.'" href="'._ROOT.'/tags/'.$tag.'">'.ucwords( $tag ).'</a>';
	}

	$tags = implode(' ', $tagged );
	echo $tags;
}

function postTags( $class = '' ){
	$tags = $GLOBALS['gpost']['tags'];
	$tags = explode(", ", $tags );
	$tagged = array(); 
	foreach ($tags as $tag ) {
		$tagged[] = $tag;
	}

	$tags = implode(' ', $tagged );
	echo $tags;
}

function theImage( $width = 500, $height = "", $class = "" )
{
	echo ( '<img src = "'. $GLOBALS['gpost']['avatar'] .'" width = "'.$width.'" height ="'.$height.'" class="'.$class.'" >');
}

function theDate( $format = "M d, Y" )
{
	$created = $GLOBALS['gpost']['created'];
	$timed = strtotime( $created );
	$formatted = date( $format, $timed );
	echo( $formatted );
}

function headerTitle( $table )
{
	if ( isset( $_GET['type'] ) ) {
		$text = ucwords( $table .': '.$_GET['type'].'s ');
	} elseif ( isset( $_GET['view'] ) ) {
		if ( $_GET['view'] == "list" ) {
		  $text = ucwords( $table .': '.$_GET['key']." List" );
		} else {
		  $text =  ucwords( $table );
		}
	} elseif ( isset( $_GET['x'] ) && isset( $_GET['key'] ) ) {
		if ( isset( $_GET['create'] ) ) {
		  $text = "Add New " . ucwords( $_GET['create'] );
		} elseif ( isset( $_GET['edit'] ) ) {
		  $text = "Editing " . ucwords( $_GET['key'] );
		} elseif ( isset( $_GET['settings'] ) ) {
		  $text = ucwords( $_GET['settings'] );
		}
	} elseif ( isset( $_GET['x'] ) && isset( $_GET['create'] ) ) {
		$text = ucwords( "Create ".$_GET['create'] );
	} elseif ( isset( $_GET['x'] ) && isset( $_GET['settings'] ) && !isset( $_GET['key'] ) ) {
		$text = ucwords( $_GET['settings'].' Options' );
	} elseif ( isset( $_GET['create'] ) ) {
		$text = "Add New ".ucwords( $_GET['create'].' ' );
	} elseif ( isset( $_GET['add'] ) ) {
		$text = "Add New ".ucwords( $_GET['add'].' ' );
	} elseif ( isset( $_GET['chat'] ) ) {
		if ( $_GET['chat'] == "list" ) {
		  $text = "Chats List";
		} else {
		  $text = "Chat ".ucwords( $_GET['chat'] );
		}
	} elseif ( isset( $_GET['page'] ) ) {
		$text = ucwords( $_GET['page'] );
	} elseif ( isset( $_GET['settings'] ) ) {
		$text = ucwords( $_GET['settings'].' Options' );
	} elseif ( isset( $_GET['edit'] ) && $_GET['key'] !== "" ) {
		$text = 'Editing '.ucwords( $_GET['key'].' ' );
	} elseif ( isset( $_GET['pay'] ) ) {
		$text = "Pay Via ".strtoupper( $_GET['method'] );
	}

	//author-key, category, type, status, for-key, id-key, page, settings, options, x
	return $text;
}

function head()
{
	echo( '
<!-- Basic App Metadata -->
<meta charset="'. getOption( 'charset' ) .'">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
<meta name="description" content="'. getOption( 'description' ) .'">
<meta name="keywords" content="Keywords">
<meta name="theme-color" content="white"/>
<meta name="background-color" content="#008aff"/>

<!-- Make our app progressive -->
<!-- Android  -->
<meta name="theme-color" content="teal">
<meta name="mobile-web-app-capable" content="yes">

<!-- Add to homescreen for Safari on iOS -->
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="apple-mobile-web-app-title" content="'. getOption( 'name' ) .'">
<link rel="apple-touch-icon-precomposed" href="' . getOption( 'favicon' ) .'">

<!-- Pinned Sites  -->
<meta name="application-name" content="'. getOption( 'name' ) .'">
<meta name="msapplication-tooltip" content="'. getOption( 'name' ) .'">
<meta name="msapplication-starturl" content="/">
<link rel="icon" sizes="192x192" href="' . getOption( 'favicon' ) .'">

<!-- Tile icon for Win8 (144x144 + tile color) -->
<meta name="msapplication-TileImage" content="' . getOption( 'favicon' ) .'">
<meta name="msapplication-TileColor" content="#008080">

<link rel="shortcut icon" href="' . getOption( 'favicon' ) .'">

<link rel="manifest" href="'. _ROOT.'/manifest" >
<link rel="alternate" type="application/rss+xml" href="'. _ROOT.'/feed/" title="'. getOption( 'name' ) .'">' );
}

function manifest()
{
	$manifest["name"] = getOption('name');
	$manifest["short_name"] = getOption('name');
	$manifest["start_url"] = ".";
	$manifest["orientation"] = "portrait";
	$manifest["display"] = "standalone";
	$manifest["theme_color"] = "teal";
	$manifest["background_color"] = "white";
	$manifest["description"] = getOption('description');
	$manifest["icons"][] = array( 'src' => getOption('favicon'), 'type' => "image/png", 'sizes' => "96x96");
	$manifest["icons"][] = array( 'src' => getOption('favicon'), 'type' => "image/png", 'sizes' => "144x144");
	$manifest["icons"][] = array( 'src' => getOption('favicon'), 'type' => "image/png", 'sizes' => "192x192");
	$manifest["icons"][] = array( 'src' => getOption('favicon'), 'type' => "image/png", 'sizes' => "300x300");
	$manifest["related_applications"][] = array( 'platform' => "web", 'url' => "");
	$manifest["related_applications"][] = array( 'platform' => "play", 'url' => "");

	return $manifest;
}

function submitButton( $name = "create", $position = "alignright", $icon = "save", $form = false )
{	csrf();
	if ( $form == true ) $form = '</form>'; else $form = '';
	echo( '<button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored '.$position.'" type="submit" name="'.$name.'"><i class="material-icons">'.$icon.'</i></button>'.$form );
}

function sendButton( $name = "create", $value = "", $class = "alignright", $icon = "save", $form = false )
{	csrf();
	$value = !empty( $value ) ?? $name;
	echo( '<button class="'.$class.'" type="submit" name="'.$name.'">'.$value.'</button>' );
}


function hiddenFields( $fields )
{
	foreach ($fields as $name => $value) {
		echo( '<input type="hidden" name="'.$name.'" value="'.$value.'">' );
	}
}

function updatingJabali()
{
	if ( file_exists( '.jbl' ) ) {
		header("HTTP/1.1 503 Service Temporarily Unavailable");
		header("Status: 503 Service Temporarily Unavailable");
		header("Retry-After: 3600");
		echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
			<html xml:lang=&quot;en&quot; lang=&quot;en&quot; xmlns=&quot;http://www.w3.org/1999/xhtml&quot;>
				<head>
					<meta http-equiv=&quot;Content-Type&quot; content=&quot;text/html; charset=UTF-8&quot; />
					<title>Site upgrade in progress</title>
					<meta name=&quot;robots&quot; content=&quot;none&quot; />
				</head>
				<body>
					<h1>Site upgrade in progress</h1>
					<p>This site is being upgraded, and can\'t currently be accessed.</p>
					<p>It should be back up and running very soon. Please check back in a bit!</p>
					<hr />
				</body>
			</html>';
		exit();
	}
}

function userIP()
{
	$client = $_SERVER['HTTP_CLIENT_IP'];
	$forward = $_SERVER['HTTP_X_FORWARDED_FOR'];
	$remote = $_SERVER['REMOTE_ADDR'];

	if ( filter_var( $client, FILTER_VALIDATE_IP ) ) {
		return $client;
	} elseif ( filter_var( $forward, FILTER_VALIDATE_IP ) ) {
		return $forward;
	} else {
		return $remote;
	}
}

function noAccess( $access = null )
{
	if ( !is_null( $access ) ) {
		define('ACCESS', true );
	}

	if ( !defined( 'ACCESS' ) ) {
		die( 'Direct access of file not allowed' );
		exit();
	}
}

function eMail($receipients, $subject, $message, $cc = null, $attachments = null, $isHTML = true )
{
	$GLOBALS['MAILER'] -> From = getOption('email');
	$GLOBALS['MAILER'] -> FromName = getOption('name');

	if ( is_array( $receipient ) ) {
		foreach ($receipients as $email => $name ) {
			$GLOBALS['MAILER'] -> addAddress( $email, $name );
		}
	} else {
		$GLOBALS['MAILER'] -> addAddress( $receipients );
	}

	//Provide file path and name of the attachments
	$GLOBALS['MAILER'] -> addAttachment("file.txt", "File.txt");        
	$GLOBALS['MAILER'] -> addAttachment("images/profile.png"); //Filename is optional

	$GLOBALS['MAILER'] -> isHTML(true);

	$GLOBALS['MAILER'] -> Subject = "Subject Text";
	$GLOBALS['MAILER'] -> Body = "<i>Mail body in HTML</i>";
	$GLOBALS['MAILER'] -> AltBody = "This is the plain text version of the email content";

	if(!$GLOBALS['MAILER'] -> send()) 
	{
	    return array( "status" => "Failed", "error" => $GLOBALS['MAILER'] -> ErrorInfo );
	} 
	else 
	{
	    return array( "status", "Message has been sent successfully" );
	}
}

function keyGen( string $key )
{
	if ( $key == "salt" ) {
		echo( md5( date( 'YYMMDDHHIISS').rand(89, 489900) ) );
	} elseif ( $key == "auth" ) {
		echo( sha1( md5( date( 'YYMMDDHHIISS').rand(89, 489900) ) ) );
	} else {
		echo( md5( date( 'YYMMDDHHIISS').rand(89, 489900) ) );
		echo( '<br>');
		echo( sha1( md5( date( 'YYMMDDHHIISS').rand(89, 489900) ) ) );
	}
}

function guzzler( string $url, string $method, array $auth,  bool $async = false )
{
	if ( $async !== false ) {
		$request = new \GuzzleHttp\Psr7\Request( $method, $url );
		$promise = $GLOBALS['GUZZLE']->sendAsync($request)->then(function ($response) {
		    return $response->getBody();
		});
		$promise -> wait();
	} else {
		$res = $GLOBALS['GUZZLE']->request($method, $url, [ 'auth' => [$auth[0], $auth[1]] ]);
		$data = $res->getStatusCode();
		$data .= $res->getHeader('content-type');
		$data .= $res->getBody();
		return $data;
	}
	
}

function feed( $type = "rss" )
{
	$title = getOption('name');
	$link = _ROOT;
	$description = getOption('description');
	$copyright = getOption('copyright');
	$mail = getOption('email');
	$date = date( 'Y-m-d H:i:s');
	$salt = JBLSALT;
	$rssdata = <<<RSS
<?xml version="1.0" encoding="UTF-8" ?>
	<rss version="2.0">
		<channel>
			<title>{$title}</title>
			<link>{$link}</link>
			<description>{$description}</description>
			<category>Web development</category>
			<copyright>{$copyright}</copyright>
			<language>en-us</language>
			<docs>https://docs.jabalicms.org/api/feed</docs>
			<webMaster>{$mail}</webMaster>
			<pubDate>{$date}</pubDate>
RSS;

	$atomdata = <<<RSS
<?xml version="1.0" encoding="utf-8"?>
	<feed xmlns="http://www.w3.org/2005/Atom">
		<title>{$title}</title> 
		<link href="{$link}"/>
		<updated>{$date}</updated>
		<id>{$salt}</id>
RSS;

	$posts = $GLOBALS['POSTS'] -> sweep();
	foreach ( $posts as $post ) {
		$details = htmlspecialchars( $post['details']);
		$atomdata .= <<<RSS
			<entry>
				<title>{$post['name']}</title>
				<link href="{$post['link']}"/>
				<id>{$post['id']}</id>
				<updated>{$post['created']}</updated>
				<summary>{$details}</summary>
			</entry>
RSS;

		$rssdata .= <<<RSS
			<item>
				<title>{$post['name']}</title>
				<link>{$post['link']}</link>
				<description>{$details}</description>
				<comments>{$link}/comments/{$post['slug']}</comments>
				<pubDate>{$post['created']}</pubDate>
				<guid>{$post['id']}</guid>
				<category>{$post['categories']}</category>
			</item>
RSS;
}

	$rssdata .= <<<RSS
		</channel>
	</rss>
RSS;

	$atomdata .= <<<RSS
	</feed>
RSS;

	if ( $type == "rss") {
		header("Content-Type: application/xml; charset=UTF-8");
		header('Pragma: public');
		header('Cache-control: private');
		header('Expires: -1');
		echo( $rssdata );
	} elseif ( $type == "atom") {
		header("Content-Type: application/atom+xml; charset=UTF-8");
		header('Pragma: public');
		header('Cache-control: private');
		header('Expires: -1');
		echo( $atomdata );
	} else {
		header("Content-Type: application/xml; charset=UTF-8");
		header('Pragma: public');
		header('Cache-control: private');
		header('Expires: -1');
		echo( $rssdata );
	}
}