<?php
/**
* @package Jabali Framework
* @subpackage Forms Class
* @link https://docs.jabalicms.org/classes/forms/
* @author Mauko Maunde
* @version 0.17.06
**/

namespace Jabali\Classes;

class Forms {

  function messageForm() { ?>
    <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone mdl-card mdl-shadow--2dp mdl-card--expand mdl-color--<?php primaryColor(); ?>">
        <div class="mdl-card__supporting-text mdl-card--expand">
            <form enctype="multipart/form-data" name="messageForm" method="POST" action="">
              <title>Compose <?php echo ucfirst( $_GET['create'] ); ?> - <?php showOption( 'name' ); ?></title>

                <div class="input-field">
                  <i class="material-icons prefix">label</i>
                  <input id="subject" type="text" name="name" >
                  <label for="subject" class="center-align">Subject</label>
                </div><?php

                if ( isset( $_GET['code'] )  ) { ?>
                  <input type="hidden" name="for" value="<?php echo( $_GET['code'] ); ?>"><?php
                } else { ?>
                  <div class="input-field inline getmdl-select getmdl-select__fix-height">
                    <i class="material-icons prefix">perm_identity</i>
                    <input class="mdl-textfield__input" type="text" id="for" name="for" readonly tabIndex="-1" placeholder="Select Receipient">
                    <ul for="for" class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-color--<?php primaryColor(); ?>" style="max-height: 300px !important; overflow-y: auto;"><?php
                        $centers = $GLOBALS['JBLDB'] -> query( "SELECT name, avatar, id FROM ". _DBPREFIX ."users ORDER BY name" );
                        if ( $GLOBALS['JBLDB'] -> numRows( $centers ) > 0 );
                        while ( $center = $GLOBALS['JBLDB'] -> fetchArray( $centers ) ) {
                          echo( '<li class="mdl-menu__item" data-val="'.$center['id'].'">'.$center['name'].'<span style=""><img class="alignright" style="padding-right:20px;margin:auto;" src="'.$center['avatar'].'" height="18px;"></span></li>' );
                        } ?>
                    </ul>
                  </div><?php
                } ?>

                <div class="input-field inline getmdl-select getmdl-select__fix-height">
                  <i class="material-icons prefix">perm_identity</i>
                  <input class="mdl-textfield__input" type="text" id="forc" name="forc" readonly tabIndex="-1" placeholder="Cc/Bcc">
                  <ul for="forc" class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-color--<?php primaryColor(); ?>" style="max-height: 300px !important; overflow-y: auto;"><?php
                      $centers = $GLOBALS['JBLDB'] -> query( "SELECT name, avatar, id FROM ". _DBPREFIX ."users ORDER BY name" );
                      if ( $GLOBALS['JBLDB'] -> numRows( $centers ) > 0 );
                      while ( $center = $GLOBALS['JBLDB'] -> fetchArray( $centers ) ) {
                        echo( '<li class="mdl-menu__item" data-val="'.$center['id'].'">'.$center['name'].'<span style=""><img class="alignright" style="padding-right:20px;margin:auto;" src="'.$center['avatar'].'" height="18px;"></span></li>' );
                      } ?>
                  </ul>
                </div>

                <input type="hidden" name="author" value="<?php echo $_SESSION[JBLSALT.'Code']; ?>">
                <input type="hidden" name="by" value="<?php echo $_SESSION[JBLSALT.'Alias']; ?>">
                <input type="hidden" name="email " value="<?php echo $_SESSION[JBLSALT.'Email']; ?>">
                <input type="hidden" name="level" value="private">
                <input type="hidden" name="phone" value="<?php echo $_SESSION[JBLSALT.'Phone']; ?>">
                <input type="hidden" name="ilk" value="<?php echo $_GET['create']; ?>">

                <div class="input-field">
                  <p>Your Message</p>
                  <textarea class="materialize-textarea col s12" type="text" id="details" rows="5" name="details"></textarea><script>CKEDITOR.replace( 'details' );</script>
                </div>

                <div class="file-field input-field inline">
                  <div class="btn mdl-color--<?php primaryColor(); ?>">
                    <span class="material-icons">attach_file</span>
                    <input type="file" multiple>
                  </div>
                  <div class="file-path-wrapper">
                    <input class="file-path validate" type="text" placeholder="Attach files">
                  </div>
                </div>

                <div class="input-field inline alignright">
                  <button class="mdl-button mdl-button--fab alignright" type="submit" name="create"><i class="material-icons">send</i></button>
                </div>
            </form>
        </div>
    </div><?php
  }

  function contactForm() { ?>
    <div class="mdl-grid">
      <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone mdl-card mdl-shadow--2dp mdl-card--expand mdl-color--<?php if ( isset( $_SESSION[JBLSALT.'Code'] ) ){ primaryColor(); } else { echo "grey"; } ?>">
          <div class="mdl-card__supporting-text mdl-card--expand">
            <form>
              <div class="input-field inline">
                <i class="material-icons prefix">perm_identity</i>
              <input id="by" name="by" type="text">
              <label for="by">Your Name</label>
              </div>

              <div class="input-field inline">
                <i class="material-icons prefix">mail_outline</i>
              <input id="email " name="email " type="text">
              <label for="email ">Your Email</label>
              </div>

              <div class="input-field inline">
                <i class="material-icons prefix">phone</i>
              <input id="phone" name="phone" type="text">
              <label for="phone">Phone (Optional )</label>
              </div>

              <div class="input-field mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">
                <i class="material-icons prefix">room</i>
              <input class="mdl-textfield__input" type="text" id="counties" name="location" readonly tabIndex="-1" placeholder="Location (Optional )">
              <ul for="counties" class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-color--<?php primaryColor(); ?>" style="max-height: 300px !important; overflow-y: auto;">
                  <?php
                  $county_list = "baringo, bomet, bungoma, busia, elgeyo-marakwet, embu, garissa, homa bay, isiolo, kakamega, kajiado, kapenguria, kericho, kiambu, kilifi, kirinyanga, kisii, kisumu, kitui, kwale, laikipia, lamu, machakos, makueni, mandera, marsabit, meru, migori, mombasa, muranga, nairobi, nakuru, nandi, narok, nyamira, nyandarua, nyeri, ol kalou, samburu, siaya, taita-taveta, tana river, tharaka-nithi, trans-nzoia, turkana, uasin-gishu, vihiga, wajir, west pokot";
                  $counties = explode( ", ", $county_list );
                  for ( $c=0; $c < count( $counties ); $c++ ) {
                      $label = ucwords( $counties[$c] );
                      echo '<li class="mdl-menu__item" data-val="'.$counties[$c].'">'.$label.'</li>';
                  }
                   ?>
              </ul>
              </div>

              <div class="input-field">
              <p>Your Message</p>
              <textarea class="materialize-textarea col s12" type="text" id="details" rows="5" name="details"></textarea><script>CKEDITOR.replace( 'details' );</script>
              </div><br>
              <button type="submit" name="" class="mdl-button mdl-button--fab alignright"><i  class="material-icons">send</i></button>
            </form>
          </div>
      </div>
    </div><?php
  }

