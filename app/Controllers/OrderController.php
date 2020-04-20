<?php 
namespace App\Controllers;

use Seven\Vars\Arrays;
use Rave\Rave;
use App\Providers\{Strings, Session, RaveEventHandler};
use App\{Transaction, Products, Profile};

class OrderController extends Controller{

	public function IndexEndPoint( $var = "" ){
		if( is_numeric($var) ){
			$data = [];
			$data  = (array) Transaction::findfirst( [ 'id' => $var ] );
			$sum = unserialize($data['summary']);
			$data['summary'] = [];
			$counter = 0;
			foreach ($sum as $key => $value) {
				$data['summary'][$counter] = Products::findfirst([ 'product_code' => $key ]);
				$data['summary'][$counter]->quantity = $value;
				$counter += 1;
			}
			return view('order.index', $data);
		}
		redirect('home');
	}

	public function historyEndPoint()
	{
		$data = Transaction::findBy(['customer_id' => Session::get($this->app->get('CURRENT_USER_SESSION_NAME')),
			'payment_status' => true
		]);
		view('order.history', $data);
	}

	public function checkoutEndPoint()
	{
		$txref = Strings::get_unique_name( Strings::rand(4) );
		if ( $this->request->isNotEmpty() ) {
			$arr = [];
			foreach($_SESSION['cart'] as $key => $value) {
				$arr[$value['ids']] = $value['quantity'];
				Products::minus('quantity', $value['quantity'], [ 'id' => $value['ids'] ] ); //decrease products quantity
			}
			$t = Transaction::insert([
				'customer_id' => Session::get($this->app->get('CURRENT_USER_SESSION_NAME')),
				'order_code' => $txref,
				'summary' => serialize($arr),
				'total' => $_SESSION['mm'],
				'created_at' => Strings::time_from_string()
			]);
			if ( is_numeric($t) ) {
				unset($_SESSION["cart"]); unset($_SESSION['mm']);
				//$this->request->status('success', 'Your Order has been placed.');
				$eventHandler = new RaveEventHandler;
				$rave = Rave::init([ 'env' => 'live', 'autoRefs' => false ])->listener($eventHandler);
				return $rave->run();	
			}
		}
		$user = Profile::findfirst([ 'id' => Session::get($this->app->get('CURRENT_USER_SESSION_NAME')) ]);
		$user->txref = $txref;
		view('order.checkout',  $user);	
	}

	public function cartEndPoint()
	{
		view('order.cart', []);
	}

	public function cancelEndPoint($var)
	{
		Profile::add('wallet', $order->total, ['id' => $var, 'payment' => 'true' ]);
		Transaction::softdelete(['id' => $var]); //or Transaction::delete(['id' => $var]);
		$this->request->status('success', 'Your order has been cancelled.');
		redirect('home');
	}

}