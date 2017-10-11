<?php 
session_start();
require_once( '../init.php' );
require_once( 'header.php' );

if ( isset( $_GET['delete'] ) ) {
	$GLOBALS['JBLDB'] -> query( "DELETE FROM ". _DBPREFIX ."resources WHERE id='".$_GET['delete']."'" );
	$hResource -> getResources();
}

if ( isset( $_GET['create'] ) ) {
	$hForm -> resourceForm();
}

if ( isset( $_GET['edit'] ) ) {
	$hForm -> editResourceForm( $_GET['edit'] );
}

if ( isset( $_GET['fav'] ) ) {
	$getRate = $GLOBALS['JBLDB'] -> query( "INSERT INTO hratings (author, for, ilk ) 
		VALUES ('".$_SESSION[JBLSALT.'Code']."', '".$_GET['fav']."', 'resource' )" );
}

if ( isset( $_GET['author'] ) ) {
	$hResource-> getResourcesAuthor( $_GET['author'] );
	if ( isCap( 'admin' ) ) {
		newButton('resource', 'resource', 'create' );
	}
}

if ( isset( $_GET['view'] )){
	if ( $_GET['view'] == "list" ) {
		if ( isset( $_GET['type'] ) ) {
			$hResource -> getResourcesType( $_GET['type'] );
			if ( isCap( 'admin' ) || isCap( 'center' ) ) {
				newButton('resource', $_GET['type'], 'create' );
			}
		} elseif ( isset( $_GET['location'] ) ) {
			$hResource -> getResourcesLoc( $_GET['location'] );
			if ( isCap( 'admin' ) || isCap( 'center' ) ) {
				newButton('resource', $_GET['location'], 'create' );
			}
		} else {
			$hResource -> getResources();
			if ( isCap( 'admin' ) || isCap( 'center' ) ) {
				newButton('resource', 'center', 'create' );
			}
		}
	} else {
		$hResource -> getResourceCode( $_GET['view'] );
	}

}

if ( isset( $_POST['update'] ) ) {
	$hResource -> updateResource( $_POST['id'] );
}

if ( isset( $_POST['register'] ) ) {
	$hResource -> createResource();
}
require_once( './footer.php' );
