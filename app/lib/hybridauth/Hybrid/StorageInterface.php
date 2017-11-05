<?php

/**
 * HybridAuth
 * https://hybridauth.sourceforge.net | https://github.com/hybridauth/hybridauth
 * (c) 2009-2015, HybridAuth authors | https://hybridauth.sourceforge.net/licenses.html
 */

/**
 * HybridAuth storage manager interface
 */
interface Hybrid_Storage_Interface {

	public function config($key, $value = null);

	public function get($key);

	public function set($key, $value);

	function clear();

	function delete($key);

	function deleteMatch($key);

	function getSessionData();

	function restoreSessionData($sessiondata = null);
}
