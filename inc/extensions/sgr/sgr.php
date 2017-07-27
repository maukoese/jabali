<?php 
function setupSGR() {
  $hcoaches = mysqli_query( $GLOBALS['conn'], "CREATE TABLE IF NOT EXISTS ". hDBPREFIX ."coaches (
  h_code VARCHAR(16), 
  h_price VARCHAR(10),
  h_type VARCHAR(10),
  PRIMARY KEY(h_code)
  )" );

  $horders = mysqli_query( $GLOBALS['conn'], "CREATE TABLE IF NOT EXISTS ". hDBPREFIX ."orders(
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

  $hpayments = mysqli_query( $GLOBALS['conn'], "CREATE TABLE IF NOT EXISTS ". hDBPREFIX ."payments(
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

    mysqli_query( $GLOBALS['conn'], "INSERT INTO ". hDBPREFIX ."options(h_alias, h_code, h_description, h_updated) VALUES ('Merchant Name', 'merchant', 'Jabali', '".$created."' )" );
    mysqli_query( $GLOBALS['conn'], "INSERT INTO ". hDBPREFIX ."options(h_alias, h_code, h_description, h_updated) VALUES ('Callback URL', 'callback', '".hROOT."callback', '".$created."' )" );
    mysqli_query( $GLOBALS['conn'], "INSERT INTO ". hDBPREFIX ."options(h_alias, h_code, h_description, h_updated) VALUES ('Paybill Number', 'paybill', '898998', '".$created."' )" );
    mysqli_query( $GLOBALS['conn'], "INSERT INTO ". hDBPREFIX ."options(h_alias, h_code, h_description, h_updated) VALUES ('Timestamp', 'timestamp', '20160510161908', '".$created."' )" );
    mysqli_query( $GLOBALS['conn'], "INSERT INTO ". hDBPREFIX ."options(h_alias, h_code, h_description, h_updated) VALUES ('SAG Password', 'sag', 'ZmRmZDYwYzIzZDQxZDc5ODYwMTIzYjUxNzNkZDMwMDRjNGRkZTY2ZDQ3ZTI0YjVjODc4ZTExNTNjMDA1YTcwNw==', '".$created."' )" );
  }
}

function show_cart() { ?>

  <span class="cartfab mdl-button mdl-button--fab mdl-color--<?php primaryColor(); ?>" id="cartbtn"  >
  <i class="material-icons mdl-badge mdl-badge--overlap" data-badge="<?php echo count( $_SESSION["cart_item"] ); ?>">shopping_cart</i>
  </span><div class="mdl-tooltip" for="cartbtn">My Cart</div>

  <div class="mdl-menu mdl-js-menu mdl-js-ripple-effect mdl-menu--top-right mdl-card mdl-color--<?php primaryColor(); ?>" for="cartbtn" style="width: 250px;bottom: 521.813px;>
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

  include hABSX.'sgr/class.coaches.php';

$hCoach = new _hCoaches();

if ( isset( $_GET['delete'] ) ) {
  mysqli_query( $GLOBALS['conn'], "DELETE FROM hcoaches WHERE h_code='".$_GET['delete']."'" );
  $hCoach -> getCoaches();
}

if ( isset( $_GET['create'] ) ) {
  $hForm -> coachForm();
}

if ( isset( $_GET['edit'] ) ) {
  $hForm -> editCoachForm( $_GET['edit'] );
}

if ( isset( $_GET['fav'] ) ) {
  $getRate = mysqli_query( $GLOBALS['conn'], "INSERT INTO hratings (h_author, h_for, h_type ) 
    VALUES ('".$_SESSION['myCode']."', '".$_GET['fav']."', 'coach' )" );
}

if ( isset( $_GET['author'] ) ) {
  $hCoach-> getCoachesAuthor( $_GET['author'] );
  if ( isCap( 'admin' ) ) {
    newButton('coach', 'coach', 'create' );
  }
}

if ( isset( $_GET['view'] )){
  if ( $_GET['view'] == "list" ) {
    if ( isset( $_GET['type'] ) ) {
      $hCoach -> getCoachesType( $_GET['type'] );
      if ( isCap( 'admin' ) || isCap( 'center' ) ) {
        newButton('coach', $_GET['type'], 'create' );
      }
    } elseif ( isset( $_GET['location'] ) ) {
      $hCoach -> getCoachesLoc( $_GET['location'] );
      if ( isCap( 'admin' ) || isCap( 'center' ) ) {
        newButton('coach', $_GET['location'], 'create' );
      }
    } else {
      $hCoach -> getCoaches();
      if ( isCap( 'admin' ) || isCap( 'center' ) ) {
        newButton('coach', 'center', 'create' );
      }
    }
  } else {
    $hCoach -> getCoach( $_GET['view'] );
  }

}

if ( isset( $_GET['class'] )){
  $hCoach -> getCoachesClass( $_GET['class'] );
  show_cart();
}

if ( isset( $_POST['update'] ) ) {
  $hCoach -> updateCoach( $_POST['h_code'] );
}

if ( isset( $_POST['register'] ) ) {
  $hCoach -> createCoach();
}
?>