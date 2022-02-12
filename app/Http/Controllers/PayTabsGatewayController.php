<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Paytabscom\Laravel_paytabs\Facades\paypage; 

class PayTabsGatewayController extends Controller
{
    public function index(Request $request)
    {
        $data = [
            "name"=> "Ahmed Eid",
            "email" => "ahmed@gmail.com",
            "amount"=> 50,
            "phone" => "0102221545"

        ];

        $pay= paypage::sendPaymentCode('all') 

         ->sendTransaction('sale') 

         ->sendCart(10,$data['amount'],'test')  // CartID, Amount, CartDescription

         ->sendCustomerDetails($data['name'], $data['email'], $data['phone'], 'test', 'Nasr City', 'Cairo', 'EG', '1234','100.279.20.10') 

         ->sendHideShipping(true)

         ->sendURLs(env('paytabs_return'), env('paytabs_callback')) 

         ->sendLanguage('en') 

         ->create_pay_page(); 

        return $pay; 
    }

    public function callback(Request $request)
    {
        return $request;
    }
}
