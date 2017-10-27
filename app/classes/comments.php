<?php

namespace Jabali\Classes; 

class Comments {
  var $name; 
  var $author;
  var $category; 
  var $company; 
  var $id; 
  var $created; 
  var $h_desc; 
  var $email ;
  var $for; 
  var $authkey; 
  var $level; 
  var $link; 
  var $location; 
  var $excerpt; 
  var $phone; 
  var $state; 
  var $ilk; 

  
  function create() {

    $date = date( "YmdHms" );
    if ( isset( $_SESSION[JBLSALT.'Email'] ) ) {
      $email = $_SESSION[JBLSALT.'Email'];
    } else {
      $email = hEMAIL;
    }

    $name = $_POST['name'];
    $author = $_POST['author'];
    $by = $_POST['by'];
    $authkey = str_shuffle(md5( $email.$date ) );
    $id = substr( $authkey, rand(0, 15), 12 ); 
    $created = date(Ymd );
    $h_desc = $_POST['details']; 
    $email  = $_POST['email'];
    $for = $_POST['for'];
    $level = $_POST['level']; 
    $link = _ADMIN."notification?view=".$id;
    $state = "unread";
    $ilk = $_POST['ilk'];

     if ( $GLOBALS['JBLDB'] -> query( "INSERT INTO ". _DBPREFIX ."comments (name, author, by, id, created, details, email , authkey, level, link, state, ilk) 
    VALUES ('".$name."', '".$author."', '".$by."', '".$id."', '".$created."', '".$h_desc."', '".$email ."', '".$authkey."', '".$level."', '".$link."', '".$state."', '".$ilk."' )" ) ) {
       echo "<script type = \"text/javascript\">
                    alert(\"Comment Sent\" );
                </script>";
     } else {
        echo "Error: " . $sql . "<br>" . $GLOBALS['JBLDB']->error;
     //   echo "<script type = \"text/javascript\">
     //                alert(\"Comment Not Sent. \n
     //                Check and try again\" );
     //            </script>";
      }
  }

  function delete( $id) {}

  function getCommentsType( $type) { ?>
  <title><?php echo( ucfirst( $type) ); ?>s  List - <?php showOption( 'name' ); ?></title><?php 
    $getCommentsBy = $GLOBALS['JBLDB'] -> query( "SELECT * FROM ". _DBPREFIX ."comments WHERE ilk = '".$type."' " );
    if ( $getCommentsBy -> num_rows > 0) { ?>
      <div style="margin:1%;" >
      <table class="table pmd-table mdl-color--<?php primaryColor(); ?> mdl-color-text--white"><thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric"><?php echo( strtoupper( $type) ); ?></th>
        <th class="mdl-data-table__cell--non-numeric">SENDER</th>
        <th class="mdl-data-table__cell--non-numeric">SENT ON</th>
        <th class="mdl-data-table__cell--non-numeric">STATUS</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead><?php 
      while ( $commentsDetails = mysqli_fetch_assoc( $getComments)){ ?>
        <tbody>
        <tr>
        <td class="mdl-data-table__cell--non-numeric" data-title="">
          <?php echo( $commentsDetails['name'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric" data-title="">
          <?php echo( $commentsDetails['by'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric" data-title="">
          <?php echo( $commentsDetails['created'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric" data-title="">
          <?php echo( $commentsDetails['state'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric" data-title="">
        <a href="./notification?create=<?php echo( $commentsDetails['ilk'] ); ?>&code=<?php echo( $commentsDetails['author'] ); ?>" ><i class="material-icons">reply</i></a> 
        <a href="./notification?view=<?php echo( $commentsDetails['id'] ); ?>" ><i class="material-icons">open_in_new</i></a> 
        <a href="tel:<?php echo( $commentsDetails['phone'] ); ?>" ><i class="material-icons">phone</i></a> 
        <!-- <a href="./notification?chat=<?php echo( $commentsDetails['author'] ); ?>" ><i class="material-icons">question_answer</i></a>  -->
        <a href="./notification?delete=<?php echo( $commentsDetails['id'] ); ?>" ><i class="material-icons">delete</i></a>
        </td>
        </tr>
        </tbody><?php 
      } ?>
        </table>
        </div><?php 
    } else { ?>
      <div style="margin:1%;" >
      <table class="table pmd-table mdl-color--<?php primaryColor(); ?> mdl-color-text--white"><thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric"><?php echo( strtoupper( $type) ); ?></th>
        <th class="mdl-data-table__cell--non-numeric">SENDER</th>
        <th class="mdl-data-table__cell--non-numeric">SENT ON</th>
        <th class="mdl-data-table__cell--non-numeric">STATUS</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead>
        <tbody>
        <tr>
        <td><p>No <?php echo( ucfirst( $type) ); ?>s Found</p></td>
        </tr>
        </tbody>
        </table>
        </div><?php 
    }
  }

  function getComments() { ?>
  <title>All Comments - <?php showOption( 'name' ); ?></title><?php 
    $getComments = $GLOBALS['JBLDB'] -> query( "SELECT * FROM ". _DBPREFIX ."comments ORDER BY created DESC" );
    if ( $getComments -> num_rows > 0) { ?>
      <div style="margin:1%;" >
        <table class="table pmd-table mdl-color--<?php primaryColor(); ?> mdl-color-text--white">
          <thead>
            <tr>
              <th class="mdl-data-table__cell--non-numeric">COMMENT</th>
              <th class="mdl-data-table__cell--non-numeric">BY</th>
              <th class="mdl-data-table__cell--non-numeric">SENT ON</th>
              <th class="mdl-data-table__cell--non-numeric">STATUS</th>
              <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
            </tr>
          </thead><?php 
        while ( $commentsDetails = mysqli_fetch_assoc( $getComments)){ ?>
          <tbody>
            <tr>
              <td class="mdl-data-table__cell--non-numeric" data-title="">
                <?php echo( $commentsDetails['name'] ); ?>
              </td>
              <td class="mdl-data-table__cell--non-numeric" data-title="">
                <?php echo( $commentsDetails['by'] ); ?>
              </td>
              <td class="mdl-data-table__cell--non-numeric" data-title="">
                <?php echo( $commentsDetails['created'] ); ?>
              </td>
              <td class="mdl-data-table__cell--non-numeric" data-title="">
                <?php echo( $commentsDetails['state'] ); ?>
              </td>
              <td class="mdl-data-table__cell--non-numeric" data-title="">
              <a href="./notification?create=<?php echo( $commentsDetails['ilk'] ); ?>&code=<?php echo( $commentsDetails['author'] ); ?>" ><i class="material-icons">reply</i></a> 
              <a href="./notification?view=<?php echo( $commentsDetails['id'] ); ?>" ><i class="material-icons">open_in_new</i></a> 
              <a href="tel:<?php echo( $commentsDetails['phone'] ); ?>" ><i class="material-icons">phone</i></a> 
              <!-- <a href="./notification?chat=<?php echo( $commentsDetails['author'] ); ?>" ><i class="material-icons">question_answer</i></a>  -->
              <a href="./notification?delete=<?php echo( $commentsDetails['id'] ); ?>" ><i class="material-icons">delete</i></a>
              </td>
            </tr>
          </tbody><?php 
        } ?>
        </table>
      </div><?php 
    } else { ?>
      <div style="margin:1%;" >
        <table class="table pmd-table mdl-color--<?php primaryColor(); ?> mdl-color-text--white">
          <thead>
            <tr>
              <th class="mdl-data-table__cell--non-numeric">COMMENT</th>
              <th class="mdl-data-table__cell--non-numeric">BY</th>
              <th class="mdl-data-table__cell--non-numeric">SENT ON</th>
              <th class="mdl-data-table__cell--non-numeric">STATUS</th>
              <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><p>No Comments Found</p></td>
            </tr>
          </tbody>
        </table>
      </div><?php 
    }
  }

  function getComment( $code) {
    $getComment = $GLOBALS['JBLDB'] -> query( "SELECT * FROM ". _DBPREFIX ."comments WHERE id = '".$code."'" );
    $GLOBALS['JBLDB'] -> query( "UPDATE ". _DBPREFIX ."comments SET state = 'read' WHERE id = '".$code."'" );
    if ( $getComment -> num_rows > 0) {
      while ( $commentDetails = mysqli_fetch_assoc( $getComment)){ ?>
      <title><?php echo( $commentDetails['name'] ); ?> - <?php showOption( 'name' ); ?></title>
        <div class="mdl-grid" >
              <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone">
                    <div class="mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>">
                        <div class="mdl-card__title">
                            <h2 class="mdl-card__title-text"><?php echo( $commentDetails['name'] ); ?></h2>

                            <div class="mdl-layout-spacer"></div>
                            <div class="mdl-card__subtitle-text">
                                <a id="reply" href="./notification?create=<?php echo( $commentDetails['ilk'] ); ?>&code=<?php echo( $commentDetails['author'] ); ?>" ><i class="material-icons">reply</i></a>
                                <a id="chat" href="./notification?chat=<?php echo( $commentDetails['author'] ); ?>" ><i class="material-icons">question_answer</i></a>
                                <a id="delete" href="./notification?delete=<?php echo( $commentDetails['id'] ); ?>" ><i class="material-icons">delete</i></a>
                            </div>

                            <div class="mdl-tooltip" for="reply" >Reply to Comment</div>
                            <div class="mdl-tooltip" for="chat" >Chats</div>
                            <div class="mdl-tooltip" for="delete" >Delete Comment</div>
                        </div>
                        <div class="mdl-card__supporting-text mdl-card--expand mdl-grid">
                          <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone">
                            <blockquote><?php echo( $commentDetails['details'] ); ?></blockquote>
                          </div>
                          <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--2-col-phone">
                            <h5>From: <?php echo( $commentDetails['email'] ); ?></h5>
                            <h5>Sent: <?php echo( $commentDetails['created'] ); ?></h5>
                          </div>
                        </div>
                    </div>
                </div>

                <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone mdl-color--<?php primaryColor(); ?> mdl-card mdl-shadow--2dp mdl-card--expand"><?php 
                  $getNotes = $GLOBALS['JBLDB'] -> query( "SELECT * FROM ". _DBPREFIX ."comments LIMIT 5" );
                  if ( $getNotes -> num_rows >= 0) { ?>
                    <div class="mdl-card__title">
                    <i class="material-icons">query_builder</i>
                      <span class="mdl-button">Recent Comments</span>
                    <div class="mdl-layout-spacer"></div>
                      <div class="mdl-card__subtitle-text">
                        <i class="material-icons">notifications</i>
                      </div>
                    </div>
                    <div class="mdl-card__supporting-text">
                      <ul class="collapsible popout" data-collapsible="accordion"><?php 
                          while ( $note = mysqli_fetch_assoc( $getNotes) ) { ?>
                          <li>
                            <div class="collapsible-header"><i class="material-icons">label_outline</i>
                              
                                <b><?php echo( $note['name'] ); ?></b><span class="alignright"><?php 
                                echo( $note['created'] ); ?></span>
                            </div>
                            <div class="collapsible-body"><span class="alignright">
                                <a href="./notification?create=note&code=<?php echo( $note['author'] ); ?>" ><i class="material-icons">reply</i></a> 
                                <a href="./notification?view=<?php echo( $note['id'] ); ?>" ><i class="material-icons">open_in_new</i></a> 
                                <a href="./notification?delete=<?php echo( $note['id'] ); ?>" ><i class="material-icons">delete</i></a>
                                </span>
                                <span><?php 
                                echo( $note['details'] ); ?></span>
                            </div>
                          </li><?php 
                          } ?>
                    </ul>
                    </div><?php
                  } else {
                  echo '<div class="mdl-card__title">
        <i class="material-icons">notifications_none</i>
          <span class="mdl-button">No Recent Comments</span>
            <div class="mdl-layout-spacer">';
                }
              ?>
        </div>
                </div><?php 
      }
    } else {
      echo 'Comment Not Found';
    }
  }

}
