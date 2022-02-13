<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Task;
use App\Models\Transaction;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Paytabscom\Laravel_paytabs\Facades\paypage;
use Illuminate\Support\Facades\Validator;


class PayTabsGatewayController extends Controller
{


  private $DEFAULT_CART_ID = "sd54sd45sd4sa";

  public function index(Request $request)
  {

    $user = Auth::user();
    $data = $request->all();
    $rules = [
      'trans_type' => 'required|string|in:connects,order,service,both,refund',
      'amount' => 'required|integer|in:50,120,200',
    ];

    if (isset($data['trans_type']) && $data['trans_type'] != 'connects') {
      $rules['task_id'] = 'required|exists:tasks';
    } else {
      $data['task_id'] = $this->DEFAULT_CART_ID; // any non valid task_id;
    }

    $validator = Validator::make($data, $rules);

    if (!$validator) {
      return $this->failure($validator->errors()->all());
    }

    if ($data['task_id'] != $this->DEFAULT_CART_ID) {
      $data['task_id'] = $data['task_id'] . "-" . $data['trans_type'];
    }

    /**
     * sendTransaction: auth, sale, refund, void, capture
     * sendCart: CartID, Amount, CartDescription
     * paytabs_return: a page paytabs service calls it after finishing payment operation
     * paytabs_callback: link paytabs service calls it after finishing payment operation
     * we store user_id instead of `ip` cause we need the id later
     */
    $paymentPage = paypage::sendPaymentCode('all')->sendTransaction('sale')
      ->sendCart($data['task_id'], $data['amount'], strval($user->id), "connects")
      ->sendCustomerDetails($user->name, $user->email, '', '', '', '', 'EG', '1234', "")
      ->sendHideShipping(true)
      ->sendURLs(env('paytabs_return'), env('paytabs_callback'))
      ->sendLanguage('en')
      ->sendFramed(true)
      ->create_pay_page();
    return ["payment_url" => $paymentPage];
  }

  public function callback(Request $request)
  {
    $rules = [
      'tran_ref' => 'bail|required',
      'payment_result' => 'bail|required',
      'payment_result.response_status' => 'bail|required|in:A,H',
      'customer_details' => 'bail|required',
      'customer_details.ip' => 'bail|required',
      'cart_id' => 'required',
      'payment_result' => 'required',
      'payment_info' => 'required',
    ];

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
      print_r($validator->errors()->all());
      return; // return $this->failure($validator->errors()->all());
    }

    if ($request['cart_id'] != $this->DEFAULT_CART_ID) {
      $task_id = +explode('-', $request['cart_id'])[0];
      $trans_type = explode('-', $request['cart_id'])[1];
    } else {
      $task_id = null;
      $trans_type = 'connects';
    }


    $user_id = +$request['cart_description']; // We sent user_id instead of cart description
    $trans_reference = $request['tran_ref'];
    $trans_amount = $request['tran_total'];
    $trans_currency = $request['tran_currency'];
    $trans_desc = '';
    $paymentResult = $request['payment_result'];
    $responseStatus = $paymentResult['response_status'];
    $responseMessage = $paymentResult['response_message'];
    $trasactionTime = $paymentResult['transaction_time'];
    $paymentInfo = $request['payment_info'];
    $payment_method = $paymentInfo['payment_method'];
    $paymentCard = $paymentInfo['payment_description'];
    $ipn_trace = $request['ipn_trace'];

    try {
      Transaction::create([
        'user_id' => $user_id,
        'task_id' => $task_id,
        'trans_ref' => $trans_reference,
        'trans_amount' => $trans_amount,
        'trans_currency' => $trans_currency,
        'trans_desc' => $trans_desc,
        'trans_type' => $trans_type,
        'res_status' => $responseStatus,
        'res_msg' => $responseMessage,
        'trans_time' => $trasactionTime,
        'payment_method' => $payment_method,
        'payment_card' => $paymentCard,
        'ipn_trace' => $ipn_trace,
      ]);
      if ($trans_type == "connects") {
        $userProfile = Profile::find($user_id);
        $userProfile->connects = $userProfile->connects + $this->getConnects(+$trans_amount);
        $userProfile->save();
      } else {
        $task = Task::find($task_id);
        if ($trans_type == "order") {
          $task->paid_order = $trans_amount;
        } else if ($trans_type == "service") {
          $task->paid_service = $trans_amount;
        } else if ($trans_type == "both") {
          $task->paid_both = $trans_amount;
        }
        $task->save();
      }
    } catch (Exception $e) {
      printf($e->getMessage());
    }
  }

  private function getConnects($amount)
  {
    switch ($amount) {
      case 50:
        return 25;
      case 120:
        return 75;
      case 200:
        return 140;
      default:
        return 0;
    }
  }

  public function listTransactions(Request $request)
  {
    // return Transaction::where();
  }

  public function refund(Request $request)
  {
    # code... client ask to refund his money
    # if client B not do the job in the time client A can refund the money
    # after two days
  }
}

/*
response_status
A	Authorized
H	Hold (Authorised but on hold for further anti-fraud review)
P	Pending (for refunds)
V	Voided
E	Error
D	Declined
 */

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