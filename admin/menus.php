<?php  
include '../inc/config.php';
include '../inc/jabali.php';
include './header.php';

if ( isset( $_POST['create'] ) ) {
     $h_alias = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_alias'] );
     $h_author = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_author'] );
     $h_avatar = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_avatar'] );
     $h_code = strtolower( str_replace(' ', '', $h_alias ) );
     if ( empty( $_POST['h_type'] ) ) {
     $h_type = "nil";
     } else {
         $h_type = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_type'] );
     }
     $h_for = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_for'] );
     $h_for = strtolower( str_replace(' ', '', $h_for ) );
     $h_link = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_link'] );
     $h_location = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_location'] );
     $h_location = strtolower( $h_location );
     $h_status = $_POST['h_status'];

     $hMenu -> create ( $h_alias, $h_author, $h_avatar, $h_code, $h_for, $h_link, $h_location, $h_status, $h_type );
}

if ( isset( $_POST['update'] ) ) {
     $h_alias = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_alias'] );
     $h_author = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_author'] );
     $h_avatar = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_avatar'] );
     $h_code = strtolower( str_replace(' ', '', $h_alias ) );
     if ( empty( $_POST['h_type'] ) ) {
     $h_type = "item";
     } else {
         $h_type = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_type'] );
     }
     $h_for = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_for'] );
     $h_for = strtolower( str_replace(' ', '', $h_for ) );
     $h_link = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_link'] );
     $h_location = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_location'] );
     $h_location = strtolower( $h_location );
     $h_status = $_POST['h_status'];

     $hMenu -> update ( $h_alias, $h_author, $h_avatar, $h_code, $h_for, $h_link, $h_location, $h_status, $h_type );
} ?>
<div class="mdl-grid">

