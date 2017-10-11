<?php

namespace Jabali\Classes;

class Posts {

  function getPostsType( $type ) { ?>
    <title>All <?php _show_( ucwords( $type) ); ?>s [ <?php showOption( 'name' ); ?> ]</title>
      <div class="mdl-cell mdl-cell--12-col"><?php
            $getPosts = $GLOBALS['JBLDB'] -> query( "SELECT * FROM ". _DBPREFIX ."posts WHERE ilk = '" . $type . "'" );
            if ( $getPosts -> num_rows > 0) { ?>
                      <table class="table pmd-table pmd-table-card mdl-color--<?php primaryColor(); ?> mdl-color-text--white">
                      <thead>
                        <tr>
                          <th class="mdl-data-table__cell--non-numeric">POST</th>
                            <th class="mdl-data-table__cell--non-numeric">AUTHOR</th>
                            <?php if ( $type !== "page") { ?>
                            <th class="mdl-data-table__cell--non-numeric">CATEGORIES</th>
                            <th class="mdl-data-table__cell--non-numeric">TAGS</th>
                            <?php } ?>
                            <th class="mdl-data-table__cell--non-numeric">CREATED</th>
                            <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
                        </tr>
                      </thead>
                      <tbody><?php
                        while ( $post = mysqli_fetch_object( $getPosts)){ ?>
                          <tr>
                          <td class="mdl-data-table__cell--non-numeric" data-title="Post"><?php _show_( $post -> name ); ?></td>
                          <td class="mdl-data-table__cell--non-numeric" data-title="Author"><?php _show_( $post -> author_name ); ?></td>
                            <?php if ( $type !== "page") { ?>
                          <td class="mdl-data-table__cell--non-numeric" data-title="Categories"><?php _show_( $post -> categories ); ?></td>
                          <td class="mdl-data-table__cell--non-numeric" data-title="Tags"><?php _show_( $post -> tags ); ?></td>
                            <?php } ?>
                          <td class="mdl-data-table__cell--non-numeric" data-title="Created"><?php _show_( $post -> created ); ?></td>
                          <td class="mdl-data-table__cell--non-numeric" data-title="Actions">
                          <a href="./posts?view=<?php _show_( $post -> id ); ?>&key=<?php _show_( $post -> name ); ?>" ><i class="material-icons">open_in_new</i></a>
                          <a href="tel:<?php _show_( $post -> phone ); ?>" ><i class="material-icons">phone</i></a>
                          <a href="?posts?view=<?php _show_( $_SESSION[JBLSALT.'Code'] ); ?>&action=chat&by=<?php _show_( $post -> id ); ?>" ><i class="material-icons">message</i></a><?php if ( isCap( 'admin' ) || isAuthor( $post -> author ) ) { ?>
                          <a href="./posts?edit=<?php _show_( $post -> id ); ?>&key=<?php _show_( ucwords( $post -> name ) ); ?>" ><i class="material-icons">edit</i></a>
                          <a href="./posts?delete=<?php _show_( $post -> id ); ?>" ><i class="material-icons">delete</i></a><?php } ?>
                          </td>
                          </tr><?php
                        } ?>
                      </tbody>
                    </table><?php
            } else { ?>
            <div class="custom-table mdl-cell mdl-cell--12-col">
            <div class="container-fluid">
              <section class="row component-section">
              <div class="col-md-12">
                <div class="component-box"><?php
                  tableHeader($type.'s', "AUTHOR", "CATEGORY", "TAGS", "CREATED", "STATUS", "ACTIONS"); ?>
                    <tr>
                      <td class="mdl-data-table__cell--non-numeric" data-title="">
                        <p>No <?php _show_( ucwords( $type) ); ?>s Found</p>
                      </td>
                    </tr><?php 
                  tableFooter(); ?>
                  </div>
                </div>
                </section>
                </div>
                </div><?php
            } ?>
  </div><?php
  }

