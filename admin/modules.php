<?php
/**
* @package Jabali Framework
* @subpackage Extension Modules
* @link https://docs.jabalicms.org/extend/
* @author Mauko Maunde
* @since 0.17.09
**/
session_start();
require_once( '../init.php' );
require_once( 'header.php' );

if ( isset( $_POST['save']) && !empty( $_POST['ext'] ) ) {
    $activex = json_encode( $_POST['ext'] );
    $hOption = new Jabali\Classes\Options();
    $hOption -> update( 'modules', $activex, date('Y-m-d H:i:s') );
}

if ( isset( $_GET['install'] ) ) {
	function intallX( $name, $source) {
		$xZip = fopen( _ABSX_."temp/$name.zip", "w" );
    if ( $xZip) {
      file_put_contents( $xZip, fopen( $source, "r" ) );
    }

    $install = new ZipArchive();
    $xT = $install -> open( $xZip );
    if ( $xT === TRUE ) {
      $install -> extractTo( _ABSX_ );
      $install -> close();
    } else {
      echo "Error!";
    }
	}

  intallX( $_GET['install'], "http://jabalicms.org/dl/extensions/".$_GET['install'].".zip" );

} elseif ( isset( $_GET['activate'] ) ) {
	function activateX( $x) {

    $GLOBALS['JBLDB'] -> query( "UPDATE hextensions SET state='active' WHERE id='".$x."'" );
	}

  activateX( $_GET['activate'] );

} elseif ( isset( $_GET['view'] ) ) {
	?>
<title>Extension: <?php echo $_GET['key']; ?> - <?php showOption( 'name' ); ?></title>
  <div class="mdl-grid">
  <form method="POST" action="" class="mdl-grid mdl-cell mdl-cell--8-col mdl-shadow--2dp mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>"><?php
        $extension = $_GET['view'];
        $xJson = file_get_contents( _ABSX_.$extension."/".$extension.".json" );
        $xD = json_decode( $xJson, true ); ?>

        <div class="mdl-card__title mdl-card--expand">
          <h2 class="mdl-card__title-text"><?php echo $xD[ 'name' ] ; ?></h2>
        <div class="mdl-layout-spacer"></div>
        <div class="mdl-card__subtitle-text">
              <a id="<?php echo $xD[ 'slug' ] ; ?>help" href="<?php echo $xD[ 'support' ] ; ?>" class="material-icons">help</a>
              <div class="mdl-tooltip" for="<?php echo $xD[ 'slug' ] ; ?>help"><?php echo $xD[ 'name' ] ; ?> Help</div>
              <a href="<?php echo $xD[ 'website' ] ; ?>" class="material-icons">public</a>
        </div>
        </div>
        <div class="mdl-card__supporting-text">
          <?php echo $xD[ 'description' ] ; ?>
        </div>
        <div class="mdl-card__actions mdl-card--border">
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
        <div class="mdl-layout-spacer"></div>
              <a id = "<?php echo $xD[ 'slug' ] ; ?>author" href="#" class="material-icons alignright">perm_identity</a>
              <ul class="mdl-menu mdl-list mdl-js-menu mdl-js-ripple-effect mdl-menu--bottom-right mdl-color--<?php primaryColor(); ?>" for="<?php echo $xD[ 'slug' ] ; ?>author" style="overflow-y: auto;">
              <a href="<?php echo $xD[ 'social' ]['facebook'] ; ?>" class="mdl-list__item"><i class="mdi mdi-facebook mdl-list__item-icon"></i><span style="padding-left: 20px">Facebook</span></a>
              <a href="<?php echo $xD[ 'social' ]['twitter'] ; ?>" class="mdl-list__item"><i class="mdi mdi-twitter mdl-list__item-icon"></i><span style="padding-left: 20px">Twitter</span></a>
              <a href="<?php echo $xD[ 'social' ]['github'] ; ?>" class="mdl-list__item"><i class="mdi mdi-github-circle mdl-list__item-icon"></i><span style="padding-left: 20px">Github</span></a>
              <a href="mailto:<?php echo $xD[ 'social' ][ 'email' ] ; ?>" class="mdl-list__item"><i class="mdi mdi-email mdl-list__item-icon"></i><span style="padding-left: 20px"><?php echo $xD[ 'social' ][ 'email' ] ; ?></span></a>
              </ul>
              <div class="mdl-tooltip" for="<?php echo $xD[ 'slug' ] ; ?>author">Author: <?php echo $xD[ 'author' ] ; ?></div>
        </div>
      <button type="submit" name="save" class="mdl-button mdl-button--fab addfab mdl-button--colored right"><i class="material-icons">save</i></button>
    </form>

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
} else { ?>
<title>Extensions [ JABALI ]</title>
  <form method="POST" action="" class="mdl-grid"><?php
      $path = _ABSX_;
      $dir = new DirectoryIterator($path);
      foreach ($dir as $fileinfo) {
          if ($fileinfo->isDir() && !$fileinfo->isDot()) {
              $extension = $fileinfo->getFilename();
              $xJson = file_get_contents( _ABSX_.$extension."/".$extension.".json" );
              $xD = json_decode( $xJson, true ); ?>
            <div class="mdl-cell mdl-cell--3-col mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>">
              <div class="mdl-card__title mdl-card--expand">
                <h2 class="mdl-card__title-text"><?php echo $xD[ 'name' ] ; ?></h2>
              <div class="mdl-layout-spacer"></div>
              <div class="mdl-card__subtitle-text">
                    <a id="<?php echo $xD[ 'slug' ] ; ?>help" href="<?php echo $xD[ 'support' ] ; ?>" class="material-icons">help</a>
                    <div class="mdl-tooltip" for="<?php echo $xD[ 'slug' ] ; ?>help"><?php echo $xD[ 'name' ] ; ?> Help</div>
                    <a href="<?php echo $xD[ 'website' ] ; ?>" class="material-icons">public</a>
              </div>
              </div>
              <div class="mdl-card__supporting-text">
                <?php echo $xD[ 'description' ] ; ?>
              </div>
              <div class="mdl-card__actions mdl-card--border">
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
              <div class="mdl-layout-spacer"></div>
                    <a id = "" href="?view=<?php echo $xD[ 'slug' ] ; ?>&key=<?php echo $xD[ 'name' ] ; ?>" class="material-icons alignright">open_in_new</a>
                    <a id = "<?php echo $xD[ 'slug' ] ; ?>author" href="#" class="material-icons alignright">perm_identity</a>
                    <ul class="mdl-menu mdl-list mdl-js-menu mdl-js-ripple-effect mdl-menu--bottom-right mdl-color--<?php primaryColor(); ?>" for="<?php echo $xD[ 'slug' ] ; ?>author" style="overflow-y: auto;">
                    <a href="<?php echo $xD[ 'social' ]['facebook'] ; ?>" class="mdl-list__item"><i class="mdi mdi-facebook mdl-list__item-icon"></i><span style="padding-left: 20px">Facebook</span></a>
                    <a href="<?php echo $xD[ 'social' ]['twitter'] ; ?>" class="mdl-list__item"><i class="mdi mdi-twitter mdl-list__item-icon"></i><span style="padding-left: 20px">Twitter</span></a>
                    <a href="<?php echo $xD[ 'social' ]['github'] ; ?>" class="mdl-list__item"><i class="mdi mdi-github-circle mdl-list__item-icon"></i><span style="padding-left: 20px">Github</span></a>
                    <a href="mailto:<?php echo $xD[ 'social' ][ 'email' ] ; ?>" class="mdl-list__item"><i class="mdi mdi-email mdl-list__item-icon"></i><span style="padding-left: 20px"><?php echo $xD[ 'social' ][ 'email' ] ; ?></span></a>
                    </ul>
                    <div class="mdl-tooltip" for="<?php echo $xD[ 'slug' ] ; ?>author">Author: <?php echo $xD[ 'author' ] ; ?></div>
              </div>
            </div><?php
          }
      } csrf(); ?>
      <button type="submit" name="save" class="mdl-button mdl-button--fab addfab mdl-button--colored right"><i class="material-icons">save</i></button>
    </form><?php 
}

include './footer.php'; ?>