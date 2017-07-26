<?php 
include '../inc/config.php'; 
include '../inc/jabali.php';
include './header.php';

if ( isset( $_GET['install'] ) ) {
	function intallX( $name, $source) {
		$xZip = fopen( "../extensions/temp/$name.zip", "w" );
    if ( $xZip) {
      file_put_contents( $xZip, fopen( $source, "r" ) );
    }

    $install = new ZipArchive();
    $xT = $install -> open( $xZip );
    if ( $xT === TRUE ) {
      $install -> extractTo( hEXTENSIONS );

      $xJson = file_get_contents( hEXTENSIONS.$name."/".$name.".json" );
      $xD = json_decode( $xJson, true );

      mysqli_query( $GLOBALS['conn'], "INSERT INTO hextensions (h_alias, h_author, h_avatar, h_category, h_code, h_created, h_description, h_email, h_key, h_social, h_status, h_support, h_website) VALUES ('".$xD['name']."', '".$xD['author']."', '".$xD['screenshot']."', '".$xD['category']."', '".substr(md5(date(YmdHms)), 0, 12)."', '".date('Ymd' )."', '".$xD['description']."', '".$xD['social']['email']."', '".md5(date(YmdHms))."', '".$xD['social']['facebook'].", ".$xD['social']['twitter'].", ".$xD['social']['github']."', 'active', '".$xD['support']."', '".$xD['website']."' )" );

      $install -> close();
    } else {
      echo "Error!";
    }
	}

  intallX( $_GET['install'], "http://code.mauko.co.ke/dl/extensions/".$_GET['install'].".zip" );

} elseif ( isset( $_GET['activate'] ) ) {
	function activateX( $x) {

    mysqli_query( $GLOBALS['conn'], "UPDATE hextensions SET h_status='active' WHERE h_code='".$x."'" );
	}

  activateX( $_GET['activate'] );

} elseif ( isset( $_GET['view'] ) ) {
	function getX() {
		# code...
	}
} else { ?>
<title>Extensions [ JABALI ]</title>
	<div class="mdl-grid">
  <div class="mdl-cell mdl-cell--8-col mdl-card mdl-shadow--2dp  mdl-color--<?php primaryColor(); ?>">

  <div class="mdl-card__supporting-text">
    <table class="mdl-data-table mdl-js-data-table">
    <tbody>
      <tr>
      <td class="mdl-data-table__cell--non-numeric">Extension Name</td>
      <td class="mdl-data-table__cell--non-numeric">
        <div class="switch">
          <label>
            Inactive
            <input id="ext" type="checkbox">
            <span class="lever"></span>
            Active
          </label>
        </div>
      </td>
      <td class="mdl-data-table__cell"><a href="#" class="material-icons">public</a></td>
      </tr>
    </tbody>
    </table>
  </div>
  </div>
  <div class="mdl-cell mdl-cell--4-col mdl-card mdl-shadow--2dp  mdl-color--<?php primaryColor(); ?>">
    <div class="mdl-card__title">
    <i class="material-icons">help</i>
      <span class="mdl-button">Tips on Extending Jabali</span>
    </div>
    <div class="mdl-card__supporting-text mdl-card--expand">
     <ul class="collapsible popout" data-collapsible="accordion">
        <li>
        <div class="collapsible-header"><i class="material-icons">help</i>Installing Extension</div>
        <div class="collapsible-body">
          <span>Download</span>
        </div>
        </li>
        <li>
        <div class="collapsible-header"><i class="material-icons">help</i>Activating Extension</div>
        <div class="collapsible-body">
          <span>Download</span>
        </div>
        </li>
        <li>
        <div class="collapsible-header"><i class="material-icons">help</i>Deactivating Extension</div>
        <div class="collapsible-body">
          <span>Download</span>
        </div>
        </li>
        <li>
        <div class="collapsible-header"><i class="material-icons">help</i>UnInstalling Extension</div>
        <div class="collapsible-body">
          <span>Download</span>
        </div>
        </li>
        <li>
        <div class="collapsible-header"><i class="material-icons">delete</i>Deleting Extension</div>
        <div class="collapsible-body">
          <span>Download</span>
        </div>
        </li>
      </ul>
    </div>
  </div> 
</div><?php 
}

include './footer.php'; ?>