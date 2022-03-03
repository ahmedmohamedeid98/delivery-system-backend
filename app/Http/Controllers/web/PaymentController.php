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
}
