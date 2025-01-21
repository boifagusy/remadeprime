<?php

use App\Mail\MainEmail;
use App\Models\{
    EmailTemplate,
    Setting,
    SystemSetting,
    User
};

if (!function_exists('get_setting')) {
    function get_setting($key)
    {
        $settings = Setting::first();
        $setting = $settings->$key;       
        return $setting;
    }
}
if (!function_exists('sys_setting')) {
    function sys_setting($key, $default = null)
    {
        $settings = SystemSetting::all();
        $setting = $settings->where('name', $key)->first();

        return $setting == null ? $default : $setting->value;
    }
}

if (!function_exists('static_asset')) {
    function static_asset($path, $secure = null)
    {
        return app('url')->asset('public/assets/' . $path, $secure);
    }
}

//return file uploaded via uploader
if (!function_exists('my_asset')) {
    function my_asset($path, $secure = null)
    {
        return app('url')->asset('public/uploads/' . $path, $secure);
    }
}

function text_trim($string, $length = null)
{
    if (empty($length)) $length = 100;
    return Str::limit($string, $length, "...");
}
function show_datetime($date, $format = 'd M, Y h:ia')
{
    return \Carbon\Carbon::parse($date)->format($format);
}

// random string
function getTrxcode($length)
{
    $characters = 'ABCDEFGHJKMNOPQRSTUVWXYZ1234567890';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
function getTrx($length)
{
    $characters = 'ABCDEFGHJKMNOPQRSTUVWXYZ1234567890acdefghijklmopqrstuvwxyz';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
// short code replacer
function shortCodeReplacer($shortCode, $replace_with, $template_string)
{
    return str_replace($shortCode, $replace_with, $template_string);
}

function show_date($date, $format = 'd M, Y')
{
    return \Carbon\Carbon::parse($date)->format($format);
}

function show_time($date, $format = 'h:ia')
{
    return \Carbon\Carbon::parse($date)->format($format);
}
// Transaction type
function short_trx_type($id){
    if($id == 1){
        return "airtime";
    }elseif($id == 2){
        return "data";
    }elseif($id == 3){
        return "airtime swap";
    }elseif($id == 4){
        return "voucher pin";
    }elseif($id == 5){
        return "cable tv";
    }elseif($id == 6){
        return "education";
    }elseif($id == 7){
        return "electricity";
    }elseif($id == 8){
        return "bulk sms";
    }elseif($id == 9){
        return "wallet";
    }elseif($id == 10){
        return "referral";
    } else{
        return $id;
    }
}
function trans_type($id){
    if($id == 1){
        return '<span class="badge bg-success">credit</span>';
    }elseif($id == 2){
        return '<span class="badge bg-danger">debit</span>';
    } else{
        return $id;
    }
}
function trans_type2($id){
    if($id == 1){
        return 'credit';
    }elseif($id == 2){
        return 'debit';
    } else{
        return $id;
    }
}
//formats currency
if (!function_exists('format_price')) {
    function format_price($price)
    {
        $fomated_price = number_format($price, 2);      
        $currency = get_setting('currency');  
        return $currency .$fomated_price;
    }
}
function sym_price($price)
{
    $fomated_price = number_format($price, 2);      
    $currency = get_setting('currency_code');  
    return $currency . $fomated_price;
}
function format_number($price)
{
    $fomated_price = number_format($price, 2); 
    return $fomated_price;
}

// Send general emails
function send_emails($email, $type, $shortCodes = [])
{
    $email_template = EmailTemplate::whereType($type)->first();
    if($email_template == null){
        return;
    }
    $message = $email_template->content;
    foreach ($shortCodes as $code => $value) {
        $message = shortCodeReplacer('{{'.$code.'}}', $value, $message);
    }
    // subject
    $subject = $email_template->subject;
    foreach ($shortCodes as $code => $value) {
        $subject = shortCodeReplacer('{{'.$code.'}}', $value, $subject);
    }

    // dd($subject, $message);
    // send email
    $data['subject'] = $subject;
    $data['message'] = $message;
    
    try {
        Mail::to($email)->queue(new MainEmail($data));
    } catch (\Exception $e) {
        // dd($e);
    }

}
// send email
function general_email($email, $mes, $sub)
{
    // return $email;
    $data['subject'] = $sub;
    $data['message'] = $mes;
    try {
        Mail::to($email)->queue(new MainEmail($data));
    } catch (\Exception $e) {
        dd($e);
    }
}

// give affiliate bonus
function give_affiliate_bonus($id, $amount){
    $user = User::find($id);
    $refer = User::find($user->ref_id);
    $commission = sys_setting('referral_commission') * $amount /100;
    $trxcode = getTrx(12);
    if($refer){
        $refer->bonus = $commission + $refer->bonus;
        $refer->save(); 
        $refer->transactions()->create([
            'amount' => $commission,
            'user_id' => $refer->id,
            'charge' => 0,
            'old_balance' => $refer->bonus - $commission,
            'new_balance' => $refer->bonus,
            'type' => 1,
            'status'=> 1,
            'service' => 10,
            'message' => 'Referral Bonus from '. $user->username,
            'code' => $trxcode,
        ]);
        // send email
        if(\sys_setting('trx_email') == 1 && $refer->email_notify == 1){
            \send_emails($refer->email, 'TRX_EMAIL', 
            [
                'username' => $refer['username'],
                'code' => $trxcode,
                'trx_details' => 'Referral Bonus from '. $user->username,
                'trx_type' => trans_type2(1),
                'amount' => format_price($commission),
                'date' => date('Y-m-d H:m:s')
            ]);
        }
    }
    return;
}

// Install copy files
function install_files($name)
{
    $file = base_path('storage/install/'.$name);
    return $file;
}

function fazi_network($id){
    if($id == 'MTN'){
        return 1;
    }elseif($id == 'GLO'){
        return 3;
    }elseif($id == 'AIRTEL'){
        return 2;
    }elseif($id == '9MOBILE'){
        return 4;
    } else{
        return $id;
    }
}