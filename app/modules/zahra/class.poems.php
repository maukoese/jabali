<?php 

class Poems extends Jabali\Classes\Posts {
  
  function getPoems() { ?>
    <title>All Poems - <?php showOption( 'name' ); ?></title>
      <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone "><?php 
              $getPoems = $GLOBALS['JBLDB'] -> query( "SELECT * FROM ". _DBPREFIX ."posts WHERE ilk = 'poem' AND state = 'published'" );
              if ( $getPoems -> num_rows >= 0) { ?>
                  <ul class="collapsible popout " data-collapsible="accordion"><?php 
                      while ( $note = mysqli_fetch_assoc( $getPoems) ) { ?>
                      <li>
                        <div class="collapsible-header mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>"><i class="material-icons">label_outline</i>
                          
                            <b><?php echo( $note['name'] ); ?></b><span class="alignright"><a href="./index?x=zahra&poem=<?php echo( $note['id'] ); ?>&key=<?php echo( $note['name'] ); ?>" ><i class="material-icons">open_in_new</i></a></span>
                        </div>
                        <div class="collapsible-body mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>">
                            <span><?php 
                            echo( $note['excerpt'] ); ?></span>
                        </div>
                      </li><?php 
                      } ?>
                </ul><?php
              } else {
              error404( 'poems' );
            } ?>
    </div><?php 
  }

