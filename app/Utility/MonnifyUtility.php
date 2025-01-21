<?php

namespace App\Utility;

use Illuminate\Support\Facades\Http;

class MonnifyUtility

{
    protected $contractcode;
    protected $apikey ;
    protected $secretkey;
    protected $baseurl ;

    public function __construct()
    {
        $this->contractcode = env('MONNIFY_CONTRACT');
        $this->apikey = env('MONNIFY_API_KEY');
        $this->secretkey = env('MONNIFY_SECRET_KEY');
        if(sys_setting('monnify_demo') == 1){
            $this->baseurl = "https://sandbox.monnify.com/api";
        }
        else {
        $this->baseurl = "https://api.monnify.com/api";
        }
    }
    
    public function generateReference()
    {
        return 'mfy_' . uniqid(time());
    }
    public function getHeader()
    {
        $credentials = base64_encode($this->apikey.':'.$this->secretkey);

        $response = Http::withHeaders([
            'Authorization' => 'Basic '.$credentials 
        ])->post($this->baseurl.'/v1/auth/login' );

        return 'Bearer ' . $response['responseBody']['accessToken'];
    }

    public function initializePayment($data)
    {
        $formdata = [
            'amount' => $data['amount'],
            'customerEmail' => $data['email'],
            'customerName' => $data['name'],
            'paymentReference' => $data['reference'],
            'currencyCode' =>$data['currency'] ?? "NGN",
            'paymentDescription' => $data['description'],
            'paymentMethods' => ["CARD"],
            'redirectUrl' => $data->redirectUrl ?? url('monnify/success') ,            
            "contractCode" => $this->contractcode,
        ];
        $response = Http::withHeaders([
            'Authorization' => $this->getHeader()
        ])->post($this->baseurl.'/v1/merchant/transactions/init-transaction', $formdata)->json();
        
        return $response;
    }

    // verify transaction
    public function verifyTransaction($data)
    {
        $response = Http::withHeaders([
            'Authorization' => $this->getHeader()
        ])->get($this->baseurl.'/v1/merchant/transactions/query', $data);

        return $response;
    }
    
    // Reserve account
    public function reserveAccount($data)
    {
        $formdata = [
            'customerEmail' => $data['email'],
            'customerName' => $data['name'],
            'accountName' => $data['name'],
            'accountReference' => $data['reference'],
            'currencyCode' =>$data['currency'] ?? "NGN",         
            "contractCode" => $this->contractcode,
            "getAllAvailableBanks" => false,
            "preferredBanks" => ["035","232"]
            
        ];
        $response = Http::withHeaders([
            'Authorization' => $this->getHeader()
        ])->post($this->baseurl.'/v2/bank-transfer/reserved-accounts', $formdata)->json();
        
        return $response;
    }
}