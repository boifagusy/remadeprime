<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\Mdeposit;
use App\Models\NetworkTrx;
use App\Models\Page;
use App\Models\Transaction;
use App\Models\User;
use Artisan;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Str;

class AdminController extends Controller
{
    //
    function index(){
        $users = User::whereBlocked(0)->whereUserRole('user')->orderByDesc('id')->get();
        $deposit = Deposit::orderByDesc('id')->get();
        $mpayment = Mdeposit::orderByDesc('id')->get();
        $networktrx = NetworkTrx::orderByDesc('id')->get();
        $transactions = Transaction::orderByDesc('id')->get();
        return view('admin.index', compact('users','deposit','mpayment','transactions','networktrx'));
    }
    function login(){
        // check if admin loggedin and show login page
        return view('admin.login');
    }
    // Profile
    function profile(){
        return view('admin.profile');
    }
    function update_profile (Request $request){

        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        
        if($request->password != null){
            $user->password = Hash::make($request->password);        
        }
        $user->save();
        return back()->withSuccess(__('Profile Updated Successfully.'));
    }

    // Pages
    public function pages ()
    {
        $pages = Page::all();
        return view('admin.pages.index' ,compact('pages'));
    }
    public function create_page ()
    {
        return view('admin.pages.create');
    }
    public function store_page(Request $request)
    {
        $page = new Page();
        $page->title = $request->title;
        $page->content = $request->content;
        $page->type = "custom";
        $page->slug = Str::slug($request->slug);   
        $page->save();
        return redirect()->route('admin.pages.index')->withSuccess(__('Page Created Successfully'));
    }
    public function edit_page ($id)
    {
        $page = Page::findorFail($id);
        return view('admin.pages.edit' ,compact('page'));
    }
    public function update_page ($id, Request $request)
    {
        if(Page::where('id','!=', $id)->where('slug', $request->slug)->first() == null){
            $page = Page::findorFail($id);
            $page->title = $request->title;
            $page->content = $request->content;
            $page->slug = Str::slug($request->slug);
            $page->save();
            return redirect()->route('admin.pages.index')->withSuccess(__("Page updated successfully"));
        }    
    	return redirect()->back()->withError(__('Slug has been used. Try again'));
    }
    function delete_page($id)
    {
        $page = Page::findOrFail($id);
        if($page->type != "custom") {
            return back()->withError('Something Went Wrong');
        }
        $page->delete();
        return back()->withSuccess('Page deleted successfully');
    }

    // Users
    public function users()
    {
        $users = User::where('user_role' ,'user')->whereBlocked(0)->orderByDesc('id')->get();
        return view('admin.user.index', compact('users'));
    }
    public function user_settings()
    {
       return view('admin.user.settings');
    }
    public function ban_user($id,$status)
    {
        $user = User::findorFail($id);
        $user->suspend = $status;
        $user->save();
        return redirect()->back()->withSuccess(__('User updated Successfully.'));
    }
    public function delete_user($id)
    {
        $user = User::findorFail($id);
        $user->blocked = 1;
        $user->save();
        return redirect()->back()->withSuccess(__('User deleted Successfully.'));
    }    
    function view_user ($id){
        $user = User::findorFail($id);
        return view('admin.user.view', compact('user'));
    }
    function update_user_balance ($id, Request $request){
        $this->validate($request, [
            'amount' => 'required|numeric|min:0',
            'type' => 'required',
            'message' => 'required'
        ]);
        $user = User::findorFail($id);
        if($request->type == 1){
            // create transaction
            $trans = new Transaction();
            $trans->user_id = $user->id;
            $trans->type = 1; // 1- credit, 2- debit, 3-others
            $trans->code = \getTrxcode(14);
            $trans->message = $request['message'];
            $trans->amount = $request->amount; 
            $trans->status = 1; 
            $trans->charge = 0; 
            $trans->service = 9; 
            $trans->old_balance = $user->balance; 
            $trans->new_balance = $user->balance + $request->amount; 
            $trans->save();
            // Add User Balance
            $user->balance =  $trans['new_balance'];
            $user->save();

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
        } else{
            // create transaction
            $trans = new Transaction();
            $trans->user_id = $user->id;
            $trans->type = 2; // 1- credit, 2- debit, 3-others
            $trans->code = \getTrxcode(14);
            $trans->message = $request['message'];
            $trans->amount = $request->amount; 
            $trans->status = 1; 
            $trans->charge = 0; 
            $trans->service = 9; 
            $trans->old_balance = $user->balance; 
            $trans->new_balance = $user->balance - $request->amount; 
            $trans->save();
            // Add User Balance
            $user->balance =  $trans['new_balance'];
            $user->save();

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
        }
        return redirect()->back()->withSuccess(__('User updated Successfully.'));        
    }
    function update_user ($id, Request $request){
        $user = User::findorFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->phone = $request->phone;
        $user->address = $request->address;
        // $user->balance = $request->balance;
        if($request->password != null){
            $user->password = Hash::make($request->password);        
        }
        $user->save();
        return redirect()->back()->withSuccess(__('User updated Successfully.'));        
    }
    function user_referral ($id){
        $user = User::findorFail($id);
        $referrals = User::orderByDesc('id')->whereRefId($user->id)->get();
        return view('admin.user.referral', compact('referrals','user'));
    }
    function user_deposit ($id){
        $user = User::findorFail($id);
        $deposits = Deposit::orderByDesc('id')->whereUserId($user->id)->get();
        return view('admin.user.deposits', compact('deposits','user'));
    }
    function user_trx ($id){
        $user = User::findorFail($id);
        $trx = Transaction::orderByDesc('id')->whereUserId($user->id)->get();
        return view('admin.user.trx', compact('trx','user'));
    }
    // Clear cache
    public function clearCache()
    {
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('route:clear');
        Artisan::call('view:clear');
        return back()->withSuccess('Cache Cleared Successfully.');
    }
}
