<?php 

class _hEvents extends _hPosts {

  function createp($h_code, $h_price){
    mysqli_query( $GLOBALS['conn'], "INSERT INTO hevents(h_code, h_price) VALUES('".$h_code."', '".$h_price."')" );
  }

  function getEvents() { ?>
    <title>All Events [ <?php showOption( 'name' ); ?> ]</title><?php 
    $events = mysqli_query( $GLOBALS['conn'], "SELECT * FROM hposts LEFT JOIN hevents ON hevents.h_code = hposts.h_code WHERE h_type = 'event'" );
    if ( $events -> num_rows > 0) {
      while( $row = mysqli_fetch_assoc( $events) ) {
        $events_array[] = $row;
      }
    } else { ?><center>
      <div class="mdl-cell mdl-cell--7-col mdl-card mdl-color--red" >
      <div class="mdl-card-media">
          <img src="<?php _show_( hIMAGES.'404.jpg'); ?>" width="100%" style="overflow: hidden;" >
      </div>
        <div class="mdl-card__title mdl-card--expand">
          <div class="mdl-card__title-text">
            No Events Found!
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

    if ( !empty( $events_array) ) { 
      foreach( $events_array as $event ){ ?>
      <div class="mdl-cell mdl-cell--3-col mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>">
        <div class="mdl-card-media">
          <img src="<?php echo $event["h_avatar"]; ?>" width="100%" style="overflow: hidden;" >
        </div> 
        <form enctype="multipart/form-data" method="post" action="./shop?view=list&buy=add&code=<?php echo $events_array[$key]["h_code"]; ?>">
          <div class="mdl-card__title mdl-card--expand">
            <a href="?x=banda&event=<?php echo $event["h_code"]; ?>">
              <h3 class="mdl-card__title-text"><?php echo $event["h_alias"]; ?></h3>
            </a>
            <div class="mdl-layout-spacer"></div>
            <div class="mdl-card__subtitle-text">
              <?php echo "KSh ".$event["h_price"]; ?>
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
          <a href="?x=banda&event=all&fav=<?php echo $event["h_code"]; ?>" class="mdl-button mdl-js-ripple-effect mdl-button--icon"><i class="material-icons">favorite</i></a>
          </div>
        </form>
      </div><?php 
      }
    }
  }

  function getEvent( $code) { ?>
    <title>Shop [ <?php showOption( 'name' ); ?> ]</title><?php 
    $event = mysqli_query( $GLOBALS['conn'], "SELECT * FROM hposts LEFT JOIN hevents ON hevents.h_code = hposts.h_code WHERE hposts.h_code='". $_GET["event"] ."'" );
    if ( $event -> num_rows > 0) { 
      while( $event_array = mysqli_fetch_assoc( $event) ) {
        $event_deets[] = $event_array;
      }
    } ?>

    <div class="mdl-cell mdl-cell--8-col mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>">
      <div class="mdl-card-media">
        <img src="<?php echo $event_deets[0]["h_avatar"]; ?>" width="100%" style="overflow: hidden;" >
      </div>
      <form enctype="multipart/form-data" method="post" action="./shop?view=list&buy=add&code=<?php echo $events_array[$key]["h_code"]; ?>">
        <div class="mdl-card__title mdl-card--expand">
            <div class="mdl-card__title-text">
              <?php echo $event_deets[0]["h_alias"]; ?>
            </div>
            <div class="mdl-layout-spacer"></div>
            <div class="mdl-card__subtitle-text">
              <?php echo "KSh ".$event_deets[0]["h_price"]; ?>
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
        <a href="?x=banda&event=all&fav=<?php echo $event_deets[0]["h_code"]; ?>" class="mdl-button mdl-js-ripple-effect mdl-button--icon"><i class="material-icons">favorite</i></a><?php } else { ?>
          <a href="?x=banda&edit=<?php echo $event_deets[0]["h_code"]; ?>&key=event" class="mdl-button mdl-js-ripple-effect mdl-button--icon"><i class="material-icons">edit</i></a><?php
        } ?>
        </div>
      </form>
    </div<?php 
  }

