<?php  
include '../inc/jabali.php';
include './header.php';

if ( isset( $_GET['chat'] ) ) {
  if ( $_GET['chat'] == "list" ) {
    $hMessage -> getMessagesType('chat' );
  } else {
    $hMessage -> getChatCode( $_GET['chat'] );

  }
}

if ( isset( $_GET['delete'] ) ) {
  mysqli_query( $GLOBALS['conn'], "DELETE FROM hmessages WHERE h_code='".$_GET['delete']."'" );
  $hMessage -> getMessages();
}

if ( isset( $_POST['create'] ) ) {
    $h_key = generateCode();
    $h_alias = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_alias'] );
    $h_author = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_author'] );
    $h_by = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_by'] );
    $h_avatar = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_avatar'] );
    $h_code = substr( $h_key, rand(0, 15), 12 );
    $h_created = date( 'Y-m-d' );
    $h_description = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_description'] );
    $h_email = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_email'] );
    $h_type = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_type'] );
    $h_for = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_for'] );
    $h_link = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_link'] );
    $h_location = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_location'] );
    $h_location = strtolower( $h_location );
    $h_level = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_level'] ); 
    $h_link = hADMIN."message?view=".$h_code;
    $h_phone = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_phone'] );
    $h_status = "unread";

    $hMessage -> create ($h_alias, $h_author, $h_by, $h_code, $h_created, $h_description, $h_email, $h_for, $h_key, $h_level, $h_link, $h_phone, $h_status, $h_type);
} ?>
<div class="mdl-grid">

<div class="mdl-cell mdl-cell--9-col-desktop mdl-cell--9-col-tablet mdl-cell--12-col-phone mdl-grid">
            <div class="mdl-cell mdl-cell--2-col">
              <a href="./message?compose=message"><button class="mdl-button mdl-color--red alignrght "><i class="material-icons">mode_edit</i>Compose</button></a>

                     <a href="./message?view=unread&key=unread messages" class="mdl-tabs__tab is-active">Inbox
                     </a>
                     <a href="./message?view=flagged&key=flagged messages" class="mdl-tabs__tab">Flagged
                      </a>
                      <a href="./message?view=drafts&key=draft messages" class="mdl-tabs__tab">Drafts
                      </a>
                  <a href="./message?view=sent&key=sent messages" class="mdl-tabs__tab">Sent
                  </a>
           </div>
           <div class="mdl-cell mdl-cell--10-col"><?php
                       if ( isset( $_GET['compose'] ) ) {
              $hForm -> messageForm( $_GET['create'] );
            } elseif ( isset( $_GET['view'] ) ) {
                if ( $_GET['view'] == "unread" ) {
                  $hMessage -> getUnreadMessages();
                } else if ( $_GET['view'] == "outbox" ) {
                $hMessage -> getSentMessages();
                } else if ( $_GET['view'] == "flagged" ) {
                  $hMessage -> getSentMessages();
                } else if ( $_GET['view'] == "drafts" ) {
                  $hMessage -> getSentMessages();
                } else if ( $_GET['view'] == "sent" ) {
                  $hMessage -> getSentMessages(); 
                } else {
                  $hMessage -> getMessageCode( $_GET['view'] );
                }
              } ?>
          </div>
</div>

<div class="mdl-cell mdl-cell--3-col-desktop mdl-cell--3-col-tablet mdl-cell--12-col-phone mdl-grid">
<div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>">
    
    <div class="mdl-card__title">
      <span class="mdl-button">Online</span>
        <div class="mdl-layout-spacer"></div>
        <div class="mdl-card__subtitle-text mdl-button">
            <i class="material-icons">chat</i>
        </div>
    </div>
    <div class="mdl-card__supporting-text">
      <a href="?sort=images" class="mdl-list__item"><i class="mdi mdi-account mdl-list__item-icon"></i><span style="padding-left: 20px">Online User</span></a>
      <a href="?sort=images" class="mdl-list__item"><i class="mdi mdi-account mdl-list__item-icon"></i><span style="padding-left: 20px">Online User</span></a>
      <a href="?sort=images" class="mdl-list__item"><i class="mdi mdi-account mdl-list__item-icon"></i><span style="padding-left: 20px">Online User</span></a>
      <a href="?sort=images" class="mdl-list__item"><i class="mdi mdi-account mdl-list__item-icon"></i><span style="padding-left: 20px">Online User</span></a>

</div>
</div>
<div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>">
    
    <div class="mdl-card__title">
      <span class="mdl-button">Offline</span>
        <div class="mdl-layout-spacer"></div>
        <div class="mdl-card__subtitle-text mdl-button">
            <i class="material-icons">chat</i>
        </div>
    </div>
    <div class="mdl-card__supporting-text">
      <a href="?sort=images" class="mdl-list__item"><i class="mdi mdi-account mdl-list__item-icon"></i><span style="padding-left: 20px">Online User</span></a>
      <a href="?sort=images" class="mdl-list__item"><i class="mdi mdi-account mdl-list__item-icon"></i><span style="padding-left: 20px">Online User</span></a>
      <a href="?sort=images" class="mdl-list__item"><i class="mdi mdi-account mdl-list__item-icon"></i><span style="padding-left: 20px">Online User</span></a>
      <a href="?sort=images" class="mdl-list__item"><i class="mdi mdi-account mdl-list__item-icon"></i><span style="padding-left: 20px">Online User</span></a>

</div>
</div><?php 
include './footer.php';
