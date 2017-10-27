<?php 
include _ABSX_.'banda/functions.php';
if ( !isShop() ) {
  call_user_func( 'setupShop' );
}

include _ABSX_.'banda/cart.php';
include _ABSX_.'banda/options.php';
if ( isset( $_POST['mpesa'] ) ) {

    $options = array( 'merchant', 'callback', 'paybill', 'timestamp', 'sag');
    foreach ( $options as $option ) {
      $date = date( 'Y-m-d H:i:s' );
      $hOption = new Jabali\_hOptions();
      $hOption -> update( $option, $_POST[ $option ], $date );
    }
}

include _ABSX_.'banda/class.products.php';
$hProduct = new _hProducts();

include _ABSX_.'banda/class.orders.php';
$hOrder = new _hOrders();

include _ABSX_.'banda/class.payments.php';
include _ABSX_.'banda/payments/autoload.php';
$hPayment = new _hPayments();

if ( isset( $_POST['pay'] ) && $_POST['amount'] !== "" && $_POST['phone'] !== "" ) {
    $AMOUNT = $_POST['amount'];
    $NUMBER = $_POST['phone']; //format 254700000000
    $PRODUCT_ID = $_GET['order'];
    //init MPESA class
    $mpesa = new MPESA(ENDPOINT, CALLBACK_URL, CALL_BACK_METHOD, PAYBILL_NO, TIMESTAMP, PASSWORD, $GLOBALS['JBLDB'] );
    $mpesa->setProductID( $PRODUCT_ID );
    $mpesa->setAmount( $AMOUNT );
    $mpesa->setNumber( $NUMBER ); // replaces 0 with 254
    $mpesa->init();
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

  if ( move_uploaded_file( $_FILES['avatar']["tmp_name"], $upload) ) {
      //Do nothing
  } else {}
  $avatar = _UPLOADS.date('Y' ).'/'.date('m' ).'/'.date('d' ).'/'. $_FILES['avatar']['name'];
}

$by = $GLOBALS['JBLDB'] -> clean( $_POST['by'] );
$category = $GLOBALS['JBLDB'] -> clean( $_POST['category'] ); 
$company = $GLOBALS['JBLDB'] -> clean( $_POST['company'] );
if ( isset( $_POST['create'] ) ) {
  $authkey = str_shuffle( md5(date('l jS \of F Y h:i:s A').rand(10,1000) ) );
  $id = substr( $authkey, rand(0, 15), 12 );
} elseif ( isset( $_POST['update'] ) ) {
  $authkey = $GLOBALS['JBLDB'] -> clean( $_POST['authkey'] );
  $id = $GLOBALS['JBLDB'] -> clean( $_POST['id'] );
}
$created = $_POST['created'];
$h_desc = $GLOBALS['JBLDB'] -> clean( $_POST['h_desc'] ); 
$email  = $GLOBALS['JBLDB'] -> clean( $_POST['email'] ); 
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

if ( isset( $_POST['product'] ) ) {
  $hProduct -> createp($id, $h_price );
  $hProduct -> create( $name, $author, $avatar, $by, $category, $company, $id, $created, $h_desc, $email , $h_fav, $authkey, $level, $link, $location, $excerpt, $phone, $readings, $state, $subtitle, $tags, $ilk, $updated );
}

if ( isset( $_POST['productupd'] ) ) {
  $hProduct -> createp($id, $h_price );
  $hProduct -> update( $name, $author, $avatar, $by, $category, $company, $id, $created, $h_desc, $email , $h_fav, $authkey, $level, $link, $location, $excerpt, $phone, $readings, $state, $subtitle, $tags, $ilk, $updated );
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