<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AboutUserResource extends JsonResource
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
            "identity_status" => $this->identity_status,
            "country" => $this->country,
            "state" => $this->state,
            "city" => $this->city,
            "phone" => $this->phone,
            "total_rate" => $this->total_rate,
            "success_rate" => $this->success_rate,
            "earning_amount" => $this->earning_amount,
            "spent_amount" => $this->spent_amount,
            "total_orders_amount" => $this->total_orders_amount,
            "created_at" => $this->user->human_readable_date(),
            "name" => $this->user->name,
            "photo_url" => $this->user->photo_url,
        ];
    }

    /*
    {
        "user_id": 1,
        "about": "Hi my name is ahmed and i am 32 years old\r\ni work as a doctor for 10 years, and i have 2 children",
        "gender": "male",
        "identity_status": 0,
        "country": "Egypt",
        "state": "Ismailia",
        "city": "Salam",
        "phone": "01054865214",
        "total_rate": 0,
        "success_rate": 0,
        "connects": 55,
        "earning_amount": 0,
        "spent_amount": 0,
        "total_orders_amount": 0,
        "created_at": "2022-02-13T00:33:29.000000Z",
        "updated_at": "2022-02-12T22:40:43.000000Z",
        "user": {
            "id": 1,
            "name": "ahmed",
            "email": "ahmed3@gmail.com",
            "email_verified_at": null,
            "created_at": "2022-02-12T17:40:14.000000Z",
            "updated_at": "2022-02-14T13:25:01.000000Z",
            "google_id": null,
            "facebook_id": null,
            "photo_url": "https://photo.com",
            "identity_id": 3
        }
    }
     */
}
