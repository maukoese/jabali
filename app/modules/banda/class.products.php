<?php 

class _hProducts extends Jabali\Classes\Posts {

  function createp($id, $h_price){
    $GLOBALS['JBLDB'] -> query( "INSERT INTO hproducts(id, h_price) VALUES('".$id."', '".$h_price."')" );
  }

  function getProducts() { ?>
    <title>All Products - <?php showOption( 'name' ); ?></title><?php 
    $products = $GLOBALS['JBLDB'] -> query( "SELECT * FROM ". _DBPREFIX ."posts LEFT JOIN hproducts ON hproducts.id = ". _DBPREFIX ."posts.id WHERE ". _DBPREFIX ."posts.ilk = 'product'" );
    if ( $products -> num_rows > 0) {
      while( $product = mysqli_fetch_assoc( $products) ) { ?>
      <div class="mdl-cell mdl-cell--3-col mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>">
        <div class="mdl-card-media">
          <img src="<?php echo $product["avatar"]; ?>" width="100%" style="overflow: hidden;" >
        </div> 
        <form enctype="multipart/form-data" method="post" action="?x=banda&product=all&cart=add&code=<?php echo $product["id"]; ?>">
          <div class="mdl-card__title mdl-card--expand">
            <a href="?x=banda&product=<?php echo $product["id"]; ?>">
              <h3 class="mdl-card__title-text"><?php echo $product["name"]; ?></h3>
            </a>
            <div class="mdl-layout-spacer"></div>
            <div class="mdl-card__subtitle-text">
              <?php echo "KSh ".$product["h_price"]; ?>
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
              
          <div class="mdl-card__menu">
          <a href="?x=banda&product=all&fav=<?php echo $product["id"]; ?>" class="mdl-button mdl-js-ripple-effect mdl-button--icon"><i class="material-icons">favorite</i></a>
          </div>
        </form>
      </div><?php 
      }
    } else { ?><center>
      <div class="mdl-cell mdl-cell--7-col mdl-card mdl-color--red" >
      <div class="mdl-card-media">
          <img src="<?php echo( _IMAGES.'404.jpg' ); ?>" width="100%" style="overflow: hidden;" >
      </div>
        <div class="mdl-card__title mdl-card--expand">
          <div class="mdl-card__title-text">
            No Products Found!
          </div>
              <div class="mdl-layout-spacer"></div>
              <div class="mdl-card__subtitle-text">
                <i class="material-icons">search</i>
              </div>
        </div>
        <div class="mdl-card__menu">
          <a href="./index.php" class="mdl-button mdl-js-ripple-effect mdl-button--icon"><i class="material-icons">home</i></a>
          </div>
      </div></center><?php
    }
  }

  function getProduct( $code) { ?>
    <title>Shop - <?php showOption( 'name' ); ?></title><?php 
    $product = $GLOBALS['JBLDB'] -> query( "SELECT * FROM ". _DBPREFIX ."posts LEFT JOIN hproducts ON hproducts.id = ". _DBPREFIX ."posts.id WHERE ". _DBPREFIX ."posts.id='". $_GET["product"] ."'" );
    if ( $product -> num_rows > 0) { 
      while( $product_array = mysqli_fetch_assoc( $product) ) {
        $product_deets[] = $product_array;
      }
    } ?>

    <div class="mdl-cell mdl-cell--8-col mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>">
      <div class="mdl-card-media">
        <img src="<?php echo $product_deets[0]["avatar"]; ?>" width="100%" style="overflow: hidden;" >
      </div>
      <form enctype="multipart/form-data" method="post" action="?x=banda&product=all&cart=add&code=<?php echo $product_deets[0]["id"]; ?>">
        <div class="mdl-card__title mdl-card--expand">
            <div class="mdl-card__title-text">
              <?php echo $product_deets[0]["name"]; ?>
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
            
        <div class="mdl-card__menu"><?php
        if ( !isCap( 'admin' ) ) { ?>
        <a href="?x=banda&product=all&fav=<?php echo $product_deets[0]["id"]; ?>" class="mdl-button mdl-js-ripple-effect mdl-button--icon"><i class="material-icons">favorite</i></a><?php } else { ?>
          <a href="?x=banda&edit=<?php echo $product_deets[0]["id"]; ?>&key=product" class="mdl-button mdl-js-ripple-effect accent mdl-button--icon"><i class="material-icons">edit</i></a><?php
        } ?>
        </div>
      </form>
    </div<?php 
  }

