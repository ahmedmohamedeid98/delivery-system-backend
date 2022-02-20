<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatsController extends Controller
{

    /**
     * Fetch all messages
     *
     * @return Message
     */
    public function fetchMessages(Request $request)
    {
        $user_id = Auth::user()->id;
        $reciver_id = $request->query('id');
        $e2eIds = [$user_id, $reciver_id];
        return Message::whereIn('sender_id', $e2eIds)->whereIn('reciver_id', $e2eIds)->orderByDesc('created_at')->get();
    }

    /**
     * Persist message to database
     *
     * @param  Request $request
     * @return Response
     */
    public function sendMessage(Request $request)
    {
        $reciver_id = $request->input('reciver_id');
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        // $message = $user->messages()->create([
        //     'message' => $request->input('message')
        // ]);
        $message = Message::create([
            'sender_id' => $user_id,
            'reciver_id' => $reciver_id,
            'message' => $request->input('message')
        ]);
        broadcast(new MessageSent($user, $message))->toOthers();
        return ['status' => 'Message Sent!'];
    }
}