  function commentForm() { ?>
      <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone mdl-shadow--2dp mdl-color--<?php if ( isset( $_SESSION[JBLSALT.'Code'] ) ){ primaryColor(); } else { echo "grey"; } ?>">
            <form class=" mdl-grid" method="POST" action="" style="width: 100%">
              <div class="input-field mdl-cell mdl-cell--6-col">
                <i class="material-icons prefix">perm_identity</i>
              <input id="by" name="by" type="text" value="<?php if ( isset( $_SESSION[JBLSALT.'Alias'] ) ){ echo( $_SESSION[JBLSALT.'Alias'] ); } ?>">
              <label for="by">Your Name</label>
              </div>

              <div class="input-field mdl-cell mdl-cell--5-col">
                <i class="material-icons prefix">mail_outline</i>
              <input id="email " name="email " type="text" value="<?php if ( isset( $_SESSION[JBLSALT.'Email'] ) ){ echo( $_SESSION[JBLSALT.'Email'] ); } ?>">
              <label for="email ">Your Email</label>
              </div>

              <div class="input-field mdl-cell mdl-cell--10-col">
              <p>Your Message</p>
              <textarea class="materialize-textarea col s12" type="text" id="details" rows="5" name="details"></textarea><script>CKEDITOR.replace( 'details' );</script>
              </div><br>
              <button type="submit" name="" class="mdl-button mdl-button--colored alignright"><i  class="material-icons">send</i></button>
            </form>
      </div><?php
  }

  function postForm() { ?>
    <title>New <?php echo ucfirst( $_GET['create'] ); ?> - <?php showOption( 'name' ); ?></title>
      <form enctype="multipart/form-data" name="postForm" method="POST" action="" style="width:100%;" class="mdl-grid">
        <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone mdl-grid mdl-card mdl-shadow--2dp mdl-card--expand mdl-color--<?php primaryColor(); ?>"><br><br>
          <div class="mdl-card__supporting-text mdl-cell mdl-cell--12-col mdl-grid">
            <div class="input-field mdl-cell mdl-cell--12-col">
            <input id="name" type="text" name="name" >
            <label for="name" data-error="wrong" data-success="right" class="center-align">Title</label>
            </div>

            <div class="input-field mdl-cell mdl-cell--9-col">
            <input id="subtitle" type="text" name="subtitle" >
            <label for="subtitle" data-error="wrong" data-success="right" class="center-align">Subtitle(Optional )</label>
            </div>

            <div class="input-field mdl-cell--3-col mdl-js-textfield getmdl-select">
              <i class="material-icons prefix">keyboard_arrow_down</i>
              <input class="mdl-textfield__input" id="ilk" name="template" type="text" readonly tabIndex="-1" value="Select Template" >
              <ul class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-color--<?php primaryColor(); ?>" for="ilk"><?php
                  $theme = getOption( 'activetheme' );
                  $path = _ABSTHEMES_ . $theme . '/templates/';
                  if ( $dh = opendir( $path ) ) {
                    while ( ($template = readdir( $dh ) ) !== false ) {
                      if ( ($template !== ".") && ($template !== "..")) {
                        echo '<li class="mdl-menu__item" data-val="'.  str_replace(".php", "", $template ) .'" >'. ucwords(str_replace(".php", "", $template ) ) .'</li>';
                      }
                    }
                    closedir( $dh );
                  } ?>
              </ul>
            </div>

            <div class="input-field mdl-cell mdl-cell--12-col">
            <h6><?php echo ucfirst( $_GET['create'] ); ?> Content</h6>
            <textarea class="materialize-textarea col s12" type="text" id="message" rows="5" name="details"></textarea>
            <script>CKEDITOR.replace( 'message' );</script>
            </div>
            <div class="input-field mdl-cell mdl-cell--12-col">
            <h6><?php echo ucfirst( $_GET['create'] ); ?> Notes</h6>
            <textarea class="materialize-textarea col s12" type="text" id="message" rows="5" name="excerpt"></textarea>
            </div>
          </div>
        </div>
        <?php if ( $_GET['create'] == "page" || $_GET['create'] == "article" || $_GET['create'] == "project" ) { ?>
        <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone mdl-card mdl-shadow--2dp mdl-card--expand mdl-color--<?php primaryColor(); ?>">
          <div class="mdl-card__image">
              <div style="height:0px;overflow:hidden">
                 <input type="file" id="avatar" name="new_avatar" />
                 <input type="hidden" id="avatar" name="the_avatar" value="<?php echo( _IMAGES.'placeholder.svg' ); ?>" />
              </div>
              <img id="havatar" onclick="chooseFile();" src="<?php echo( _IMAGES.'placeholder.svg' ); ?>" width="100%">
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
          </div>
          <div class="mdl-card__supporting-text"><?php

              if ( $_GET['create'] !== "page" ) { ?>
                <div class="mdl-cell mdl-cell--12-col mdl-grid">
                  <div class="input-field mdl-cell mdl-cell--6-col">
                  <i class="material-icons prefix">label</i>
                  <textarea id="tags" name="tags" class="materialize-textarea col s12"></textarea>
                  <label for="tags" class="center-align">Tags</label>
                  </div>

                  <div class="input-field mdl-cell mdl-cell--6-col">
                  <i class="material-icons prefix">label_outline</i>
                  <textarea id="category" name="categories" class="materialize-textarea col s12"></textarea>
                  <label for="category" class="center-align">Categories</label>
                  </div><?php
              } ?>

              <div class="input-field mdl-cell mdl-cell--7-col">
                <i class="material-icons prefix">today</i>
                <input  id="created" name="created_d" type="text" value="<?php echo date( 'Y-m-d' ); ?>" >
                <label for="created" class="center-align">Publish Date</label>
                <script>
                  $(function() {
                  $("#created").datepicker({ dateFormat: "yy-mm-dd" }).val()
                  });
                </script>
              </div>

              <div class="input-field mdl-cell mdl-cell--5-col">
                <i class="material-icons prefix">schedule</i>
                <input  id="created_t" name="created_t" type="text" value="<?php echo date( 'H:i:s' ); ?>" class="timepicker" >
                <script type="text/javascript">
                  $('.timepicker').pickatime({
                    default: 'now', // Set default time: 'now', '1:30AM', '16:30'
                    fromnow: 0,       // set default time to * milliseconds from now (using with default = 'now')
                    twelvehour: false, // Use AM/PM or 24-hour format
                    donetext: 'OK', // text for done-button
                    cleartext: 'Clear', // text for clear-button
                    canceltext: 'Cancel', // Text for cancel-button
                    autoclose: false, // automatic close timepicker
                    ampmclickable: true, // make AM PM clickable
                    aftershow: function(){} //Function for after opening timepicker
                  });
                </script>
                <label for="created_t" class="center-align">Time</label>
              </div>
              </div>

            <input type="hidden" name="author" value="<?php echo $_SESSION[JBLSALT.'Code']; ?>">
            <input type="hidden" name="author_name" value="<?php echo $_SESSION[JBLSALT.'Alias']; ?>">
            <input type="hidden" name="level" value="public">
            <input type="hidden" name="authkey" value="<?php str_shuffle( generateCode() ); ?>">
            <input type="hidden" name="state" value="published">
            <input type="hidden" name="ilk" value="<?php echo $_GET['create']; ?>">
            <?php csrf(); ?>

            <div class="input-field">
              <button class="mdl-button mdl-button--fab addfab alignright mdl-button--colored" type="submit" name="create"><i class="material-icons">save</i></button>
            </div>
        </div>
          <div class="mdl-card__menu">
            <a href="?view=list&type=article">
              <i class="material-icons">clear</i>
            </a>
          </div>
        </div>
      </form><?php
        }
  }

