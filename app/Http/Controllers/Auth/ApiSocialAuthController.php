<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Jobs\TriggerNotification;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiSocialAuthController extends Controller
{
    public function googleLogin(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'name' => ['required'],
            'email' => ['required', 'email'],
            'id' => ['required']
        ]);

        if ($validator->fails()) {
            return $this->failure($validator->errors()->all());
        }

        try {
            $finduser = User::where('google_id', $data['id'])->first();

            if ($finduser) {
                return $this->successWithToken($finduser);
            } else {
                $validator = Validator::make($data, [
                    'email' => ["unique:users"],
                ]);
                if ($validator->fails()) {
                    return $this->failure($validator->errors()->all());
                }
                $newUser = User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'google_id' => $data['id'],
                    'photo_url' => $data['photo_url'],
                    'password' => 'NULL',
                ]);
                $msg = 'Wellcome ' . $newUser->name . ', creating account successfully';
                $this->dispatch(new TriggerNotification($msg, $newUser->id));
                return $this->successWithToken($newUser);
            }
        } catch (Exception $e) {
            return $this->failure([$e->getMessage()]);
        }
    }

    public function facebookLogin(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'id' => ['required'],
            'name' => ['required'],
            // 'email' => ['required', 'email'], // some facebook user login with phone...
        ]);

        if ($validator->fails()) {
            return $this->failure($validator->errors()->all());
        }
        if (isset($data['email'])) {
            $users = User::where('email', $data['email'])->get();
            if ($users && count($users) > 0) {
                return $this->failure(['user already exist']);
            }
        }
        try {
            $finduser = User::where('facebook_id', $data['id'])->first();

            if ($finduser) {
                return $this->successWithToken($finduser);
            } else {

                $newUser = User::create([
                    'name' => $data['name'],
                    'email' => isset($data['email']) && $data['email'] != null ? $data['email'] : $data['id'] . "@example.com",
                    'facebook_id' => $data['id'],
                    'photo_url' => $data['photo_url'],
                    'password' => 'NULL',
                ]);
                $msg = 'Wellcome ' . $newUser->name . ', creating account successfully';
                $this->dispatch(new TriggerNotification($msg, $newUser->id));
                $this->successWithToken($newUser);
            }
        } catch (Exception $e) {
            return $this->failure([$e->getMessage()]);
        }
    }
}
