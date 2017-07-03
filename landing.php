<?php 
/**
* @package Jabali Framework
* @subpackage Home
* @link https://docs.mauko.co.ke/jabali/home
* @author Mauko Maunde
* @version 0.17.06
**/

include 'sheader.php'; ?>
<title>Shop [ <?php showOption( 'name' ); ?> ]</title>
<div class="mdl-grid">
	<div class="mdl-cell mdl-cell--2-col" style="background: url( <?php _show_( hIMAGES.'tag.png' ); ?> ); background-repeat:repeat; background-size: initial;background-blend-mode: lighten;"></div>
	<div class="input-field mdl-cell mdl-cell--8-col">
        <button class="mdl-button mdl-color--grey-400" id="categories">CATEGORIES <i class="material-icons">keyboard_arrow_down</i></button>
        <ul class="mdl-menu mdl-js-menu mdl-js-ripple-effect mdl-menu--bottom-right option-drop mdl-color--<?php primaryColor(); ?>" for="categories">
        	<a class="mdl-list__item" href="?product_category=men">Men</a>
        	<a class="mdl-list__item" href="?product_category=women">Women</a>
        	<a class="mdl-list__item" href="?product_category=children">Children</a>
        </ul>

        <button class="mdl-button mdl-color--grey-400" id="categories">PRODUCTS <i class="material-icons">keyboard_arrow_down</i></button>
        <ul class="mdl-menu mdl-js-menu mdl-js-ripple-effect mdl-menu--bottom-right option-drop mdl-color--<?php primaryColor(); ?>" for="categories">
        	<a class="mdl-list__item" href="?product_category=men">Men</a>
        	<a class="mdl-list__item" href="?product_category=women">Women</a>
        	<a class="mdl-list__item" href="?product_category=children">Children</a>
        </ul>

        <button class="mdl-button mdl-color--grey-400" id="categories">BRANDS <i class="material-icons">keyboard_arrow_down</i></button>
        <ul class="mdl-menu mdl-js-menu mdl-js-ripple-effect mdl-menu--bottom-right option-drop mdl-color--<?php primaryColor(); ?>" for="categories">
        	<a class="mdl-list__item" href="?product_category=men">Men</a>
        	<a class="mdl-list__item" href="?product_category=women">Women</a>
        	<a class="mdl-list__item" href="?product_category=children">Children</a>
        </ul>

        <button class="mdl-button mdl-color--grey-400" id="categories">PRICE <i class="material-icons">keyboard_arrow_down</i></button>
        <ul class="mdl-menu mdl-js-menu mdl-js-ripple-effect mdl-menu--bottom-right option-drop mdl-color--<?php primaryColor(); ?>" for="categories">
        	<a class="mdl-list__item" href="?product_category=men">Men</a>
        	<a class="mdl-list__item" href="?product_category=women">Women</a>
        	<a class="mdl-list__item" href="?product_category=children">Children</a>
        </ul>

        <button class="mdl-button mdl-color--grey-400 alignright" id="categories"><i class="material-icons">search</i> Search Item</button>

	</div>
	<div class="mdl-cell mdl-cell--2-col" style="background: url( <?php _show_( hIMAGES.'tag.png' ); ?> ); background-repeat:repeat; background-size: initial;background-blend-mode: lighten;"></div>

	<div class=" mdl-color--pink" style="background: url( <?php _show_( hIMAGES.'avatar.svg' ); ?> ); background-repeat:no-repeat; background-size: cover;background-blend-mode: lighten;">
		<style type="text/css">
		@keyframes slidy {
			0% { left: 0%; }
			20% { left: 0%; }
			25% { left: -100%; }
			45% { left: -100%; }
			50% { left: -200%; }
			70% { left: -200%; }
			75% { left: -300%; }
			95% { left: -300%; }
			100% { left: -400%; }
			}

			body { margin: 0; } 
			div#slider { 
				overflow: hidden;
				min-height: 250px;
				max-height: 300px; }
			div#slider figure img { width: 20%; float: left; }
			div#slider figure { 
			  position: relative;
			  width: 500%;
			  margin: 0;
			  left: 0;
			  text-align: left;
			  font-size: 0;
			  animation: 30s slidy infinite; 
			}
			table
    {
    border-collapse:separate;
    border-spacing:10px 0px;
    }
		</style>
		<div id="slider">
		<figure>
		<img src="http://localhost/jabali/inc/assets/images/logo-w.png" alt>
		<img src="http://localhost/jabali/inc/assets/images/marker.png" alt>
		<img src="http://localhost/jabali/inc/assets/images/logo.png" alt>
		</figure>
		</div>
	</div>
	<div class="mdl-cell mdl-cell--2-col" style="background: url( <?php _show_( hIMAGES.'tag.png' ); ?> ); background-repeat:repeat; background-size: initial;background-blend-mode: lighten;"></div>
	<div class="mdl-cell mdl-cell--8-col">
		<table class="mdl-data-table" style="border-collapse:separate;border-spacing:0px 10px;">
  <thead>
  </thead>
  <tbody>
    <tr class="mdl-shadow--2dp mdl-color--grey-100 mdl-color-text--black">
      <td class="mdl-data-table__cell--non-numeric"><img src="<?php _show_( hIMAGES.'marker.png' ); ?>" width="150px;" ></td>
      <td class="mdl-data-table__cell--non-numeric"><h6><b>Product Name</b></h6>Category<br>
      <div style="display: inline-table;">
      	<a href=""><img style="border-radius: 100%;" src="<?php _show_( hIMAGES.'marker.png' ); ?>" width="50px;"><span> <b>Author</b> Location</span></a>
      </div>
      
      </td>
      <td><b>KSh 49021</b><br>
      <a class="mdl-button mdl-color--pink alignleft" href="#">VIEW <i class="material-icons">visibility</i></a>
      <a class="mdl-button mdl-color--pink alignright" href="#">ADD <i class="material-icons">add_shopping_cart</i></a></td>
    </tr>
    <tr class="mdl-shadow--2dp mdl-color--grey-100 mdl-color-text--black">
      <td class="mdl-data-table__cell--non-numeric"><img src="<?php _show_( hIMAGES.'marker.png' ); ?>" width="150px;" ></td>
      <td class="mdl-data-table__cell--non-numeric"><h6><b>Product Name</b></h6>Category<br>
      <div style="display: inline-table;">
      	<a href=""><img style="border-radius: 100%;" src="<?php _show_( hIMAGES.'marker.png' ); ?>" width="50px;"><span> <b>Author</b> Location</span></a>
      </div>
      
      </td>
      <td><b>KSh 49021</b><br>
      <a class="mdl-button mdl-color--pink alignleft" href="#">VIEW <i class="material-icons">visibility</i></a>
      <a class="mdl-button mdl-color--pink alignright" href="#">ADD <i class="material-icons">add_shopping_cart</i></a></td>
    </tr>
    <tr class="mdl-shadow--2dp mdl-color--grey-100 mdl-color-text--black">
      <td class="mdl-data-table__cell--non-numeric"><img src="<?php _show_( hIMAGES.'marker.png' ); ?>" width="150px;" ></td>
      <td class="mdl-data-table__cell--non-numeric"><h6><b>Product Name</b></h6>Category<br>
      <div style="display: inline-table;">
      	<a href=""><img style="border-radius: 100%;" src="<?php _show_( hIMAGES.'marker.png' ); ?>" width="50px;"><span> <b>Author</b> Location</span></a>
      </div>
      
      </td>
      <td><b>KSh 49021</b><br>
      <a class="mdl-button mdl-color--pink alignleft" href="#">VIEW <i class="material-icons">visibility</i></a>
      <a class="mdl-button mdl-color--pink alignright" href="#">ADD <i class="material-icons">add_shopping_cart</i></a></td>
    </tr>
  </tbody>
</table>
	</div>
	<div class="mdl-cell mdl-cell--2-col" style="background: url( <?php _show_( hIMAGES.'tag.png' ); ?> ); background-repeat:repeat; background-size: initial;background-blend-mode: lighten;"></div>
</div><?php
include 'footer.php'; ?>