<?php 
/**
* @package Jabali Framework
* @subpackage Database
* @link https://docs.mauko.co.ke/jabali/jabali
* @author Mauko Maunde
* @version 0.17.06
**/

/**
* Default Date/Timezone
**/
date_default_timezone_set( "Africa/Nairobi" );

/**
* Install main instance of Jabali
**/
function installJabali() {
	$husers = mysqli_query( $GLOBALS['conn'], "CREATE TABLE IF NOT EXISTS ". hDBPREFIX ."users(
	h_alias VARCHAR(100),
	h_author VARCHAR(12),
	h_avatar VARCHAR(100), 
	h_organization VARCHAR(100),
	h_code VARCHAR(16),
	h_created DATETIME,
	h_custom VARCHAR(12),
	h_description TEXT,
	h_email VARCHAR(50),
	h_fav INT(5),
	h_gender VARCHAR(10),
	h_key VARCHAR(100),
	h_level VARCHAR(12),
	h_link VARCHAR(100),
	h_location VARCHAR(50),
	h_logdate VARCHAR(12),
	h_logip VARCHAR(20),
	h_notes TEXT,
	h_password VARCHAR(50),
	h_phone VARCHAR(20),
	h_social TEXT,
	h_status VARCHAR(20),
	h_style VARCHAR(100),
	h_type VARCHAR(50),
	h_updated DATE,
	h_username VARCHAR(20),
	PRIMARY KEY(h_code)
	)" );

	$hresources = mysqli_query( $GLOBALS['conn'], "CREATE TABLE IF NOT EXISTS ". hDBPREFIX ."resources (
	h_alias VARCHAR(100),
	h_author VARCHAR(12),
	h_avatar VARCHAR(20),
	h_by VARCHAR(20), 
	h_organization VARCHAR(20),
	h_code VARCHAR(16),
	h_created DATETIME,
	h_custom VARCHAR(12),
	h_description TEXT,
	h_email VARCHAR(50),
	h_key VARCHAR(100),
	h_level VARCHAR(12),
	h_link VARCHAR(100),
	h_location VARCHAR(50),
	h_notes TEXT,
	h_phone VARCHAR(20),
	h_social VARCHAR(500),
	h_status VARCHAR(20),
	h_type VARCHAR(50),
	h_updated DATE,
	PRIMARY KEY(h_code)
	)" );

	$hservices = mysqli_query( $GLOBALS['conn'], "CREATE TABLE IF NOT EXISTS ". hDBPREFIX ."services (
	h_alias VARCHAR(100),
	h_author VARCHAR(12),
	h_by VARCHAR(20), 
	h_organization VARCHAR(20),
	h_code VARCHAR(16),
	h_created DATETIME,
	h_email VARCHAR(50),
	h_key VARCHAR(100),
	h_level VARCHAR(12),
	h_link VARCHAR(100),
	h_location VARCHAR(50),
	h_notes TEXT,
	h_status VARCHAR(20),
	h_type VARCHAR(50),
	h_updated DATE,
	PRIMARY KEY(h_code)
	)" );

	$hmessages = mysqli_query( $GLOBALS['conn'], "CREATE TABLE IF NOT EXISTS ". hDBPREFIX ."messages(
	h_alias VARCHAR(100),
	h_author VARCHAR(20),
	h_by VARCHAR(20),
	h_code VARCHAR(16),
	h_created DATETIME,
	h_description TEXT,
	h_email VARCHAR(50),
	h_for VARCHAR(20),
	h_key VARCHAR(100),
	h_level VARCHAR(12),
	h_link VARCHAR(100),
	h_phone VARCHAR(20),
	h_status VARCHAR(20),
	h_type VARCHAR(50),
	PRIMARY KEY(h_code)
	)" );

	$hcomments = mysqli_query( $GLOBALS['conn'], "CREATE TABLE IF NOT EXISTS ". hDBPREFIX ."comments(
	h_alias VARCHAR(100),
	h_author VARCHAR(20),
	h_by VARCHAR(20),
	h_code VARCHAR(16),
	h_created DATETIME,
	h_description TEXT,
	h_email VARCHAR(50),
	h_for VARCHAR(20),
	h_key VARCHAR(100),
	h_level VARCHAR(12),
	h_link VARCHAR(100),
	h_status VARCHAR(20),
	h_type VARCHAR(50),
	h_updated DATE,
	PRIMARY KEY(h_code)
	)" );

	$huploads = mysqli_query( $GLOBALS['conn'], "CREATE TABLE IF NOT EXISTS ". hDBPREFIX ."uploads(
	h_alias VARCHAR(100),
	h_author VARCHAR(12),
	h_avatar VARCHAR(20),
	h_by VARCHAR(20), 
	h_organization VARCHAR(20),
	h_code VARCHAR(16),
	h_created DATETIME,
	h_custom VARCHAR(12),
	h_description TEXT,
	h_email VARCHAR(50),
	h_for VARCHAR(20),
	h_key VARCHAR(100),
	h_level VARCHAR(12),
	h_link VARCHAR(100),
	h_location VARCHAR(50),
	h_notes TEXT,
	h_phone VARCHAR(20),
	h_status VARCHAR(20),
	h_type VARCHAR(50),
	h_updated DATE,
	PRIMARY KEY(h_code)
	)" );

	$posts = mysqli_query( $GLOBALS['conn'], "CREATE TABLE IF NOT EXISTS ". hDBPREFIX ."posts(
	h_alias VARCHAR(300),
	h_author VARCHAR(20),
	h_by VARCHAR(100),
	h_avatar VARCHAR(100),
	h_category VARCHAR(20), 
	h_organization VARCHAR(20),
	h_code VARCHAR(16),
	h_created DATETIME,
	h_description TEXT,
	h_email VARCHAR(50),
	h_fav INT(5),
	h_gallery VARCHAR(500),
	h_key VARCHAR(100),
	h_level VARCHAR(12),
	h_link VARCHAR(100),
	h_location VARCHAR(100),
	h_notes TEXT,
	h_phone VARCHAR(100),
	h_reading VARCHAR(500),
	h_status VARCHAR(20),
	h_subtitle VARCHAR(100),
	h_tags VARCHAR(50),
	h_type VARCHAR(50),
	h_updated DATE,
	PRIMARY KEY(h_code)
	)" );

	$hnotes = mysqli_query( $GLOBALS['conn'], "CREATE TABLE IF NOT EXISTS ". hDBPREFIX ."notes (
	id INT(10) NOT NULL AUTO_INCREMENT,
	h_author VARCHAR(20),
	h_by VARCHAR(100),
	h_created DATETIME,
	h_description TEXT,
	h_for VARCHAR(20),
	h_link VARCHAR(100),
	h_type VARCHAR(50),
	PRIMARY KEY(id)
	)" );

	$hratings = mysqli_query( $GLOBALS['conn'], "CREATE TABLE IF NOT EXISTS ". hDBPREFIX ."ratings (
	id INT(10) NOT NULL AUTO_INCREMENT,
	h_author VARCHAR(20),
	h_code VARCHAR(16),
	h_for VARCHAR(20),
	h_type VARCHAR(50),
	PRIMARY KEY(id)
	)" );

	$hfaqs = mysqli_query( $GLOBALS['conn'], "CREATE TABLE IF NOT EXISTS ". hDBPREFIX ."faqs (
	h_alias VARCHAR(100),
	h_code VARCHAR(16),
	h_description TEXT,
	h_type VARCHAR(50),
	PRIMARY KEY(h_code)
	)" );

	$hoptions = mysqli_query( $GLOBALS['conn'], "CREATE TABLE IF NOT EXISTS ". hDBPREFIX ."options (
	id INT(10) NOT NULL AUTO_INCREMENT,
	h_alias VARCHAR(200),
	h_code VARCHAR(100) UNIQUE,
	h_description TEXT,
	h_updated DATETIME,
	PRIMARY KEY(id)
	)" );

	$hextensions = mysqli_query( $GLOBALS['conn'], "CREATE TABLE IF NOT EXISTS ". hDBPREFIX ."menus(
	h_alias VARCHAR(100) UNIQUE,
	h_author VARCHAR(100),
	h_avatar VARCHAR(100), 
	h_code VARCHAR(16),
	h_for VARCHAR(50),
	h_link VARCHAR(300),
	h_location VARCHAR(100),
	h_status VARCHAR(10),
	h_type VARCHAR(10),
	PRIMARY KEY(h_code)
	)" );

	$hextensions = mysqli_query( $GLOBALS['conn'], "CREATE TABLE IF NOT EXISTS ". hDBPREFIX ."extensions(
	h_alias VARCHAR(300),
	h_author VARCHAR(20),
	h_avatar VARCHAR(100),
	h_category VARCHAR(20), 
	h_code VARCHAR(16),
	h_created DATE,
	h_description TEXT,
	h_email VARCHAR(50),
	h_social VARCHAR(500),
	h_status VARCHAR(20),
	h_support VARCHAR(500),
	h_updated DATETIME,
	h_website VARCHAR(500),
	PRIMARY KEY(h_code)
	)" );

	if ( $husers && $hresources && $hmessages && $hcomments && $huploads && $posts && $hnotes && $hratings && $hfaqs && $hoptions && $hextensions ) {
		return true; 
	} else {
		return false;
	}

	return true;
} 

