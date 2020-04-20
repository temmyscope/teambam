<?php
namespace App\Controllers;

use App\Providers\Application;
use App\Providers\Request;

class Controller extends Application{

	public function __construct(){
		parent::__construct();
		$this->request = new Request();
		$this->app = app();
	}

}