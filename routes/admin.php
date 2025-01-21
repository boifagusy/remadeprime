<?php

use App\Http\Controllers\Back\{
    AdminController, BillsController, EmailController, SalesController, SettingController, StaffController
};
use App\Http\Controllers\{
    UpdateController
};
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
Route::middleware('admin')->group(function(){

    Route::controller(AdminController::class)->group(function(){
        Route::get('/', 'index')->name('index');
        Route::get('/profile', 'profile')->name('profile');
        Route::post('/profile', 'update_profile')->name('profile');
        Route::get('/logout', 'index')->name('logout');
    });
    // Bills
    Route::controller(BillsController::class)->as('bills.')->group(function(){
        Route::get('/api-setting' , 'api_setting')->name('api_setting');
        Route::get('/airtime/s/{id}/{status}' , 'airtime_status')->name('airtime.status');  //Enable/disable airtime
        Route::post('/airtime/{id}' , 'update_airtime')->name('airtime.update');    //Edit Airtime
        Route::get('/airtime' , 'airtime')->name('airtime');
        // data
        Route::get('/data' , 'internet_data')->name('data');
        Route::get('/data/s/{id}/{status}' , 'datasub_status')->name('data.status'); 
        Route::get('/data/plans/{id}' , 'manage_dataplans')->name('data.plans');
        Route::post('/data/plan' , 'create_dataplan')->name('dataplan.create');
        Route::post('/data/plan/e/{id}' , 'edit_dataplan')->name('dataplan.edit');
        Route::get('/dataplan/s/{id}/{status}' , 'dataplan_status')->name('dataplan.status'); 
        // cabletv
        Route::get('/cabletv' , 'cabletv')->name('cabletv');
        Route::get('/cabletv/s/{id}/{status}' , 'cabletv_status')->name('cabletv.status'); 
        Route::get('/cabletv/plans/{id}' , 'manage_cabletvplans')->name('cabletv.plans');
        Route::post('/cabletv/plan' , 'create_cabletvplan')->name('cabletv.create');
        Route::post('/cabletv/plan/e/{id}' , 'edit_cabletvplan')->name('cabletv.edit');
        Route::get('/cableplan/s/{id}/{status}' , 'cableplan_status')->name('cableplan.status'); 
        // electricity
        Route::get('/electricity' , 'electricity')->name('electricity');
        Route::get('/power/s/{id}/{status}' , 'electricity_status')->name('power.status'); 
        Route::post('/power/plan' , 'create_electricity')->name('power.create');
        Route::post('/power/plan/e/{id}' , 'edit_electricity')->name('power.edit');
        // bulksms
        Route::get('bulksms', 'bulksms')->name('bulksms');
        // Airtime swap
        Route::get('/airtime-swap/s/{id}/{status}' , 'airtimeswap_status')->name('swap.status');  //Enable/disable airtime
        Route::post('/airtime-swap/{id}' , 'update_airtimeswap')->name('swap.update');    //Edit Airtime
        Route::get('/airtime-swap' , 'airtime_swap')->name('swap');
        // Recharge pins
        Route::get('/rechargepin/s/{id}/{status}' , 'rechargepin_status')->name('cards.status');  //Enable/disable airtime
        Route::post('/recharge-pin/{id}' , 'update_rechargepin')->name('cards.update');    //Edit Airtime
        Route::get('/recharge-pins' , 'recharge_pins')->name('cards');
        // Education
        Route::get('education', 'education')->name('education');  //Enable/disable 
        Route::post('/edu/{id}' , 'update_education')->name('education.update');   
        Route::get('/edu/s/{id}/{status}' , 'education_status')->name('education.status');
        
    });
    // Users
    Route::controller(AdminController::class)->as('users.')->prefix('users')->group(function(){
        Route::get('/' , 'users')->name('index');
        Route::get('/view/{id}' , 'view_user')->name('view');
        Route::get('/edit/{id}' , 'edit_user')->name('edit');
        Route::get('/withdrawals/{id}' , 'user_withdraw')->name('withdrawals');
        Route::get('/deposits/{id}' , 'user_deposit')->name('deposits');
        Route::get('/deposits/pay/{id}' , 'user_deposit_pay')->name('manual.pay');
        Route::get('/deposits/delete/{id}' , 'user_deposit_delete')->name('manual.delete');
        Route::get('/referrals/{id}' , 'user_referral')->name('referrals');
        Route::get('/transactions/{id}' , 'user_trx')->name('transactions');
        Route::get('/delete/{id}' , 'delete_user')->name('delete');
        Route::get('/ban/{id}/{status}' , 'ban_user')->name('ban');
        Route::post('/edit/{id}' , 'update_user')->name('update');
        Route::post('/balance/{id}' , 'update_user_balance')->name('balance');
        Route::get('/settings' , 'user_settings')->name('settings');
    });
    // Sales
    Route::controller(SalesController::class)->group(function(){
        Route::get('/deposits' , 'deposits')->name('deposits');
        Route::get('/manual/deposits' , 'manual_deposits')->name('mdeposits');
        Route::get('/mdeposit/del/{id}' , 'manual_deposits_delete')->name('mdeposit.delete');
        Route::get('/mdeposit/pay/{id}' , 'manual_deposits_pay')->name('mdeposit.pay');
        Route::get('/mdeposit/rej/{id}' , 'manual_deposits_reject')->name('mdeposit.reject');
        Route::get('/transactions' , 'transactions')->name('transactions');
        Route::get('/transactiondetails' , 'transactiondetails')->name('transactiondetails');
    });
    // Reports
    Route::controller(SalesController::class)->prefix('report')->as('reports.')->group(function(){
        Route::get('/data' , 'data_sales')->name('data');
        Route::get('/airtime' , 'airtime_sales')->name('airtime');
        Route::get('/cabletv' , 'cable_sales')->name('cable');
        Route::get('/electricity' , 'power_sales')->name('power');
        Route::get('/swap' , 'airtime_swap')->name('swap');
        Route::get('/swap/del/{id}' , 'airtime_swap_delete')->name('swap.delete');
        Route::get('/swap/approve/{id}' , 'airtime_swap_approve')->name('swap.approve');
        Route::get('/education' , 'education_sales')->name('education');
        Route::get('/vouchers' , 'voucher_pins')->name('vouchers');
        Route::get('/bulksms' , 'transactions')->name('bulksms');
    });
    // Staffs and Roles
    Route::controller(StaffController::class)->prefix('staffs')->as('staffs.')->group(function(){
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
        Route::get('/delete/{id}', 'destroy')->name('destroy');
    });
    Route::controller(StaffController::class)->prefix('roles')->as('roles.')->group(function(){
        Route::get('/', 'roles')->name('index');
        Route::get('/create',  'create_role')->name('create');
        Route::post('/store', 'store_role')->name('store');
        Route::get('/edit/{id}', 'edit_role')->name('edit');
        Route::post('/update/{id}', 'update_role')->name('update');
        Route::get('/delete/{id}', 'destroy_role')->name('destroy');
    });
    // Email setting
    Route::controller(EmailController::class)->as('email.')->prefix('email')->group(function(){
        Route::get('/setting' , 'setting')->name('setting');
        Route::get('/templates' , 'templates')->name('template');
        Route::get('/newsletter' , 'newsletter')->name('newsletter');
        Route::post('/newsletter' , 'send_newsletter')->name('newsletter');
        Route::get('/templates/edit/{id}' , 'edit_template')->name('edit_template');
        Route::post('/templates/update/{id}' , 'update_template')->name('update_template');
        Route::post('/test' , 'test_email')->name('test');
    });
    // PAges
    Route::controller(AdminController::class)->as('pages.')->prefix('pages')->group(function(){
        Route::get('/create' , 'create_page')->name('create');
        Route::get('/' , 'pages')->name('index');
        Route::post('/create' , 'store_page')->name('store');
        Route::get('/edit/{id}' , 'edit_page')->name('edit');
        Route::post('/edit/{id}' , 'update_page')->name('update');
        Route::get('/delete/{id}' , 'delete_page')->name('delete');
    });
    // Settings
    Route::controller(SettingController::class)->as('setting.')->prefix('settings')->group(function(){
        Route::get('/payment' , 'payment')->name('payment');
        Route::get('/features' , 'features')->name('features');
        Route::get('/custom-styles' , 'custom_styles')->name('custom');
        Route::get('/' , 'index')->name('index');

        Route::post('/update', 'update')->name('update');
        Route::post('/system', 'systemUpdate')->name('sys_settings');
        Route::post('/system/store', 'store_settings')->name('store_settings');   
        Route::post('env_key', 'envkeyUpdate')->name('env_key');     
    });

    Route::get('/system/update', [UpdateController::class, 'index'])->name('system.update');
    Route::post('/update/files', [UpdateController::class, 'saveFile'])->name('update.postfile'); 
    Route::get('/update/finish', [UpdateController::class, 'finish'])->name('update.finish');
    Route::get('/cache-clear', [AdminController::class, 'clearCache'])->name('clear.cache');
    Route::get('/maintenance', [AdminController::class, 'maintenance'])->name('maintenance');
});