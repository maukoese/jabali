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

	<div class="mdl-cell mdl-cell--2-col" style="background: url( <?php _show_( hIMAGES.'tag.png' ); ?> ); background-repeat:repeat; background-size: initial;background-blend-mode: lighten;"></div>
	<div class="mdl-cell mdl-cell--8-col mdl-grid">
	<div class="mdl-cell mdl-cell--5-col mdl-card">
		<img src="<?php _show_( hIMAGES.'marker.png' ); ?>" width="100%;" >
		<div class="mdl-card__supporting_text">
			<img src="<?php _show_( hIMAGES.'marker.png' ); ?>" width="22%;" >
			<img src="<?php _show_( hIMAGES.'marker.png' ); ?>" width="22%;" >
			<img src="<?php _show_( hIMAGES.'marker.png' ); ?>" width="22%;" >
			<img src="<?php _show_( hIMAGES.'marker.png' ); ?>" width="22%;" >
		</div>
		<div class="mdl-card__menu">
			<a class="material-icons mdl-button--icon" href="#">share</a>
		</div>
      </div>
	<div class="mdl-cell mdl-cell--7-col">
		
      <h4><b>Product Name</b></h4>
      <h6>Category</h6>
      <a class="waves-effect waves-light btn-large mdl-color--pink"><i class="material-icons right">add_shopping_cart</i>BUY NOW</a>

      <h6>KSh 10000<span class="alignright"><i class="material-icons">star</i><i class="material-icons">star</i><i class="material-icons">star</i><i class="material-icons">star</i></span></h6>
      <form action="#">
    <p>
      <input type="checkbox" id="test5" />
      <label for="test5">Delivery</label>
    </p>
    <p>
      <input type="checkbox" id="test5" />
      <label for="test5">Pickup</label>
    </p>

    <p>
    <input class="with-gap" name="group3" type="radio" id="test5" checked />
    <label for="test5"><i class="fa fa-paypal"></i></label>
  </p>
    </form><br>
      <a class="waves-effect waves-light btn-large mdl-color--grey-400"><i class="material-icons right">mail</i>CONTACT SELLER</a>
	</div>
	</div>
	<div class="mdl-cell mdl-cell--2-col" style="background: url( <?php _show_( hIMAGES.'tag.png' ); ?> ); background-repeat:repeat; background-size: initial;background-blend-mode: lighten;"></div>
</div><?php
include 'footer.php'; ?>