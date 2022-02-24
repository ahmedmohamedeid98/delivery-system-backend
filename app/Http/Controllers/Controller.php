<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function success(string $message, $data = null)
    {
        $res = ["success" => true, "message" => $message];
        if ($data) {
            $res["data"] = $data;
        }
        return response($res, 200);
    }

    public function successWithToken(User $user)
    {
        $token = $user->createToken('o-l-create-token');
        $hasAddress = $this->hasAddress($user->id);
        return response([
            "success" => true,
            "message" => 'login successfully',
            "token" => $token->accessToken,
            "has_address" => $hasAddress,
            "token_expires_at" => $token->token->expires_at,
            "user" => new UserResource($user)
        ], 200);
    }

    public function failure(array $errors)
    {
        return response([
            'success' => false,
            'errors' => $errors,
        ], 422);
    }

    public function unauthorizedFailure()
    {
        return response([
            'success' => false,
            'errors' => ['unauthorized operation!'],
        ], 401);
    }

    public function hasAddress($user_id)
    {
        $profile = Profile::find($user_id);
        if ($profile && $profile->country && $profile->state && $profile->city) return true;
        return false;
    }
}