  function getPosts() { ?>
    <title>All <?php _show_( "Articles" ); ?>s [ <?php showOption( 'name' ); ?> ]</title>
      <div class="custom-table mdl-cell mdl-cell--12-col">
      <div class="container-fluid">
        <section class="row component-section">
        <div class="col-md-12">
          <div class="component-box"><?php
            $getPosts = $GLOBALS['JBLDB'] -> query( "SELECT * FROM ". _DBPREFIX ."posts WHERE ilk = 'article'" );
            if ( $getPosts -> num_rows > 0) { ?>
                  <div class="pmd-card pmd-z-depth pmd-card-custom-view">
                    <div class="pmd-table-card">
                      <table class="table pmd-table mdl-color--<?php primaryColor(); ?> mdl-color-text--white">
                      <thead>
                        <tr>
                          <th class="mdl-data-table__cell--non-numeric">POST</th>
                            <th class="mdl-data-table__cell--non-numeric">AUTHOR</th>
                            <th class="mdl-data-table__cell--non-numeric">CATEGORIES</th>
                            <th class="mdl-data-table__cell--non-numeric">TAGS</th>
                            <th class="mdl-data-table__cell--non-numeric">CREATED</th>
                            <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
                        </tr>
                      </thead>
                      <tbody><?php
                        while ( $post = mysqli_fetch_object( $getPosts)){ ?>
                          <tr>
                          <td class="mdl-data-table__cell--non-numeric" data-title="Post"><?php _show_( $post -> name ); ?></td>
                          <td class="mdl-data-table__cell--non-numeric" data-title="Author"><?php _show_( $post -> author_name ); ?></td>
                          <td class="mdl-data-table__cell--non-numeric" data-title="Categories"><?php _show_( $post -> categories ); ?></td>
                          <td class="mdl-data-table__cell--non-numeric" data-title="Tags"><?php _show_( $post -> tags ); ?></td>
                          <td class="mdl-data-table__cell--non-numeric" data-title="Created"><?php _show_( $post -> created ); ?></td>
                          <td class="mdl-data-table__cell--non-numeric" data-title="Actions">
                          <a href="./posts?view=<?php _show_( $post -> id ); ?>&key=<?php _show_( $post -> name ); ?>" ><i class="material-icons">open_in_new</i></a>
                          <a href="tel:<?php _show_( $post -> phone ); ?>" ><i class="material-icons">phone</i></a>
                          <a href="?posts?view=<?php _show_( $_SESSION[JBLSALT.'Code'] ); ?>&action=chat&by=<?php _show_( $post -> id ); ?>" ><i class="material-icons">message</i></a><?php if ( isCap( 'admin' ) || isAuthor( $post -> author ) ) { ?>
                          <a href="./posts?edit=<?php _show_( $post -> id ); ?>&key=<?php _show_( ucwords( $post -> name ) ); ?>" ><i class="material-icons">edit</i></a>
                          <a href="./posts?delete=<?php _show_( $post -> id ); ?>" ><i class="material-icons">delete</i></a><?php } ?>
                          </td>
                          </tr><?php
                        } ?>
                      </tbody>
                    </table>
                    </div>
                  </div><?php
            } else { ?>
            <div class="custom-table mdl-cell mdl-cell--12-col">
            <div class="container-fluid">
              <section class="row component-section">
              <div class="col-md-12">
                <div class="component-box"><?php
              tableHeader("POST", "AUTHOR", "CATEGORY", "TAGS", "CREATED", "STATUS", "ACTIONS"); ?>
                <tr>
                  <td class="mdl-data-table__cell--non-numeric" data-title=""><p>No Posts Found</p></td>
                </tr><?php tableFooter(); ?>
                </div>
                </div>
                </section>
                </div>
                </div><?php
            } ?>
          </div>
        </div> 
      </section>
    </div>
  </div><?php
  }

