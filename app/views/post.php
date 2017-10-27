<div class="mdl-grid"><?php 
	while ( $postsDetails = mysqli_fetch_assoc( $getPosts)){  ?>
		<title><?php echo( $postsDetails['name']); ?> - <?php showOption( 'name' ); ?></title>
	      	<div class="mmm-ribbon mdl-color--<?php if ( isset( $_SESSION[JBLSALT.'Code'] ) ){ primaryColor(); } else { echo "madge"; } ?>" style="background: url( <?php echo( $postsDetails['avatar']); ?> ); background-repeat:no-repeat; background-size: cover; background-position: center;">
				<center><h1><b><?php echo( $postsDetails['name']); ?></b></h1>
				<span>
					<h6>
						Published by <b><a href="<?php echo( _ROOT.'users/'.$postsDetails['author']); ?>"><?php 
						echo( $postsDetails['author_name']); ?></a></b> on <b><?php $date = $postsDetails['created'];
						echo( date("F d, Y h:i:s A", strtotime( $date ) ) ); ?></b>
					</h6>
				</span>
				</center>
			</div>
	      
	        <div class="demo-container">
	          	<div class="demo-content mdl-color--white content mdl-color-text--black mdl-grid">
		            <article class="mdl-color-text--black">
		            	<?php echo( $postsDetails['details']); ?>
		            </article>
		            <?php global $hForm; 
		            $hForm -> commentForm(); ?>
		        </div>
	      </div>
	<?php } ?>
</div>