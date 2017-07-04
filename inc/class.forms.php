<?php 
/**
* @package Jabali Framework
* @subpackage Forms Class
* @link https://docs.mauko.co.ke/jabali/classes/hforms
* @author Mauko Maunde
* @version 0.17.06
**/

class _hForms {

  function messageForm() { ?>
      <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone mdl-card mdl-shadow--2dp mdl-card--expand mdl-color--<?php primaryColor(); ?>">
          <div class="mdl-card__supporting-text mdl-card--expand">
              <form enctype="multipart/form-data" name="messageForm" method="POST" action="">
                <title>Compose <?php echo ucfirst( $_GET['create'] ); ?> [ <?php showOption( 'name' ); ?> ]</title>
                
                  <div class="input-field">
                    <i class="material-icons prefix">label</i>
                  <input id="subject" type="text" name="h_alias" >
                  <label for="subject" class="center-align">Subject</label>
                  </div>

                  <?php if ( $_GET['code']  ) { ?> <input type="hidden" name="h_for" value="<?php _show_( $_GET['code'] ); ?>"> <?php } else { ?>

                  <div class="input-field inline getmdl-select getmdl-select__fix-height">
                    <i class="material-icons prefix">perm_identity</i>
                  <input class="mdl-textfield__input" type="text" id="h_for" name="h_for" readonly tabIndex="-1" placeholder="Select Receipient">
                  <ul for="h_for" class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-color--<?php primaryColor(); ?>" style="max-height: 300px !important; overflow-y: auto;">
                      <?php 
                      $centers = mysqli_query( $GLOBALS['conn'], "SELECT h_alias, h_avatar, h_code FROM husers ORDER BY h_alias" );
                      if ( $centers -> num_rows > 0 );
                      while ( $center = mysqli_fetch_assoc( $centers ) ) {
                          echo '<li class="mdl-menu__item" data-val="'.$center['h_code'].'">'.$center['h_alias'].'<span style=""><img class="alignright" style="padding-right:20px;margin:auto;" src="'.$center['h_avatar'].'" height="18px;"></span></li>';
                      }
                       ?>
                  </ul>
                  </div><?php } ?>
                  <div class="input-field inline getmdl-select getmdl-select__fix-height">
                    <i class="material-icons prefix">perm_identity</i>
                  <input class="mdl-textfield__input" type="text" id="h_forc" name="h_forc" readonly tabIndex="-1" placeholder="Cc/Bcc">
                  <ul for="h_forc" class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-color--<?php primaryColor(); ?>" style="max-height: 300px !important; overflow-y: auto;">
                      <?php 
                      $centers = mysqli_query( $GLOBALS['conn'], "SELECT h_alias, h_avatar, h_code FROM husers ORDER BY h_alias" );
                      if ( $centers -> num_rows > 0 );
                      while ( $center = mysqli_fetch_assoc( $centers ) ) {
                          echo '<li class="mdl-menu__item" data-val="'.$center['h_code'].'">'.$center['h_alias'].'<span style=""><img class="alignright" style="padding-right:20px;margin:auto;" src="'.$center['h_avatar'].'" height="18px;"></span></li>';
                      }
                       ?>
                  </ul>
                  </div>

                  <input type="hidden" name="h_author" value="<?php echo $_SESSION['myCode']; ?>">
                  <input type="hidden" name="h_by" value="<?php echo $_SESSION['myAlias']; ?>">
                  <input type="hidden" name="h_email" value="<?php echo $_SESSION['myEmail']; ?>">
                  <input type="hidden" name="h_level" value="private">
                  <input type="hidden" name="h_phone" value="<?php echo $_SESSION['myPhone']; ?>">
                  <input type="hidden" name="h_type" value="<?php echo $_GET['create']; ?>">

                  <div class="input-field">
                  <p>Your Message</p>
                  <textarea class="materialize-textarea col s12" type="text" id="h_description" rows="5" name="h_description"></textarea><script>CKEDITOR.replace( 'h_description' );</script>
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
                  <button class="mdl-button mdl-button--fab alignright" type="submit" name="create"><i class="material-icons">send</i></button></div>
              </form>
          </div>
      </div><?php 
  }

  function contactForm() { ?>
    <div class="mdl-grid">
      <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone mdl-card mdl-shadow--2dp mdl-card--expand mdl-color--<?php if ( isset( $_SESSION['myCode'] ) ){ primaryColor(); } else { echo "grey"; } ?>">
          <div class="mdl-card__supporting-text mdl-card--expand">
            <form>
              <div class="input-field inline">
                <i class="material-icons prefix">perm_identity</i>
              <input id="h_by" name="h_by" type="text">
              <label for="h_by">Your Name</label>
              </div>

              <div class="input-field inline">
                <i class="material-icons prefix">mail_outline</i>
              <input id="h_email" name="h_email" type="text">
              <label for="h_email">Your Email</label>
              </div>

              <div class="input-field inline">
                <i class="material-icons prefix">phone</i>
              <input id="h_phone" name="h_phone" type="text">
              <label for="h_phone">Phone (Optional )</label>
              </div>

              <div class="input-field mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">
                <i class="material-icons prefix">room</i>
              <input class="mdl-textfield__input" type="text" id="counties" name="h_location" readonly tabIndex="-1" placeholder="Location (Optional )">
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
              <textarea class="materialize-textarea col s12" type="text" id="h_description" rows="5" name="h_description"></textarea><script>CKEDITOR.replace( 'h_description' );</script>
              </div><br>
              <button type="submit" name="" class="mdl-button mdl-button--fab alignright"><i  class="material-icons">send</i></button>
            </form>
          </div>
      </div>
    </div><?php 
  }

  function commentForm() { ?>
      <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone mdl-shadow--2dp mdl-color--<?php if ( isset( $_SESSION['myCode'] ) ){ primaryColor(); } else { echo "grey"; } ?>">
            <form class=" mdl-grid" method="POST" action="" style="width: 100%">
              <div class="input-field mdl-cell mdl-cell--6-col">
                <i class="material-icons prefix">perm_identity</i>
              <input id="h_by" name="h_by" type="text" value="<?php if ( isset( $_SESSION['myAlias'] ) ){ _show_( $_SESSION['myAlias'] ); } ?>">
              <label for="h_by">Your Name</label>
              </div>

              <div class="input-field mdl-cell mdl-cell--5-col">
                <i class="material-icons prefix">mail_outline</i>
              <input id="h_email" name="h_email" type="text" value="<?php if ( isset( $_SESSION['myEmail'] ) ){ _show_( $_SESSION['myEmail'] ); } ?>">
              <label for="h_email">Your Email</label>
              </div>

              <div class="input-field mdl-cell mdl-cell--10-col">
              <p>Your Message</p>
              <textarea class="materialize-textarea col s12" type="text" id="h_description" rows="5" name="h_description"></textarea><script>CKEDITOR.replace( 'h_description' );</script>
              </div><br>
              <button type="submit" name="" class="mdl-button mdl-button--fab alignright"><i  class="material-icons">send</i></button>
            </form>
      </div><?php 
  }

