<?php
/**
* @package Eventually 
**/ ?>
<title><?php echo( $post -> name ).' - '; showOption( 'name' ); ?></title>
<!-- Header -->
	<header id="header">
		<?php headerLogo(); ?>
		<hr>
		<h1><?php echo( $post -> name ); ?></h1>
		<p><?php echo( $post -> details ); ?></p>
	</header>

<!-- Signup Form -->
	<form id="signup-form" method="post" action="#">
		<input type="email" name="email" id="email" placeholder="Email Address" />
		<input type="submit" value="Sign Up" />
	</form>
		<hr>