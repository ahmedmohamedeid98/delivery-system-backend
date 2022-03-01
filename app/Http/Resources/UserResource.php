<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'account_status' => $this->account_status,
            'is_admin' => $this->is_admin,
            'created_at' => $this->created_at,
        ];
    }

    private function getEmail()
    {
        // check email 
        if ($this->facebook_id == null) {
            return $this->email;
        } else {
            $username = explode('@', $this->email)[0];
            if ($username == $this->facebook_id) {
                return null;
            } else {
                return $this->email;
            }
        }
    }
}
