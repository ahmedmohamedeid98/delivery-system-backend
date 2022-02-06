<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function success(string $message, $data=null)
    {
        $res = ["success"=>true, "message"=>$message];
        if($data) {
            $res["data"] = $data;
        }
        return response($res, 200);
    }

    public function successWithToken(User $user) {
        $token = $user->createToken('o-l-create-token');
        return response([
            "success"=>true,
            "message"=>'login successfully',
            "token"=>$token->accessToken,
            "token_expires_at"=>$token->token->expires_at, 
            "user"=>new UserResource($user)
        ], 200);
    }

    public function failure(array $errors)
    {
        return response([
            'success'=>false,
            'errors'=>$errors,
        ], 422);
    }
}
