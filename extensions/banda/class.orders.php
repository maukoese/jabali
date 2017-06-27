<?php 

class _hOrders {

  function create() {
    if ( isset( $_SESSION["cart_item"] )){
  $item_total = 0; ?>
    <div class="mdl-layout__content mdl-cell mdl-cell--6-col mdl-card mdl-color--<?php primaryColor(); ?>">
      <div class="mdl-card__title">
        <i class="material-icons">print</i>
        <span class="mdl-button">Order <?php _show_( $_GET['order'] ); ?></span>
      <div class="mdl-layout-spacer"></div>
      <div class="mdl-card__subtitle-text mdl-button">
        <a id="btnEmpty" href="./shop?view=list&buy=empty">
          <i class="material-icons">remove_shopping_cart</i>
          Cancel Order
        </a>
      </div>
      </div>
      <table class="mdl-data-table mdl-js-data-table mdl-color--<?php primaryColor(); ?>">
        <tbody>
          <tr>
            <th class="mdl-data-table__cell--non-numeric">ITEM</th>
            <th class="mdl-data-table__cell--non-numeric">QTY</th>
            <th class="mdl-data-table__cell--non-numeric">PRICE</th>
            <th class="mdl-data-table__cell--non-numeric">ACTION</th>
          </tr> 
        <?php     
        foreach ( $_SESSION["cart_item"] as $item){ ?>
          <tr>
            <td style="text-align:left;" ><strong><?php echo $item["name"]; ?></strong></td>
            <td style="text-align:left;" ><?php echo $item["quantity"]; ?></td>
            <td style="text-align:left;" ><?php echo "KSh ".$item["price"]; ?></td>
            <td style="text-align:left;" ><a href="./shop?order=<?php _show_( $_GET['order'] ); ?>&method=<?php _show_( $_GET['method'] ); ?>&pay=now&buy=remove&code=<?php echo $item["code"]; ?>" class="material-icons">clear</a></td>
          </tr><?php 
            $item_total += ( $item["price"]*$item["quantity"] );
        } ?>
        <tr>
          <td colspan="5" align=left >
            <h5><b>TOTAL: </b> <?php echo "KSh ".$item_total; ?></h5>
          </td>
        </tr>
        </tbody>
      </table>
    </div>

    <div class="mdl-layout__content mdl-cell mdl-cell--6-col mdl-card mdl-color--<?php primaryColor(); ?>">
      <div class="mdl-card__title">
      <i class="material-icons">perm_identity</i>
      <span class="mdl-button">Your Details</span>
      <div class="mdl-layout-spacer"></div>
      <div class="mdl-card__subtitle-text mdl-button">
      <i class="mdi mdi-truck-delivery mdi-24px"></i>
      <?php _show_( $_SESSION['myLocation'] ); ?>
      </div>
      </div>

      <form enctype="multipart/form-data" class="" name="payForm" method="POST" action=""><br>
        <div class="input-field inline">
        <i class="material-icons prefix">label</i>
        <input type="text" name="h_by" value="<?php _show_( $_SESSION['myAlias'] ); ?>">
        <label>Full Names</label>
        </div>

        <div class="input-field inline">
        <i class="material-icons prefix">mail</i>
        <input type="text" name="h_email" value="<?php _show_( $_SESSION['myEmail'] ); ?>">
        <label>Email</label>
        </div>

        <div class="input-field inline">
        <i class="material-icons prefix">phone</i>
        <input type="text" name="h_phone" value="<?php _show_( $_SESSION['myPhone'] ); ?>">
        <label>Phone</label>
        </div>

        <div class="input-field inline">
        <i class="material-icons prefix">room</i>
        <input type="text" name="h_location" value="<?php _show_( ucwords( $_SESSION['myLocation'] ) ); ?>">
        <label>Location</label>
        </div>

        <div class="input-field inline">
        <i class="material-icons prefix">monetization_on</i>
        <input type="text" name="h_location" value="<?php _show_( strtoupper( $_GET['method'] ) ); ?>">
        <label>Pay Via</label>
        </div>
        <input type="hidden" name="amount" value="<?php echo $item_total; ?>">

        <div class="input-field inline">
        <button class="mdl-button mdl-js-button mdl-button--colored mdl-js-ripple-effect" type="submit" name="pay">pay now <i class="material-icons">send</i></button>
        </div>
      </form>
    </div><?php 
  } ?>

  <div class="mdl-layout__content mdl-cell mdl-cell--6-col mdl-card mdl-color--<?php primaryColor(); ?>">
    <div class="mdl-card__title">
      <i class="material-icons">shop</i>
      <span class="mdl-button">Order <?php _show_( $_GET['order'] ); ?></span>
      <div class="mdl-layout-spacer"></div>
      <div class="mdl-card__subtitle-text mdl-button">
        <a id="btnEmpty" href="./shop?buy=empty">
         <i class="material-icons">note_add</i>
        Add Note
        </a>
      </div>
    </div>
    <table class="mdl-data-table mdl-js-data-table mdl-color--<?php primaryColor(); ?>">
      <tbody>
        <tr>
          <th class="mdl-data-table__cell--non-numeric">NOTES</th>
          <th class="mdl-data-table__cell--non-numeric">CREATED</th>
          <th class="mdl-data-table__cell--non-numeric">AMOUNT</th>
          <th class="mdl-data-table__cell--non-numeric">STATUS</th>
        </tr> 
      <?php     
      foreach ( $_SESSION["cart_item"] as $item){ ?>
        <tr>
          <td style="text-align:left;" ><strong><?php echo $item["name"]; ?></strong></td>
          <td style="text-align:left;" ><?php _show_( date(Ymd) ); ?></td><?php 
          $item_total += ( $item["price"]*$item["quantity"] );
        } ?>
          <td style="text-align:left;" ><?php echo "KSh ".$item_total; ?></td>
          <td style="text-align:left;" >processing</td>
        </tr>
      </tbody>
    </table>
  </div><?php
  }

