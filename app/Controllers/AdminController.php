<?php 
namespace App\Controllers;

use App\Providers\{Strings, Session, Rave};
use App\{ Order, Withdraw, Transaction, Profile };
use Seven\Vars\Arrays;

class AdminController extends Controller{

	public function IndexEndPoint(){ 
		view('admin.index'); 
	}

	public function ordersEndPoint($var = "")
	{
		if( Session::get('role') == 'admin' ){
			if (get('action') != null && $var != "") {
				if ( get('action') == 'cancel' ) {
					Transaction::update([ 'status' => 'cancelled' ], ['id' => (int)$var]);
				}elseif ( get('action') == 'confirm' ) {
					Transaction::update([ 'status' => 'confirmed' ], ['id' => (int)$var]);
				}	
			}
			if ( get('type') == 'cancelled' ) { 
				view('admin.cancelled_orders', Transaction::findby( [ 'status' => 'cancelled', 'payment_status' => 'true' ]));
			}elseif ( get('type') == 'confirmed' ) {
				view('admin.confirmed_orders', Transaction::findby( [ 'status' => 'confirmed', 'payment_status' => 'true' ]));
			} else {
				view('admin.pending_orders', Transaction::findby( [ 'status' => 'pending', 'payment_status' => 'true' ]) );
			}
		}else{
			$this->request->status('error', 'Only admins can access that page');
			redirect('home');
		}
	}

	public function change_roleEndPoint()
	{
		if( Session::get('role') == 'admin' ){
			if ( $this->request->isNotEmpty() ) {
				$this->request->validate([
					'role' => [ 'display' => 'Role', 'required' => true, 'is_one_of' => [ 'admin', 'supplier', 'customer' ] ],
					'user_id' => [ 'display' => 'User ID', 'required' => true, 'is_numeric' => true ]
				]);
				if ( $this->request->passed() ) {
					Profile::update(['role' => post('role')], [ 'id'=> post('user_id') ]);
					$this->request->status('success', 'User Privilege has been updated.');
				}
			}
			$users = new Arrays( Profile::all() );
			$data = $users->whitelist( ['id', 'email', 'name', 'role'] );
			view('admin.change_role', $data);
		}else{
			$this->request->status('error', 'Only admins can access that page');
			redirect('home');
		}
	}

	public function chartsEndPoint()
	{
		view('admin.charts');
	}

	public function payoutsEndPoint($var = '')
	{
		if ( $var != '' && is_numeric($var) ) {
			$var = Withdraw::findfirst(['id' => $var]);
			$rave = new Rave();
			$data = $rave->transfer($var->txref, $var->bank_code, $var->account_no, $var->amount, $narration = "Transfer From AgriTrading");
			if( $data ){
				//Withdraw::update( [ 'status' => 'paid' ], ['id' => $var] );	
			}
		}
		$data =  Withdraw::findby(['deleted' => 'false', 'status' => 'pending']);
		view('admin.payouts', $data );
	}
	
}