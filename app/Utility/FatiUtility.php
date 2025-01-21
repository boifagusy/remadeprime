<?php

namespace App\Utility;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Http;

class FatiUtility

{
    protected $username;
    protected $password;
    protected $baseurl ;

    public function __construct()
    {
        $this->username = env('FATI_USERNAME');
        $this->password = env('FATI_PASS');
        $this->baseurl = "https://fatizaradata.com/api";
    }
    
    public function generateReference()
    {
        return 'ftz_' . uniqid(time());
    }
    public function getHeader()
    {
        $credentials = base64_encode($this->username.':'.$this->password);

        $response = Http::withHeaders([
            'Authorization' => 'Basic '.$credentials 
        ])->post($this->baseurl.'/user' );

        return 'Token ' . $response['AccessToken'];
    }

    public function buyAirtime($data)
    {
        $formdata = [
            'amount' => $data['amount'],
            'phone' => $data['phone'],
            'network' => fazi_network($data['code']),
            'plan_type' => 'VTU',
            'bypass' => false,
            'request-id' => $this->generateReference()
        ];
        // return $this->getHeader();
        $response = Http::withHeaders([
            'Authorization' => $this->getHeader(),
            'Content-Type' => 'application/json'
        ])->post($this->baseurl.'/topup', $formdata);

        return $response;
        
    }
    // buy data
    public function buyData($data)
    {
        $formdata = [
            'data_plan' => $data['plan'],
            'phone' => $data['phone'],
            'network' => fazi_network($data['network']),
            'bypass' => false,
            'request-id' => $this->generateReference()
        ];
        $response = Http::withHeaders([
            'Authorization' => $this->getHeader(),
            'Content-Type' => 'application/json'
        ])->post($this->baseurl.'/data', $formdata);

        return $response;
        
    }
    // cable sub
    public function buyCablesub($data)
    {
        $formdata = [
            'amount' => $data['amount'],
            'phone' => $data['phone'],
            'serviceID' => $data['service'],
            'plan' => $data['plan'],
            'api' => $this->secretkey,
            'customerID' => $data['customer']
        ];
       
        $response = Http::withHeaders([
            'api' => 'Bearer '.$this->secretkey,
            'Authorization' => 'Bearer '.$this->secretkey
        ])->asMultipart()->post($this->baseurl.'/pay/', $formdata);

        return $response;
        
    }
    // power 
    public function buyPower($data)
    {
        $formdata = [
            'amount' => $data['amount'],
            'phone' => $data['phone'],
            'serviceID' => $data['service'],
            'api' => $this->secretkey,
            'customerID' => $data['customer']
        ];
       
        $response = Http::withHeaders([
            'api' => 'Bearer '.$this->secretkey,
            'Authorization' => 'Bearer '.$this->secretkey
        ])->asMultipart()->post($this->baseurl.'/pay/', $formdata);

        return $response;
        
    }

    //generate Pins
    public function buyGeneratePins($data)
    {
        $formdata = [
            'network' => $data['network'],
            'value' => $data['value'],
            'number' => $data['quantity'],
            'api' => $this->secretkey
        ];
       
        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.$this->secretkey
        ])->asMultipart()->post('https://gsubz.com/apiV2/generate/', $formdata);
        
        return $response;
        
    }
}