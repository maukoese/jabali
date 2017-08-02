<?php
include '../inc/config.php';
include '../inc/jabali.php';
include './header.php';

if ( isset( $_POST['mystyle'] ) ) {
    $theme = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['theme'] );
    mysqli_query( $GLOBALS['conn'], "UPDATE ". hDBPREFIX ."users SET h_style = '".$theme."' WHERE h_code = '".$_SESSION['myCode']."'" );
}


if ( isset( $_POST['preferences'] ) ) {
    $date = date('Y-m-d' );
    $uploads = hABSUP.date('Y' ).'/'.date('m' ).'/'.date('d' )."/";
    $headerlogo = $uploads . basename( $_FILES['header_logo']['name'] );
    $homelogo = $uploads . basename( $_FILES['home_logo']['name'] );
    $favicon = $uploads . basename( $_FILES['my_favicon']['name'] );

    if ( move_uploaded_file( $_FILES['header_logo']["tmp_name"], $headerlogo ) || move_uploaded_file( $_FILES['home_logo']["tmp_name"], $homelogo ) || move_uploaded_file( $_FILES['my_favicon']["tmp_name"], $favicon ) ) {
        //Do nothing
    } else {
        echo "Sorry, there was an error uploading your file.";
    }

    $header_logo = hUPLOADS.date('Y' ).'/'.date('m' ).'/'.date('d' ).'/'.$_FILES['header_logo']['name'];
    $home_logo = hUPLOADS.date('Y' ).'/'.date('m' ).'/'.date('d' ).'/'.$_FILES['home_logo']['name'];
    $favicon = hUPLOADS.date('Y' ).'/'.date('m' ).'/'.date('d' ).'/'.$_FILES['my_favicon']['name'];

    $hOpt -> update ( 'name', $_POST['name'], $date );
    $hOpt -> update ( 'description', $_POST['description'], $date );
    $hOpt -> update ( 'email', $_POST['email'], $date );
    $hOpt -> update ( 'phone', $_POST['phone'], $date );
    $hOpt -> update ( 'copyright', $_POST['copyright'], $date );
    $hOpt -> update ( 'attribution', $_POST['attribution'], $date );
    $hOpt -> update ( 'header_logo', $header_logo, $date );
    $hOpt -> update ( 'favicon', $favicon, $date );
    $hOpt -> update ( 'registration', $_POST['registration'], $date );
    $hOpt -> update ( 'tos', $_POST['tos'], $date );
}

if ( isset( $_POST['utype'] ) ) {
    $hUserType = new _hOptions();

    $type = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['type'] );
    $level = $_POST['level'];

    $usertypes = json_decode( getOption( 'usertypes' ), true );
    $types = count( $usertypes );
    $types2 = ++$types;

    for ($countyp=0; $countyp < count( $usertypes ); $countyp++) { 
        array( $usertypes[$countyp]['name'] => $usertypes[$countyp]['level'] );
    }
    $t = array_push( $usertypes, array( 'name' => $type, 'level' => $level ) );
    $usertypes = json_encode( $t );
    $hUserType -> update ( 'User Type', 'usertypes', $usertypes, date('Y-m-d') );
}

if ( isset( $_POST['social'] ) ) {
    $facebook = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['facebook'] );
    $twitter = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['twitter'] );
    $github = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['github'] );
    $instagram = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['instagram'] );
    $social = array('facebook' => $facebook, 'twitter' => $twitter, 'instagram' => $instagram, 'github' => $github );
    $social = json_encode( $social );

    $hSocial = new _hOptions();
    $hSocial -> update ( 'social', $social, date('Y-m-d') );
}

