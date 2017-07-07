<?php 
include '../inc/config.php';
include '../inc/jabali.php';
include './header.php'; ?>

<div class="mdl-grid"><?php

if ( isset( $_GET['create'] ) ) {
	$hForm -> postForm();
}

if ( isset( $_GET['edit'] ) ) {
	$hForm -> editPostForm( $_GET['edit'] );
}

if ( isset( $_GET['delete'] ) ) {
  $hPost -> delete( $_GET['delete'] );
	$hPost -> getPosts( 'h_created' );
  if ( isCap( 'admin' ) ) {
    newButton('post', 'article', 'create' );
  }
}

if ( isset( $_GET['view'] )){
	if ( $_GET['view'] == "list" ) {
		if ( isset( $_GET['type'] ) ) {
			$hPost -> getPostsType( $_GET['type'] );
      if ( isCap( 'admin' ) ) {
        newButton('post', $_GET['type'], 'create' );
      }
		} else {
			$hPost -> getPosts( $_GET['sort'] );
      if ( isCap( 'admin' ) ) {
        newButton('post', 'article', 'create' );
      }
		}
	} elseif ( $_GET['view'] == "drafts" ) {
    $hPost -> getDrafts ();
  } else {
		$hPost -> getPost( $_GET['view'] );
	}

}

if ( isset( $_POST['create'] ) || isset( $_POST['update'] ) ) { 

  $h_alias = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_alias'] ); 
  $h_author = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_author'] );

  if ( $_FILES['h_avatar'] == "" ) {
    $h_avatar = hIMAGES.'placeholder.svg';
  } else {
    $uploads = hABSUP .date('Y' ).'/'.date('m' ).'/'.date('d' ).'/';

    if ( file_exists( $upload) ) {
      $upload = $uploads . basename( $_FILES['h_avatar']['name'] )."_".date('H_m_s');
    } else {
      $upload = $uploads . basename( $_FILES['h_avatar']['name'] );
    }

    if ( move_uploaded_file( $_FILES['h_avatar']["tmp_name"], $upload) ) {
        //Do nothing
    } else {}
    $h_avatar = hUPLOADS.date('Y' ).'/'.date('m' ).'/'.date('d' ).'/'. $_FILES['h_avatar']['name'];
  }

  $h_by = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_by'] );
  $h_category = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_category'] ); 
  $h_organization = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_organization'] );
  
  if ( isset( $_POST['create'] ) ) {
    $h_key = str_shuffle( generateCode() );
    $h_code = substr( $h_key, rand(0, 15), 12 );
  } elseif ( isset( $_POST['update'] ) ) {
    $h_key = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_key'] );
    $h_code = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_code'] );
  }

  $h_created = $_POST['h_created'];
  $h_created_t = $_POST['h_created_t'];
  $h_created = $h_created.' '.$h_created_t;
  $h_desc = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_desc'] ); 
  $h_email = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_email'] ); 
  $h_fav = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_fav'] ); 
  $h_level = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_level'] ); 
  $h_link = preg_replace('/\s+/', '_', $h_alias);
  $h_link = strtolower( $h_link );
  $h_location = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_location'] );
  if ( isset( $_POST['create'] ) ) {
    $h_notes = substr( $h_desc, 250 );
  } elseif ( isset( $_POST['update'] ) ) {
    $h_notes = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_notes'] );
  } 
  $h_phone = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_phone'] ); 
  $h_price = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_price'] );
  $h_reading = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_reading'] ); 
  $h_status = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_status'] );
  $h_subtitle = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_subtitle'] ); 
  $h_tags = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_tags'] ); 
  $h_type = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_type'] ); 
  $h_updated = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_updated'] );

  if ( isset( $_POST['create'] ) ) {
  	$hPost -> create( $h_alias, $h_author, $h_avatar, $h_by, $h_category, $h_organization, $h_code, $h_created, $h_desc, $h_email, $h_fav, $h_key, $h_level, $h_link, $h_location, $h_notes, $h_phone, $h_reading, $h_status, $h_subtitle, $h_tags, $h_type, $h_updated );
  } elseif ( isset( $_POST['update'] ) ) {
  	$hPost -> update( $h_alias, $h_author, $h_avatar, $h_by, $h_category, $h_organization, $h_code, $h_created, $h_desc, $h_email, $h_fav, $h_key, $h_level, $h_link, $h_location, $h_notes, $h_phone, $h_reading, $h_status, $h_subtitle, $h_tags, $h_type, $h_updated );
  } 

} ?>
</div><?php

include './footer.php'; ?>