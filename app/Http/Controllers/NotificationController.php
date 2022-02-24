<?php

namespace App\Http\Controllers;

use App\Events\notifyEvent;
use App\Http\Resources\NotificationResource;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function getNotifications()
    {
        $user_id = Auth::user()->id;
        $notifications = Notification::orderByDesc('created_at')->where('user_id', $user_id)->limit(10)->get();
        return $this->success('success', NotificationResource::collection($notifications));
    }

    public function markNotificationAsSeen()
    {
        $user_id = Auth::user()->id;
        Notification::where('user_id', $user_id)->update(['seen' => 1]);
        return $this->success('success');
    }

    static function storeAndPublish($text, $user_id)
    {
        $notification = Notification::create([
            'user_id' => $user_id,
            'text' => $text
        ]);
        broadcast(new notifyEvent(new NotificationResource($notification)));
    }
}
