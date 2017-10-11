<?php 


namespace Jabali\Classes;

class Messages {
  
  function create($name, $author, $by, $id, $created, $details, $email , $for, $authkey, $level, $link, $phone, $state, $ilk) {
  if ( $GLOBALS['JBLDB'] -> query( "INSERT INTO hmessages (name, author, by, id, created, details, email , for, authkey, level, link, phone, state, ilk) 
    VALUES ('".$name."', '".$author."', '".$by."', '".$id."', '".$created."', '".$h_desc."', '".$email ."', '".$for."', '".$authkey."', '".$level."', '".$link."', '".$phone."', '".$state."', '".$ilk."' )" ) ) {
       echo "<script type = \"text/javascript\">
                    alert(\"Message Sent\" );
                </script>";
     } else {
       echo $GLOBALS['JBLDB']->error.'!';
      }
  }

  function deleteMessage( $id) {}

  function getType( $type ) { ?>
  <title><?php _show_( ucfirst( $type) ); ?>'s  List - <?php getMsgCount(); ?> Unread [ <?php showOption( 'name' ); ?> ]</title><?php 
    $getMessagesBy = $GLOBALS['JBLDB'] -> query( "SELECT * FROM ". _DBPREFIX ."messages WHERE (ilk = '".$type."' AND for = '".$_SESSION[JBLSALT.'Code']."' ) " );
    if ( $getMessagesBy -> num_rows > 0) { ?>
      <div class="mdl-cell mdl-cell--12-col">
      <table class="table pmd-table mdl-color--<?php primaryColor(); ?> mdl-color-text--white"><thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric"><?php _show_( strtoupper($type) ); ?></th>
        <th class="mdl-data-table__cell--non-numeric">SENDER</th>
        <th class="mdl-data-table__cell--non-numeric">SENT ON</th>
        <th class="mdl-data-table__cell--non-numeric">STATUS</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead><?php 
      while ( $messagesDetails = mysqli_fetch_assoc( $getMessagesBy)){ ?>
        <tbody>
        <tr>
        <td class="mdl-data-table__cell--non-numeric" data-title="">
          <?php _show_( $messagesDetails['name'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric" data-title="">
          <?php _show_( $messagesDetails['by'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric" data-title="">
          <?php _show_( $messagesDetails['created'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric" data-title="">
          <?php _show_( $messagesDetails['state'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric" data-title="">
        <a href="./message?create=<?php _show_( $messagesDetails['ilk'] ); ?>&code=<?php _show_( $messagesDetails['author'] ); ?>" ><i class="material-icons">reply</i></a> 
        <a href="./message?view=<?php _show_( $messagesDetails['id'] ); ?>&key=<?php _show_( $messagesDetails['name'] ); ?>" ><i class="material-icons">open_in_new</i></a> 
        <a href="tel:<?php _show_( $messagesDetails['phone'] ); ?>" ><i class="material-icons">phone</i></a> 
        <a href="./message?chat=<?php _show_( $messagesDetails['author'] ); ?>" ><i class="material-icons">question_answer</i></a>
        <a href="./message?delete=<?php _show_( $messagesDetails['id'] ); ?>" ><i class="material-icons">delete</i></a>
        </td>
        </tr>
        </tbody><?php 
      } ?>
        </table>
        </div><?php 
    } else { ?>

      <div class="mdl-cell mdl-cell--12-col">
      <table class="table pmd-table mdl-color--<?php primaryColor(); ?> mdl-color-text--white"><thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric"><?php _show_( strtoupper($type) ); ?></th>
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

  function getMessages() { ?>
    <title>All Messages - <?php getMsgCount(); ?> Unread [ <?php showOption( 'name' ); ?> ]</title><?php 
    $getMessages = $GLOBALS['JBLDB'] -> query( "SELECT * FROM ". _DBPREFIX ."messages WHERE for = '".$_SESSION[JBLSALT.'Code']."' ORDER BY created DESC" );
    if ( $getMessages -> num_rows > 0) { ?>
      <div style="margin:1%;" >
      <table class="table pmd-table mdl-color--<?php primaryColor(); ?> mdl-color-text--white"><thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric">MESSAGE</th>
        <th class="mdl-data-table__cell--non-numeric">SENDER</th>
        <th class="mdl-data-table__cell--non-numeric">SENT ON</th>
        <th class="mdl-data-table__cell--non-numeric">STATUS</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead><?php 
      while ( $messagesDetails = mysqli_fetch_assoc( $getMessages)){ ?>
        <tbody>
        <tr>
        <td class="mdl-data-table__cell--non-numeric" data-title="">
          <?php _show_( $messagesDetails['name'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric" data-title="">
          <?php _show_( $messagesDetails['by'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric" data-title="">
          <?php _show_( $messagesDetails['created'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric" data-title="">
          <?php _show_( $messagesDetails['state'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric" data-title="">
        <a href="./message?create=<?php _show_( $messagesDetails['ilk'] ); ?>&code=<?php _show_( $messagesDetails['author'] ); ?>" ><i class="material-icons">reply</i></a> 
        <a href="./message?view=<?php _show_( $messagesDetails['id'] ); ?>&key=<?php _show_( $messagesDetails['name'] ); ?>" ><i class="material-icons">open_in_new</i></a> 
        <a href="tel:<?php _show_( $messagesDetails['phone'] ); ?>" ><i class="material-icons">phone</i></a> 
        <!-- <a href="./message?chat=<?php _show_( $messagesDetails['author'] ); ?>" ><i class="material-icons">question_answer</i></a>  -->
        <a href="./message?delete=<?php _show_( $messagesDetails['id'] ); ?>" ><i class="material-icons">delete</i></a>
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
        <th class="mdl-data-table__cell--non-numeric">MESSAGE</th>
        <th class="mdl-data-table__cell--non-numeric">SENDER</th>
        <th class="mdl-data-table__cell--non-numeric">SENT ON</th>
        <th class="mdl-data-table__cell--non-numeric">STATUS</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead>
        <tbody>
        <tr>
        <td><p>Looks like you haven't received any message.</p></td>
        <td><p>Check back later?</p></td>
        </tr>
        </tbody>
        </table>
        </div><?php 
    }
  }

  function getSentMessages() { ?>
    <title>Sent Messages [ <?php showOption( 'name' ); ?> ]</title><?php 
    $getMessages = $GLOBALS['JBLDB'] -> query( "SELECT * FROM ". _DBPREFIX ."messages WHERE author = '".$_SESSION[JBLSALT.'Code']."' ORDER BY created DESC" );
    if ( $getMessages -> num_rows > 0) { ?>
      <div style="margin:1%;" >
      <table class="table pmd-table mdl-color--<?php primaryColor(); ?> mdl-color-text--white"><thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric">MESSAGE</th>
        <th class="mdl-data-table__cell--non-numeric">SENT ON</th>
        <th class="mdl-data-table__cell--non-numeric">STATUS</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead><?php 
      while ( $messagesDetails = mysqli_fetch_assoc( $getMessages)){ ?>
        <tbody>
        <tr>
        <td class="mdl-data-table__cell--non-numeric" data-title="">
          <?php _show_( $messagesDetails['name'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric" data-title="">
          <?php _show_( $messagesDetails['created'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric" data-title="">
          <?php _show_( $messagesDetails['state'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric" data-title="">
        <a href="./message?create=<?php _show_( $messagesDetails['ilk'] ); ?>&code=<?php _show_( $messagesDetails['for'] ); ?>" ><i class="material-icons">reply</i></a>
        <a href="./message?chat=<?php _show_( $messagesDetails['for'] ); ?>" ><i class="material-icons">question_answer</i></a>
        <a href="./message?delete=<?php _show_( $messagesDetails['id'] ); ?>" ><i class="material-icons">delete</i></a>
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
        <th class="mdl-data-table__cell--non-numeric">MESSAGE</th>
        <th class="mdl-data-table__cell--non-numeric">SENDER</th>
        <th class="mdl-data-table__cell--non-numeric">SENT ON</th>
        <th class="mdl-data-table__cell--non-numeric">STATUS</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead>
        <tbody>
        <tr>
        <td><p>You haven't sent any messages yet</p>
        <a href="?create=message">Compose now?</a></td>
        </tr>
        </tbody>
        </table>
        </div><?php 
    }
  }

  function getUnreadMessages() { ?>
    <title>Unread Messages - <?php getMsgCount(); ?> [ <?php showOption( 'name' ); ?> ]</title><?php 
    $getMessages = $GLOBALS['JBLDB'] -> query( "SELECT * FROM ". _DBPREFIX ."messages WHERE (state = 'unread' AND for = '".$_SESSION[JBLSALT.'Code']."' ) ORDER BY created DESC" );
    if ( $getMessages -> num_rows > 0) { ?>
      <div class="mdl-cell mdl-cell--12-col">
      <table class="table pmd-table mdl-color--<?php primaryColor(); ?> mdl-color-text--white"><thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric">Flag</th>
        <th class="mdl-data-table__cell--non-numeric">Sender</th>
        <th class="mdl-data-table__cell--non-numeric">Message</th>
        <th class="mdl-data-table__cell--non-numeric">Date</th>
        </tr>
        </thead><?php 
      while ( $messagesDetails = mysqli_fetch_assoc( $getMessages)){ ?>
        <tbody>
        <tr>
        <td class="mdl-data-table__cell--non-numeric" data-title="">
          <i class="material-icons">flag</i>
        </td>
        <td class="mdl-data-table__cell--non-numeric" data-title="">
          <a href="users?view=<?php _show_( $messagesDetails['author'] ); ?>&key=<?php _show_( $messagesDetails['by'] ); ?>"><?php _show_( $messagesDetails['by'] ); ?></a>
        </td>
        <td class="mdl-data-table__cell--non-numeric" data-title="">
          <?php _show_( $messagesDetails['name'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric" data-title="">
          <?php _show_( $messagesDetails['created'] ); ?>
        </td>
        </tr>
        </tbody><?php 
      } ?>
        </table>
        </div><?php 
    } else { ?>
      <div class="mdl-cell mdl-cell--12-col">
      <table class="table pmd-table mdl-color--<?php primaryColor(); ?> mdl-color-text--white"><thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric">Flag</th>
        <th class="mdl-data-table__cell--non-numeric">Sender</th>
        <th class="mdl-data-table__cell--non-numeric">Message</th>
        <th class="mdl-data-table__cell--non-numeric">Date</th>
        </tr>
        </thead>
        <tbody>
        <tr>
        <td>
        <center><i class="material-icons">done_all</i><p>Oops! You have read all your messages.</p></center>
        </td>
        </tr>
        </tbody>
        </table>
        </div><?php 
    }
  }

  function getMessageCode( $code) {
    $getMessageCode = $GLOBALS['JBLDB'] -> query( "SELECT * FROM ". _DBPREFIX ."messages WHERE id = '".$code."'" );
    $GLOBALS['JBLDB'] -> query( "UPDATE hmessages SET state = 'read' WHERE id = '".$code."'" );
    if ( $getMessageCode -> num_rows > 0) {
      while ( $messageDetails = mysqli_fetch_assoc( $getMessageCode)){ ?>
      <title><?php _show_( $messageDetails['name'] ); ?> [ <?php showOption( 'name' ); ?> ]</title>
        <div class="mdl-grid" >
              <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone">
                    <div class="mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>">
                        <div class="mdl-card__title">
                            <h2 class="mdl-card__title-text"><?php _show_( $messageDetails['name'] ); ?></h2>

                            <div class="mdl-layout-spacer"></div>
                            <div class="mdl-card__subtitle-text">
                                <a id="reply" href="./message?create=<?php _show_( $messageDetails['ilk'] ); ?>&code=<?php _show_( $messageDetails['author'] ); ?>" ><i class="material-icons">reply</i></a>
                                <!-- <a id="chat" href="./message?chat=<?php _show_( $messageDetails['author'] ); ?>" ><i class="material-icons">question_answer</i></a> -->
                                <a id="delete" href="./message?delete=<?php _show_( $messageDetails['id'] ); ?>" ><i class="material-icons">delete</i></a>
                            </div>

                            <div class="mdl-tooltip" for="reply" >Reply to Message</div>
                            <div class="mdl-tooltip" for="chat" >Chats</div>
                            <div class="mdl-tooltip" for="delete" >Delete Message</div>
                        </div>
                        <div class="mdl-card__supporting-text mdl-card--expand mdl-grid">
                          <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone">
                            <blockquote><?php _show_( $messageDetails['details'] ); ?></blockquote>
                          </div>
                          <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--2-col-phone">
                            <h5>From: <?php _show_( $messageDetails['email'] ); ?></h5>
                            <h5>Sent: <?php _show_( $messageDetails['created'] ); ?></h5>
                          </div>
                        </div>
                    </div>
                </div>

                <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone">
                    <div class="mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>">
                        <div class="mdl-card__title">
                        <i class="material-icons">business</i>
                          <?php _show_( $_SESSION[JBLSALT.'Org'] ); ?>
                            <div class="mdl-layout-spacer"></div>
                            <div class="mdl-card__subtitle-text mdl-button">
                                <i class="material-icons">room</i>
                                <?php _show_( $_SESSION[JBLSALT.'Location'] ); ?>
                            </div>
                        </div>
                        <div class="mdl-card__supporting-text mdl-card--expand">
                            Messages and latest chats go here
                        </div>
                    </div>
                </div>
                </div><?php 
      }
    } else {
      echo 'Message Not Found';
    }
  }

  function getComments() { ?>
    <title>All Comments - <?php getMsgCount(); ?> Unread [ <?php showOption( 'name' ); ?> ]</title><?php 
    $getMessages = $GLOBALS['JBLDB'] -> query( "SELECT * FROM ". _DBPREFIX ."messages WHERE ilk = 'comment' ORDER BY created DESC" );
    if ( $getMessages -> num_rows > 0) { ?>
      <div style="margin:1%;" >
      <table class="table pmd-table mdl-color--<?php primaryColor(); ?> mdl-color-text--white"><thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric">COMMENT</th>
        <th class="mdl-data-table__cell--non-numeric">BY</th>
        <th class="mdl-data-table__cell--non-numeric">SENT ON</th>
        <th class="mdl-data-table__cell--non-numeric">FOR</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead><?php 
      while ( $messagesDetails = mysqli_fetch_assoc( $getMessages)){ ?>
        <tbody>
        <tr>
        <td class="mdl-data-table__cell--non-numeric" data-title="">
          <?php _show_( $messagesDetails['name'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric" data-title="">
          <?php _show_( $messagesDetails['by'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric" data-title="">
          <?php _show_( $messagesDetails['created'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric" data-title="">
          <?php _show_( $messagesDetails['for'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric" data-title="">
        <a href="./message?create=<?php _show_( $messagesDetails['ilk'] ); ?>&code=<?php _show_( $messagesDetails['author'] ); ?>" ><i class="material-icons">reply</i></a> 
        <a href="./message?view=<?php _show_( $messagesDetails['id'] ); ?>&key=<?php _show_( $messagesDetails['name'] ); ?>" ><i class="material-icons">open_in_new</i></a> 
        <a href="tel:<?php _show_( $messagesDetails['phone'] ); ?>" ><i class="material-icons">phone</i></a> 
        <!-- <a href="./message?chat=<?php _show_( $messagesDetails['author'] ); ?>" ><i class="material-icons">question_answer</i></a>  -->
        <a href="./message?delete=<?php _show_( $messagesDetails['id'] ); ?>" ><i class="material-icons">delete</i></a>
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
        <th class="mdl-data-table__cell--non-numeric">COMMENT</th>
        <th class="mdl-data-table__cell--non-numeric">BY</th>
        <th class="mdl-data-table__cell--non-numeric">SENT ON</th>
        <th class="mdl-data-table__cell--non-numeric">FOR</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead>
        <tbody>
        <tr>
        <td><p>Looks like you haven't received any message.</p></td>
        <td><p>Check back later?</p></td>
        </tr>
        </tbody>
        </table>
        </div><?php 
    }
  }

  function getCommentsFor( $for) { ?>
    <title>Comments on - <?php getMsgCount(); ?> Unread [ <?php showOption( 'name' ); ?> ]</title><?php 
    $getMessages = $GLOBALS['JBLDB'] -> query( "SELECT * FROM ". _DBPREFIX ."messages WHERE for = '".$for."' ORDER BY created DESC" );
    if ( $getMessages -> num_rows > 0) { ?>
      <div style="margin:1%;" >
      <table class="table pmd-table mdl-color--<?php primaryColor(); ?> mdl-color-text--white"><thead>
        <tr>
        <th class="mdl-data-table__cell--non-numeric">MESSAGE</th>
        <th class="mdl-data-table__cell--non-numeric">SENDER</th>
        <th class="mdl-data-table__cell--non-numeric">SENT ON</th>
        <th class="mdl-data-table__cell--non-numeric">STATUS</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead><?php 
      while ( $messagesDetails = mysqli_fetch_assoc( $getMessages)){ ?>
        <tbody>
        <tr>
        <td class="mdl-data-table__cell--non-numeric" data-title="">
          <?php _show_( $messagesDetails['name'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric" data-title="">
          <?php _show_( $messagesDetails['by'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric" data-title="">
          <?php _show_( $messagesDetails['created'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric" data-title="">
          <?php _show_( $messagesDetails['state'] ); ?>
        </td>
        <td class="mdl-data-table__cell--non-numeric" data-title="">
        <a href="./message?create=<?php _show_( $messagesDetails['ilk'] ); ?>&code=<?php _show_( $messagesDetails['author'] ); ?>" ><i class="material-icons">reply</i></a> 
        <a href="./message?view=<?php _show_( $messagesDetails['id'] ); ?>&key=<?php _show_( $messagesDetails['name'] ); ?>" ><i class="material-icons">open_in_new</i></a> 
        <a href="tel:<?php _show_( $messagesDetails['phone'] ); ?>" ><i class="material-icons">phone</i></a> 
        <!-- <a href="./message?chat=<?php _show_( $messagesDetails['author'] ); ?>" ><i class="material-icons">question_answer</i></a>  -->
        <a href="./message?delete=<?php _show_( $messagesDetails['id'] ); ?>" ><i class="material-icons">delete</i></a>
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
        <th class="mdl-data-table__cell--non-numeric">MESSAGE</th>
        <th class="mdl-data-table__cell--non-numeric">SENDER</th>
        <th class="mdl-data-table__cell--non-numeric">SENT ON</th>
        <th class="mdl-data-table__cell--non-numeric">STATUS</th>
        <th class="mdl-data-table__cell--non-numeric">ACTIONS</th>
        </tr>
        </thead>
        <tbody>
        <tr>
        <td><p>Looks like you haven't received any message.</p></td>
        <td><p>Check back later?</p></td>
        </tr>
        </tbody>
        </table>
        </div><?php 
    }
  }

  function getComment( $code) {
    $getMessageCode = $GLOBALS['JBLDB'] -> query( "SELECT * FROM ". _DBPREFIX ."messages WHERE id = '".$code."'" );
    $GLOBALS['JBLDB'] -> query( "UPDATE hmessages SET state = 'read' WHERE id = '".$code."'" );
    if ( $getMessageCode -> num_rows > 0) {
      while ( $messageDetails = mysqli_fetch_assoc( $getMessageCode)){ ?>
      <title><?php _show_( $messageDetails['name'] ); ?> [ <?php showOption( 'name' ); ?> ]</title>
        <div class="mdl-grid" >
              <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone">
                    <div class="mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>">
                        <div class="mdl-card__title">
                            <h2 class="mdl-card__title-text"><?php _show_( $messageDetails['name'] ); ?></h2>

                            <div class="mdl-layout-spacer"></div>
                            <div class="mdl-card__subtitle-text">
                                <a id="reply" href="./message?create=<?php _show_( $messageDetails['ilk'] ); ?>&code=<?php _show_( $messageDetails['author'] ); ?>" ><i class="material-icons">reply</i></a>
                                <!-- <a id="chat" href="./message?chat=<?php _show_( $messageDetails['author'] ); ?>" ><i class="material-icons">question_answer</i></a> -->
                                <a id="delete" href="./message?delete=<?php _show_( $messageDetails['id'] ); ?>" ><i class="material-icons">delete</i></a>
                            </div>

                            <div class="mdl-tooltip" for="reply" >Reply to Message</div>
                            <div class="mdl-tooltip" for="chat" >Chats</div>
                            <div class="mdl-tooltip" for="delete" >Delete Message</div>
                        </div>
                        <div class="mdl-card__supporting-text mdl-card--expand mdl-grid">
                          <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone">
                            <blockquote><?php _show_( $messageDetails['details'] ); ?></blockquote>
                          </div>
                          <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--2-col-phone">
                            <h5>From: <?php _show_( $messageDetails['email'] ); ?></h5>
                            <h5>Sent: <?php _show_( $messageDetails['created'] ); ?></h5>
                          </div>
                        </div>
                    </div>
                </div>

                <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone">
                    <div class="mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>">
                        <div class="mdl-card__title">
                        <i class="material-icons">business</i>
                          <?php _show_( $_SESSION[JBLSALT.'Org'] ); ?>
                            <div class="mdl-layout-spacer"></div>
                            <div class="mdl-card__subtitle-text mdl-button">
                                <i class="material-icons">room</i>
                                <?php _show_( $_SESSION[JBLSALT.'Location'] ); ?>
                            </div>
                        </div>
                        <div class="mdl-card__supporting-text mdl-card--expand">
                            Messages and latest chats go here
                        </div>
                    </div>
                </div>
                </div><?php 
      }
    } else {
      echo 'Message Not Found';
    }
  }

  function getChatCode( $code) {
    $getMessageCode = $GLOBALS['JBLDB'] -> query( "SELECT * FROM ". _DBPREFIX ."messages WHERE author = '".$code."'" );
    if ( $getMessageCode -> num_rows > 0) {
      while ( $messageDetail = mysqli_fetch_assoc( $getMessageCode)){
        $messageDetails[] = $messageDetail;
      }
    } else {
      echo 'Chat Not Found';
    }

    if ( !empty( $messageDetails) ) { ?>
    <div class="mdl-grid" >
              <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone">
                    <div class="mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>">
                    <div class="mdl-card__title">
                <h2 class="mdl-card__title-text"> Chat with <?php _show_( $messageDetails[0]['by'] ); ?></h2>
              </div>
              <title><?php _show_( $messageDetails[0]['by'] ); ?> [ JABALI Chats ]</title><?php 
        foreach ( $messageDetails as $message) { ?>
        <div class="mdl-card__supporting-text mdl-card--expand mdl-grid">
                <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--12-col-phone">
                  <div><?php _show_( $message['details'] ); ?>
                  <span class="alignright" >Sent: <?php _show_( $message['created'] ); ?></span></div>
                </div>
              </div><?php } ?>
              <div class="mdl-card__supporting-text mdl-card--expand">
                    <form enctype="multipart/form-data" name="messageForm" method="POST" action="">
                      <title>Create Message</title>
                        <input type="hidden" name="name" value="Reply">
                        <input type="hidden" name="email " value="<?php _show_( $_SESSION[JBLSALT.'Email'] ); ?>">
                        <input type="hidden" name="author" value="<?php _show_( $_SESSION[JBLSALT.'Code'] ); ?>">
                        <input type="hidden" name="for" value="<?php _show_( $_GET['code'] ); ?>">
                        <input type="hidden" name="level" value="private">
                        <input type="hidden" name="ilk" value="chat">

                        <div class="input-field">
                          <p>Your Response</p>
                        <textarea id="message" rows="5" name="h_desc"></textarea><script>CKEDITOR.replace( 'message' );</script>
                        </div>
                        <br>
                        <a href="./message?create=chat" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect "style="float:left;"><i class="material-icons">chat</i></a>
                        <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect " type="submit" name="create" style="float:right;"><i class="material-icons">send</i></button>
                    </form>
                </div>
                    </div>
                </div>

                <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--12-col-phone mdl-color--<?php primaryColor(); ?> mdl-card"><?php 
                  $getNotes = $GLOBALS['JBLDB'] -> query( "SELECT * FROM ". _DBPREFIX ."messages LIMIT 5" );
                  if ( $getNotes -> num_rows >= 0) { ?>
                    <div class="mdl-card__title">
                    <i class="material-icons">query_builder</i>
                      <span class="mdl-button">Recent Messages</span>
                    <div class="mdl-layout-spacer"></div>
                    </div>
                    <div class="mdl-card__supporting-text">
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
                    </ul>
                    </div><?php
                  } else {
                    echo "No Messages";
                  } ?>
              </div>
                </div><?php 
    }
  }
}
