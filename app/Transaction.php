<?php 
namespace App;

use App\Providers\Model; 

class Transaction extends Model{

	protected static $table = 'transaction'; 

	protected static $fulltext = [];

}