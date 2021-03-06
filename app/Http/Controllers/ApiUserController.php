<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\AboutUserResource;
use App\Http\Resources\UserResource;
use App\Models\Profile;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiUserController extends Controller
{
    public function index(Request $request)
    {
        return new UserResource($request->user());
    }

    public function getConnects()
    {
        $user_id = Auth::user()->id;
        try {
            $profile = Profile::find($user_id);
            return $this->success('get connects successfully', ['connects' => $profile->connects]);
        } catch (Exception $e) {
            return $this->failure([$e->getMessage()]);
        }
    }

    public function about(Request $request)
    {
        $user_id = $request->query('id');
        if (!$user_id || !is_numeric($user_id)) {
            return $this->failure(['invalid user id']);
        }
        try {
            $userInfo = Profile::with('user')->where('user_id', $user_id)->get()->first();
            return $this->success('get user info successfully', new AboutUserResource($userInfo));
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
