<?php

namespace App\Http\Controllers;

use App\Models\{
    CablePlan,
    DataBundle,
    Decoder,
    DecoderTrx,
    Education,
    EduTrx,
    Electricity,
    Network,
    NetworkTrx,
    PowerTrx,
    RechargePin,
    Transaction
};
use App\Utility\ApiUtility;
use App\Utility\FatiUtility;
use Auth;
use Illuminate\Http\Request;

class BillController extends Controller
{
    //
    public function bills()
    {
        return view('bills.index');
    }
    
    public function data()
    {
        $networks = Network::whereStatus(1)->whereData(1)->get();
        return view('bills.data', compact('networks'));
    }
    public function data_plan($slug)
    {
        $network = Network::whereName($slug)->first();
        if ($network == null){
            abort(404)->withError('Invalid Request. Please Try again');
        }
        $plans = DataBundle::whereNetworkId($network->id)->whereStatus(1)->get();

        return view('bills.dataplan', compact('plans','network'));
    }
    public function buy_dataplan(Request $request)
    {
        // validate requests
        $request->validate([
            'amount' => 'required|numeric',
            'phone' => 'required|digits:11|numeric',
            'plan' => 'required|exists:data_bundles,id'
        ]);
        // return $request;
        $user = Auth::user();
        $plan = DataBundle::findOrFail($request->plan);
        $network = $plan->network;
        if ($user->balance < $plan->price){
            return back()->with('error', 'You dont have enough funds in your wallet to complete this transaction');
        }
        // deduct balance
        $user->balance = $user->balance - $plan->price;
        $user->save();
        // api transaction
        $data = [
            'amount' => $request->amount,
            'phone' => $request['phone'],
            'service' => $plan['service'],
            'plan' => $plan->code,
            'network' => $network->name
        ];
        if(sys_setting('vend_api') == 0){
            $api = new ApiUtility();
            $response = $api->buyData($data);
            if($response['code'] === 200 && $response['status'] == "TRANSACTION_SUCCESSFUL"){
                // create transaction
                $trans = new Transaction();
                $trans->user_id = $user->id;
                $trans->type = 2; // 1- credit, 2- deit, 3-others
                $trans->code = getTrxcode(14);
                $trans->message = $plan->name;
                $trans->amount = $plan->price; 
                $trans->status = 1; 
                $trans->charge = 0; 
                $trans->service = 2; // bills
                $trans->new_balance = $user->balance; 
                $trans->old_balance = $user->balance - $plan->price; 
                $trans->save();
                // Create network Trx
                $trx = new NetworkTrx();
                $trx->user_id = $user->id;
                $trx->network_id = $network->id;
                $trx->type = 2; // 1- airtime, 2- data, 3-swap
                $trx->code = getTrxcode(15);
                $trx->name = $plan->name;
                $trx->amount = $request->amount; 
                $trx->status = 1; //1 - success , 2- pendig, 3 -declined 
                $trx->charge = 0; 
                $trx->number = $request->phone; 
                $trx->old_balance = $user->balance - $plan->price; 
                $trx->new_balance = $user->balance; 
                $trx->save();
                // send trxn email 
                if(\sys_setting('trx_email') == 1 && $user->email_notify == 1){
                    \send_emails($user->email, 'TRX_EMAIL', 
                    [
                        'username' => $user['username'],
                        'code' => $trans->code,
                        'trx_details' => $trans->message,
                        'trx_type' => trans_type2($trans->type),
                        'amount' => format_price($trans['amount']),
                        'date' => $trans->created_at
                    ]);
                }
                // give referral bonus
                if(sys_setting('is_affiliate') == 1){
                    give_affiliate_bonus($user->id, $plan->price);
                }
                return redirect()->route('user.dashboard')->withSuccess($plan->name.' purchase successful for '.$request->phone);
    
            }else{
                // refund user
                $user->balance = $user->balance + $request->amount;
                $user->save();
                // cancel transaction
                return back()->with('error', 'Transaction wasnot successful. Please try again');
            }
        }else{
            $api = new FatiUtility();
            $response = $api->buyData($data);
            if($response['status'] == "success"){
                // create transaction
                $trans = new Transaction();
                $trans->user_id = $user->id;
                $trans->type = 2; // 1- credit, 2- deit, 3-others
                $trans->code = $response['transid'];
                $trans->message = $response['message'];
                $trans->amount = $plan->price; 
                $trans->status = 1; 
                $trans->charge = 0; 
                $trans->service = 2; // bills
                $trans->new_balance = $user->balance; 
                $trans->old_balance = $user->balance - $plan->price; 
                $trans->save();
                // Create network Trx
                $trx = new NetworkTrx();
                $trx->user_id = $user->id;
                $trx->network_id = $network->id;
                $trx->type = 2; // 1- airtime, 2- data, 3-swap
                $trx->code = getTrxcode(15);
                $trx->name = $plan->name;
                $trx->amount = $request->amount; 
                $trx->status = 1; //1 - success , 2- pendig, 3 -declined 
                $trx->charge = 0; 
                $trx->number = $request->phone; 
                $trx->old_balance = $user->balance - $plan->price; 
                $trx->new_balance = $user->balance; 
                $trx->save();
                // send trxn email 
                if(\sys_setting('trx_email') == 1 && $user->email_notify == 1){
                    \send_emails($user->email, 'TRX_EMAIL', 
                    [
                        'username' => $user['username'],
                        'code' => $trans->code,
                        'trx_details' => $trans->message,
                        'trx_type' => trans_type2($trans->type),
                        'amount' => format_price($trans['amount']),
                        'date' => $trans->created_at
                    ]);
                }
                // give referral bonus
                if(sys_setting('is_affiliate') == 1){
                    give_affiliate_bonus($user->id, $plan->price);
                }
                $mess = $response['message'];
                return redirect()->route('user.dashboard')->withSuccess($mess);
    
            }else{
                // refund user
                $user->balance = $user->balance + $request->amount;
                $user->save();
                // cancel transaction
                return back()->with('error', 'Transaction wasnot successful. Please try again');
            }
        }
        
        return back()->with('error', 'Something went wrong. Please try again');
    }
    // airtime
    public function airtime()
    {
        $networks = Network::whereStatus(1)->whereAirtime(1)->get();
        return view('bills.airtime', compact('networks'));
    }
    public function buy_airtime(Request $request)
    {
        // validate requests
        $request->validate([
            'amount' => 'required|numeric|min:100',
            'phone' => 'required|digits:11|numeric',
            'network' => 'required|exists:networks,id',
        ]);
        // return $request;
        $user = Auth::user();
        $network = Network::findOrFail($request->network);
        if ($user->balance < $request->amount){
            return back()->with('error', 'You dont have enough funds in your wallet to complete this transaction');
        }
        // deduct balance
        $user->balance = $user->balance - $request->amount;
        $user->save();
        // api transaction
        $data = [
            'amount' => $request->amount,
            'phone' => $request['phone'],
            'code' => $network['name'],
        ];
        // if(sys_setting('vend_api') == 0){
            $api = new ApiUtility();
            $response = $api->buyAirtime($data);
        // }else{
        //     $api = new FatiUtility();
        //     $response = $api->buyAirtime($data);
        // }
        // return $response;
        if($response['code'] === 200 && $response['status'] == "TRANSACTION_SUCCESSFUL"){
            // create transaction
            $trans = new Transaction();
            $trans->user_id = $user->id;
            $trans->type = 2; // 1- credit, 2- deit, 3-others
            $trans->code = getTrxcode(14);
            $trans->message = "Airtime Purchase of ".format_price($request->amount);
            $trans->amount = $request->amount; 
            $trans->status = 1; 
            $trans->charge = 0; 
            $trans->service = 1; 
            $trans->new_balance = $user->balance; 
            $trans->old_balance = $user->balance - $request->amount; 
            $trans->save();
            // Create network Trx
            $trx = new NetworkTrx();
            $trx->user_id = $user->id;
            $trx->network_id = $network->id;
            $trx->type = 1; // 1- airtime, 2- data, 3-swap
            $trx->code = getTrxcode(15);
            $trx->name = "Airtime Purchase of ".format_price($request->amount);
            $trx->amount = $request->amount; 
            $trx->status = 1; //1 - success , 2- pendig, 3 -declined 
            $trx->charge = 0; 
            $trx->number = $request->phone; 
            $trx->old_balance = $user->balance - $request->amount; 
            $trx->new_balance = $user->balance; 
            $trx->save();
            // send trxn email 
            if(\sys_setting('trx_email') == 1 && $user->email_notify == 1){
                \send_emails($user->email, 'TRX_EMAIL', 
                [
                    'username' => $user['username'],
                    'code' => $trans->code,
                    'trx_details' => $trans->message,
                    'trx_type' => trans_type2($trans->type),
                    'amount' => format_price($trans['amount']),
                    'date' => $trans->created_at
                ]);
            }
            // give referral bonus
            if(sys_setting('is_affiliate') == 1){
                give_affiliate_bonus($user->id, $request->amount);
            }
            return redirect()->route('user.dashboard')->with('success', 'Airtime purchase successful');

        }else{
            // refund user
            $user->balance = $user->balance + $request->amount;
            $user->save();
            // cancel transaction
            return back()->with('error', 'Transaction wasnot successful. Please try again');
        }
        return back()->with('error', 'Something went wrong. Please try again');
    }
    // cable TV
    public function cabletv()
    {
        $decoders = Decoder::whereStatus(1)->get();
        return view('bills.cable', compact('decoders'));
    }
    function cabletv_packages($slug){
        $decoder = Decoder::whereName($slug)->first();
        if ($decoder == null){
            abort(404)->withError('Invalid Request. Please Try again');
        }
        $plans = CablePlan::whereDecoderId($decoder->id)->whereStatus(1)->get();

        return view('bills.cable_buy', compact('plans','decoder'));
    }
    public function buy_cabletv(Request $request)
    {
        // validate requests
        $request->validate([
            'amount' => 'required|numeric',
            'number' => 'required|numeric',
            'package' => 'required|numeric'
        ]);
        $user = Auth::user();
        $plan = CablePlan::findOrFail($request->package);
        $decoder = $plan->decoder; 
        if ($user->balance < $plan->price){
            return back()->with('error', 'You dont have enough funds in your wallet to complete this transaction');
        }
        // deduct balance
        $user->balance = $user->balance - $plan->price;
        $user->save();
         // api transaction
        $data = [
            'amount' => $request->amount,
            'phone' => $user->phone,
            'customer' => $request['number'],
            'plan' => $plan->code,
            'service' => $plan->decoder['name']
        ];
        $api = new ApiUtility();
        $response = $api->buyCablesub($data);
        if($response['code'] === 200 && $response['status'] == "TRANSACTION_SUCCESSFUL"){

            // create transaction
            $trans = new Transaction();
            $trans->user_id = $user->id;
            $trans->type = 2; // 1- credit, 2- deit, 3-others
            $trans->code = getTrxcode(14);
            $trans->message = $plan->name;
            $trans->amount = $plan->price; 
            $trans->status = 1; 
            $trans->charge = 0; 
            $trans->service = 5; // cable
            $trans->new_balance = $user->balance; 
            $trans->old_balance = $user->balance - $plan->price; 
            $trans->save();
            // send trxn email 
            if(\sys_setting('trx_email') == 1 && $user->email_notify == 1){
                \send_emails($user->email, 'TRX_EMAIL', 
                [
                    'username' => $user['username'],
                    'code' => $trans->code,
                    'trx_details' => $trans->message,
                    'trx_type' => trans_type2($trans->type),
                    'amount' => format_price($trans['amount']),
                    'date' => $trans->created_at
                ]);
            }
            // Create network Trx
            $trx = new DecoderTrx();
            $trx->user_id = $user->id;
            $trx->decoder_id = $decoder->id;
            $trx->code = getTrxcode(15);
            $trx->name = $plan->name;
            $trx->amount = $plan->price; 
            $trx->status = 1; //1 - success , 2- pending, 3 -declined 
            $trx->charge = 0; 
            $trx->number = $request->number; 
            $trx->old_balance = $user->balance - $plan->price; 
            $trx->new_balance = $user->balance; 
            $trx->save();
            // give referral bonus
            if(sys_setting('is_affiliate') == 1){
                give_affiliate_bonus($user->id, $plan->price);
            }
            return redirect()->route('user.dashboard')->withSuccess($plan->name.' purchase successful');

        }else{
            // refund user
            $user->balance = $user->balance + $request->amount;
            $user->save();
            // cancel transaction
            return back()->with('error', 'Transaction wasnot successful. Please try again');
        }
        return back()->with('error', 'Something went wrong. Please try again');
    }

