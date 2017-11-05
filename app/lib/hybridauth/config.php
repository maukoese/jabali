<?php

/**
 * HybridAuth
 * https://hybridauth.sourceforge.net | https://github.com/hybridauth/hybridauth
 * (c) 2009-2015, HybridAuth authors | https://hybridauth.sourceforge.net/licenses.html
 */
// ----------------------------------------------------------------------------------------
//	HybridAuth Config file: https://hybridauth.sourceforge.net/userguide/Configuration.html
// ----------------------------------------------------------------------------------------

$config = array(
    "base_url" => "http://localhost/jabali/inc/lib/hybridauth/index",
    "providers" => array(
        // openid providers
        "OpenID" => array(
            "enabled" => true,
        ),
        "Yahoo" => array(
            "enabled" => true,
            "keys" => array("id" => "", "secret" => ""),
        ),
        "AOL" => array(
            "enabled" => true,
        ),
        "Google" => array(
            "enabled" => true,
            "keys" => array("id" => "", "secret" => ""),
        ),
        "Facebook" => array(
            "enabled" => true,
            "keys" => array("id" => "1084251448343450", "secret" => "8bee7cdf240afde6c3977ad73992a05a"),
            "trustForwarded" => false,
        ),
        "Twitter" => array(
            "enabled" => true,
            "keys" => array("key" => "WIewzibMOm4cV8ixqPHX084yE", "secret" => "gBf4pN1Ft2OEgR6Qp8l5UIeIo8KY073VHkZXue4SrBrgMCRRfZ"),
            "includeEmail" => true,
        ),
        // windows live
        "Live" => array(
            "enabled" => true,
            "keys" => array("id" => "", "secret" => ""),
        ),
        "LinkedIn" => array(
            "enabled" => true,
            "keys" => array("id" => "", "secret" => ""),
            "fields" => array(),
        ),
        "Foursquare" => array(
            "enabled" => true,
            "keys" => array("id" => "", "secret" => ""),
        ),
    ),
    // If you want to enable logging, set 'debug_mode' to true.
    // You can also set it to
    // - "error" To log only error messages. Useful in production
    // - "info" To log info and error messages (ignore debug messages)
    "debug_mode" => false,
    // Path to file writable by the web server. Required if 'debug_mode' is not false
    "debug_file" => "",
);
