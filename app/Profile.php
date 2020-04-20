<?php 
namespace App;

use App\Providers\Model; 

class Profile extends Model{

	protected static $table = 'users'; 

	protected static $fulltext = [];

}