  function eventFields () { 
    if ( $_GET['edit'] ) {
      $getPostCode = mysqli_query( $GLOBALS['conn'], "SELECT * FROM hposts LEFT JOIN hevents ON hevents.h_code = hposts.h_code WHERE hposts.h_code='".$_GET['edit']."'" );
      if ( $getPostCode -> num_rows > 0 ) {
        while ( $postDetails = mysqli_fetch_assoc( $getPostCode ) ){
          $event[] = $postDetails;
        }
      }
    } ?>
    <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone mdl-card mdl-shadow--2dp mdl-card--expand mdl-color--<?php primaryColor(); ?>">
      <div class="mdl-card__title">
        <i class="material-icons">details</i>
          <span class="mdl-button">Event Details</span>
        <div class="mdl-layout-spacer"></div>
          <div class="mdl-card__subtitle-text"><?php
          if( $_GET['create']){ ?>
            <a href="./do?x=banda&event=all">
              <i class="material-icons">clear</i>
            </a><?php } else { ?>
            <a href="?delete=<?php _show_( $event[0]['h_code'] ); ?>">
              <i class="material-icons">delete</i>
            </a><?php } ?>
          </div>
      </div>
      <div class="mdl-card__supporting-text">

          <?php 
          if ( $postDetails['h_type'] !== "page"  ) { ?>

          <div class="input-field">
          <i class="material-icons prefix">label</i>
          <textarea id="h_tags" name="h_tags" class="materialize-textarea col s12"><?php if( $_GET['create']) { _show_( '' ); } else { _show_( $event[0]['h_tags'] ); } ?></textarea>
          <label for="h_tags" class="center-align">Event Tags</label>
          </div>

          <div class="input-field">
          <i class="material-icons prefix">label_outline</i>
          <textarea id="h_category" name="h_category" class="materialize-textarea col s12"><?php if( $_GET['create']) { _show_( '' ); } else { _show_( $event[0]['h_category'] ); } ?></textarea>
          <label for="h_category" class="center-align">Event Categories</label>
          </div><?php 
          } ?>

        <div class="input-field">
          <i class="fa fa-money prefix"></i>
          <input id="h_price" type="text" name="h_price" value="<?php
          if( $_GET['create']) { _show_( '0.00' ); } else { _show_( $event[0]['h_price'] ); } ?>" >
          <label for="h_price" class="center-align">Price (KSh )</label>
        </div>

          <div class="input-field">
            <i class="material-icons prefix">date_range</i>
            <input  id="h_date" name="h_created" type="text" value="<?php if( $_GET['create']){ echo date( 'Y-m-d' ); } else { _show_( $event[0]['h_created'] ); } ?>"" >
            <label for="h_date" class="center-align">Event Date</label>
            <script>
              $(function() {
              $("#h_date").datepicker({ dateFormat: "yy-mm-dd" }).val()
              });
            </script>
          </div>

          <div class="mdl-cell mdl-cell--12-col mdl-grid">
          <div class="input-field mdl-cell mdl-cell--6-col">
            <i class="material-icons prefix">query_builder</i>
            <input  id="h_date" name="h_created" type="text" value="<?php if( $_GET['create']){ echo date( 'H-I-s' ); } else { _show_( $event[0]['h_created'] ); } ?>"" >
            <label for="f_time" class="center-align">Time (From)</label>
            <script>
              $(function() {
              $("#f_time").timepicker({ dateFormat: "yy-mm-dd" }).val()
              });
            </script>
          </div>
          <div class="input-field mdl-cell mdl-cell--6-col">
            <i class="material-icons prefix">schedule</i>
            <input  id="h_date" name="h_created" type="text" value="<?php if( $_GET['create']){ echo date( 'H-I-s' ); } else { _show_( $event[0]['h_created'] ); } ?>"" >
            <label for="t_time" class="center-align">Time (To)</label>
            <script>
              $(function() {
              $("#t_time").timepicker({ dateFormat: "yy-mm-dd" }).val()
              });
            </script>
          </div>
          </div>

        <div class="input-field inline mdl-card mdl-shadow--2dp">
            <div style="height:0px;overflow:hidden">
               <input type="file" id="h_avatar" name="h_avatar" />
            <label for="h_avatar" class="center-align">Event Poster</label>
            </div>
            <img id="havatar" onclick="chooseFile();" src="<?php
          if( $_GET['create']) { _show_( hIMAGES.'placeholder.svg' ); } else { _show_( $event[0]['h_avatar'] ); } ?>" width="100%">
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
                  $( "#h_avatar" ).click();
               }
             </script>
        <div class="file-field input-field">
          <div class="btn mdl-button">
            <i class="material-icons">photo_library</i>
            <input type="file" multiple>
          </div>
          <div class="file-path-wrapper">
            <input class="file-path validate" type="text" placeholder="Event Gallery Images">
          </div>
        </div>
        <div class="mdl-cell mdl-cell--12-col mdl-grid">
          <div class="input-field mdl-cell mdl-cell--6-col">
            <i class="material-icons prefix">schedule</i>
            <input  id="h_created" name="h_created" type="text" value="<?php if( $_GET['create']){ echo date( 'Y-m-d' ); } else { _show_( $event[0]['h_created'] ); } ?>"" >
            <label for="h_created" class="center-align">Publish Date</label>
            <script>
              $(function() {
              $("#h_created").datepicker({ dateFormat: "yy-mm-dd" }).val()
              });
            </script>
          </div>
          <input type="hidden" name="h_author" value="<?php if( $_GET['create']) { echo $_SESSION['myCode']; } else { _show_( $event[0]['h_author'] ); } ?>">
          <input type="hidden" name="h_by" value="<?php if( $_GET['create']) { echo $_SESSION['myAlias']; } else { _show_( $event[0]['h_by'] ); } ?>">
          <input type="hidden" name="h_email" value="<?php if( $_GET['create']) { echo $_SESSION['myEmail']; } else { _show_( $event[0]['h_email'] ); } ?>">
          <input type="hidden" name="h_level" value="public">
          <input type="hidden" name="h_phone" value="<?php if( $_GET['create']) { echo $_SESSION['myPhone']; } else { _show_( $event[0]['h_phone'] ); } ?>">
          <input type="hidden" name="h_type" value="event">
          <input type="hidden" name="h_updated" value="<?php echo date('Y-m-d'); ?>">

          <div class="input-field mdl-cell mdl-cell--6-col">
          <button class="mdl-button mdl-button--fab alignright" type="submit" name="event<?php if( $_GET['edit']) { _show_( 'upd' ); } ?>"><i class="material-icons">save</i></button>
          </div>
        </div>
      </div>
    </form>
    </div><?php
  }
} ?>