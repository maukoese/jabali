<?php 

/**
* @package Jabali 
* @subpackage Ethereal
* @author Mauko Maunde
* @link http://mauko.co.ke/themes/ethereal/
* @since 0.1
**/

$user = (object)$user;
?>

	<title><?php echo ( $user -> name ); ?></title>
	<!-- Panel (Banner) -->
		<section class="panel banner right">
			<div class="content color0 span-3-75">
				<?php headerLogo(); ?>
				<h1 class="major"><?php echo ( $user -> name ); ?></h1>
				<p><?php echo ( $user -> name ); ?></p>
				<ul class="actions">
					<li><a href="#first" class="button special color1 circle icon fa-angle-right">Next</a></li>
				</ul>
			</div>
			<div class="image filtered span-1-75" data-position="25% 25%">
				<img src="<?php echo ( $user -> avatar ); ?>" alt="<?php echo ( $user -> name ); ?>">
			</div>
		</section>

	<!-- Panel (Spotlight) -->
		<section class="panel spotlight large left">
			<div class="content span-5">
				<h2 class="major"><?php echo ( $user -> name ); ?></h2>
				<?php echo ( $user -> details ); ?>
			</div>
		</section>

	<!-- Panel -->
		<section class="panel color4-alt">
			<div class="intro color4">
				<h2 class="major">Contact Details</h2>
				<p><?php echo ( $user -> phone ); ?></p>
				<p><?php echo ( $user -> email ); ?></p>
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
							<label for="message">Message</label>
							<textarea name="message" id="message" rows="4"></textarea>
						</div>
						<ul class="actions">
							<li><input type="submit" value="Send" class="button special" /></li>
						</ul>
					</form>
				</div>
				<div class="span-1-5">
					<ul class="contact-icons color1">

						<?php $social = json_decode( $user -> social, true ); ?>
						<li class="icon fa-twitter"><a href="<?php echo( $social['twitter'] ); ?>"><?php echo( $social['twitter'] ); ?></a></li>
						<li class="icon fa-facebook"><a href="<?php echo( $social['facebook'] ); ?>"><?php echo( $social['twitter'] ); ?></a></li>
						<li class="icon fa-github"><a href="#"><?php echo( $social['github'] ); ?></a></li>
						<li class="icon fa-instagram"><a href="#"><?php echo( $social['instagram'] ); ?></a></li>
					</ul>
				</div>
			</div>
		</section>