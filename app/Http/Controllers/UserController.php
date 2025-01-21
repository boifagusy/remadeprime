<?php

namespace App\Http\Controllers;

use App\Models\DecoderTrx;
use App\Models\Deposit;
use App\Models\EduTrx;
use App\Models\Mdeposit;
use App\Models\NetworkTrx;
use App\Models\PowerTrx;
use App\Models\RechargePin;
use App\Models\Transaction;
use App\Models\User;
use App\Utility\MonnifyUtility;
use App\Utility\StrowalletUtility;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Str;

class UserController extends Controller
{
    public function dashboard(){
        $transactions = Transaction::whereUserId(Auth::user()->id)->orderByDesc('updated_at')->limit(20)->get();
        return view('user.index', \compact('transactions'));
    }

    // Settings
    public function setting(){
        return view('user.setting');
    }
    public function profile(){
        return view('user.profile');
    }
    function update_profile(Request $request){
        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'address' => 'nullable|string',
        ]);
        // return $request;
        $user = Auth::User();
        $user->name = $request->name;
        // check if no user exists with the email and then save
        if(user::where('id','!=', $user->id)->where('phone', $request->phone)->first() == null){
            $user->phone = $request->phone;
        }else{
            return redirect()->back()->withError('Phone Number has been used');
        }
        $user->address = $request->address;
        $user->save();
        return redirect()->back()->withSuccess('Profile updated successfully');
    }
    function update_password(Request $request){
        $request->validate([
            'old_password' => 'required|string|min:5',
            'new_password' => 'required|string|min:5'
        ]);
        $user = Auth::User();
        // check if pssword matches
        if(Hash::check($request->old_password, $user->password)){
            $user->password = Hash::make($request->new_password);
            $user->save();
            return redirect()->back()->withSuccess('Password successfully changed');
        }
        return redirect()->back()->withError('Old Password is incorrect');        
    }
    // transactions
    public function transactions(){
        $transactions = Transaction::whereUserId(Auth::user()->id)->orderByDesc('updated_at')->get();
        return view('user.transactions', \compact('transactions'));
    }
    // Referrals
    public function referrals(){
        return view('user.referrals');
    }
    public function referral_withdraw(Request $request){
        $request->validate([
            'amount' => 'required|numeric'
        ]);
        $user = Auth::user();
        if ($user->bonus < $request->amount){
            return back()->with('error', 'You dont have enough funds in your referral bonus to withdraw');
        }
        $user->bonus = $user->bonus - $request->amount;
        $user->balance = $user->balance + $request->amount;
        $user->save();
         // create transaction
        $trans = new Transaction();
        $trans->user_id = $user->id;
        $trans->type = 1; // 1- credit, 2- deit, 3-others
        $trans->code = getTrxcode(14);
        $trans->message = "Referral bonus withdrawal";
        $trans->amount = $request->amount; 
        $trans->status = 1; 
        $trans->charge = 0; 
        $trans->service = 10; // bills
        $trans->old_balance = $user->balance - $request->amount; 
        $trans->new_balance = $user->balance; 
        $trans->save();
        // send trx email
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
        return back()->with('success', 'Bonus Converted Successfully');
    }
    // Wallet
    public function wallet(){
        $deposits = Deposit::whereUserId(Auth::user()->id)->orderByDesc('id')->get();
        $banks = Auth::user()->virtual_banks;
        $banks = \json_decode($banks);

        return view('user.wallet', \compact('deposits','banks'));
    }
    public function fund_wallet(Request $request){
        // validate
        $request->validate([
            'amount' => 'required|min:1',
            'gateway' => 'required|string',
        ]);
        $payment = new PaymentController; 
        $user = Auth::user();        
        $details['amount'] = $request->amount;
        $details['name'] = $user->name;
        $details['user_id'] = $user->id;
        $details['phone'] = $user->phone;
        $details['description'] = "Wallet Funding Payment";
        $details['gateway'] = $request->gateway;
        $details['email'] = $user->email;
        // add data to session
        $request->session()->put('payment_data', $details);
        if($request->gateway == "paystack"){
            $details['final'] = $details['amount'] + ( (sys_setting('card_fee')* $request->amount )/100);
            return $payment->initPaystack($request, $details);
        }elseif($request->gateway == "flutter"){
            $details['final'] = $details['amount'] + ( (sys_setting('card_fee')* $request->amount )/100);
            return $payment->initFlutter($request, $details);
        }elseif($request->gateway == "monnify"){
            $details['final'] = $details['amount'] + ( (sys_setting('card_fee')* $request->amount )/100);
            return $payment->initMonnify($request, $details);
        }elseif($request->gateway == "bank"){
            $details['final'] = $details['amount'] - sys_setting('bank_fee');
            $request->session()->put('payment_data', $details);
            return view('payment.bank', compact('details'));
        }elseif($request->gateway == "strowallet"){
            $details['final'] = $details['amount'] + ( (sys_setting('card_fee')* $request->amount )/100);
            return $payment->initStrowallet($request, $details);
        }
        return back()->withError('Invalid request. Please try again');
    }
    
    function complete_walletDeposit($details)
    {
        $user = Auth::user();
        // save to deposit
        $deposit = new Deposit();
        $deposit->user_id = $details['user_id'];
        $deposit->type = 'card'; // 1- event, 2- form, 3-vote
        $deposit->gateway = $details['gateway'];
        $deposit->trx = $details['reference'];            
        $deposit->message = $details['description'];
        $deposit->amount = $details['amount']; 
        $deposit->status = 1; 
        $deposit->save();
        // create transaction
        $trans = new Transaction();
        $trans->user_id = $details['user_id'];
        $trans->type = 1; // 1- credit, 2- debit, 3-others
        $trans->code = \getTrxcode(14);
        $trans->message = $details['description'];
        $trans->amount =$details['amount']; 
        $trans->status = 1; 
        $trans->charge = 0; 
        $trans->service = 9; 
        $trans->old_balance = $user->balance; 
        $trans->new_balance = $user->balance + $details['amount']; 
        $trans->save();
        // Add User Balance
        $user->balance =  $trans['new_balance'];
        $user->save();

        // send email
        // send pending withdrawal email
        if(\sys_setting('trx_email') == 1 && $user->email_notify == 1){
            \send_emails($user->email, 'DEPOSIT_EMAIL', 
            [
                'username' => $user['username'],
                'amount' => \format_price($deposit->amount),
                'method' => $deposit['gateway'],
                'date' => $trans->created_at
            ]);
        }
        return redirect()->route('user.wallet')->withSuccess('Payment was successful'); 
    }
    // Deposits
    public function deposits(){
        return view('user.deposits');
    }

    // Manual PAyment
    function manual_payment(Request $request)
    {
        $details = $request->session()->get('payment_data');
        $user = Auth::user();
        $request->validate([
            'document' => 'required|mimes:png,jpg,jpeg',
            'name' => 'required|string',
        ]);
        $mpayment = new Mdeposit();
        $mpayment->user_id = $user->id;
        $mpayment->name = $request->name;
        $mpayment->amount = $details['amount'];
        $mpayment->code = getTrx(10);
        $mpayment->message = $details['description'];
        // upload document
        if ($request->hasFile('document')){
            $document = $request->file('document');
            $name = Str::random(22).'.jpg';  
            $document->move(public_path('uploads/payment'),$name);
            $mpayment->image = "payment/".$name;
        }
        $mpayment->status =2;
        $mpayment->save();
        return redirect()->route('user.wallet')->withSuccess("Your Payment has been submited. Wallet will be funded once your payment has been confirmed by the admin"); 
    }
    function complete_AutobankDeposit($details)
    {
        $user = User::where('virtual_ref', $details['reference'])->first();
       
        if($user == null){
            return 'wrong user';
        }
        // save to deposit
        $deposit = new Deposit();
        $deposit->user_id = $user->id;
        $deposit->type = 'bank'; // 1- event, 2- form, 3-vote
        $deposit->gateway = "autobank";
        $deposit->trx = \getTrxcode(14);            
        $deposit->message = "Autobank wallet funding";
        $deposit->amount = $details['amount'] - \sys_setting('auto_fee'); 
        $deposit->status = 1; 
        $deposit->save();
        // create transaction
        $trans = new Transaction();
        $trans->user_id = $user->id;
        $trans->type = 1; // 1- credit, 2- debit, 3-others
        $trans->code = \getTrxcode(14);
        $trans->message = $deposit['message'];
        $trans->amount = $deposit['amount']; 
        $trans->status = 1; 
        $trans->charge = 0; 
        $trans->service = 9; 
        $trans->old_balance = $user->balance; 
        $trans->new_balance = $user->balance + $deposit['amount']; 
        $trans->save();
        // Add User Balance
        $user->balance =  $trans['new_balance'];
        $user->save();

        // send email
        if(\sys_setting('trx_email') == 1 && $user->email_notify == 1){
            \send_emails($user->email, 'DEPOSIT_EMAIL', 
            [
                'username' => $user['username'],
                'amount' => \format_price($deposit->amount),
                'method' => "autobank",
                'date' => $trans->created_at
            ]);
        }
        return "success"; 
    }
    // Accounts
    public function bank_accounts(){

        if(Auth::user()->virtual_ref == null){
            try {
                $this->generate_bank();
            } catch (\Exception $e) {
            // dd($e);
                return redirect()->route('user.wallet')->withSuccess('Virtual Account not Generated');
            }
        }
        $banks = Auth::user()->virtual_banks;
        $banks = \json_decode($banks);
        return view('user.bank', \compact('banks'));
    }
    // generate bank accout
    function generate_bank()
    {
        $user = Auth::user();
        $strowallet = new StrowalletUtility();
        $data = [
            'email' => $user['email'],
            'phone' => $user['phone'],
            'name' => $user['name'],
            'reference' => $user['username'].\getTrx(4)
        ];
        $response = $strowallet->reserveAccount($data);
        $banks = [
            'bankName' => $response['bank_name'] ,
            'accountName'  => $response['account_name'], 
            'accountNumber' => $response['account_number']
        ];
        $banks = \json_encode($banks);
        if($response['success'] == 'true'){
            $user->virtual_ref = $response['account_number'];
            $user->virtual_banks = $banks;
            $user->save();
            return;
        }else{
            return;
        }
        // return redirect()->route('user.wallet')->withSuccess('Virtual Account Generated');
    }

    // report logs
    function airtime_logs()
    {
        $trx = NetworkTrx::whereUserId(Auth::user()->id)->whereType(1)->orderByDesc('id')->get();
        return view('user.report.airtime', compact('trx'));
    }
    function data_logs()
    {
        $trx = NetworkTrx::whereUserId(Auth::user()->id)->whereType(2)->orderByDesc('id')->get();
        return view('user.report.data', compact('trx'));
    }
    function swap_logs()
    {
        $trx = NetworkTrx::whereUserId(Auth::user()->id)->whereType(3)->orderByDesc('id')->get();
        return view('user.report.swap', compact('trx'));
    }
    function power_logs()
    {
        $trx = PowerTrx::whereUserId(Auth::user()->id)->orderByDesc('id')->get();
        return view('user.report.power', compact('trx'));
    }
    function decoder_logs()
    {
        $trx = DecoderTrx::whereUserId(Auth::user()->id)->orderByDesc('id')->get();
        return view('user.report.decoder', compact('trx'));
    }
    function education_logs()
    {
        $trx = EduTrx::whereUserId(Auth::user()->id)->orderByDesc('id')->get();
        return view('user.report.education', compact('trx'));
    }
    function printed_cards()
    {
        $trx = RechargePin::whereUserId(Auth::user()->id)->orderByDesc('id')->get();
        
        return view('user.report.voucher', compact('trx'));
    }
    function view_voucher($id)
    {
        $trx = RechargePin::whereUserId(Auth::user()->id)->where('id', $id)->first();
        if(!$trx){
            return back()->withError('Invalid request. Dont be a thief');
        }
        $pins = \json_decode($trx->pins);
        return view('user.report.pins', compact('trx', 'pins'));
    }
}
