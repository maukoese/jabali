<?php 
/**
* @package Jabali - The Plug-N-Play Framework
* @subpackage Setup
* @link https://docs.jabalicms.org/setup/
* @author Mauko Maunde
* @since 0.17.05
* @license MIT - https://opensource.org/licenses/MIT
**/


function isLocalhost()
{
    $whitelist = array( '127.0.0.1', '::1' );
    if ( in_array( $_SERVER['REMOTE_ADDR'], $whitelist) ) {
        return true;
    }
}

if ( file_exists('app/config.php' ) ) {
	header( "Location: install.php" );
}

if ( !file_exists( '.htaccess' ) ) {
	$rewrite = fopen( '.htaccess', 'w' );

	$text = "# JABALI INIT\n\n";
	fwrite( $rewrite,  $text );

	$text = "<IfModule mod_rewrite.c>\n";
	fwrite( $rewrite,  $text );

	$text = "RewriteEngine On\n";
	fwrite( $rewrite,  $text );

	if ( !isLocalhost() ) {
		
		$text = "RewriteCond %{HTTPS} off\n";
		fwrite( $rewrite,  $text );

		$text = "RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]\n";
		fwrite( $rewrite,  $text );
	}

	if ( isLocalhost() && $_SERVER['DOCUMENT_ROOT'] !== __DIR__ ) {
		$base = '/'.basename( __DIR__ ).'/';
	} else {
		$base = '/';
	}
	fwrite( $rewrite, "RewriteBase " . $base."\n" );

	$text = 'RewriteRule ^index\.php$ - [L]';
	fwrite( $rewrite,  $text );

	$txt = "\n";
	fwrite( $rewrite,  $txt );

	$text = 'RewriteRule ^([^\.]+)$ $1.php [NC]';
	fwrite( $rewrite,  $text );

	$txt = "\n";
	fwrite( $rewrite,  $txt );

	$text = 'RewriteCond %{REQUEST_FILENAME} !-f';
	fwrite( $rewrite,  $text );

	$txt = "\n";
	fwrite( $rewrite,  $txt );

	$text = 'RewriteCond %{REQUEST_FILENAME} !-d';
	fwrite( $rewrite,  $text );

	$txt = "\n";
	fwrite( $rewrite,  $txt );

	if ( isLocalhost() ) {
		$baser = '/'.basename( __DIR__ );
	} else {
		$baser = '';
	}
	fwrite( $rewrite,  'RewriteRule . '. $baser.'/index.php [L]'  );

	$txt = "\n";
	fwrite( $rewrite,  $txt );

	$text = '</IfModule>';
	fwrite( $rewrite,  $text );

	$txt = "\n\n";
	fwrite( $rewrite,  $txt );

	$text = '# JABALI EXIT';
	fwrite( $rewrite,  $text );
}

