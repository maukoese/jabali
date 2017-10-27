<?php
session_start();
require_once( '../init.php' );
require_once( 'header.php' );

if ( isset( $_GET['ddelete'] ) ) {
  global $hPost;
  $hPost -> delete( $_GET['ddelete'] );
}

if ( isset( $_POST['draft'] ) ) {
  global $hPost;

  $name = $GLOBALS['JBLDB'] -> clean( $_POST['name'] ); 
  $author = $_SESSION[JBLSALT.'Code'];
  $avatar = _ASSETS . 'placeholder.svg';

  $by = $_SESSION[JBLSALT.'Alias'];
  $authkey = str_shuffle( generateCode() );
  $id = substr( $authkey, rand(0, 15), 12 ); 
  $created = date('Y-m-d');
  $h_desc = $GLOBALS['JBLDB'] -> clean( $_POST['details'] ); 
  $email  = $_SESSION[JBLSALT.'Email']; 
  $link = preg_replace('/\s+/', '_', $name);
  if ( recordExists( $link ) ) {
    $i = 1;
    $link = strtolower( $link.'_'.$i++ );
  } else {
    $link = strtolower( $link );
  }
  $location = $_SESSION[JBLSALT.'Location'];
  $excerpt = substr( $h_desc, 250 ); 
  $phone = $_SESSION[JBLSALT.'Phone']; 
  $state = "draft";
  $subtitle = $GLOBALS['JBLDB'] -> clean( $_POST['subtitle'] );
  $ilk = "article";

  $category = "n/a"; 
  $company = "n/a";
  $h_fav = "n/a";
  $level = "n/a"; 
  $location = "n/a";
  $readings = "n/a";
  $tags = "n/a";
  $updated = "n/a";

$hPost -> create( $name, $author, $avatar, $by, $category, $company, $id, $created, $h_desc, $email , $h_fav, $authkey, $level, $link, $location, $excerpt, $phone, $readings, $state, $subtitle, $tags, $ilk, $updated );
} ?>
<div class="mdl-grid"><?php
  if ( isset( $_GET['x'] ) ) {
    doSetting( $_GET['x'] );
    doActions( $_GET['x'] );
    renderSettingsForm( $_GET['x'] );
  } else {
    global $hWidget; ?>
    <title><?php echo( ucwords( $_SESSION[JBLSALT.'Cap'] ) ); ?> Dashboard - <?php showOption( 'name' ); ?></title>
    	<div class="mdl-cell mdl-cell--3-col mdl-card mdl-color--<?php primaryColor(); ?>" >
          <?php $hWidget -> quickLinks(); ?>
      </div>
      <div class="mdl-cell mdl-cell--3-col mdl-card mdl-color--<?php primaryColor(); ?>" >
        <?php $hWidget -> dashRecents(); ?>
      </div>
      <div class="mdl-cell mdl-cell--6-col mdl-card mdl-color--<?php primaryColor(); ?>" >
        <?php $hWidget -> dashDrafts(); ?>
      </div>
      <div class="mdl-cell mdl-cell--7-col mdl-card mdl-color--<?php primaryColor(); ?>">
          <?php $hWidget -> stats(); ?>
      </div>
      <div class="mdl-cell mdl-cell--5-col mdl-card mdl-color--<?php primaryColor(); ?>" >
        <?php $hWidget -> jabaliCentral(); ?>
      </div><?php 
  } ?>
</div><?php 
include './footer.php'; ?>