<?php 
session_start();

if ( isset( $_GET['logout'] ) ) {
  session_unset();
  session_destroy();
}

include './inc/jabali.php';
if ( file_exists('./inc/config.php' ) ) {
    connectDb();
} ?>
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
    <link rel="shortcut icon" href="<?php 
    if ( file_exists('./inc/config.php' ) ) {
        showOption( 'favicon' );
    } else {
        echo hIMAGES."marker.png"; 
    } ?>">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="A front-end template that helps you build fast, modern mobile web apps.">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Add to homescreen for Chrome on Android -->
    <meta name="mobile-web-app-capable" content="yes">


    <!-- Add to homescreen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Material Design Lite">


    <!-- Tile icon for Win8 (144x144 + tile color) -->
    <meta name="msapplication-TileImage" content="images/touch/ms-touch-icon-144x144-precomposed.png">
    <meta name="msapplication-TileColor" content="#3372DF">

    <link rel="stylesheet" href='<?php echo hSTYLES; ?>lib/getmdl-select.min.css'>
    <link rel="stylesheet" href="<?php echo hSTYLES; ?>lib/nv.d3.css">
    <link rel="stylesheet" href="<?php echo hSTYLES; ?>jquery-ui.css">
    <link rel="stylesheet" href="<?php echo hSTYLES; ?>materialize.css">
    <link rel="stylesheet" href="<?php echo hSTYLES; ?>material-icons.css">
    <link rel="stylesheet" href="<?php echo hSTYLES; ?>materialdesignicons.css">
    <link rel="stylesheet" href="<?php echo hSTYLES; ?>font-awesome.css">
    <link rel="stylesheet" href="<?php echo hSTYLES; ?>jabali.css">
    <style type="text/css">
    .mdl-menu__outline {
        background-color: <?php primaryColor(); ?>;
        overflow-y: auto;
    }

    .primary {
        color: <?php primaryColor(); ?>;
    }
    .accent, a {
        color: <?php if ( isset( $_SESSION['myCode'] ) ) { secondaryColor(); } else { echo "red"; } ?>;
    }
    .accent, .mdl-button--fab.mdl-button--colored, .mdl-badge[data-badge]:after {
        background-color: <?php if ( isset( $_SESSION['myCode'] ) ) { secondaryColor(); } else { echo "red"; } ?>;
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

    <script src="<?php echo hSCRIPTS; ?>jquery-3.2.1.min.js"></script>
    <script src="<?php echo hSCRIPTS; ?>jquery-ui.min.js"></script>
    <script src="<?php echo hASSETS; ?>js/ckeditor/ckeditor.js"></script>
    <script src="<?php echo hASSETS; ?>js/list.js"></script>
</head>
<div class="mdl-layout mdl-layout-transparent mdl-layout__header--waterfall mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
  <body>
  <header class="mdl-layout__header mdl-color-text--grey-600 mdl-layout__header mdl-color--<?php if ( isset( $_SESSION['myCode'] ) ) { primaryColor(); } else { echo "madge"; } ?>">
    <div class="mdl-layout__header-row">
      <a href="<?php if ( file_exists('./inc/config.php' ) ) {
      echo hROOT;
      } else { echo './'; } ?>">
        <span class="mdl-layout-title"><img src="<?php if ( file_exists('./inc/config.php' ) ) {
          echo hIMAGES.'ecom.png';
          } else { echo './assets/images/ecom.png'; } ?>" width="120px;">
        </span>
      </a>
      <div class="mdl-layout-spacer"></div>
      <a href="./login" class="mdl-button mdl-button--colored notification" id="github">HOME | </a><a href="./login" class="mdl-button mdl-button--colored notification" id="github">ABOUT US | </a><a href="./login" class="mdl-button mdl-button--colored notification" id="github">INVITE A FRIEND</a> <a href="#" class="mdl-button mdl-button--colored notification" id="github"></a>
      <a href="./login" class="mdl-button notification" id="login">LOGIN</a>
      <div class="mdl-tooltip" for="login">Login</div>

      <a href="register?type=user" class="mdl-button notification" id="register">Register</a>
      <div class="mdl-tooltip" for="register">Register</div>

      <a href="./shop" class="material-icons mdl-badge mdl-badge--overlap mdl-button--icon" id="h_messages" data-badge="0" tabindex="0">
                shopping_cart
            </a>
      <div class="mdl-tooltip" for="h_messages">Shop</div>

      <a href="<?php echo hROOT.'register?type=user'; ?>" class="mdi mdi-facebook mdl-badge mdl-badge--overlap mdl-button--icon notification" id="facebook"></a>
      <div class="mdl-tooltip" for="facebook">Facebook</div>

      <a href="<?php echo hROOT.'register?type=user'; ?>" class="mdi mdi-twitter mdl-badge mdl-badge--overlap mdl-button--icon notification" id="twitter"></a>
      <div class="mdl-tooltip" for="twitter">Twitter</div>

      <a id="admin" href="#" class="mdi mdi-menu mdl-badge mdl-badge--overlap mdl-button--icon"></a>
      <div class="mdl-tooltip" for="admin">Admin</div>
        <ul class="mdl-menu mdl-js-menu mdl-js-ripple-effect mdl-menu--bottom-right option-drop mdl-color--pink" for="admin">
        <a href="./login" class="mdl-list__item"><i class="mdi mdi-exit-to-app mdl-list__item-icon"></i><span style="padding-left: 20px">LOGIN</span></a>
        <a href="./register" class="mdl-list__item"><i class="mdi mdi-account-plus mdl-list__item-icon"></i><span style="padding-left: 20px">REGISTER</span></a>
        <a href="./login" class="mdl-list__item"><i class="mdi mdi-help mdl-list__item-icon"></i><span style="padding-left: 20px">FAQ</span></a>
        <a href="./contact" class="mdl-list__item"><i class="mdi mdi-email mdl-list__item-icon"></i><span style="padding-left: 20px">CONTACT</span></a>
        <div class="mdl-layout-spacer"></div>
        <a href="./" class="mdl-list__item"><i class="mdi mdi-home mdl-list__item-icon"></i><span style="padding-left: 20px">HOME</span></a>
        </ul>
    </div>
  </header>
  <main class="mdl-layout__content mdl-color-text--white">