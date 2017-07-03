<?php 
/**
* @package Jabali Framework
* @subpackage Home
* @link https://docs.mauko.co.ke/jabali/home
* @author Mauko Maunde
* @version 0.17.06
**/
function is_localhost() {
    $whitelist = array( '127.0.0.1', '::1' );
    if ( in_array( $_SERVER['REMOTE_ADDR'], $whitelist) )
        return true;
  }

$protocol = ((!empty( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] != 'off' ) || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
if ( is_localhost() ) { 
echo $protocol . $_SERVER['HTTP_HOST'] . '/' . basename( __DIR__ ) . '/'; 
} else { 
echo $protocol . $_SERVER['HTTP_HOST'] . '/'; 
} 

$urlparts = trim( '/', $_SERVER['REQUEST_URI'] );
echo $urlparts;
$urlparts = explode( "/", $_SERVER['REQUEST_URI'] );
echo $urlparts[0];
echo "<br>";
echo $urlparts[1];
echo "<br>";
echo $urlparts[2];
echo "<br>";
echo $urlparts[3];
echo "<br>";
echo $urlparts[4];
?>