  function faqForm() { ?>
    <div class="mdl-card mdl-shadow--2dp mdl-card--expand mdl-color--<?php primaryColor(); ?>">
      <div class="mdl-card__supporting-text mdl-card--expand">
        <form>
        <div class="input-field inline">
          <i class="material-icons prefix">perm_identity</i>
        <input id="h_by" name="h_by" type="text">
        <label for="h_by">Your Name</label>
        </div>

        <div class="input-field inline">
          <i class="material-icons prefix">mail_outline</i>
        <input id="h_email" name="h_email" type="text">
        <label for="h_email">Your Email</label>
        </div>

        <div class="input-field inline">
          <i class="material-icons prefix">phone</i>
        <input id="h_phone" name="h_phone" type="text">
        <label for="h_phone">Phone (Optional )</label>
        </div>

        <div class="input-field mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">
          <i class="material-icons prefix">room</i>
        <input class="mdl-textfield__input" type="text" id="counties" name="h_location" readonly tabIndex="-1" placeholder="Location (Optional )">
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
          <i class="material-icons prefix">description</i>
        <input id="h_alias" name="h_alias" type="text">
        <label for="h_alias">Subject</label>
        </div>

        <div class="input-field">
        <p>Your Question</p>
        <textarea class="materialize-textarea col s12" type="text" id="h_description" rows="5" name="h_description"></textarea><script>CKEDITOR.replace( 'h_description' );</script>
        </div><br>
        <button type="submit" name="" class="mdl-button mdl-button--fab alignright"><i  class="material-icons">send</i></button>
        </form>
      </div>
    </div><?php 
  }

  function postForm() { ?>
    <title>New <?php echo ucfirst( $_GET['create'] ); ?> [ <?php showOption( 'name' ); ?> ]</title>
      <form enctype="multipart/form-data" name="postForm" method="POST" action="" style="width:100%;" class="mdl-grid">
        <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone mdl-grid mdl-card mdl-shadow--2dp mdl-card--expand mdl-color--<?php primaryColor(); ?>"><br><br>
          <div class="mdl-cell mdl-cell--12-col">
            <div class="input-field">
            <input id="h_alias" type="text" name="h_alias" >
            <label for="h_alias" data-error="wrong" data-success="right" class="center-align">Title</label>
            </div>

            <div class="input-field">
            <input id="h_subtitle" type="text" name="h_subtitle" >
            <label for="h_subtitle" data-error="wrong" data-success="right" class="center-align">Subtitle(Optional )</label>
            </div>

            <h6><?php echo ucfirst( $_GET['create'] ); ?> Content</h6>
            <textarea class="materialize-textarea col s12" type="text" id="message" rows="5" name="h_desc"></textarea><script>CKEDITOR.replace( 'message' );</script>

            <h6><?php echo ucfirst( $_GET['create'] ); ?> Notes</h6>
            <textarea class="materialize-textarea col s12" type="text" id="message" rows="5" name="h_notes"></textarea>
          </div>
        </div>
        <?php if ( !isset( $_GET['x']) ) { ?>
        <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone mdl-card mdl-shadow--2dp mdl-card--expand mdl-color--<?php primaryColor(); ?>">
          <div class="mdl-card__title">
            <i class="material-icons">details</i>
            <span class="mdl-button">Other Details</span>
            <div class="mdl-layout-spacer"></div>
            <div class="mdl-card__subtitle-text">
            <a href="?view=list&type=article">
              <i class="material-icons">clear</i>
            </a>
            </div>
          </div>
          <div class="mdl-card__supporting-text"><?php

            if ( $_GET['create'] !== "page" ) { ?>
              <div class="mdl-cell mdl-cell--12-col mdl-grid">
                <div class="input-field mdl-cell mdl-cell--6-col">
                <i class="material-icons prefix">label</i>
                <textarea id="h_tags" name="h_tags" class="materialize-textarea chips col s12"></textarea>
                <label for="h_tags" class="center-align">Tags</label>
                </div>

                <div class="input-field mdl-cell mdl-cell--6-col">
                <i class="material-icons prefix">label_outline</i>
                <textarea id="h_category" name="h_category" class="materialize-textarea col s12"></textarea>
                <label for="h_category" class="center-align">Categories</label>
                </div><?php 
            } ?>

              <div class="input-field mdl-cell mdl-cell--7-col">
                <i class="material-icons prefix">today</i>
                <input  id="h_created" name="h_created" type="text" value="<?php echo date( 'Y-m-d' ); ?>" >
                <label for="h_created" class="center-align">Publish Date</label>
                <script>
                  $(function() {
                  $("#h_created").datepicker({ dateFormat: "yy-mm-dd" }).val()
                  });
                </script>
              </div>

              <div class="input-field mdl-cell mdl-cell--5-col">
                <i class="material-icons prefix">schedule</i>
                <input  id="h_created_t" name="h_created_t" type="text" value="<?php echo date( 'H:i:s' ); ?>" >
                <label for="h_created_t" class="center-align">Time</label>
              </div>
              </div>

              <div class="input-field inline mdl-card mdl-shadow--2dp">
              <div style="height:0px;overflow:hidden">
                 <input type="file" id="h_avatar" name="h_avatar" />
              </div>
              <img id="havatar" onclick="chooseFile();" src="<?php _show_( hIMAGES.'placeholder.svg' ); ?>" width="100%">
                <label for="h_avatar" class="center-align">Featured Image</label>
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

            <input type="hidden" name="h_author" value="<?php echo $_SESSION['myCode']; ?>">
            <input type="hidden" name="h_by" value="<?php echo $_SESSION['myAlias']; ?>">
            <input type="hidden" name="h_email" value="<?php echo $_SESSION['myEmail']; ?>">
            <input type="hidden" name="h_level" value="public">
            <input type="hidden" name="h_key" value="<?php str_shuffle( generateCode() ); ?>">
            <input type="hidden" name="h_code" value="<?php substr( $h_key, rand(0, 15), 12 ); ?>">
            <input type="hidden" name="h_phone" value="<?php echo $_SESSION['myPhone']; ?>">
            <input type="hidden" name="h_status" value="published">
            <input type="hidden" name="h_type" value="<?php echo $_GET['create']; ?>">

            <div class="input-field">
              <button class="mdl-button mdl-button--fab alignright" type="submit" name="create"><i class="material-icons">save</i></button>
            </div>
        </div>
        </div>
      </form><?php 
        }
  }

