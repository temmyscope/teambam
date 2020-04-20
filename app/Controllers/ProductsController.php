<?php 
namespace App\Controllers;

use App\Providers\{Strings, File, Session};
use App\Products;

class ProductsController extends Controller{

	public function IndexEndPoint(){
		if (Session::get('role') == 'admin') {
			view('products.index', Products::findby(['supplier_id' => Session::get($this->app->get('CURRENT_USER_SESSION_NAME') ) ]));
		} 
	}
	
	public function addEndPoint(File $file)
	{
		if (Session::get('role') == 'admin') {
			if ( $this->request->isNotEmpty() ) {
				$this->request->validate([
					'product_name' => [ 'display' => 'Product Name', 'required' => true ],
					'quantity' => [ 'display' => 'Quantity', 'required' => true, 'is_numeric' => true ],
					'category' => [ 'display' => 'Category', 'required' => true],
					'price' => [ 'display' => 'Price', 'required' => true, 'is_numeric' => true ]
				]);
				if( $this->request->passed() ){
					Products::insert([
						'product_name' => post('product_name'),
						'img' => $file->uploader( $this->request->file('img') )['value'],
						'quantity' => post('qty'),
						'category' => post('category'),
						'measurement' => post('measurement'),
						'created_at' => Strings::time_from_string(),
						'updated_at' => Strings::time_from_string(),
						'status' => 'available',
						'price' => post('price'),
						'resellable' => post('resellable_price'),
						'product_code' => post('product_name').Strings::fixed_length_token(4)
					]);
					$this->request->status('success', 'Your Profile has been added.');
				}
			}
			view('products.add');	
		}
	}

	public function editEndPoint($var)
	{
		if (Session::get('role') == 'admin') {
			$clause = [
				'supplier_id' => Session::get($this->app->get('CURRENT_USER_SESSION_NAME') ), 
				'id' => $var 
			];
			if ( $this->request->isNotEmpty() ) {
				$this->request->validate([
					'product_name' => [ 'display' => 'Product Name', 'required' => true ],
					'quantity' => [ 'display' => 'Quantity', 'required' => true, 'is_numeric' => true ],
					'category' => [ 'display' => 'Category', 'required' => true],
					'price' => [ 'display' => 'Price', 'required' => true, 'is_numeric' => true ]				
				]);
				if( $this->request->passed() ){
					Products::update([
						'product_name' => post('product_name'),
						'quantity' => post('qty'),
						'measurement' => post('measurement'),
						'category' => post('category'),
						'updated_at' => Strings::time_from_string(),
						'status' => post('status'),
						'price' => post('price'),
						'resellable' => post('resellable_price')
					], $clause);
				}
			}
			view('products.edit', Products::findfirst($clause) );	
		}
	}
}