    public function bulksms()
    {
        return view('bills.bulksms');
    }
    public function send_bulksms(Request $request){
        $request->validate([
            'message' => 'required|string',
            'sender' => 'required|string',
            'recipient' => 'required|string',
        ]);
        $user = Auth::user();
        $amount = 300;
        if ($user->balance < $amount){
            return back()->with('error', 'You dont have enough funds in your wallet to complete this transaction');
        }
        
        return back()->with('error', 'Something went wrong. Please try again');
    }
    
    public function education()
    {
        $education = Education::whereStatus(1)->get();
        return view('bills.education' ,compact('education'));
    }
    public function buy_education(Request $request){
        $request->validate([
            'amount' => 'required|numeric',
            'quantity' => 'required|numeric|min:1',
            'service' => 'required|numeric|exists:education,id'
        ]);
        $user = Auth::user();
        $plan = Education::findOrFail($request->service);
        $cost = $request->quantity * $plan->price;
        if ($user->balance < $cost){
            return back()->with('error', 'You dont have enough funds in your wallet to complete this transaction');
        }
        // deduct balance
        $user->balance = $user->balance - $cost;
        $user->save(); 
        // Api trans
        $response = "pending";
        if($response == 1){
            // create transaction
            $trans = new Transaction();
            $trans->user_id = $user->id;
            $trans->type = 2; // 1- credit, 2- deit, 3-others
            $trans->code = getTrxcode(14);
            $trans->message = $plan->name;
            $trans->amount = $cost; 
            $trans->status = 1; 
            $trans->charge = 0; 
            $trans->service = 6; // education
            $trans->new_balance = $user->balance; 
            $trans->old_balance = $user->balance - $cost; 
            $trans->save();
            // Create Education Trx
            $trx = new EduTrx();
            $trx->user_id = $user->id;
            $trx->education_id = $plan->id;
            $trx->code = getTrxcode(15);
            $trx->quantity = $request->quantity;
            $trx->name = $plan->name;
            $trx->amount = $cost; 
            $trx->status = 1; //1 - success , 2- pending, 3 -declined 
            $trx->charge = 0; 
            $trx->number = $request->number; 
            $trx->old_balance = $user->balance - $cost; 
            $trx->new_balance = $user->balance; 
            $trx->save();
            // send trxn email 
            if(\sys_setting('trx_email') == 1 && $user->email_notify == 1){
                \send_emails($user->email, 'TRX_EMAIL', 
                [
                    'username' => $user['username'],
                    'code' => $trans->code,
                    'trx_details' => $trans->message,
                    'trx_type' => trans_type2($trans->type),
                    'amount' => format_price($trans['amount']),
                    'date' => $trans->created_at
                ]);
            }
            // give referral bonus
            if(sys_setting('is_affiliate') == 1){
                give_affiliate_bonus($user->id, $cost);
            }
            return redirect()->route('user.dashboard')->withSuccess($plan->name.' purchase successful');

        }else{
            // refund user
            $user->balance = $user->balance + $cost;
            $user->save();
            // cancel transaction
            return back()->with('error', 'Transaction wasnot successful. Please try again');
        }
        return back()->with('error', 'Something went wrong. Please try again');
    }
    
