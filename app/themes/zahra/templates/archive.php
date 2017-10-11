<div class="mdl-grid"><?php 
	while ( $posts = $GLOBALS['JBLDB'] -> fetch ( $getPosts ) ){ ?>
		<div class="mdl-cell mdl-cell--4-col card">
			<div class="card-image waves-effect waves-block waves-light">
				<img class="activator" src="<?php _show_( $posts['avatar'] ); ?>">
			</div>

			<div class="card-content mdl-color-text--black">
				<a href="<?php _show_( $posts['link'] ); ?>"><span class="card-title grey-text text-darken-4"><?php _show_( $posts['name'] ); ?><i class="material-icons right">arrow_forward</i></span></a>
				<span class="mdl-list__item mdl-color-text--black"><i class="material-icons mdl-list__item-icon mdl-color-text--black">today</i><span style="padding-left: 20px"><?php $date = $posts['created'];
				$date = explode(" ", $date); _show_( $date[0] ); ?></span>
			</div>

			<div class="card-reveal mdl-color-text--black">
				<span class="card-title grey-text text-darken-4"><i class="material-icons left">perm_identity</i> <a href="<?php echo _ROOT; ?>/users/<?php _show_( $posts['author'] ); ?>"><?php _show_( $posts['author_name'] ); ?></a><i class="material-icons right">close</i></span><br>
				<p>
				<?php _show_( substr( $posts['details'], 0, 200 )."..." ); ?>
				</p> 
				<p><a class="mdl-button mdl-button--colored" href="<?php _show_( $posts['link'] ); ?>">read more</a></p>
				<p>Posted In: <a href="<?php echo _ROOT; ?>/categories/<?php _show_( $posts['categories'] ); ?>"><?php _show_( ucwords( $posts['categories'] ) ); ?></a></p>
				<p>Tagged: <a href="<?php echo _ROOT; ?>/tags/<?php _show_( $posts['tags'] ); ?>"><?php _show_( ucwords( $posts['tags'] ) ); ?></a></p>
			</div>
		</div><?php 
	} ?>
</div>