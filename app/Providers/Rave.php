<?php
namespace App\Providers;

use Strings;

class Rave{
    protected $pubic = "FLWPUBK-5f66b109aec9748233e8b50199a07c36-X";
    protected $enc_key = "5683d643c029bc80b67c98f7";

    public function refund(string $txref): bool
    {
        curl("https://api.ravepay.co/gpx/merchant/transactions/refund")
        ->setData( $this->process([
            'ref' => $txref, //reference key
            'seckey' => $this->secret
        ]))
        ->setMethod('POST')->send();
    }

    public function transfer($txref, $bank = "044", $acc_no = "0690000044", $amount = 500, $narration = "Cash Transfer" )
    {   //This is only available for the following currencies NGN, KES, UGX, TZS, ZAR, GHS & XOF
        $result = curl("https://api.ravepay.co/v2/gpx/transfers/create")->setData(
            $this->process([
            "account_bank" => $bank,
            "account_number"  => $acc_no,
            "amount"  => $amount,
            "seckey"  => $this->secret,
            "narration"  => $narration,
            "currency"  => "NGN",
            "reference"  => $txref
        ]))
        ->setMethod('POST')->send();
        $result = json_decode($result);
        if (
            $result['status'] === "success" && $result['data']['reference'] === $txref && 
            $result['data']['amount'] === $amount && $result['status']['is_approved'] == 1
        ){
            return true;
        }
        return false;
    }

    public function create_bulk()
    {
        /**
        * bulk_data should look sth like dis: 
        * @example
            [
                [
                    "Bank" => "044",
                    "Account Number" => "0690000032",
                    "Amount" => 500,
                    "Currency" => "NGN",
                    "Narration" => "Bulk transfer 1",
                    "Reference" => "mk-82973029"
                ],
                [
                    "Bank" => "044",
                    "Account Number" => "0690000034",
                    "Amount" => 500,
                    "Currency" => "NGN",
                    "Narration" => "Bulk transfer 2",
                    "Reference" => "mk-283874750"
                ]
            ]
        */
        $data = curl("https://api.ravepay.co/v2/gpx/transfers/create_bulk")
        ->setData( $this->process([
            "seckey"  => $this->secret,
            "title" => $title,
            "bulk_data" => [
                json_encode($bulk_data)
            ]
        ]) )
        ->setMethod('POST')
        ->send();
        $data = json_decode($data);
        if ( $data['status'] == "success" ) {
            return $data['data']['id'];
        }
    }

    public function bulk_status($id) //the id returned from the bulk transfer
    {
        $data = curl("https://api.ravepay.co/v2/gpx/transfers?seckey={$this->secret}&batch_id={$id}")->send();
        $data = json_decode($data);
        if ($data['status'] == 'success') {
            $success = [];
            foreach($data['data']['transfers'] as $key => $value){
                $status = strtolower($value['status']);
                if ( $status === 'success' || $status === 'successful' ) {
                    $success[] = $value;
                }
            }
            return $success;
        }
        return null;
    }

    private function encrypt3Des($data){
        $encData = openssl_encrypt($data, 'DES-EDE3', $this->enc_key, OPENSSL_RAW_DATA);
        return base64_encode($encData);
    }

    public function process($data)
    {
        return [ 'PBFPubKey' => $this->public, 'client' => $this->encrypt3Des($data), 'alg' => '3DES-24' ];
    }
    
    /**
    public function payviacard($email, $amnt, $cardno, $cvv, $exp_year, $exp_month, $txref){
        $dataReq= json_encode([
            'PBFPubKey' => $this->public,
            'cardno' => $cardno,
            'cvv' => $cvv,
            'amount' => $amnt,
            'expiryyear' => $exp_year,
            'expirymonth' => $exp_month,
            'email' => $email,
            "suggested_auth" => "PIN",
            'txRef' => $txref
        ]);
        curl("https://api.ravepay.co/flwv3-pug/getpaidx/api/charge")
        ->setMethod('POST')
        ->setData($this->process($dataReq))
        ->send();
    }

    public function payWithAccount()
    {
        $data = curl()
        ->setMethod('POST')
        ->setData([
            "PBFPubKey" => $this->public,
            "accountbank" => $bank_code,
            "accountnumber" => $acc_no,
            "payment_type" => "account",
            "amount"=> $amount,
            "email" => $email,
            "passcode" => $passcode,//customer Date of birth, required for Zenith bank account payment. DDMMYYYY e.g. "09101989"
            //"bvn" => "12345678901", required for UBA bank, hence we will not make UBA available
            "phonenumber" => "0902620185",
            "txRef" => $txref,
            "redirect_url" => ""
        ])
        ->send();
    }

    public function verifier($txref)
    {
        $result = curl("https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/verify")
        ->setData( $this->process([
            'txref' => $txref,
            'SECKEY' => $this->secret
        ]) )
        ->setMethod('POST')
        ->send();
        return json_decode($result);
    }
    
    function successful($txref): bool{
        $data = $this->verifier($txref);
        if('successful' == $data['data']['status'] && '00'== $data['data']['chargecode']){
            return true;
        }
        return false;
    }

    public function payment_verified($txref, $amount, $currency = 'NGN')
    {
        $data = $this->verifier($txref);
        if($amount == $data['data']['amount']  && $currency == $result['data']['currency']){
            return true;
        }
        return false;
    }
    */

}
