<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;
use App\Models\UserRequestTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Paytabscom\Laravel_paytabs\Facades\paypage;

class PayFroTaskController extends Controller
{

    public function index(Request $request)
    {
        $user_id = $request->query('user_id');
        $task_id = $request->query('task_id');

        $task = Task::find($task_id);
        if (!$task) {
            return $this->failure(['invalid task id']);
        }
        $user = User::find($user_id);
        $data = UserRequestTask::where('task_id', $task_id)->where('approve_status', 2)->get('user_id')->first();
        $client = null;

        if ($data) {
            $client = User::find($data->user_id);
        }

        if ($client && $task) {
            return view('budget.pay_for_task', [
                'id' => $task->id,
                'from_user' => $user->name,
                'from_user_id' => $user->id,
                'title' => $task->title,
                'budget' => $task->budget,
                'status' => $task->task_status,
                'to_user' => isset($client) ? $client->name : '',
                'to_email' => isset($client) ? $client->email : ''
            ]);
        } else {
            dd('err');
        }

        // show payment view
    }

    public function pay(Request $request)
    {
        $this->validate($request, [
            'trans_type' => ['required', 'string', Rule::in(['order', 'service', 'both'])],
            'amount' => ['required', 'integer'],
            'description' => ['required', 'string'],
            'user_id' => ['required', Rule::exists('users', 'id')],
            'task_id' => ['required', 'integer', Rule::exists('tasks', 'id')]
        ]);

        $data = $request->all();
        $user = User::find($data['user_id']);

        $data = $request->all();
        // $rules = [
        //     'trans_type' => 'required|string|in:connects,order,service,both,refund',
        //     'amount' => 'required|integer|in:50,120,200',
        // ];

        // if (isset($data['trans_type']) && $data['trans_type'] != 'connects') {
        //     $rules['task_id'] = 'required|exists:tasks';
        // } else {
        //     $data['task_id'] = $this->DEFAULT_CART_ID; // any non valid task_id;
        // }

        // $validator = Validator::make($data, $rules);

        // if (!$validator) {
        //     return $this->failure($validator->errors()->all());
        // }

        // if ($data['task_id'] != $this->DEFAULT_CART_ID) {
        $data['task_id'] = $data['task_id'] . "-" . $data['trans_type'];
        // }

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
}
