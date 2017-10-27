<?php

function isShop() {
  if ( getOption( 'shop') ) {
    return true;
  } else {
    return false;
  }
}

function setupShop() {
$hproducts = $GLOBALS['JBLDB'] -> query( "CREATE TABLE IF NOT EXISTS banda_products (
id VARCHAR(16), 
h_price VARCHAR(50),
PRIMARY KEY(id)
)" );

$horders = $GLOBALS['JBLDB'] -> query( "CREATE TABLE IF NOT EXISTS banda_orders(
name VARCHAR(300),
amount VARCHAR(20),
author VARCHAR(20),
by VARCHAR(100),
id VARCHAR(16),
created DATE,
details TEXT,
email  VARCHAR(50),
authkey VARCHAR(100),
location VARCHAR(100),
excerpt TEXT,
phone VARCHAR(100),
state VARCHAR(20),
updated DATE,
PRIMARY KEY(id)
)" );

$hpayments = $GLOBALS['JBLDB'] -> query( "CREATE TABLE IF NOT EXISTS banda_payments(
name VARCHAR(300),
amount VARCHAR(20),
author VARCHAR(20),
by VARCHAR(100),
id VARCHAR(16),
created DATE,
details TEXT,
email  VARCHAR(50),
for VARCHAR(20),
authkey VARCHAR(100),
excerpt TEXT,
phone VARCHAR(100),
state VARCHAR(20),
h_trx_code VARCHAR(50),
updated DATE,
PRIMARY KEY(id)
)" );

if ( $hproducts && $horders && $hpayments) {
  $hOpt = new Jabali\_hOptions();
  $hMenu = new Jabali\Classes\Menus();

  /*
  *
  */
  $hOpt -> create ( 'Install Shop', 'shop', 'yes', $created );

  $hOpt -> create ( 'Merchant Name', 'merchant', 'Jabali', $created );
  $hOpt -> create ( 'Callback URL', 'callback', _ROOT."callback.php", $created );
  $hOpt -> create ( 'Paybill Number', 'paybill', '898998', $created );
  $hOpt -> create ( 'Timestamp', 'timestamp', '20160510161908', $created );
  $hOpt -> create ( 'SAG Password', 'sag', 'ZmRmZDYwYzIzZDQxZDc5ODYwMTIzYjUxNzNkZDMwMDRjNGRkZTY2ZDQ3ZTI0YjVjODc4ZTExNTNjMDA1YTcwNw==', $created  );

  /*
  *
  */
  $hMenu -> create ( 'Shop', 'banda', 'shopping_cart', 'products', '', '#', 'drawer', 'visible', 'drop' );
  //Product SubMenus
  $hMenu -> create ( 'All Products', 'banda', 'description', 'allproducts', 'products', './index?x=banda&product=all&key=all products', 'drawer', 'visible', 'null' );
  $hMenu -> create ( 'Draft Products', 'banda', 'insert_drive_file', 'draftproducts', 'products', './index?x=banda&product=drafts&key=draft products', 'drawer', 'visible', 'null' );
  $hMenu -> create ( 'Shop Settings', 'banda', 'tune', 'shopsettings', 'products', './index?x=banda&settings=shop', 'drawer', 'visible', 'null' );

  /*
  *
  */
  $hMenu -> create ( 'Orders', 'banda', 'receipt', 'orders', '', '#', 'drawer', 'visible', 'drop' );
  //Product SubMenus
  $hMenu -> create ( 'Complete Orders', 'banda', 'description', 'completeorders', 'orders', './index?x=banda&orders=all', 'drawer', 'visible', 'null' );
  $hMenu -> create ( 'Processing Orders', 'banda', 'insert_drive_file', 'processingorders', 'orders', './index?x=banda&orders=processing', 'drawer', 'visible', 'null' );
  $hMenu -> create ( 'Customers', 'banda', 'tune', 'customers', 'users', './users?view=list&type=customer', 'drawer', 'visible', 'null' );
  $hMenu -> create ( 'Sellers', 'banda', 'tune', 'sellers', 'users', './users?view=list&type=seller', 'drawer', 'visible', 'null' );

  /*
  *
  */
  $hMenu -> create ( 'Payments', 'banda', 'monetization_on', 'payments', '', '#', 'drawer', 'visible', 'drop' );
  //Product SubMenus
  $hMenu -> create ( 'All Payments', 'banda', 'description', 'allpayments', 'payments', './index?x=banda&payments=all', 'drawer', 'visible', 'null' );
  $hMenu -> create ( 'Pending Payments', 'banda', 'insert_drive_file', 'pendingpayments', 'payments', './index?x=banda&payments=pending', 'drawer', 'visible', 'null' );
  $hMenu -> create ( 'Shop Summary', 'banda', 'tune', 'shopsummary', 'payments', './index?x=banda&payments=summary', 'drawer', 'visible', 'null' );
}
}

function show_cart() { ?>

  <a href="?x=banda&order=new" class="cartfab mdl-button mdl-button--fab notification mdl-color--<?php primaryColor(); ?>" id="cartbtn" >
  <i class="material-icons mdl-badge mdl-badge--overlap" data-badge="<?php echo count( $_SESSION["cart_item"] ); ?>">shopping_cart</i>
  </a><div class="mdl-tooltip" for="cartbtn">My Cart</div>
<?php 
}