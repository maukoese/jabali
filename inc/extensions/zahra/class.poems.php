<?php 

class _hPoems extends _hPosts {
  
  function getPoems() { ?>
    <title>All Poems [ <?php showOption( 'name' ); ?> ]</title>
      <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone "><?php 
              $getPoems = mysqli_query( $GLOBALS['conn'], "SELECT * FROM hposts WHERE h_type = 'poem' AND h_status = 'published'" );
              if ( $getPoems -> num_rows >= 0) { ?>
                  <ul class="collapsible popout " data-collapsible="accordion"><?php 
                      while ( $note = mysqli_fetch_assoc( $getPoems) ) { ?>
                      <li>
                        <div class="collapsible-header mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>"><i class="material-icons">label_outline</i>
                          
                            <b><?php _show_( $note['h_alias'] ); ?></b><span class="alignright"><a href="./index?x=zahra&poem=<?php _show_( $note['h_code'] ); ?>&key=<?php _show_( $note['h_alias'] ); ?>" ><i class="material-icons">open_in_new</i></a></span>
                        </div>
                        <div class="collapsible-body mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>">
                            <span><?php 
                            _show_( $note['h_notes'] ); ?></span>
                        </div>
                      </li><?php 
                      } ?>
                </ul><?
              } else {
              error404( 'poems' );
            } ?>
    </div><?php 
  }

  function getPoem( $code) {
    $getPoemCode = mysqli_query( $GLOBALS['conn'], "SELECT * FROM hposts WHERE h_code = '".$code."'" );
    if ( $getPoemCode -> num_rows > 0) {
      while ( $postDetails = mysqli_fetch_assoc( $getPoemCode)){ ?>
      <title><?php _show_( $postDetails['h_alias'] ); ?> [ <?php showOption( 'name' ); ?> ]</title>
      <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--11-col-phone">
          <div class="mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>">
            <div class="mdl-card__supporting-text mdl-card--expand mdl-grid">
              <div class="mdl-cell mdl-cell--7-col mdl-grid">
                <div class="mdl-cell mdl-cell--10-col">
                  <?php _show_( $postDetails['h_description'] ); ?>
                </div>
              </div>
              <div class="mdl-cell mdl-cell--5-col-desktop mdl-cell--5-col-tablet mdl-cell--12-col-phone">
                <img src="<?php _show_( $postDetails['h_avatar'] ); ?>" width="100%">
                <h4><?php _show_( $postDetails['h_subtitle'] ); ?></h4>
                <h6>Published: <?php _show_( $postDetails['h_created'] ); ?><br>
                Authored by: <a href="./user?view=<?php _show_( $postDetails['h_author'] ); ?>&key=<?php _show_( $postDetails['h_by'] ); ?>"><?php _show_( $postDetails['h_by'] ); ?></a><br>
                Category: <?php _show_( $postDetails['h_category'] ); ?><br>
                Tagged: <?php _show_( ucwords( $postDetails['h_tags'] ) ); ?></br>
                Readings: <?php _show_( ucwords( $postDetails['h_tags'] ) ); ?></h6>
              </div>
            </div>


          <div class="mdl-card__menu">
            <button id="demo_menu-top-right" class="mdl-button mdl-js-button mdl-button--icon" data-upgraded=",MaterialButton">
            <i class="material-icons">more_vert</i>
            </button>
              <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect mdl-color--<?php primaryColor(); ?>"
              for="demo_menu-top-right">
              <a href="./index?x=zahra&poem=<?php _show_( $postDetails['h_code'] ); ?>&fav=<?php _show_( $postDetails['h_code'] ); ?>" class="mdl-list__item"><i class="mdi mdi-heart mdl-list__item-icon"></i><span style="padding-left: 20px">Favorite</span></a>
              <a href="./note?poem=<?php _show_( $postDetails['h_code'] ); ?>&author=<?php _show_( $_SESSION['myCode'] ); ?>" class="mdl-list__item"><i class="mdi mdi-note-multiple mdl-list__item-icon"></i><span style="padding-left: 20px">Notes</span></a><?php if ( isCap( 'admin' ) || isAuthor( $postDetails['h_author'] ) ) { ?>
              <a href="./index?x=zahra&edit=<?php _show_( $postDetails['h_code'] ); ?>" class="mdl-list__item"><i class="mdi mdi-pencil mdl-list__item-icon"></i><span style="padding-left: 20px">Edit</span></a><?php } ?>
              </ul>
          </div>
        </div>
      </div>

                <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone">
                    <div class="mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>"><?php 
                      $getPoems = mysqli_query( $GLOBALS['conn'], "SELECT * FROM hmessages LIMIT 5" );
                      if ( $getPoems -> num_rows >= 0) { ?>
                        <div class="mdl-card__title">
                          <i class="material-icons">comment</i>
                            <span class="mdl-button">Comments</span>
                          <div class="mdl-layout-spacer"></div>
                        </div>
                        <div class="mdl-card__supporting-text mdl-card--expand">
                          <ul class="collapsible popout" data-collapsible="accordion"><?php 
                              while ( $note = mysqli_fetch_assoc( $getPoems) ) { ?>
                              <li>
                                <div class="collapsible-header"><i class="material-icons">label_outline</i>
                                  
                                    <b><?php _show_( $note['h_alias'] ); ?></b><span class="alignright"><?php 
                                    _show_( $note['h_created'] ); ?></span>
                                </div>
                                <div class="collapsible-body"><span class="alignright">
                                    <a href="./notification?create=note&code=<?php _show_( $note['h_author'] ); ?>" ><i class="material-icons">reply</i></a> 
                                    <a href="./notification?view=<?php _show_( $note['h_code'] ); ?>" ><i class="material-icons">open_in_new</i></a> 
                                    <a href="./notification?delete=<?php _show_( $note['h_code'] ); ?>" ><i class="material-icons">delete</i></a>
                                    </span>
                                    <span><?php 
                                    _show_( $note['h_description'] ); ?></span>
                                </div>
                              </li><?php 
                              } ?>
                          </ul><?
                      } else {
                        echo "No Messages";
                      } ?>
                            <p>Add Comment</p>
                            <form>
                            <div class="input-field">
                            <input id="h_alias" name=="h_alias" type="text">
                            <label for="h_alias">Title</label>
                            </div>

                            <div class="input-field">
                            <textarea class="materialize-textarea col s12" id="h_description" name="h_description" ><?php _show_( $userDetails['h_description'] ); ?></textarea>
                            <label for="h_description">Your Comment</label>
                            </div>
                            <button type="submit" name="" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect alignright"><i  class="material-icons">send</i></button>
                            </form>
                        </div>
                    </div>
                </div><?php
      }
    } else {
      error404( 'poem' );
    }
  }

