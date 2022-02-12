<?php

use App\Http\Controllers\ApiUserController;
use App\Http\Controllers\Auth\ApiAuthController;
use App\Http\Controllers\Auth\ApiSocialAuthController;
use App\Http\Controllers\Auth\ForgetPasswordController;
use App\Http\Controllers\PayTabsGatewayController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('tasks', [TaskController::class, 'index']);
Route::post('task', [TaskController::class, 'create'])->middleware('auth:api');

// Payment Gateway
Route::post('pay', [PayTabsGatewayController::class, 'index'])->middleware('auth:api');
Route::post('payment/callback', [PayTabsGatewayController::class, 'callback']);

// user
Route::get('user', [ApiUserController::class, 'index'])->middleware(['auth:api', 'json.response']);

// normal auth
Route::post('login', [ApiAuthController::class, 'login'])->middleware(['json.response']);
Route::post('register', [ApiAuthController::class, 'register'])->middleware(['json.response']);
// social auth
Route::post('login/google', [ApiSocialAuthController::class, 'googleLogin'])->middleware(['json.response']);
Route::post('login/facebook', [ApiSocialAuthController::class, 'facebookLogin'])->middleware('json.response');

// logout
Route::post('logout', [ApiAuthController::class, 'logout'])->middleware(['auth:api', 'json.response']);
// reset
Route::post('password/forget', [ForgetPasswordController::class, 'forget']);
Route::post('password/reset', [ForgetPasswordController::class, 'reset']);
