<?php 

/**
* @package Jabali 
* @subpackage Skeleton
* @author Mauko Maunde
* @link https://jabalicms.org/themes/skeleton
* @since 0.1
**/

?>

    <main>

      <?php foreach ($posts as $post ) : ?>

        <title><?php echo( $post -> name ); ?></title>

        <?php echo( $post -> name );

        //echo( $post -> details ); ?>

      <?php endforeach; ?>

    </main>