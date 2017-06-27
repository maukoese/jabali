<?php 
include hABSX.'banda/functions.php';
if ( !isShop() ) {
  call_user_func( 'setupShop' );
}

include hABSX.'banda/cart.php';
include hABSX.'banda/options.php';
if ( isset( $_POST['mpesa'] ) ) {
    $date = date(Ymd );
    mysqli_query( $GLOBALS['conn'], "UPDATE hoptions SET h_description = '".$_POST['merchant']."', h_updated = '".$date."' WHERE h_code='merchant'" );
    mysqli_query( $GLOBALS['conn'], "UPDATE hoptions SET h_description = '".$_POST['callback']."', h_updated = '".$date."'  WHERE h_code='callback'" );
    mysqli_query( $GLOBALS['conn'], "UPDATE hoptions SET h_description = '".$_POST['paybill']."', h_updated = '".$date."'  WHERE h_code='paybill'" );
    mysqli_query( $GLOBALS['conn'], "UPDATE hoptions SET h_description = '".$_POST['timestamp']."', h_updated = '".$date."'  WHERE h_code='timestamp'" );
    mysqli_query( $GLOBALS['conn'], "UPDATE hoptions SET h_description = '".$_POST['sag']."', h_updated = '".$date."'  WHERE h_code='sag'" );
}

include hABSX.'banda/class.products.php';
$hProduct = new _hProducts();

$h_alias = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_alias'] ); 
$h_author = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_author'] );

if ( $_FILES['h_avatar'] == "" ) {
  $h_avatar = hIMAGES.'placeholder.svg';
} else {
  $uploads = hABSUP . "uploads/".date('Y' ).'/'.date('m' ).'/'.date('d' ).'/';
  $upload = $uploads . basename( $_FILES['h_avatar']['name'] );

  if ( file_exists( $upload) ) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
  }

  if ( move_uploaded_file( $_FILES['h_avatar']["tmp_name"], $upload) ) {
      //Do nothing
  } else {
      echo "Sorry, there was an error uploading your file.";
  }
  $h_avatar = $uploads.$_FILES['h_avatar']['name'];
}

$h_by = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_by'] );
$h_category = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_category'] ); 
$h_organization = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_organization'] );
$h_key = str_shuffle( generateCode() );
$h_code = substr( $h_key, rand(0, 15), 12 ); 
$h_created = $_POST['h_created'];
$h_desc = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_desc'] ); 
$h_email = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_email'] ); 
$h_fav = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_fav'] ); 
$h_level = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_level'] ); 
$h_link = hADMIN."post?view=".$h_code; 
$h_location = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_location'] );
$h_notes = substr( $h_desc, 250 ); 
$h_phone = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_phone'] ); 
$h_price = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_price'] );
$h_reading = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_reading'] ); 
$h_status = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_status'] );
$h_subtitle = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_subtitle'] ); 
$h_tags = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_tags'] ); 
$h_type = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_type'] ); 
$h_updated = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_updated'] );

if ( isset( $_POST['product'] ) ) {
  $hProduct -> createp($h_code, $h_price );
  $hProduct -> create( $h_alias, $h_author, $h_avatar, $h_by, $h_category, $h_organization, $h_code, $h_created, $h_desc, $h_email, $h_fav, $h_key, $h_level, $h_link, $h_location, $h_notes, $h_phone, $h_reading, $h_status, $h_subtitle, $h_tags, $h_type, $h_updated );
}

if ( isset( $_POST['productupd'] ) ) {
  $hProduct -> createp($h_code, $h_price );
  $hProduct -> update( $h_alias, $h_author, $h_avatar, $h_by, $h_category, $h_organization, $h_code, $h_created, $h_desc, $h_email, $h_fav, $h_key, $h_level, $h_link, $h_location, $h_notes, $h_phone, $h_reading, $h_status, $h_subtitle, $h_tags, $h_type, $h_updated );
}

if ( isset( $_GET['product'] ) ) { 
  if ( $_GET['product'] == "all" ) {
    $hProduct -> getProducts();
    if ( !isCap( 'admin' ) ) {
      newButton('do', 'product&x=banda', 'create' );
    } else {
      show_cart();
    }
  } elseif ( $_GET['product'] == "drafts" ) {
    $hProduct -> getDrafts();
  } else {
    $hProduct -> getProduct( $_GET['product'] );
    if ( !isCap( 'admin' ) ) {
      newButton('do', 'product&x=banda', 'create' );
    } else {
      show_cart();
    }
  }
}

if ( isset( $_GET['create'] ) ) { 
  if ( $_GET['create'] == "product" ) {
    $hForm -> postForm();
    $hProduct -> productFields ();
  } elseif ( $_GET['create'] == "drafts" ) {
    $hProduct -> getDrafts();
  } else {
    $hForm -> postForm();
    $hProduct -> productFields ();
  }
}

if ( isset( $_GET['edit'] ) ) { 
  if ( $_GET['edit'] == "product" ) {
    $hForm -> editPostForm( $_GET['edit'] );
    $hProduct -> productFields ();
  } elseif ( $_GET['edit'] == "order" ) {
    $hProduct -> getDrafts();
  } else {
    $hForm -> editPostForm( $_GET['edit'] );
    $hProduct -> productFields ();
  }
}

if ( isset( $_GET['order'] ) ) { 
  if ( $_GET['order'] == "all" ) {
    $hProduct -> getProducts();
  } elseif ( $_GET['order'] == "drafts" ) {
    $hProduct -> getDrafts();
  } else {
    $hProduct -> getProduct( $_GET['order'] );
  }
}

if ( isset( $_GET['payment'] ) ) { 
  if ( $_GET['payment'] == "all" ) {
    $hProduct -> getProducts();
  } elseif ( $_GET['payment'] == "drafts" ) {
    $hProduct -> getDrafts();
  } else {
    $hProduct -> getProduct( $_GET['payment'] );
  }
}

if ( $_GET["order"] ) {
   
} ?>