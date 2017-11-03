<?php 
/**
* @package Jabali Framework
* @subpackage Admin Users
* @link https://docs.jabalicms.org/users/
* @author Mauko Maunde
* @since 0.17.04
**/
session_start();
require_once( '../init.php' );

if ( isset( $_POST['register'] ) ) {

    if ( empty( $_POST['authkey'] ) ) { $_POST['authkey'] = str_shuffle( generateCode() ); }
    if ( empty( $_POST['fname'] ) ) { $_POST['name'] = 'User Name'; } else { $_POST['name'] = $_POST['fname'].' '.$_POST['lname']; }
    if ( empty( $_POST['author'] ) ) { $_POST['author'] = '1'; }
    if ( empty( $_POST['author_name'] ) ) { $_POST['author_name'] = 'Undefined'; }
    if ( empty( $_POST['categories'] ) ) { $_POST['categories'] = "Uncategorized"; }
    if ( empty( $_POST['company'] ) ) { $_POST['company'] = "Jabali"; }
    if ( empty( $_POST['created_d'] ) ) { $_POST['created_d'] = date( "Y-m-d" ); }
    if ( empty( $_POST['created_t'] ) ) { $_POST['created_t'] = date( "H:i:s" ); }
    if ( empty( $_POST['custom'] ) ) { $_POST['custom'] = "{}"; }
    if ( empty( $_POST['details'] ) ) { $_POST['details'] = "User bio"; }
    if ( empty( $_POST['email'] ) ) { $_POST['email'] = "user@jabali.co.ke"; }
    if ( empty( $_POST['excerpt'] ) ) { $_POST['excerpt'] = substr( $_POST['details'], 250 ); }
    if ( empty( $_POST['gender'] ) ) { $_POST['gender'] = "transgender"; }
    if ( empty( $_POST['level'] ) ) { $_POST['level'] = "public"; }
    if ( empty( $_POST['location'] ) ) { $_POST['location'] = "nairobi"; }
    if ( empty( $_POST['phone'] ) ) { $_POST['phone'] = "+254204404993"; }
    if ( empty( $_POST['social'] ) ) { $_POST['social'] = '{"facebook":"https://www.facebook.com/","twitter":"https://twitter.com/","instagram":"https://instagram.com/","github":"https://github.com/"}'; }
    if ( empty( $_POST['style'] ) ) { $_POST['style'] = "zahra"; }
    if ( empty( $_POST['state'] ) ) { $_POST['state'] = "active"; } 
    if ( empty( $_POST['ilk'] ) ) { $_POST['ilk'] = "subscriber"; } 
    if ( empty( $_POST['password'] ) ) { $_POST['password'] = md5($_POST['name'].date("Y-m-d H:i:s")); } 
    if ( empty( $_POST['updated'] ) ) { $_POST['updated'] = date('Y-m-d H:i:s'); }

    if ( !empty( $_FILES['new_avatar'] ) ) {
      $upload = _ABSUP_.date('Y/m/d/').basename( $_FILES['new_avatar']['name'] );
      if ( file_exists( $upload) ) {
        $avatar = _UPLOADS.date('Y/m/d/').basename( $_FILES['new_avatar']['name'] )."_".date('H_m_s');
      } else {
        $avatar = _UPLOADS.date('Y/m/d/').basename( $_FILES['new_avatar']['name'] );
      }

      move_uploaded_file( $_FILES['new_avatar']["tmp_name"], $upload );
    } else {
      $avatar = $_POST['the_avatar'];
    }

    $GLOBALS['USERS'] -> authkey = $_POST['authkey'];
    $GLOBALS['USERS'] -> name = $_POST['name']; 
    $GLOBALS['USERS'] -> author = $_POST['author'];
    $GLOBALS['USERS'] -> author_name = $_POST['author_name'];
    $GLOBALS['USERS'] -> avatar = $avatar;
    $GLOBALS['USERS'] -> categories = $_POST['categories'];
    $created = $_POST['created_d'];
    $created_t = $_POST['created_t'];
    $GLOBALS['USERS'] -> created = $created.' '.$created_t;
    $GLOBALS['USERS'] -> company = $_POST['company'];
    $GLOBALS['USERS'] -> custom = $_POST['custom'];
    $GLOBALS['USERS'] -> details = $_POST['details'];
    $GLOBALS['USERS'] -> email = $_POST['email'];
    $GLOBALS['USERS'] -> excerpt = $_POST['excerpt'];
    $GLOBALS['USERS'] -> gender = strtolower( $_POST['gender'] );
    $GLOBALS['USERS'] -> level = $_POST['level'];
    $link = preg_replace('/\s+/', '', $_POST['name'] );
    $GLOBALS['USERS'] -> username = strtolower( $link );
    $GLOBALS['USERS'] -> link = _ROOT . '/users/' . $GLOBALS['USERS'] -> username ;
    $GLOBALS['USERS'] -> location = $_POST['location'];
    $GLOBALS['USERS'] -> phone = $_POST['phone'];  
    $GLOBALS['USERS'] -> state = $_POST['state'];
    $GLOBALS['USERS'] -> social = $_POST['social'];
    $GLOBALS['USERS'] -> style = $_POST['style'];  
    $GLOBALS['USERS'] -> ilk = strtolower( $_POST['ilk'] );
    $GLOBALS['USERS'] -> updated = $_POST['updated'];
    $GLOBALS['USERS'] -> password = $_POST['password'];
    $create = $GLOBALS['USERS'] -> create();
    if ( isset( $create['error'] ) ) {
      _shout_( "Status: ".$create['status']."<br>Error: ".$create['error'], "error" );
    } else {
      _shout_( "Status: ".$create['status'] );
      header( "Location: ?edit=".$GLOBALS['JBLDB'] -> insertId() ."&key=".$_POST['ilk']);
      exit();
    }
}

