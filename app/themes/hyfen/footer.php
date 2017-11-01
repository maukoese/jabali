
  <?php
  /**
  * @package Jabali 
  * @subpackage Hyfen
  * @author 
  * @link 
  * @since 0.1
  **/
  ?>
    <footer>
      <?php if ( isLocalhost() ) :
        loadScript( 'js/jquery.min.js', 'hyfen');
      else:
        loadScript( 'https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js');
      endif; ?>
    </footer>
  <body>
</html>