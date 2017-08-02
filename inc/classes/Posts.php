<?php

namespace Jabali;

class _hPosts {

  function create( $h_alias, $h_author, $h_avatar, $h_by, $h_category, $h_organization, $h_code, $h_created, $h_desc, $h_email, $h_fav, $h_key, $h_level, $h_link, $h_location, $h_notes, $h_phone, $h_reading, $h_status, $h_subtitle, $h_tags, $h_type, $h_updated ) {

    if ( mysqli_query( $GLOBALS['conn'], "INSERT INTO ". hDBPREFIX ."posts ( h_alias, h_author, h_avatar, h_by, h_category, h_organization, h_code, h_created, h_description, h_email, h_fav, h_key, h_level, h_link, h_location, h_notes, h_phone, h_reading, h_status, h_subtitle, h_tags, h_type, h_updated )
      VALUES ('".$h_alias."', '".$h_author."', '".$h_avatar."', '".$h_by."', '".$h_category."', '".$h_organization."', '".$h_code."', '".$h_created."', '".$h_desc."', '".$h_email."', '".$h_fav."', '".$h_key."', '".$h_level."', '".$h_link."', '".$h_location."', '".$h_notes."', '".$h_phone."', '".$h_reading."', '".$h_status."', '".$h_subtitle."', '".$h_tags."', '".$h_type."', '".$h_updated."' )" ) ) {
      echo "<script type = \"text/javascript\">
              alert(\"" . ucwords( $h_type ) . " Created Successfully!\" );
          </script>";
    } else {
        echo "Error: " . $GLOBALS['conn'] -> error;
    }
  }

  function update( $h_alias, $h_author, $h_avatar, $h_by, $h_category, $h_organization, $h_code, $h_created, $h_desc, $h_email, $h_fav, $h_key, $h_level, $h_link, $h_location, $h_notes, $h_phone, $h_reading, $h_status, $h_subtitle, $h_tags, $h_type, $h_updated ) {

    if ( mysqli_query( $GLOBALS['conn'], "UPDATE ". hDBPREFIX ."posts SET h_alias ='".$h_alias."', h_author = '".$h_author."', h_avatar = '".$h_avatar."', h_category = '".$h_category."', h_organization = '".$h_organization."', h_code = '".$h_code."', h_created = '".$h_created."', h_description = '".$h_desc."', h_email = '".$h_email."', h_fav = '".$h_fav."', h_key = '".$h_key."', h_level = '".$h_level."', h_link = '".$h_link."', h_location = '".$h_location."', h_notes = '".$h_notes."', h_phone = '".$h_phone."', h_reading = '".$h_reading."', h_status = '".$h_status."', h_subtitle = '".$h_subtitle."', h_tags = '".$h_tags."', h_type = '".$h_type."', h_updated = '".$h_updated."' WHERE h_code = '".$h_code."'" ) ) {
      echo "<script type = \"text/javascript\">
              alert(\"" . ucwords( $h_alias ) . " Updated Successfully!\" );
          </script>";
    } else {
        echo "Error: " . $GLOBALS['conn']->error;
    }
  }

  function delete( $code ) {
    mysqli_query( $GLOBALS['conn'], "DELETE FROM ". hDBPREFIX ."posts WHERE h_code = '".$code."'" );
  }

  function getPostsType( $type ) { ?>
    <title>All <?php _show_( ucwords( $type) ); ?>s [ <?php showOption( 'name' ); ?> ]</title><?php
    if ( isset( $_GET['sort'] ) ) {
      $sort = $_GET['sort'];
    } else {
      $sort = "h_created";
    }
    $getPostsBy = mysqli_query( $GLOBALS['conn'], "SELECT * FROM ". hDBPREFIX ."posts WHERE h_status = 'published' AND h_type='".$type."' ORDER BY ".$sort." ASC" );
    if ( $getPostsBy -> num_rows > 0) { ?>
        <div class="mdl-cell mdl-cell--3-col" >
          <form>
              <div class="input-field mdl-js-textfield getmdl-select">
                <i class="material-icons prefix">sort</i>
                 <input class="mdl-textfield__input" id="h_type" name="h_type" type="text" readonly tabIndex="-1" placeholder="<?php if ( isset( $_GET['sort'] ) ) { _show_( 'Sort By ' . ucfirst( substr( $_GET['sort'], 2 ) ) ); } else { _show_( 'Click to Sort' ); } ?>" >
               <ul class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-color--<?php primaryColor(); ?>" for="h_type">
                 <a href="./post?view=list&type=article&sort=h_created" class="mdl-menu__item mdl-list__item"><i class="material-icons mdl-list__item-icon">date_range</i><span style="padding-left: 20px">Date</span></a>
                 <a href="./post?view=list&type=article&sort=h_author" class="mdl-menu__item mdl-list__item"><i class="material-icons mdl-list__item-icon">create</i><span style="padding-left: 20px">Author</span></a>
                 <a href="./post?view=list&type=article&sort=h_alias" class="mdl-menu__item mdl-list__item"><i class="material-icons mdl-list__item-icon">label</i><span style="padding-left: 20px">Name</span></a>
               </ul>
            </div>
          </form>
        </div>
          <div class="mdl-cell mdl-cell--8-col" >
            <form>
              <center>
              <div class="input-field">
              <i class="material-icons prefix">search</i>
              <input type="text" placeholder="Search <?php _show_( "Article" ); ?>">
              </div></center>
          </div>
          <div class="mdl-cell mdl-cell--1-col" >
              <div class="input-field">
                <button type="submit" name="search" class="mdl-button mdl-js-button mdl-button--fab alignright">
                  <i class="material-icons prefix">search</i>
                </button>
              </div></center>
              </form>
          </div>
      <div class="mdl-cell--12-col mdl-grid">
        <table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>">
        <thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric"><?php _show_( strtoupper( $type) ); ?></th>
        <th class="mdl-data-table__cell--non-numeric">AUTHOR</th><?php if ( $type !== "page") { ?>
        <th class="mdl-data-table__cell--non-numeric">CATEGORY</th>
        <th class="mdl-data-table__cell--non-numeric">TAGS</th><?php } ?>
        <th class="mdl-data-table__cell--non-numeric">CREATED</th>
        <th class="mdl-data-table__cell--non-numeric">STATUS</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead><?php
        while ( $postsDetails = mysqli_fetch_assoc( $getPostsBy)){ ?>
        <tbody>
        <tr>
        <td class="mdl-data-table__cell--non-numeric">
        <?php _show_( $postsDetails['h_alias'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
        <?php _show_( $postsDetails['h_by'] ); ?>
        </td><?php if ( $type !== "page") { ?>
        <td class="mdl-data-table__cell--non-numeric">
        <?php _show_( $postsDetails['h_category'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
        <?php _show_( $postsDetails['h_tags'] ); ?>
        </td><?php } ?>
        <td class="mdl-data-table__cell--non-numeric">
        <?php _show_( $postsDetails['h_created'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
        <?php _show_( $postsDetails['h_status'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
        <a href="./post?view=<?php _show_( $postsDetails['h_code'] ); ?>&key=<?php _show_( $postsDetails['h_alias'] ); ?>" ><i class="material-icons">open_in_new</i></a><?php if ( isCap( 'admin' ) || isAuthor( $postDetails['h_author'] ) ) { ?>
        <a href="./post?edit=<?php _show_( $postsDetails['h_code'] ); ?>&key=<?php _show_( ucwords( $postsDetails['h_alias'] ) ); ?>" ><i class="material-icons">edit</i></a>
        <a href="./post?delete=<?php _show_( $postsDetails['h_code'] ); ?>" ><i class="material-icons">delete</i></a> <?php } ?>
        </td>
        </tr>
        </tbody><?php
        } ?>
        </table>
        </div><?php
    } else {
      ?><div class="mdl-cell mdl-cell--12-col"><table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>">
      <thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric"><?php _show_( strtoupper( $type) ); ?></th>
        <th class="mdl-data-table__cell--non-numeric">AUTHOR</th>
        <th class="mdl-data-table__cell--non-numeric">AUTHOR</th><?php if ( $type !== "page") { ?>
        <th class="mdl-data-table__cell--non-numeric">CATEGORY</th>
        <th class="mdl-data-table__cell--non-numeric">TAGS</th><?php } ?>
        <th class="mdl-data-table__cell--non-numeric">CREATED</th>
        <th class="mdl-data-table__cell--non-numeric">STATUS</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead>
        <tbody>
        <tr>
        <td><p>No <?php _show_( ucwords( $type) ); ?>s Found</p></td>
        </tr>
        </tbody>
        </table><?php
    }
  }

  function getPosts( $sort ) { ?>
    <title>All Articles [ <?php showOption( 'name' ); ?> ]</title><?php
      $getPosts = mysqli_query( $GLOBALS['conn'], "SELECT * FROM ". hDBPREFIX ."posts WHERE (h_type = 'article' AND h_status = 'published' ) ORDER BY ".$sort." DESC" );
      if ( $getPosts -> num_rows > 0) { ?>
        <div class="mdl-cell mdl-cell--12-col mdl-grid mdl-color--<?php primaryColor(); ?>" >
      <div class="mdl-cell mdl-cell--3-col" >
          <form>
              <div class="input-field mdl-js-textfield getmdl-select">
                <i class="material-icons prefix">sort</i>
                 <input class="mdl-textfield__input" id="h_type" name="h_type" type="text" readonly tabIndex="-1" placeholder="<?php if ( isset( $_GET['sort'] ) ) { _show_( 'Sort By ' . ucfirst( $_GET['sort'] ) ); } else { _show_( 'Click to Sort' ); } ?>" >
               <ul class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-color--<?php primaryColor(); ?>" for="h_type">
                 <a href="?sort=h_created" class="mdl-menu__item mdl-list__item"><i class="material-icons mdl-list__item-icon">image</i><span style="padding-left: 20px">Images</span></a>
                 <a href="?sort=h_type" class="mdl-menu__item mdl-list__item"><i class="material-icons mdl-list__item-icon">send</i><span style="padding-left: 20px">Video</span></a>
                 <a href="?sort=h_author" class="mdl-menu__item mdl-list__item"><i class="material-icons mdl-list__item-icon">attach_file</i><span style="padding-left: 20px">Files</span></a>
               </ul>
            </div>
          </form>
        </div>
          <div class="mdl-cell mdl-cell--8-col" >
            <form>
              <center>
              <div class="input-field">
              <i class="material-icons prefix">search</i>
              <input type="text" placeholder="Search <?php _show_( "Article" ); ?>">
              </div></center>
          </div>
          <div class="mdl-cell mdl-cell--1-col" >
              <div class="input-field">
                <button type="submit" name="search" class="mdl-button mdl-js-button mdl-button--fab alignright">
                  <i class="material-icons prefix">search</i>
                </button>
              </div></center>
              </form>
          </div>
        <div class="mdl-cell--12-col mdl-grid">
          <table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>">
          <thead>
          <tr>
          <th class="mdl-data-table__cell--non-numeric">POST</th>
          <th class="mdl-data-table__cell--non-numeric">AUTHOR</th>
          <th class="mdl-data-table__cell--non-numeric">CATEGORY</th>
          <th class="mdl-data-table__cell--non-numeric">TAGS</th>
          <th class="mdl-data-table__cell--non-numeric">CREATED</th>
          <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
          </tr>
          </thead><?php
          while ( $postsDetails = mysqli_fetch_assoc( $getPosts)){ ?>
          <tbody>
          <tr>
          <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( $postsDetails['h_alias'] ); ?>
          </td>
          <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( $postsDetails['h_by'] ); ?>
          </td>
          <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( $postsDetails['h_category'] ); ?>
          </td>
          <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( $postsDetails['h_tags'] ); ?>
          </td>
          <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( $postsDetails['h_created'] ); ?>
          </td>
          <td class="mdl-data-table__cell--non-numeric">
          <a href="./post?view=<?php _show_( $postsDetails['h_code'] ); ?>&key=<?php _show_( $postsDetails['h_alias'] ); ?>" ><i class="material-icons">open_in_new</i></a>
          <a href="tel:<?php _show_( $postsDetails['h_phone'] ); ?>" ><i class="material-icons">phone</i></a>
          <a href="?post?view=<?php _show_( $_SESSION['myCode'] ); ?>&action=chat&by=<?php _show_( $postsDetails['h_code'] ); ?>" ><i class="material-icons">message</i></a><?php if ( isCap( 'admin' ) || isAuthor( $postDetails['h_author'] ) ) { ?>
          <a href="./post?edit=<?php _show_( $postsDetails['h_code'] ); ?>&key=<?php _show_( ucwords( $postDetails['h_alias'] ) ); ?>" ><i class="material-icons">edit</i></a>
          <a href="./post?delete=<?php _show_( $postsDetails['h_code'] ); ?>" ><i class="material-icons">delete</i></a><?php } ?>
          </td>
          </tr>
          </tbody><?php
          } ?>
          </table>
          </div><br>
          </div><?php
      } else {
        tableHeader("POST", "AUTHOR", "CATEGORY", "TAGS", "CREATED", "STATUS", "ACTIONS"); ?>
          <tr>
            <td class="mdl-data-table__cell--non-numeric"><p>No Posts Found</p></td>
          </tr><?php tableFooter();
      }
  }

  function getDrafts() { ?>
    <title>Draft Posts [ <?php showOption( 'name' ); ?> ]</title><?php
      $getPosts = mysqli_query( $GLOBALS['conn'], "SELECT * FROM ". hDBPREFIX ."posts WHERE (h_type = 'article' AND h_status = 'draft' ) ORDER BY h_created DESC" );
      if ( $getPosts -> num_rows > 0) { ?>
          <div class="mdl-cell--12-col" >
            <form>
              <center>
              <div class="input-field">
              <i class="material-icons prefix">search</i>
              <input type="text" placeholder="Search <?php _show_( "Page" ); ?>">
              </div></center>
              </form>
          </div>
        <div class="mdl-cell--12-col mdl-grid">
          <table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>">
          <thead>
          <tr>
          <th class="mdl-data-table__cell--non-numeric">POST</th>
          <th class="mdl-data-table__cell--non-numeric">AUTHOR</th>
          <th class="mdl-data-table__cell--non-numeric">CATEGORY</th>
          <th class="mdl-data-table__cell--non-numeric">TAGS</th>
          <th class="mdl-data-table__cell--non-numeric">CREATED</th>
          <th class="mdl-data-table__cell">ACTIONS</th>
          </tr>
          </thead><?php
          while ( $postsDetails = mysqli_fetch_assoc( $getPosts)){ ?>
          <tbody>
          <tr>
          <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( $postsDetails['h_alias'] ); ?>
          </td>
          <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( $postsDetails['h_by'] ); ?>
          </td>
          <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( $postsDetails['h_category'] ); ?>
          </td>
          <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( $postsDetails['h_tags'] ); ?>
          </td>
          <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( $postsDetails['h_created'] ); ?>
          </td>
          <td class="mdl-data-table__cell"><?php if ( isCap( 'admin' ) || isAuthor( $postDetails['h_author'] ) ) { ?>
          <a href="./post?edit=<?php _show_( $postsDetails['h_code'] ); ?>&key=<?php _show_( ucwords( $postDetails['h_alias'] ) ); ?>" ><i class="material-icons">edit</i></a>
          <a href="./post?delete=<?php _show_( $postsDetails['h_code'] ); ?>" ><i class="material-icons">delete</i></a><?php } ?>
          </td>
          </tr>
          </tbody><?php
          } ?>
          </table>
          </div><?php
      } else {
        ?><div style="margin:1%;" ><table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>">
        <thead>
          <tr>
          <th class="mdl-data-table__cell--non-numeric">POST</th>
          <th class="mdl-data-table__cell--non-numeric">AUTHOR</th>
          <th class="mdl-data-table__cell--non-numeric">CATEGORY</th>
          <th class="mdl-data-table__cell--non-numeric">TAGS</th>
          <th class="mdl-data-table__cell--non-numeric">CREATED</th>
          <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
          </tr>
          </thead>
          <tbody>
          <tr>
          <td><p>No Posts Found</p></td>
          </tr>
          </tbody>
          </table><?php
      }
  }

  function dashDrafts() {
    $getDrafts = mysqli_query( $GLOBALS['conn'], "SELECT * FROM ". hDBPREFIX ."posts WHERE (h_type = 'article' AND h_status = 'draft' ) ORDER BY h_created ASC LIMIT 4" );
    if ( $getDrafts -> num_rows > 0) {
      while ( $draft = mysqli_fetch_assoc( $getDrafts)){ ?>
        <a href="./post?edit=<?php _show_( $draft['h_code'] ); ?>&key=<?php _show_( $draft['h_alias'] ); ?>"><b><?php _show_( $draft['h_alias'] ); ?></b></a>
        <a href="./?ddelete=<?php _show_( $draft['h_code'] ); ?>"><i class="mdi mdi-delete alignright"></i></a>
      <br><?php
      }
    }
  }

  function getPost( $code) {
    $getPostCode = mysqli_query( $GLOBALS['conn'], "SELECT * FROM ". hDBPREFIX ."posts WHERE h_code = '".$code."'" );
    if ( $getPostCode -> num_rows > 0 ) {
      while( $postDetails = mysqli_fetch_assoc( $getPostCode ) ){ ?>
        <title><?php _show_( ucwords( $postDetails['h_alias'] ) ); ?> [ <?php showOption( 'name' ); ?> ]</title>
        <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone">
          <div class="mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>">
            <div class="mdl-card__supporting-text mdl-card--expand mdl-grid">
              <div class="mdl-cell mdl-cell--6-col-desktop mdl-cell--6-col-tablet mdl-cell--12-col-phone">
                <h4><?php _show_( $postDetails['h_subtitle'] ); ?></h4>
                <h6>Published: <?php _show_( $postDetails['h_created'] ); ?></h6>
                <h6>Authored by: <a href="./user?view=<?php _show_( $postDetails['h_author'].'&key='.$postDetails['h_by'] ); ?>"><?php _show_( $postDetails['h_by'] ); ?></a></h6>
                <h6>Category: <?php _show_( $postDetails['h_category'] ); ?></h6>
                <h6>Tagged: <?php _show_( ucwords( $postDetails['h_tags'] ) ); ?></h6>
                <h6>Readings: <?php _show_( ucwords( $postDetails['h_tags'] ) ); ?></h6>
              </div>
              <div class="mdl-cell mdl-cell--6-col-desktop mdl-cell--6-col-tablet mdl-cell--12-col-phone">
                <img src="<?php _show_( $postDetails['h_avatar'] ); ?>" width="100%">
              </div>
            </div>
            <div class="mdl-card__supporting-text mdl-card--expand">
              <span><?php _show_( $postDetails['h_description'] ); ?></span>
            </div>
            <div class="mdl-card__menu">
              <button id="demo_menu-top-right" class="mdl-button mdl-js-button mdl-button--icon mdl-button--fab mdl-color--accent">
              <i class="material-icons mdl-color-text--white">more_vert</i>
              </button>
              <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect mdl-color--<?php primaryColor(); ?>"
              for="demo_menu-top-right">
              <a href="./post?view=<?php _show_( $postDetails['h_code'] ); ?>&fav=<?php _show_( $postDetails['h_code'] ); ?>&key=<?php _show_( ucwords( $postDetails['h_alias'] ) ); ?>" class="mdl-list__item"><i class="mdi mdi-heart mdl-list__item-icon"></i><span style="padding-left: 20px">Favorite</span></a>
              <a href="./note?post=<?php _show_( $postDetails['h_code'] ); ?>&author=<?php _show_( $_SESSION['myCode'] ); ?>" class="mdl-list__item"><i class="mdi mdi-note-multiple mdl-list__item-icon"></i><span style="padding-left: 20px">Notes</span></a><?php if ( isCap( 'admin' ) || isAuthor( $postDetails['h_author'] ) ) { ?>
              <a href="./post?edit=<?php _show_( $postDetails['h_code'] ); ?>&key=<?php _show_( ucwords( $postDetails['h_alias'] ) ); ?>" class="mdl-list__item"><i class="mdi mdi-pencil mdl-list__item-icon"></i><span style="padding-left: 20px">Edit</span></a><?php } ?>
              </ul>
            </div>
          </div>
        </div>
        <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone">
          <div class="mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>"><?php
            $getNotes = mysqli_query( $GLOBALS['conn'], "SELECT * FROM ". hDBPREFIX ."messages LIMIT 5" );
              if ( $getNotes -> num_rows >= 0) { ?>
                <div class="mdl-card__title">
                  <i class="material-icons">comment</i>
                  <span class="mdl-button">Comments</span>
                  <div class="mdl-layout-spacer"></div>
                </div>
                <div class="mdl-card__supporting-text mdl-card--expand">
                  <ul class="collapsible popout" data-collapsible="accordion"><?php
                  while ( $note = mysqli_fetch_assoc( $getNotes) ) { ?>
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
                  </ul><?php
              } else {
              echo "No Messages";
              } ?>
            <p>Add Comment</p>
            <form>
              <div class="input-field">
                <input id="h_alias" name=="h_alias" type="text">
                <label for="h_alias">Title</label>
              </div>

              <div class="input-field">
                <textarea class="materialize-textarea col s12" id="h_description" name="h_description" ></textarea>
                <label for="h_description">Your Comment</label>
              </div>

              <div class="input-field">
                <button type="submit" name="" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect alignright"><i  class="material-icons">send</i></button>
              </div>
            </form>
            </div>
          </div>
        </div><?php
      }
    } else {
      _show_( 'No Post Found' );
    }
  }

} ?>
