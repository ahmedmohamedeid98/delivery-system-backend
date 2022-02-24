<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Http\Resources\UserResource;
use App\Models\ChatChannel;
use App\Models\Message;
use App\Models\User;
use Exception;
use Illuminate\Broadcasting\Channel;
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
        $channel_id = $request->input('channel_id');
        $user_id = Auth::user()->id;

        Message::create([
            'sender_id' => $user_id,
            'reciver_id' => $reciver_id,
            'message' => $request->input('message'),
            'channel_id' => $channel_id
        ]);
        // broadcast(new MessageSent($message, $channelId))->toOthers();
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

    public function getAllMyChatChannels()
    {
        $user = Auth::user();
        $channels = ChatChannel::orWhere('user1_id', $user->id)->orWhere('user2_id', $user->id)->get();
        $details = [];
        foreach ($channels as $channel) {
            $messages = Message::where('channel_id', $channel->id)->get();
            if ($messages && count($messages) > 0) {
                $chat_with_id = $user->id == $channel->user1_id ? $channel->user2_id : $channel->user1_id;
                $chat_with = User::find($chat_with_id);
                array_push($details, ['chat_with' => new UserResource($chat_with), 'on_channel_id' => $channel->id]);
            }
        }
        NotificationController::storeAndPublish('test notification', $user->id);
        return $this->success('success', ['me' => new UserResource($user), "channels" => $details]);
    }
}
