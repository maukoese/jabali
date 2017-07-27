<?php 

class _hComments {
  var $h_alias; 
  var $h_author;
  var $h_category; 
  var $h_organization; 
  var $h_code; 
  var $h_created; 
  var $h_desc; 
  var $h_email;
  var $h_for; 
  var $h_key; 
  var $h_level; 
  var $h_link; 
  var $h_location; 
  var $h_notes; 
  var $h_phone; 
  var $h_status; 
  var $h_type; 

  
  function create() {

    $date = date( "YmdHms" );
    if ( isset( $_SESSION['myEmail'] ) ) {
      $email = $_SESSION['myEmail'];
    } else {
      $email = hEMAIL;
    }

    $h_alias = $_POST['h_alias'];
    $h_author = $_POST['h_author'];
    $h_by = $_POST['h_by'];
    $h_key = str_shuffle(md5( $email.$date ) );
    $h_code = substr( $h_key, rand(0, 15), 12 ); 
    $h_created = date(Ymd );
    $h_desc = $_POST['h_description']; 
    $h_email = $_POST['h_email'];
    $h_for = $_POST['h_for'];
    $h_level = $_POST['h_level']; 
    $h_link = hADMIN."notification?view=".$h_code;
    $h_status = "unread";
    $h_type = $_POST['h_type'];

     if ( mysqli_query( $GLOBALS['conn'], "INSERT INTO ". hDBPREFIX ."comments (h_alias, h_author, h_by, h_code, h_created, h_description, h_email, h_key, h_level, h_link, h_status, h_type) 
    VALUES ('".$h_alias."', '".$h_author."', '".$h_by."', '".$h_code."', '".$h_created."', '".$h_desc."', '".$h_email."', '".$h_key."', '".$h_level."', '".$h_link."', '".$h_status."', '".$h_type."' )" ) ) {
       echo "<script type = \"text/javascript\">
                    alert(\"Comment Sent\" );
                </script>";
     } else {
        echo "Error: " . $sql . "<br>" . $GLOBALS['conn']->error;
     //   echo "<script type = \"text/javascript\">
     //                alert(\"Comment Not Sent. \n
     //                Check and try again\" );
     //            </script>";
      }
  }

  function delete( $h_code) {}

  function getCommentsType( $type) { ?>
  <title><?php _show_( ucfirst( $type) ); ?>s  List [ <?php showOption( 'name' ); ?> ]</title><?php 
    $getCommentsBy = mysqli_query( $GLOBALS['conn'], "SELECT * FROM ". hDBPREFIX ."comments WHERE h_type = '".$type."' " );
    if ( $getCommentsBy -> num_rows > 0) { ?>
      <div style="margin:1%;" >
      <table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>"><thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric"><?php _show_( strtoupper( $type) ); ?></th>
        <th class="mdl-data-table__cell--non-numeric">SENDER</th>
        <th class="mdl-data-table__cell--non-numeric">SENT ON</th>
        <th class="mdl-data-table__cell--non-numeric">STATUS</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead><?php 
      while ( $commentsDetails = mysqli_fetch_assoc( $getComments)){ ?>
        <tbody>
        <tr>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( $commentsDetails['h_alias'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( $commentsDetails['h_by'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( $commentsDetails['h_created'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
          <?php _show_( $commentsDetails['h_status'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric">
        <a href="./notification?create=<?php _show_( $commentsDetails['h_type'] ); ?>&code=<?php _show_( $commentsDetails['h_author'] ); ?>" ><i class="material-icons">reply</i></a> 
        <a href="./notification?view=<?php _show_( $commentsDetails['h_code'] ); ?>" ><i class="material-icons">open_in_new</i></a> 
        <a href="tel:<?php _show_( $commentsDetails['h_phone'] ); ?>" ><i class="material-icons">phone</i></a> 
        <!-- <a href="./notification?chat=<?php _show_( $commentsDetails['h_author'] ); ?>" ><i class="material-icons">question_answer</i></a>  -->
        <a href="./notification?delete=<?php _show_( $commentsDetails['h_code'] ); ?>" ><i class="material-icons">delete</i></a>
        </td>
        </tr>
        </tbody><?php 
      } ?>
        </table>
        </div><?php 
    } else { ?>
      <div style="margin:1%;" >
      <table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>"><thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric"><?php _show_( strtoupper( $type) ); ?></th>
        <th class="mdl-data-table__cell--non-numeric">SENDER</th>
        <th class="mdl-data-table__cell--non-numeric">SENT ON</th>
        <th class="mdl-data-table__cell--non-numeric">STATUS</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead>
        <tbody>
        <tr>
        <td><p>No <?php _show_( ucfirst( $type) ); ?>s Found</p></td>
        </tr>
        </tbody>
        </table>
        </div><?php 
    }
  }

  function getComments() { ?>
  <title>All Comments [ <?php showOption( 'name' ); ?> ]</title><?php 
    $getComments = mysqli_query( $GLOBALS['conn'], "SELECT * FROM ". hDBPREFIX ."comments ORDER BY h_created DESC" );
    if ( $getComments -> num_rows > 0) { ?>
      <div style="margin:1%;" >
        <table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>">
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
              <td class="mdl-data-table__cell--non-numeric">
                <?php _show_( $commentsDetails['h_alias'] ); ?>
              </td>
              <td class="mdl-data-table__cell--non-numeric">
                <?php _show_( $commentsDetails['h_by'] ); ?>
              </td>
              <td class="mdl-data-table__cell--non-numeric">
                <?php _show_( $commentsDetails['h_created'] ); ?>
              </td>
              <td class="mdl-data-table__cell--non-numeric">
                <?php _show_( $commentsDetails['h_status'] ); ?>
              </td>
              <td class="mdl-data-table__cell--non-numeric">
              <a href="./notification?create=<?php _show_( $commentsDetails['h_type'] ); ?>&code=<?php _show_( $commentsDetails['h_author'] ); ?>" ><i class="material-icons">reply</i></a> 
              <a href="./notification?view=<?php _show_( $commentsDetails['h_code'] ); ?>" ><i class="material-icons">open_in_new</i></a> 
              <a href="tel:<?php _show_( $commentsDetails['h_phone'] ); ?>" ><i class="material-icons">phone</i></a> 
              <!-- <a href="./notification?chat=<?php _show_( $commentsDetails['h_author'] ); ?>" ><i class="material-icons">question_answer</i></a>  -->
              <a href="./notification?delete=<?php _show_( $commentsDetails['h_code'] ); ?>" ><i class="material-icons">delete</i></a>
              </td>
            </tr>
          </tbody><?php 
        } ?>
        </table>
      </div><?php 
    } else { ?>
      <div style="margin:1%;" >
        <table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>">
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
    $getComment = mysqli_query( $GLOBALS['conn'], "SELECT * FROM ". hDBPREFIX ."comments WHERE h_code = '".$code."'" );
    mysqli_query( $GLOBALS['conn'], "UPDATE ". hDBPREFIX ."comments SET h_status = 'read' WHERE h_code = '".$code."'" );
    if ( $getComment -> num_rows > 0) {
      while ( $commentDetails = mysqli_fetch_assoc( $getComment)){ ?>
      <title><?php _show_( $commentDetails['h_alias'] ); ?> [ <?php showOption( 'name' ); ?> ]</title>
        <div class="mdl-grid" >
              <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone">
                    <div class="mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>">
                        <div class="mdl-card__title">
                            <h2 class="mdl-card__title-text"><?php _show_( $commentDetails['h_alias'] ); ?></h2>

                            <div class="mdl-layout-spacer"></div>
                            <div class="mdl-card__subtitle-text">
                                <a id="reply" href="./notification?create=<?php _show_( $commentDetails['h_type'] ); ?>&code=<?php _show_( $commentDetails['h_author'] ); ?>" ><i class="material-icons">reply</i></a>
                                <a id="chat" href="./notification?chat=<?php _show_( $commentDetails['h_author'] ); ?>" ><i class="material-icons">question_answer</i></a>
                                <a id="delete" href="./notification?delete=<?php _show_( $commentDetails['id'] ); ?>" ><i class="material-icons">delete</i></a>
                            </div>

                            <div class="mdl-tooltip" for="reply" >Reply to Comment</div>
                            <div class="mdl-tooltip" for="chat" >Chats</div>
                            <div class="mdl-tooltip" for="delete" >Delete Comment</div>
                        </div>
                        <div class="mdl-card__supporting-text mdl-card--expand mdl-grid">
                          <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone">
                            <blockquote><?php _show_( $commentDetails['h_description'] ); ?></blockquote>
                          </div>
                          <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--2-col-phone">
                            <h5>From: <?php _show_( $commentDetails['h_email'] ); ?></h5>
                            <h5>Sent: <?php _show_( $commentDetails['h_created'] ); ?></h5>
                          </div>
                        </div>
                    </div>
                </div>

                <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone mdl-color--<?php primaryColor(); ?> mdl-card mdl-shadow--2dp mdl-card--expand"><?php 
                  $getNotes = mysqli_query( $GLOBALS['conn'], "SELECT * FROM ". hDBPREFIX ."comments LIMIT 5" );
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
