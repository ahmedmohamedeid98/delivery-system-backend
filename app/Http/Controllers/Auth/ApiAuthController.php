<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\NotificationController;
use App\Jobs\TriggerNotification;
use App\Models\OauthAccessToken;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ApiAuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);
        if ($validator->fails()) {
            return $this->failure($validator->errors()->all());
        }
        try {

            $request['password'] = Hash::make($request['password']);
            $request['remember_token'] = Str::random(10);
            $user = User::create($request->toArray());
        } catch (Exception $e) {
            return $this->failure([$e->getMessage()]);
        }
        $msg = 'Wellcome ' . $user->name . ', creating account successfully';
        // Trigger Notification Async.
        $this->dispatch(new TriggerNotification($msg, $user->id));
        return $this->successWithToken($user);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);
        if ($validator->fails()) {
            return $this->failure($validator->errors()->all());
        }
        $user = User::where('email', $request->email)->first();

        if ($user) {
            if (!isset($user->account_status) || $user->account_status == 0) {
                $locked_msg = 'Your account was locked due to violations to the terms and conditions, contact us if there is a mistake';
                return $this->failure([$locked_msg]);
            }

            if (Hash::check($request->password, $user->password)) {
                return $this->successWithToken($user);
            } else {
                return $this->failure(['Invalid email or password']);
            }
        } else {
            return $this->failure(['User does not exist']);
        }
    }

    public function logout(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'all_devices' => ['required', 'boolean']
        ]);

        if ($validator->fails()) {
            return $this->failure($validator->errors()->all());
        }
        if ($data['all_devices'] == true && Auth::check()) {
            OauthAccessToken::where('user_id', Auth::user()->id)->delete();
        } else if (Auth::check()) {
            if ($request->user()->token()) {
                $request->user()->token()->revoke();
            }
        } else {
            return $this->unauthorizedFailure();
        }
        return $this->success('You have been successfully logged out!');
    }
}
