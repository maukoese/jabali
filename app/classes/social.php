<?php 
/**
* Social Sharing & icons
*/

namespace Jabali\Classes;

class Social {

  function socShare( $type) {
    
  echo '<div class="card__share">
          <div class="card__social">  
              <a class="share-icon facebook" href=""><span class="fa fa-facebook"></span></a>

              <a class="share-icon twitter" href="http://twitter.com/share?url='._ROOT.'blog/&text='.$postsDetails['name'].'&via=@jfwork"><span class="fa fa-twitter"></span></a>

              <a class="share-icon googleplus" href="#"><span class="fa fa-google-plus"></span></a>

              <a class="share-icon whatsapp" href="whatsapp://send?text=<?php echo $post_title; ?>" data-action="share/whatsapp/share"><span class="fa fa-whatsapp"></span></a>

              <a class="share-icon email" href="mailto:sample@email.com" data-rel="external"><span class="fa fa-envelope"></span></a>
          </div>

          <a id="share" class="share-toggle share-icon mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored" href="#"><i class="material-icons">share</i></a>
        </div>';
  }

  function bottomshare( $code) { 
    $getPostCode = $GLOBALS['JBLDB'] -> query( "SELECT * FROM ". _DBPREFIX ."posts WHERE id = '".$code."'" );
    if ( $getPostCode -> num_rows > 0) {
      while ( $post = mysqli_fetch_assoc( $getPostCode)){ ?>
    <div class="fixed-action-btn horizontal">
      <a class="btn-floating btn-large mdl-color--<?php if ( isset( $_SESSION[JBLSALT.'Code'] ) ) { primaryColor(); } else { echo "grey"; } ?>">
        <i class="large material-icons">share</i>
      </a>
      <ul>
        <li class="waves-effect waves-light"><a href="./options?settings=social"><i class="mdl-color-text--light-blue mdi mdi-facebook fa-2x" role="presentation"></i></a></li>
        <li class="waves-effect waves-light"><a href="./options?settings=social"><i class="mdl-color-text--red fa fa-instagram fa-2x" role="presentation"></i></a></li>
        <li class="waves-effect waves-light"><a href="./options?settings=social"><i class="mdl-color-text--light-blue fa fa-twitter fa-2x" role="presentation"></i></a></li>
        <li class="waves-effect waves-light"><a href="./options?settings=social"><i class="mdl-color-text--red fa fa-envelope fa-2x" role="presentation"></i></a></li>
        <li class="waves-effect waves-light"><a href="sms://<?php _show_( $_SESSION[JBLSALT.'Phone'] ); ?>?body=<?php _show_( $post['name'].' '._ROOT ); ?><?php _show_( $post['link'] ); ?>"><i class="mdl-color-text--black mdi mdi-message fa-2x" role="presentation"></i></a></li>
        <li class="waves-effect waves-light"><a href="whatsapp://send?text=<?php _show_( $post['name'] ); _show_( _ROOT.$post['link'] ); ?>"><i class="mdl-color-text--green fa fa-whatsapp fa-2x" role="presentation"></i></a></li>
     </ul>
    </div><?php 
      }
    }
    
  }

  function bottomsocial( $facebook,$twitter, $github, $linkedin, $tel, $mail) { ?>
    <div class="fixed-action-btn horizontal click-to-toggle">
              <a class="btn-floating btn-large mdl-color--<?php if ( isset( $_SESSION[JBLSALT.'Code'] ) ) {
            secondaryColor();
        } else { echo "red";}  ?>">
                <i class="material-icons">public</i>
              </a>
              <ul>
                <li><a href="<?php _show_( $facebook ); ?>" class="btn-floating mdl-color--indigo"><i class="fa fa-facebook"></i></a></li>

                <li><a href="https://twitter.com/intent/tweet?url={url}&text={title}&via={via}&hashtags={hashtags}" class="btn-floating mdl-color--light-blue"><i class="fa fa-twitter"></i></a></li>

                <li><a href="<?php _show_( $github ); ?>" class="btn-floating mdl-color--purple"><i class="fa fa-github"></i></a></li>

                <li><a href="<?php _show_( $linkedin ); ?>" class="btn-floating mdl-color--blue"><i class="fa fa-linkedin"></i></a></li>

                <li><a href="tel:<?php _show_( $tel ); ?>" class="btn-floating mdl-color--green"><i class="fa fa-phone"></i></a></li>

                <li><a href="mailto:<?php _show_( $mail ); ?>" class="btn-floating mdl-color--grey"><i class="fa fa-envelope"></i></a></li>
              </ul>
            </div><?php 
  }
  
}
 ?>