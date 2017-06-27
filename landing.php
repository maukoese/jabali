<?php 
/**
* @package Jabali Framework
* @subpackage Home
* @link https://docs.mauko.co.ke/jabali/home
* @author Mauko Maunde
* @version 0.17.06
**/

$dbfile = 'inc/config.php';
if ( !file_exists( $dbfile) ) {
	header( "Location: ./setup" );
}

include 'header.php';
$year = date( "Y" );
$month = date( "m" );
$day = date( "d" );
$directory = "uploads/$year/$month/$day/";

if ( !is_dir( $directory) ) {
	mkdir( $directory, 755, true );
}

if ( isset( $_GET['post'] ) ) {
	if ( $_GET['post'] == "posts" ) {
		$hPost -> getArticles();
	} else {
		$hPost -> getArticleCode( $_GET['post'] );
		$hSocial -> bottomshare( $_GET['post'] );
	}
} else { ?>
	<title>Access Your Health [ <?php showOption( 'name' ); ?> ]</title>
	<div style="padding-top:40px;" >
	    <div id="login_div" class="">
		<center><a href="<?php echo hROOT; ?>"><img src="<?php echo hIMAGES; ?>logo-w.png" width="300px;"></a><br><?php 
		if ( isset( $_GET['logout'] ) ) {

			echo '<div id="success" class="alert mdl-color--orange">
                    <span>You are now logged out!</span>
                </div>';
		} 
		if ( !isset( $_SESSION['myCode'] ) ) { ?>
		<a href="./login" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-color--<?php if ( isset( $_SESSION['myCode'] ) ) { secondaryColor(); } else { echo "red"; } ?>">
	  		<i class="material-icons">exit_to_app</i> LOGIN
	  	</a><br><?php 
	  } ?><br>
	  <p>© <?php showOption( 'name' ); ?> 2017 - All Rights Reserved</p><b>
	  <a href="./about">About</a> - <a href="./tos">TOS</a> - <a href="./faq">FAQs</a></b>
		</center><br>
	    </div>
	    
<div class="fixed-action-btn">
	<a class="btn-floating btn-large red">
		<i class="large material-icons">mode_edit</i>
	</a>
	<ul>
		<li class="waves-effect waves-light"><a href="./register?type=user" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--colored">
  <i class="mdi mdi-account-plus mdi-24px mdl-color-text--red"></i></a></li>
            <li class="waves-effect waves-light"><a href="./register?type=organization" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--colored">
  <i class="material-icons mdl-color-text--red">location_city</i></a></li>
            <li class="waves-effect waves-light"><a href="./contact" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--colored">
  <i class="material-icons mdl-color-text--red">message</i></a></li>
	</ul>
</div>
</div><?php 
}

include 'footer.php'; ?>