<?php 
/**
* @package Jabali Framework
* @subpackage Setup
* @link https://docs.mauko.co.ke/jabali/classes/setup
* @author Mauko Maunde
* @version 0.17.06
**/


function isLocalhost() {
    $whitelist = array( '127.0.0.1', '::1' );
    if ( in_array( $_SERVER['REMOTE_ADDR'], $whitelist) ) {
        return true;
    }
}

if ( file_exists('./inc/config.php' ) ) {
	header( "Location: ./install.php" );
}

if ( !file_exists( '.htaccess' ) ) {
	$rewrite = fopen( '.htaccess', 'w' );

	$text = '# JABALI INIT';
	fwrite( $rewrite,  $text );

	$txt = "\n\n";
	fwrite( $rewrite,  $txt );

	$text = '<IfModule mod_rewrite.c>';
	fwrite( $rewrite,  $text );

	$txt = "\n";
	fwrite( $rewrite,  $txt );

	$text = "RewriteEngine On";
	fwrite( $rewrite,  $text );

	$txt = "\n";
	fwrite( $rewrite,  $txt );

	if ( isLocalhost() ) {
		$base = 'RewriteBase /'.basename ( __DIR__ ).'/';
	} else {
		$base = 'RewriteBase /';
	}
	fwrite( $rewrite, $base );

	$txt = "\n";
	fwrite( $rewrite,  $txt );

	$text = 'RewriteRule ^index\.php$ - [L]';
	fwrite( $rewrite,  $text );

	$txt = "\n";
	fwrite( $rewrite,  $txt );

	$text = 'RewriteRule ^([^\.]+)$ $1.php [NC]';
	fwrite( $rewrite,  $text );

	$txt = "\n";
	fwrite( $rewrite,  $txt );

	$text = 'RewriteCond %{REQUEST_FILENAME} !-d';
	fwrite( $rewrite,  $text );

	$txt = "\n";
	fwrite( $rewrite,  $txt );

	$text = 'RewriteCond %{REQUEST_FILENAME} !-f';
	fwrite( $rewrite,  $text );

	$txt = "\n";
	fwrite( $rewrite,  $txt );

	$text = 'RewriteRule . /'.basename ( __DIR__ ).'/index.php [L]';
	fwrite( $rewrite,  $text );

	$txt = "\n";
	fwrite( $rewrite,  $txt );

	$text = '</IfModule>';
	fwrite( $rewrite,  $text );

	$txt = "\n\n";
	fwrite( $rewrite,  $txt );

	$text = '# JABALI EXIT';
	fwrite( $rewrite,  $text );
}

