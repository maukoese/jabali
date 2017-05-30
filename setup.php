<?php
if (file_exists('./functions/db.php')) {
	//header("Location: ./login");
}

if (isset($_POST['setup']) && $_POST['host'] != "" && $_POST['user'] != "" && $_POST['password'] != "" && $_POST['name'] != "") {

	include './functions/jabali.php';
	
	$dbhost = $_POST["host"];
	$dbname = $_POST["name"];
	$dbuser = $_POST["user"];
	$dbpass = $_POST["password"];
	$home = $_POST["home"];

	function createDb($dbhost, $dbname, $dbuser, $dbpass, $home) {
		$dbfile = fopen("./functions/db.php", "w") or die("Unable to open file!");
		$txt = "<?php";
		fwrite($dbfile, $txt);
		$txt = "\n";
		fwrite($dbfile, $txt);
		$text = '/**';
		fwrite($dbfile, $text);
		$txt = "\n";
		fwrite($dbfile, $txt);
		$text = '* Database Constants';
		fwrite($dbfile, $text);
		$txt = "\n";
		fwrite($dbfile, $txt);
		$text = '**/';
		fwrite($dbfile, $text);
		$txt = "\n";
		fwrite($dbfile, $txt);
		$text = 'define("hDBNAME","'.$dbname.'");';
		fwrite($dbfile, $text);
		$txt = "\n";
		fwrite($dbfile, $txt);
		$text = 'define("hDBUSER","'.$dbuser.'");';
		fwrite($dbfile, $text);
		$txt = "\n";
		fwrite($dbfile, $txt);
		$text = 'define("hDBPASS","'.$dbpass.'");';
		fwrite($dbfile, $text);
		$txt = "\n";
		fwrite($dbfile, $txt);
		$text = 'define("hDBHOST","'.$dbhost.'");';
		fwrite($dbfile, $text);
		$txt = "\n";
		fwrite($dbfile, $txt);
		$text = 'define("hROOT","'.$home.'");';
		fwrite($dbfile, $text);
		$txt = "\n";
		fwrite($dbfile, $txt);
		$txt = "?>";
		fwrite($dbfile, $txt);
		fclose($dbfile);

		return true;
	}

	if (createDb($dbhost, $dbname, $dbuser, $dbpass, $home)) {
		header("Location: ./install?module=app");
	}
} else {

	include './header.php';?>	

    <link rel="stylesheet" href="./assets/css/materialize.css">
    <link rel="stylesheet" href="./assets/css/material-icons.css">
    <link rel="stylesheet" href="./assets/css/jabali.css">
    <script src="./assets/js/materialize.min.js"></script>
    <script src="./assets/js/material.js"></script>
	<title>Setup [ <?php getOption('name'); ?> ]</title>
	<div style="padding-top:40px;" >
    <div id="login_div">
        <center><img src="./assets/images/logo.png"></center>
        <form method="POST" action="">
        <div class="input-field">
        <i class="material-icons prefix">account_circle</i>
        <input name="host" id="host" type="text" value="localhost">
        <label for="host" class="center-align">Database Host</label>
        </div>

        <div class="input-field">
        <i class="material-icons prefix">account_circle</i>
        <input name="user" id="user" type="text" value="username">
        <label for="user" class="center-align">Database Username</label>
        </div>

        <div class="input-field">
        <i class="material-icons prefix">lock</i>
        <input name="password" id="password" type="text" value="password">
        <label for="password">Database Password</label>
        </div>


        <div class="input-field">
        <i class="material-icons prefix">account_circle</i>
        <input name="name" id="name" type="text" value="jabali">
        <label for="name" class="center-align">Database Name</label>
        </div>

        <div class="input-field">
        <i class="material-icons prefix">home</i>
        <input name="home" id="home" type="text" value="<?php 
        function is_localhost() {
	    $whitelist = array( '127.0.0.1', '::1' );
	    if( in_array( $_SERVER['REMOTE_ADDR'], $whitelist) )
	        return true;
		}

		if (is_localhost()) {
			$base = basename(__DIR__);
		} else {
			$base = "";
		}
        $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://"; echo $protocol . $_SERVER['HTTP_HOST'].'/'.$base; ?>/">
        <label for="home" class="center-align">Home Url</label>
        </div>

        <button class="mdl-button mdl-button--fab mdl-js-button mdl-button--raised mdl-button--colored" type="submit" name="setup"><i class="material-icons">forward</i></button>
        </form>
    </div>
	</div>
<?php
}
?>