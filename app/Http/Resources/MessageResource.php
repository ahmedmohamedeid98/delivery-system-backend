<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'sender_id' => $this->sender_id,
            'reciver_id' => $this->reciver_id,
            'message' => $this->message,
            'channel_id' => $this->channel_id,
            'seen' => $this->seen
        ];
    }
}