  function editPostForm( $code ) {
    $getPostCode = mysqli_query( $GLOBALS['conn'], "SELECT * FROM hposts WHERE h_code = '".$code."'" );
    if ( $getPostCode -> num_rows > 0 ) {
      while ( $postDetails = mysqli_fetch_assoc( $getPostCode ) ){
        $names = explode( " ", $postDetails['h_alias'] ); ?>
        <title>Edit <?php _show_( $postDetails['h_alias'] ); ?> [ <?php showOption( 'name' ); ?> ]</title>
      <form enctype="multipart/form-data" name="postForm" method="POST" action="" style="width:100%;" class="mdl-grid">
          <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone mdl-grid mdl-card mdl-shadow--2dp mdl-card--expand mdl-color--<?php primaryColor(); ?>">
            <div class="mdl-cell mdl-cell--12-col mdl-grid">
              <div class="input-field mdl-cell mdl-cell--12-col">
              <i class="material-icons prefix">label</i>
              <input id="h_alias" type="text" name="h_alias" value="<?php _show_( $postDetails['h_alias'] ); ?>">
              <label for="h_alias" data-error="wrong" data-success="right" class="center-align">Title</label>
              </div>

              <div class="input-field mdl-cell mdl-cell--7-col">
              <i class="material-icons prefix">label_outline</i>
              <input id="h_subtitle" type="text" name="h_subtitle" value="<?php _show_( $postDetails['h_subtitle'] ); ?>">
              <label for="h_subtitle"  class="center-align">Subtitle</label>
              </div>


              <div class="input-field mdl-cell mdl-cell--5-col mdl-grid">
              <i class="material-icons prefix">link</i>
                <input id="h_link" type="text" name="h_link" value="<?php _show_( $postDetails['h_link'] ); ?>">
                <label for="h_link"  class="center-align"><?php _show_( hROOT ); ?></label>
              </div>

              <div class="input-field mdl-cell mdl-cell--12-col">
              <h6><?php echo ucfirst( $postDetails['h_type'] ); ?> Content</h6>
              <textarea class="materialize-textarea col s12" type="text" id="message" rows="5" name="h_desc">
                <?php _show_( $postDetails['h_description'] ); ?>
              </textarea><script>CKEDITOR.replace( 'message' );</script>
              </div>

              <div class="input-field mdl-cell mdl-cell--12-col">
              <h6><?php echo ucfirst( $postDetails['h_type'] ); ?> Notes</h6>
              <textarea class="materialize-textarea col s12" type="text" id="message" rows="5" name="h_notes">
                <?php _show_( $postDetails['h_notes'] ); ?>
                  
                </textarea>
              </div>
            </div>

            <div class="mdl-card__menu mdl-button mdl-button--icon">
            <a href="<?php _show_( hROOT.$postDetails['h_link'] ); ?>" target="_blank" >
              <i class="material-icons">open_in_new</i>
            </a>
            </div>
          </div>
        <?php if ( !isset( $_GET['x']) ) { ?>
        <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone mdl-card mdl-shadow--2dp mdl-card--expand mdl-color--<?php primaryColor(); ?>">
          <div class="mdl-card__title">
            <i class="material-icons">details</i>
            <span class="mdl-button">Other Details</span>
            <div class="mdl-layout-spacer"></div>
            <div class="mdl-card__subtitle-text">
            <a href="?delete=<?php _show_( $postDetails['h_code'] ); ?>">
              <i class="material-icons">delete</i>
            </a>
            </div>
          </div>
          <div class="mdl-card__supporting-text">

              <?php 
              if ( $postDetails['h_type'] !== "page"  ) { ?>

              <div class="input-field">
              <i class="mdi mdi-tag-multiple prefix"></i>
              <textarea id="h_tags" name="h_tags" class="materialize-textarea col s12"><?php _show_( $postDetails['h_tags'] ); ?></textarea>
              <label for="h_tags" class="center-align">Tags</label>
              </div>

              <div class="input-field">
              <i class="mdi mdi-format-list-bulleted-type prefix"></i>
              <textarea id="h_category" name="h_category" class="materialize-textarea col s12"><?php _show_( $postDetails['h_category'] ); ?></textarea>
              <label for="h_category" class="center-align">Categories</label>
              </div><?php 
              }  
              $date = $postDetails['h_created'];
              $date = explode(" ", $date); ?>

              <div class="mdl-grid">
              <div class="input-field mdl-cell mdl-cell--6-col">
              <i class="material-icons prefix">today</i>
                <input type="text" id="h_created" name="h_created" value="<?php _show_( $date[0] ); ?>" >
                <script>
                  $(function() {
                  $("#h_created").datepicker({ dateFormat: "yy-mm-dd" }).val()
                  });
                </script>
              <label for="h_created" class="center-align">Published on</label>
              </div>

              <div class="input-field mdl-cell mdl-cell--6-col">
              <i class="material-icons prefix">schedule</i>
                <input type="text" id="h_created_t" name="h_created_t" value="<?php _show_( $date[1] ); ?>" >
              <label for="h_created_t" class="center-align">at</label>
              </div>
              </div>
              <p>Author: <a href="./user?view=<?php _show_( $postDetails['h_author'] ); ?>&key=<?php _show_( $postDetails['h_by'] ); ?>"><?php _show_( $postDetails['h_by'] ); ?></a></p>

              <div class="input-field inline mdl-card mdl-shadow--2dp">
              <div style="height:0px;overflow:hidden">
                 <input type="file" id="h_avatar" name="h_avatar" value="<?php _show_( $postDetails['h_avatar'] ); ?>" />
              </div>
              <img id="havatar" onclick="chooseFile();" src="<?php _show_( $postDetails['h_avatar'] ); ?>" width="100%">
                <label for="h_avatar" class="center-align">Featured Image</label>
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

              <input type="hidden" name="h_author" value="<?php _show_( $postDetails['h_author'] ); ?>">
              <input type="hidden" name="h_by" value="<?php _show_( $postDetails['h_by'] ); ?>">
              <input type="hidden" name="h_organization" value="<?php _show_( $postDetails['h_organization'] ); ?>">
              <input type="hidden" name="h_level" value="public">
              <input type="hidden" name="h_key" value="<?php _show_( $postDetails['h_key'] ); ?>">
              <input type="hidden" name="h_code" value="<?php _show_( $postDetails['h_code'] ); ?>">
              <input type="hidden" name="h_location" value="<?php _show_( $postDetails['h_location'] ); ?>">
              <input type="hidden" name="h_phone" value="<?php _show_( $postDetails['h_phone'] ); ?>">
              <input type="hidden" name="h_status" value="published">
              <input type="hidden" name="h_type" value="<?php _show_( $postDetails['h_type'] ); ?>">
              <input type="hidden" name="h_updated" value="<?php _show_( date('Y-m-d') ); ?>">

            <div class="input-field">
              <button class="mdl-button mdl-button--fab alignright" type="submit" name="update"><i class="material-icons">save</i></button>
            </div>
        </div>
        </div>
      </form><?php 
        }
      } 
    } else {
      echo 'The Post No Longer Exists.';
    }
  }

