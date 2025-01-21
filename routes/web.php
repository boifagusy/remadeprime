<?php

use App\Http\Controllers\{
    BillController,
    DeveloperController,
    HomeController,
    PaymentController,
    UserController
};
use App\Http\Controllers\Auth\{
    LoginController,
    RegisterController
};
use App\Http\Controllers\Back\AdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['verify' => true]);
Route::get('admin/login', [AdminController::class, 'login'])->name('admin.login');
// Auth pages
Route::controller(LoginController::class)->middleware('maintenance')->group(function(){
    Route::get('/login', 'user_login')->name('login');
    Route::get('/user/login', 'user_login')->name('user.login');
    Route::post('/user/login', 'submit_login')->name('user.login');
    
});
// Register
Route::controller(RegisterController::class)->middleware('maintenance')->group(function(){
    Route::get('/register', 'user_register')->name('register');
    Route::get('/user/register', 'user_register')->name('user.register');
    Route::post('/user/register', 'register')->name('user.register');
});
Route::controller(HomeController::class)->middleware('maintenance')->group(function(){
    Route::get('/', 'index')->name('index');
    Route::get('/home', 'index')->name('home');
    Route::get('/logout', 'logout')->name('logout');
    Route::get('/policy', 'policy')->name('policy');
    Route::get('/terms', 'terms')->name('terms');
    Route::get('/page/{slug}', 'pages')->name('page');
    Route::get('/contact', 'contact_us')->name('contact');
    Route::post('/contact', 'send_contact')->name('contact');
    Route::get('/services', 'services')->middleware('user')->name('services');
});
// Bills Payment
Route::prefix('bills')->controller(BillController::class)->as('bills.')->middleware('auth','suspend','verified','maintenance')->group(function(){
    Route::get('/', 'bills')->name('index');
    // data
    Route::get('/data', 'data')->name('data');
    Route::get('/data/{slug}', 'data_plan')->name('data.plan');
    Route::post('/buydata', 'buy_dataplan')->name('data.buyplan');
    // airtime
    Route::get('/airtime', 'airtime')->name('airtime');
    Route::post('/airtime', 'buy_airtime')->name('airtime.buy');
    // cable tv
    Route::get('/cable', 'cabletv')->name('cable');
    Route::post('/cable', 'buy_cabletv')->name('cable.buy');
    Route::get('/cable/{slug}', 'cabletv_packages')->name('cable.plan');
    // electricity
    Route::get('/electricity', 'electricity')->name('electricity');
    Route::post('/electricity', 'buy_electricity')->name('buypower');
    // educationn
    Route::get('/education', 'education')->name('education');
    Route::post('/education', 'buy_education')->name('education');
    // bulksms
    Route::post('/bulksms', 'send_bulksms')->name('bulksms');
    Route::get('/bulksms', 'bulksms')->name('bulksms');
    // recharge pins
    Route::get('/recharge-pins', 'recharge_pins')->name('airtimepin');
    Route::post('/recgarge-pins', 'generate_recharge_pins')->name('cardpin');
    // airtime swap
    Route::get('/airtime-cash', 'airtime_cash')->name('a2c');
    Route::post('/airtime-swap', 'airtime_swap')->name('airtime_swap');
});
// User Routes
Route::middleware('user','verified','maintenance')->as('user.')->controller(UserController::class)->group(function(){
    Route::get('/user', 'dashboard')->name('index');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::get('/setting', 'setting')->name('setting');
    Route::get('/profile', 'profile')->name('profile');
    Route::post('change-pin','change_pin')->name('change_pin');
    Route::post('profile','update_profile')->name('profile.update');
    Route::post('password','update_password')->name('password.update');

    Route::get('/transactions', 'transactions')->name('transactions');
    Route::get('/referral', 'referrals')->name('referral');
    Route::post('referral','referral_withdraw')->name('referral.withdraw');
    Route::get('/wallet', 'wallet')->name('wallet');
    Route::post('/wallet/fund', 'fund_wallet')->name('wallet.fund');
    Route::post('/wallet/manual', 'manual_payment')->name('wallet.bank');
    Route::get('/deposits', 'deposits')->name('deposit');
    Route::get('/bank-accounts', 'bank_accounts')->name('accounts');
    Route::get('/bank', 'generate_bank')->name('generate.account');

    // Transaction logs
    Route::get('/airtime-swap/logs', 'swap_logs')->name('swap.logs');
    Route::get('/vouchers', 'printed_cards')->name('vouchers.logs');
    Route::get('/cards/{id}', 'view_voucher')->name('voucher.view');
    Route::get('/airtime/logs', 'airtime_logs')->name('airtime.logs');
    Route::get('/data/logs', 'data_logs')->name('data.logs');
    Route::get('/power/logs', 'power_logs')->name('power.logs');
    Route::get('/cable/logs', 'decoder_logs')->name('cable.logs');
    Route::get('/education/logs', 'education_logs')->name('education.logs');
    Route::get('/bulk-sms', 'transactions')->name('sms.logs');
    
});
// Developers API
Route::prefix('developer')->controller(DeveloperController::class)->as('developer.')->middleware('auth','verified')->group(function(){
    Route::get('/', 'bills')->name('index');
    Route::get('/data', 'data')->name('data');
    Route::get('/data/{slug}', 'data_plan')->name('data.plan');
    Route::get('/airtime', 'airtime')->name('airtime');
    Route::post('/airtime', 'buy_airtime')->name('airtime.buy');
    Route::get('/cable', 'cabletv')->name('cable');
    Route::get('/electricity', 'electricity')->name('electricity');
    Route::get('/education', 'education')->name('education');
    Route::get('/bulksms', 'bulksms')->name('bulksms');
    Route::get('/card-print', 'print_card')->name('airtimepin');
    Route::get('/airtime-cash', 'airtime_cash')->name('a2c');
});

// Payment Callback
Route::controller(PaymentController::class)->group(function(){
    Route::get('/paystack/success/', 'paystack_success')->name('paystack.success');
    Route::get('/flutter/success/', 'flutter_success')->name('flutter.success');
    Route::get('/monnify/success/', 'monnify_success')->name('monnify.success');
    Route::get('/strowallet/success/', 'strowallet_success')->name('strowallet.success');
});

Route::get('/maintenance', [HomeController::class, 'maintenance'])->name('maintenance');
// Route::get('/sw.js', [HomeController::class, 'service_worker'])->name('sw');

// logout
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
