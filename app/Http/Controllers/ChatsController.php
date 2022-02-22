<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Http\Resources\UserResource;
use App\Models\ChatChannel;
use App\Models\Message;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Pusher\Pusher;

class ChatsController extends Controller
{


    public function authPusher(Request $request)
    {
        $user = Auth::user();
        $socket_id = $request->socket_id;
        $channel_name = $request->channel_name;
        $key = env('PUSHER_APP_KEY');
        $secret = env('PUSHER_APP_SECRET');
        $app_id = env('PUSHER_APP_ID');
        if ($user) {
            $pusher = new Pusher($key, $secret, $app_id);
            return $pusher->socketAuth($channel_name, $socket_id);
        }
    }
    /**
     * Fetch all messages
     *
     * @return Message
     */
    public function fetchMessages(Request $request)
    {
        $user_id = Auth::user()->id;
        $reciver_id = $request->query('id');
        $channelId = $this->getChatChannelId($user_id, $reciver_id);
        return Message::where('channel_id', $channelId)->get();
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
        $user_id = $request->input('sender_id');
        $user_id = Auth::user()->id;
        if ($reciver_id == $user_id) {
            return $this->failure(['user can not chat with himself!']);
        }
        $channelId = $this->getChatChannelId($user_id, $reciver_id);


        // $user = User::find($user_id);
        // $message = $user->messages()->create([
        //     'message' => $request->input('message')
        // ]);
        $message = Message::create([
            'sender_id' => $user_id,
            'reciver_id' => $reciver_id,
            'message' => $request->input('message'),
            'channel_id' => $channelId
        ]);
        // broadcast(new MessageSent($message, $channelId))->toOthers();

        // return ['status' => 'Message Sent!'];
        // return response($request->all(), 200);
    }


    private function getChatChannelId($sender_id, $reciver_id)
    {
        $ids = [$sender_id, $reciver_id];
        $channelId = ChatChannel::whereIn('user1_id', $ids)->whereIn('user2_id', $ids)->limit(1)->get('id');
        if (!$channelId || count($channelId) == 0) {
            if ($sender_id == $reciver_id) return 0;
            $channel = ChatChannel::create([
                'user1_id' => $sender_id,
                'user2_id' => $reciver_id,
            ]);
            return $channel->id;
        }
        return $channelId[0]->id;
    }

    public function getChannelDetails(Request $request)
    {
        try {
            $client_id = $request->query('id');
            $client = User::find($client_id);
            $user = Auth::user();
            $user_id = $user->id;
            $channel = $this->getChatChannelId($user_id, $client_id);
            return $this->success('success', ['me' => new UserResource($user), 'chat_with' => new UserResource($client), 'on_channel_id' => $channel]);
        } catch (Exception $e) {
            return $this->failure([$e->getMessage()]);
        }
    }
}
