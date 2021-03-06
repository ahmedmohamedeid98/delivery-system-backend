<?php

use App\Http\Controllers\web\PaymentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    // $details = [
    //     'title' => 'Mail from ItSolutionStuff.com',
    //     'body' => 'This is for testing email using smtp',
    //     'url' => 'https://www.google.com'
    // ];
    // return view('resetPasswordEmail', ["details" => $details]);
    return view('welcome');
});

// Route::get('/buy-connects', [BuyConnectsController::class, 'index']);
// Route::post('buy', [BuyConnectsController::class, 'buy'])->name('connects.buy');
// Route::post('payment/callback', [PaymentController::class, 'callback']);
Route::post('payment/return', [PaymentController::class, 'return']);

// Route::get('pay/task', [PayFroTaskController::class, 'index']);
// Route::post('pay/task', [PayFroTaskController::class, 'pay'])->name('pay.task');
