<?php 
namespace App;

use App\Providers\Model; 

class Admin extends Model{

	protected static $table = 'admin'; 

	protected static $fulltext = [];

}