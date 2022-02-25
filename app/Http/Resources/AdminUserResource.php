<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminUserResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->getEmail(),
            'photo_url' => $this->photo_url,
            'is_admin' => $this->is_admin,
            'created_at' => $this->created_at,
            'profile' => new ProfileResource($this->profile),
        ];
    }
}
