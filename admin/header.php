<?php 
session_start();
if ( !isset( $_SESSION['myCode'] ) ) {
	header( "Location: ../login" );
}

connectDb();
$dB = new MysqliDb ($GLOBALS['conn']); ?>
<!doctype html>
<!--
  Jabali Framework
  © 2017 Mauko Maunde. All rights reserved.

  Licensed under the MIT license (the "License" );
  you may not use this file except in compliance with the License.
  You may obtain a copy of the License at https://opensource.org/licenses/MIT
-->
<html lang="en" xmlns="http://www.w3.org/1999/html">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="<?php showOption( 'description' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

    <!-- Add to homescreen for Chrome on Android -->
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="icon" sizes="192x192" href="images/android-desktop.png">

    <!-- Add to homescreen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Material Design Lite">
    <link rel="apple-touch-icon-precomposed" href="images/ios-desktop.png">

    <!-- Tile icon for Win8 (144x144 + tile color) -->
    <meta name="msapplication-TileImage" content="images/touch/ms-touch-icon-144x144-precomposed.png">
    <meta name="msapplication-TileColor" content="#008080">

    <link rel="shortcut icon" href="<?php showOption( 'favicon' ); ?>">

    <link rel="stylesheet" href='<?php echo hSTYLES; ?>lib/getmdl-select.min.css'>
    <link rel="stylesheet" href="<?php echo hSTYLES; ?>lib/nv.d3.css">
    <link rel="stylesheet" href="<?php echo hSTYLES; ?>jquery-ui.css">
    <link rel="stylesheet" href="<?php echo hSTYLES; ?>materialize.css">
    <link rel="stylesheet" href="<?php echo hSTYLES; ?>material-icons.css">
    <link rel="stylesheet" href="<?php echo hSTYLES; ?>materialdesignicons.css">
    <link rel="stylesheet" href="<?php echo hSTYLES; ?>font-awesome.css">
    <link rel="stylesheet" href="<?php echo hSTYLES; ?>datetimepicker.min.css">
    <link rel="stylesheet" href="<?php echo hSTYLES; ?>jabali.css">
    <style type="text/css">
    .mdl-menu__outline {
        background-color: <?php primaryColor(); ?>;
        overflow-y: auto;
    }
    
    .cke_bottom {
    background: <?php secondaryColor(); ?>;
    }

    .primary {
        color: <?php primaryColor(); ?>;
    }
    .accent, a, .mdl-data-table.a, .mdl-badge.mdl-badge--no-background[data-badge]:after, .mdl-layout__drawer.mdl-navigation.mdl-navigation__link--current.material-icons, .mdl-layout__drawer.mdl-navigation.mdl-navigation__link:hover, .mdl-layout__drawer.mdl-navigation.mdl-navigation__link:hover.material-icons {
        color: <?php secondaryColor(); ?>;
    }


    .mdl-color--accent, .accent, .mdl-button--fab.mdl-button--colored, .mdl-badge[data-badge]:after {
        background-color: <?php secondaryColor(); ?>;
    }

    .mdl-data-table {
    color: white;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    -o-text-overflow: ellipsis;
    width: 100%;
    height: auto;
    }
    </style>

    <script src="<?php echo hSCRIPTS ?>jquery-3.2.1.min.js"></script>
    <script src="<?php echo hSCRIPTS ?>jquery-ui.min.js"></script>
    <script src="<?php echo hSCRIPTS ?>datetimepicker.min.js"></script>
    <script src="<?php echo hSCRIPTS ?>ckeditor/ckeditor.js"></script>
    
  </head>
  <body>
    <div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
      <header class="demo-header mdl-layout__header mdl-color-text--grey-600 mdl-color--<?php primaryColor(); ?>">
        <div class="mdl-layout__header-row">
          <span class="mdl-layout-title"><?php 
          if ( isset( $_GET['type'] ) ) {
            echo ucwords( $_GET['type'].'s ' );
          } elseif ( isset( $_GET['view'] ) && $_GET['key'] !== "" ) {
            if ( $_GET['view'] == "list" ) {
              echo ucwords( $_GET['key']." List" );
            } else {
              echo ucwords( $_GET['key'] );
            }
          } elseif ( isset( $_GET['x'] ) && $_GET['key'] !== "" ) {
            if ( isset( $_GET['create'] ) ) {
              echo "Add New " . ucwords( $_GET['create'] );
            } elseif ( isset( $_GET['edit'] ) ) {
              echo "Editing " . ucwords( $_GET['key'] );
            } else {
              echo ucwords( $_GET['key'] );
            }
          } elseif ( isset( $_GET['x'] ) && $_GET['create'] !== "" ) {
            echo ucwords( "Create ".$_GET['create'] );
          } elseif ( isset( $_GET['x'] ) && $_GET['settings'] !== "" && !isset( $_GET['key'] ) ) {
            echo ucwords( $_GET['settings'].' Options' );
          } elseif ( isset( $_GET['create'] ) ) {
            echo "Add New ".ucwords( $_GET['create'].' ' );
          } elseif ( isset( $_GET['add'] ) ) {
            echo "Add New ".ucwords( $_GET['add'].' ' );
          } elseif ( isset( $_GET['chat'] ) ) {
            if ( $_GET['chat'] == "list" ) {
              echo "Chats List";
            } else {
              echo "Chat ".ucwords( $_GET['chat'] );
            }
          } elseif ( isset( $_GET['page'] ) ) {
            echo ucwords( $_GET['page'] );
          } elseif ( isset( $_GET['settings'] ) ) {
            echo ucwords( $_GET['settings'].' Options' );
          } elseif ( isset( $_GET['edit'] ) && $_GET['key'] !== "" ) {
            echo 'Editing '.ucwords( $_GET['key'].' ' );
          } elseif ( isset( $_GET['pay'] ) ) {
            echo "Pay Via ".strtoupper( $_GET['method'] );
          }
          ?></span>
          <div class="mdl-layout-spacer"></div>
          <a href="<?php _show_( hROOT ); ?>" class="material-icons mdl-badge mdl-badge--overlap mdl-button--icon notification" id="home"
               >
              visibility
          </a><div class="mdl-tooltip" for="home">View Site</div><?php 
          if ( isCap( 'admin' ) ) { ?>

          <span class="material-icons mdl-badge mdl-badge--overlap mdl-button--icon" id="happs">apps</span>
            <div class="mdl-tooltip" for="happs">Options</div><?php } ?>
            <ul class="mdl-menu mdl-js-menu mdl-js-ripple-effect mdl-menu--bottom-right option-drop mdl-card mdl-grid mdl-color--<?php primaryColor(); ?>" for="happs">
            <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone">
              <a class="" href="<?php _show_( hADMIN . 'options?page=general' ); ?>"><i class="material-icons mdl-list__item-icon">settings</i></a>
            </div>
            <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone">
              <a class="" href="<?php _show_( hADMIN . 'options?page=color' ); ?>"><i class="material-icons mdl-list__item-icon">palette</i></a>
            </div>
            <div class="mdl-cell">
            <a class="" href="<?php _show_( hADMIN . 'shop?view=list&key=products' ); ?>"><i class="material-icons mdl-list__item-icon">store</i></a>
            </div>
            <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone">
            <a class="" href="<?php _show_( hADMIN . 'shop?orders='.$_SESSION['myCode'] ); ?>"><i class="material-icons mdl-list__item-icon">shopping_basket</i></a>
            </div>
            <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone">
            <a class="" href="<?php _show_( hADMIN . 'shop?payments='.$_SESSION['myCode'] ); ?>"><i class="material-icons mdl-list__item-icon">monetization_on</i></a>
            </div>
            <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone">
            <a class="" href="<?php _show_( hADMIN . 'shop?author='.$_SESSION['myCode'] ); ?>"><i class="fa fa-cart-arrow-down mdl-list__item-icon" aria-hidden="true"></i></a>
            </div>
            <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone">
            <a class="" href="<?php _show_( hADMIN . 'options?page=shop' ); ?>"><i class="material-icons mdl-list__item-icon">shopping_cart</i></a>
            </div>
            <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone">
              <a class="" href="<?php _show_( hADMIN . 'post?view=list' ); ?>"><i class="material-icons mdl-list__item-icon">description</i></a>
            </div>
            <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone">
            <a class="" href="<?php _show_( hADMIN . 'wapi?events=list' ); ?>"><i class="material-icons mdl-list__item-icon">date_range</i></a>
            </div>
          </ul>

          <a href="./notification?view=list" class="material-icons mdl-badge mdl-badge--overlap mdl-button--icon notification" id="h_notifications"
               >
              notifications_none
          </a><div class="mdl-tooltip" for="h_notifications">Notifications</div>

          <a href="./message?view=inbox&key=my inbox" class="material-icons mdl-badge mdl-badge--overlap mdl-button--icon notification" id="h_messages"
                 data-badge="<?php getMsgCount() ?>">
                mail_outline
            </a><div class="mdl-tooltip" for="h_messages"><?php getMsgCount(); ?> Messages</div>
          
          <a href="#" class="material-icons mdl-js-button mdl-badge mdl-badge--overlap mdl-button--icon" id="hvdrbtn">perm_identity</a>
          <ul class="mdl-menu mdl-list mdl-js-menu mdl-js-ripple-effect mdl-menu--bottom-right option-drop mdl-color--<?php primaryColor(); ?>" for="hvdrbtn">
          <a id="profile" href="./user?view=<?php _show_( $_SESSION['myCode'] ); ?>&key=<?php _show_( $_SESSION['myAlias'] ); ?>" class="mdl-list__item"><i class="mdi mdi-account mdl-list__item-icon alignright"></i><span style="padding-left: 20px"><?php _show_( $_SESSION['myAlias'] ); ?></span></a>
          <a id="profedit" href="./user?edit=<?php _show_( $_SESSION['myCode'] ); ?>&key=<?php _show_( $_SESSION['myAlias'] ); ?>" class="mdl-list__item"><i class="mdi mdi-account-edit mdl-list__item-icon"></i><span style="padding-left: 20px">Edit Account</span></a>
          <a id="hdrbtn" href="#" class="mdl-list__item"><i class="mdi mdi-exit-to-app mdl-list__item-icon"></i><span style="padding-left: 20px">Logout</span></a>
          </ul>
          <div id="exitModal" class="modal">
              <div class="modal-content mdl-card mdl-shadow--2dp mdl-color--orange">
                <div class="mdl-card__title">
                  <div class="mdl-card__title-text">Are You Sure?</div>
                    <div class="mdl-layout-spacer"></div>
                    <div class="mdl-card__subtitle-text">
                        
                    </div>
                  </div>
                  <div class="mdl-card__supporting-text">
                  <a href="<?php _show_( hROOT . '?logout=true' ); ?>">
                    <span class="alignleft">Yes, log me out.<br><center>
                   <i class="material-icons">done</i>
                    </center>
                    </span></a>

                    <div class="mdl-layout-spacer"></div>
                    <span class="alignright eclose">
                        Keep me logged in.<br>
                        <center>
                              <i class="material-icons mdl-button--icon">clear</i>
                        </center>
                    </span>
                  </div>
                </div>
          </div>

        <script>
        var emodal = document.getElementById('exitModal' );
        var h = document.getElementById( "hdrbtn" );
        var span = document.getElementsByClassName( "eclose" )[0];
        h.onclick = function() {
            emodal.style.display = "block";
        }
        span.onclick = function() {
            emodal.style.display = "none";
        }
        window.onclick = function(event) {
            if ( event.target == emodal ) {
               emodal.style.display = "none";
            }
        }
        </script>
        </div>
      </header>
      <div class="mdl-layout__drawer mdl-color--<?php primaryColor(); ?> mdl-color-text--blue-grey-50">
        <header class="demo-drawer-header">
          <a href="./user?view=<?php _show_( $_SESSION['myCode'] ); ?>&key=<?php _show_( $_SESSION['myAlias'] ); ?>">
            <img src="<?php _show_( $_SESSION['myAvatar'] ); ?>" class="demo-avatar">
          </a>
          <div class="demo-avatar-dropdown">
            <span><?php _show_( $_SESSION['myAlias'] ); ?></span>
            <div class="mdl-layout-spacer"></div>
            <a href="./user?edit=<?php _show_( $_SESSION['myCode'] ); ?>&key=<?php _show_( $_SESSION['myAlias'] ); ?>"><button id="accbtn" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
              <i class="mdi mdi-account-edit" role="presentation"></i></button></a>
          </div>
        </header>
        <nav class="demo-navigation mdl-navigation mdl-color--<?php primaryColor(); ?>"><?php 
          $hMenu -> drawerdef( 'dashboard' );
          $hMenu -> drawerdef( 'articles' );
          $hMenu -> drawerdef( 'pages' );
          $hMenu -> drawerdef( 'users' );
          $hMenu -> drawerdef( 'extensions' );
          $hMenu -> drawerdef( 'messages' );
          /*
          * User Defined Menus
          */
          $hMenu -> drawer(); ?>
          <div class="mdl-layout-spacer"></div>
          <a class="mdl-navigation__link" id="extensions" href="#"><i class="mdl-color-text--white material-icons" role="presentation">power</i>Extensions</a>
          <ul class="mdl-menu mdl-list mdl-js-menu mdl-js-ripple-effect mdl-menu--top-left mdl-color--<?php primaryColor(); ?>" for="extensions">
          <a class="mdl-navigation__link" href="./extensions?view=active"><i class="mdl-color-text--white material-icons" role="presentation">schedule</i><span>Active Extensions</span></a>
          <a class="mdl-navigation__link" href="./extensions?view=installed"><i class="mdl-color-text--white material-icons" role="presentation">link</i><span>Installed Extensions</span></a>
          <a class="mdl-navigation__link" href="./extensions?add=new"><i class="mdl-color-text--white material-icons" role="presentation">file_download</i><span>Add Extensions</span></a>
          </ul>
          
          <a id="hpref" class="mdl-navigation__link" href="#"><i class="mdl-color-text--white material-icons" role="presentation">settings</i>Preferences</a>
            <ul class="mdl-menu mdl-list mdl-js-menu mdl-js-ripple-effect mdl-menu--top-left mdl-color--<?php primaryColor(); ?>" for="hpref">
            <a class="mdl-navigation__link" href="./options?settings=color"><i class="mdl-color-text--white material-icons" role="presentation">color_lens</i><span>Color Options</span></a><?php 
          if ( isCap( 'admin' ) ) { ?>
          <a class="mdl-navigation__link" href="./menus?settings=menu"><i class="mdl-color-text--white material-icons" role="presentation">menu</i><span>Menu Options</span></a>
          <a class="mdl-navigation__link" href="./options?settings=user"><i class="mdl-color-text--white material-icons" role="presentation">build</i><span>User Options</span></a>
          <a class="mdl-navigation__link" href="./options?settings=social"><i class="mdl-color-text--white material-icons" role="presentation">public</i><span>Social Settings</span></a>
          <a class="mdl-navigation__link" href="./options?settings=general"><i class="mdl-color-text--white material-icons" role="presentation">tune</i><span>General Settings</span></a>
          <a class="mdl-navigation__link" href="./update?settings=update"><i class="mdl-color-text--white material-icons" role="presentation">update</i><span>Jabali Updates</span></a>
          <?php } ?>
            </ul>
        </nav>
      </div>
      <main class="mdl-layout__content mdl-color--">