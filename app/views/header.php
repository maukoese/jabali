<?php 

?>
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
        echo _IMAGES."marker.png"; 
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

    <link rel="manifest" href="<?php echo _ROOT.'manifest.php;' ?>">

    <link rel="stylesheet" href='<?php echo _STYLES; ?>lib/getmdl-select.min.css'>
    <link rel="stylesheet" href="<?php echo _STYLES; ?>lib/nv.d3.css">
    <link rel="stylesheet" href="<?php echo _STYLES; ?>jquery-ui.css">
    <link rel="stylesheet" href="<?php echo _STYLES; ?>materialize.css">
    <link rel="stylesheet" href="<?php echo _STYLES; ?>material-icons.css">
    <link rel="stylesheet" href="<?php echo _STYLES; ?>materialdesignicons.css">
    <link rel="stylesheet" href="<?php echo _STYLES; ?>font-awesome.css">
    <link rel="stylesheet" href="<?php echo _STYLES; ?>jabali.css">
    <!-- <link rel="stylesheet" href="app/styles.php"> -->
    <style type="text/css">
    .mdl-menu__outline {
        background-color: <?php primaryColor(); ?>;
        overflow-y: auto;
    }

    .primary {
        color: <?php primaryColor(); ?>;
    }
    .accent, a {
        color: <?php if ( isset( $_SESSION[JBLSALT.'Code'] ) ) { secondaryColor(); } else { echo "red"; } ?>;
    }
    .accent, .mdl-button--fab.mdl-button--colored, .mdl-button.mdl-button--colored, .mdl-badge[data-badge]:after {
        background-color: <?php if ( isset( $_SESSION[JBLSALT.'Code'] ) ) { secondaryColor(); } else { echo "red"; } ?>;
    }

    .cke_bottom {
      background: <?php if ( isset( $_SESSION[JBLSALT.'Code'] ) ) { secondaryColor(); } else { echo "red"; } ?>;
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

    <script src="<?php echo _SCRIPTS; ?>jquery-3.2.1.min.js"></script>
    <script src="<?php echo _SCRIPTS; ?>jquery-ui.min.js"></script>
    <script src="<?php echo _ASSETS; ?>js/ckeditor/ckeditor.js"></script>
    <script src="<?php echo _ASSETS; ?>js/list.js"></script>
</head>
<div class="mdl-layout mdl-layout-transparent mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
  <body>
  <header class="mdl-layout__header mdl-layout__header--waterfall mdl-color-text--grey-600 mdl-color--<?php if ( isset( $_SESSION[JBLSALT.'Code'] ) ) { primaryColor(); } else { echo "madge"; } ?>">
    <div class="mdl-layout__header-row">
      <a href="<?php echo _ROOT; ?>">
        <span class="mdl-layout-title">
          <img src="<?php echo _IMAGES.'head-w.png'; ?>" width="100px;">
        </span>
      </a>
      <div class="mdl-layout-spacer"></div>

      <?php if ( isset( $_SESSION[JBLSALT.'Code'] ) ) { ?>
      <a id="admin" href="#" class="mdi mdi-lock mdl-badge mdl-badge--overlap mdl-button--icon"></a>
      <div class="mdl-tooltip" for="admin">Admin</div>
        <ul class="mdl-menu mdl-js-menu mdl-js-ripple-effect mdl-menu--bottom-right option-drop mdl-color--<?php primaryColor(); ?>" for="admin">
        <a class="mdl-cell" href="<?php echo(  _ADMIN .'index?page=my dashboard' ); ?>"><i class="material-icons mdl-list__item-icon">dashboard</i></a>
        <a class="mdl-cell" href="<?php echo(  _ADMIN .'users?view='. $_SESSION[JBLSALT.'Code'] .'&key='.$_SESSION[JBLSALT.'Alias'] ); ?>"><i class="material-icons mdl-list__item-icon">perm_identity</i></a>
        <a class="mdl-cell" href="<?php echo(  _ADMIN .'options?settings=color' ); ?>"><i class="material-icons mdl-list__item-icon">palette</i></a>
        </ul><?php
      } else { ?>
      <a id="admin" href="<?php echo(  _ROOT.'signin/jabali' ); ?>" class="mdi mdi-exit-to-app mdl-badge mdl-badge--overlap mdl-button--icon"></a><?php 
      } ?>

    </div>
  </header>
  <main class="mdl-layout__content mdl-color-text--white">