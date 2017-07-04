<?php 
/*
*For Carrying out test SQLs
* TO-Do: Remove in dist
*/ 
include '../inc/jabali.php';
include './header.php';
$hOpt = new _hOptions();
	$usertypes = array( array( 'name' => 'admin', 'level' => 'admin' ), array( 'name' => 'organization' , 'level' => 'organization' ), array( 'name' => 'editor', 'level' => 'editor' ), array( 'name' => 'author', 'level' => 'author' ), array('name' => 'subscriber', 'level' => 'subscriber' ) );
	$usertypes = json_encode( $usertypes );
	$hOpt -> create ( 'User Types', 'usertypes', $usertypes, $h_created );;

include './footer.php'; ?>
<?php ?>