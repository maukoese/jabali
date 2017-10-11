<?php
require 'init.php';
header('Content-Type:Application/json' );

$manifest["name"] = getOption('name');
$manifest["short_name"] = getOption('name');
$manifest["start_url"] = ".";
$manifest["display"] = "standalone";
$manifest["background_color"] = "#ffff";
$manifest["description"] = getOption('description');
$manifest["icons"][] = array( 'src' => getOption('favicon'), 'type' => "image/png", 'sizes' => "96x96");
$manifest["icons"][] = array( 'src' => getOption('favicon'), 'type' => "image/png", 'sizes' => "192x96");
$manifest["icons"][] = array( 'src' => getOption('favicon'), 'type' => "image/png", 'sizes' => "300x96");
$manifest["icons"][] = array( 'src' => getOption('favicon'), 'type' => "image/png", 'sizes' => "300x96");
$manifest["related_applications"][] = array( 'platform' => "web", 'url' => "");
$manifest["related_applications"][] = array( 'platform' => "play", 'url' => "");

echo json_encode( $manifest );