  function editPostForm( $code ) {
    $getPostCode = $GLOBALS['JBLDB'] -> query( "SELECT * FROM ". _DBPREFIX ."posts WHERE id = '".$code."'" );
    if ( $GLOBALS['JBLDB'] -> numRows( $getPostCode ) > 0 ) {
      while ( $post = $GLOBALS['JBLDB'] -> fetchObject( $getPostCode ) ){
        $names = explode( " ", $post -> name ); ?>
        <title>Edit <?php echo( $post -> name ); ?> - <?php showOption( 'name' ); ?></title>
      <form enctype="multipart/form-data" name="postForm" method="POST" action="" style="width:100%;" class="mdl-grid">
          <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone mdl-grid mdl-card mdl-shadow--2dp mdl-card--expand mdl-color--<?php primaryColor(); ?>">
          <div class="mdl-card__supporting-text mdl-cell mdl-cell--12-col mdl-grid">
              <div class="input-field mdl-cell mdl-cell--12-col">
              <i class="material-icons prefix">label</i>
              <input id="name" type="text" name="name" value="<?php echo( $post -> name ); ?>">
              <label for="name" data-error="wrong" data-success="right" class="center-align">Title</label>
              </div>

              <div class="input-field mdl-cell mdl-cell--7-col">
              <i class="material-icons prefix">label_outline</i>
              <input id="subtitle" type="text" name="subtitle" value="<?php echo( $post -> subtitle ); ?>">
              <label for="subtitle"  class="center-align">Subtitle</label>
              </div>


              <div class="input-field mdl-cell mdl-cell--5-col mdl-grid">
                <i class="material-icons prefix">link</i>
                <input id="link" type="text" name="link" value="<?php echo( _ROOT . '/'. $post -> slug ); ?>">
                <label for="link"  class="center-align">Link</label>
              </div>

              <div class="input-field mdl-cell mdl-cell--12-col">
                <h6><?php echo( ucfirst( $post -> ilk ) ); ?> Content</h6>
                <textarea class="materialize-textarea col s12" type="text" id="message" rows="5" name="details">
                  <?php echo( $post -> details ); ?>
                </textarea><script>CKEDITOR.replace( 'message' );</script>
              </div>

              <div class="input-field mdl-cell mdl-cell--12-col">
                <h6><?php echo( ucfirst( $post -> ilk ) ); ?> Notes</h6>
                <textarea class="materialize-textarea col s12" type="text" id="message" rows="5" name="excerpt">
                <?php echo( $post -> excerpt ); ?>
                </textarea>
              </div>
            </div>

            <div class="mdl-card__menu mdl-button mdl-button--icon">
            <a href="<?php echo( $post -> link ); ?>" target="_blank" >
              <i class="material-icons">open_in_new</i>
            </a>
            </div>
          </div>
        <?php if ( !isset( $_GET['x']) ) { ?>
        <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone mdl-card mdl-shadow--2dp mdl-card--expand mdl-color--<?php primaryColor(); ?>">
          <div class="mdl-card__image">
              <div style="height:0px;overflow:hidden">
                 <input type="file" id="avatar" name="new_avatar" />
                 <input type="hidden" id="avatar" name="the_avatar" value="<?php echo( $post -> avatar ); ?>" />
              </div><?php if (!file_exists( $post -> avatar )): $savatar = _IMAGES.'placeholder.svg'; endif; ?>
              <img id="havatar" onclick="chooseFile();" src="<?php echo( $savatar ); ?>" width="100%">
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
             </div>
          <div class="mdl-card__supporting-text">


            <div class="input-field mdl-js-textfield getmdl-select">
              <i class="material-icons prefix">keyboard_arrow_down</i>
              <input class="mdl-textfield__input" id="ilk" name="template" type="text" readonly tabIndex="-1" value="<?php echo( $post -> template ); ?>" >
              <ul class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-color--<?php primaryColor(); ?>" for="ilk"><?php
                  $theme = getOption( 'activetheme' );
                  $path = _ABSTHEMES_ . $theme . '/templates/';
                  if ( $dh = opendir( $path ) ) {
                    while ( ($template = readdir( $dh ) ) !== false ) {
                      if ( ($template !== ".") && ($template !== "..")) {
                        echo '<li class="mdl-menu__item" data-val="'.  str_replace(".php", "", $template ) .'" >'. ucwords(str_replace(".php", "", $template ) ) .'</li>';
                      }
                    }
                    closedir( $dh );
                  } ?>
              </ul>
            </div>

              <?php
              if ( $post -> ilk !== "page"  ) { ?>

              <div class="input-field">
              <i class="mdi mdi-tag-multiple prefix"></i>
              <textarea id="tags" name="tags" class="materialize-textarea col s12"><?php echo( $post -> tags ); ?></textarea>
              <label for="tags" class="center-align">Tags</label>
              </div>

              <div class="input-field">
              <i class="mdi mdi-format-list-bulleted-type prefix"></i>
              <textarea id="category" name="categories" class="materialize-textarea col s12"><?php echo( $post -> categories ); ?></textarea>
              <label for="category" class="center-align">Categories</label>
              </div><?php
              } else {
                hiddenFields( array( 'tags' => '', 'categories' => '') );
              }
              $date = $post -> created;
              $date = explode(" ", $date); ?>

              <div class="mdl-grid">
              <div class="input-field mdl-cell mdl-cell--6-col">
              <i class="material-icons prefix">today</i>
                <input type="text" id="created" name="created_d" value="<?php echo( $date[0] ); ?>" >
                <script>
                  $(function() {
                  $("#created").datepicker({ dateFormat: "yy-mm-dd" }).val()
                  });
                </script>
              <label for="created" class="center-align">Published on</label>
              </div>

              <div class="input-field mdl-cell mdl-cell--6-col">
              <i class="material-icons prefix">schedule</i>
                <input type="text" id="created_t" name="created_t" value="<?php echo( $date[1] ); ?>" >
              <label for="created_t" class="center-align">at</label>
              </div>
              </div>
              <p>Author: <a href="./users?view=<?php echo( $post -> author ); ?>&key=<?php echo( $post -> author_name ); ?>"><?php echo( $post -> author_name ); ?></a></p>

              <?php hiddenFields( array( 'author' => $post -> author, 'author_name' => $post -> author_name, 'level' => $post -> level, 'authkey' => $post -> authkey, 'id' => $post -> id, 'state' => $post -> state, 'ilk' => $post -> ilk, 'updated' => date( 'Y-m-d H:i:s') ) ); 
              submitButton( 'update', 'addfab' ); ?>
        </div>

          <div class="mdl-card__menu">
            <a href="?delete=<?php echo( $post -> id ); ?>">
              <i class="material-icons">delete</i>
            </a>
          </div>
        </div>
      </form><?php
        }
      }
    } else {
      echo 'The Post No Longer Exists.';
    }
  }


