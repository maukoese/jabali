<?php
include '../inc/jabali.php';
include './header.php';

if ( isset( $_GET['ddelete'] ) ) {
  $hPost -> delete( $_GET['ddelete'] );
}
if ( isset( $_POST['draft'] ) ) {
  $h_alias = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_alias'] ); 
  $h_author = $_SESSION['myCode'];
  $h_avatar = hASSETS . 'placeholder.svg';

  $h_by = $_SESSION['myAlias'];
  $h_key = str_shuffle( generateCode() );
  $h_code = substr( $h_key, rand(0, 15), 12 ); 
  $h_created = date('Y-m-d');
  $h_desc = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_description'] ); 
  $h_email = $_SESSION['myEmail']; 
  $h_link = preg_replace('/\s+/', '_', $h_alias);
  if ( recordExists( $h_link ) ) {
    $i = 1;
    $h_link = strtolower( $h_link.'_'.$i++ );
  } else {
    $h_link = strtolower( $h_link );
  }
  $h_location = $_SESSION['myLocation'];
  $h_notes = substr( $h_desc, 250 ); 
  $h_phone = $_SESSION['myPhonew']; 
  $h_status = "draft";
  $h_subtitle = mysqli_real_escape_string( $GLOBALS['conn'], $_POST['h_subtitle'] );
  $h_type = "article";

  $h_category = "n/a"; 
  $h_organization = "n/a";
  $h_fav = "n/a";
  $h_level = "n/a"; 
  $h_location = "n/a";
  $h_reading = "n/a";
  $h_tags = "n/a";
  $h_updated = "n/a";

$hPost -> create( $h_alias, $h_author, $h_avatar, $h_by, $h_category, $h_organization, $h_code, $h_created, $h_desc, $h_email, $h_fav, $h_key, $h_level, $h_link, $h_location, $h_notes, $h_phone, $h_reading, $h_status, $h_subtitle, $h_tags, $h_type, $h_updated );
} ?>
<div class="mdl-grid"><?php
  if ( isset( $_GET['x'] ) ) {
    require_once hABSX.$_GET['x'].'/'.$_GET['x'].'.php';
  } else { ?>
    <title><? _show_( ucwords( $_SESSION['myCap'] ) ); ?> Dashboard [ <?php showOption( 'name' ); ?> ]</title>
    <div class="mdl-cell--12-col mdl-grid">
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
          <?php $hWidget -> stats();
          $field1 = array ( "length" => "mdl-cell mdl-cell--6-col", "icon" =>" label", "icon-class" => "material-icons prefix", "genre" => "textarea", "class" => "", "type" => "text", "name" => "myName", "id" => "myName", "placeholder" => "My Name", "value" => "");
          $field2 = array ( "length" => "mdl-cell mdl-cell--6-col", "genre" =>"button", "class" => "mdl-button", "type" => "submit", "name" => "myName", "id" => "myName", "placeholder" => "My Name", "value" => "save");
          form( 'testForm', 'multipart/form-data', 'POST', '#', 'mdl-grid', array( $field1, $field2 ) );  ?>
      </div>
      <div class="mdl-cell mdl-cell--5-col mdl-card mdl-color--<?php primaryColor(); ?>" >
        <?php $hWidget -> jabaliCentral(); ?>
      </div>
    </div><?php 
  } ?>
</div><?php 
include './footer.php'; ?>