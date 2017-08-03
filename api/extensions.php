<?php
include '../inc/config.php';
include '../inc/jabali.php';

$path = hABSX;
$dir = new DirectoryIterator($path);
	echo '[';
foreach ($dir as $fileinfo) {
  if ($fileinfo->isDir() && !$fileinfo->isDot()) {
	$extension = $fileinfo->getFilename();
	$xJson = file_get_contents( hABSX.$extension."/".$extension.".json" );
	$xD = json_decode( $xJson, true );
	echo '{ "'.$xD['slug'] .'" :'. $xJson.' },';
	}
  }

	echo ' {} ]';

	$ext = json_decode ( hAPI.'extensions', true );
	var_dump( $ext ); ?>