if ( isset( $_POST['update'] ) ) {

    if ( empty( $_POST['authkey'] ) ) { $_POST['authkey'] = str_shuffle( generateCode() ); }
    if ( empty( $_POST['fname'] ) ) { $_POST['name'] = 'User Name'; } else { $_POST['name'] = $_POST['fname'].' '.$_POST['lname']; }
    if ( empty( $_POST['author'] ) ) { $_POST['author'] = '1'; }
    if ( empty( $_POST['author_name'] ) ) { $_POST['author_name'] = 'Undefined'; }
    if ( empty( $_POST['categories'] ) ) { $_POST['categories'] = "Uncategorized"; }
    if ( empty( $_POST['company'] ) ) { $_POST['company'] = "Jabali"; }
    if ( empty( $_POST['created_d'] ) ) { $_POST['created_d'] = date( "Y-m-d" ); }
    if ( empty( $_POST['created_t'] ) ) { $_POST['created_t'] = date( "H:i:s" ); }
    if ( empty( $_POST['custom'] ) ) { $_POST['custom'] = "{}"; }
    if ( empty( $_POST['details'] ) ) { $_POST['details'] = "User bio"; }
    if ( empty( $_POST['email'] ) ) { $_POST['email'] = "user@jabali.co.ke"; }
    if ( empty( $_POST['excerpt'] ) ) { $_POST['excerpt'] = substr( $_POST['details'], 250 ); }
    if ( empty( $_POST['gender'] ) ) { $_POST['gender'] = "transgender"; }
    if ( empty( $_POST['level'] ) ) { $_POST['level'] = "public"; }
    if ( empty( $_POST['location'] ) ) { $_POST['location'] = "nairobi"; }
    if ( empty( $_POST['phone'] ) ) { $_POST['phone'] = "+254204404993"; }
    if ( empty( $_POST['social'] ) ) { $_POST['social'] = '{"facebook":"https://www.facebook.com/","twitter":"https://twitter.com/","instagram":"https://instagram.com/","github":"https://github.com/"}'; } else { $_POST['social'] = json_encode( $_POST['social']); }
    if ( empty( $_POST['style'] ) ) { $_POST['style'] = "zahra"; }
    if ( empty( $_POST['state'] ) ) { $_POST['state'] = "active"; } 
    if ( empty( $_POST['ilk'] ) ) { $_POST['ilk'] = "subscriber"; } 
    if ( empty( $_POST['password'] ) ) { $_POST['password'] = md5($_POST['name'].date("Y-m-d H:i:s")); } 
    if ( empty( $_POST['updated'] ) ) { $_POST['updated'] = date('Y-m-d H:i:s'); }

    if ( !empty( $_FILES['new_avatar'] ) ) {
      $upload = _ABSUP_.date('Y/m/d/').basename( $_FILES['new_avatar']['name'] );
      if ( file_exists( $upload) ) {
        $avatar = _UPLOADS.date('Y/m/d/').basename( $_FILES['new_avatar']['name'] )."_".date('H_m_s');
      } else {
        $avatar = _UPLOADS.date('Y/m/d/').basename( $_FILES['new_avatar']['name'] );
      }

      move_uploaded_file( $_FILES['new_avatar']["tmp_name"], $upload );
    } else {
      $avatar = $_POST['the_avatar'];
    }

    $GLOBALS['USERS'] -> authkey = $_POST['authkey'];
    $GLOBALS['USERS'] -> name = $_POST['name']; 
    $GLOBALS['USERS'] -> author = $_POST['author'];
    $GLOBALS['USERS'] -> author_name = $_POST['author_name'];
    $GLOBALS['USERS'] -> avatar = $avatar;
    $GLOBALS['USERS'] -> categories = $_POST['categories'];
    $created = $_POST['created_d'];
    $created_t = $_POST['created_t'];
    $GLOBALS['USERS'] -> created = $created.' '.$created_t;
    $GLOBALS['USERS'] -> company = $_POST['company'];
    $GLOBALS['USERS'] -> custom = $_POST['custom'];
    $GLOBALS['USERS'] -> details = $_POST['details'];
    $GLOBALS['USERS'] -> email = $_POST['email'];
    $GLOBALS['USERS'] -> id = $_POST['id'];
    $GLOBALS['USERS'] -> excerpt = $_POST['excerpt'];
    $GLOBALS['USERS'] -> gender = strtolower( $_POST['gender'] );
    $GLOBALS['USERS'] -> level = $_POST['level'];
    $GLOBALS['USERS'] -> username = $_POST['username'];
    $GLOBALS['USERS'] -> link = _ROOT . '/users/' . $GLOBALS['USERS'] -> username ;
    $GLOBALS['USERS'] -> location = $_POST['location'];
    $GLOBALS['USERS'] -> phone = $_POST['phone'];  
    $GLOBALS['USERS'] -> state = $_POST['state'];
    $GLOBALS['USERS'] -> social = $_POST['social'];
    $GLOBALS['USERS'] -> style = $_POST['style'];  
    $GLOBALS['USERS'] -> ilk = strtolower( $_POST['ilk'] );
    $GLOBALS['USERS'] -> updated = $_POST['updated'];
    $GLOBALS['USERS'] -> password = $_POST['password'];
    $update = $GLOBALS['USERS'] -> update();
    if ( isset( $update['error'] ) ) {
      _shout_( "Status: ".$update['status']."<br>Error: ".$update['error'], "error" );
    } else {
      _shout_( "Status: ".$update['status'], "success" );
    }
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