  function productFields () {
    $product[] = ""; 
    if ( isset( $_GET['edit'] ) ) {
      $getPostCode = $GLOBALS['JBLDB'] -> query( "SELECT * FROM ". _DBPREFIX ."posts LEFT JOIN hproducts ON hproducts.id = ". _DBPREFIX ."posts.id WHERE ". _DBPREFIX ."posts.id='".$_GET['edit']."'" );
      if ( $getPostCode -> num_rows > 0 ) {
        while ( $postDetails = mysqli_fetch_assoc( $getPostCode ) ){
          $product[] = $postDetails;
        }
      }
    } ?>
    <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone mdl-card mdl-shadow--2dp mdl-card--expand mdl-color--<?php primaryColor(); ?>">
      <div class="mdl-card__title">
        <i class="material-icons">details</i>
          <span class="mdl-button">Product Details</span>
        <div class="mdl-layout-spacer"></div>
          <div class="mdl-card__subtitle-text"><?php
          if( $_GET['create']){ ?>
            <a href="./do?x=banda&product=all">
              <i class="material-icons">clear</i>
            </a><?php } else { ?>
            <a href="?delete=<?php echo( $product[0]['id'] ); ?>">
              <i class="material-icons">delete</i>
            </a><?php } ?>
          </div>
      </div>
      <div class="mdl-card__supporting-text">

          <?php 
          if ( isset( $_GET['edit'] ) && $product[0]['ilk'] !== "page"  ) { ?>

          <div class="input-field">
          <i class="material-icons prefix">label</i>
          <textarea id="tags" name="tags" class="materialize-textarea col s12"><?php if( $_GET['create']) { echo( '' ); } else { echo( $product[0]['tags'] ); } ?></textarea>
          <label for="tags" class="center-align">Product Tags</label>
          </div>

          <div class="input-field">
          <i class="material-icons prefix">label_outline</i>
          <textarea id="category" name="category" class="materialize-textarea col s12"><?php if( $_GET['create']) { echo( '' ); } else { echo( $product[0]['category'] ); } ?></textarea>
          <label for="category" class="center-align">Product Categories</label>
          </div><?php 
          } ?>

        <div class="input-field">
          <i class="fa fa-money prefix"></i>
          <input id="h_price" type="text" name="h_price" value="<?php
          if( $_GET['create']) { echo( '0.00' ); } else { echo( $product[0]['h_price'] ); } ?>" >
          <label for="h_price" class="center-align">Price (KSh )</label>
        </div>
        <div class="input-field inline mdl-card mdl-shadow--2dp">
            <div style="height:0px;overflow:hidden">
               <input type="file" id="avatar" name="avatar" />
            </div>
            <img id="havatar" onclick="chooseFile();" src="<?php
          if( $_GET['create']) { echo( _IMAGES.'placeholder.svg' ); } else { echo( $product[0]['avatar'] ); } ?>" width="100%">
            </div>
             <script>
                $(function () {
                  $( ":file" ).change(function () {
                      if ( this.files && this.files[0]  ) {
                          var reader = new FileReader();
                          reader.onload = imageIsLoaded;
                          reader.readAsDataURL(this.files[0] );
                      }
                  } );
              } );

              function imageIsLoaded(e ) {
                  $('#havatar' ).attr('src', e.target.result );
              };
              </script>
                <script>
               function chooseFile() {
                  $( "#avatar" ).click();
               }
             </script>
        <div class="file-field input-field">
          <div class="btn mdl-button">
            <i class="material-icons">photo_library</i>
            <input type="file" multiple>
          </div>
          <div class="file-path-wrapper">
            <input class="file-path validate" type="text" placeholder="Product Gallery Images">
          </div>
        </div>
        <div class="mdl-cell mdl-cell--12-col mdl-grid">
          <div class="input-field mdl-cell mdl-cell--6-col">
            <i class="material-icons prefix">schedule</i>
            <input  id="created" name="created" type="text" value="<?php if( $_GET['create']){ echo date( 'Y-m-d' ); } else { echo( $product[0]['created'] ); } ?>"" >
            <label for="created" class="center-align">Publish Date</label>
            <script>
              $(function() {
              $("#created").datepicker({ dateFormat: "yy-mm-dd" }).val()
              });
            </script>
          </div>
          <input type="hidden" name="author" value="<?php if( isset( $_GET['create'] ) ) { echo $_SESSION[JBLSALT.'Code']; } else { echo( $product[0]['author'] ); } ?>">
          <input type="hidden" name="by" value="<?php if( isset( $_GET['create'] ) ) { echo $_SESSION[JBLSALT.'Alias']; } else { echo( $product[0]['by'] ); } ?>">
          <input type="hidden" name="email " value="<?php if( isset( $_GET['create'] ) ) { echo $_SESSION[JBLSALT.'Email']; } else { echo( $product[0]['email'] ); } ?>">
          <input type="hidden" name="authkey" value="<?php if( isset( $_GET['edit'] ) ) { echo( $product[0]['authkey'] ); } ?>">
          <input type="hidden" name="id" value="<?php if( isset( $_GET['edit'] ) ) { echo( $product[0]['id'] ); } ?>">
          <input type="hidden" name="level" value="public">
          <input type="hidden" name="phone" value="<?php if( isset( $_GET['create'] ) ) { echo $_SESSION[JBLSALT.'Phone']; } else { echo( $product[0]['phone'] ); } ?>">
          <input type="hidden" name="ilk" value="product">
          <input type="hidden" name="updated" value="<?php echo date('Y-m-d'); ?>">

          <div class="input-field mdl-cell mdl-cell--6-col">
          <button class="mdl-button mdl-button--fab alignright" type="submit" name="product<?php if( isset( $_GET['edit'] ) ) { echo( 'upd' ); } ?>"><i class="material-icons">save</i></button>
          </div>
        </div>
      </div>
    </form>
    </div><?php
  }
} ?>