    public function airtime_cash()
    {        
        $networks = Network::whereStatus(1)->whereSwap(1)->get();
        return view('bills.a2c', compact('networks'));
    }
    public function airtime_swap(Request $request){
        $request->validate([
            'rate' => 'required|numeric',
            'amount' => 'required|numeric|min:1000',
            'phone' => 'required|numeric|digits:11',
            'network' => 'required|numeric|exists:networks,id'
        ]);
        $user = Auth::user();
        // Save to database
        $network = Network::findOrFail($request->network);
        $trans = new NetworkTrx();
        $trans->user_id = $user->id;
        $trans->network_id = $network->id;
        $trans->type = 3; // 1- airtime, 2- data, 3-swap
        $trans->code = getTrxcode(15);
        $trans->name = "Airtime Swap of ".sym_price($request->amount);
        $trans->amount = $request->amount; 
        $trans->status = 2; //1 - success , 2- pendig, 3 -declined 
        $trans->charge = $request->amount * $network->rate/100; 
        $trans->number = $request->phone; 
        $trans->old_balance = $user->balance; 
        $trans->new_balance = $user->balance; 
        $trans->save();
        $message = 'Your '.$network->name.' Airtime conversion from phone number '.$request->phone.' has been successfully sent to the admin for confirmation.
        The unit price of your airtime will be credited to your deposit balance once we verify your conversion';
        return redirect()->route('user.swap.logs')->with('success', $message);
    }
    
