<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Jobs\TriggerNotification;
use App\Models\EDeleiveryFailure;
use App\Models\Profile;
use App\Models\Task;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserRequestTask;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    /**
     * "acquirerMessage" => null
     * "acquirerRRN" => null
     * "cartId" => "sd54sd45sd4sa"
     * "customerEmail" => "ahmed3@gmail.com"
     * "respCode" => "G19371"
     * "respMessage" => "Authorised"
     * "respStatus" => "A"
     * "signature" => "030f5108e69bbcebc4f0c708d4dca5f9ce73d793085ccd51f92afeac2a2e990d"
     * "token" => null
     * "tranRef" => "TST2206201082080"
     */
    public function return(Request $request)
    {
        $data = $request->all();
        if (isset($data['respStatus'])) {
            return view('payments.response', ['status' => $data['respStatus']]);
        }
    }


    public function callback(Request $request)
    {
        Transaction::create([
            'user_id' => 555,
            'task_id' => 45,
            'trans_ref' => "testtrans",
            'trans_amount' => "25",
            'trans_currency' => "EGB",
            'trans_desc' => "desc",
            'trans_type' => "payment",
            'res_status' => "A",
            'res_msg' => "msg",
            'trans_time' => "25",
            'payment_method' => "Visa",
            'payment_card' => "25452#####",
            'ipn_trace' => "d45d4df54f5sdf",
        ]);

        EDeleiveryFailure::created([
            'failure' => "start in callbacl",
        ]);
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
            EDeleiveryFailure::created([
                'failure' => "there is failure in payment for task",
            ]);
            $errors = $validator->errors()->all();
            $json = json_encode($errors);
            EDeleiveryFailure::created([
                'failure' => $json,
            ]);
        }

        if ($request['cart_id'] != $this->DEFAULT_CART_ID) {
            $task_id = +explode('-', $request['cart_id'])[0];
            $trans_type = explode('-', $request['cart_id'])[1];
            EDeleiveryFailure::created([
                'failure' => "not fail task_id=" . $task_id . ", trasn_type=" . $trans_type,
            ]);
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
                $newConnects = $this->getConnects(+$trans_amount);
                $userProfile->connects = $userProfile->connects + $newConnects;
                $userProfile->save();

                $notifyMsg = "Buying new connects successfully, you get new " . $newConnects . " connects.";
                $notifyJob = new TriggerNotification($notifyMsg, $user_id);
                $this->dispatch($notifyJob);
            } else {
                $task = Task::find($task_id);
                if ($trans_type == "order") {
                    $task->paid_order = $trans_amount;
                } else if ($trans_type == "service") {
                    $task->paid_service = $trans_amount;
                } else if ($trans_type == "both") {
                    $task->paid_both = $trans_amount;
                }
                $userProfile = Profile::find($user_id);
                $spent_amount = $userProfile->spent_amount;
                $userProfile->spent_amount = $spent_amount + $trans_amount;
                $userProfile->save();
                $task->save();

                $clientsIds = UserRequestTask::where('task_id', $task->id)->get('user_id');
                if (count($clientsIds) > 0) {
                    $client = User::find($clientsIds[0]->user_id);
                    if ($client) {
                        $notifyOwnerMsg = "You are reserve (" . $trans_amount . " EGB) for task, " . $task->title . "  successfully. we will transfer this amount to " . $client->name . " if he/she completes the task successfully!";
                        $this->dispatch(new TriggerNotification($notifyOwnerMsg, $user_id));

                        $notifyClientMsg = "Task owner was reserved (" . $trans_amount . " EGB) for task, " . $task->title . "  you are approved in it. we will transfer this amount for your account when completes the task successfully!";
                        $this->dispatch(new TriggerNotification($notifyClientMsg, $client->user_id));
                    }
                }
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
}
