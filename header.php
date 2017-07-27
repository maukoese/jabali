<?php 
session_start();

if ( isset( $_GET['logout'] ) ) {
  session_unset();
  session_destroy();
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
    <meta name="description" content="<?php showOption( 'description' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Add to homescreen for Chrome on Android -->
    <meta name="mobile-web-app-capable" content="yes">


    <!-- Add to homescreen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="<?php showOption( 'name' ); ?>">


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
    .accent, .mdl-button--fab.mdl-button--colored, .mdl-button.mdl-button--colored, .mdl-badge[data-badge]:after {
        background-color: <?php if ( isset( $_SESSION['myCode'] ) ) { secondaryColor(); } else { echo "red"; } ?>;
    }

    .cke_bottom {
      background: <?php if ( isset( $_SESSION['myCode'] ) ) { secondaryColor(); } else { echo "red"; } ?>;
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
<div class="mdl-layout mdl-layout-transparent mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
  <body>
  <header class="mdl-layout__header mdl-layout__header--waterfall mdl-color-text--grey-600 mdl-color--<?php if ( isset( $_SESSION['myCode'] ) ) { primaryColor(); } else { echo "madge"; } ?>">
    <div class="mdl-layout__header-row">
      <a href="<?php if ( file_exists('./inc/config.php' ) ) {
      echo hROOT;
      } else { echo './'; } ?>">
        <span class="mdl-layout-title"><img src="<?php if ( file_exists('./inc/config.php' ) ) {
          echo hIMAGES.'head-w.png';
          } else { echo './assets/images/head-w.png'; } ?>" width="100px;">
        </span>
      </a>
      <div class="mdl-layout-spacer"></div>
      <a href="http://github.com/maukoese/jabali" class="mdi mdi-github-circle mdl-badge mdl-badge--overlap mdl-button--icon notification" id="github"></a>
      <div class="mdl-tooltip" for="github">Github</div>

      <a href="<?php echo hROOT.'about'; ?>" class="mdi mdi-email mdl-badge mdl-badge--overlap mdl-button--icon notification" id="h_contact"></a>
      <div class="mdl-tooltip" for="h_contact">Contact</div>

      <a href="<?php echo hROOT.'register?type=user'; ?>" class="mdi mdi-account-plus mdl-badge mdl-badge--overlap mdl-button--icon notification" id="h_submit"></a>
      <div class="mdl-tooltip" for="h_submit">Register</div>

      <?php if ( isset( $_SESSION['myCode'] ) ) { ?>
      <a id="admin" href="#" class="mdi mdi-lock mdl-badge mdl-badge--overlap mdl-button--icon"></a>
      <div class="mdl-tooltip" for="admin">Admin</div>
        <ul class="mdl-menu mdl-js-menu mdl-js-ripple-effect mdl-menu--bottom-right option-drop mdl-color--<?php primaryColor(); ?>" for="admin">
        <a class="mdl-cell" href="<?php _show_(  hADMIN .'index?page=my dashboard' ); ?>"><i class="material-icons mdl-list__item-icon">dashboard</i></a>
        <a class="mdl-cell" href="<?php _show_(  hADMIN .'user?view='. $_SESSION['myCode'] .'&key='.$_SESSION['myAlias'] ); ?>"><i class="material-icons mdl-list__item-icon">perm_identity</i></a>
        <a class="mdl-cell" href="<?php _show_(  hADMIN .'options?settings=color' ); ?>"><i class="material-icons mdl-list__item-icon">palette</i></a>
        </ul><?php
      } else { ?>
      <a id="admin" href="<?php _show_(  hROOT.'login' ); ?>" class="mdi mdi-exit-to-app mdl-badge mdl-badge--overlap mdl-button--icon"></a><?php 
      } ?>

    </div>
    <!-- Bottom row, not visible on scroll -->
    <div class="mdl-layout__header-row" style="overflow-x: auto;">
      <div class="mdl-layout-spacer"></div>
        <?php $header = new _hMenus();
        $header -> header(); ?>
    </div>
  </header>
  <main class="mdl-layout__content mdl-color-text--white">