  function getPoem( $code) {
    $getPoemCode = $GLOBALS['JBLDB'] -> query( "SELECT * FROM ". _DBPREFIX ."posts WHERE id = '".$code."'" );
    if ( $getPoemCode -> num_rows > 0) {
      while ( $postDetails = mysqli_fetch_assoc( $getPoemCode ) ) { ?>
        <title><?php echo( $postDetails['name'] ); ?> - <?php showOption( 'name' ); ?></title>
        <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--11-col-phone">
          <div class="mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>">
            <div class="mdl-card__supporting-text mdl-card--expand mdl-grid">
              <div class="mdl-cell mdl-cell--7-col mdl-grid">
                <div class="mdl-cell mdl-cell--10-col"><?php 
                  echo( $postDetails['details'] ); ?>
                </div>
              </div>
              <div class="mdl-cell mdl-cell--5-col-desktop mdl-cell--5-col-tablet mdl-cell--12-col-phone">
              <img src="<?php echo( $postDetails['avatar'] ); ?>" width="100%">
              <h4><?php echo( $postDetails['subtitle'] ); ?></h4>
              <h6>Published: <?php echo( $postDetails['created'] ); ?><br>
              Authored by: <a href="./users?view=<?php echo( $postDetails['author'] ); ?>&key=<?php echo( $postDetails['by'] ); ?>"><?php echo( $postDetails['by'] ); ?></a><br>
              Category: <?php echo( $postDetails['category'] ); ?><br>
              Tagged: <?php echo( ucwords( $postDetails['tags'] ) ); ?></br>
              Readings: <?php echo( ucwords( $postDetails['tags'] ) ); ?></h6>
              </div>
            </div>

            <div class="mdl-card__menu">
              <button id="demo_menu-top-right" class="mdl-button mdl-js-button mdl-button--icon" data-upgraded=",MaterialButton">
              <i class="material-icons">more_vert</i>
              </button>
              <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect mdl-color--<?php primaryColor(); ?>"
              for="demo_menu-top-right">
                <a href="./index?x=zahra&poem=<?php echo( $postDetails['id'] ); ?>&fav=<?php echo( $postDetails['id'] ); ?>" class="mdl-list__item"><i class="mdi mdi-heart mdl-list__item-icon"></i><span style="padding-left: 20px">Favorite</span></a>
                <a href="./note?poem=<?php echo( $postDetails['id'] ); ?>&author=<?php echo( $_SESSION[JBLSALT.'Code'] ); ?>" class="mdl-list__item"><i class="mdi mdi-note-multiple mdl-list__item-icon"></i><span style="padding-left: 20px">Notes</span></a><?php if ( isCap( 'admin' ) || isAuthor( $postDetails['author'] ) ) { ?>
                <a href="./index?x=zahra&edit=<?php echo( $postDetails['id'] ); ?>" class="mdl-list__item"><i class="mdi mdi-pencil mdl-list__item-icon"></i><span style="padding-left: 20px">Edit</span></a><?php } ?>
              </ul>
            </div>
          </div>
        </div>

        <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone">
          <div class="mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>"><?php 
          $getPoems = $GLOBALS['JBLDB'] -> query( "SELECT * FROM ". _DBPREFIX ."messages LIMIT 5" );
          if ( $getPoems -> num_rows > 0 ) { ?>
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
                      
                        <b><?php echo( $note['name'] ); ?></b><span class="alignright"><?php 
                        echo( $note['created'] ); ?></span>
                    </div>
                    <div class="collapsible-body">
                      <span class="alignright">
                        <a href="./notification?create=note&code=<?php echo( $note['author'] ); ?>" ><i class="material-icons">reply</i></a>
                        <a href="./notification?view=<?php echo( $note['id'] ); ?>" ><i class="material-icons">open_in_new</i></a> 
                        <a href="./notification?delete=<?php echo( $note['id'] ); ?>" ><i class="material-icons">delete</i></a>
                      </span>
                      <span><?php 
                      echo( $note['details'] ); ?></span>
                    </div>
                  </li><?php 
                } ?>
              </ul>
            </div><?php
          } else {
            echo "No Messages";
          } ?>
          <p>Add Comment</p>
          <form>
            <div class="input-field">
              <input id="name" name=="name" type="text">
              <label for="name">Title</label>
            </div>

            <div class="input-field">
              <textarea class="materialize-textarea col s12" id="details" name="details" ><?php 
                echo( $userDetails['details'] ); ?>
              </textarea>
              <label for="details">Your Comment</label>
            </div>
            <button type="submit" name="" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect alignright"><i  class="material-icons">send</i></button>
          </form>
          </div>
        </div><?php
      }
    } else {
    error404( 'poem' );
    }
  }

  function getPage( $code) {
    $getPoemCode = $GLOBALS['JBLDB'] -> query( "SELECT * FROM ". _DBPREFIX ."posts WHERE id = '".$code."'" );
    if ( $getPoemCode -> num_rows > 0) {
      while ( $postDetails = mysqli_fetch_assoc( $getPoemCode)){ ?>
      <title><?php echo( $postDetails['name'] ); ?> - <?php showOption( 'name' ); ?></title>
      <?php $hSocial = new _hSocial();
      $hSocial -> bottomShare( $code ); ?>
      <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--8-col-phone">
            <div class="mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>">
                <div class="mdl-card__title">
            <i class="material-icons">label</i>
              <span class="mdl-button"><h2 class="mdl-card__title-text"><?php echo( $postDetails['name'] ); ?></h2></span>
                    <div class="mdl-layout-spacer"></div>
                    <div class="mdl-card__subtitle-text">
                        <a href="tel:<?php echo( $postDetails['phone'] ); ?>" ><i class="material-icons">phone</i></a>
                        <a href="./posts?view=<?php echo( $postDetails['id'] ); ?>&fav=<?php echo( $postDetails['id'] ); ?>" ><i class="material-icons">star</i></a>
                        <a href="./posts?edit=<?php echo( $postDetails['id'] ); ?>" ><i class="material-icons">edit</i></a>
                    </div>
                </div>
                <div class="mdl-card__supporting-text mdl-card--expand mdl-grid">
                  <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone">
                <?php echo( $postDetails['details'] ); ?>
                  </div>
                  <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone">
                    <img src="<?php echo( $postDetails['avatar'] ); ?>" width="100%">
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
          $hPoem = new Poems();
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
      $getPostCode = $GLOBALS['JBLDB'] -> query( "SELECT * FROM ". _DBPREFIX ."posts WHERE id='".$_GET['edit']."'" );
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
        <textarea id="readings" name="readings" class="materialize-textarea col s12"></textarea>
        <label for="readings" class="center-align">Readings ( Links )</label>
        </div>

          <?php 
          if ( $postDetails['ilk'] !== "page"  ) { ?>

          <div class="input-field">
          <i class="material-icons prefix">label</i>
          <textarea id="tags" name="tags" class="materialize-textarea col s12"><?php if( $_GET['create']) { echo( '' ); } else { echo( $poem[0]['tags'] ); } ?></textarea>
          <label for="tags" class="center-align">Poem Tags</label>
          </div>

          <div class="input-field">
          <i class="material-icons prefix">label_outline</i>
          <textarea id="category" name="category" class="materialize-textarea col s12"><?php if( $_GET['create']) { echo( '' ); } else { echo( $poem[0]['category'] ); } ?></textarea>
          <label for="category" class="center-align">Poem Categories</label>
          </div><?php 
          } ?>

        <div class="input-field inline mdl-card mdl-shadow--2dp">
            <div style="height:0px;overflow:hidden">
               <input type="file" id="avatar" name="avatar" />
            </div>
            <img id="havatar" onclick="chooseFile();" src="<?php
          if( $_GET['create']) { echo( _IMAGES.'placeholder.svg' ); } else { echo( $poem[0]['avatar'] ); } ?>" width="100%">
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
      
        <div class="mdl-cell mdl-cell--12-col mdl-grid">
          <div class="input-field mdl-cell mdl-cell--6-col">
        <?php if( $_GET['create']) { ?>
            <i class="material-icons prefix">today</i>
            <input  id="created" name="created" type="text" value="<?php if( $_GET['create']){ echo date( 'Y-m-d' ); } else { echo( $poem[0]['created'] ); } ?>"" >
            <label for="created" class="center-align">Publish Date</label>
            <script>
              $(function() {
              $("#created").datepicker({ dateFormat: "yy-mm-dd" }).val()
              });
            </script>
            <?php } else { ?>
            <p><i class="material-icons prefix">today</i>   <span class="alignright"><?php echo( $poem[0]['created'] ); ?></span></p><br>
              <p><i class="material-icons prefix">perm_identity</i>   <span class="alignright"><a href="./users?view=<?php echo( $poem[0]['author'] ); ?>&key=<?php echo( $poem[0]['by'] ); ?>"><?php echo( $poem[0]['by'] ); ?></a></span></p><?php } ?>
          </div>
          <input type="hidden" name="author" value="<?php if( $_GET['create']) { echo $_SESSION[JBLSALT.'Code']; } else { echo( $poem[0]['author'] ); } ?>">
          <input type="hidden" name="by" value="<?php if( $_GET['create']) { echo $_SESSION[JBLSALT.'Alias']; } else { echo( $poem[0]['by'] ); } ?>">
          <input type="hidden" name="email" value="<?php if( $_GET['create']) { echo $_SESSION[JBLSALT.'Email']; } else { echo( $poem[0]['email'] ); } ?>">
          <input type="hidden" name="authkey" value="<?php if( $_GET['edit']) { echo( $poem[0]['authkey'] ); } ?>">
          <input type="hidden" name="id" value="<?php if( $_GET['edit']) { echo( $poem[0]['id'] ); } ?>">
          <input type="hidden" name="level" value="public">
          <input type="hidden" name="phone" value="<?php if( $_GET['create']) { echo $_SESSION[JBLSALT.'Phone']; } else { echo( $poem[0]['phone'] ); } ?>">
          <input type="hidden" name="ilk" value="poem">
          <input type="hidden" name="updated" value="<?php echo date('Y-m-d'); ?>">

          <div class="input-field mdl-cell mdl-cell--6-col">
          <button class="mdl-button mdl-button--fab alignright" type="submit" name="poem<?php if( $_GET['edit']) { echo( 'upd' ); } ?>"><i class="material-icons">save</i></button>
          </div>
        </div>
      </div>
    </form>
    </div><?php
  }

} ?>

