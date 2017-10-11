<?php 

/**
* @package Jabali 
* @subpackage Ethereal
* @author Mauko Maunde
* @link http://mauko.co.ke/themes/ethereal/
* @since 0.1
**/

$post = (object)$post;
?>

	<title><?php echo ( $post -> name ); ?></title>
	<!-- Panel (Banner) -->
		<section class="panel banner right">
			<div class="content color0 span-3-75">
				<?php headerLogo(); ?>
				<h1 class="major"><?php echo ( $post -> name ); ?></h1>
				<p><?php echo ( $post -> name ); ?></p>
				<ul class="actions">
					<li><a href="#first" class="button special color1 circle icon fa-angle-right">Next</a></li>
				</ul>
			</div>
			<div class="image filtered span-1-75" data-position="25% 25%">
				<img src="<?php echo ( $post -> avatar ); ?>" alt="<?php echo ( $post -> name ); ?>">
			</div>
		</section>

	<!-- Panel (Spotlight) -->
		<section class="panel spotlight large left">
			<div class="content span-100">
				<?php echo ( $post -> details ); ?>
			</div>
		</section>

	<!-- Panel -->
		<section class="panel color4-alt">
			<div class="intro color4">
				<h2 class="major">Post Meta</h2>
				<p><?php echo ( $post -> categories ); ?></p>
				<p><?php echo ( $post -> tags ); ?></p>
				<a href="<?php echo ( _ROOT.'/users/'.$post -> author ); ?>"><?php echo ( $post -> author_name ); ?></a>
			</div>
			<div class="inner columns divided">
				<div class="span-3-25">
					<form method="post" action="#">
						<div class="field half">
							<label for="name">Name</label>
							<input type="text" name="name" id="name" />
						</div>
						<div class="field half">
							<label for="email">Email</label>
							<input type="email" name="email" id="email" />
						</div>
						<div class="field">
							<label for="message">Comment</label>
							<textarea name="message" id="message" rows="4"></textarea>
						</div>
						<ul class="actions">
							<li><input type="submit" value="Submit" class="button special" /></li>
						</ul>
					</form>
				</div>
				<div class="span-1-5">
						<li><a href="https://twitter.com/intent/tweet?url=<?php echo ( $post -> link ); ?>&text=<?php echo ( $post -> name ); ?>&via={via}&hashtags=<?php echo ( $post -> tags ); ?>" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
						<li><a href="https://www.facebook.com/sharer.php?u=<?php echo ( $post -> link ); ?>" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
						<li><a href="https://plus.google.com/share?url=<?php echo ( $post -> link ); ?>" class="icon fa-google-plus"><span class="label">G+</span></a></li>
						<li><a href="https://pinterest.com/pin/create/bookmarklet/?media=<?php echo ( $post -> avatar ); ?>&url=<?php echo ( $post -> link ); ?>&is_video={is_video}&description=<?php echo ( $post -> name ); ?>" class="icon fa-pinterest"><span class="label">Pinterest</span></a></li>
						<li><a href="whatsapp://send?text=<?php echo ( $post -> link ); ?>" class="icon fa-whatsapp"><span class="label">Whatsapp</span></a></li>
						<li><a href="https://share.flipboard.com/bookmarklet/popout?v=2&title=<?php echo ( $post -> name ); ?>&url=<?php echo ( $post -> link ); ?>" class="icon fa-instagram"><span class="label">Flipboard</span></a></li>
					</ul>
				</div>
			</div>
		</section>