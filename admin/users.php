<?php
session_start();
require_once( '../init.php' );

if ( isset( $_POST['register'] ) ) {
	$hUser -> createUser();
}

if ( isset( $_POST['update'] ) ) {
	$hUser -> updateUser( $_POST['code'] );
}

require_once( 'header.php' ); ?>
<div class="mdl-grid"><?php

if ( isset( $_GET['activate'] ) ) {
	$GLOBALS['JBLDB'] -> query( "UPDATE ". _DBPREFIX ."users SET state = 'active' WHERE id='".$_GET['activate']."'" );
	echo "<script type = \"text/javascript\">
              alert(\"User Activated Successfully!\" );
          </script>";
	$hUser -> getUsers();
} elseif ( isset( $_GET['delete'] ) ) {
	$GLOBALS['JBLDB'] -> query( "DELETE FROM ". _DBPREFIX ."users WHERE id='".$_GET['delete']."'" );
	$hUser -> getUsers();
} elseif ( isset( $_GET['create'] ) ) {
	$hForm -> userForm();
} elseif ( isset( $_GET['edit'] ) ) {
	$hForm -> editUserForm( $_GET['edit'] );
} elseif ( isset( $_GET['fav'] ) ) {
	$getRate = $GLOBALS['JBLDB'] -> query( "INSERT INTO hratings (author, for, ilk ) 
		VALUES ('".$_SESSION[JBLSALT.'Code']."', '".$_GET['fav']."', 'user' )" );
} elseif ( isset( $_GET['author'] ) ) {
	$hUser -> getUsersAuthor( $_GET['author'] );
	if ( isCap( 'admin' ) ) {
		newButton('users', 'doctor', 'create' );
	}
} elseif ( isset( $_GET['view'] )){
	if ( $_GET['view'] == "list" ) {
		if ( isset( $_GET['type'] ) ) {
			if ( isset( $_GET['location'] ) ) {
				$hUser -> getUsersLoc( $_GET['location'] );
				if ( isCap( 'admin' ) ) {
					newButton('users', 'author', 'create' );
				}
			} else {
				$hUser -> getUsersType( $_GET['type'] );
				if ( isCap( 'admin' ) ) {
					newButton('users', $_GET['type'], 'create' );
				}
			}
		} elseif ( isset( $_GET['location'] ) ) {
			$hUser -> getUsersLoc( $_GET['location'] );
			if ( isCap( 'admin' ) ) {
				newButton('users', 'author', 'create' );
			}
		} else {
			$hUser -> getUsers();
			if ( isCap( 'admin' ) ) {
				newButton('users', 'author', 'create' );
			}
		}
	} elseif ( $_GET['view'] == "pending" ) {
		$hUser -> getPendingUsers();
		if ( isCap( 'admin' ) ) {
			newButton('users', 'author', 'create' );
		}
	} else {
		$hUser -> getUserCode( $_GET['view'] );
	}
}
?></div><?php
require_once( 'footer.php' );