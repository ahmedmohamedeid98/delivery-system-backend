<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewMessageEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $from_id;
    public $to_id;
    public $last_message;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($from_id, $to_id, $last_message)
    {
        $this->from_id = $from_id;
        $this->to_id = $to_id;
        $this->last_message = $last_message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PresenceChannel('new-messages.' . $this->to_id);
    }

    public function broadcastAs()
    {
        return 'new-messages-event';
    }
}
