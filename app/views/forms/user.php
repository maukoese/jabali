<?php
/**
* @package Jabali - The Plug-N-Play Framework
* @subpackage Form
* @link https://docs.jabalicms.org/classes/forms/
* @author Mauko Maunde
* @version 0.17.06
**/ ?>
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
    </div>