<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CashU extends Controller
{
    public function Preparing()
    {
        ini_set("soap.wsdl_cache_enabled", "0");
        ini_set('user_agent', 'Mozilla/5.0(Windows NT6.1;WOW64;rv:20.0) Gecko/20100101 Firefox/20.0');
        $merchant_id = 'test';
        $encryption_key = 'encryption_key_value';
        $amount = $_POST["amount"];
        $currency = 'usd';
        $display_text = 'Description will show to the user';
        $language = 'en';
        $session_id = '123ct2';
        $txt1 = 'item';
        $testmode = 0;
        $txt2 = '';
        $txt3 = '';
        $txt4 = '';
        $txt5 = '';
        $service_name = '';

        $token = md5(strtolower());
    }
}
