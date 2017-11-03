<?php 
/**
* @package Jabali Framework
* @subpackage Admin Messages
* @link https://docs.jabalicms.org/messages/
* @author Mauko Maunde
* @since 0.17.04
**/
session_start();
require_once( '../init.php' );
require_once( 'header.php' );

if ( isset( $_GET['delete'] ) ) {
  $GLOBALS['JBLDB'] -> query( "DELETE FROM ". _DBPREFIX ."messages WHERE id='".$_GET['delete']."'" );
  $hMessage -> getMessages();
}

if ( isset( $_POST['create'] ) ) {
    $authkey = generateCode();
    $name = $GLOBALS['JBLDB'] -> clean( $_POST['name'] );
    $author = $GLOBALS['JBLDB'] -> clean( $_POST['author'] );
    $by = $GLOBALS['JBLDB'] -> clean( $_POST['by'] );
    $avatar = $GLOBALS['JBLDB'] -> clean( $_POST['avatar'] );
    $id = substr( $authkey, rand(0, 15), 12 );
    $created = date( 'Y-m-d' );
    $details = $GLOBALS['JBLDB'] -> clean( $_POST['details'] );
    $email  = $GLOBALS['JBLDB'] -> clean( $_POST['email'] );
    $ilk = $GLOBALS['JBLDB'] -> clean( $_POST['ilk'] );
    $for = $GLOBALS['JBLDB'] -> clean( $_POST['for'] );
    $link = $GLOBALS['JBLDB'] -> clean( $_POST['link'] );
    $location = $GLOBALS['JBLDB'] -> clean( $_POST['location'] );
    $location = strtolower( $location );
    $level = $GLOBALS['JBLDB'] -> clean( $_POST['level'] ); 
    $link = _ADMIN."message?view=".$id;
    $phone = $GLOBALS['JBLDB'] -> clean( $_POST['phone'] );
    $state = "unread";

    $hMessage -> create ($name, $author, $by, $id, $created, $details, $email , $for, $authkey, $level, $link, $phone, $state, $ilk);

  } ?>
  <div class="mdl-grid"><?php
    if ( isset( $_GET['create'] ) ) {
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
        } else if ( $_GET['view'] == "list" ) {
          if ( isset( $_GET['type'] ) ) {
            $hMessage -> getType( $_GET['type'] );
          } else {
            $hMessage -> getMessages();
          }
        } else {
          $hMessage -> getMessageCode( $_GET['view'] );
        }
    } ?>
  </div><?php
include './footer.php';
