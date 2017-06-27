<?php

function isShop() {
  if ( getOption( 'shop') ) {
    return true;
  } else {
    return false;
  }
}

function setupShop() {
$hproducts = mysqli_query( $GLOBALS['conn'], "CREATE TABLE IF NOT EXISTS hproducts (
h_code VARCHAR(16), 
h_price VARCHAR(50),
PRIMARY KEY(h_code)
)" );

$horders = mysqli_query( $GLOBALS['conn'], "CREATE TABLE IF NOT EXISTS horders(
h_alias VARCHAR(300),
h_amount VARCHAR(20),
h_author VARCHAR(20),
h_by VARCHAR(100),
h_code VARCHAR(16),
h_created DATE,
h_description TEXT,
h_email VARCHAR(50),
h_key VARCHAR(100),
h_location VARCHAR(100),
h_notes TEXT,
h_phone VARCHAR(100),
h_status VARCHAR(20),
h_updated DATE,
PRIMARY KEY(h_code)
)" );

$hpayments = mysqli_query( $GLOBALS['conn'], "CREATE TABLE IF NOT EXISTS hpayments(
h_alias VARCHAR(300),
h_amount VARCHAR(20),
h_author VARCHAR(20),
h_by VARCHAR(100),
h_code VARCHAR(16),
h_created DATE,
h_description TEXT,
h_email VARCHAR(50),
h_for VARCHAR(20),
h_key VARCHAR(100),
h_notes TEXT,
h_phone VARCHAR(100),
h_status VARCHAR(20),
h_trx_code VARCHAR(50),
h_updated DATE,
PRIMARY KEY(h_code)
)" );

if ( $hproducts && $horders && $hpayments) {
  $hOpt = new _hOptions();
  $hMenu = new _hMenus();

  /*
  *
  */
  $hOpt -> create ( 'Install Shop', 'shop', 'yes', $created );

  $hOpt -> create ( 'Merchant Name', 'merchant', 'Jabali', $created );
  $hOpt -> create ( 'Callback URL', 'callback', '".hROOT."callback', $created );
  $hOpt -> create ( 'Paybill Number', 'paybill', '898998', $created );
  $hOpt -> create ( 'Timestamp', 'timestamp', '20160510161908', $created );
  $hOpt -> create ( 'SAG Password', 'sag', 'ZmRmZDYwYzIzZDQxZDc5ODYwMTIzYjUxNzNkZDMwMDRjNGRkZTY2ZDQ3ZTI0YjVjODc4ZTExNTNjMDA1YTcwNw==', $created  );

  /*
  *
  */
  $hMenu -> create ( 'Shop', 'banda', 'shopping_cart', 'products', '', '#', 'drawer', 'visible', 'drop' );
  //Product SubMenus
  $hMenu -> create ( 'All Products', 'banda', 'description', 'allproducts', 'products', './do?x=banda&product=list', 'drawer', 'visible', 'null' );
  $hMenu -> create ( 'Draft Products', 'banda', 'insert_drive_file', 'draftproducts', 'products', './do?x=banda&product=drafts', 'drawer', 'visible', 'null' );
  $hMenu -> create ( 'Shop Settings', 'banda', 'tune', 'shopsettings', 'products', './do?x=banda&settings=shop', 'drawer', 'visible', 'null' );

  /*
  *
  */
  $hMenu -> create ( 'Orders', 'banda', 'shopping_cart', 'products', '', '#', 'drawer', 'visible', 'drop' );
  //Product SubMenus
  $hMenu -> create ( 'Complete Orders', 'banda', 'description', 'allproducts', 'products', './do?x=banda&product=list', 'drawer', 'visible', 'null' );
  $hMenu -> create ( 'Processing Orders', 'banda', 'insert_drive_file', 'draftproducts', 'products', './do?x=banda&product=drafts', 'drawer', 'visible', 'null' );
  $hMenu -> create ( 'Customers', 'banda', 'tune', 'shopsettings', 'products', './do?x=banda&settings=shop', 'drawer', 'visible', 'null' );

  /*
  *
  */
  $hMenu -> create ( 'Payments', 'banda', 'shopping_cart', 'products', '', '#', 'drawer', 'visible', 'drop' );
  //Product SubMenus
  $hMenu -> create ( 'All Payments', 'banda', 'description', 'allproducts', 'products', './do?x=banda&product=list', 'drawer', 'visible', 'null' );
  $hMenu -> create ( 'Pending Payments', 'banda', 'insert_drive_file', 'draftproducts', 'products', './do?x=banda&product=drafts', 'drawer', 'visible', 'null' );
  $hMenu -> create ( 'Shop Summary', 'banda', 'tune', 'shopsettings', 'products', './do?x=banda&settings=shop', 'drawer', 'visible', 'null' );
}
}

function show_cart() { ?>

  <span class="cartfab mdl-button mdl-button--fab notification mdl-color--<?php primaryColor(); ?>" id="cartbtn" >
  <i class="material-icons mdl-badge mdl-badge--overlap" data-badge="<?php echo count( $_SESSION["cart_item"] ); ?>">shopping_cart</i>
  </span><div class="mdl-tooltip" for="cartbtn">My Cart</div>

  <div class="mdl-menu mdl-js-menu mdl-js-ripple-effect mdl-menu--top-right option-drop mdl-card mdl-color--<?php primaryColor(); ?>" for="cartbtn" style="width: 250px">
    <div class="mdl-card__title"><?php 
    if ( !empty( $_SESSION["cart_item"] ) ) { ?>
      <a class="mdl-button mdl-js-button mdl-js-ripple-effect" href="./shop?order=<?php echo substr(md5( $_SESSION['myEmail'].date(Ymd)), 0, 12 ); ?>">checkout now<i class="material-icons">forward</i></a>
          <div class="mdl-layout-spacer"></div>
          <div class="mdl-card__subtitle-text">
              
          <a class="mdl-badge mdl-badge--overlap notification" id="btnEmpty" href="./shop?view=list&buy=empty">
              <i class="material-icons">remove_shopping_cart</i>
          </a>
          </div><?php 
      } else { echo "MY CART";} ?>
      </div>

      <div class="mdl-card__supporting-text">
              <?php 
    if ( isset( $_SESSION["cart_item"] )){
        $item_total = 0; ?>
    <table class="mdl-data-table mdl-js-data-table">
    <tbody> 
    <?php  
        foreach ( $_SESSION["cart_item"] as $item){
        ?>
            <tr><td style="text-align:left;" ><a href="./shop?view=list&buy=remove&code=<?php echo $item["code"]; ?>" class="material-icons">clear</a></td>
            <td style="text-align:left;" ><strong><?php echo $item["name"]; ?></strong></td>
            </tr>

            <?php 
            $item_total += ( $item["price"]*$item["quantity"] );
        }
        ?>
    </tbody>
    </table><?php 
    } else { echo "<center><br>Your Cart Is Empty</center>";}
    ?>
    <?php if ( !empty( $_SESSION["cart_item"] ) ) { ?>
    <center>
      <h5><b>TOTAL: </b> <?php echo "KSh ".$item_total; ?></h5>
    </center>
    <?php } ?>  
    </div>
  </div><?php 
}