  function getDrafts() { ?>
    <title>All <?php _show_( "Articles" ); ?>s [ <?php showOption( 'name' ); ?> ]</title>
      <div class="custom-table mdl-cell mdl-cell--12-col">
      <div class="container-fluid">
        <section class="row component-section">
        <div class="col-md-12">
          <div class="component-box"><?php
            $getPosts = $GLOBALS['JBLDB'] -> query( "SELECT * FROM ". _DBPREFIX ."posts WHERE ilk = 'draft'" );
            if ( $getPosts -> num_rows > 0) { ?>
                  <div class="pmd-card pmd-z-depth pmd-card-custom-view">
                    <div class="pmd-table-card">
                      <table class="table pmd-table mdl-color--<?php primaryColor(); ?> mdl-color-text--white">
                      <thead>
                        <tr>
                          <th class="mdl-data-table__cell--non-numeric">POST</th>
                            <th class="mdl-data-table__cell--non-numeric">AUTHOR</th>
                            <th class="mdl-data-table__cell--non-numeric">CATEGORIES</th>
                            <th class="mdl-data-table__cell--non-numeric">TAGS</th>
                            <th class="mdl-data-table__cell--non-numeric">CREATED</th>
                            <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
                        </tr>
                      </thead>
                      <tbody><?php
                        while ( $post = mysqli_fetch_object( $getPosts)){ ?>
                          <tr>
                          <td class="mdl-data-table__cell--non-numeric" data-title="Post"><?php _show_( $post -> name ); ?></td>
                          <td class="mdl-data-table__cell--non-numeric" data-title="Author"><?php _show_( $post -> author_name ); ?></td>
                          <td class="mdl-data-table__cell--non-numeric" data-title="Categories"><?php _show_( $post -> category ); ?></td>
                          <td class="mdl-data-table__cell--non-numeric" data-title="Tags"><?php _show_( $post -> tags ); ?></td>
                          <td class="mdl-data-table__cell--non-numeric" data-title="Created"><?php _show_( $post -> created ); ?></td>
                          <td class="mdl-data-table__cell--non-numeric" data-title="Actions">
                          <a href="./posts?view=<?php _show_( $post -> id ); ?>&key=<?php _show_( $post -> name ); ?>" ><i class="material-icons">open_in_new</i></a>
                          <a href="tel:<?php _show_( $post -> phone ); ?>" ><i class="material-icons">phone</i></a>
                          <a href="?posts?view=<?php _show_( $_SESSION[JBLSALT.'Code'] ); ?>&action=chat&by=<?php _show_( $post -> id ); ?>" ><i class="material-icons">message</i></a><?php if ( isCap( 'admin' ) || isAuthor( $post -> author ) ) { ?>
                          <a href="./posts?edit=<?php _show_( $post -> id ); ?>&key=<?php _show_( ucwords( $post -> name ) ); ?>" ><i class="material-icons">edit</i></a>
                          <a href="./posts?delete=<?php _show_( $post -> id ); ?>" ><i class="material-icons">delete</i></a><?php } ?>
                          </td>
                          </tr><?php
                        } ?>
                      </tbody>
                    </table>
                    </div>
                  </div><?php
            } else { ?>
            <div class="custom-table mdl-cell mdl-cell--12-col">
            <div class="container-fluid">
              <section class="row component-section">
              <div class="col-md-12">
                <div class="component-box"><?php
              tableHeader("POST", "AUTHOR", "CATEGORY", "TAGS", "CREATED", "STATUS", "ACTIONS"); ?>
                <tr>
                  <td class="mdl-data-table__cell--non-numeric" data-title=""><p>No Posts Found</p></td>
                </tr><?php tableFooter(); ?>
                </div>
                </div>
                </section>
                </div>
                </div><?php
            } ?>
          </div>
        </div> 
      </section>
    </div>
  </div><?php
  }

  function dashDrafts() {
    $getDrafts = $GLOBALS['JBLDB'] -> query( "SELECT * FROM ". _DBPREFIX ."posts WHERE (ilk = 'article' AND state = 'draft' ) ORDER BY created ASC LIMIT 4" );
    if ( $getDrafts -> num_rows > 0) {
      while ( $draft = mysqli_fetch_assoc( $getDrafts)){ ?>
        <a href="./posts?edit=<?php _show_( $draft['id'] ); ?>&key=<?php _show_( $draft['name'] ); ?>"><b><?php _show_( $draft['name'] ); ?></b></a>
        <a href="./?ddelete=<?php _show_( $draft['id'] ); ?>"><i class="mdi mdi-delete alignright"></i></a>
      <br><?php
      }
    }
  }

