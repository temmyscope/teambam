<?php
namespace App\Providers;

use Seven\Model\ModelTrait;

class Model
{
	use ModelTrait;

	/**
	* This variable is extremely essential to the proper functioning of the trait due to the underlying Doctrine DBAL package  
	*/
	protected static $config = [
		'dbname' => 'id13307915_teambam',
		'user' => 'id13307915_root',
		'password' => '1#G2Zck8FAFM5vfEyKio',
		'host' => 'localhost',
	    'driver' => 'pdo_mysql'
	];

}