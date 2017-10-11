<div class="mdl-grid"><?php
		$post = (object)$post; ?>
		<title><?php _show_( $post -> name ); ?> [ <?php showOption( 'name' ); ?> ]</title>
	      	<div class="mmm-ribbon mdl-color--<?php if ( isset( $_SESSION[JBLSALT.'Code'] ) ){ primaryColor(); } else { echo "madge"; } ?>" style="background: url( <?php _show_( $post -> avatar ); ?> ); background-repeat:no-repeat; background-size: cover; background-position: center;">
				<center><h1><b><?php _show_( $post -> name ); ?></b></h1>
				</center>
			</div>
	      
	        <div class="demo-container">
	          	<div class="demo-content mdl-color--white content mdl-color-text--black mdl-grid">
		            <article class="mdl-color-text--black" style="padding: 2%;">
		            	<?php _show_( $post -> details); ?>
		            </article>
		        </div>
	      </div>
</div>