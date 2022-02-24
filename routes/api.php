<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApiUserController;
use App\Http\Controllers\ApplyOnTaskController;
use App\Http\Controllers\Auth\ApiAuthController;
use App\Http\Controllers\Auth\ApiSocialAuthController;
use App\Http\Controllers\Auth\ForgetPasswordController;
use App\Http\Controllers\ChatsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IdentityController;
use App\Http\Controllers\InterviewController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PayTabsGatewayController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublichActionController;
use App\Http\Controllers\StaticDataController;
use App\Http\Controllers\TaskController;
use App\Models\ChatChannel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

Route::get('task/list', [TaskController::class, 'index'])->middleware('auth:api');
Route::post('task', [TaskController::class, 'create'])->middleware('auth:api');

// Payment Gateway
Route::post('pay', [PayTabsGatewayController::class, 'index'])->middleware('auth:api');
Route::post('payment/callback', [PayTabsGatewayController::class, 'callback']);

// user
Route::get('user', [ApiUserController::class, 'index'])->middleware(['auth:api', 'json.response']);
Route::get('user/about{id?}', [ApiUserController::class, 'about'])->middleware(['auth:api', 'json.response']);

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

Route::post('identity/images', [IdentityController::class, 'create'])->middleware('auth:api');
Route::get('identity/can-upload', [IdentityController::class, 'canUpload'])->middleware('auth:api');
// profile
Route::get('user/showProfile{id?}', [ProfileController::class, 'showAnotherUser'])->middleware('auth:api');
Route::get('user/profile', [ProfileController::class, 'show'])->middleware('auth:api');
Route::post('user/profile-photo', [ProfileController::class, 'changePhoto'])->middleware('auth:api');
Route::post('user/edit-profile', [ProfileController::class, 'edit'])->middleware('auth:api');
Route::get('user/address', [ProfileController::class, 'getAddress'])->middleware("auth:api");
Route::post('user/address', [ProfileController::class, 'updateAddress'])->middleware("auth:api");
Route::get('location/data', [StaticDataController::class, 'getGovernorate'])->middleware('auth:api');

Route::delete('myTask{id?}', [DashboardController::class, 'deleteTask'])->middleware('auth:api');

Route::get('viewTask{id?}', [DashboardController::class, 'getTask'])->middleware('auth:api');

Route::post('completeTask{id?}', [DashboardController::class, 'completeTask'])->middleware('auth:api');










Route::get('location/target', [LocationController::class, 'getTargetLocations'])->middleware('auth:api');
Route::get('location/delivery', [LocationController::class, 'getDeliveryLocations'])->middleware('auth:api');
Route::post('location/target', [LocationController::class, 'createTargetLocation'])->middleware('auth:api');
Route::post('location/delivery', [LocationController::class, 'createDeliveryLocation'])->middleware('auth:api');
Route::get('task/can-apply{task_id?}', [ApplyOnTaskController::class, 'canApply'])->middleware('auth:api');
Route::post('task/apply', [ApplyOnTaskController::class, 'apply'])->middleware('auth:api');
Route::post('task/offers{task_id?}', [ApplyOnTaskController::class, 'offersOnTask'])->middleware('auth:api');
Route::post('interview/select', [InterviewController::class, 'select'])->middleware('auth:api');
Route::get('interview/candidates{task_id?}', [InterviewController::class, 'candidates'])->middleware('auth:api');
Route::post('interview/approve', [InterviewController::class, 'approve'])->middleware('auth:api');

Route::get('task/me', [DashboardController::class, 'getMyTasks'])->middleware('auth:api');
Route::get('task/applied', [DashboardController::class, 'getAppliedTasks'])->middleware('auth:api');
Route::get('user/connects', [ApiUserController::class, 'getConnects'])->middleware("auth:api");
Route::get('feedback/me', [DashboardController::class, 'getMyFeedback'])->middleware('auth:api');
Route::get('feedback{user_id?}', [DashboardController::class, 'getFeedback'])->middleware('auth:api');
Route::post('feedback', [DashboardController::class, 'addFeedback'])->middleware('auth:api');


Route::get('messages', [ChatsController::class, 'fetchMessages'])->middleware('auth:api');
Route::post('messages', [ChatsController::class, 'sendMessage'])->middleware('auth:api');

Route::post('contact-us', [PublichActionController::class, 'sendContactForm']);
Route::get('is-admin', [AdminController::class, 'isAdmin'])->middleware('auth:api');
Route::delete('task{id?}', [AdminController::class, 'deleteTask'])->middleware('auth:api');


Route::post('pusher/auth', [ChatsController::class, 'authPusher'])->middleware('auth:api');


Route::get('channel{id?}', [ChatsController::class, 'getChannelDetails'])->middleware('auth:api');
Route::get('chat/me/channels', [ChatsController::class, 'getAllMyChatChannels'])->middleware('auth:api');
Route::get('notifications', [NotificationController::class, 'getNotifications'])->middleware('auth:api');
Route::get('notifications/seen', [NotificationController::class, 'markNotificationAsSeen'])->middleware('auth:api');
Route::get('admin/contact-us', [AdminController::class, 'getContactUs'])->middleware('auth:api');
Route::get('admin/users', [AdminController::class, 'getUsers'])->middleware('auth:api');
Route::get('admin/transactions', [AdminController::class, 'getTransactions'])->middleware('auth:api');
Route::get('admin/identities', [AdminController::class, 'getIdentities'])->middleware('auth:api');
Route::delete('admin/user{id?}', [AdminController::class, 'deleteUser'])->middleware('auth:api');
Route::post('admin/login', [AdminController::class, 'login']);





















// end
