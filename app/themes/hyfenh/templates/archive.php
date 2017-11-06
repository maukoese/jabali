<?php
/**
* @package Jabali - The Plug-N-Play Framework
* @subpackage Hyfen
* @author 
* @link https://jabalicms.org/themes/hyfen
* @since 0.10
**/ ?>
<?php if( hasPosts() ): ?>
  <?php while( hasPosts() ): ?>
    <?php thePost(); ?>
    <h1><?php theTitle(); ?></h1>
    <?php theImage(); ?>
    <p><?php theDate(); ?></p>
    <p><?php theCategories(); ?></p>
    <p><?php theTags(); ?></p>
    <article><?php theContent(); ?></article>
  <?php endwhile; ?>
<?php endif; ?>