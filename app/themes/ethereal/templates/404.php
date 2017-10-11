<?php 

/**
* @package Jabali 
* @subpackage Ethereal
* @author Mauko Maunde
* @link http://mauko.co.ke/themes/ethereal/
* @since 0.1
**/
?>

<title>Error 404: Not Found</title>
<!-- Panel (Banner) -->
	<section class="panel banner right">
		<div class="content color0 span-3-75">
			<?php headerLogo(); ?>
			<h1 class="major">Error 404: Not Found</h1>
			<p>Someone ate the page you are looking for. We are blaming the dog.</p>
			<ul class="actions">
				<li><a href="<?php echo( _ROOT ); ?>" class="button special color1 circle icon fa-home">Home</a></li>
			</ul>
		</div>
		<div class="image filtered span-1-75" data-position="25% 25%">
			<img src="<?php echo( _IMAGES.'404.jpg' ); ?>" alt="<?php echo ( $post -> name ); ?>">
		</div>
	</section>