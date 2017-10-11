<?php  
session_start();
require_once( '../init.php' );
require_once( 'header.php' ); ?>

<title><?php if ( isset( $_GET['sort'] ) ) { _show_( ' Viewing ' . ucfirst( $_GET['sort']. ' [ ' ) ); } else {
_show_( 'All Media [ ' ); } showOption( 'name' ); ?> ]</title>
<div class="mdl-grid "><br>
<div class="mdl-cell mdl-cell--12-col mdl-grid mdl-color--<?php primaryColor(); ?>" >
	<div class="mdl-cell mdl-cell--3-col" >
		<form>
		  	<div class="input-field mdl-js-textfield getmdl-select">
			    <i class="material-icons prefix">sort</i>
			     <input class="mdl-textfield__input" id="ilk" name="ilk" type="text" readonly tabIndex="-1" placeholder="<?php if ( isset( $_GET['sort'] ) ) { _show_( 'Sort By ' . ucfirst( $_GET['sort'] ) ); } else { _show_( 'Click to Sort' ); } ?>" >
			   <ul class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-color--<?php primaryColor(); ?>" for="ilk">
			     <a href="?sort=images" class="mdl-menu__item mdl-list__item"><i class="material-icons mdl-list__item-icon">image</i><span style="padding-left: 20px">Images</span></a>
			     <a href="?sort=video" class="mdl-menu__item mdl-list__item"><i class="material-icons mdl-list__item-icon">send</i><span style="padding-left: 20px">Video</span></a>
			     <a href="?sort=files" class="mdl-menu__item mdl-list__item"><i class="material-icons mdl-list__item-icon">attach_file</i><span style="padding-left: 20px">Files</span></a>
			   </ul>
			</div>
		</form>
	</div>
	<div class="mdl-cell mdl-cell--8-col mdl-color--<?php primaryColor(); ?>" >
		<form>
		  <div class="input-field">
		  <input type="text" placeholder="Type Media Name To Search">
		  </div>
	</div>
	<div class="mdl-cell mdl-cell--1-col mdl-color--<?php primaryColor(); ?>" >
		<button type="submit" name="search" class="mdl-button mdl-button--fab alignright"><i class="material-icons ">search</i></button>
		</form>
	</div>
	<div class="mdl-cell mdl-cell--12-col mdl-grid  mdl-card mdl-shadow--2dp mdl-color--<?php primaryColor(); ?>">
		<div class="mdl-cell mdl-cell--3-col mdl-card mdl-shadow--2dp">
		<img src="<?php _show_( _IMAGES . '404.jpg'); ?>" width="100%" >

      <div class="mdl-card__supporting-text"><center><strong>Image Name</strong></center></div>
			<div class="mdl-card__menu">
	          <a href="?x=banda&edit=<?php echo $product_deets[0]["id"]; ?>&key=product" class="mdl-button mdl-js-ripple-effect mdl-button--icon mdl-color-text--<?php secondaryColor(); ?>"><i class="material-icons">open_in_new</i></a>
	          <a href="?x=banda&edit=<?php echo $product_deets[0]["id"]; ?>&key=product" class="mdl-button mdl-js-ripple-effect mdl-button--icon"><i class="material-icons mdl-color-text--<?php secondaryColor(); ?>">delete</i></a>
	        </div>
        </div>

		<div class="mdl-cell mdl-cell--3-col mdl-card mdl-shadow--2dp"><img src="<?php _show_( _IMAGES . '404.jpg'); ?>" width="100%" ></div>
		<div class="mdl-cell mdl-cell--3-col mdl-card mdl-shadow--2dp"><img src="<?php _show_( _IMAGES . '404.jpg'); ?>" width="100%" ></div>
		<div class="mdl-cell mdl-cell--3-col mdl-card mdl-shadow--2dp"><img src="<?php _show_( _IMAGES . '404.jpg'); ?>" width="100%" ></div>		
		<div class="mdl-cell mdl-cell--3-col mdl-card mdl-shadow--2dp"><img src="<?php _show_( _IMAGES . '404.jpg'); ?>" width="100%" ></div>
		<div class="mdl-cell mdl-cell--3-col mdl-card mdl-shadow--2dp"><img src="<?php _show_( _IMAGES . '404.jpg'); ?>" width="100%" ></div>
		<div class="mdl-cell mdl-cell--3-col mdl-card mdl-shadow--2dp"><img src="<?php _show_( _IMAGES . '404.jpg'); ?>" width="100%" ></div>
	</div>
</div></div><?php

include './footer.php'; ?>