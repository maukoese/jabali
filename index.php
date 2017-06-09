<?php
/**
* @package Jabali Framework
* @subpackage Home
* @link https://docs.mauko.co.ke/jabali/home
* @author Mauko Maunde
* @version 0.17.06
**/

session_start();

$dbfile = 'functions/config.php';
if (!file_exists($dbfile)) {
	header("Location: setup");
}

include 'header.php';
$year = date("Y");
$month = date("m");
$day = date("d");
$directory = "uploads/$year/$month/$day/";

if (!is_dir($directory)) {
	mkdir($directory, 755, true);
}

if (isset($_GET['post'])) {
	if ($_GET['post'] == "posts") {
		$hPost -> getPosts();
	} else {
		$hPost -> getPostCode($_GET['post']);
	}
} else { ?>
	<title>Access Your Health [ <?php getOption('name'); ?> ]</title>
	<div style="padding-top:40px; class="mdl-color--<?php if (isset($_SESSION['myCode'])) {
            primaryColor($_SESSION['myCode']);
        } else { echo "blue";}  ?>">
	    <div id="login_div">
		<center><a href="<?php echo hROOT; ?>"><img src="<?php echo hIMAGES; ?>logo-w.png" width="300px;"></a><br><?php
		if (isset($_GET['logout'])) {
			session_destroy();

			echo '<div id="success" class="alert mdl-color--orange">
                    <span>You are now logged out!</span>
                </div>';
		} ?><a href="./login" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--colored">
	  <i class="material-icons">exit_to_app</i> LOGIN</a><br><br>
	    <a href="./register?type=user" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--colored">
	  <i class="material-icons">create</i> NEW USER</a> <a href="./register?type=center" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--colored">
	  <i class="material-icons">edit</i> NEW CENTER</a><br>
	  <p>© <?php getOption('name'); ?> 2017 - All Rights Reserved</p>
	  <a href="./about">About</a> - <a href="./tos">TOS</a> - <a href="./faq">FAQs</a>
		</center><br>
	    </div>
	</div> 
<?php }
include 'footer.php';
?>