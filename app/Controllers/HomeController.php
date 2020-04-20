<?php
namespace App\Controllers;

use Seven\Vars\Arrays;
use App\Products;

class HomeController extends Controller{

	public function __construct(){
		parent::__construct();
	}
	
	public function IndexEndPoint(){
		$all = Products::all();
		$var = new Arrays( $all );
		$var->exclude_by([ 'quantity' => 0, 'status' => 'unavailable']);
		$data = $var->get();
		view('home.index', $data );
	}	


	public function add_productEndPoint()
	{
		if( $this->request->isNotEmpty() ){
			$this->request->validate([
				'product_code' => [ 'display' => 'product code', 'required' => true ],
				'hiddenname' => [ 'display' => 'name', 'required' => true ],
				'hiddenprice' => [ 'display' => 'product price', 'is_numeric' => true, 'required' => true ],
				'quantity' => [ 'display' => 'quantity', 'required' => true ]
			]);
			if( $this->request->passed() ){
				$size = isset( $_SESSION["cart"] ) ? count( ($_SESSION["cart"]) ) : 0;
				$array_ids = array_column( $_SESSION["cart"] ?? [], "ids");
				$itemarray = [ 
					'ids' => post("product_code"), 'name' => post("hiddenname"),
					'price' => post("hiddenprice"), 'quantity' => post("quantity"),
					'resellable' => is_null(post('resellable')) ? post("hiddenprice") : post('resellable')
				];
				if ( !in_array($_POST["product_code"], $array_ids) ) {
					$_SESSION["cart"][$size] = $itemarray;
					$this->request->status('success', 'Item has been Added.');
				}else{
					$this->request->status('error', 'Product can not be added twice.');
				}
			}
		}
		redirect('home');
	}

	public function remove_productEndPoint()
	{
		if ( isset($_SESSION["cart"]) ) {
			foreach ($_SESSION["cart"] as $key => $value) {
				if ( $value['ids'] == get("id") ) {
					unset($_SESSION["cart"][$key]);
					$this->request->status('success', 'Product removed.');
					break;  
				}
			}
		}
		redirect('order/cart');
	}

}