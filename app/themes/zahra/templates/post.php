<div class="mdl-grid"><?php
		$post = (object)$post; ?>
		<title><?php _show_( $post -> name ); ?> [ <?php showOption( 'name' ); ?> ]</title>
	      	<div class="mmm-ribbon mdl-color--<?php if ( isset( $_SESSION[JBLSALT.'Code'] ) ){ primaryColor(); } else { echo "madge"; } ?>" style="background: url( <?php _show_( $post -> avatar ); ?> ); background-repeat:no-repeat; background-size: cover; background-position: center;">
				<center><h1><b><?php _show_( $post -> name ); ?></b></h1>
				<span>
					<h5>
						Published by <b><a href="<?php _show_( _ROOT.'/users/'.$post -> author ); ?>"><?php 
						_show_( $post -> author_name ); ?></a></b> on <b><?php $date = $post -> created;
						_show_( date("F d, Y h:i:s A", strtotime( $date ) ) ); ?></b>
					</h5>
					<h6>
						Posted In: <b><a href="<?php _show_( _ROOT.'/categories/'.$post -> categories ); ?>"><?php 
						_show_( $post -> categories ); ?></a></b>
					</h6>
					<h6>
						Tagged: <b><a href="<?php _show_( _ROOT.'/tags/'.$post -> tags ); ?>"><?php 
						_show_( $post -> tags ); ?></a></b>
					</h6>
				</span>
				</center>
			</div>
	      
	        <div class="demo-container">
	          	<div class="demo-content mdl-color--white content mdl-color-text--black mdl-grid">
		            <article class="mdl-color-text--black" style="padding: 2%;">
		            	<?php _show_( $post -> details); ?>
		            </article>
		            <?php global $hForm; 
		            $hForm -> commentForm(); ?>
		        </div>
	      </div>
	<?php
		global $hSocial; 
		$hSocial -> bottomShare( $post -> id ); ?>
</div>