/**
* Include the main configuration file
**/
function connectDb() {
	$GLOBALS['conn'] = mysqli_connect( hDBHOST, hDBUSER, hDBPASS, hDBNAME );

	if ( mysqli_connect_errno() ) {
		printf( "Connection failed: %s\ ", mysqli_connect_error() );
		exit();
	}
	return true;
}

function is_localhost() {
	$whitelist = array( '127.0.0.1', '::1' );
	if ( in_array( $_SERVER['REMOTE_ADDR'], $whitelist) )
	    return true;
}

if ( is_localhost() ) {
	$base = basename( dirname( __DIR__ ) );
} else {
	$base = "";
}

/**
* Script Directories
**/
define( 'hABS', $_SERVER['DOCUMENT_ROOT'].'/'.$base.'/' );
define( 'hABSAD', $_SERVER['DOCUMENT_ROOT'].'/'.$base.'/admin/' );
define( 'hABSINC', $_SERVER['DOCUMENT_ROOT'].'/'.$base.'/inc/' );
define( 'hABSX', $_SERVER['DOCUMENT_ROOT'].'/'.$base.'/inc/extensions/' );
define( 'hABSTEMPLE', $_SERVER['DOCUMENT_ROOT'].'/'.$base.'/inc/templates/' );
define( 'hABSUP', $_SERVER['DOCUMENT_ROOT'].'/'.$base.'/uploads/' );