if ( isset( $_POST['setup'] ) && $_POST['host'] != "" && $_POST['user'] != "" && $_POST['prefix'] != "" && $_POST['name'] != "" && $_POST['dbtype'] != "" ) {

	$dbhost = $_POST["host"];
	$dbname = $_POST["name"];
	$dbuser = $_POST["user"];
	$dbpass = $_POST["password"];
	$home = $_POST["home"];

	$dbprefix = $_POST['prefix'];
	$dbtype = $_POST['dbtype'];
	$dbport = $_POST['dbport'];
	$dbip = $_POST['dbip'];

	function conFigure( $dbhost, $dbname, $dbuser, $dbpass, $home, $dbprefix, $dbtype, $dbport, $dbip )
	{
		$dbfile = fopen( "app/config.php", "w" ) or die( "Unable to create configuration file!" );
		$salts = sha1( date('YmdHis') ).sha1( date('YmdHm') );
		$salt = str_shuffle( md5($salts) );
		$auth = str_shuffle( sha1( $salts ) );
		$config = '<?php 
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
* @param _ROOT The app\'s home/root url
* @param _DBPRFIX A prefix to be added before all database tables. 
* Allows multiple Jabali installations on same database.
* @param JBLSALT A unique, app-specific string for authentication.
* @param JBLAUTH Used in conjuction with JBLSALT for authentication and 
* prevention of Cross-site Request Forgery(CSRF). Also unique and app-specific
**/

$server["dbhost"] = "'.$dbhost.'";
$server["dbuser"] = "'.$dbuser.'";
$server["dbpass"] = "'.$dbpass.'";
$server["dbname"] = "'.$dbname.'";
$server["dbtype"] = "'.$dbtype.'";
$server["dbport"] = "'.$dbport.'";
$server["dbip"] = "'.$dbip.'";

define( "_ROOT", "'.$home.'" );
define( "_DBPREFIX", "'.$dbprefix.'" );
define( "JBLSALT", "'.$salt.'" );
define( "JBLAUTH", "'.$auth.'" );';		
		fwrite( $dbfile, $config );
		fclose( $dbfile );

		return true;
	}

	if ( conFigure( $dbhost, $dbname, $dbuser, $dbpass, $home, $dbprefix, $dbtype, $dbport, $dbip ) ) {
		header( "Location: install.php" );
	} else {
		_shout_( 'Could Not create configuration file <code>config.php</code><br>
		<h4>Suggestions</h4><br>
		1. Allow jabali <a href="https://stackoverflow.com/questions/2900690/how-do-i-give-php-write-access-to-a-directory">write permissions</a>.<br>
		2. Manually edit the <code>config-sample.php</code>file appropriately and save as <code>config.php</code>, then point your browser to https://yoursite.com/install.php', 'error' );
	}
} else {

    $protocol = ( ( !empty( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] != 'off' ) || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://"; ?>
    <!DOCTYPE html>
	<!--
	  Jabali Framework
	  © 2017 Mauko Maunde. All rights reserved.

	  Licensed under the MIT license (the "License" );
	  You may not use this file except in compliance with the License.
	  You may obtain a copy of the License at https://opensource.org/licenses/MIT
	-->
	<html lang="en" xmlns="https://www.w3.org/1999/html">
		<head>
        	<meta name="viewport" content="width=device-width, initial-scale=1.0">
		    <link rel="stylesheet" href="app/assets/css/materialize.css">
		    <link rel="stylesheet" href="app/assets/css/material-icons.css">
		    <link rel="stylesheet" href="app/assets/css/jabali.css">
		    <script src="app/assets/js/jquery-3.2.1.min.js"></script>
		    <script src="app/assets/js/materialize.min.js"></script>
		    <script src="app/assets/js/material.js"></script>
			<title>Setup - Jabali CMS</title>
		</head>

		<div class="mdl-layout mdl-layout-transparent mdl-js-layout">
			<body>
				<main class="mdl-layout__content">
					<div class="mdl-grid">
						<div class="mdl-cell mdl-cell--3-col"></div>
				        <form method="POST" action="" class="mdl-grid mdl-cell mdl-cell--6-col mdl-color--madge">
					        <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone">
						        <center>
						        	<img src="app/assets/images/logo-w.png" width="200px;">
						        </center>
					        </div>

					        <div class="mdl-cell mdl-cell--2-col"></div>
					        <div class="input-field mdl-cell mdl-cell--9-col">
						        <i class="material-icons prefix">public</i>
						        <input name="host" id="host" type="text" value="localhost">
						        <label for="host" class="center-align">Database Host</label>
					        </div>

					        <div class="mdl-cell mdl-cell--2-col"></div>
					        <div class="input-field mdl-cell mdl-cell--9-col">
						        <i class="material-icons prefix">perm_identity</i>
						        <input name="user" id="user" type="text" value="username">
						        <label for="user" class="center-align">Database Username</label>
					        </div>

					        <div class="mdl-cell mdl-cell--2-col"></div>
					        <div class="input-field mdl-cell mdl-cell--9-col">
						        <i class="material-icons prefix">lock</i>
						        <input name="password" id="password" type="text" value="password">
						        <label for="password">Database Password</label>
					        </div>

					        <div class="mdl-cell mdl-cell--2-col"></div>
					        <div class="input-field mdl-cell mdl-cell--9-col">
						        <i class="material-icons prefix">label</i>
						        <input name="name" id="name" type="text" value="jabali">
						        <label for="name" class="center-align">Database Name</label>
					        </div>

					        <div class="mdl-cell mdl-cell--2-col"></div>
					        <div class="input-field mdl-cell mdl-cell--4-col">
						        <i class="material-icons prefix">label_outline</i>
						        <input name="prefix" id="prefix" type="text" value="db_">
						        <label for="prefix" class="center-align">Database Prefix</label>
					        </div>

							<div class="input-field mdl-cell--5-col mdl-js-textfield mdl-textfield--floating-label getmdl-select">
							<i class="material-icons prefix">data_usage</i>
							<input class="mdl-textfield__input" id="ilk" name="dbtype" type="text" readonly tabIndex="-1" value="MySQL" >
						        <label for="ilk" class="center-align">Database Type</label>
							<label for="ilk"><i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i></label>
							<ul class="mdl-menu mdl-menu--top-left mdl-js-menu mdl-color--madge" for="ilk">
							<li class="mdl-menu__item" data-val="MySQL">MySQL</li>
							<li class="mdl-menu__item" data-val="SQLite">SQLite</li>
							<li class="mdl-menu__item" data-val="PostgreSQL">PostgreSQL</li>
							<!-- <li class="mdl-menu__item" data-val="MongoDB">MongoDB</li> -->
							</ul>
							</div>
					        <input name="home" type="hidden" value="<?php 
							if ( isLocalhost() ) { 
					        	echo $protocol . $_SERVER['HTTP_HOST'] . '/' . basename( __DIR__ ); 
					        } else { 
					        	echo $protocol . $_SERVER['HTTP_HOST']; } ?>">

					        <input name="dbport" type="hidden" value="<?php echo $_SERVER['SERVER_PORT']; ?>" />
					        <input name="dbip" type="hidden" value="<?php echo $_SERVER['SERVER_ADDR']; ?>" />

					        <button class="addfab mdl-button mdl-button--fab mdl-js-button mdl-button--raised mdl-button--colored alignright" type="submit" name="setup"><i class="material-icons">arrow_forward</i></button>
				        </form>
						<div class="mdl-cell mdl-cell--3-col"></div>
					</div>
				</main>
			</body>
		</div>
		<script src="app/assets/js/d3.js"></script>
		<script src="app/assets/js/getmdl-select.min.js"></script>
		<script src="app/assets/js/material.js"></script>
		<script src="app/assets/js/materialize.js"></script>
		<script src="app/assets/js/nv.d3.js"></script>
		<script src="app/assets/js/widgets/employer-form/employer-form.js"></script>
		<script src="app/assets/js/widgets/line-chart/line-chart-nvd3.js"></script>
		<script src="app/assets/js/list.js"></script>
		<script src="app/assets/js/widgets/pie-chart/pie-chart-nvd3.js"></script>
		<script src="app/assets/js/widgets/table/table.js"></script>
		<script src="app/assets/js/widgets/todo/todo.js"></script>
	</html>
<?php }