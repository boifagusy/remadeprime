<?php

namespace App\Utility;

use Illuminate\Support\Facades\Http;

class StrowalletUtility

{
    protected $apikey ;
    protected $secretkey;

    public function __construct()
    {
        $this->apikey = env('STRO_PUBLIC_KEY');
        $this->secretkey = env('STRO_SECRET_KEY');
    }
    
    public function generateReference()
    {
        return 'stw_' . uniqid(time());
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
            'email' => $data['email'],
            'name' => $data['name'],
            'custom' => $data['reference'],
            'currency' =>$data['currency'] ?? "NGN",
            'details' => $data['details'],
            'success_url' => $data->success_url ?? url('strowallet/success') , 
            'ipn_url' => $data->success_url ?? url('strowallet/success') , 
            'cancel_url' => $data->cancel_url ?? url('wallet') , 
            'public_key' => $this->apikey , 
        ];
        $baseurl = "https://strowallet.com/express/initiate";
        $response = Http::get($baseurl, $formdata)->json();
        
        return $response;
    }
    
    // Reserve account
    public function reserveAccount($data)
    {
        $formdata = [
            'phone' => $data['phone'],
            'email' => $data['email'],
            'account_name' => $data['name'],
            'accountReference' => $data['reference'],
            "webhook_url" => route('strowallet.webhook'),
            'public_key' => $this->apikey,
            
        ];
        $baseurl = "https://strowallet.com/api/virtual-bank/new-customer";
        $response = Http::post($baseurl, $formdata)->json();
        
        return $response;
    }
}