  function getOrders() { ?>
    <title>All Orders [ <?php showOption( 'name' ); ?> ]</title><?php 
    $products = mysqli_query( $GLOBALS['conn'], "SELECT * FROM hposts LEFT JOIN hproducts ON hproducts.h_code = hposts.h_code WHERE h_type = 'product'" );
    if ( $products -> num_rows > 0) {
      while( $row = mysqli_fetch_assoc( $products) ) {
        $products_array[] = $row;
      }
    }

    if ( !empty( $products_array) ) { 
      foreach( $products_array as $key=>$value){ ?>
      <div class="mdl-cell mdl-cell--3-col mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>">
        <div class="mdl-card-media">
          <img src="<?php echo $products_array[$key]["h_avatar"]; ?>" width="100%" style="overflow: hidden;" >
        </div>
        <form enctype="multipart/form-data" method="post" action="./shop?view=list&buy=add&code=<?php echo $products_array[$key]["h_code"]; ?>">
          <div class="mdl-card__title mdl-card--expand">
              <div class="mdl-card__title-text">
                <?php echo $products_array[$key]["h_alias"]; ?>
              </div>
              <div class="mdl-layout-spacer"></div>
                <div class="mdl-card__subtitle-text">
            <?php echo "KSh ".$products_array[$key]["h_price"]; ?>
              
            </div>
            </div>
          <div class="mdl-card__supporting-text">
            <div class="input-field inline">
              <input type="number" name="quantity" value="1" size="2" />
            </div>
            <div class="input-field inline" style="padding-left: 10px;">
              <button type="submit" class="mdl-button mdl-button--fab mdl-button--colored mdl-js-button mdl-js-ripple-effect alignright">
              <i class="material-icons">add_shopping_cart</i></button>
            </div>
          </div>
          <span style="padding: 20px;">
          <a href="#" class="mdl-button mdl-js-ripple-effect mdl-button--icon"><i class="material-icons">thumb_up</i></a>

          <a href="#" class="mdl-button mdl-js-ripple-effect mdl-button--icon"><i class="material-icons">comment</i></a>

          <a href="#" class="mdl-button mdl-js-ripple-effect mdl-button--icon"><i class="material-icons">image</i></a>

          <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon alignright" id="prbtn">
                  <i class="material-icons">more_vert</i>
                </button>
                <ul class="mdl-menu mdl-js-menu mdl-js-ripple-effect mdl-menu--bottom-right option-drop mdl-card mdl-color--<?php primaryColor(); ?>" for="prtbtn">
                  <a class="mdl-menu__item mdl-list__item" href="#">Opt</a>
                  <a class="mdl-menu__item mdl-list__item" href="#">Opt</a>
                  <a class="mdl-menu__item mdl-list__item" href="#">Opt</a>
                </ul>
              </span>
              
          <div class="mdl-card__menu">
          <a href="?fav=<?php echo $products_array[$key]["h_code"]; ?>" class="mdl-button mdl-js-ripple-effect mdl-button--icon"><i class="material-icons">favorite</i></a>
          </div>
        </form>
      </div><?php 
      }
    }
  }