/**
* Scripts
**/
define( 'hADMIN', hROOT.'admin/' );
define( 'hINC', hROOT.'inc/' );
define( 'hUPLOADS', hROOT.'uploads/' );
define( 'hEXTENSIONS', hINC.'extensions/' );

/**
* Assets
**/
define( 'hASSETS', hROOT.'inc/assets/' );
define( 'hSTYLES', hASSETS.'css/' );
define( 'hSCRIPTS', hASSETS.'js/' );
define( 'hIMAGES', hASSETS.'images/' );
define( 'hFONTS', hASSETS.'fonts/' );

/**
* 
**/
define( 'hLOGIN', hROOT.'login/' );
define( 'hREGISTER', hROOT.'register/' );
define( 'hAPI', hROOT.'api/' );

/**
* 
**/
define( 'hEMAIL', 'jabali@mauko.co.ke' );
define( 'hPHONE', '25420 440 4993' );

/**
* Include Function
**/
function getFile( $path, $file ) {

	include $path.$file.'.php';
}

/**
* Load stylesheets
**/
function getStyle( $link ) { ?>

	<link rel="stylesheet" type="text/css" href="<?php echo $link; ?>"><?php 
}

/**
* Load Javascript
**/
function getScript( $link ) { ?>

	<script src="<?php echo $link; ?>"></script><?php 
}