    public function electricity()
    {
        $powers = Electricity::whereStatus(1)->whereDeleted(0)->get();
        return view('bills.electricity', compact('powers'));
    }
    public function buy_electricity(Request $request){
        $request->validate([
            'amount' => 'required|numeric',
            'number' => 'required|numeric',
            'meter' => 'required|numeric',
            'disco' => 'required|numeric|exists:electricities,id'
        ]);
        $user = Auth::user();
        $disco = Electricity::findOrFail($request->disco);
        $cost = $request->amount + $disco->fee;
        if ($disco->minimum > $request->amount){
            return back()->with('error', 'Amount is lower than minimum price '.format_price($disco->minimum));
        }
        if ($user->balance < $request->amount){
            return back()->with('error', 'You dont have enough funds in your wallet to complete this transaction');
        }
        // deduct balance
        $user->balance = $user->balance - $request->amount;
        $user->save();
         // api transaction
        $data = [
            'amount' => $request->amount,
            'phone' => $user['phone'],
            'service' => $disco['code'],
            'customer' => $request->number
        ];
        $api = new ApiUtility();
        $response = $api->buyPower($data);
        if($response['code'] === 200 && $response['status'] == "TRANSACTION_SUCCESSFUL"){

            // create transaction
            $trans = new Transaction();
            $trans->user_id = $user->id;
            $trans->type = 2; // 1- credit, 2- deit, 3-others
            $trans->code = getTrxcode(14);
            $trans->message = $disco->name;
            $trans->amount = $request->amount; 
            $trans->status = 1; 
            $trans->charge = $disco->fee; 
            $trans->service = 7; // electricity
            $trans->new_balance = $user->balance; 
            $trans->old_balance = $user->balance - $request->amount; 
            $trans->save();
            // send trxn email 
            if(\sys_setting('trx_email') == 1 && $user->email_notify == 1){
                \send_emails($user->email, 'TRX_EMAIL', 
                [
                    'username' => $user['username'],
                    'code' => $trans->code,
                    'trx_details' => $trans->message,
                    'trx_type' => trans_type2($trans->type),
                    'amount' => format_price($trans['amount']),
                    'date' => $trans->created_at
                ]);
            }
            // Create network Trx
            $trx = new PowerTrx();
            $trx->user_id = $user->id;
            $trx->electricity_id = $disco->id;
            $trx->code = getTrxcode(15);
            $trx->name = $disco->name;
            $trx->amount = $request->amount; 
            $trx->status = 1; //1 - success , 2- pending, 3 -declined 
            $trx->charge = 0; 
            $trx->number = $request->number; 
            $trx->old_balance = $user->balance - $request->amount; 
            $trx->new_balance = $user->balance; 
            $trx->save();

            // give referral bonus
            if(sys_setting('is_affiliate') == 1){
                give_affiliate_bonus($user->id, $request->amount);
            }

            return redirect()->route('user.dashboard')->withSuccess($disco->name.' purchase successful');

        }else{
            // refund user
            $user->balance = $user->balance + $request->amount;
            $user->save();
            // cancel transaction
            return back()->with('error', 'Transaction wasnot successful. Please try again');
        }
        return back()->with('error', 'Something went wrong. Please try again');
    }

