<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ProfileResource;
use App\Http\Resources\UserResource;

class ProfileController extends Controller
{
    public function show() {
        $id= Auth::user()->id;
        $post= Profile::find($id);
        $user= User::find($id);
        return [new ProfileResource($post),new UserResource($user)];
    }
    public function edit(Request $req){
        $user = User::find(Auth::user()->id);
        $profile = Profile::find(Auth::user()->id);
        $profile->gender=$req->gender;
        //$profile->user_id = $req->user_id;
        $profile->state = $req->state;
        $profile->city = $req->city;
        $profile->phone = $req->phone;
        $user->name = $req->name;
        $user->email = $req->email;
        $profile->save();
        $user->save();
        return [new ProfileResource($profile),new UserResource($user)];

    }
}
