<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Paytabscom\Laravel_paytabs\Facades\paypage;

class BuyConnectsController extends Controller
{


    private $DEFAULT_CART_ID = "sd54sd45sd4sa";


    public function index(Request $request)
    {
        $user_id = $request->query('user_id');
        return view('connects.index', ['user_id' => $user_id]);
    }

    public function buy(Request $request)
    {

        $data = $request->all();
        $user = User::find($data['user_id']);

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
        return Redirect::to($paymentPage);
    }

    public function return(Request $request)
    {
        dd($request->all());
    }
}