  function getPage( $code) {
    $getPoemCode = mysqli_query( $GLOBALS['conn'], "SELECT * FROM hposts WHERE h_code = '".$code."'" );
    if ( $getPoemCode -> num_rows > 0) {
      while ( $postDetails = mysqli_fetch_assoc( $getPoemCode)){ ?>
      <title><?php _show_( $postDetails['h_alias'] ); ?> [ <?php showOption( 'name' ); ?> ]</title>
      <?php $hSocial = new _hSocial();
      $hSocial -> bottomShare( $code ); ?>
      <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--8-col-phone">
            <div class="mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>">
                <div class="mdl-card__title">
            <i class="material-icons">label</i>
              <span class="mdl-button"><h2 class="mdl-card__title-text"><?php _show_( $postDetails['h_alias'] ); ?></h2></span>
                    <div class="mdl-layout-spacer"></div>
                    <div class="mdl-card__subtitle-text">
                        <a href="tel:<?php _show_( $postDetails['h_phone'] ); ?>" ><i class="material-icons">phone</i></a>
                        <a href="./post?view=<?php _show_( $postDetails['h_code'] ); ?>&fav=<?php _show_( $postDetails['h_code'] ); ?>" ><i class="material-icons">star</i></a>
                        <a href="./post?edit=<?php _show_( $postDetails['h_code'] ); ?>" ><i class="material-icons">edit</i></a>
                    </div>
                </div>
                <div class="mdl-card__supporting-text mdl-card--expand mdl-grid">
                  <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone">
                <?php _show_( $postDetails['h_description'] ); ?>
                  </div>
                  <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone">
                    <img src="<?php _show_( $postDetails['h_avatar'] ); ?>" width="100%">
                  </div>
                </div>
            </div>
      </div>

      <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone">
        <div class="mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>">
          <div class="mdl-card__title">
              <h2 class="mdl-card__title-text">List Of Poems</h2>

              <div class="mdl-layout-spacer"></div>
              <div class="mdl-card__subtitle-text">
          <i class="material-icons">list</i>
              </div>
          </div>
          <div class="mdl-card__supporting-text mdl-card--expand mdl-grid"><?php 
          $hPoem = new _hPoems();
          $hPoem -> getPoems(); ?>
          </div>
        </div>
      </div><?php
      }
    } else {
      error404( 'page' );
    }
  }

