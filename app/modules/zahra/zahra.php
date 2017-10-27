<?php

include _ABSX_.'zahra/class.poems.php';
$hPoem = new \Poems();
$hPost = new Jabali\Classes\Posts();

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

if ( isset( $_POST['name'] ) || isset( $_POST['author'] ) || isset( $_POST['avatar'] ) || isset( $_POST['by'] ) || isset( $_POST['category'] ) || isset( $_POST['company'] ) || isset( $_POST['id'] ) || isset( $_POST['created'] ) || isset( $_POST['h_desc'] ) || isset( $_POST['email'] ) || isset( $_POST['h_fav'] ) || isset( $_POST['authkey'] ) || isset( $_POST['level'] ) || isset( $_POST['link'] ) || isset( $_POST['location'] ) || isset( $_POST['excerpt'] ) || isset( $_POST['phone'] ) || isset( $_POST['readings'] ) || isset( $_POST['state'] ) || isset( $_POST['subtitle'] ) || isset( $_POST['tags'] ) || isset( $_POST['ilk'] ) || isset( $_POST['updated'] ) ) {

  $name = $GLOBALS['JBLDB'] -> clean( $_POST['name'] ); 
  $author = $GLOBALS['JBLDB'] -> clean( $_POST['author'] );

  if ( $_FILES['avatar'] == "" ) {
    $avatar = _IMAGES.'placeholder.svg';
  } else {
    $uploads = _ABSUP_ .date('Y' ).'/'.date('m' ).'/'.date('d' ).'/';
    $upload = $uploads . basename( $_FILES['avatar']['name'] );

    if ( file_exists( $upload) ) {
      echo "Sorry, file already exists.";
      $uploadOk = 0;
    }

    if ( move_uploaded_file( $_FILES['avatar']["tmp_name"], $upload) ) {} else {}
    $avatar = _UPLOADS.date('Y' ).'/'.date('m' ).'/'.date('d' ).'/'. $_FILES['avatar']['name'];
  }

  $by = $GLOBALS['JBLDB'] -> clean( $_POST['by'] );
  $category = $GLOBALS['JBLDB'] -> clean( $_POST['category'] ); 
  $company = $GLOBALS['JBLDB'] -> clean( $_POST['company'] );
  if ( isset( $_POST['create'] ) ) {
    $authkey = str_shuffle( generateCode() );
    $id = substr( $authkey, rand(0, 15), 12 );
  } elseif ( isset( $_POST['update'] ) ) {
    $authkey = $GLOBALS['JBLDB'] -> clean( $_POST['authkey'] );
    $id = $GLOBALS['JBLDB'] -> clean( $_POST['id'] );
  }
  $created = $_POST['created'];
  $h_desc = $GLOBALS['JBLDB'] -> clean( $_POST['h_desc'] ); 
  $email= $GLOBALS['JBLDB'] -> clean( $_POST['email'] ); 
  $h_fav = $GLOBALS['JBLDB'] -> clean( $_POST['h_fav'] ); 
  $level = $GLOBALS['JBLDB'] -> clean( $_POST['level'] ); 
  $link = preg_replace('/\s+/', '_', $name);
  $link = strtolower( $link );
  $location = $GLOBALS['JBLDB'] -> clean( $_POST['location'] );
  if ( isset( $_POST['create'] ) ) {
    $excerpt = substr( $h_desc, 250 );
  } elseif ( isset( $_POST['update'] ) ) {
    $excerpt = $GLOBALS['JBLDB'] -> clean( $_POST['excerpt'] );
  } 
  $phone = $GLOBALS['JBLDB'] -> clean( $_POST['phone'] ); 
  $h_price = $GLOBALS['JBLDB'] -> clean( $_POST['h_price'] );
  $readings = $GLOBALS['JBLDB'] -> clean( $_POST['readings'] ); 
  $state = $GLOBALS['JBLDB'] -> clean( $_POST['state'] );
  $subtitle = $GLOBALS['JBLDB'] -> clean( $_POST['subtitle'] ); 
  $tags = $GLOBALS['JBLDB'] -> clean( $_POST['tags'] ); 
  $ilk = $GLOBALS['JBLDB'] -> clean( $_POST['ilk'] ); 
  $updated = $GLOBALS['JBLDB'] -> clean( $_POST['updated'] );

  if ( isset( $_POST['create'] ) ) {
    $hPost -> create( $name, $author, $avatar, $by, $category, $company, $id, $created, $h_desc, $email, $h_fav, $authkey, $level, $link, $location, $excerpt, $phone, $readings, $state, $subtitle, $tags, $ilk, $updated );
  } elseif ( isset( $_POST['update'] ) ) {
    $hPost -> update( $name, $author, $avatar, $by, $category, $company, $id, $created, $h_desc, $email, $h_fav, $authkey, $level, $link, $location, $excerpt, $phone, $readings, $state, $subtitle, $tags, $ilk, $updated );
  } 
} ?>
?>