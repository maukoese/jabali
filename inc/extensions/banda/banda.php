<?php 
include hABSX.'banda/functions.php';
if ( !isShop() ) {
  call_user_func( 'setupShop' );
}

include hABSX.'banda/cart.php';
include hABSX.'banda/options.php';
if ( isset( $_POST['mpesa'] ) ) {

    $options = array( 'merchant', 'callback', 'paybill', 'timestamp', 'sag');
    foreach ( $options as $option ) {
      $date = date( 'Y-m-d H:i:s' );
      $hOption = new _hOptions();
      $hOption -> update( $option, $_POST[ $option ], $date );
    }
}

include hABSX.'banda/class.products.php';
$hProduct = new _hProducts();

include hABSX.'banda/class.orders.php';
$hOrder = new _hOrders();

include hABSX.'banda/class.payments.php';
include hABSX.'banda/payments/autoload.php';
$hPayment = new _hPayments();

if ( isset( $_POST['pay'] ) && $_POST['amount'] !== "" && $_POST['h_phone'] !== "" ) {
    $AMOUNT = $_POST['amount'];
    $NUMBER = $_POST['h_phone']; //format 254700000000
    $PRODUCT_ID = $_GET['order'];
    //init MPESA class
    $mpesa = new MPESA(ENDPOINT, CALLBACK_URL, CALL_BACK_METHOD, PAYBILL_NO, TIMESTAMP, PASSWORD, $GLOBALS['conn'] );
    $mpesa->setProductID( $PRODUCT_ID );
    $mpesa->setAmount( $AMOUNT );
    $mpesa->setNumber( $NUMBER ); // replaces 0 with 254
    $mpesa->init();
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

  if ( move_uploaded_file( $_FILES['h_avatar']["tmp_name"], $upload) ) {
      //Do nothing
  } else {}
  $h_avatar = hUPLOADS.date('Y' ).'/'.date('m' ).'/'.date('d' ).'/'. $_FILES['h_avatar']['name'];
}

$h_by = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_by'] );
$h_category = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_category'] ); 
$h_organization = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_organization'] );
if ( isset( $_POST['create'] ) ) {
  $h_key = str_shuffle( md5(date('l jS \of F Y h:i:s A').rand(10,1000) ) );
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

if ( isset( $_POST['product'] ) ) {
  $hProduct -> createp($h_code, $h_price );
  $hProduct -> create( $h_alias, $h_author, $h_avatar, $h_by, $h_category, $h_organization, $h_code, $h_created, $h_desc, $h_email, $h_fav, $h_key, $h_level, $h_link, $h_location, $h_notes, $h_phone, $h_reading, $h_status, $h_subtitle, $h_tags, $h_type, $h_updated );
}

if ( isset( $_POST['productupd'] ) ) {
  $hProduct -> createp($h_code, $h_price );
  $hProduct -> update( $h_alias, $h_author, $h_avatar, $h_by, $h_category, $h_organization, $h_code, $h_created, $h_desc, $h_email, $h_fav, $h_key, $h_level, $h_link, $h_location, $h_notes, $h_phone, $h_reading, $h_status, $h_subtitle, $h_tags, $h_type, $h_updated );
}

}

if ( isset( $_GET['product'] ) ) { 
  if ( $_GET['product'] == "all" ) {
    $hProduct -> getProducts();
    if ( isCap( 'admin' ) ) {
      newButton('index', 'product&x=banda', 'create' );
    } else {
      show_cart();
    }
  } elseif ( $_GET['product'] == "drafts" ) {
    $hProduct -> getDrafts();
  } else {
    $hProduct -> getProduct( $_GET['product'] );
    if ( isCap( 'admin' ) ) {
      newButton('index', 'product&x=banda', 'create' );
    } else {
      show_cart();
    }
  }
}

$hForm = new _hForms();

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
  } elseif ( $_GET['order'] == "new" ) {
    $hOrder -> create();
  } elseif ( $_GET['order'] == "drafts" ) {
    $hProduct -> getDrafts();
  } else {
    $hProduct -> getProduct( $_GET['order'] );
  }
}

if ( isset( $_GET['payment'] ) ) { 
  if ( $_GET['payment'] == "all" ) {
    $hOrder -> create();
  } elseif ( $_GET['payment'] == "drafts" ) {
    $hProduct -> getDrafts();
  } elseif ( $_GET['payment'] == "new" ) {
    $hPayment -> transactPay();
  } else {
    $hProduct -> getProduct( $_GET['payment'] );
  }
}

if ( isset( $_GET["order"] ) ) {
   
} ?>