  function poemFields() {
    if ( $_GET['edit'] ) {
      $getPostCode = mysqli_query( $GLOBALS['conn'], "SELECT * FROM hposts WHERE h_code='".$_GET['edit']."'" );
      if ( $getPostCode -> num_rows > 0 ) {
        while ( $postDetails = mysqli_fetch_assoc( $getPostCode ) ){
          $poem[] = $postDetails;
        }
      }
    } ?>
    <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone mdl-card mdl-shadow--2dp mdl-card--expand mdl-color--<?php primaryColor(); ?>">
      <div class="mdl-card__title">
        <i class="material-icons">details</i>
          <span class="mdl-button">Poem Details</span>
        <div class="mdl-layout-spacer"></div>
          <div class="mdl-card__subtitle-text">
            <i class="material-icons">description</i>
          </div>
      </div>
      <div class="mdl-card__supporting-text">

        <div class="input-field">
        <i class="material-icons prefix">visibility</i>
        <textarea id="h_reading" name="h_reading" class="materialize-textarea col s12"></textarea>
        <label for="h_reading" class="center-align">Readings ( Links )</label>
        </div>

          <?php 
          if ( $postDetails['h_type'] !== "page"  ) { ?>

          <div class="input-field">
          <i class="material-icons prefix">label</i>
          <textarea id="h_tags" name="h_tags" class="materialize-textarea col s12"><?php if( $_GET['create']) { _show_( '' ); } else { _show_( $poem[0]['h_tags'] ); } ?></textarea>
          <label for="h_tags" class="center-align">Poem Tags</label>
          </div>

          <div class="input-field">
          <i class="material-icons prefix">label_outline</i>
          <textarea id="h_category" name="h_category" class="materialize-textarea col s12"><?php if( $_GET['create']) { _show_( '' ); } else { _show_( $poem[0]['h_category'] ); } ?></textarea>
          <label for="h_category" class="center-align">Poem Categories</label>
          </div><?php 
          } ?>

        <div class="input-field inline mdl-card mdl-shadow--2dp">
            <div style="height:0px;overflow:hidden">
               <input type="file" id="h_avatar" name="h_avatar" />
            </div>
            <img id="havatar" onclick="chooseFile();" src="<?php
          if( $_GET['create']) { _show_( hIMAGES.'placeholder.svg' ); } else { _show_( $poem[0]['h_avatar'] ); } ?>" width="100%">
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
      
        <div class="mdl-cell mdl-cell--12-col mdl-grid">
          <div class="input-field mdl-cell mdl-cell--6-col">
        <?php if( $_GET['create']) { ?>
            <i class="material-icons prefix">today</i>
            <input  id="h_created" name="h_created" type="text" value="<?php if( $_GET['create']){ echo date( 'Y-m-d' ); } else { _show_( $poem[0]['h_created'] ); } ?>"" >
            <label for="h_created" class="center-align">Publish Date</label>
            <script>
              $(function() {
              $("#h_created").datepicker({ dateFormat: "yy-mm-dd" }).val()
              });
            </script>
            <?php } else { ?>
            <p><i class="material-icons prefix">today</i>   <span class="alignright"><?php _show_( $poem[0]['h_created'] ); ?></span></p><br>
              <p><i class="material-icons prefix">perm_identity</i>   <span class="alignright"><a href="./user?view=<?php _show_( $poem[0]['h_author'] ); ?>&key=<?php _show_( $poem[0]['h_by'] ); ?>"><?php _show_( $poem[0]['h_by'] ); ?></a></span></p><?php } ?>
          </div>
          <input type="hidden" name="h_author" value="<?php if( $_GET['create']) { echo $_SESSION['myCode']; } else { _show_( $poem[0]['h_author'] ); } ?>">
          <input type="hidden" name="h_by" value="<?php if( $_GET['create']) { echo $_SESSION['myAlias']; } else { _show_( $poem[0]['h_by'] ); } ?>">
          <input type="hidden" name="h_email" value="<?php if( $_GET['create']) { echo $_SESSION['myEmail']; } else { _show_( $poem[0]['h_email'] ); } ?>">
          <input type="hidden" name="h_key" value="<?php if( $_GET['edit']) { _show_( $poem[0]['h_key'] ); } ?>">
          <input type="hidden" name="h_code" value="<?php if( $_GET['edit']) { _show_( $poem[0]['h_code'] ); } ?>">
          <input type="hidden" name="h_level" value="public">
          <input type="hidden" name="h_phone" value="<?php if( $_GET['create']) { echo $_SESSION['myPhone']; } else { _show_( $poem[0]['h_phone'] ); } ?>">
          <input type="hidden" name="h_type" value="poem">
          <input type="hidden" name="h_updated" value="<?php echo date('Y-m-d'); ?>">

          <div class="input-field mdl-cell mdl-cell--6-col">
          <button class="mdl-button mdl-button--fab alignright" type="submit" name="poem<?php if( $_GET['edit']) { _show_( 'upd' ); } ?>"><i class="material-icons">save</i></button>
          </div>
        </div>
      </div>
    </form>
    </div><?php
  }

} ?>

