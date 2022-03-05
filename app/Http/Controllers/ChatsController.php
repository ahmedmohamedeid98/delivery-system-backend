<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Events\NewMessageEvent;
use App\Http\Resources\MessageResource;
use App\Http\Resources\UserResource;
use App\Models\ChatChannel;
use App\Models\Message;
use App\Models\User;
use Exception;
use Illuminate\Broadcasting\Channel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
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
            // Auth to Private Channel
            // return $pusher->socketAuth($channel_name, $socket_id);
            // Auth to Presence Channel (Track User)
            $presenceData = ['id' => $user->id, 'name' => $user->name];
            return $pusher->presenceAuth(
                $channel_name,
                $socket_id,
                $user->id,
                $presenceData
            );
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
        $messages = Message::where('channel_id', $channelId)->get();
        $messagesCount = count($messages);
        if ($messagesCount > 0) {
            $lastMessage = $messages[$messagesCount - 1];
            if ($lastMessage->reciver_id == $user_id) {
                $this->seenMessagesWhenEnter($channelId);
            }
        }
        return $messages;
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
        $seen = $request->input('seen');
        $user_id = Auth::user()->id;
        $message = $request->input('message');

        Message::create([
            'sender_id' => $user_id,
            'reciver_id' => $reciver_id,
            'message' => $message,
            'seen' => $seen,
            'channel_id' => $channel_id
        ]);
        // broadcast(new NewMessageEvent($user_id, $reciver_id, $message))->toOthers();
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
            $messagesCount = count($messages);
            if ($messages && $messagesCount > 0) {
                $chat_with_id = $user->id == $channel->user1_id ? $channel->user2_id : $channel->user1_id;
                $chat_with = User::find($chat_with_id);
                $lastMessage = $messages[$messagesCount - 1];
                $unseen_count = count(array_filter(MessageResource::collection($messages)->response()->getData()->data, function ($msg) {
                    return $msg->seen == 0;
                }));
                array_push($details, ['chat_with' => new UserResource($chat_with), 'on_channel_id' => $channel->id, 'last_message' => $lastMessage->message, 'send_by_id' => $lastMessage->sender_id, 'unseen_count' => $unseen_count]);
            }
        }
        return $this->success('success', ['me' => new UserResource($user), "channels" => $details]);
    }


    public function seenMessagesWhenEnter($channel_id)
    {
        if ($channel_id && is_numeric($channel_id)) {
            Message::where('channel_id', $channel_id)->update(['seen' => true]);
        }
    }

    public function seenMessagesWhenLeave(Request $request)
    {
        $channel_id = $request->query('$channel_id');
        if ($channel_id && is_numeric($channel_id)) {
            Message::where('channel_id', $channel_id)->update(['seen' => true]);
            return $this->success('success');
        } else {
            return $this->failure(['invalid channel id']);
        }
    }
}
