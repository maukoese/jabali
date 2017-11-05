<?php
/**
* @package Eventually 
**/ ?>
<title><?php showOption( 'name' ); ?> - <?php showOption( 'description' ); ?></title>
<!-- Header -->
<center>
	<header id="header">
		<?php headerLogo(100); ?>
		<h1><?php showOption( 'name' ); ?></h1>
		<p><?php showOption( 'about' ); ?></span></p>
	</header>

<!-- Signup Form -->
	<form id="signup-form" method="post" action="#">
		<input type="email" name="email" id="email" placeholder="Email Address" />
		<input type="submit" value="Sign Up" />
	</form>
</center>