  function ccommentForm() {
    $getUser = mysqli_query( $GLOBALS['conn'], "SELECT * FROM husers WHERE h_code = '".$GET['code']."'" );
    $h_email = "";
    if ( $getUser -> num_rows > 0 ) {
        while ( $userDeets = mysqli_fetch_assoc( $getUser ) ){
                $userDeet[] = $userDeets;
            }
    }
      
    ?><div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone mdl-card mdl-shadow--2dp mdl-card--expand mdl-color--<?php primaryColor(); ?>">
                <div class="mdl-card__supporting-text mdl-card--expand">
                    <form enctype="multipart/form-data" name="messageForm" method="POST" action="">
                      <title>New Notification</title>
                        <div class="input-field">
                        <input id="subject" type="text" name="h_alias" >
                        <label for="email" data-error="wrong" data-success="right" class="center-align">Subject</label>
                        </div>

                        <div class="input-field">
                        <input id="for" type="text" name="h_for" value="" >
                        <label for="for" data-error="wrong" data-success="right" class="center-align">For</label>
                        </div>

                          <input type="hidden" name="h_author" value="<?php echo $_SESSION['myCode']; ?>">
                          <input type="hidden" name="h_by" value="<?php echo $_SESSION['myAlias']; ?>">
                          <input type="hidden" name="h_email" value="<?php echo $_SESSION['myEmail']; ?>">
                          <input type="hidden" name="h_level" value="private">
                          <input type="hidden" name="h_phone" value="<?php echo $_SESSION['myPhone']; ?>">
                          <input type="hidden" name="h_type" value="<?php echo $_GET['create']; ?>">

                        <div class="input-field">
                        <textarea class="materialize-textarea col s12" id="message" rows="5" name="h_desc"></textarea><script>CKEDITOR.replace( 'message' );</script>
                        <label for="message" class="center-align">Your Note</label>
                        </div>

                        <div class="input-field">
                        <button class="mdl-button mdl-button--fab alignright" type="submit" name="create"><i class="material-icons">send</i></button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone mdl-color--<?php primaryColor(); ?> mdl-card mdl-shadow--2dp mdl-card--expand"><?php 
                  $getNotes = mysqli_query( $GLOBALS['conn'], "SELECT * FROM hcomments LIMIT 5" );
                  if ( $getNotes -> num_rows >= 0 ) { ?>
                    <div class="mdl-card__title">
                    <i class="material-icons">query_builder</i>
                      <span class="mdl-button">Recent Notifications</span>
                    <div class="mdl-layout-spacer"></div>
                      <div class="mdl-card__subtitle-text">
                        <i class="material-icons">notifications</i>
                      </div>
                    </div>
                    <div class="mdl-card__supporting-text">
                      <ul class="collapsible popout" data-collapsible="accordion"><?php 
                          while ( $note = mysqli_fetch_assoc( $getNotes ) ) { ?>
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
                    </ul>
                    </div><?
                  } else {
                  echo '<div class="mdl-card__title">
        <i class="material-icons">notifications_none</i>
          <span class="mdl-button">No Recent Notifications</span>
            <div class="mdl-layout-spacer">';
                }
              ?>><?php 
  }

  function userForm() { ?>
        <title>Add New <?php _show_( ucfirst( $_GET['create'] ) ); ?> [ <?php showOption( 'name' ); ?> ]</title>
        <div class="mdl-cell mdl-cell--12-col mdl-grid mdl-color--<?php primaryColor(); ?>">
        <form enctype="multipart/form-data" name="registerUser" method="POST" action="<?php _show_( hADMIN.'user?create' ); ?>" class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone mdl-grid">
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
                 <input class="mdl-textfield__input" id="h_type" name="h_type" type="text" readonly tabIndex="-1" placeholder="<?php 
                 if ( isset( $_GET['create'] ) ) {
                   _show_( ucwords( $_GET['create'] ) );
                  } ?>" value="<?php if ( isset( $_GET['create'] ) ) {
                   _show_( ucwords( $_GET['create'] ) );
                  } ?>" >
                  <label for="h_type">
               <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
              </label>
                   <ul class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-color--<?php primaryColor(); ?>" for="h_type"><?php 
                     if ( $_SESSION['myCap'] == "admin"  ) {
                      _show_( '<li class="mdl-menu__item" data-val="admin">Admin<i class="mdl-color-text--white mdi mdi-lock alignright" role="presentation"></i></li>' );
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
                 <input class="mdl-textfield__input" id="h_gender" name="h_gender" type="text" readonly tabIndex="-1" placeholder="Gender" >
                 <label for="h_gender">
               <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
              </label>
                   <ul class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-color--<?php primaryColor(); ?>" for="h_gender">
                     <li class="mdl-menu__item" data-val="male">Male</li>
                     <li class="mdl-menu__item" data-val="female">Female</li>
                     <li class="mdl-menu__item" data-val="other">Other</li>
                   </ul>
                </div><?php } ?>

              <div class="input-field mdl-cell--4-col mdl-js-textfield getmdl-select getmdl-select__fix-height">
                <i class="material-icons prefix">room</i>
              <input class="mdl-textfield__input" type="text" id="counties" name="h_location" readonly tabIndex="-1" placeholder="Location">
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
              <input  id="h_phone" name="h_phone" type="text" >
              <label for="h_phone" class="center-align">Phone Number</label>
              </div>

              <?php if ( $_GET['create'] !== "organization"  ) { ?>
              <div class="input-field mdl-cell--6-col mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">
                <i class="material-icons prefix">business</i>
              <input class="mdl-textfield__input" type="text" id="centers" name="h_organization" readonly tabIndex="-1" placeholder="Organization ( Optional )">
              <ul for="centers" class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-color--<?php primaryColor(); ?>" style="max-height: 300px !important; overflow-y: auto;">
                <?php 
                  $centers = mysqli_query( $GLOBALS['conn'], "SELECT h_alias, h_code FROM husers WHERe h_type = 'center' ORDER BY h_alias" );
                  if ( $centers -> num_rows > 0 ) {
                    while ( $center = mysqli_fetch_assoc( $centers ) ) {
                        echo '<li class="mdl-menu__item" data-val="'.$center['h_code'].'">'.$center['h_alias'].'</li>';
                    }
                  }
                  echo '<center>Your Organization Not Listed? <br><a href="./user?create=organization">Register it Now</a></center>'; ?>
              </ul>
              </div><?php } ?>

              <div class="input-field mdl-cell--6-col">
                <i class="material-icons prefix">mail</i>
              <input class="validate" id="email" name="h_email" type="email" >
              <label for="email" data-error="wrong" data-success="right" class="center-align">Email Address</label>
              </div>

              <div class="input-field mdl-cell--6-col">
                <i class="material-icons prefix">lock</i>
              <input id="password" name=="h_password" type="text" >
              <label for="password">Password</label>
              </div>

              <div class="input-field mdl-cell--12-col">
                <i class="material-icons prefix">description</i>
              <textarea  id="h_description" name="h_description" type="text" class="materialize-textarea" rows="5">Details about <?php _show_( $_GET['create'] ); ?>.</textarea>
              <label for="h_description" class="center-align">About</label>
              </div>

              <div class="input-field center-align">
                <input type="checkbox" id="remember-me" name="h_status" value="active"/>
                <label for="remember-me">Activate Account</label>
              </div>

              <br>
            </div>
            </div>
            <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone">
              <div style="height:0px;overflow:hidden">
                 <input type="file" id="h_avatar" name="h_avatar" />
              </div>
              <img id="havatar" onclick="chooseFile();" src="<?php _show_( hIMAGES.'avatar.svg' ); ?>" width="100%">

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

              <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect" type="submit" style="margin-left: 150px;margin-top: 100px;" name="register"><i class="material-icons">save</i></button>  
          </div>
        </form>
        </div><?php 
  }

  function editUserForm( $code ) {
    $getUserCode = mysqli_query( $GLOBALS['conn'], "SELECT * FROM husers WHERE h_code = '".$code."'" );
    if ( $getUserCode -> num_rows > 0 ) {
      while ( $userDetails = mysqli_fetch_assoc( $getUserCode ) ){
        $names = explode( " ", $userDetails['h_alias'] );

        ?><title>Editing <?php _show_( $userDetails['h_alias'] ); ?> [ <?php showOption( 'name' ); ?> ]</title>
        <form enctype="multipart/form-data" name="registerUser" method="POST" action="<?php _show_( hADMIN.'user?view='.$code.'&key='.$userDetails['h_alias'] ); ?>" class="mdl-grid" >
          <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone">
              <div class="mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>">

                  <div class="mdl-card__supporting-text mdl-card--expand mdl-grid ">
                    <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone mdl-grid">

                      <div class="input-field mdl-cell mdl-cell--6-col">
                      <i class="material-icons prefix">label</i>
                      <input id="fname" name="fname" type="text" value="<?php _show_( $names[0] ); ?>">
                      <label for="fname">First Name</label>
                      </div>
                             
                      <div class="input-field mdl-cell mdl-cell--6-col">
                      <i class="material-icons prefix">label_outline</i>
                      <input id="lname" name="lname" type="text" value="<?php _show_( $names[1] ); ?>">
                      <label for="lname">Last Name</label>
                      </div>

                      <div class="input-field inline mdl-js-textfield mdl-textfield--floating-label getmdl-select">
                      <i class="material-icons prefix">donut_large</i>
                       <input class="mdl-textfield__input" id="h_type" name="h_type" type="text" readonly tabIndex="-1" placeholder="<?php _show_( ucfirst( $userDetails['h_type'] ) ); ?>" value="<?php _show_( ucwords( $userDetails['h_type'] ) ); ?>">
                         <ul class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-color--<?php primaryColor(); ?>" for="h_type"><?php 
                           if ( $_SESSION['myCap'] == "admin"  ) {
                            _show_( '<li class="mdl-menu__item" data-val="admin">Admin</li>' );
                           } ?>
                     <li class="mdl-menu__item" data-val="organization">Organization<i class="mdl-color-text--white mdi mdi-city alignright" role="presentation"></i></li>
                     <li class="mdl-menu__item" data-val="editor">Editor<i class="mdl-color-text--white mdi mdi-note alignright" role="presentation"></i></li>
                     <li class="mdl-menu__item" data-val="author">Author<i class="mdl-color-text--white mdi mdi-note-plus alignright" role="presentation"></i></li>
                     <li class="mdl-menu__item" data-val="subscriber">Subscriber<i class="mdl-color-text--white mdi mdi-email alignright" role="presentation"></i></li>
                         </ul>
                      </div><br>

                      <?php if ( $userDetails['h_type'] !== "organization"  ) { ?>                             
                      <div class="input-field mdl-js-textfield mdl-textfield--floating-label getmdl-select">
                      <i class="mdi mdi-gender-transgender prefix"></i>
                       <input class="mdl-textfield__input" id="h_gender" name="h_gender" type="text" readonly tabIndex="-1" placeholder="<?php _show_( ucfirst( $userDetails['h_gender'] ) ); ?>" value="<?php _show_( ucwords( $userDetails['h_gender'] ) ); ?>">
                         <ul class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-color--<?php primaryColor(); ?>" for="h_gender">
                           <li class="mdl-menu__item" data-val="male">Male</li>
                           <li class="mdl-menu__item" data-val="female">Female</li>
                           <li class="mdl-menu__item" data-val="other">Other</li>
                         </ul>
                      </div><?php } ?>

                      <div class="input-field inline mdl-js-textfield getmdl-select getmdl-select__fix-height">
                        <i class="material-icons prefix">room</i>
                      <input class="mdl-textfield__input" type="text" id="counties" name="h_location" readonly tabIndex="-1" placeholder="<?php _show_( ucwords( $userDetails['h_location'] ) ); ?>" value="<?php _show_( ucwords( $userDetails['h_location'] ) ); ?>">
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
                      <input  id="h_phone" name="h_phone" type="text" value="<?php _show_( $userDetails['h_phone'] ); ?>">
                      <label for="h_phone" class="center-align">Phone Number</label>
                      </div>

                      <div class="input-field mdl-cell mdl-cell--6-col">
                      <i class="material-icons prefix">mail</i>
                      <input class="validate" id="email" name="h_email" type="email" value="<?php _show_( $userDetails['h_email'] ); ?>">
                      <label for="email" class="center-align">Email Address</label>
                      </div>

                      <div class="input-field mdl-cell mdl-cell--12-col">
                      <i class="mdi mdi-bio prefix"></i>
                      <textarea class="materialize-textarea col s12" rows="5" id="h_description" name="h_description" >
                        <?php _show_( $userDetails['h_description'] ); ?>
                      </textarea>
                      <script>CKEDITOR.replace( 'h_description' );</script>
                      </div><?php 
                      $social = json_decode( $userDetails['h_social'] );
                      foreach ($social as $key => $value) { ?>
                      <div class="input-field mdl-cell mdl-cell--3-col">
                      <i class="fa fa-<?php _show_( $key ); ?> prefix"></i>
                      <input id="<?php _show_( $key ); ?>" name="<?php _show_( $key ); ?>" type="text" value="<?php _show_( $value ); ?>">
                      <label for="<?php _show_( $key ); ?>"><?php _show_( ucwords( $key ) ); ?></label>
                      </div><?php } ?>

                      <br>
                      </div>

                    <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone">
                    
                      <div style="height:0px;overflow:hidden">
                         <input type="file" id="h_avatar" name="h_avatar" />
                      </div>
                      <img id="havatar" onclick="chooseFile();" src="<?php _show_( $userDetails['h_avatar'] ); ?>" width="100%">

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



                      <?php if ( $userDetails['h_type'] !== "organization"  ) { ?>
                      <div class="input-field mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">
                        <i class="material-icons prefix">business</i>
                      <input class="mdl-textfield__input" type="text" id="centers" name="h_organization" readonly tabIndex="-1" placeholder="Change Center">
                      <ul for="centers" class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-color--<?php primaryColor(); ?>" style="max-height: 300px !important; overflow-y: auto;">
                          <?php 
                          $centers = mysqli_query( $GLOBALS['conn'], "SELECT h_alias, h_code FROM husers WHERe h_type = 'center' ORDER BY h_alias" );
                          if ( $centers -> num_rows > 0 ) {
                            while ( $center = mysqli_fetch_assoc( $centers ) ) {
                                echo '<li class="mdl-menu__item" data-val="'.$center['h_code'].'">'.$center['h_alias'].'</li>';
                            }
                          }
                          echo '<center>Your Organization Not Listed? <br><a href="./user?create=center">Register it Now</a></center>'; ?>
                      </ul>
                      </div><?php } ?>

                      <div class="input-field">
                      <i class="material-icons prefix">lock</i>
                      <input id="password" name=="h_password" type="password" value="">
                      <label for="password">Change Password</label>
                      </div>

                      <center>
                      <div class="input-field">
                      <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="switch-2">
                        <input type="checkbox" id="switch-2" class="mdl-switch__input" checked> <span style="padding-left: 20px;">Online/Offline</span>         
                      </label>
                      </div>
                      <input type="hidden" name="h_code" value="<?php _show_( $code ); ?>" >
                      <input type="hidden" name="h_pass" value="<?php _show_( $userDetails['h_password'] ); ?>" >
                          <button type="submit" name="update" class="mdl-button mdl-button--fab alignright"><i class="material-icons">save</i></button>
                      </center><br><br>

                    </div>
                  </div>
              </div>
          </div>
        </form><?php 
      }
    } else {
      echo 'User Not Found';
    }
  }

  function serviceForm() { ?>
        <title>Create <?php _show_( ucfirst( $_GET['create'] ) ); ?> [ <?php showOption( 'name' ); ?> ]</title>
        <div class="mdl-cell mdl-cell--12-col mdl-grid mdl-color--<?php primaryColor(); ?>">
        <form enctype="multipart/form-data" name="registerService" method="POST" action="<?php _show_( hADMIN.'service?create' ); ?>" class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone mdl-grid">
            <div class="mdl-cell mdl-cell--6-col-desktop mdl-cell--6-col-tablet mdl-cell--12-col-phone">

              <div class="input-field">
              <i class="material-icons prefix">label</i>
              <input id="h_alias" name="h_alias" type="text" value="Request for Service" >
              <label for="h_alias">Subject</label>
              </div> 

              <input type="hidden" name="h_author" value="<?php _show_( $_SESSION['myCode'] ); ?>" >
              <input type="hidden" name="h_by" value="<?php _show_( $_SESSION['myAlias'] ); ?>" >

              <div class="input-field mdl-js-textfield mdl-textfield--floating-label getmdl-select">
                <i class="material-icons prefix">perm_identity</i>
                 <input class="mdl-textfield__input" id="h_type" name="h_type" type="text" readonly tabIndex="-1" placeholder="<?php _show_( ucwords( $_SESSION['myCap'] ) ); ?>" data-val="<?php _show_( $_SESSION['myCap'] ); ?>">
                   <ul class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-color--<?php primaryColor(); ?>" for="h_type">
                     <li class="mdl-menu__item" data-val="doctor">Doctor</li>
                     <li class="mdl-menu__item" data-val="center">Center</li>
                     <li class="mdl-menu__item" data-val="nurse">Nurse</li>
                     <li class="mdl-menu__item" data-val="patient">Patient</li>
                   </ul>
                </div>

                <div class="input-field mdl-js-textfield mdl-textfield--floating-label getmdl-select">
                  <i class="mdi mdi-adjust prefix"></i>
                   <input class="mdl-textfield__input" id="h_gender" name="h_gender" type="text" readonly tabIndex="-1" placeholder="<?php _show_( ucwords( $_GET['create'] ) ); ?>" data-val="<?php _show_( $_GET['create'] ); ?>">
                     <ul class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-color--<?php primaryColor(); ?>" for="h_gender">
                       <li class="mdl-menu__item" data-val="request">Request</li>
                       <li class="mdl-menu__item" data-val="confirmation">Confirmation</li>
                       <li class="mdl-menu__item" data-val="followup">Follow Up</li>
                     </ul>
                  </div>

              <div class="input-field mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">
                <i class="material-icons prefix">room</i>
              <input class="mdl-textfield__input" type="text" id="counties" name="h_location" readonly tabIndex="-1" placeholder="<?php _show_( ucwords( $_SESSION['myLocation'] ) ); ?>" data-val="<?php _show_( $_SESSION['myLocation'] ); ?>">
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

              <div class="input-field mdl-js-textfield mdl-textfield--floating-label">
                <i class="material-icons prefix">phone</i>
              <input  id="h_phone" name="h_phone" type="text" value="<?php _show_( $_SESSION['myPhone'] ); ?>">
              <label for="h_phone" class="center-align">Phone Number</label>
              </div>


              <div class="input-field mdl-js-textfield mdl-textfield--floating-label">
                <i class="material-icons prefix">business</i>
              <input id="h_organization" name="h_organization" type="text" value="<?php _show_( $_SESSION['myOrg'] ); ?>">
              <label for="h_organization">Center</label>
              </div>

              <div class="input-field mdl-js-textfield mdl-textfield--floating-label">
                <i class="material-icons prefix">mail</i>
              <input class="validate" id="email" name="h_email" type="email" value="<?php _show_( $_SESSION['myEmail'] ); ?>">
              <label for="email" data-error="wrong" data-success="right" class="center-align">Email Address</label>
              </div>

              <br>
            </div>
            <div class="mdl-cell mdl-cell--6-col-desktop mdl-cell--6-col-tablet mdl-cell--12-col-phone">                      
              <div class="input-field">
              <i class="mdi mdi-note-plus prefix"></i>
              <textarea class="materialize-textarea col s12" rows="5" id="h_notes" name="h_notes" >
                Add your notes here.
              </textarea>
              <script>CKEDITOR.replace( 'h_notes' );</script>
              </div>

              <button class="mdl-button mdl-button--fab mdl-js-button mdl-js-ripple-effect" type="submit" style="margin-left: 150px;margin-top: 100px;" name="create"><i class="material-icons">send</i></button>  
          </div>
        </form>
        </div><?php 
  }

  function editServiceForm( $code ) {
    $getUserCode = mysqli_query( $GLOBALS['conn'], "SELECT * FROM husers WHERE h_code = '".$code."'" );
    if ( $getUserCode -> num_rows > 0 ) {
      while ( $userDetails = mysqli_fetch_assoc( $getUserCode ) ){
        $names = explode( " ", $userDetails['h_alias'] );

        ?><title>Editing <?php _show_( $userDetails['h_alias']." [ ".showOption( 'name' )." ]</title>" ); ?>
        <form enctype="multipart/form-data" name="registerUser" method="POST" action="<?php _show_( hADMIN.'user?create' ); ?>" class="mdl-grid" >
          <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone">
              <div class="mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>">

                  <div class="mdl-card__supporting-text mdl-card--expand mdl-grid ">
                    <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone">

                      <div class="input-field inline">
                      <i class="material-icons prefix">label</i>
                      <input id="fname" name="fname" type="text" value="<?php _show_( $names[0] ); ?>">
                      <label for="fname">First Name</label>
                      </div>
                             
                      <div class="input-field inline">
                      <i class="material-icons prefix">label_outline</i>
                      <input id="lname" name="lname" type="text" value="<?php _show_( $names[1] ); ?>">
                      <label for="lname">Last Name</label>
                      </div>

                      <div class="input-field mdl-js-textfield mdl-textfield--floating-label getmdl-select">
                      <i class="material-icons prefix">perm_identity</i>
                       <input class="mdl-textfield__input" id="h_type" name="h_type" type="text" readonly tabIndex="-1" placeholder="<?php _show_( ucfirst( $userDetails['h_type'] ) ); ?>" value="<?php _show_( ucwords( $userDetails['h_type'] ) ); ?>">
                         <ul class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-color--<?php primaryColor(); ?>" for="h_type">
                           <li class="mdl-menu__item" data-val="doctor">Doctor</li>
                           <li class="mdl-menu__item" data-val="center">Center</li>
                           <li class="mdl-menu__item" data-val="nurse">Nurse</li>
                           <li class="mdl-menu__item" data-val="patient">Patient</li>
                         </ul>
                      </div>
                             
                      <div class="input-field mdl-js-textfield mdl-textfield--floating-label getmdl-select">
                      <i class="mdi mdi-gender-transgender prefix"></i>
                       <input class="mdl-textfield__input" id="h_gender" name="h_gender" type="text" readonly tabIndex="-1" placeholder="<?php _show_( ucfirst( $userDetails['h_gender'] ) ); ?>" value="<?php _show_( ucwords( $userDetails['h_gender'] ) ); ?>">
                         <ul class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-color--<?php primaryColor(); ?>" for="h_gender">
                           <li class="mdl-menu__item" data-val="male">Male</li>
                           <li class="mdl-menu__item" data-val="female">Female</li>
                           <li class="mdl-menu__item" data-val="other">Other</li>
                         </ul>
                      </div>

                      <div class="input-field inline">
                      <i class="material-icons prefix">phone</i>
                      <input  id="h_phone" name="h_phone" type="text" value="<?php _show_( $userDetails['h_phone'] ); ?>">
                      <label for="h_phone" class="center-align">Phone Number</label>
                      </div>

                      <div class="input-field mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">
                        <i class="material-icons prefix">room</i>
                      <input class="mdl-textfield__input" type="text" id="counties" name="h_location" readonly tabIndex="-1" placeholder="<?php _show_( ucwords( $userDetails['h_location'] ) ); ?>" value="<?php _show_( ucwords( $userDetails['h_location'] ) ); ?>">
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
                      <i class="material-icons prefix">business</i>
                      <input id="h_organization" name="h_organization" type="text" value="<?php _show_( $userDetails['h_organization'] ); ?>">
                      <label for="h_organization">Center</label>
                      </div>

                      <div class="input-field">
                      <i class="material-icons prefix">mail</i>
                      <input class="validate" id="email" name="h_email" type="email" value="<?php _show_( $userDetails['h_email'] ); ?>">
                      <label for="email" class="center-align">Email Address</label>
                      </div>

                      <div class="input-field">
                      <i class="mdi mdi-bio prefix"></i>
                      <textarea class="materialize-textarea col s12" rows="5" id="h_description" name="h_description" >
                      <?php _show_( $userDetails['h_description'] ); ?>
                      </textarea>
                      <script>CKEDITOR.replace( 'h_description' );</script>
                      <label for="h_description">Notes</label>
                      </div>

                      <br>
                      </div>

                    <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone">
                    <script>
                     function chooseFile() {
                        $( "#h_avatar" ).click();
                     }
                   </script>
                      <div style="height:0px;overflow:hidden">
                         <input type="file" id="fileInput" name="h_avatar" />
                      </div>
                      <img id="havatar" onclick="chooseFile();" src="<?php _show_( $userDetails['h_avatar'] ); ?>" width="100%" onclick="chooseFile();">

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
                      <center>
                      <div class="input-field">
                      <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="switch-2">
                        <input type="checkbox" id="switch-2" class="mdl-switch__input"> <span style="padding-left: 20px;">Online/Offline</span>         
                      </label> 
                      </div><br>
                      <input type="hidden" name="h_code" value="<?php _show_( $userDetails['h_code'] ); ?>" >

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
      echo 'User Not Found';
    }
  }

  function resourceForm() { ?>
        <title><?php _show_( $resourceDetails['h_alias'] ); ?> Create <?php _show_( ucfirst( $_GET['create'] ) ); ?> [ <?php showOption( 'name' ); ?> ]</title>
        <div class="mdl-cell mdl-cell--12-col mdl-grid mdl-color--<?php primaryColor(); ?>">
        <form enctype="multipart/form-data" name="registerResource" method="POST" action="<?php _show_( hADMIN."resource?create=center" ); ?>" class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone mdl-grid">
            <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone">

              <div class="input-field">
                <i class="material-icons prefix">label</i>
              <input id="h_alias" name="h_alias" type="text" >
              <label for="h_alias">Resource Name</label>
              </div>                       

              <div class="input-field mdl-js-textfield mdl-textfield--floating-label getmdl-select">
                <i class="material-icons prefix">donut_large</i>
                 <input class="mdl-textfield__input" id="h_type" name="h_type" type="text" readonly tabIndex="-1" placeholder="Type" >
                   <ul class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-color--<?php primaryColor(); ?>" for="h_type">
                     <li class="mdl-menu__item" data-val="ambulance">Ambulance</li>
                     <li class="mdl-menu__item" data-val="lab">Lab</li>
                     <li class="mdl-menu__item" data-val="ward">Ward</li>
                     <li class="mdl-menu__item" data-val="morgue">Morgue</li>
                   </ul>
                </div>

              <div class="input-field mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">
                <i class="material-icons prefix">room</i>
              <input class="mdl-textfield__input" type="text" id="counties" name="h_location" readonly tabIndex="-1" value="<?php _show_( ucwords( $_SESSION['myLocation'] ) ); ?>">
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
              <input class="mdl-textfield__input" type="text" id="centers" name="h_organization" readonly tabIndex="-1" placeholder="Organization">
              <ul for="centers" class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-color--<?php primaryColor(); ?>" style="max-height: 300px !important; overflow-y: auto;">
                  <?php 
                  $centers = mysqli_query( $GLOBALS['conn'], "SELECT h_alias, h_code FROM husers WHERe h_type = 'center' ORDER BY h_alias" );
                  if ( $centers -> num_rows > 0 );
                  while ( $center = mysqli_fetch_assoc( $centers ) ) {
                      echo '<li class="mdl-menu__item" data-val="'.$center['h_code'].'">'.$center['h_alias'].'</li>';
                  }
                   ?>
              </ul>
              </div>

              <div class="input-field inline">
                <i class="material-icons prefix">phone</i>
              <input  id="h_phone" name="h_phone" type="text" value="<?php _show_( $_SESSION['myPhone'] ); ?>" >
              <label for="h_phone" class="center-align">Contact Phone</label>
              </div>

              <div class="input-field inline">
                <i class="material-icons prefix">mail</i>
              <input class="validate" id="email" name="h_email" type="email" value="<?php _show_( $_SESSION['myEmail'] ); ?>">
              <label for="email" data-error="wrong" data-success="right" class="center-align">Admin Email</label>
              </div>

              <div class="input-field mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">
                <i class="material-icons prefix">face</i>
              <input class="mdl-textfield__input" type="text" id="doctors" name="h_by" readonly tabIndex="-1" placeholder="Doctor In Charge">
              <ul for="doctors" class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-color--<?php primaryColor(); ?>" style="max-height: 300px !important; overflow-y: auto;">
                  <?php 
                  $centers = mysqli_query( $GLOBALS['conn'], "SELECT h_alias, h_code FROM husers WHERe h_type = 'doctor' ORDER BY h_alias" );
                  if ( $centers -> num_rows > 0 );
                  while ( $center = mysqli_fetch_assoc( $centers ) ) {
                      echo '<li class="mdl-menu__item" data-val="'.$center['h_code'].'">'.$center['h_alias'].'</li>';
                  }
                   ?>
              </ul>
              </div>
              <input type="hidden" name="h_author" value="<?php _show_( $_SESSION['myCode'] ); ?>">

              <div class="input-field">
                <i class="material-icons prefix">description</i>
              <textarea  id="h_description" name="h_description" type="text" class="materialize-textarea">Details about resource.</textarea>
              <label for="h_description" class="center-align">About</label>
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
                  <input id="h_avatar" type="file" name="h_avatar" value="<?php _show_( hIMAGES.'placeholder.svg' ); ?>">
                </div>
                <img id="havatar" onclick="chooseFile();" src="../assets/images/placeholder.svg" width="100%"></i>
                </div>
                <script>
                     function chooseFile() {
                        $( "#h_avatar" ).click();
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
                <input type="checkbox" id="remember-me" name="h_status" name="active"/>
                <label for="remember-me">Available</label>

              <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect alignright" type="submit" style="margin-left: 150px;margin-top: 100px;" name="register"><i class="material-icons">save</i></button>  
              </div>
          </div>
        </form>
        </div><?php 
  }

  function editResourceForm( $code ) {
    $getResourceCode = mysqli_query( $GLOBALS['conn'], "SELECT * FROM hresources WHERE h_code = '".$code."'" );
    if ( $getResourceCode -> num_rows > 0 ) {
      while ( $resourceDetails = mysqli_fetch_assoc( $getResourceCode ) ){
        $names = explode( " ", $resourceDetails['h_alias'] );

        ?><title>Editing <?php _show_( $resourceDetails['h_alias']." [ ".showOption( 'name' )." ]</title>" ); ?>
        <form enctype="multipart/form-data" name="registerResource" method="POST" action="<?php _show_( hADMIN.'resource?create' ); ?>" class="mdl-grid" >
          <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone">
              <div class="mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>">

                  <div class="mdl-card__supporting-text mdl-card--expand mdl-grid ">
                    <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone">

                      <div class="input-field">
                      <i class="material-icons prefix">label</i>
                      <input id="h_alias" name="h_alias" type="text" value="<?php _show_( $resourceDetails['h_alias'] ); ?>">
                      <label for="h_alias">Resource Name</label>
                      </div>

                      <div class="input-field mdl-js-textfield mdl-textfield--floating-label getmdl-select">
                      <i class="material-icons prefix">business</i>
                       <input class="mdl-textfield__input" id="h_type" name="h_type" type="text" readonly tabIndex="-1" placeholder="<?php _show_( ucwords( $resourceDetails['h_type'] ) ); ?>" value="<?php _show_( ucwords( $resourceDetails['h_type'] ) ); ?>" >
                         <ul class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-color--<?php primaryColor(); ?>" for="h_type">
                           <li class="mdl-menu__item" data-val="center">Center</li>
                           <li class="mdl-menu__item" data-val="equipment">Equipment</li>
                           <li class="mdl-menu__item" data-val="lab">Lab</li>
                           <li class="mdl-menu__item" data-val="ward">Ward</li>
                         </ul>
                      </div>

                      <div class="input-field inline">
                      <i class="material-icons prefix">phone</i>
                      <input  id="h_phone" name="h_phone" type="text" value="<?php _show_( $resourceDetails['h_phone'] ); ?>">
                      <label for="h_phone" class="center-align">Contact Phone</label>
                      </div>

                      <div class="input-field mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height">
                        <i class="material-icons prefix">room</i>
                      <input class="mdl-textfield__input" type="text" id="counties" name="h_location" readonly tabIndex="-1" placeholder="<?php _show_( ucwords( $resourceDetails['h_location'] ) ); ?>" value="<?php _show_( ucwords( $resourceDetails['h_location'] ) ); ?>">
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

                      <?php if ( $resourceDetails['h_type'] !== "organization"  ) { ?>
                      <div class="input-field">
                      <i class="material-icons prefix">business</i>
                      <input id="h_organization" name="h_organization" type="text" value="<?php _show_( $resourceDetails['h_organization'] ); ?>">
                      <label for="h_organization">Center</label>
                      </div>
                      <?php } ?>

                      <div class="input-field">
                      <i class="material-icons prefix">mail</i>
                      <input class="validate" id="email" name="h_email" type="email" value="<?php _show_( $resourceDetails['h_email'] ); ?>">
                      <label for="email" class="center-align">Admin Email</label>
                      </div>

                      <div class="input-field">
                      <i class="mdi mdi-bio prefix"></i>
                      <textarea class="materialize-textarea col s12" rows="5" id="h_description" name="h_description" >
                      <?php _show_( $resourceDetails['h_description'] ); ?>
                      </textarea>
                      <script>CKEDITOR.replace( 'h_description' );</script>
                      <label for="h_description">Bio</label>
                      </div>

                      <br>
                      </div>

                    <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone">
                    <script>
                     function chooseFile() {
                        $( "#h_avatar" ).click();
                     }
                   </script>
                      <div style="height:0px;overflow:hidden">
                         <input type="file" id="fileInput" name="h_avatar" />
                      </div>
                      <img id="havatar" onclick="chooseFile();" src="<?php _show_( $resourceDetails['h_avatar'] ); ?>" width="100%" onclick="chooseFile();">

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