if ( isset( $_GET['settings'] ) ) {
    if ( $_GET['settings'] == "general" ) {
        ?><title>General Site Options [ <?php showOption( 'name' ); ?> ]</title>
        <div class="mdl-grid" >

        <div class="mdl-cell mdl-cell--6-col-desktop mdl-cell--6-col-tablet mdl-cell--12-col-phone mdl-grid mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>">
            <div class=" mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone">
            <form enctype="multipart/form-data" name="optionForm" method="POST" action="">

                    <div class="input-field">
                            <i class="material-icons prefix">label</i>
                        <input id="name" type="text" name="name" value="<?php showOption( 'name' ); ?>">
                        <label for="name" data-error="wrong" data-success="right" class="center-align">Site Name </label>
                    </div>

                    <div class="input-field">
                            <i class="material-icons prefix">details</i>
                        <input id="description" type="text" name="description" value="<?php showOption( 'description' ); ?>">
                        <label for="description" class="center-align">Site Description </label>
                    </div>

                    <div class="input-field">
                            <i class="material-icons prefix">mail</i>
                        <input id="email" type="text" name="email" value="<?php showOption( 'email' ); ?>">
                        <label for="email" class="center-align">Admin Email </label>
                    </div>

                    <div class="input-field">
                            <i class="material-icons prefix">phone</i>
                        <input id="phone" type="text" name="phone" value="<?php showOption( 'phone' ); ?>">
                        <label for="phone" class="center-align">Admin Phone </label>
                    </div>

                    <div class="input-field">
                            <i class="material-icons prefix">copyright</i>
                        <input id="copyright" type="text" name="copyright" value="<?php showOption( 'copyright' ); ?>">
                        <label for="copyright"class="center-align">Footer Copyright </label>
                    </div>

                    <div class="input-field">
                            <i class="mdi mdi-format-color-text prefix"></i>
                        <input id="attribution" type="text" name="attribution" value="<?php showOption( 'attribution' ); ?>">
                        <label for="attribution"class="center-align">Footer Attribution </label>
                    </div>

            </div>

            <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone mdl-grid">
                <script>
                   function chooseHeader() {
                      $( "#header_logo" ).click();
                   }

                   function chooseHome() {
                      $( "#home_logo" ).click();
                   }

                   function chooseFavicon() {
                      $( "#my_favicon" ).click();
                   }
                </script>

                <div class="input-field inline mdl-cell mdl-cell--2-col-desktop mdl-cell--2-col-tablet mdl-cell--12-col-phone mdl-grid mdl-card mdl-shadow--2dp">
                    <div style="height:0px;overflow:hidden">
                        <input id="my_favicon" type="file" name="my_favicon" value="<?php showOption( 'favicon' ); ?>">
                    </div>
                    <img src="<?php showOption( 'favicon' ); ?>" width="100%" onclick="chooseFavicon();">
                    <label for="my_favicon" data-error="wrong" data-success="right" class="center-align">Favicon <span><i class="material-icons">edit</i></span></label>
                </div>

                <div class="input-field inline mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone mdl-grid mdl-card mdl-shadow--2dp">
                    <div style="height:0px;overflow:hidden">
                        <input id="header_logo" type="file" name="header_logo" value="<?php showOption( 'header_logo' ); ?>">
                    </div>
                    <img src="<?php showOption( 'header_logo' ); ?>" width="75%" onclick="chooseHeader();">
                    <label for="header_logo" data-error="wrong" data-success="right" class="center-align">Header Logo (100x80px) <span><i class="material-icons">edit</i></span></label>
                </div>

                <div class="input-field inline mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone mdl-grid mdl-card mdl-shadow--2dp">
                    <div style="height:0px;overflow:hidden">
                    <input id="home_logo" type="file" name="home_logo" value="<?php showOption( "home_logo" ); ?>">
                    </div>
                    <img src="<?php showOption( 'home_logo' ); ?>" width="100%" onclick="chooseHome();">
                    <label for="home_logo" data-error="wrong" data-success="right">Home Logo (250x80px) <span><i class="material-icons">edit</i></span></label>
                </div>
            </div>
        </div>

        <div class="mdl-cell mdl-cell--6-col-desktop mdl-cell--6-col-tablet mdl-cell--12-col-phone mdl-grid mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>">
            <div class=" mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone">

                <div class="input-field">
                    <textarea id="h_tos" name="tos" class="materialize-textarea col s12"><?php showOption( 'tos' ); ?></textarea>
                            <script>CKEDITOR.replace( "h_tos" );</script>
                    <label for="h_tos" data-error="wrong" data-success="right" class="center-align">Terms of Service </label>
                </div>
                <div class="mdl-grid">
                    <div class="mdl-cell">
                    <?php $hGlobal -> currencyCode(); ?>
                    </div>
                    <div class="mdl-cell">
                    <?php $hGlobal -> countries(); ?>
                    </div>
                    <div class="mdl-cell">
                    <?php $hGlobal -> timeZone(); ?>
                    </div>
                </div>
                <div class="mdl-grid">
                    <div class="input-field mdl-cell">
                      <input type="checkbox" id="registration" name="registration" <?php showOption( 'registration' ); ?> value="checked" />
                      <label for="registration">Allow User Registrations?</label>
                    </div>
                    <div class="mdl-cell mdl-cell--6-col"></div>
                    <div class="input-field mdl-cell mdl-cell--8-col">
                            <i class="material-icons prefix">room</i>
                        <input id="map" type="text" name="map" value="<?php showOption( 'map' ); ?>">
                        <label for="map" class="center-align">Map Embed Link (iframe) </label>
                    </div>
                    <div class="input-field mdl-cell">
                    <button class="mdl-button mdl-button--fab alignright" type="submit" name="preferences"><i class="material-icons">save</i></button>
                    </div>
                </div>
            </div>
        </form>
        </div>
        </div><?php 
    } elseif ( $_GET['settings'] == "social" ) { ?>
        <title>Site Social Settings [ <?php showOption( 'name' ); ?> ]</title>
        <div class="mdl-grid">
        <div class="mdl-cell mdl-cell--9-col-desktop mdl-cell--9-col-tablet mdl-cell--12-col-phone mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>">
            <div class="mdl-card__title">
                <div class="mdl-card__title-text">
                    Social Networks
                </div>
                <div class="mdl-layout-spacer"></div>
                <i class="material-icons">public</i>
            </div>
            <div class="mdl-card_supporting-text" style="padding: 20px;">
                 <form enctype="multipart/form-data" name="optionForm" method="POST" action="" ><?php 
                      $social = getOption( 'social' );
                      $social = json_decode( $social ); 
                      foreach ($social as $key => $value) { ?>

                    <div class="input-field">
                      <i class="fa fa-<?php _show_( $key ); ?> prefix"></i>
                      <input id="<?php _show_( $key ); ?>" name="<?php _show_( $key ); ?>" type="text" value="<?php _show_( $value ); ?>">
                      <label for="<?php _show_( $key ); ?>"><?php _show_( ucwords( $key ) ); ?></label>
                    </div><?php } ?>

                    <div class="input-field"><br>
                    <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect alignright" type="submit" name="social"><i class="material-icons">save</i></button>
                    </div>
                </form>
            </div>
    </div>
    <div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--12-col-phone mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>">
        <div class="mdl-card__title">
                <div class="mdl-card__title-text">
                    Mauko by Design
                </div>
                <div class="mdl-layout-spacer"></div>
                <i class="material-icons">public</i>
            </div>
            <div id="fb-root"></div>
            <script>(function(d, s, id) {
              var js, fjs = d.getElementsByTagName(s)[0];
              if (d.getElementById(id)) return;
              js = d.createElement(s); js.id = id;
              js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.9&appId=1084251448343450";
              fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>
                <div class="fb-page mdl-card_supporting-text" data-href="https://www.facebook.com/maukoese/" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/maukoese/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/maukoese/">Mauko by Design</a></blockquote></div>
            </div>
    </div><?php
    }
    elseif ( $_GET['settings'] == "user" ) {
        ?><title>User Options [ <?php showOption( 'name' ); ?> ]</title>
        <div class="mdl-grid" >
        <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone">
        <div class="mdl-card mdl-color--<?php primaryColor(); ?>">
        <div class="mdl-card__supporting-text mdl-card--expand">
        <div class="mdl-grid mdl-card">
            <div class="mdl-cell mdl-cell--6-col" >
            <h6>Inbuilt Types</h6>
                <a href="./user?view=list&type=admin" class="mdl-list__item"><i class="mdi mdi-lock mdl-list__item-icon"></i><span style="padding-left: 20px">Admin</span></a>
                <a href="./user?view=list&type=organization" class="mdl-list__item"><i class="material-icons mdl-list__item-icon">business</i><span style="padding-left: 20px">Organization</span></a>
                <a href="./user?view=list&type=editor" class="mdl-list__item"><i class="material-icons mdl-list__item-icon">edit</i><span style="padding-left: 20px">Editor</span></a>
                <a href="./user?view=list&type=author" class="mdl-list__item"><i class="material-icons mdl-list__item-icon">note_add</i><span style="padding-left: 20px">Author</span></a>
                <a href="./user?view=list&type=subscriber" class="mdl-list__item"><i class="material-icons mdl-list__item-icon">mail</i><span style="padding-left: 20px">Subscriber</span></a>
            </div>
            <div class="mdl-cell mdl-cell--6-col" >
            <h6>User Defined Types</h6>
                <?php $usertypes = json_decode( getOption( 'usertypes' ), true );
                echo $usertypes[0]['name'];
                echo $usertypes[0]['level'];
                echo "<br>";
                $types = count( $usertypes );
                $types = ++$types;
                echo $types; ?>
            </div>
        </div>
                <h6>Add New User Type</h6>
        <form enctype="multipart/form-data" name="optionForm" method="POST" action="" class="mdl-grid ">

                <div class="input-field mdl-cell">
                        <i class="material-icons prefix">label</i>
                    <input id="merchant" type="text" name="type" placeholder="e.g Accountant">
                    <label for="merchant" data-error="wrong" data-success="right" class="center-align">Label</label>
                </div>

                <div class="input-field mdl-cell mdl-js-textfield getmdl-select">
                <i class="material-icons prefix">lock</i>
                 <input class="mdl-textfield__input" id="h_type" name="level" type="text" readonly tabIndex="-1" placeholder="Select Level" >
                  <label for="h_type">
                      <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
                  </label>
                   <ul class="mdl-menu mdl-menu--top-left mdl-js-menu mdl-color--<?php primaryColor(); ?>" for="h_type">
                     <li class="mdl-menu__item" data-val="admin">Admin</li>
                     <li class="mdl-menu__item" data-val="editor">Editor</li>
                     <li class="mdl-menu__item" data-val="author">Author</li>
                     <li class="mdl-menu__item" data-val="subscriber">Subscriber</li>
                   </ul>
                </div>
                <div class="input-field mdl-cell">
                    <button class="mdl-button mdl-button--fab alignright" type="submit" name="utype"><i class="material-icons">save</i></button>
                </div>
        </form>
        </div>
        </div>
        </div>

        <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone">
                    <div class="mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>">
                        <div class="mdl-card__title">
                        <i class="material-icons">group</i>
                          <span class="mdl-button">User Types & Permisions</span>
                        </div>
                        <div class="mdl-card__supporting-text mdl-card--expand">
                        <ul class="collapsible popout" data-collapsible="accordion">
                        <li>
                          <div class="collapsible-header active"><i class="material-icons">supervisor_account</i>Admin<b class="alignright">Level 1</b></div>
                          <div class="collapsible-body">
                          <span><b>Permisions</b></span>
                            <ul>
                                <li>Create, Edit & Delete Users</li>
                                <li>Create, Edit & Delete Posts</li>
                                <li>Create, Edit & Delete Resources</li>
                            </ul>
                          </div>
                        </li>
                        <li>
                          <div class="collapsible-header"><i class="material-icons">supervisor_account</i>Editor<b class="alignright">Level 2</b></div>
                          <div class="collapsible-body">
                          <span><b>Permisions</b></span>
                            <ul>
                                <li>Create, Edit & Delete Posts</li>
                                <li>Create, Edit & Delete Resources</li>
                            </ul>
                            </div>
                        </li>
                        <li>
                          <div class="collapsible-header"><i class="material-icons">create</i>Author<b class="alignright">Level 3</b></div>
                          <div class="collapsible-body">
                          <span><b>Permisions</b></span>
                            <ul>
                                <li>Create, Edit & Delete Users</li>
                                <li>Create, Edit & Delete Posts</li>
                                <li>Create, Edit & Delete Resources</li>
                            </ul>
                            </div>
                        </li>
                        <li>
                          <div class="collapsible-header"><i class="material-icons">mail_outline</i>Subscriber<b class="alignright">Level 4</b></div>
                          <div class="collapsible-body">
                          <span><b>Permisions</b></span>
                            <ul>
                                <li>Create, Edit & Delete Messages</li>
                            </ul>
                            </div>
                        </li>
                      </ul>
                        </div>
                    </div>
                </div>
        </div><?php 
    } elseif ( $_GET['settings'] == "color" ) {

        function isTheme ( $theme) {
            $themes = mysqli_query( $GLOBALS['conn'], "SELECT h_style FROM ". hDBPREFIX ."users WHERE h_code = '".$_SESSION['myCode']."'" );
            if ( $themes -> num_rows > 0) {
                while ( $mytheme = mysqli_fetch_assoc( $themes) ) {
                    if ( $theme == $mytheme['h_style'] ) {
                        echo 'checked';
                    }
                }
            }
        }
?>
    <title>Theme Color Options [ <?php showOption( 'name' ); ?> ]</title>
    <div class="mdl-grid mdl-grid--no-spacing mdl-cell mdl-cell--12-col" >
        <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone mdl-grid mdl-shadow--2dp">
        	<div class=" mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>">
        		<style type="text/css">
                .cholder {
                    display: inline-flex;
                    }

                .ccolor {
                    height: 40px;
                    width: 40px;
                    border-radius: 50%;
                    border: #eee 1px solid;
                }

                .clabel {
                    padding-left: 20px;
                }

                </style>
                <div class="mdl-card__title">
                    <div class="mdl-card__title-text">
                        Select Theme
                    </div>
                    <div class="mdl-layout-spacer"></div>
                    <div class="mdl-card__subtitle-text mdl-button mdl-button--icon">
                        <i class="material-icons">color_lens</i>
                    </div>
                </div>
                <div class="mdl-card_supporting-text">
                <form enctype="multipart/form-data" name="themeForm" method="POST" action="" class="mdl-cell mdl-cell--12-col mdl-grid">

<div class="mdl-cell mdl-cell--3-col">
    <input type="radio" id="zahra" name="theme" value="zahra" <?php isTheme ('zahra' ); ?> />
    <label for="zahra">
        <span class="cholder" for="zahra">
            <span class="ccolor mdl-color--teal"></span>
            <span class="ccolor csec mdl-color--red"></span>
            <span class="ccolor csec mdl-color--white"></span>
        </span>
    </label>
    <div class="mdl-tooltip" for="zahra">Zahra's Fade</div>
</div>

<div class="mdl-cell mdl-cell--3-col">
    <input type="radio" id="love" name="theme" value="love" <?php isTheme ('love' ); ?> />
    <label for="love">
        <span class="cholder" for="love">
            <span class="ccolor mdl-color--teal"></span>
            <span class="ccolor csec mdl-color--red"></span>
            <span class="ccolor csec mdl-color--white"></span>
        </span>
    </label>
    <div class="mdl-tooltip" for="love">Love, Olive</div>
</div>

<div class="mdl-cell mdl-cell--3-col">
    <input type="radio" id="zahra" name="theme" value="zahra" <?php isTheme ('love' ); ?> />
    <label for="zahra">
        <span class="cholder" for="zahra">
            <span class="ccolor mdl-color--teal"></span>
            <span class="ccolor csec mdl-color--red"></span>
            <span class="ccolor csec mdl-color--white"></span>
        </span>
    </label>
    <div class="mdl-tooltip" for="zahra">Zahra's Fade</div>
</div>


                    <div class="mdl-cell mdl-cell--3-col">
                        <input type="radio" id="love" name="theme" value="love" <?php isTheme ('love' ); ?>>
                        <label for="love"><p class="cholder" for="love">
                            <span class="ccolor mdl-color--cyan"></span><span class="ccolor csec mdl-color--magenta"></span><span class="ccolor csec mdl-color--white"></span>
                        </p></label>
                    </div><div class="mdl-tooltip" for="love">Love, Olive</div>

                    <div class="mdl-cell mdl-cell--3-col">
                        <input type="radio" id="wizz" name="theme" value="wizz" <?php isTheme ('wizz' ); ?>>
                        <label for="wizz"><p class="cholder" for="wizz">
                            <span class="ccolor mdl-color--yellow"></span><span class="ccolor csec mdl-color--black"></span><span class="ccolor csec mdl-color--white"></span>
                        </p></label>
                    </div><div class="mdl-tooltip" for="wizz">The Wizz</div>

                    <div class="mdl-cell mdl-cell--3-col">
                        <input type="radio" id="pint" name="theme" value="pint" <?php isTheme ('pint' ); ?>>
                        <label for="pint"><p class="cholder" for="pint">
                            <span class="ccolor mdl-color--blue"></span><span class="ccolor csec mdl-color--pink"></span><span class="ccolor csec mdl-color--white"></span>
                        </p></label>
                    </div><div class="mdl-tooltip" for="pint">The Bluepint</div>

                    <div class="mdl-cell mdl-cell--3-col">
                        <input type="radio" id="stack" name="theme" value="stack" <?php isTheme ('stack' ); ?>>
                        <label for="stack"><p class="cholder" for="stack">
                            <span class="ccolor mdl-color--grey"></span><span class="ccolor csec mdl-color--brown"></span><span class="ccolor csec mdl-color--white"></span>
                        </p></label>
                    </div><div class="mdl-tooltip" for="stack">Needle in a Haystack</div>

                    <div class="mdl-cell mdl-cell--3-col">
                        <input type="radio" id="indie" name="theme" value="indie" <?php isTheme ('indie' ); ?>>
                        <label for="indie"><p class="cholder" for="indie">
                            <span class="ccolor mdl-color--indigo"></span><span class="ccolor csec mdl-color--brown"></span><span class="ccolor csec mdl-color--white"></span>
                        </p></label>
                    </div><div class="mdl-tooltip" for="indie">Indie Go</div>

                    <div class="mdl-cell mdl-cell--3-col">
                        <input type="radio" id="haze" name="theme" value="haze" <?php isTheme ('haze' ); ?>>
                        <label for="haze"><p class="cholder" for="haze">
                            <span class="ccolor mdl-color--purple"></span><span class="ccolor csec mdl-color--green"></span><span class="ccolor csec mdl-color--white"></span>
                        </p></label>
                    </div><div class="mdl-tooltip" for="haze">Purple Haze</div>

                    <div class="mdl-cell mdl-cell--3-col">
                        <input type="radio" id="hot" name="theme" value="hot" <?php isTheme ('hot' ); ?>>
                        <label for="hot"><p class="cholder" for="hot">
                            <span class="ccolor mdl-color--red"></span><span class="ccolor csec mdl-color--blue"></span><span class="ccolor csec mdl-color--white"></span>
                        </p></label>
                    </div><div class="mdl-tooltip" for="hot">Red Hot</div>

                    <div class="mdl-cell mdl-cell--3-col">
                        <input type="radio" id="princess" name="theme" value="princess" <?php isTheme ('princess' ); ?>>
                        <label for="princess"><p class="cholder" for="princess">
                            <span class="ccolor mdl-color--pink"></span><span class="ccolor csec mdl-color--cyan"></span><span class="ccolor csec mdl-color--white"></span>
                        </p></label>
                    </div><div class="mdl-tooltip" for="princess">Princess Zahra</div>

                    <div class="mdl-cell mdl-cell--3-col">
                        <input type="radio" id="sky" name="theme" value="sky" <?php isTheme ('sky' ); ?>>
                        <label for="sky"><p class="cholder" for="sky">
                            <span class="ccolor mdl-color--light-blue"></span><span class="ccolor csec mdl-color--brown"></span><span class="ccolor csec mdl-color--white"></span>
                        </p></label>
                    </div><div class="mdl-tooltip" for="sky">Blue Sky</div>

                    <div class="mdl-cell mdl-cell--3-col">
                        <input type="radio" id="greene" name="theme" value="greene" <?php isTheme ('greene' ); ?>>
                        <label for="greene"><p class="cholder" for="greene">
                            <span class="ccolor mdl-color--green"></span><span class="ccolor csec mdl-color--red"></span><span class="ccolor csec mdl-color--white"></span>
                        </p></label>
                    </div><div class="mdl-tooltip" for="greene">Green E</div>

                    <div class="mdl-cell mdl-cell--3-col">
                        <input type="radio" id="vegan" name="theme" value="vegan" <?php isTheme ('vegan' ); ?>>
                        <label for="vegan"><p class="cholder" for="vegan">
                            <span class="ccolor mdl-color--light-green"></span><span class="ccolor csec mdl-color--green"></span><span class="ccolor csec mdl-color--white"></span>
                        </p></label>
                    </div><div class="mdl-tooltip" for="vegan">Vegan</div>

                    <div class="mdl-cell mdl-cell--3-col">
                        <input type="radio" id="lemon" name="theme" value="lemon" <?php isTheme ('lemon' ); ?>>
                        <label for="lemon"><p class="cholder" for="lemon">
                            <span class="ccolor mdl-color--lime"></span><span class="ccolor csec mdl-color--brown"></span><span class="ccolor csec mdl-color--white"></span>
                        </p></label>
                    </div><div class="mdl-tooltip" for="lemon">Life's Lemons</div>

                    <div class="mdl-cell mdl-cell--3-col">
                        <input type="radio" id="wait" name="theme" value="wait" <?php isTheme ('wait' ); ?>>
                        <label for="wait"><p class="cholder" for="wait">
                            <span class="ccolor mdl-color--amber"></span><span class="ccolor csec mdl-color--brown"></span><span class="ccolor csec mdl-color--white"></span>
                        </p></label>
                    </div><div class="mdl-tooltip" for="wait">Wait A Minute</div>

                    <div class="mdl-cell mdl-cell--3-col">
                        <input type="radio" id="orange" name="theme" value="orange" <?php isTheme ('orange' ); ?>>
                        <label for="orange"><p class="cholder" for="orange">
                            <span class="ccolor mdl-color--orange"></span><span class="ccolor csec mdl-color--yellow"></span><span class="ccolor csec mdl-color--white"></span>
                        </p></label>
                    </div><div class="mdl-tooltip" for="orange">Orange Tan</div>

                    <div class="mdl-cell mdl-cell--3-col">
                        <input type="radio" id="sun" name="theme" value="sun" <?php isTheme ('sun' ); ?>>
                        <label for="sun"><p class="cholder" for="sun">
                            <span class="ccolor mdl-color--deep-orange"></span><span class="ccolor csec mdl-color--cyan"></span><span class="ccolor csec mdl-color--white"></span>
                        </p></label>
                    </div><div class="mdl-tooltip" for="sun">Orange Sun</div>

                    <div class="mdl-cell mdl-cell--3-col">
                        <input type="radio" id="earth" name="theme" value="earth" <?php isTheme ('earth' ); ?>>
                        <label for="earth"><p class="cholder" for="earth">
                            <span class="ccolor mdl-color--brown"></span><span class="ccolor csec mdl-color--orange"></span><span class="ccolor csec mdl-color--white"></span>
                        </p></label>
                    </div><div class="mdl-tooltip" for="earth">Down To Earth</div>
                    

                    <div class="mdl-cell mdl-cell--3-col">
                        <input type="radio" id="ghost" name="theme" value="ghost" <?php isTheme ('ghost' ); ?>>
                        <label for="ghost"><p class="cholder" for="ghost">
                            <span class="ccolor mdl-color--blue-grey"></span><span class="ccolor csec mdl-color--red"></span><span class="ccolor csec mdl-color--white"></span>
                        </p></label>
                    </div><div class="mdl-tooltip" for="ghost">Ghosting Blues</div>
                    

                    <div class="mdl-cell mdl-cell--3-col">
                        <input type="radio" id="bred" name="theme" value="bred" <?php isTheme ('bred' ); ?>>
                        <label for="bred"><p class="cholder" for="bred">
                            <span class="ccolor mdl-color--black"></span><span class="ccolor csec mdl-color--red"></span><span class="ccolor csec mdl-color--white"></span>
                        </p></label>
                    </div><div class="mdl-tooltip" for="bred">Born & Bred</div>
                    

                    <div class="mdl-cell mdl-cell--3-col">
                        <input type="radio" id="prince" name="theme" value="prince" <?php isTheme ('prince' ); ?>>
                        <label for="prince"><p class="cholder" for="prince">
                            <span class="ccolor mdl-color--deep-purple"></span><span class="ccolor csec mdl-color--lime"></span><span class="ccolor csec mdl-color--white"></span>
                        </p></label>
                    </div><div class="mdl-tooltip" for="prince">Dark Prince</div>

                    <div class="mdl-cell mdl-cell--3-col">
                        <input type="radio" id="peachy" name="theme" value="peachy" <?php isTheme ('prince' ); ?>>
                        <label for="peachy"><p class="cholder" for="prince">
                            <span class="ccolor mdl-color--peachpuff"></span><span class="ccolor csec mdl-color--maroon"></span><span class="ccolor csec mdl-color--white"></span>
                        </p></label>
                    </div><div class="mdl-tooltip" for="peachy">Peachy</div>

                    <div class="mdl-cell mdl-cell--3-col">
                        <input type="radio" id="queen" name="theme" value="queen" <?php isTheme ('queen' ); ?>>
                        <label for="queen"><p class="cholder" for="queen">
                            <span class="ccolor mdl-color--deep-purple"></span><span class="ccolor csec mdl-color--light-green"></span><span class="ccolor csec mdl-color--white"></span>
                        </p></label>
                    </div><div class="mdl-tooltip" for="queen">The Queen</div>

                    <div class="mdl-cell mdl-cell--3-col">
                        <input type="radio" id="madge" name="theme" value="madge" <?php isTheme ('madge' ); ?>>
                        <label for="madge"><p class="cholder" for="madge">
                            <span class="ccolor mdl-color--madge"></span><span class="ccolor csec mdl-color--sony"></span><span class="ccolor csec mdl-color--white"></span>
                        </p></label>
                    </div><div class="mdl-tooltip" for="madge">Madge Sony</div>

                    <div class="mdl-cell mdl-cell--3-col">
                        <input type="radio" id="madge" name="theme" value="madge" <?php isTheme ('madge' ); ?>>
                        <label for="madge"><p class="cholder" for="madge">
                            <span class="ccolor mdl-color--black"></span><span class="ccolor csec mdl-color--cyan"></span><span class="ccolor csec mdl-color--white"></span>
                        </p></label>
                    </div><div class="mdl-tooltip" for="madge">Madge Sony</div>
                    

                    <div class="mdl-cell mdl-cell--3-col">
                    <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored alignright" type="submit" name="mystyle"><i class="material-icons">save</i></button>
                    </div>
                </form>
                </div>
        	</div>
            <div class=" mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>">
                <div class="mdl-card__title">
                    <div class="mdl-card__title-text">
                        Custom Styling
                    </div>

                    <div class="mdl-layout-spacer"></div>
                    <div class="mdl-card__subtitle-text mdl-button mdl-button--icon">
                        <i class="material-icons">brush</i>
                    </div>
                </div>

                <form enctype="multipart/form-data" name="themeForm" method="POST" action="" class="mdl-cell mdl-cell--12-col">
                <div class="mdl-card_supporting-text">

                    <div class="input-field">
                        <i class="mdi mdi-format-color-text prefix"></i>
                        <input id="secondary" type="text" name="secondary">
                        <label for="secondary" data-error="wrong" data-success="right" class="center-align">Accent Color </label>
                    </div>

                    <div class="input-field">
                        <i class="mdi mdi-format-paragraph prefix"></i>
                        <input id="textp" type="text" name="textp">
                        <label for="textp" data-error="wrong" data-success="right" class="center-align">Text Primary Color </label>
                    </div>

                    <div class="input-field">
                        <i class="mdi mdi-code-string prefix"></i>
                        <input id="texts" type="text" name="texts">
                        <label for="texts" data-error="wrong" data-success="right" class="center-align">Text Secondary Color </label>
                    </div>

                    <div class="input-field">
                        <i class="mdi mdi-language-css3 prefix"></i>
                        <textarea id="customs" name="customs" cols="3" class="materialize-textarea col s12"></textarea>
                        <label for="customs" data-error="wrong" data-success="right" class="center-align">Custom CSS </label>
                    </div>

                    <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored alignright" type="submit" name="custom"><i class="material-icons">save</i></button>
                </form>
                </div>
            </div>
        </div>

        <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone mdl-grid mdl-shadow--2dp">
            <div class="mdl-cell mdl-cell--12-col mdl-card mdl-color--<?php primaryColor(); ?>">
                <div class="mdl-card__title">
                    <div class="mdl-card__title-text">
                        Color Palette
                    </div>

                    <div class="mdl-layout-spacer"></div>
                    <div class="mdl-card__subtitle-text mdl-button mdl-button--icon">
                        <i class="material-icons">palette</i>
                    </div>
                </div>
                <div class="mdl-card_supporting-text" style="margin: 5%;"><br>
                   <p class="cholder">
                        <span class="ccolor mdl-color--red"></span><span class="clabel"> Red</span><span class="clabel"> ( red )</span>
                    </p><br>
                   <p class="cholder">
                        <span class="ccolor mdl-color--pink"></span><span class="clabel"> Pink</span><span class="clabel"> ( pink )</span>
                    </p><br>
                   <p class="cholder">
                        <span class="ccolor mdl-color--purple"></span><span class="clabel"> Purple</span><span class="clabel"> ( purple )</span>
                    </p><br>
                   <p class="cholder">
                        <span class="ccolor mdl-color--deep-purple"></span><span class="clabel"> Deep Purple</span><span class="clabel"> ( deep-purple )</span>
                    </p><br>
                   <p class="cholder">
                        <span class="ccolor mdl-color--indigo"></span><span class="clabel"> Indigo</span><span class="clabel"> ( indigo )</span>
                    </p><br>
                   <p class="cholder">
                        <span class="ccolor mdl-color--blue"></span><span class="clabel"> Blue</span><span class="clabel"> ( blue )</span>
                    </p><br>
                   <p class="cholder">
                        <span class="ccolor mdl-color--light-blue"></span><span class="clabel"> Light Blue</span><span class="clabel"> ( light-blue )</span>
                    </p><br>
                   <p class="cholder">
                        <span class="ccolor mdl-color--cyan"></span><span class="clabel"> Cyan</span><span class="clabel"> ( cyan )</span>
                    </p><br>
                   <p class="cholder">
                        <span class="ccolor mdl-color--teal"></span><span class="clabel"> Teal</span><span class="clabel"> ( teal )</span>
                    </p><br>
                   <p class="cholder">
                        <span class="ccolor mdl-color--green"></span><span class="clabel"> Green</span><span class="clabel"> ( green )</span>
                    </p><br>
                   <p class="cholder">
                        <span class="ccolor mdl-color--light-green"></span><span class="clabel"> Light Green</span><span class="clabel"> ( light-green )</span>
                    </p><br>
                   <p class="cholder">
                        <span class="ccolor mdl-color--lime"></span><span class="clabel"> Lime</span><span class="clabel"> ( green )</span>
                    </p><br>
                   <p class="cholder">
                        <span class="ccolor mdl-color--yellow"></span><span class="clabel"> Yellow</span><span class="clabel"> ( yellow )</span>
                    </p><br>
                   <p class="cholder">
                        <span class="ccolor mdl-color--amber"></span><span class="clabel"> Amber</span><span class="clabel"> ( amber )</span>
                    </p><br>
                   <p class="cholder">
                        <span class="ccolor mdl-color--orange"></span><span class="clabel"> Orange</span><span class="clabel"> ( orange )</span>
                    </p><br>
                   <p class="cholder">
                        <span class="ccolor mdl-color--deep-orange"></span><span class="clabel"> Deep Orange</span><span class="clabel"> ( deep-orange )</span>
                    </p><br>
                   <p class="cholder">
                        <span class="ccolor mdl-color--brown"></span><span class="clabel"> Brown</span><span class="clabel"> ( brown )</span>
                    </p><br>
                   <p class="cholder">
                        <span class="ccolor mdl-color--grey"></span><span class="clabel"> Grey</span><span class="clabel"> ( grey )</span>
                    </p><br>
                   <p class="cholder">
                        <span class="ccolor mdl-color--blue-grey"></span><span class="clabel"> Blue Grey</span><span class="clabel"> ( blue-grey )</span>
                    </p><br>
                </div>
            </div>
        </div>
    </div>
<?php 
    }
}

include './footer.php';
