<?php
include 'inc/config.php';
include 'inc/jabali.php';
connectDb();

$manifest = array(
  'short_name' => getOption( 'name' ),
  'name' => getOption('description'),
  'icons' => array(
    'src' => getOption('favicon'),
      'type' => "image/png",
      'sizes' => "48x48"
    ),
    array(
      'src' => getOption('favicon'),
      'type' => "image/png",
      'sizes' => "96x96"
    ),
    array(
      'src' => getOption('favicon'),
      'type' => "image/png",
      'sizes' => "192x192"
   ),
  'start_url' => hROOT
);

echo json_encode( $manifest );
header('Content-Type:Application/json' );

?>