  function userForm() { ?>
    <title>Add New <?php echo( ucfirst( $_GET['create'] ) ); ?> - <?php showOption( 'name' ); ?></title>
    <div class="mdl-cell mdl-cell--12-col mdl-grid mdl-color--<?php primaryColor(); ?> mdl-card">
      <form enctype="multipart/form-data" name="registerUser" method="POST" action="" class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone mdl-grid mdl-card__supporting-text">
          <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone mdl-grid">
            <div class="mdl-cell mdl-cell--12-col mdl-grid">

            <div class="input-field mdl-cell--6-col">
              <i class="material-icons prefix">label</i>
              <input id="fname" name="fname" type="text" >
              <label for="fname">First Name</label>
            </div>

            <div class="input-field mdl-cell--6-col">
              <i class="material-icons prefix">label_outline</i>
              <input id="lname" name="lname" type="text">
              <label for="lname">Last Name</label>
            </div>

            <div class="input-field mdl-cell--4-col mdl-js-textfield mdl-textfield--floating-label getmdl-select">
              <i class="material-icons prefix">perm_identity</i>
              <input class="mdl-textfield__input" id="ilk" name="ilk" type="text" readonly tabIndex="-1" value="<?php if ( isset( $_GET['create'] ) ) {
                echo( ucwords( $_GET['create'] ) );
              } ?>" >
              <label for="ilk"><i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i></label>
              <ul class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-color--<?php primaryColor(); ?>" for="ilk"><?php
              if ( isCap( 'admin' )  ) {
                echo( '<li class="mdl-menu__item" data-val="admin">Admin<i class="mdl-color-text--white mdi mdi-lock alignright" role="presentation"></i></li>' );
              } ?>
              <li class="mdl-menu__item" data-val="organization">Organization<i class="mdl-color-text--white mdi mdi-city alignright" role="presentation"></i></li>
              <li class="mdl-menu__item" data-val="editor">Editor<i class="mdl-color-text--white mdi mdi-note alignright" role="presentation"></i></li>
              <li class="mdl-menu__item" data-val="author">Author<i class="mdl-color-text--white mdi mdi-note-plus alignright" role="presentation"></i></li>
              <li class="mdl-menu__item" data-val="subscriber">Subscriber<i class="mdl-color-text--white mdi mdi-email alignright" role="presentation"></i></li>
              </ul>
            </div>

            <?php if ( $_GET['create'] !== "organization"  ) { ?>
              <div class="input-field mdl-cell--4-col mdl-js-textfield mdl-textfield--floating-label getmdl-select">
                <i class="mdi mdi-gender-transgender prefix"></i>
                <input class="mdl-textfield__input" id="gender" name="gender" type="text" readonly tabIndex="-1" placeholder="Gender" >
                <label for="gender">
                <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
                </label>
                <ul class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-color--<?php primaryColor(); ?>" for="gender">
                <li class="mdl-menu__item" data-val="male">Male</li>
                <li class="mdl-menu__item" data-val="female">Female</li>
                <li class="mdl-menu__item" data-val="other">Other</li>
                </ul>
              </div><?php
            } ?>

