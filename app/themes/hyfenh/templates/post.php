<?php
/**
* @package Jabali - The Plug-N-Play Framework
* @subpackage Hyfen
* @author 
* @link https://jabalicms.org/themes/hyfen
* @since 0.10
**/ ?>
<title><?php theTitle(); ?> - <?php showOption( 'name' ); ?></title>
<?php theImage('100%'); ?>
<h1><?php theTitle(); ?></h1>
<p><?php theDate(); ?></p>
<p><?php theCategories(); ?></p>
<p><?php theTags(); ?></p>
<article><?php theContent(); ?></article