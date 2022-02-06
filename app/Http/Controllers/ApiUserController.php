<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class ApiUserController extends Controller
{
    public function index(Request $request) {
        return new UserResource($request->user());
    }
}
