<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
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
            'about' => $this->about,
            'gender' => $this->gender,
            'identity_status' => $this->identity_status,
            'country' => $this->country,
            'state' => $this->state,
            'city' => $this->city,
            'phone' => $this->phone,
            'total_rate' => $this->total_rate,
            'success_rate' => $this->success_rate,
            'connects' => $this->connects,
            'earning_amount' => $this->earning_amount,
            'spent_amount' => $this->spent_amount,
            'total_orders_amount' => $this->total_orders_amount,
        ];
    }
}
