<?php
namespace App\Providers;

class Application{
	
	public function __construct(){
		if ( app()->get('APP_DEBUG') == false ) {
			$this->_set_ini_setings();
			$this->_set_reporting();
			$this->_unregister_globals();
		}
	}

	private function _set_reporting(){
		error_reporting(0);
		ini_set('display_errors', 0);
		ini_set('log_errors', 1);
		ini_set('error_log', app()->get('APP_ROOT').'/tmp/errors.log');
	}

	private function _set_ini_setings(){
		ini_set('zend_extension', 1);
		ini_set('opcache.memory_consumption', 128);
		ini_set('opcache.interned_strings_buffer', 8);
		ini_set('opcache.max_accelerated_files', 4000);
		ini_set('opcache.revalidate_freq', 60);
		ini_set('opcache.fast_shutdown', 1);
		ini_set('opcache.enable_cli', 1);
	}

	private function _unregister_globals(){
		if (ini_get('register_globals')) {
			$globals= ['_SESSION', '_COOKIE', '_POST', '_GET', '_SERVER', '_ENV', '_REQUEST', '_FILES'];
			foreach ($globals as $g) {
				foreach ($GLOBALS[$g] as $key => $value) {
					if ($GLOBALS[$key] === $value) {
						unset($GLOBALS[$key]);
					}
				}
			}
		}
	}

  	protected function jsonResponse($code, $resp){
      header("Access-Control-Allow-Origin: *");
      header("Access-Control-Allow-Methods: *");
      header("Content-Type: applicaton/json; charset=UTF-8");
      http_response_code($code);
      print_r(json_encode($resp));
      exit;
  	}
}