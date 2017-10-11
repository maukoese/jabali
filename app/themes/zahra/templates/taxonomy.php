<div class="mdl-grid"><?php 
	while ( $postsDetails = mysqli_fetch_assoc( $getPosts)){ ?>
		<div class="mdl-cell mdl-cell--3-col card">
			<div class="card-image waves-effect waves-block waves-light">
				<img class="activator" src="<?php _show_( $postsDetails['avatar'] ); ?>">
			</div>

			<div class="card-content mdl-color-text--black">
				<a href="<?php _show_( $postsDetails['link'] ); ?>"><span class="card-title grey-text text-darken-4"><?php _show_( $postsDetails['name'] ); ?><i class="material-icons right">arrow_forward</i></span></a>
				<span class="mdl-list__item mdl-color-text--black"><i class="material-icons mdl-list__item-icon mdl-color-text--black">today</i><span style="padding-left: 20px"><?php $date = $postsDetails['created'];
				$date = explode(" ", $date); _show_( $date[0] ); ?></span>
			</div>

			<div class="card-reveal mdl-color-text--black">
				<span class="card-title grey-text text-darken-4"><i class="material-icons left">perm_identity</i> <a href="./user/<?php _show_( $postsDetails['author'] ); ?>"><?php _show_( $postsDetails['author_name'] ); ?></a><i class="material-icons right">close</i></span><br>
				<article>
				<?php _show_( substr( $postsDetails['details'], 0, 240 ) ); 
				?> ...

				</article> 
				<a class="mdl-button mdl-button--colored" href="<?php _show_( $postsDetails['link'] ); ?>">read more</a><br>
				<p>Posted In: <a href="<?php echo _ROOT; ?>/categories/<?php _show_( $postsDetails['categories'] ); ?>"><?php _show_( ucwords( $postsDetails['category'] ) ); ?></a></p>
				<p>Tagged: <a href="<?php echo _ROOT; ?>/tags/<?php _show_( $postsDetails['tags'] ); ?>"><?php _show_( ucwords( $postsDetails['tags'] ) ); ?></a></p>
			</div>
		</div><?php 
	} ?>
</div>