  function getOrder( $code) { ?>
    <title>Shop [ <?php showOption( 'name' ); ?> ]</title><?php 
    $product = mysqli_query( $GLOBALS['conn'], "SELECT * FROM hposts LEFT JOIN hproducts ON hproducts.h_code = hposts.h_code WHERE hposts.h_code='". $_GET["view"] ."'" );
    if ( $product -> num_rows > 0) { 
      while( $product_array = mysqli_fetch_assoc( $product) ) {
        $product_deets[] = $product_array;
      }
    } ?>

    <div class="mdl-cell mdl-cell--8-col mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>">
      <div class="mdl-card-media">
        <img src="<?php echo $product_deets[0]["h_avatar"]; ?>" width="100%" style="overflow: hidden;" >
      </div>
      <form enctype="multipart/form-data" method="post" action="./shop?view=list&buy=add&code=<?php echo $products_array[$key]["h_code"]; ?>">
        <div class="mdl-card__title mdl-card--expand">
            <div class="mdl-card__title-text">
              <?php echo $product_deets[0]["h_alias"]; ?>
            </div>
            <div class="mdl-layout-spacer"></div>
            <div class="mdl-card__subtitle-text">
              <?php echo "KSh ".$product_deets[0]["h_price"]; ?>
            </div>
        </div>

        <div class="mdl-card__supporting-text">
          <div class="input-field inline">
            <input type="number" name="quantity" value="1" size="2" />
          </div>
          <div class="input-field inline" style="padding-left: 10px;">
            <button type="submit" class="mdl-button mdl-button--fab mdl-button--colored mdl-js-button mdl-js-ripple-effect alignright">
            <i class="material-icons">add_shopping_cart</i></button>
          </div>
        </div>
        <span style="padding: 20px;">
          <a href="#" class="mdl-button mdl-js-ripple-effect mdl-button--icon"><i class="material-icons">thumb_up</i></a>

          <a href="#" class="mdl-button mdl-js-ripple-effect mdl-button--icon"><i class="material-icons">comment</i></a>

          <a href="#" class="mdl-button mdl-js-ripple-effect mdl-button--icon"><i class="material-icons">image</i></a>

          <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon alignright" id="prbtn">
                  <i class="material-icons">more_vert</i>
                </button>
                <ul class="mdl-menu mdl-js-menu mdl-js-ripple-effect mdl-menu--bottom-right option-drop mdl-card mdl-color--<?php primaryColor(); ?>" for="prtbtn">
                  <a class="mdl-menu__item mdl-list__item" href="#">Opt</a>
                  <a class="mdl-menu__item mdl-list__item" href="#">Opt</a>
                  <a class="mdl-menu__item mdl-list__item" href="#">Opt</a>
                </ul>
        </span>
            
        <div class="mdl-card__menu">
        <a href="?fav=<?php echo $product_deets[0]["h_code"]; ?>" class="mdl-button mdl-js-ripple-effect mdl-button--icon"><i class="material-icons">favorite</i></a>
        </div>
      </form>
    </div<?php 
    }
} ?>

