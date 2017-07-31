<?php

include hABSX.'zahra/class.poems.php';
$hPoem = new _hPoems();
$hPost = new _hPosts();

if ( isset( $_GET['poem'] ) ) { 
  if ( $_GET['poem'] == "list" ) {
    $hPoem -> getPoems();
  } elseif ( $_GET['poem'] == "drafts" ) {
    $hPoem -> getDrafts();
  } else {
    $hPoem -> getPoem( $_GET['poem'] );
  }
}

if ( isset( $_GET['page_id'] ) ) { 
  if ( $_GET['page'] == "drafts" ) {
    $hPoem -> getDrafts();
  } else {
    $hPoem -> getPage( $_GET['page_id'] );
  }
}
if ( isset( $_GET['create'] ) ) { 
  $hForm -> postForm();
  $hPoem -> poemFields();
}

if ( isset( $_GET['edit'] ) ) { 
  $hForm -> editPostForm( $_GET['edit'] );
  $hPoem -> poemFields();
}

if ( isset( $_POST['h_alias'] ) || isset( $_POST['h_author'] ) || isset( $_POST['h_avatar'] ) || isset( $_POST['h_by'] ) || isset( $_POST['h_category'] ) || isset( $_POST['h_organization'] ) || isset( $_POST['h_code'] ) || isset( $_POST['h_created'] ) || isset( $_POST['h_desc'] ) || isset( $_POST['h_email'] ) || isset( $_POST['h_fav'] ) || isset( $_POST['h_key'] ) || isset( $_POST['h_level'] ) || isset( $_POST['h_link'] ) || isset( $_POST['h_location'] ) || isset( $_POST['h_notes'] ) || isset( $_POST['h_phone'] ) || isset( $_POST['h_reading'] ) || isset( $_POST['h_status'] ) || isset( $_POST['h_subtitle'] ) || isset( $_POST['h_tags'] ) || isset( $_POST['h_type'] ) || isset( $_POST['h_updated'] ) ) {

  $h_alias = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_alias'] ); 
  $h_author = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_author'] );

  if ( $_FILES['h_avatar'] == "" ) {
    $h_avatar = hIMAGES.'placeholder.svg';
  } else {
    $uploads = hABSUP .date('Y' ).'/'.date('m' ).'/'.date('d' ).'/';
    $upload = $uploads . basename( $_FILES['h_avatar']['name'] );

    if ( file_exists( $upload) ) {
      echo "Sorry, file already exists.";
      $uploadOk = 0;
    }

    if ( move_uploaded_file( $_FILES['h_avatar']["tmp_name"], $upload) ) {} else {}
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
?>