<div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>"><?php
if (isset( $_GET['add'] )) { ?>
          <title>Add New Menu [ <?php showOption( 'name' ); ?> ]</title>
         <div class="mdl-card__supporting-text">
           <form class="" action="?add<?php if ( !empty( $_GET['add'] )) {
                echo "=".$_GET['add'];
              } ?>" method="POST" >
             <div class="input-field">
               <i class="material-icons prefix">label</i>
             <input id="h_alias" name="h_alias" type="text">
             <label for="h_by">Label</label>
             </div>

            <div class="input-field">
              <i class="material-icons prefix">link</i>
            <input id="h_link" name="h_link" type="text" value="<?php _show_( $menu[0]['h_link'] ); ?>">
            <label for="h_link">Link</label>
            </div>

             <?php $hMenu -> materialIcons( '' ); ?>

             <input type="hidden" name="h_author" value="<?php _show_( $_SESSION['myCode'] ); ?>">

             <div class="input-field inline mdl-js-textfield getmdl-select">
               <i class="material-icons prefix">room</i>
              <input class="mdl-textfield__input" id="h_location" name="h_location" type="text" tabIndex="-1" placeholder="<?php _show_( 'Location' ); ?>" value="<?php if ( !empty( $_GET['add'] )) {
                echo ucwords( $_GET['add'] );
              } else {  } ?>" >
                <ul class="mdl-menu mdl-menu--top-left mdl-js-menu mdl-color--<?php primaryColor(); ?>" for="h_location">
                  <li class="mdl-menu__item" data-val="drawer">Drawer</li>
                  <li class="mdl-menu__item" data-val="header">Header</li>
                  <li class="mdl-menu__item" data-val="main">Main</li>
                  <li class="mdl-menu__item" data-val="footer">Footer</li>
                </ul>
             </div>

              <div class="input-field inline mdl-js-textfield mdl-textfield--floating-label getmdl-select">
               <i class="material-icons prefix">label_outline</i>
              <input class="mdl-textfield__input" id="h_for" name="h_for" type="text" readonly tabIndex="-1"  placeholder="For..." >
                <ul class="mdl-menu mdl-menu--top-left mdl-js-menu mdl-color--<?php primaryColor(); ?>" for="h_for" style="max-height: 300px !important; overflow-y: auto;"><?php
               $getMenu = mysqli_query( $GLOBALS['conn'], "SELECT * FROM ". hDBPREFIX ."menus WHERE h_type = 'drop'");
               if ( $getMenu -> num_rows > 0 ) {
                    while ($menu = mysqli_fetch_assoc( $getMenu )) {
                         echo '<li class="mdl-menu__item" data-val="'.$menu['h_alias'].'">'.ucwords( $menu['h_alias'] ).'</i></li>'; 
                    }
               } ?>
                </ul>
                </div><br>
                <div class="mdl-grid">

                <div class="input-field mdl-cell">
                  <input type="checkbox" id="h_type" name="h_type" value="drop" >
                  <label for="h_type">Has Dropdown</label>
                </div>

                <div class="input-field mdl-cell">
                <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="switch-2">
                  <input type="checkbox" id="switch-2" class="mdl-switch__input" name="h_status" value="visible"> <span style="padding-left: 20px;">Visible</span>         
                </label>
                </div>

               <div class="input-field mdl-cell alignright">
                 <button class="mdl-button mdl-button--fab alignright" type="submit" name="create"><i class="material-icons">save</i></button>
               </div>
                </div><br>
           </form>
         </div><?php 
} elseif ( isset( $_GET['edit'] ) ) { 
          $getMenu = mysqli_query( $GLOBALS['conn'], "SELECT * FROM ". hDBPREFIX ."menus WHERE h_code = '".$_GET['edit']."'");
           if ( $getMenu -> num_rows > 0 ) {
                while ($menus = mysqli_fetch_assoc( $getMenu )) {
                     $menu[] = $menus; 
                }
           } ?>
     <title>Edit Menu [ <?php showOption( 'name' ); ?> ]</title>
        <div class="mdl-card__menu mdl-button mdl-button--icon">
          <a href="?delete=<?php _show_( $menu[0]['h_code'] ); ?>">
               <i class="material-icons">delete</i>
          </a>
        </div>
    <div class="mdl-card__supporting-text">
      <form class="" action="?edit=<?php _show_( $menu[0]['h_code'] ); ?>" method="POST" >
        <div class="input-field">
          <i class="material-icons prefix">label</i>
        <input id="h_alias" name="h_alias" type="text" value="<?php _show_( $menu[0]['h_alias'] ); ?>">
        <label for="h_by">Label</label>
        </div>

        <div class="input-field">
          <i class="material-icons prefix">link</i>
        <input id="h_link" name="h_link" type="text" value="<?php _show_( $menu[0]['h_link'] ); ?>">
        <label for="h_link">Link</label>
        </div><?php

        $hMenu -> materialIcons( $menu[0]['h_avatar'] ); ?>

        <div class="input-field inline mdl-js-textfield getmdl-select">
          <i class="material-icons prefix">room</i>
         <input class="mdl-textfield__input" id="h_location" name="h_location" type="text" tabIndex="-1" value="<?php _show_( ucwords( $menu[0]['h_location'] ) ); ?>">
           <ul class="mdl-menu mdl-menu--top-left mdl-js-menu mdl-color--<?php primaryColor(); ?>" for="h_location">
             <li class="mdl-menu__item" data-val="drawer">Drawer</li>
             <li class="mdl-menu__item" data-val="header">Header</li>
             <li class="mdl-menu__item" data-val="main">Main</li>
             <li class="mdl-menu__item" data-val="footer">Footer</li>
           </ul>
        </div>

         <div class="input-field inline mdl-js-textfield mdl-textfield--floating-label getmdl-select">
          <i class="material-icons prefix">label_outline</i>
         <input class="mdl-textfield__input" id="h_for" name="h_for" type="text" readonly tabIndex="-1"  value="<?php _show_( ucwords( $menu[0]['h_for'] ) ); ?>" >
           <ul class="mdl-menu mdl-menu--top-left mdl-js-menu mdl-color--<?php primaryColor(); ?>" for="h_for" style="max-height: 300px !important; overflow-y: auto;"><?php
          $getMenu = mysqli_query( $GLOBALS['conn'], "SELECT * FROM ". hDBPREFIX ."menus WHERE h_type = 'drop'");
          if ( $getMenu -> num_rows > 0 ) {
               while ($tmenu = mysqli_fetch_assoc( $getMenu )) {
                    echo '<li class="mdl-menu__item" data-val="'.$tmenu['h_alias'].'">'.ucwords( $tmenu['h_alias'] ).'</i></li>'; 
               }
          } ?>
           </ul>
        </div><br>
        <div class="mdl-grid">

        <div class="input-field mdl-cell">
          <input type="checkbox" id="h_type" name="h_type" value="drop" <?php if ( $menu[0]['h_type'] == "drop" ) {
               _show_( 'checked' );
          } ?>>
          <label for="h_type">Has Dropdown</label>
        </div>

        <div class="input-field mdl-cell">
        <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="h_status">
          <input type="checkbox" id="h_status" class="mdl-switch__input" <?php if ( $menu[0]['h_status'] == "visible" ) {
               _show_( 'checked' );
          } ?> name="h_status" value="visible"> <span style="padding-left: 20px;">Visible</span>         
        </label>
        </div>
        <input type="hidden" name="h_author" value="<?php _show_( strtolower( $menu[0]['h_author'] ) ); ?>">

        <div class="input-field mdl-cell alignright">
          <button class="mdl-button mdl-button--fab alignright" type="submit" name="update"><i class="material-icons">save</i></button>
        </div>
        </div><br>
      </form>
    </div><?php 
} elseif ( isset( $_GET['delete'] ) ) {
     $hMenu -> delete( $_GET['delete'] ); ?>
     <center>
        <h3>The Menu has been deleted</h3>
        <div class="mdl-grid">
          <div class="mdl-cell mdl-cell--6-col-desktop" >
            <a class="mdl-button mdl-button--fab" href="./menus"><i class="material-icons">arrow_back</i></a>
        <h6>Back To Menus</h6>
          </div>
          <div class="mdl-cell mdl-cell--6-col-desktop" >
            <a class="mdl-button mdl-button--fab" href="./menus?add"><i class="material-icons">create</i></a>
        <h6>Add New Menu</h6>
          </div>
        </div>
      </center><?php
} else { ?>
  <title>Menus [ <?php showOption( 'name' ); ?> ]</title>
    <div class="mdl-card__supporting-text">
        <ul id="tabs-swipe-demo" style="border-radius: 5px;" class="tabs mdl-card__title mdl-card--expand">
          <li class="tab col s3"><a class="active" href="#drawer">drawer</a></li>
          <li class="tab col s3"><a href="#header">header</a></li>
          <li class="tab col s3"><a href="#main">main</a></li>
          <li class="tab col s3"><a href="#footer">footer</a></li>
        </ul>
        <div id="drawer" class="mdl-tabs vertical-mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
            <div class="mdl-grid mdl-card">
            <div class="mdl-cell mdl-cell--3-col mdl-color--<?php primaryColor(); ?>">
                <div class="mdl-tabs__tab-bar ">

                     <a href="#dashboard" class="mdl-tabs__tab is-active">Dashboard
                     </a>
                     <a href="#articles" class="mdl-tabs__tab">Articles
                      </a>
                      <a href="#pages" class="mdl-tabs__tab">Pages
                      </a>
                  <a href="#users" class="mdl-tabs__tab">Users
                  </a>
                  <a href="#comments" class="mdl-tabs__tab">Comments
                  </a>
                  <a href="#udef" class="mdl-tabs__tab">User Defined
                  </a>
                </div>
           </div>
           <div class="mdl-cell mdl-cell--9-col mdl-color--<?php primaryColor(); ?>">
                <div class="mdl-tabs__panel is-active" id="dashboard"><?php
                    $hMenu -> theMenu( 'dashboard' );
                    $hMenu -> subMenu( 'dashboard' ); ?>
                </div>
                <div class="mdl-tabs__panel" id="articles"><?php
                    $hMenu -> theMenu( 'articles' );
                    $hMenu -> subMenu( 'articles' ); ?>
                </div>
                <div class="mdl-tabs__panel" id="pages"><?php
                    $hMenu -> theMenu( 'pages' );
                    $hMenu -> subMenu( 'pages' ); ?>
                </div>

                <div class="mdl-tabs__panel" id="users"><?php
                    $hMenu -> theMenu( 'users' );
                    $hMenu -> subMenu( 'users' ); ?>
                </div>

                <div class="mdl-tabs__panel" id="comments"><?php
                    $hMenu -> theMenu( 'comments' );
                    $hMenu -> subMenu( 'comments' ); ?>
                </div>

                <div class="mdl-tabs__panel" id="udef"><?php
                    $hMenu -> uMenu(); ?>

                </div>
            </div>
              <a href="?add=menu"><button class="mdl-button mdl-color--red alignrght "><i class="material-icons">add</i>Add New Item</button></a>
          </div>
        </div>
        <div id="header"><?php
          $hMenu -> headMenu(); ?>
        </div>
        <div id="main"><?php
          $hMenu -> subMenu( 'articles' ); ?>
        </div>
        <div id="footer"><?php
          $hMenu -> subMenu( 'articles' ); ?>
        </div>
    </div><?php } ?>
