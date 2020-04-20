<?php
namespace App\Providers;

use Rave\Rave;
use Rave\Event\EventHandlerInterface;
use App\Transaction;

class RaveEventHandler implements EventHandlerInterface{

 /**
     * This is called when a transaction is initialized
     * @param object $initializationData (This is the initial transaction data as passed)
     **/
    public function onInit($initializationData) {}

    /**
     * This is called only when a transaction is successful
     * @param object $transactionData (This is the transaction data as returned from the Rave payment gateway)
     **/
    public function onSuccessful($transactionData) {
        $request = new Request;
        Transaction::update( [ 'payment_status' => true ], [ 'order_code' => $transactionData->txref ] );
        $request->status('success', 'Payment Successful. Your order is been actively processed.');
		redirect('home');
    }

    /**
     * This is called only when a transaction failed
     * @param object $transactionData (This is the transaction data as returned from the Rave payment gateway)
     **/
    public function onFailure($transactionData) {
        $request = new Request;
        Transaction::update( [ 'deleted' => true ], [ 'order_code' => $transactionData->txref ] );
        $request->status('success', 'Payment Failed. Your order has been canceled.');
		redirect('home');
    }

    /**
     * This is called when a transaction is requeried from the payment gateway
     * @param string $transactionReference (This is the transaction reference as returned from the Rave payment gateway)
     **/
    public function onRequery($transactionReference) {}

    /**
     * This is called when a transaction requery returns with an error
     * @param string $requeryResponse (This is the error response gotten from the Rave payment gateway requery call)
     **/
    public function onRequeryError($requeryResponse) {}

    /**
     * This is called when a transaction is cancelled by the user
     * @param string $transactionReference (This is the transaction reference as returned from the Rave payment gateway)
     **/
    public function onCancel($transactionReference){
        $request = new Request;
        Transaction::update( [ 'deleted' => true ], [ 'order_code' => $transactionData->txref ] );
        $request->status('warning', 'Payment Cancelled. Your order has been cancelled.');
		redirect('home');
    }

    /**
     * This is called when a transaction doesn't return with a success or a failure response.
     * @param string $transactionReference (This is the transaction reference as returned from the Rave payment gateway)
     * @param object $data (This is the data returned from the requery call)
     **/
    public function onTimeout($transactionReference,$data){
        $request = new Request;
        $request->status('error', 'The transaction timed out. Try again later.');
		redirect('home');
    }


}