    public function recharge_pins()
    {
        $networks = Network::whereStatus(1)->whereCardpin(1)->get();
        return view('bills.airtimepin', compact('networks'));
    }

    public function generate_recharge_pins(Request $request){
        $request->validate([
            'amount' => 'required|numeric',
            'quantity' => 'required|numeric',
            'network' => 'required|exists:networks,id',
            'value' => 'required|numeric'
        ]);
        $user = Auth::user();
        $cost = $request->value * $request->quantity;
        $network = Network::find($request->network);
        if ($user->balance < $cost){
            return back()->with('error', 'You dont have enough funds in your wallet to complete this transaction');
        }
        // create transaction
        $trans = new Transaction();
        $trans->user_id = $user->id;
        $trans->type = 2; // 1- credit, 2- deit, 3-others
        $trans->code = getTrxcode(14);
        $trans->message = "Recharge card printing";
        $trans->amount = $cost; 
        $trans->status = 2; 
        $trans->charge = 0; 
        $trans->service = 4; 
        $trans->old_balance = $user->balance; 
        $trans->new_balance = $user->balance - $cost; 
        $trans->save();
        // deduct user balance
        $user->balance = $user->balance - $cost;
        $user->save();
        // api transaction
        $data = [
            'network' => $network->name,
            'value' => $request['value'],
            'quantity' => $request->quantity
        ];
        $api = new ApiUtility();
        $response = $api->buyGeneratePins($data);
        if($response['status'] == "success"){
            // create transaction
            $trans->status = 1;
            $trans->save();
            // save pins to database
            $voucher = new RechargePin(); 
            $voucher->user_id = $user->id;
            $voucher->network_id = $network->id; // 1- credit, 2- deit, 3-others
            $voucher->code = $response['id'];
            $voucher->message = "Recharge card printing";
            $voucher->pins = $response['pins'];
            $voucher->amount = $cost; 
            $voucher->cost = $request->amount; 
            $voucher->status = 1; //1 - success , 2- pendig, 3 -declined 
            $voucher->charge = 0; 
            $voucher->quantity = $request->quantity; 
            $voucher->old_balance = $user->balance + $cost; 
            $voucher->new_balance = $user->balance; 
            $voucher->save();
            // send trxn email 
            if(\sys_setting('trx_email') == 1 && $user->email_notify == 1){
                \send_emails($user->email, 'TRX_EMAIL', 
                [
                    'username' => $user['username'],
                    'code' => $trans->code,
                    'trx_details' => $trans->message,
                    'trx_type' => trans_type2($trans->type),
                    'amount' => format_price($trans['amount']),
                    'date' => $trans->created_at
                ]);
            }
            return redirect()->route('user.voucher.view', $voucher->id)->with('success', 'Recharge Pins generated Successfully');
            // return back()->with('success', 'Recharge Pins generated Successfully');

        }else{
            // refund user
            $user->balance = $user->balance + $cost;
            $user->save();
            // cancel transaction
            $trans->status = 3;
            $trans->save();
            return back()->with('error', 'Transaction wasnot successful. Please try again');
        }
        return back()->with('error', 'Something went wrong. Please try again');
    }

}