if ( isset( $_POST['setup'] ) && $_POST['host'] != "" && $_POST['user'] != "" && $_POST['prefix'] != "" && $_POST['name'] != "" ) {

	$dbhost = $_POST["host"];
	$dbname = $_POST["name"];
	$dbuser = $_POST["user"];
	$dbpass = $_POST["password"];
	$home = $_POST["home"];

	$dbprefix = $_POST['prefix'];

	function conFigure( $dbhost, $dbname, $dbuser, $dbpass, $home, $dbprefix ) {
		$dbfile = fopen( "./inc/config.php", "w" ) or die( "Unable to create configuration file!" );
		$txt = "<?php ";
		fwrite( $dbfile, $txt );
		$txt = "\n";
		fwrite( $dbfile, $txt );
		$text = '/**';
		fwrite( $dbfile, $text );
		$txt = "\n";
		fwrite( $dbfile, $txt );
		$txt = '* @package Jabali Framework';
		fwrite( $dbfile, $txt );
		$txt = "\n";
		fwrite( $dbfile, $txt );
		$txt = '* @subpackage Configuration File';
		fwrite( $dbfile, $txt );
		$txt = "\n";
		fwrite( $dbfile, $txt );
		$txt = '* @link https://docs.mauko.co.ke/jabali/configuration';
		fwrite( $dbfile, $txt );
		$txt = "\n";
		fwrite( $dbfile, $txt );
		$txt = '* @author Mauko Maunde';
		fwrite( $dbfile, $txt );
		$txt = "\n";
		fwrite( $dbfile, $txt );
		$txt = '* @version 0.17.06';
		fwrite( $dbfile, $txt );
		$txt = "\n";
		fwrite( $dbfile, $txt );
		$txt = '**/';
		fwrite( $dbfile, $txt );
		$txt = "\n";
		fwrite( $dbfile, $txt );
		$txt = "\n";
		fwrite( $dbfile, $txt );
		$text = 'define( "hDBNAME", "'.$dbname.'" );';
		fwrite( $dbfile, $text );
		$txt = "\n";
		fwrite( $dbfile, $txt );
		$text = 'define( "hDBUSER", "'.$dbuser.'" );';
		fwrite( $dbfile, $text );
		$txt = "\n";
		fwrite( $dbfile, $txt );
		$text = 'define( "hDBPASS", "'.$dbpass.'" );';
		fwrite( $dbfile, $text );
		$txt = "\n";
		fwrite( $dbfile, $txt );
		$text = 'define( "hDBHOST", "'.$dbhost.'" );';
		fwrite( $dbfile, $text );
		$txt = "\n";
		fwrite( $dbfile, $txt );
		$text = 'define( "hROOT", "'.$home.'" );';
		fwrite( $dbfile, $text );
		$txt = "\n\n";
		fwrite( $dbfile, $txt );
		$text = 'define( "hDBPREFIX", "'.$dbprefix.'" );';
		fwrite( $dbfile, $text );
		$txt = "\n\n";
		fwrite( $dbfile, $txt );
		$salts = sha1(date('YmdHs')).sha1(date('YmdHm' ) );
		$text = 'define( "hSALTS", "'.$salts.'" );';
		fwrite( $dbfile, $text );
		$txt = " ?>";
		fwrite( $dbfile, $txt );
		fclose( $dbfile );

		return true;
	}

	if ( conFigure( $dbhost, $dbname, $dbuser, $dbpass, $home, $dbprefix ) ) {
		header( "Location: ./install.php" );
	} else {
		echo 'Could Not create configuration file<code>config.php</php><br>
		<h4>Suggestions</h4><br>
		1. Allow jabali <a href="https://stackoverflow.com/questions/2900690/how-do-i-give-php-write-access-to-a-directory">write permissions</a>.<br>
		2. Edit the sample appropriately and save as, then point your browser to http://yoursite.com/install.php';
	}
} else {

    $protocol = ((!empty( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] != 'off' ) || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://"; ?>
    <!doctype html>
	<!--
	  Jabali Framework
	  © 2017 Mauko Maunde. All rights reserved.

	  Licensed under the MIT license (the "License" );
	  you may not use this file except in compliance with the License.
	  You may obtain a copy of the License at https://opensource.org/licenses/MIT
	-->
	<html lang="en" xmlns="http://www.w3.org/1999/html">
		<head>
		    <link rel="stylesheet" href="./inc/assets/css/materialize.css">
		    <link rel="stylesheet" href="./inc/assets/css/material-icons.css">
		    <link rel="stylesheet" href="./inc/assets/css/jabali.css">
		    <script src="./inc/assets/js/jquery-3.2.1.min.js"></script>
		    <script src="./inc/assets/js/materialize.min.js"></script>
		    <script src="./inc/assets/js/material.js"></script>
			<title>Setup [ JABALI ]</title>
		</head>

		<div class="mdl-layout mdl-layout-transparent mdl-js-layout">
			<body>
				<main class="mdl-layout__content">
					<div class="mdl-grid">
						<div class="mdl-cell mdl-cell--2-col"></div>
				        <form method="POST" action="" class="mdl-grid mdl-cell mdl-cell--8-col mdl-color--blue">
					        <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone">
						        <center>
						        	<img src="./inc/assets/images/logo-w.png" width="200px;">
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
					        <div class="input-field mdl-cell mdl-cell--7-col">
						        <i class="material-icons prefix">label_outline</i>
						        <input name="prefix" id="prefix" type="text" value="db_">
						        <label for="prefix" class="center-align">Database Prefix</label>
					        </div>

					        <input name="home" id="home" type="hidden" value="<?php 
							if ( isLocalhost() ) { 
					        	echo $protocol . $_SERVER['HTTP_HOST'] . '/' . basename( __DIR__ ) . '/'; 
					        } else { 
					        	echo $protocol . $_SERVER['HTTP_HOST'] . '/'; } ?>">

					        <div class="input-field mdl-cell mdl-cell--2-col">
					        	<button class="mdl-button mdl-button--fab mdl-js-button mdl-button--raised mdl-button--colored alignright" type="submit" name="setup"><i class="material-icons">arrow_forward</i></button>
					        </div>
				        </form>
						<div class="mdl-cell mdl-cell--2-col"></div>
					</div>
				</main>
			</body>
		</div>
		<script src="./inc/assets/js/d3.js"></script>
		<script src="./inc/assets/js/getmdl-select.min.js"></script>
		<script src="./inc/assets/js/material.js"></script>
		<script src="./inc/assets/js/materialize.min.js"></script>
		<script src="./inc/assets/js/nv.d3.js"></script>
		<script src="./inc/assets/js/widgets/employer-form/employer-form.js"></script>
		<script src="./inc/assets/js/widgets/line-chart/line-chart-nvd3.js"></script>
		<script src="./inc/assets/js/list.js"></script>
		<script src="./inc/assets/js/widgets/pie-chart/pie-chart-nvd3.js"></script>
		<script src="./inc/assets/js/widgets/table/table.js"></script>
		<script src="./inc/assets/js/widgets/todo/todo.js"></script>
	</html>
<?php } ?>