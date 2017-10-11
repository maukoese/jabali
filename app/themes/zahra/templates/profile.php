<div class="mdl-grid"><?php
	$user = (array)$user; ?>
		<title><?php _show_( $user['name'] ); ?> [ <?php showOption( 'name' ); ?> ]</title>
		<div class="mdl-cell mdl-cell--5-col card">
			<div class="card-image waves-effect waves-block waves-light">
				<img class="activator" src="<?php _show_( $user['avatar'] ); ?>">
			</div>

			<div class="card-reveal mdl-color-text--black">
				<div class="mdl-grid">
					<div class="mdl-cell mdl-cell--5-col waves-effect waves-block waves-light">
						<img class="activator" src="<?php _show_( $user['avatar'] ); ?>">
					</div>
					<div class="mdl-cell mdl-cell--5-col waves-effect waves-block waves-light">
						<img class="activator" src="<?php _show_( $user['avatar'] ); ?>">
					</div>
				</div>
			</div>
		</div>

		<div class="mdl-cell mdl-cell--6-col mdl-color-text--black" >
		<h3><?php _show_( $user['name'] ); ?><i class="mdi mdi-<?php 
            if ( strtolower( $user['ilk'] ) == "organization" ) { 
                echo "city";
            } else {
                if ( strtolower( $user['gender'] ) == "male" ) {
                  echo "gender-male";
                } elseif ( strtolower( $user['gender'] ) == "female" ) {
                  echo "gender-female";
                } elseif ( $user['gender'] == 'other' || $user['gender'] == "" ) {
                  echo "transgender";
                }
            } ?> mdl-button-icon mdl-badge mdl-badge--overlap alignright">
              </i></h3>
			<article>
				<?php _show_( $user['details'] ); ?>
			</article><?php
          $social = json_decode( $user['social'] ); 
          foreach ($social as $key => $value) { ?>
          <div style="display: inline;">
          <a href="<?php _show_( $value ); ?>" type="text" value="<?php _show_( $value ); ?>">
          <i class="fa fa-<?php _show_( $key ); ?> fa-2x"></i></a>
          </div><?php } ?>
          <span class="right">
          	<a href="tel:<?php _show_( $user['phone'] ); ?>"><i class="fa fa-phone fa-2x"></i></a>
          	<a href="mailto:<?php _show_( $user['email'] ); ?>"><i class="fa fa-envelope fa-2x"></i></a>
          </span>
		</div>
</div>