/**
* Display logo
**/
function frontlogo() {
	
	echo '<a href="'.hROOT.'"><img src="'.hIMAGES.'logo-w.png" width="250px;"></a>';
}

/**
* Print out something
**/
function _show_( $what ) {

	echo $what;
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
	if ( $_SESSION['myCap'] == $cap ) {
		return true;
	} else {
		return false;
	}
}

function isAuthor( $author ) {
	if ( $_SESSION['myCode'] == $author ) {
		return true;
	} else {
		return false;
	}
}

function emailExists( $email ) {
	$theEmail = mysqli_query( $GLOBALS['conn'], "SELECT h_email FROM ". hDBPREFIX ."users WHERE h_email ='".$email."'" );
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
	if ( $_SESSION['myCode'] == $_GET['view'] ) {
		return true;
	} else {
		return false;
	}
}


/**
* 
**/
function uploadFile() {
	$year = date('Y' );
	$month = date('m' );
	$day = date('d' );
	$uploads = hUPLOADS . "$year/$month/$day/";
	$upload = $uploads . basename( $_FILES['h_avatar']['name'] );
	$uploadOk = 1;

	if ( file_exists( $upload) ) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
	}

	if ( $uploadOk == 0 ) {
    echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
	    if ( move_uploaded_file( $_FILES['h_avatar']["tmp_name"], $upload) ) {
	        echo "The file ". basename( $_FILES["h_avatar"]["name"] ). " has been uploaded.";
	    } else {
	        echo "Sorry, there was an error uploading your file.";
	    }
	}

}

/**
* 
**/
function getMsgCount() {
    $getMessages = mysqli_query( $GLOBALS['conn'], "SELECT * FROM ". hDBPREFIX ."messages WHERE (h_status = 'unread' AND h_for = '".$_SESSION['myCode']."' )" );
    if ( $getMessages -> num_rows >= 0 ) {
      $messagecount = $getMessages -> num_rows;
      echo $messagecount;
    } else {
      _show_( '0' );
    }
}

/**
* 
**/
function getNoteCount() {
	$getMessages = mysqli_query( $GLOBALS['conn'], "SELECT * FROM ". hDBPREFIX ."comments" );
	if ( $getMessages -> num_rows >= 0 ) {
	  	$messagecount = $getMessages -> num_rows;
	  	echo $messagecount;
	} else {
	  	_show_( '0' );
	}
}

/**
* 
**/
function primaryColor() {
	$getColor = mysqli_query( $GLOBALS['conn'], "SELECT h_style FROM ". hDBPREFIX ."users  WHERE h_code='".$_SESSION['myCode']."'" );
	if ( $getColor ) {
		while ( $themes = mysqli_fetch_assoc( $getColor) ) {
			if ( $themes['h_style'] == "love" ) {
				echo "cyan";
			} elseif ( $themes['h_style'] == "zahra" ) {
				echo "teal";
			} elseif ( $themes['h_style'] == "wizz" ) {
				echo "yellow";
			} elseif ( $themes['h_style'] == "pint" ) {
				echo "blue";
			} elseif ( $themes['h_style'] == "stack" ) {
				echo "grey";
			} elseif ( $themes['h_style'] == "hot" ) {
				echo "red";
			} elseif ( $themes['h_style'] == "princess" ) {
				echo "pink";
			} elseif ( $themes['h_style'] == "haze" ) {
				echo "purple";
			} elseif ( $themes['h_style'] == "prince" ) {
				echo "deep-purple";
			} elseif ( $themes['h_style'] == "indie" ) {
				echo "indigo";
			} elseif ( $themes['h_style'] == "sky" ) {
				echo "light-blue";
			} elseif ( $themes['h_style'] == "greene" ) {
				echo "green";
			} elseif ( $themes['h_style'] == "vegan" ) {
				echo "light-green";
			} elseif ( $themes['h_style'] == "lemon" ) {
				echo "lime";
			} elseif ( $themes['h_style'] == "wait" ) {
				echo "amber";
			} elseif ( $themes['h_style'] == "orange" ) {
				echo "orange";
			} elseif ( $themes['h_style'] == "sun" ) {
				echo "deep-orange";
			} elseif ( $themes['h_style'] == "earth" ) {
				echo "brown";
			} elseif ( $themes['h_style'] == "ghost" ) {
				echo "blue-grey";
			} elseif ( $themes['h_style'] == "bred" ) {
				echo "black";
			} elseif ( $themes['h_style'] == "peachy" ) {
				echo "peachpuff";
			} elseif ( $themes['h_style'] == "queen" ) {
				echo "purple";
			} elseif ( $themes['h_style'] == "madge" ) {
				echo "madge";
			} else {
				echo "teal";
			}
		}
	}
}

