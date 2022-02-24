<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class IdentityResource extends JsonResource
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
            'id' => $this->id,
            'identity_front' => $this->identity_front,
            'identity_back' => $this->identity_back,
            'identity_selfy' => $this->identity_selfy,
            'created_at' => $this->human_readable_date(),
            'user' => new UserResource($this->user),

        ];
    }
}
