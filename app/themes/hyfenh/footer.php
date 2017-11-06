<?php
/**
* @package Jabali - The Plug-N-Play Framework
* @subpackage Hyfen
* @author 
* @link https://jabalicms.org/themes/hyfen
* @since 0.10
**/ ?>
    <footer>
      <?php showOption( 'copyright' ); ?> - <a class="" href="<?php showOption( 'attribution_link' ); ?>"><?php showOption( 'attribution' ); ?></a>
    </footer>
    <?php 
    if ( isLocalhost() ):
      loadScript( 'js/jquery.min.js', 'hyfenh');
    else:
      loadScript( 'https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js');
    endif;
    loadScript( 'js/hyfenh.js', 'hyfenh'); ?>
  <body>
</html>