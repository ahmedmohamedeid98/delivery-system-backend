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


/**
 * Auth
 */
Route::middleware('json.response', 'throttle:60,1')->group(function () {
    Route::post('login', [ApiAuthController::class, 'login']);
    Route::post('register', [ApiAuthController::class, 'register']);
    Route::post('login/google', [ApiSocialAuthController::class, 'googleLogin']);
    Route::post('login/facebook', [ApiSocialAuthController::class, 'facebookLogin']);
    Route::post('password/forget', [ForgetPasswordController::class, 'forget']);
    Route::post('password/reset', [ForgetPasswordController::class, 'reset']);
});
Route::post('logout', [ApiAuthController::class, 'logout'])->middleware(['auth:api', 'json.response', 'throttle:60,1']);

/**
 * Profile
 */
Route::middleware('auth:api', 'throttle:60,1')->group(function () {
    Route::get('user', [ApiUserController::class, 'index']);
    Route::get('user/about{id?}', [ApiUserController::class, 'about']);
    Route::get('user/showProfile{id?}', [ProfileController::class, 'showAnotherUser']);
    Route::get('user/profile', [ProfileController::class, 'show']);
    Route::post('user/profile-photo', [ProfileController::class, 'changePhoto']);
    Route::post('user/edit-profile', [ProfileController::class, 'edit']);
    Route::get('user/address', [ProfileController::class, 'getAddress']);
    Route::post('user/address', [ProfileController::class, 'updateAddress']);
    Route::post('identity/images', [IdentityController::class, 'create']);
    Route::get('identity/can-upload', [IdentityController::class, 'canUpload']);
});


/**
 * Task
 */
Route::middleware('auth:api', 'throttle:60,1')->group(function () {
    Route::get('task/list', [TaskController::class, 'index']);
    Route::post('task', [TaskController::class, 'create']);
    Route::get('task/can-apply{task_id?}', [ApplyOnTaskController::class, 'canApply']);
    Route::post('task/apply', [ApplyOnTaskController::class, 'apply']);
    Route::post('task/offers{task_id?}', [ApplyOnTaskController::class, 'offersOnTask']);
    Route::get('task/details{id?}', [TaskController::class, 'getTaskDetails']);
    Route::delete('myTask{id?}', [DashboardController::class, 'deleteTask']);
    Route::get('location/data', [StaticDataController::class, 'getGovernorate']);
    Route::get('location/target', [LocationController::class, 'getTargetLocations']);
    Route::get('location/delivery', [LocationController::class, 'getDeliveryLocations']);
    Route::post('location/target', [LocationController::class, 'createTargetLocation']);
    Route::post('location/delivery', [LocationController::class, 'createDeliveryLocation']);
    Route::get('viewTask{id?}', [DashboardController::class, 'getTask']);
    Route::post('completeTask{id?}', [DashboardController::class, 'completeTask']);
});

/**
 * Dashboard
 */
Route::middleware('auth:api', 'throttle:60,1')->group(function () {
    Route::post('interview/select', [InterviewController::class, 'select']);
    Route::get('interview/candidates{task_id?}', [InterviewController::class, 'candidates']);
    Route::post('interview/approve', [InterviewController::class, 'approve']);
    Route::get('task/me', [DashboardController::class, 'getMyTasks']);
    Route::get('task/applied', [DashboardController::class, 'getAppliedTasks']);
    Route::get('user/connects', [ApiUserController::class, 'getConnects']);
    Route::get('feedback/me', [DashboardController::class, 'getMyFeedback']);
    Route::get('feedback{user_id?}', [DashboardController::class, 'getFeedback']);
    Route::post('feedback', [DashboardController::class, 'addFeedback']);
    Route::get('pay/invoice{task_id?}', [DashboardController::class, 'invoice']);
});


/**
 * Chat & Notification
 */
Route::middleware('auth:api', 'throttle:60,1')->group(function () {
    Route::get('messages', [ChatsController::class, 'fetchMessages']);
    Route::post('messages', [ChatsController::class, 'sendMessage']);
    Route::post('pusher/auth', [ChatsController::class, 'authPusher']);
    Route::get('channel{id?}', [ChatsController::class, 'getChannelDetails']);
    Route::get('chat/me/channels', [ChatsController::class, 'getAllMyChatChannels']);
    Route::get('notifications', [NotificationController::class, 'getNotifications']);
    Route::get('notifications/seen', [NotificationController::class, 'markNotificationAsSeen']);
});

/**
 * Payment
 */
Route::post('pay', [PayTabsGatewayController::class, 'index'])->middleware(['auth:api', 'throttle:60,1']);
Route::post('payment/callback', [PayTabsGatewayController::class, 'callback']);


/**
 * Admin
 */
Route::middleware('auth:api', 'admin', 'throttle:60,1')->prefix('admin')->group(function () {
    Route::get('contact-us', [AdminController::class, 'getContactUs']);
    Route::get('users', [AdminController::class, 'getUsers']);
    Route::get('transactions', [AdminController::class, 'getTransactions']);
    Route::get('identities', [AdminController::class, 'getIdentities']);
    Route::delete('user{id?}', [AdminController::class, 'deleteUser']);
    Route::get('tasks', [AdminController::class, 'getTasks']);
    Route::post('assign-privilege', [AdminController::class, 'assignPrivilege']);
    Route::post('identity', [AdminController::class, 'verifyIdentity']);
    Route::get('statistics', [AdminController::class, 'statistics']);
});

Route::middleware('auth:api')->group(function () {
    Route::get('is-admin', [AdminController::class, 'isAdmin']);
    Route::delete('task{id?}', [AdminController::class, 'deleteTask']);
});

Route::post('admin/login', [AdminController::class, 'login']);
Route::post('admin/signup', [AdminController::class, 'signUp']);


/**
 * Public
 */
Route::post('contact-us', [PublichActionController::class, 'sendContactForm']);











// end