  function getPost( $code) {
    $getPostCode = $GLOBALS['JBLDB'] -> query( "SELECT * FROM ". _DBPREFIX ."posts WHERE id = '".$code."'" );
    if ( $getPostCode -> num_rows > 0 ) {
      while( $post = mysqli_fetch_object( $getPostCode ) ){ ?>
        <title><?php _show_( ucwords( $post -> name ) ); ?> [ <?php showOption( 'name' ); ?> ]</title>
        <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone">
          <div class="mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>">
            <div class="mdl-card__supporting-text mdl-card--expand mdl-grid">
              <div class="mdl-cell mdl-cell--6-col-desktop mdl-cell--6-col-tablet mdl-cell--12-col-phone">
                <h4><?php _show_( $post -> subtitle ); ?></h4>
                <h6>Published: <?php _show_( $post -> created ); ?></h6>
                <h6>Authored by: <a href="./users?view=<?php _show_( $post -> author .'&key='.$post -> author_name ); ?>"><?php _show_( $post -> author_name ); ?></a></h6>
                <h6>Category: <?php _show_( $post -> categories ); ?></h6>
                <h6>Tagged: <?php _show_( ucwords( $post -> tags ) ); ?></h6>
                <h6>Readings: <?php _show_( ucwords( $post -> tags ) ); ?></h6>
              </div>
              <div class="mdl-cell mdl-cell--6-col-desktop mdl-cell--6-col-tablet mdl-cell--12-col-phone">
                <img src="<?php _show_( $post -> avatar ); ?>" width="100%">
              </div>
            </div>
            <div class="mdl-card__supporting-text mdl-card--expand">
              <span><?php _show_( $post -> details ); ?></span>
            </div>
            <div class="mdl-card__menu">
              <button id="demo_menu-top-right" class="mdl-button mdl-js-button mdl-button--icon mdl-button--fab mdl-color--accent">
              <i class="material-icons mdl-color-text--white">more_vert</i>
              </button>
              <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect mdl-color--<?php primaryColor(); ?>"
              for="demo_menu-top-right">
              <a href="./posts?view=<?php _show_( $post -> id ); ?>&fav=<?php _show_( $post -> id ); ?>&key=<?php _show_( ucwords( $post -> name ) ); ?>" class="mdl-list__item"><i class="mdi mdi-heart mdl-list__item-icon"></i><span style="padding-left: 20px">Favorite</span></a>
              <a href="./note?post=<?php _show_( $post -> id ); ?>&author=<?php _show_( $_SESSION[JBLSALT.'Code'] ); ?>" class="mdl-list__item"><i class="mdi mdi-note-multiple mdl-list__item-icon"></i><span style="padding-left: 20px">Notes</span></a><?php if ( isCap( 'admin' ) || isAuthor( $post -> author ) ) { ?>
              <a href="./posts?edit=<?php _show_( $post -> id ); ?>&key=<?php _show_( ucwords( $post -> name ) ); ?>" class="mdl-list__item"><i class="mdi mdi-pencil mdl-list__item-icon"></i><span style="padding-left: 20px">Edit</span></a><?php } ?>
              </ul>
            </div>
          </div>
        </div>
        <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone">
          <div class="mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>"><?php
            $getNotes = $GLOBALS['JBLDB'] -> query( "SELECT * FROM ". _DBPREFIX ."comments LIMIT 5" );
              if ( $getNotes && $getNotes -> num_rows > 0) { ?>
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

                  <b><?php _show_( $note['name'] ); ?></b><span class="alignright"><?php
                  _show_( $note['created'] ); ?></span>
                  </div>
                  <div class="collapsible-body"><span class="alignright">
                  <a href="./notification?create=note&code=<?php _show_( $note['author'] ); ?>" ><i class="material-icons">reply</i></a>
                  <a href="./notification?view=<?php _show_( $note['id'] ); ?>" ><i class="material-icons">open_in_new</i></a>
                  <a href="./notification?delete=<?php _show_( $note['id'] ); ?>" ><i class="material-icons">delete</i></a>
                  </span>
                  <span><?php
                  _show_( $note['details'] ); ?></span>
                  </div>
                  </li><?php
                  } ?>
                  </ul><?php
              } else {
              echo '<div class="mdl-card__title">
                  <i class="material-icons">comments</i>
                  <span class="mdl-card__title-text">No Comments</span>
                  <div class="mdl-layout-spacer"></div>
                </div>';
              } ?>
            <div class="mdl-card__supporting-text mdl-card--expand">
            <p>Add Comment</p>
            <form>
              <div class="input-field">
                <input id="name" name=="name" type="text">
                <label for="name">Title</label>
              </div>

              <div class="input-field">
                <textarea class="materialize-textarea col s12" id="details" name="details" ></textarea>
                <label for="details">Your Comment</label>
              </div>

              <div class="input-field">
                <button type="submit" name="" class="mdl-button mdl-js-button mdl-button--fab mdl-button--colored mdl-js-ripple-effect alignright"><i  class="material-icons">send</i></button>
              </div>
            </form>
          </div>
            </div>
          </div>
        </div><?php
      }
    } else {
      _show_( 'No Post Found' );
    }
  }

} ?>