</div>

<div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>">
    
    <div class="mdl-card__title">
      <span class="mdl-button">Tips</span>
        <div class="mdl-layout-spacer"></div>
        <div class="mdl-card__subtitle-text mdl-button mdl-button--icon">
             <a href="./menus?settings=menu">
                 <i class="material-icons">arrow_back</i>
              </a>
        </div>
    </div>
    <div class="mdl-card__supporting-text">
        <ul class="collapsible popout" data-collapsible="accordion">
            <li>
              <div class="collapsible-header active"><i class="material-icons">label</i>
                  <b>Adding Main Menus</b>
              </div>
              <div class="collapsible-body">
               <article>
                <p>To add a menu that has dropdown options, use "#" as the link, and leave the "For" blank.</p>
                <p>Remember to check the "Visible" box otherwise your menu won't show.</p>
               </article>
              </div>
            </li>
            <li>
              <div class="collapsible-header"><i class="material-icons">label_outline</i>
                  <b>Adding Dropdown Items</b>
              </div>
              <div class="collapsible-body">
              <article>
                <p>To add a dropdown menu, fill all fields. Select the main menu for which you are adding a dropdown. Make sure the dropdown switch is not checked.</p>
                <p>Remember to check the "Visible" box otherwise your menu won't show.</p>
              </article>
              </div>
            </li>
      </ul>
    </div>
</div>

</div><?php 
include './footer.php'; ?>
