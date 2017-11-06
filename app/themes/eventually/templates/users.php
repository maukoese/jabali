<?php
  /**
  * @package Jabali 
  * @subpackage Eventually
  * @author Mauko Maunde
  * @link https://jabalicms.org/themes/eventually
  * @since 0.1
  **/ ?>
    <?php if( hasPosts() ): ?>
      <?php while( hasPosts() ): ?>
        <?php thePost(); ?>
        <title><?php theTitle(); ?> - <?php showOption( 'name' ); ?></title>
        <h1><?php theTitle(); ?></h1>
        <?php theImage(); ?>
        <p><?php theDate(); ?></p>
        <p><?php theCategories(); ?></p>
        <article><?php theContent(); ?></article>
      <?php endwhile; ?>
    <?php endif; ?>