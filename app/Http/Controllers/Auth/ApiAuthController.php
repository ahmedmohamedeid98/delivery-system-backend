<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\NotificationController;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;
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
        NotificationController::storeAndPublish('Congratulations ' . $user->name . ', creating account successfully', $user->id);
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
        $allDevices = $request->only('all_devices');
        $validator = Validator::make($allDevices, [
            'all_devices' => ['required', 'boolean']
        ]);

        if ($validator->fails()) {
            return $this->failure($validator->errors()->all());
        }
        if ($allDevices == true) {
            $tokens = $request->user()->tokens();
            foreach ($tokens as $token) {
                $token->delete();
            }
            return $this->success('You have been successfully logged out from all devices!');
        }
        $request->user()->token()->delete();
        return $this->success('You have been successfully logged out!');
    }
}
