<?php 
namespace App;

use App\Providers\Model; 

class Order extends Model{

	protected static $table = 'order'; 

	protected static $fulltext = [];

}