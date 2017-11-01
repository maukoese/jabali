
  <?php
  /**
  * @package Jabali 
  * @subpackage Hyfen
  * @author 
  * @link 
  * @since 0.1
  **/
  ?>
    <title><?php showOption( 'name' ); ?></title>
    <?php if( hasPosts() ): ?>
      <?php while( hasPosts() ): ?>
        <?php thePost(); ?>
        <h1><?php theTitle(); ?></h1>
        <p><?php theDate(); ?></p>
        <p><?php theCategories(); ?></p>
        <p><?php theTags(); ?></p>
        <article><?php theContent(); ?></article>
      <?php endwhile; ?>
    <?php endif; ?>