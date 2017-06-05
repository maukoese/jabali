<?php
include './header.php';

if (isset($_GET['delete'])) {
	mysqli_query($GLOBALS['conn'], "DELETE FROM husers WHERE h_code='".$_GET['delete']."'");
	$hUser -> getUsers();
}

if (isset($_GET['create'])) {
	$hForm -> userForm();
}

if (isset($_GET['edit'])) {
	$hForm -> editUserForm($_GET['edit']);
}

if (isset($_GET['fav'])) {
	$getRate = mysqli_query($GLOBALS['conn'], "INSERT INTO hratings (h_author, h_for, h_type ) 
		VALUES ('".$_SESSION['myCode']."', '".$_GET['fav']."', 'user')");
}

if(isset($_GET['view'])){
	if ($_GET['view'] == "list") {
		if(isset($_GET['type'])) {
			$hUser -> getUsersType($_GET['type']);
			if ( isCap( 'admin' ) ) {
				newButton('user', $_GET['type'], 'create');
			}
		} elseif(isset($_GET['location'])) {
			$hUser -> getUsersLoc($_GET['location']);
			if ( isCap( 'admin' ) ) {
				newButton('user', 'doctor', 'create');
			}
		} else {
			$hUser -> getUsers();
			if ( isCap( 'admin' ) ) {
				newButton('user', 'doctor', 'create');
			}
		}
	} else {
		$hUser -> getUserCode($_GET['view']);
	}

}

if (isset($_POST['update'])) {
	$hUser -> updateUser($_POST['code']);
}

if (isset($_POST['register'])) {
	$hUser -> createUser();
}

include './footer.php';
