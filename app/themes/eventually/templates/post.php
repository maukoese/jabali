<?php
/**
* @package Eventually 
**/ ?>
<title><?php theTitle(); ?> - <?php showOption( 'name' ); ?></title>
<!-- Header -->
	<header id="header">
		<?php headerLogo(); ?>
		<hr>
		<h1><?php theTitle(); ?></h1>
		<?php theImage(); ?>
		<p><?php theContent(); ?></p>
		<span><?php theCategories(); ?></span>
	</header>

<!-- Signup Form -->
	<form id="signup-form" method="post" action="#">
		<input type="email" name="email" id="email" placeholder="Email Address" />
		<input type="submit" value="Sign Up" />
	</form>
		<hr>