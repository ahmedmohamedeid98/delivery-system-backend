<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TaskEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $task;
    public $deliveryLocation;
    public $targetLocation;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($task, $deliveryLocation, $targetLocation)
    {
        $this->task = $task;
        $this->deliveryLocation = $deliveryLocation;
        $this->targetLocation = $targetLocation;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        $channel = '';
        if ($this->targetLocation->city != '') {
            $channel = 'tasks.' . $this->targetLocation->state . '.' . $this->targetLocation->city;
        } else {
            $channel = 'tasks.' . $this->targetLocation->state;
        }
        return new PrivateChannel(str_replace(' ', '_', $channel));
    }

    public function broadcastAs()
    {
        return "task-event";
    }

    public function broadcastWith()
    {
        return [
            'task' => $this->task,
            'delivery_location' => $this->deliveryLocation
        ];
    }
}
