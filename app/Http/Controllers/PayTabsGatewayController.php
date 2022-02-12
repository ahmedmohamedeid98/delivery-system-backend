<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Paytabscom\Laravel_paytabs\Facades\paypage; 

class PayTabsGatewayController extends Controller
{
    public function index(Request $request)
    {
        $data = [
            "cart_id" => 10,
            "cart_amount" => 20,
            "cart_description" => "buy connects",
            "name"=> "Ahmed Eid",
            "email" => "ahmed@gmail.com",
            "phone" => "0102221545",
            "user_id" => '5',

        ];

        $paymentPage = paypage::sendPaymentCode('all') 

         ->sendTransaction('sale') // [auth, sale, refund, void, capture]

         ->sendCart($data['cart_id'],$data['cart_amount'],$data['cart_description'])  // CartID, Amount, CartDescription

         ->sendCustomerDetails($data['name'], $data['email'], $data['phone'], 'test', 'Nasr City', 'Cairo', 'EG', '1234',$data['user_id'])
         // we store user_id instead of `ip` cause we need the id later  

         ->sendHideShipping(true)

         ->sendURLs(env('paytabs_return'), env('paytabs_callback')) 
         // paytabs_return: a page paytabs service calls it after finishing payment operation 
         // paytabs_callback: link paytabs service calls it after finishing payment operation
         ->sendLanguage('en') 

         ->create_pay_page(); 

        return $paymentPage; 
    }

    public function callback(Request $request)
    {
        /*
        {
  "tran_ref": "TST2204301053491",
  "merchant_id": 37871,
  "profile_id": 89644,
  "cart_id": "10",
  "cart_description": "test",
  "cart_currency": "EGP",
  "cart_amount": "50.00",
  "tran_currency": "EGP",
  "tran_total": "50.00",
  "tran_type": "Sale",
  "tran_class": "ECom",
  "customer_details": {
    "name": "Ahmed Eid",
    "email": "ahmed@gmail.com",
    "phone": "0102221545",
    "street1": "test",
    "city": "Nasr City",
    "state": "C",
    "country": "EG",
    "zip": "1234",
    "ip": "196.149.67.115"
  },
  "payment_result": {
    "response_status": "A",
    "response_code": "G29010",
    "response_message": "Authorised",
    "cvv_result": " ",
    "avs_result": " ",
    "transaction_time": "2022-02-12T01:23:30Z"
  },
  "payment_info": {
    "payment_method": "MasterCard",
    "card_type": "Credit",
    "card_scheme": "MasterCard",
    "payment_description": "5200 00## #### 0114",
    "expiryMonth": 2,
    "expiryYear": 2022
  },
  "ipn_trace": "IPNS0003.62070C12.00004269"
}
        */
        
        $trans_reference = $request['tran_ref'];
        $trans_amount = $request['tran_total'];
        $trans_currency = $request['tran_currency'];
        $trans_desc = $request['cart_description'];
        
        $paymentResult = $request['payment_result'];
        $responseStatus = $paymentResult['response_status'];
        $responseMessage = $paymentResult['response_message'];
        $trasactionTime = $paymentResult['transaction_time'];
        //[trans_ref, trans_amount, trans_currency, trans_desc, res_status, res_msg, trans_time,
        // payment_method, payment_card, ipn_trace]
        
        $paymentInfo = $request['payment_info'];
        $payment_method = $paymentInfo['payment_method'];
        $paymentCard = $paymentInfo['payment_description'];
        
        $ipn_trace = $request['ipn_trace'];

        if($responseStatus == 'A') {
            
        }
    }


    public function refund(Request $request)
    {
        # code... client ask to refund his money
        # if client B not do the job in the time client A can refund the money
        # after two days
    }
}
