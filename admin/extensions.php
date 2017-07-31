<?php 
include '../inc/config.php'; 
include '../inc/jabali.php';
include './header.php';

if ( isset( $_POST['save']) && !empty( $_POST['ext'] ) ) {
  foreach ($_POST['ext'] as $ext) {

    $activex = array();
    $activex[] = $ext;
    $activex = json_encode( $activex );
    $hOption = new _hOptions();
    $hOption -> update( 'extensions', $activex, date('Y-m-d H:i:s') );
    
  }
}

if ( isset( $_GET['install'] ) ) {
	function intallX( $name, $source) {
		$xZip = fopen( hABSX."temp/$name.zip", "w" );
    if ( $xZip) {
      file_put_contents( $xZip, fopen( $source, "r" ) );
    }

    $install = new ZipArchive();
    $xT = $install -> open( $xZip );
    if ( $xT === TRUE ) {
      $install -> extractTo( hABSX );
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
  <form method="POST" action="">
    <table class="mdl-data-table mdl-js-data-table">
    <thead>
      <th class="mdl-data-table__cell--non-numeric">Extension</th>
      <th class="mdl-data-table__cell--non-numeric">Status</th>
      <th class="mdl-data-table__cell">Links</th>
    </thead>
    <tbody><?php
    $path = hABSX;
    $dir = new DirectoryIterator($path);
    foreach ($dir as $fileinfo) {
        if ($fileinfo->isDir() && !$fileinfo->isDot()) {
            $extension = $fileinfo->getFilename();
            $xJson = file_get_contents( hABSX.$extension."/".$extension.".json" );
            $xD = json_decode( $xJson, true ); ?>
      <tr>
      <td class="mdl-data-table__cell--non-numeric"><?php echo $xD[ 'name' ] ; ?></td>
      <td class="mdl-data-table__cell--non-numeric">
        <div class="switch">
          <label>
            Inactive
            <input id="<?php echo $xD[ 'slug' ] ; ?>" name="ext[]" value="<?php echo $xD[ 'slug' ] ; ?>" type="checkbox" <?php if ( isActiveX( $xD[ 'slug' ] ) ) {
              echo "checked";
            } ?> >
            <span class="lever"></span>
            Active
          </label>
        </div>
      </td>
      <td class="mdl-data-table__cell">
        <a id = "<?php echo $xD[ 'slug' ] ; ?>author" href="#" class="material-icons">perm_identity</a>
        <ul class="mdl-menu mdl-list mdl-js-menu mdl-js-ripple-effect mdl-menu--bottom-right mdl-color--<?php primaryColor(); ?>" for="<?php echo $xD[ 'slug' ] ; ?>author" style="overflow-y: auto;">
        <a href="<?php echo $xD[ 'social' ]['facebook'] ; ?>" class="mdl-list__item"><i class="mdi mdi-facebook mdl-list__item-icon"></i><span style="padding-left: 20px">Facebook</span></a>
        <a href="<?php echo $xD[ 'social' ]['twitter'] ; ?>" class="mdl-list__item"><i class="mdi mdi-twitter mdl-list__item-icon"></i><span style="padding-left: 20px">Twitter</span></a>
        <a href="<?php echo $xD[ 'social' ]['github'] ; ?>" class="mdl-list__item"><i class="mdi mdi-github-circle mdl-list__item-icon"></i><span style="padding-left: 20px">Github</span></a>
        <a href="mailto:<?php echo $xD[ 'social' ][ 'email' ] ; ?>" class="mdl-list__item"><i class="mdi mdi-email mdl-list__item-icon"></i><span style="padding-left: 20px"><?php echo $xD[ 'social' ][ 'email' ] ; ?></span></a>
        </ul>
        <div class="mdl-tooltip" for="<?php echo $xD[ 'slug' ] ; ?>author">Author: <?php echo $xD[ 'author' ] ; ?></div>
        <a id="<?php echo $xD[ 'slug' ] ; ?>help" href="<?php echo $xD[ 'support' ] ; ?>" class="material-icons">help</a>
        <div class="mdl-tooltip" for="<?php echo $xD[ 'slug' ] ; ?>help"><?php echo $xD[ 'name' ] ; ?> Help</div>
        <a href="<?php echo $xD[ 'website' ] ; ?>" class="material-icons">public</a>
      </td>
      </tr><?php
        }
    } ?>
    </tbody>
    </table>
    <button type="submit" name="save" class="mdl-button mdl-button--fab addfab mdl-button--colored right"><i class="material-icons">save</i></button>
    </form>
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