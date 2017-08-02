<?php 
include '../inc/config.php';
include '../inc/jabali.php'; 
include './header.php';

if ( isset( $_GET['activate'] ) ) {
	mysqli_query( $GLOBALS['conn'], "UPDATE ". hDBPREFIX ."users SET h_status = 'active' WHERE h_code='".$_GET['activate']."'" );
	echo "<script type = \"text/javascript\">
              alert(\"User Activated Successfully!\" );
          </script>";
	$hUser -> getUsers();
}

if ( isset( $_GET['delete'] ) ) {
	mysqli_query( $GLOBALS['conn'], "DELETE FROM ". hDBPREFIX ."users WHERE h_code='".$_GET['delete']."'" );
	$hUser -> getUsers();
}

if ( isset( $_GET['create'] ) ) {
	$hForm -> userForm();
}

if ( isset( $_GET['edit'] ) ) {
	$hForm -> editUserForm( $_GET['edit'] );
}

if ( isset( $_GET['fav'] ) ) {
	$getRate = mysqli_query( $GLOBALS['conn'], "INSERT INTO hratings (h_author, h_for, h_type ) 
		VALUES ('".$_SESSION['myCode']."', '".$_GET['fav']."', 'user' )" );
}

if ( isset( $_GET['author'] ) ) {
	$hUser -> getUsersAuthor( $_GET['author'] );
	if ( isCap( 'admin' ) ) {
		newButton('user', 'doctor', 'create' );
	}
}

if ( isset( $_GET['view'] )){
	if ( $_GET['view'] == "list" ) {
		if ( isset( $_GET['type'] ) ) {
			if ( isset( $_GET['location'] ) ) {
				$hUser -> getUsersLoc( $_GET['location'] );
				if ( isCap( 'admin' ) ) {
					newButton('user', 'author', 'create' );
				}
			} else {
				$hUser -> getUsersType( $_GET['type'] );
				if ( isCap( 'admin' ) ) {
					newButton('user', $_GET['type'], 'create' );
				}
			}
		} elseif ( isset( $_GET['location'] ) ) {
			$hUser -> getUsersLoc( $_GET['location'] );
			if ( isCap( 'admin' ) ) {
				newButton('user', 'author', 'create' );
			}
		} else {
			$hUser -> getUsers();
			if ( isCap( 'admin' ) ) {
				newButton('user', 'author', 'create' );
			}
		}
	} elseif ( $_GET['view'] == "pending" ) {
		$hUser -> getPendingUsers();
		if ( isCap( 'admin' ) ) {
			newButton('user', 'author', 'create' );
		}
	} else {
		$hUser -> getUserCode( $_GET['view'] );
	}

}

if ( isset( $_POST['h_alias'] ) || isset( $_POST['h_author'] ) || isset( $_POST['h_avatar'] ) || isset( $_POST['h_by'] ) || isset( $_POST['h_category'] ) || isset( $_POST['h_organization'] ) || isset( $_POST['h_code'] ) || isset( $_POST['h_created'] ) || isset( $_POST['h_desc'] ) || isset( $_POST['h_email'] ) || isset( $_POST['h_fav'] ) || isset( $_POST['h_key'] ) || isset( $_POST['h_level'] ) || isset( $_POST['h_link'] ) || isset( $_POST['h_location'] ) || isset( $_POST['h_notes'] ) || isset( $_POST['h_phone'] ) || isset( $_POST['h_reading'] ) || isset( $_POST['h_status'] ) || isset( $_POST['h_subtitle'] ) || isset( $_POST['h_tags'] ) || isset( $_POST['h_type'] ) || isset( $_POST['h_updated'] ) ) {
	

	if ( isset( $_POST['register'] ) ) {
		$hUser -> createUser();
	}

	if ( isset( $_POST['update'] ) ) {
		$hUser -> updateUser( $_POST['code'] );
	}

}

include './footer.php';
