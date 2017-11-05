<?php
/**
* @package Eventually 
**/ ?>
<title><?php showOption( 'name' ); ?> - <?php showOption( 'description' ); ?></title>
<!-- Header -->
	<header id="header">
		<?php headerLogo( 200 ); ?>
		<h1><?php showOption( 'name' ); ?></h1>
		<p><?php showOption( 'about' ); ?></span></p>
	</header>

<!-- Signup Form -->
	<form id="signup-form" method="post" action=>
		<input type="text" name="name" id="name" placeholder="Name (optional)" />
		<input type="email" name="email" id="email" placeholder="Email Address" />
		<input type="hidden" name="message" value="New Subscription">
		<input type="submit" name="contact" value="Sign Up" />
		<?php csrf(); ?>
	</form>