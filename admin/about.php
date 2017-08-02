<?php 
include '../inc/config.php'; 
include '../inc/jabali.php';
include './header.php'; ?>

<title>About Jabali [ <?php showOption( 'name' ); ?> ]</title><?php

$xJson = file_get_contents( hABS."package.json" );
$xD = json_decode( $xJson, true ); ?>
<div class="mdl-grid">
  <div class="mdl-cell mdl-cell--8-col mdl-color--<?php primaryColor(); ?>">
    <article style="margin: 2%;">
      <h4><b><?php echo ucwords( $xD['name']); ?> </b>( Jabali version <?php echo ucwords( $xD['version']); ?> )</h4>
      <h4><b>Developers</b></h4>
      <p><b>Lead Developer: </b><?php echo ucwords( $xD['author']); ?></p>

      <h4><b>Licenses </b></h4>
      <p>
      <a href="<?php echo $xD['licenses']['MIT']; ?>" class="">MIT License</a><br>
      <a href="<?php echo $xD['licenses']['GNU']; ?>" class="">GNU License</a><br>
      <a href="<?php echo $xD['licenses']['Apache']; ?>" class="">Apache License</a>
      </p>
      <h4><b>Requirements</b></h4>
      <p>PHP Version <?php echo ucwords( $xD['php']); ?><br>
      MYSQL Version <?php echo ucwords( $xD['mysql']); ?></p>
    </article>
  </div>

  <div class="mdl-cell mdl-cell--4-col mdl-color--<?php primaryColor(); ?>">
    <img src="<?php echo ucwords( $xD['screenshot']); ?>">
    <article style="margin: 2%;">
      <?php echo ucwords( $xD['description']); ?>
      <h4><b>Support</b></h4>
      <a href="<?php echo ucwords( $xD['website']); ?>"><i class="material-icons">public</i></a>
      <a href="<?php echo ucwords( $xD['support']); ?>"><i class="material-icons">help</i></a>
      <h4><b>Social</b></h4>
      <a href="<?php echo ucwords( $xD['social']['facebook']); ?>"><i class="fa fa-facebook fa-2x"></i></a>
      <a href="<?php echo ucwords( $xD['social']['twitter']); ?>"><i class="fa fa-twitter fa-2x"></i></a>
      <a href="<?php echo ucwords( $xD['social']['github']); ?>"><i class="fa fa-github fa-2x"></i></a>
      <a href="mailto:<?php echo $xD['social']['email']; ?>"><i class="fa fa-envelope fa-2x"></i></a>
    </article>
  </div>
</div>
<?php
include './footer.php'; ?>