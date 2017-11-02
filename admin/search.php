<?php 
/**
* Searching
* TO-DO: Move to individual files
* @link https://tutorialrepublic.com/php-tutorial/php-mysql-ajax-livesearch.php
* @return Requested data from parent
**/
session_start();
require_once( '../init.php' );
require_once( 'header.php' );

if ( isset( $_REQUEST['searchterm'] ) ) {
	$posts = $GLOBALS['POSTS'] -> sweep();
	if ( !isset( $posts['error'] ) ) {
		foreach ($posts as $post) {
			echo '<h1><a href="" class="mdl-list--item" >'.$post['name'].'</a></h1>';
		}
	} else {
		echo "Nothing found!";
	}
}
require_once( 'footer.php' );