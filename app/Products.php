<?php 
namespace app;

use App\Providers\Model; 

class Products extends Model{

	protected static $table = 'products'; 

	protected static $fulltext = [];

}