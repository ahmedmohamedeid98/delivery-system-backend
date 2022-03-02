<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ResetPasswordMail;
use Exception;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ForgetPasswordController extends Controller
{
    public function forget(Request $request)
    {
        $data = $request->only('email');
        $validator = Validator::make($data, [
            'email' => ['required', 'email', Rule::exists('users', 'email')],
        ]);

        if ($validator->fails()) {
            return $this->failure($validator->errors()->all());
        }
        try {
            $response = Password::sendResetLink($request->only('email'));
            if ($response == Password::RESET_LINK_SENT) {
                return $this->success('Check your inbox!');
            } else {
                return $this->failure(['faild to send reset link']);
            }
        } catch (Exception $e) {
            return $this->failure(['Mailgun.org is not allowed to send: Sandbox subdomains are for test purposes only. Please add this email to authorized recipients in Account Settings.']);
        }
    }


    public function reset(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        if ($validator->fails()) {
            return $this->failure($validator->errors()->all());
        }

        $response = Password::reset($request->only('email', 'password', 'password_confirmation', 'token'), function ($user) use ($request) {
            $user->forcefill([
                'password' => Hash::make($request->password),
                'remember_token' => Str::random(60)
            ])->save();
            event(new PasswordReset($user));
        });

        if ($response == Password::PASSWORD_RESET) {
            return $this->success('Password reset successfully');
        } else {
            return $this->failure(['faild to send reset link']);
        }
    }
}
