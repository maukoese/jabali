<?php 
function setupSGR() {
  $hcoaches = $GLOBALS['JBLDB'] -> query( "CREATE TABLE IF NOT EXISTS ". _DBPREFIX ."coaches (
  id VARCHAR(16), 
  h_price VARCHAR(10),
  ilk VARCHAR(10),
  PRIMARY KEY(id)
  )" );

  $horders = $GLOBALS['JBLDB'] -> query( "CREATE TABLE IF NOT EXISTS ". _DBPREFIX ."orders(
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

  $hpayments = $GLOBALS['JBLDB'] -> query( "CREATE TABLE IF NOT EXISTS ". _DBPREFIX ."payments(
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

    $GLOBALS['JBLDB'] -> query( "INSERT INTO ". _DBPREFIX ."options(name, id, details, updated) VALUES ('Merchant Name', 'merchant', 'Jabali', '".$created."' )" );
    $GLOBALS['JBLDB'] -> query( "INSERT INTO ". _DBPREFIX ."options(name, id, details, updated) VALUES ('Callback URL', 'callback', '"._ROOT."callback', '".$created."' )" );
    $GLOBALS['JBLDB'] -> query( "INSERT INTO ". _DBPREFIX ."options(name, id, details, updated) VALUES ('Paybill Number', 'paybill', '898998', '".$created."' )" );
    $GLOBALS['JBLDB'] -> query( "INSERT INTO ". _DBPREFIX ."options(name, id, details, updated) VALUES ('Timestamp', 'timestamp', '20160510161908', '".$created."' )" );
    $GLOBALS['JBLDB'] -> query( "INSERT INTO ". _DBPREFIX ."options(name, id, details, updated) VALUES ('SAG Password', 'sag', 'ZmRmZDYwYzIzZDQxZDc5ODYwMTIzYjUxNzNkZDMwMDRjNGRkZTY2ZDQ3ZTI0YjVjODc4ZTExNTNjMDA1YTcwNw==', '".$created."' )" );
  }
}

function show_tcart() { ?>

  <span class="cartfab mdl-button mdl-button--fab mdl-color--<?php primaryColor(); ?>" id="cartbtn"  >
  <i class="material-icons mdl-badge mdl-badge--overlap" data-badge="<?php echo count( $_SESSION["cart_item"] ); ?>">shopping_cart</i>
  </span><div class="mdl-tooltip" for="cartbtn">My Cart</div>

  <div class="mdl-menu mdl-js-menu mdl-js-ripple-effect mdl-menu--top-right mdl-card mdl-color--<?php primaryColor(); ?>" for="cartbtn" style="width: 250px;bottom: 521.813px;>
    <div class="mdl-card__title"><?php 
    if ( !empty( $_SESSION["cart_item"] ) ) { ?>
      <a class="mdl-button mdl-js-button mdl-js-ripple-effect" href="./shop?order=<?php echo substr(md5( $_SESSION[JBLSALT.'Email'].date(Ymd)), 0, 12 ); ?>">checkout now<i class="material-icons">forward</i></a>
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

$hCoach = new Modules\Sgr\Coaches();

// if ( isset( $_GET['delete'] ) ) {
//   $GLOBALS['JBLDB'] -> query( "DELETE FROM hcoaches WHERE id='".$_GET['delete']."'" );
//   $hCoach -> getCoaches();
// }

// if ( isset( $_GET['screate'] ) ) {
//   $hForm -> coachForm();
// }

// if ( isset( $_GET['sedit'] ) ) {
//   $hForm -> editCoachForm( $_GET['edit'] );
// }

// if ( isset( $_GET['sfav'] ) ) {
//   $getRate = $GLOBALS['JBLDB'] -> query( "INSERT INTO hratings (author, for, ilk ) 
//     VALUES ('".$_SESSION[JBLSALT.'Code']."', '".$_GET['fav']."', 'coach' )" );
// }

// if ( isset( $_GET['sauthor'] ) ) {
//   $hCoach-> getCoachesAuthor( $_GET['author'] );
//   if ( isCap( 'admin' ) ) {
//     newButton('coach', 'coach', 'create' );
//   }
// }

// if ( isset( $_GET['sview'] )){
//   if ( $_GET['sview'] == "list" ) {
//     if ( isset( $_GET['type'] ) ) {
//       $hCoach -> getCoachesType( $_GET['type'] );
//       if ( isCap( 'admin' ) || isCap( 'center' ) ) {
//         newButton('coach', $_GET['type'], 'create' );
//       }
//     } elseif ( isset( $_GET['location'] ) ) {
//       $hCoach -> getCoachesLoc( $_GET['location'] );
//       if ( isCap( 'admin' ) || isCap( 'center' ) ) {
//         newButton('coach', $_GET['location'], 'create' );
//       }
//     } else {
//       $hCoach -> getCoaches();
//       if ( isCap( 'admin' ) || isCap( 'center' ) ) {
//         newButton('coach', 'center', 'create' );
//       }
//     }
//   } else {
//     $hCoach -> getCoach( $_GET['view'] );
//   }

// }

// if ( isset( $_GET['sclass'] )){
//   $hCoach -> getCoachesClass( $_GET['class'] );
//   show_cart();
// }

// if ( isset( $_POST['supdate'] ) ) {
//   $hCoach -> updateCoach( $_POST['id'] );
// }

// if ( isset( $_POST['sregister'] ) ) {
//   $hCoach -> createCoach();
// }