/**
* 
**/
function secondaryColor() {
	$getColor = mysqli_query( $GLOBALS['conn'], "SELECT h_style FROM ". hDBPREFIX ."users  WHERE h_code='".$_SESSION['myCode']."'" );
	if ( $getColor ) {
		while ( $themes = mysqli_fetch_assoc( $getColor) ) {
			if ( $themes['h_style'] == "love" ) {
				echo "magenta";
			} elseif ( $themes['h_style'] == "zahra" ) {
				echo "red";
			} elseif ( $themes['h_style'] == "wizz" ) {
				echo "black";
			} elseif ( $themes['h_style'] == "pint" ) {
				echo "pink";
			} elseif ( $themes['h_style'] == "stack" ) {
				echo "brown";
			} elseif ( $themes['h_style'] == "hot" ) {
				echo "blue";
			} elseif ( $themes['h_style'] == "princess" ) {
				echo "cyan";
			} elseif ( $themes['h_style'] == "haze" ) {
				echo "green";
			} elseif ( $themes['h_style'] == "prince" ) {
				echo "green";
			} elseif ( $themes['h_style'] == "indie" ) {
				echo "indigo";
			} elseif ( $themes['h_style'] == "sky" ) {
				echo "blue";
			} elseif ( $themes['h_style'] == "greene" ) {
				echo "green";
			} elseif ( $themes['h_style'] == "vegan" ) {
				echo "green";
			} elseif ( $themes['h_style'] == "lemon" ) {
				echo "lime";
			} elseif ( $themes['h_style'] == "wait" ) {
				echo "orange";
			} elseif ( $themes['h_style'] == "orange" ) {
				echo "yellow";
			} elseif ( $themes['h_style'] == "sun" ) {
				echo "deep-orange";
			} elseif ( $themes['h_style'] == "earth" ) {
				echo "orange";
			} elseif ( $themes['h_style'] == "ghost" ) {
				echo "red";
			} elseif ( $themes['h_style'] == "bred" ) {
				echo "red";
			} elseif ( $themes['h_style'] == "peachy" ) {
				echo "maroon";
			} elseif ( $themes['h_style'] == "queen" ) {
				echo "green";
			} elseif ( $themes['h_style'] == "madge" ) {
				echo "#171306";
			} else {
				echo "red";
			}
		}
	}
}

/**
* 
**/
function textColor() {
	$getColor = mysqli_query( $GLOBALS['conn'], "SELECT h_style FROM ". hDBPREFIX ."users  WHERE h_code='".$_SESSION['myCode']."'" );
	if ( $getColor ) {
		while ( $themes = mysqli_fetch_assoc( $getColor) ) {
			if ( $themes['h_style'] == "love" ) {
				echo "cyan";
			} elseif ( $themes['h_style'] == "zahra" ) {
				echo "teal";
			} elseif ( $themes['h_style'] == "wizz" ) {
				echo "brown";
			} elseif ( $themes['h_style'] == "bluepint" ) {
				echo "blue";
			} elseif ( $themes['h_style'] == "stack" ) {
				echo "grey";
			}
		}
	}
}

