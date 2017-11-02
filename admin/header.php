<?php
if ( !isset( $_SESSION[JBLSALT.'Code'] ) ) {
  header( "Location: ". _ROOT ."/login/jabali" );
}

if ( isset( $_SESSION[JBLSALT.'Code' ] ) ) {
  $GStyles = $GLOBALS['JBLDB'] -> query( "SELECT style FROM ". _DBPREFIX ."users  WHERE id='".$_SESSION[JBLSALT.'Code']."'" );
  if ( $GLOBALS['JBLDB'] -> numRows( $GStyles ) > 0 ) {
    $f = array();
    while ( $s = $GLOBALS['JBLDB'] -> fetchArray( $GStyles )) {
      $f[] = $s;
    }
    if ( $f[0]['style'] !== "" ) {
      $key = $f[0]['style'];
    } else {
      $key = "zahra";
    }
  } else {
    $key = "zahra";
  }
} else {
  $key = "zahra";
}

$GUSkin = $GLOBALS['SKINS'][$key];
$GLOBALS['GPrimary'] = $GUSkin['primary'];
$GLOBALS['GAccent'] = $GUSkin['accent'];
$GLOBALS['GTextP'] = $GUSkin['textp'];
$GLOBALS['GTextS'] = $GUSkin['texts']; ?>
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
    <?php head();
    loadStyles( [ _STYLES."lib/getmdl-select.min.css", _STYLES."lib/nv.d3.css"] ); ?>

    <link rel="stylesheet" href='<?php echo _STYLES; ?>lib/getmdl-select.min.css'>
    <link rel="stylesheet" href="<?php echo _STYLES; ?>lib/nv.d3.css">
    <link rel="stylesheet" href="<?php echo _STYLES; ?>jquery-ui.css">
    <?php if ( isLocalhost() ){ ?>
    <link rel="stylesheet" href="<?php echo _STYLES; ?>material-icons.css">
    <link rel="stylesheet" href="<?php echo _STYLES; ?>font-awesome.css">
    <?php } else { ?>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <?php } ?>
    <link rel="stylesheet" href="<?php echo _STYLES; ?>materialdesignicons.css">
    <link rel="stylesheet" href="<?php echo _STYLES; ?>jabali.css">
    <link rel="stylesheet" href="<?php echo _STYLES; ?>colors.css">
    <link rel="stylesheet" href="<?php echo _STYLES; ?>pmd/table/table.css">
    <link rel="stylesheet" href="<?php echo _STYLES; ?>pmd/table/card.css">

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
    <script src="<?php echo _SCRIPTS ?>jquery-3.2.1.min.js"></script>
    <script src="<?php echo _SCRIPTS ?>jquery.canvasjs.min.js"></script>
    <?php if ( isLocalhost() ) { ?>
      <script src="<?php echo _SCRIPTS ?>ace/ace.js"></script><?php
    } else { ?>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.1.3/ace.js"></script>
    <?php } ?>
    <script src="<?php echo _SCRIPTS ?>jquery-ui.js"></script>
    <script src="<?php echo _SCRIPTS ?>ckeditor/ckeditor.js"></script><script src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"></script>
  </head>
  <body>
    <div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
      <header class="demo-header mdl-layout__header mdl-color-text--grey-600 mdl-color--<?php primaryColor(); ?>">
        <div class="mdl-layout__header-row">
          <span class="mdl-layout-title"><?php
          if ( isset( $_GET['type'] ) ) {
            echo ucwords( $_GET['type'].'s ' );
          } elseif ( isset( $_GET['view'] ) ) {
            if ( $_GET['view'] == "list" ) {
              echo ucwords( $_GET['key']." List" );
            } else {
              echo ucwords( $_GET['key'] );
            }
          } elseif ( isset( $_GET['x'] ) && isset( $_GET['key'] ) ) {
            if ( isset( $_GET['create'] ) ) {
              echo "Add New " . ucwords( $_GET['create'] );
            } elseif ( isset( $_GET['edit'] ) ) {
              echo "Editing " . ucwords( $_GET['key'] );
            } elseif ( isset( $_GET['settings'] ) ) {
              echo ucwords( $_GET['settings'] );
            }
          } elseif ( isset( $_GET['x'] ) && isset( $_GET['create'] ) ) {
            echo ucwords( "Create ".$_GET['create'] );
          } elseif ( isset( $_GET['x'] ) && isset( $_GET['settings'] ) && !isset( $_GET['key'] ) ) {
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
          <a href="<?php echo( _ROOT ); ?>" class="material-icons mdl-badge mdl-badge--overlap mdl-button--icon notification" id="home" >visibility
          </a>
          <div class="mdl-tooltip" for="home">View Site</div>

          <a href="messages?view=list&type=notification" class="material-icons mdl-badge mdl-badge--overlap mdl-button--icon notification" id="h_notifications" data-badge="<?php getNoteCount() ?>">notifications_none
          </a>
          <div class="mdl-tooltip" for="h_notifications"><?php getNoteCount() ?> Notifications</div>

          <a href="messages?view=unread&key=unread%20messages#" class="material-icons mdl-badge mdl-badge--overlap mdl-button--icon" id="h_messages" data-badge="<?php getMsgCount() ?>">mail_outline
            </a><div class="mdl-tooltip" for="h_messages"><?php getMsgCount(); ?> Messages</div>

         <!--  <a href="#" class="material-icons mdl-js-button mdl-badge mdl-badge--overlap mdl-button--icon notification" id="hvdrbtn">apps</a>
          <ul class="mdl-menu mdl-list mdl-js-menu mdl-js-ripple-effect mdl-menu--bottom-right option-drop mdl-color--<?php primaryColor(); ?>" for="hvdrbtn">
          <a id="profile" href="users?view=<?php echo( $_SESSION[JBLSALT.'Code'] ); ?>&key=<?php echo( $_SESSION[JBLSALT.'Alias'] ); ?>" class="mdl-list__item"><i class="mdi mdi-account mdl-list__item-icon alignright"></i><span style="padding-left: 20px"><?php echo( $_SESSION[JBLSALT.'Alias'] ); ?></span></a>
          <a id="profedit" href="./users?edit=<?php echo( $_SESSION[JBLSALT.'Code'] ); ?>&key=<?php echo( $_SESSION[JBLSALT.'Alias'] ); ?>" class="mdl-list__item"><i class="mdi mdi-account-edit mdl-list__item-icon"></i><span style="padding-left: 20px">Edit Account</span></a>
          <a id="hdrbtn" href="<?php echo( _ROOT . '?logout' ); ?>" class="mdl-list__item"><i class="mdi mdi-exit-to-app mdl-list__item-icon"></i><span style="padding-left: 20px">Logout</span></a>
          </ul> -->

          <a href="#" class="material-icons mdl-js-button mdl-badge mdl-badge--overlap mdl-button--icon" id="dvdrbtn">more_vert</a>
          <ul class="mdl-menu mdl-list mdl-js-menu mdl-js-ripple-effect mdl-menu--bottom-right mdl-color--<?php primaryColor(); ?>" for="dvdrbtn">
            <?php
            $default = array( 'general', 'color', 'misc', 'types', 'restful', 'social', 'editor' ); foreach( $GLOBALS['GSettings'] as $setting => $vals ): ?>
              <?php if ( !in_array( $setting, $default ) ): ?>
                <a id="profile" href="options?options=<?php echo( $setting ); ?>&page=<?php echo( ucwords( $vals[0][2] ) ); ?> Options" class="mdl-list__item"><i class="mdi mdi-settings mdl-list__item-icon"></i><span style="padding-left: 20px"><?php echo( ucwords( $vals[0][2] ) ); ?></span></a>
              <?php endif ?>
            <?php endforeach; ?>
          <a id="hdrbtn" href="<?php echo( _ROOT . '/?logout' ); ?>" class="mdl-list__item"><i class="mdi mdi-exit-to-app mdl-list__item-icon"></i><span style="padding-left: 20px">Logout</span></a>
          </ul>
        </div>
      </header>
      <div class="mdl-layout__drawer mdl-color--<?php primaryColor(); ?> mdl-color-text--blue-grey-50">
        <header class="demo-drawer-header">
          <a href="./users?view=<?php echo( $_SESSION[JBLSALT.'Code'] ); ?>&key=<?php echo( $_SESSION[JBLSALT.'Alias'] ); ?>">
          <?php $avatar = file_exists( $_SESSION[JBLSALT.'Avatar'] ) ?: _IMAGES.'avatar.svg' ?>
            <img src="<?php echo( $avatar ); ?>" class="demo-avatar">
          </a>
          <div class="demo-avatar-dropdown">
            <span><?php echo( $_SESSION[JBLSALT.'Alias'] ); ?></span>
            <div class="mdl-layout-spacer"></div>
            <a href="./users?edit=<?php echo( $_SESSION[JBLSALT.'Code'] ); ?>&key=<?php echo( $_SESSION[JBLSALT.'Alias'] ); ?>"><button id="accbtn" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
              <i class="mdi mdi-account-edit" role="presentation"></i></button></a>
          </div>
        </header>
        <nav class="demo-navigation mdl-navigation mdl-color--<?php primaryColor(); ?>"><?php
          global $hMenu;
          $hMenu -> drawerdef( 'dashboard' );
          $hMenu -> drawerdef( 'posts' );
          $hMenu -> drawerdef( 'users' );
          $hMenu -> drawerdef( 'comments' );
          /*
          * User Defined Menus
          */
          $hMenu -> drawer(); ?><?php
          if ( isCap( 'admin' ) ) { ?>
          <a id="themes" class="mdl-navigation__link" href="#"><i class="mdl-color-text--white material-icons" role="presentation">palette</i>Themes</a>
          <ul class="mdl-menu mdl-list mdl-js-menu mdl-js-ripple-effect mdl-menu--top-left mdl-color--<?php primaryColor(); ?>" for="themes">
          <a class="mdl-navigation__link" href="themes?page=themes"><i class="mdl-color-text--white material-icons" role="presentation">arrow_downward</i><span>Installed</span></a>
          <a class="mdl-navigation__link" href="themes?showcase=all&page=themes%20showcase"><i class="mdl-color-text--white material-icons" role="presentation">arrow_upward</i><span>Add New</span></a>
          <a class="mdl-navigation__link" href="themes?page=widgets"><i class="mdl-color-text--white material-icons" role="presentation">widgets</i><span>Widgets</span></a>
            </ul>
          <a id="extensions" class="mdl-navigation__link" href="modules?page=extension modules"><i class="mdl-color-text--white material-icons" role="presentation">power</i>Modules</a><?php } ?>
          <a id="htools" class="mdl-navigation__link" href="#"><i class="mdl-color-text--white material-icons" role="presentation">import_export</i>Transfer</a>
          <ul class="mdl-menu mdl-list mdl-js-menu mdl-js-ripple-effect mdl-menu--top-left mdl-color--<?php primaryColor(); ?>" for="htools"><?php
          if ( isCap( 'admin' ) ) { ?>
          <a class="mdl-navigation__link" href="tools?page=import"><i class="mdl-color-text--white material-icons" role="presentation">arrow_downward</i><span>Import Data</span></a>
          <a class="mdl-navigation__link" href="tools?page=export"><i class="mdl-color-text--white material-icons" role="presentation">arrow_upward</i><span>Export Data</span></a>
          <?php } ?>
            </ul>

          <div class="mdl-layout-spacer"></div>
          <a id="hpref" class="mdl-navigation__link" href="#"><i class="mdl-color-text--white material-icons" role="presentation">settings</i>Preferences</a>
            <ul class="mdl-menu mdl-list mdl-js-menu mdl-js-ripple-effect mdl-menu--top-left mdl-color--<?php primaryColor(); ?>" for="hpref">
            <a class="mdl-navigation__link" href="options?settings=color"><i class="mdl-color-text--white material-icons" role="presentation">color_lens</i><span>Color Options</span></a><?php
          if ( isCap( 'admin' ) ) { ?>
          <a class="mdl-navigation__link" href="pwa?settings=progressive app"><i class="mdl-color-text--white material-icons" role="presentation">touch_app</i><span>Progressive App</span></a>
          <a class="mdl-navigation__link" href="update?settings=update"><i class="mdl-color-text--white material-icons" role="presentation">update</i><span>Jabali Updates</span></a>
          <a class="mdl-navigation__link" href="menus?settings=menu"><i class="mdl-color-text--white material-icons" role="presentation">menu</i><span>Menu Options</span></a>
          <a class="mdl-navigation__link" href="options?settings=misc"><i class="mdl-color-text--white material-icons" role="presentation">public</i><span>Miscelleaneous</span></a>
          <a class="mdl-navigation__link" href="options?settings=editor"><i class="mdl-color-text--white material-icons" role="presentation">edit</i><span>Editor Options</span></a>
          <a class="mdl-navigation__link" href="options?settings=restful"><i class="mdl-color-text--white material-icons" role="presentation">public</i><span>REST Options</span></a>
          <a class="mdl-navigation__link" href="options?settings=types"><i class="mdl-color-text--white material-icons" role="presentation">build</i><span>Types Options</span></a>
          <a class="mdl-navigation__link" href="options?settings=general"><i class="mdl-color-text--white material-icons" role="presentation">tune</i><span>General Settings</span></a>
          <?php } ?>
            </ul>
        </nav>
      </div>
      <main class="mdl-layout__content">