            <div class="input-field mdl-cell--4-col mdl-js-textfield getmdl-select getmdl-select__fix-height">
              <i class="material-icons prefix">room</i>
              <input class="mdl-textfield__input" type="text" id="counties" name="location" readonly tabIndex="-1" placeholder="Location">
              <label for="counties">
              <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
              </label>
              <ul for="counties" class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-color--<?php primaryColor(); ?>" style="max-height: 300px !important; overflow-y: auto;">
              <?php
              $county_list = "baringo, bomet, bungoma, busia, elgeyo-marakwet, embu, garissa, homa bay, isiolo, kakamega, kajiado, kapenguria, kericho, kiambu, kilifi, kirinyanga, kisii, kisumu, kitui, kwale, laikipia, lamu, machakos, makueni, mandera, marsabit, meru, migori, mombasa, muranga, nairobi, nakuru, nandi, narok, nyamira, nyandarua, nyeri, ol kalou, samburu, siaya, taita-taveta, tana river, tharaka-nithi, trans-nzoia, turkana, uasin-gishu, vihiga, wajir, west pokot";
              $counties = explode( ", ", $county_list );
              for ( $c=0; $c < count( $counties ); $c++ ) {
              $label = ucwords( $counties[$c] );
              echo '<li class="mdl-menu__item" data-val="'.$counties[$c].'">'.$label.'</li>';
              }
              ?>
              </ul>
            </div>

            <div class="input-field mdl-cell--4-col">
              <i class="material-icons prefix">phone</i>
              <input  id="phone" name="phone" type="text" >
              <label for="phone" class="center-align">Phone Number</label>
            </div>

            <?php if ( $_GET['create'] !== "organization"  ) { ?>
              <div class="input-field mdl-cell--6-col mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">
                <i class="material-icons prefix">business</i>
                <input class="mdl-textfield__input" type="text" id="centers" name="company" readonly tabIndex="-1" placeholder="Organization ( Optional )">
                <ul for="centers" class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-color--<?php primaryColor(); ?>" style="max-height: 300px !important; overflow-y: auto;">
                <?php
                $centers = $GLOBALS['JBLDB'] -> query( "SELECT name, id FROM ". _DBPREFIX ."users WHERe ilk = 'center' ORDER BY name" );
                if ( $GLOBALS['JBLDB'] -> numRows( $centers ) > 0 ) {
                while ( $center = $GLOBALS['JBLDB'] -> fetchArray( $centers ) ) {
                echo '<li class="mdl-menu__item" data-val="'.$center['id'].'">'.$center['name'].'</li>';
                }
                }
                echo '<center>Your Organization Not Listed? <br><a href="./users?create=organization">Register it Now</a></center>'; ?>
                </ul>
              </div><?php
            } ?>

            <div class="input-field mdl-cell--6-col">
              <i class="material-icons prefix">mail</i>
              <input class="validate" id="email" name="email" type="email" >
              <label for="email" data-error="wrong" data-success="right" class="center-align">Email Address</label>
            </div>

            <div class="input-field mdl-cell--6-col">
              <i class="material-icons prefix">lock</i>
              <input id="password" name="password" type="text" >
              <label for="password">Password</label>
            </div>

            <div class="input-field mdl-cell--12-col">
              <i class="material-icons prefix">description</i>
              <textarea  id="details" name="details" type="text" class="materialize-textarea" rows="5">Details about <?php echo( $_GET['create'] ); ?>.</textarea>
              <label for="details" class="center-align">About</label>
            </div>

            <div class="center-align">
              <input type="checkbox" id="remember-me" name="state" value="active"/>
              <label for="remember-me">Activate Account</label>
            </div>
          </div>
          </div>
        <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone">
          <div style="height:0px; overflow:hidden">
            <input type="file" id="avatar" name="new_avatar" />
            <input type="hidden" name="the_avatar" value="<?php echo( _IMAGES.'avatar.svg' ); ?>" />
          </div>
          <img id="havatar" onclick="chooseFile();" src="<?php echo( _IMAGES.'avatar.svg' ); ?>" width="100%">

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
          <?php csrf(); ?>

