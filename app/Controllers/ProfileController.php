<?php
namespace App\Controllers;

use App\Providers\{Strings, Session};
use App\{Profile, Withdraw};

class ProfileController extends Controller{

	public function IndexEndPoint(){
		if ( $this->request->isNotEmpty() ) {
			$this->request->validate([
				'age' => [ 'display' => 'Age', 'required' => true, 'is_numeric' => true ],
				'address' => [ 'display' => 'Address', 'required' => true ],
				'contact' => [ 'display' => 'Contact', 'required' => true ],
				'gender' => [ 'display' => 'Gender', 'required' => true, 'is_one_of' => ['male', 'female'] ],
				'zipcode' => [ 'display' => 'Zip Code', 'required' => true, 'is_numeric' => true ]
			]);
			if( $this->request->passed() ){
				Profile::insert([
					'age' => post('age'),
					'address' => post('address'),
					'contact' => post('contact'),
					'gender' => post('gender'),
					'zipcode' => post('zipcode'),
					'username' => post('username')
				]);
				$this->request->status('success', 'Your Profile has been updated.');
			}
		}
		$data = Profile::findfirst(['id' => Session::get($this->app->get('CURRENT_USER_SESSION_NAME') ) ]);
		if (!empty($data->wallet)) {
			Session::set('wallet', $data->wallet);
		}
		view('profile.index', $data ); 
	}

	public function walletEndPoint(Type $var = null)
	{	
		if ( $this->request->isNotEmpty() ) {
			//first validate
			$this->request->validate([
				'bank_name' => [ 'display' => 'Bank Name', 'required' => true],
				'amount' => [ 'display' => 'Amount', 'required' => true, 'is_numeric' => true, 'is_not_greater_than' => Session::get('wallet') ],
				'account_name' => [ 'display' => 'Account Name', 'required' => true],
				'account_number' => [ 'display' => 'Account Number', 'required' => true, 'is_numeric' => true ],
			]);
			if( $this->request->passed() ){
				$w = Withdraw::insert([
					'user_id' => Session::get( $this->app->get('CURRENT_USER_SESSION_NAME') ),
					'bank_code' => post('bank_code'),
					'txref' => Strings::get_unique_name( Strings::rand(4) ),
					'bank_name' => $this->app->get( post('bank_code') ),
					'account_name' => post('account_name'),
					'account_no' => post('account_number'),
					'amount' => post('amount'),
					'created_at' => Strings::time_from_string()
				]);
				if ( is_numeric($w) ) {
					Profile::minus('wallet', post('amount'), [ 'id' => Session::get( $this->app->get('CURRENT_USER_SESSION_NAME') ) ]);
					Session::set('wallet', Session::get('wallet')-post('amount') );
					$this->request->status('success', 'Your withdrawal will be processed within 72 hrs.');
				}
			}
		}
		view('profile.wallet', Withdraw::findby(['deleted' => 'false', 'status' => 'pending', 'user_id' => Session::get( $this->app->get('CURRENT_USER_SESSION_NAME')) ]) );
	}

}