/**
* 
**/
function getOption( $code ) {
	$option = "";
    $getOptions = mysqli_query( $GLOBALS['conn'], "SELECT * FROM ". hDBPREFIX ."options WHERE h_code='".$code."'" );
    if ( $getOptions -> num_rows > 0 ) {
        while ( $siteOption = mysqli_fetch_assoc( $getOptions) ) { 
           $option = $siteOption['h_description'];
        }
    }
    
    return $option;
}

/**
* 
**/
function showOption( $code ) {
    $getOptions = mysqli_query( $GLOBALS['conn'], "SELECT * FROM ". hDBPREFIX ."options WHERE h_code='".$code."'" );
    if ( $getOptions -> num_rows > 0 ) {
        while ( $siteOption = mysqli_fetch_assoc( $getOptions) ) { 
            _show_( $siteOption['h_description'] );
        }
    }
}

function getHeader() {

	include './header.php';
}

function getFooter() {

	include './footer.php';
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
	[ <?php
	showOption( 'name' ); ?> ]
    </title><?php
}

/**
* 
**/
function tableHeader( $collums ) { ?>
	<div class="mdl-cell mdl-cell--12-col">
		<table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>">
			<thead>
				<tr><?php
				$collums = explode(" ,", $collums );
				for ( $c=0; $c < count( $collums ); $c++) { ?>
					<th class="mdl-data-table__cell--non-numeric">
						<?php _show_( strtoupper( $collums[$c] ) ); ?>
					</th><?php
				} ?>
				</tr>
			</thead>
			<tbody><?php
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
//form( $name, 'multipart/form-data', 'POST', '', 'mdl-grid', array( $fields ) );
//
function form( $name, $enctype, $method, $action, $class, $fields ){ ?>
	<form enctype="<?php _show_( $enctype ); ?>" name="<?php _show_( $name ); ?>" method="<?php _show_( $method ); ?>" action="<?php _show_( $action ); ?>" class="<?php _show_( $class ); ?>">
	<?php foreach ($fields as $field ) { ?>
		<div class="input field <?php _show_( $field['length'] ); ?>">
		<i class="<?php _show_( $field['icon-class'] ); ?>"><?php _show_( $field['icon'] ); ?></i>
			<<?php _show_( $field['genre'] ); ?> class="<?php _show_( $field['class'] ); ?>" type="<?php _show_( $field['type'] ); ?>" name="<?php _show_( $field['name'] ); ?>" placeholder="<?php _show_( $field['placeholder'] ); ?>" value=""><?php _show_( $field['value'] ); ?></<?php _show_( $field['genre'] ); ?>>
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
function newButton( $hclass, $htype, $hicon ) {
	echo '<a href="./'.$hclass.'?create='.$htype.'" class="addfab mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
  <i class="material-icons">'.$hicon.'</i></a>';
}

function jabaliAction( $function, $arguments ) {

	call_user_func( $function, $arguments );
}

function generateCode() {
	$code = md5(date('l jS \of F Y h:i:s A').rand(10,1000) );
	return $code;
}

function recordExists( $record ) {
	$link = mysqli_query( $GLOBALS['conn'], "SELECT h_link FROM ". hDBPREFIX ."posts WHERE h_link = '".$record."'" );
	if ( $link -> num_rows > 0 ) {
		return true;
	} else {
		return false;
	}
}

function error404( $code ) { ?>
	<title>Error 404</title>
	<div style="margin:1%;" class="mdl-grid" >
		<center>
			<div class="mdl-cell mdl-cell--7-col mdl-card mdl-color--red" >
				<div class="mdl-card-media">
					<img src="<?php _show_( hIMAGES.'404.jpg'); ?>" width="100%" style="overflow: hidden;" >
				</div>
				<div class="mdl-card__title mdl-card--expand">
					<div class="mdl-card__title-text">
					<center>Error 404! <?php _show_( ucwords( $code ) ); ?> Not Found!</center>
				</div>
			  	<div class="mdl-layout-spacer"></div>
			  	<div class="mdl-card__subtitle-text">
			    	<i class="material-icons">search</i>
			 	</div>
			</div>
			<div class="mdl-card__menu">
			<a href="./index.php" class="mdl-button mdl-js-ripple-effect mdl-button--icon"><i class="material-icons">home</i></a>
			</div>
			</div>
		</center>
	</div><?php 
}

function snuffle() {

	exit();
}

function isActiveX ( $ext ) {
	if ( getOption( 'extensions' ) !== "" ) {
		$exts = getOption( 'extensions' );
	} else {
		$exts = "{'zahra':'zahra'}";
	}
	$exts = json_decode ( $exts, true );
	if ( in_array( $ext, $exts ) ) {
	return true;
  }
}

function activeX() {
  $exts = getOption( 'extensions' );
  $exts = json_decode ( $exts, true );
  foreach ( $exts as $ext ) {
    require_once hABSX.$ext.'/'.$ext.'.php';
  }
}

function LoadActiveX( $ext ) {
    require_once hABSX.$ext.'/'.$ext.'.php';
}

/**
* Autoload Classes
**/

include 'classes\Dbobject.php';
include 'classes\Mysqlidb.php';
include 'classes\Uniform.php';
include 'classes\Options.php';
include 'classes\Menus.php';
include 'classes\Forms.php';
include 'classes\Users.php';
include 'classes\Posts.php';
include 'classes\Resources.php';
include 'classes\Services.php';
include 'classes\Messages.php';
include 'classes\Comments.php';
include 'classes\Widgets.php';
include 'classes\Social.php';
require ( 'classes/Shortcodes.php' );

use Jabali\classes\Social;
use Jabali\classes\Widgets;
use Jabali\classes\Comments;
use Jabali\classes\Messages;
use Jabali\classes\Services;
use Jabali\classes\Resources;
use Jabali\classes\Posts;
use Jabali\classes\Users;
use Jabali\classes\Forms;
use Jabali\classes\Menus;
use Jabali\classes\Options;
use Jabali\classes\Dbobject;
use Jabali\classes\Mysqlidb;
use Jabali\classes\Uniform;

$GLOBALS['hGlobal'] = new Jabali\classes\_hUniform();
$hGlobal = new Jabali\classes\_hUniform();
$GLOBALS['hOpt'] = new Jabali\_hOptions();
$hOpt = new Jabali\_hOptions();
$GLOBAL['hMenu'] = new Jabali\_hMenus();
$hMenu = new Jabali\_hMenus();
$GLOBALS['hForm'] = new Jabali\_hForms();
$hForm = new Jabali\_hForms();
$GLOBALS['hUser'] = new Jabali\_hUsers();
$hUser = new Jabali\_hUsers();
$GLOBALS['hPost'] = new Jabali\_hPosts();
$hPost = new Jabali\_hPosts();
$GLOBALS['hResource'] = new Jabali\_hResources();
$hResource = new Jabali\_hResources();
$GLOBALS['hService'] = new Jabali\_hServices();
$hService = new Jabali\_hServices();
$GLOBALS['hMessage'] = new Jabali\_hMessages();
$hMessage = new Jabali\_hMessages();
$GLOBALS['hComment'] = new Jabali\_hComments();
$hComment = new Jabali\_hComments();
$GLOBALS['hWidget'] = new Jabali\_hWidgets();
$hWidget = new Jabali\_hWidgets();
$GLOBALS['hSocial'] = new Jabali\_hSocial();
$hSocial = new Jabali\_hSocial();

function add_shortcode($tag, $callback) {

    return \App\Shortcodes::instance()->register($tag, $callback);
}

function do_shortcode($str) {

    return \App\Shortcodes::instance()->doShortcode($str);
} ?>