          <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored addfab" type="submit" style="margin-left: 150px;margin-top: 100px;" name="register"><i class="material-icons">save</i></button>
        </div>
      </form>
    </div><?php
  }

  function editUserForm( $code ) {
    $getUserCode = $GLOBALS['JBLDB'] -> query( "SELECT * FROM ". _DBPREFIX ."users WHERE id = '".$code."'" );
    if ( $GLOBALS['JBLDB'] -> numRows( $getUserCode ) > 0 ) {
      while ( $userDetails = $GLOBALS['JBLDB'] -> fetchArray( $getUserCode ) ){
        $names = explode( " ", $userDetails['name'] );

        ?><title>Editing <?php echo( $userDetails['name'] ); ?> - <?php showOption( 'name' ); ?></title>
        <form enctype="multipart/form-data" name="registerUser" method="POST" action="" class="mdl-grid" >
              <div class="mdl-cell mdl-cell--12-col mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>">

                  <div class="mdl-card__supporting-text mdl-card--expand mdl-grid ">
                    <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone mdl-grid">

                      <div class="input-field mdl-cell mdl-cell--6-col">
                      <i class="material-icons prefix">label</i>
                      <input id="fname" name="fname" type="text" value="<?php echo( $names[0] ); ?>">
                      <label for="fname">First Name</label>
                      </div>

                      <div class="input-field mdl-cell mdl-cell--6-col">
                      <i class="material-icons prefix">label_outline</i>
                      <input id="lname" name="lname" type="text" value="<?php echo( $names[1] ); ?>">
                      <label for="lname">Last Name</label>
                      </div>

                      <div class="input-field inline mdl-js-textfield mdl-textfield--floating-label getmdl-select">
                      <i class="material-icons prefix">donut_large</i>
                       <input class="mdl-textfield__input" id="ilk" name="ilk" type="text" readonly tabIndex="-1" placeholder="<?php echo( ucfirst( $userDetails['ilk'] ) ); ?>" value="<?php echo( ucwords( $userDetails['ilk'] ) ); ?>">
                         <ul class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-color--<?php primaryColor(); ?>" for="ilk"><?php
                           if ( $_SESSION[JBLSALT.'Cap'] == "admin"  ) {
                            echo( '<li class="mdl-menu__item" data-val="admin">Admin</li>' );
                           } ?>
                     <li class="mdl-menu__item" data-val="organization">Organization<i class="mdl-color-text--white mdi mdi-city alignright" role="presentation"></i></li>
                     <li class="mdl-menu__item" data-val="editor">Editor<i class="mdl-color-text--white mdi mdi-note alignright" role="presentation"></i></li>
                     <li class="mdl-menu__item" data-val="author">Author<i class="mdl-color-text--white mdi mdi-note-plus alignright" role="presentation"></i></li>
                     <li class="mdl-menu__item" data-val="subscriber">Subscriber<i class="mdl-color-text--white mdi mdi-email alignright" role="presentation"></i></li>
                         </ul>
                      </div><br>

                      <?php if ( $userDetails['ilk'] !== "organization"  ) { ?>
                      <div class="input-field mdl-js-textfield mdl-textfield--floating-label getmdl-select">
                      <i class="mdi mdi-gender-<?php echo( strtolower( $userDetails['gender'] ) ); ?> prefix"></i>
                       <input class="mdl-textfield__input" id="gender" name="gender" type="text" readonly tabIndex="-1" placeholder="<?php echo( strtolower( $userDetails['gender'] ) ); ?>" value="<?php echo( ucwords( $userDetails['gender'] ) ); ?>">
                         <ul class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-color--<?php primaryColor(); ?>" for="gender">
                           <li class="mdl-menu__item" data-val="male">Male</li>
                           <li class="mdl-menu__item" data-val="female">Female</li>
                           <li class="mdl-menu__item" data-val="other">Other</li>
                         </ul>
                      </div><?php } ?>

                      <div class="input-field inline mdl-js-textfield getmdl-select getmdl-select__fix-height">
                        <i class="material-icons prefix">room</i>
                      <input class="mdl-textfield__input" type="text" id="counties" name="location" readonly tabIndex="-1" placeholder="<?php echo( ucwords( $userDetails['location'] ) ); ?>" value="<?php echo( ucwords( $userDetails['location'] ) ); ?>">
                      <ul for="counties" class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-color--<?php primaryColor(); ?>" style="max-height: 300px !important; overflow-y: auto;">
                          <?php
                          $county_list = "baringo, bomet, bungoma, busia, elgeyo-marakwet, embu, garissa, homa bay, isiolo, kakamega, kajiado, kapenguria, kericho, kiambu, kilifi, kirinyanga, kisii, kisumu, kitui, kwale, laikipia, lamu, machakos, makueni, mandera, marsabit, meru, migori, mombasa, muranga, nairobi, nakuru, nandi, narok, nyamira, nyandarua, nyeri, ol kalou, samburu, siaya, taita-taveta, tana river, tharaka-nithi, trans-nzoia, turkana, uasin-gishu, vihiga, wajir, west pokot";
                          $counties = explode( ", ", $county_list );
                          for ( $c=0; $c < count( $counties ); $c++ ) {
                              $label = ucwords( $counties[$c] );
                              echo '<li class="mdl-menu__item" data-val="'.$counties[$c].'">'.$label.'</li>';
                          }
                           ?>
                      </ul>
                      </div>

                      <div class="input-field mdl-cell mdl-cell--4-col">
                      <i class="material-icons prefix">phone</i>
                      <input  id="phone" name="phone" type="text" value="<?php echo( $userDetails['phone'] ); ?>">
                      <label for="phone" class="center-align">Phone Number</label>
                      </div>

                      <div class="input-field mdl-cell mdl-cell--6-col">
                      <i class="material-icons prefix">mail</i>
                      <input class="validate" id="email" name="email" type="email" value="<?php echo( $userDetails['email'] ); ?>">
                      <label for="email" class="center-align">Email Address</label>
                      </div>

                      <div class="input-field mdl-cell mdl-cell--12-col">
                      <i class="mdi mdi-bio prefix"></i>
                      <textarea class="materialize-textarea col s12" rows="5" id="details" name="details" >
                        <?php echo( $userDetails['details'] ); ?>
                      </textarea>
                      <script>CKEDITOR.replace( 'details' );</script>
                      </div><?php
                      $social = json_decode( $userDetails['social'] );
                      foreach ($social as $key => $value) { ?>
                      <div class="input-field mdl-cell mdl-cell--3-col">
                      <i class="fa fa-<?php echo( $key ); ?> prefix"></i>
                      <input id="<?php echo( $key ); ?>" name="social[<?php echo( $key ); ?>]" type="text" value="<?php echo( $value ); ?>">
                      <label for="<?php echo( $key ); ?>"><?php echo( ucwords( $key ) ); ?></label>
                      </div><?php } ?>

                      <br>
                      </div>

                    <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone">

                      <div style="height:0px;overflow:hidden">
                         <input type="file" id="avatar" name="new_avatar" />
                         <input type="hidden" id="the_avatar" name="the_avatar" value="<?php echo( $userDetails['avatar'] ); ?>" />
                      </div><?php $savatar = file_exists( $userDetails['avatar'] ) ?: _IMAGES.'avatar.svg'; ?>
                      <img id="havatar" onclick="chooseFile();" src="<?php echo( $savatar ); ?>" width="100%">

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

                      <div class="input-field">
                      <i class="material-icons prefix">lock</i>
                      <input id="password" name=="password" type="password" value="">
                      <label for="password">Change Password</label>
                      </div>

                      <center>
                      <div class="">
                      <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="switch-2">
                        <input type="checkbox" id="switch-2" class="mdl-switch__input" checked> <span style="padding-left: 20px;">Online/Offline</span>
                      </label>
                      </div>
                      <?php csrf(); ?>
                      <input type="hidden" name="id" value="<?php echo( $code ); ?>" >
                      <input type="hidden" name="style" value="<?php echo( $userDetails['style'] ); ?>" >
                      <input type="hidden" name="username" value="<?php echo( $userDetails['username'] ); ?>" >
                      <input type="hidden" name="categories" value="<?php echo( $userDetails['categories'] ); ?>" >
                      <input type="hidden" name="h_pass" value="<?php echo( $userDetails['password'] ); ?>" >
                          <button type="submit" name="update" class="mdl-button mdl-button--fab mdl-button--colored addfab"><i class="material-icons">save</i></button>
                      </center><br><br>

                    </div>
                  </div>
              </div>
        </form><?php
      }
    } else {
      echo 'User Not Found';
    }
  }


  function resourceForm() { ?>
        <title><?php echo( $resourceDetails['name'] ); ?> Create <?php echo( ucfirst( $_GET['create'] ) ); ?> - <?php showOption( 'name' ); ?></title>
        <div class="mdl-cell mdl-cell--12-col mdl-grid mdl-color--<?php primaryColor(); ?>">
        <form enctype="multipart/form-data" name="registerResource" method="POST" action="<?php echo( _ADMIN."resource?create=organization" ); ?>" class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone mdl-grid">
            <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone">

              <div class="input-field">
                <i class="material-icons prefix">label</i>
              <input id="name" name="name" type="text" >
              <label for="name">Resource Name</label>
              </div>

              <div class="input-field mdl-js-textfield mdl-textfield--floating-label getmdl-select">
                <i class="material-icons prefix">donut_large</i>
                 <input class="mdl-textfield__input" id="ilk" name="ilk" type="text" readonly tabIndex="-1" placeholder="Type" >
                   <ul class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-color--<?php primaryColor(); ?>" for="ilk">
                     <li class="mdl-menu__item" data-val="ambulance">Ambulance</li>
                     <li class="mdl-menu__item" data-val="lab">Lab</li>
                     <li class="mdl-menu__item" data-val="ward">Ward</li>
                     <li class="mdl-menu__item" data-val="morgue">Morgue</li>
                   </ul>
                </div>

              <div class="input-field mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">
                <i class="material-icons prefix">room</i>
              <input class="mdl-textfield__input" type="text" id="counties" name="location" readonly tabIndex="-1" value="<?php echo( ucwords( $_SESSION[JBLSALT.'Location'] ) ); ?>">
              <ul for="counties" class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-color--<?php primaryColor(); ?>" style="max-height: 300px !important; overflow-y: auto;">
                  <?php
                  $county_list = "baringo, bomet, bungoma, busia, elgeyo-marakwet, embu, garissa, homa bay, isiolo, kakamega, kajiado, kapenguria, kericho, kiambu, kilifi, kirinyanga, kisii, kisumu, kitui, kwale, laikipia, lamu, machakos, makueni, mandera, marsabit, meru, migori, mombasa, muranga, nairobi, nakuru, nandi, narok, nyamira, nyandarua, nyeri, ol kalou, samburu, siaya, taita-taveta, tana river, tharaka-nithi, trans-nzoia, turkana, uasin-gishu, vihiga, wajir, west pokot";
                  $counties = explode( ", ", $county_list );
                  for ( $c=0; $c < count( $counties ); $c++ ) {
                      $label = ucwords( $counties[$c] );
                      echo '<li class="mdl-menu__item" data-val="'.$counties[$c].'">'.$label.'</li>';
                  }
                   ?>
              </ul>
              </div>

              <div class="input-field mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">
                <i class="material-icons prefix">business</i>
              <input class="mdl-textfield__input" type="text" id="centers" name="company" readonly tabIndex="-1" placeholder="Organization">
              <ul for="centers" class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-color--<?php primaryColor(); ?>" style="max-height: 300px !important; overflow-y: auto;">
                  <?php
                  $centers = $GLOBALS['JBLDB'] -> query( "SELECT name, id FROM ". _DBPREFIX ."users WHERe ilk = 'center' ORDER BY name" );
                  if ( $GLOBALS['JBLDB'] -> numRows( $centers ) > 0 );
                  while ( $center = $GLOBALS['JBLDB'] -> fetchArray( $centers ) ) {
                      echo '<li class="mdl-menu__item" data-val="'.$center['id'].'">'.$center['name'].'</li>';
                  }
                   ?>
              </ul>
              </div>

              <div class="input-field inline">
                <i class="material-icons prefix">phone</i>
              <input  id="phone" name="phone" type="text" value="<?php echo( $_SESSION[JBLSALT.'Phone'] ); ?>" >
              <label for="phone" class="center-align">Contact Phone</label>
              </div>

              <div class="input-field inline">
                <i class="material-icons prefix">mail</i>
              <input class="validate" id="email" name="email " type="email" value="<?php echo( $_SESSION[JBLSALT.'Email'] ); ?>">
              <label for="email" data-error="wrong" data-success="right" class="center-align">Admin Email</label>
              </div>

              <div class="input-field mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">
                <i class="material-icons prefix">face</i>
              <input class="mdl-textfield__input" type="text" id="doctors" name="by" readonly tabIndex="-1" placeholder="Doctor In Charge">
              <ul for="doctors" class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-color--<?php primaryColor(); ?>" style="max-height: 300px !important; overflow-y: auto;">
                  <?php
                  $centers = $GLOBALS['JBLDB'] -> query( "SELECT name, id FROM ". _DBPREFIX ."users WHERe ilk = 'doctor' ORDER BY name" );
                  if ( $GLOBALS['JBLDB'] -> numRows( $centers ) > 0 );
                  while ( $center = $GLOBALS['JBLDB'] -> fetchArray( $centers ) ) {
                      echo '<li class="mdl-menu__item" data-val="'.$center['id'].'">'.$center['name'].'</li>';
                  }
                   ?>
              </ul>
              </div>
              <input type="hidden" name="author" value="<?php echo( $_SESSION[JBLSALT.'Code'] ); ?>">

              <div class="input-field">
                <i class="material-icons prefix">description</i>
              <textarea  id="details" name="details" type="text" class="materialize-textarea">Details about resource.</textarea>
              <label for="details" class="center-align">About</label>
              </div>

              <br>
            </div>
            <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone">
              <script>
                 function chooseFile() {
                    $( "#fileInput" ).click();
                 }
              </script>
              <div class="input-field inline">
                <div style="height:0px;overflow:hidden">
                  <input id="avatar" type="file" name="avatar" value="<?php echo( _IMAGES.'placeholder.svg' ); ?>">
                </div>
                <img id="havatar" onclick="chooseFile();" src="../assets/images/placeholder.svg" width="100%"></i>
                </div>
                <script>
                     function chooseFile() {
                        $( "#avatar" ).click();
                     }

                     function readURL(input ) {
                      if ( input.files && input.files[0]  ) {
                          var reader = new FileReader();

                          reader.onload = function (e ) {
                              $('#havatar' )
                                  .attr('src', e.target.result )
                                  .width(150 )
                                  .height(200 );
                          };

                          reader.readAsDataURL(input.files[0] );
                      }
                  }
                  </script>

              <div class="input-field">
                <input type="checkbox" id="remember-me" name="state" name="active"/>
                <label for="remember-me">Available</label>

              <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect alignright" type="submit" style="margin-left: 150px;margin-top: 100px;" name="register"><i class="material-icons">save</i></button>
              </div>
          </div>
        </form>
        </div><?php
  }

  function editResourceForm( $code ) {
    $getResourceCode = $GLOBALS['JBLDB'] -> query( "SELECT * FROM ". _DBPREFIX ."resources WHERE id = '".$code."'" );
    if ( $getResourceCode -> num_rows > 0 ) {
      while ( $resourceDetails = $GLOBALS['JBLDB'] -> fetchArray( $getResourceCode ) ){
        $names = explode( " ", $resourceDetails['name'] );

        ?><title>Editing <?php echo( $resourceDetails['name']." [ ".showOption( 'name' )." ]</title>" ); ?>
        <form enctype="multipart/form-data" name="registerResource" method="POST" action="<?php echo( _ADMIN.'resource?create' ); ?>" class="mdl-grid" >
          <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone">
              <div class="mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>">

                  <div class="mdl-card__supporting-text mdl-card--expand mdl-grid ">
                    <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone">

                      <div class="input-field">
                      <i class="material-icons prefix">label</i>
                      <input id="name" name="name" type="text" value="<?php echo( $resourceDetails['name'] ); ?>">
                      <label for="name">Resource Name</label>
                      </div>

                      <div class="input-field mdl-js-textfield mdl-textfield--floating-label getmdl-select">
                      <i class="material-icons prefix">business</i>
                       <input class="mdl-textfield__input" id="ilk" name="ilk" type="text" readonly tabIndex="-1" placeholder="<?php echo( ucwords( $resourceDetails['ilk'] ) ); ?>" value="<?php echo( ucwords( $resourceDetails['ilk'] ) ); ?>" >
                         <ul class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-color--<?php primaryColor(); ?>" for="ilk">
                           <li class="mdl-menu__item" data-val="center">Center</li>
                           <li class="mdl-menu__item" data-val="equipment">Equipment</li>
                           <li class="mdl-menu__item" data-val="lab">Lab</li>
                           <li class="mdl-menu__item" data-val="ward">Ward</li>
                         </ul>
                      </div>

                      <div class="input-field inline">
                      <i class="material-icons prefix">phone</i>
                      <input  id="phone" name="phone" type="text" value="<?php echo( $resourceDetails['phone'] ); ?>">
                      <label for="phone" class="center-align">Contact Phone</label>
                      </div>

                      <div class="input-field mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">
                        <i class="material-icons prefix">room</i>
                      <input class="mdl-textfield__input" type="text" id="counties" name="location" readonly tabIndex="-1" placeholder="<?php echo( ucwords( $resourceDetails['location'] ) ); ?>" value="<?php echo( ucwords( $resourceDetails['location'] ) ); ?>">
                      <ul for="counties" class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-color--<?php primaryColor(); ?>" style="max-height: 300px !important; overflow-y: auto;">
                          <?php
                          $county_list = "baringo, bomet, bungoma, busia, elgeyo-marakwet, embu, garissa, homa bay, isiolo, kakamega, kajiado, kapenguria, kericho, kiambu, kilifi, kirinyanga, kisii, kisumu, kitui, kwale, laikipia, lamu, machakos, makueni, mandera, marsabit, meru, migori, mombasa, muranga, nairobi, nakuru, nandi, narok, nyamira, nyandarua, nyeri, ol kalou, samburu, siaya, taita-taveta, tana river, tharaka-nithi, trans-nzoia, turkana, uasin-gishu, vihiga, wajir, west pokot";
                          $counties = explode( ", ", $county_list );
                          for ( $c=0; $c < count( $counties ); $c++ ) {
                              $label = ucwords( $counties[$c] );
                              echo '<li class="mdl-menu__item" data-val="'.$counties[$c].'">'.$label.'</li>';
                          }
                           ?>
                      </ul>
                      </div>

                      <?php if ( $resourceDetails['ilk'] !== "organization"  ) { ?>
                      <div class="input-field">
                      <i class="material-icons prefix">business</i>
                      <input id="company" name="company" type="text" value="<?php echo( $resourceDetails['company'] ); ?>">
                      <label for="company">Center</label>
                      </div>
                      <?php } ?>

                      <div class="input-field">
                      <i class="material-icons prefix">mail</i>
                      <input class="validate" id="email" name="email " type="email" value="<?php echo( $resourceDetails['email'] ); ?>">
                      <label for="email" class="center-align">Admin Email</label>
                      </div>

                      <div class="input-field">
                      <i class="mdi mdi-bio prefix"></i>
                      <textarea class="materialize-textarea col s12" rows="5" id="details" name="details" >
                      <?php echo( $resourceDetails['details'] ); ?>
                      </textarea>
                      <script>CKEDITOR.replace( 'details' );</script>
                      <label for="details">Bio</label>
                      </div>

                      <br>
                      </div>

                    <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone">
                    <script>
                     function chooseFile() {
                        $( "#avatar" ).click();
                     }
                   </script>
                      <div style="height:0px;overflow:hidden">
                         <input type="file" id="fileInput" name="avatar" />
                      </div>
                      <img id="havatar" onclick="chooseFile();" src="<?php echo( $resourceDetails['avatar'] ); ?>" width="100%" onclick="chooseFile();">

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
                      <span style="position: relative; bottom: 50px;left: 50%"><i class="material-icons">edit</i></span>
                      <center><br>

                      <div class="input-field">
                          <button type="submit" name="update" class="mdl-button mdl-button--fab"><i class="material-icons">save</i></button>
                      </div>
                      </center>
                    </div>
                  </div>
              </div>
          </div>
        </form><?php
      }
    } else {
      echo 'Resource Not Found';
    }
  }

} ?>
