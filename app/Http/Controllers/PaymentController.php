<?php

namespace App\Http\Controllers;

use App\Utility\MonnifyUtility as Monnify;
use App\Utility\StrowalletUtility as Strowallet;
use Bhekor\LaravelFlutterwave\Facades\Flutterwave;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Paystack;

class PaymentController extends Controller
{
     /**
     * Redirect the User to Paystack Payment Page
     * @return Url
     */
    public function initPaystack(Request $request, $details)
    {
        // return $details;
		$callback =  route('paystack.success');
        // $baseUrl = "https://api.paystack.co";
        // $paystack = new Paystack(env('PAYSTACK_SECRET_KEY'), $baseUrl);        
        $request->email = $details['email'];
        $request->amount = $details['final'] *100;
        $request->currency = get_setting('currency_code');
        $request->reference = Paystack::genTranxRef();
        $request->callback_url= $callback ;
        // dd($request);
        $details['reference'] = $request->reference;
        $request->session()->put('payment_data', $details);
        return Paystack::getAuthorizationUrl()->redirectNow();
    }

    public function initFlutter (Request $request, $details){
        $reference = Flutterwave::generateReference();
        // Enter the details of the payment
        $data = [
            'payment_options' => 'card,banktransfer',
            'amount' => $details['final'],
            'email' => $details['email'],
            'tx_ref' => $reference,
            'currency' =>get_setting('currency_code'),
            'redirect_url' => route('flutter.success'),
            'customer' => [
                'email' => $details['email'],
                "phone_number" => $details['phone'],
                "name" => $details['name']
            ],
        ];
        
        $details['reference'] = $reference;
        $request->session()->put('payment_data', $details);
        // dd($data);
        $payment = Flutterwave::initializePayment($data);
        if ($payment['status'] !== 'success') {
            // notify something went wrong
            return;
        }
        return redirect($payment['data']['link']);
        // return $details;
    }
    
    public function initMonnify (Request $request, $details){
        $monnify = new Monnify();
        $reference = $monnify->generateReference();
        $details['reference'] = $reference;
        $request->session()->put('payment_data', $details);
        // init transfer
        $data = [
            'amount' => $details['final'],
            'email' => $details['email'],
            'name' => $details['name'],
            'reference' => $reference,
            'currency' =>get_setting('currency_code'),
            'redirectUrl' => route('monnify.success'),
            'description' => $details['description'],
        ];
        $response =  $monnify->initializePayment($data);
        
        if ($response['responseMessage'] !== 'success' && $response['requestSuccessful'] !== 'true') {
            // notify something went wrong
            return;
        }
        // return $response;
        return redirect($response['responseBody']['checkoutUrl']);
    }
    public function initStrowallet (Request $request, $details){
       
        $strowallet = new Strowallet();
        $reference = $strowallet->generateReference();
        $details['reference'] = $reference;
        $request->session()->put('payment_data', $details);
        // init transfer
        $data = [
            'amount' => $details['final'],
            'email' => $details['email'],
            'name' => $details['name'],
            'reference' => $reference,
            'currency' =>get_setting('currency_code'),
            'cancel_url' => route('user.wallet'),
            'success_url' => route('strowallet.success'),
            'details' => $details['description'],
        ];
        $response =  $strowallet->initializePayment($data);
        
        if ($response['error'] !== 'ok') {
            // notify something went wrong
            return;
        }
        // return $response;
        return redirect($response['url']);
    }

    // Flutterwave success
    public function flutter_success(Request $request)
    {
        $status = request()->status;
        $details = $request->session()->get('payment_data');

        //if payment is successful
        if ($status ==  'successful') {        
            $transactionID = Flutterwave::getTransactionIDFromCallback();
            $payment = Flutterwave::verifyTransaction($transactionID);
            // redirect to success url
            $complete = new UserController();
            return $complete->complete_walletDeposit($details); 
        }
        elseif ($status ==  'cancelled'){            
            $request->session()->remove('payment_data');
            return redirect()->route('user.wallet')->withError('Payment not successful'); 
        }
        else{            
            $request->session()->remove('impt_data');
            $request->session()->remove('payment_data');
            return redirect()->route('index')->withError('Payment was not Successfull. Please try again');
        }
        
	}
    // monnify success
    public function monnify_success(Request $request)
    { 
        $details = $request->session()->get('payment_data');

        $data = $request->all();
        $monnify = new Monnify();
        $response = $monnify->verifyTransaction($data);
        
        if($response['responseMessage'] == 'success'){
           
            $complete = new UserController();
            return $complete->complete_walletDeposit($details); 
        }
        else {
            $request->session()->remove('payment_data');
            return redirect()->route('user.wallet')->withError('Payment not successful');  
        }
    }

    // Paystack Success
    public function paystack_success(Request $request)
    {
        $payment = Paystack::getPaymentData();
        // dd($payment);                
        $details = $request->session()->get('payment_data');
        if(!empty($payment['data']) && $payment['data']['status'] == 'success'){
            // return success url
            $complete = new UserController();
            return $complete->complete_walletDeposit($details); 
        }
        else{
            $request->session()->remove('payment_data');
            return redirect()->route('user.wallet')->withError('Payment not successful'); 
        }
    }

    // strowallet success
    public function strowallet_success(Request $request)
    { 
        $details = $request->session()->get('payment_data');
        // return $details;
        
        if($details !== null){
    
            $complete = new UserController();
            return $complete->complete_walletDeposit($details); 
        }
        else {
            $request->session()->remove('payment_data');
            return redirect()->route('user.wallet')->withError('Payment not successful');  
        }
    }


    public function monnify_webhook(Request $request)
    {
        $input = $request->all();
        if($input['eventData']['paymentMethod'] == "ACCOUNT_TRANSFER"){
            $details['amount'] = $input['eventData']['amountPaid'];
            $details['reference'] = $input['eventData']['product']['reference'];
            $details['final'] = $input['eventData']['settlementAmount'];
            
            $complete = new UserController();
            return $complete->complete_AutobankDeposit($details);
        }
        return "success";

    }
    public function strowallet_webhook(Request $request)
    {
        $input = $request->all();
    
        $details['amount'] = $input['transactionAmount'];
        $details['reference'] = $input['accountNumber'];
        $details['final'] = $input['settledAmount'];
        
        $complete = new UserController();
        return $complete->complete_AutobankDeposit($details);
        return "success";

    }
}
