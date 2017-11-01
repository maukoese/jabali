<?php 

/**
* @package Jabali 
* @subpackage Skeleton
* @author Mauko Maunde
* @link https://jabalicms.org/themes/skeleton
* @since 0.1
**/

?>
	<title><?php showOption( 'name' ); ?></title>
	<!-- Primary Page Layout
	–––––––––––––––––––––––––––––––––––––––––––––––––– -->
	<div class="container">
	    <div class="row blue banner">
	    	<div class="header-bar">
	    	<?php headerLogo(); ?>
	    	<ul class="nav right">
	    		<li><a href="#">Home</a></li>
	    	</ul>
	    	</div>
	    	<br>
	    	<br>
		    	<center>
		    		<h1><?php showOption( 'name' ); ?></h1>
		    		<h3><?php showOption( 'description' ); ?></h3>
		    		<a href="."><button class="button-primary">GET STARTED</button></a>
		    	</center>
	  	</div>
	    <div class="row">
		    	<?php if( hasPosts() ): ?>
		    	<?php while( hasPosts() ):
		    	thePost(); ?>
		    	<div class="four columns">
		    		<?php theImage('100%'); ?>
		    		<h3><?php theTitle(); ?></h3>
		    		<?php theDate(); ?>
		    		<article>
		    			<?php theExcerpt(100); ?> ... <?php theLink(); ?>
		    		</article>
		    	</div>
		    	<?php endwhile; ?>
		    	<?php endif; ?>
	  	</div>
	</div>