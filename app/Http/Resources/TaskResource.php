<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
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
            "id" => $this->id,
            "title" => $this->title,
            "task_status" => $this->task_status,
            "description" => $this->description,
            "budget" => $this->budget,
            "order_cost" => $this->order_cost,
            "payment_method" => $this->payment_method,
            "required_invoice" => $this->required_invoice,
            "note" => $this->note,
            "order_status" => $this->order_status,
            "travel_status" => $this->travel_status,
            "delivery_date" => $this->delivery_date,
            "user_id" => $this->user_id,
            "delivery_location_id" => $this->delivery_location_id,
            "target_location_id" => $this->target_location_id,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "paid_service" => $this->paid_service,
            "paid_order" => $this->paid_order,
            "paid_both" => $this->paid_both,
            "delivery_location" => [
                "id" => $this->deliveryLocation->id,
                "country" => $this->deliveryLocation->country,
                "state" => $this->deliveryLocation->state,
                "city" => $this->deliveryLocation->city,
                "streat" => $this->deliveryLocation->streat,
                "address_note" => $this->deliveryLocation->address_note,
                "longitude" => $this->deliveryLocation->longitude,
                "latitude" => $this->deliveryLocation->latitude,
            ]
        ];
    }
    /*
    {
            "id": 4,
            "title": "maksd fsd flfsd f",
            "task_status": 0,
            "description": "s;ldfsd fdslfmds fsd;lfsd f",
            "budget": 200,
            "order_cost": 0,
            "payment_method": 1,
            "required_invoice": 1,
            "note": "",
            "order_status": 0,
            "travel_status": 0,
            "delivery_date": "2022-02-17 00:00:00",
            "user_id": 1,
            "delivery_location_id": 1,
            "target_location_id": 1,
            "created_at": "2022-02-16T18:24:55.000000Z",
            "updated_at": "2022-02-16T18:24:55.000000Z",
            "paid_service": null,
            "paid_order": null,
            "paid_both": null,
            "delivery_location": {
                "id": 1,
                "country": "Egypt",
                "state": "Giza",
                "city": "Al Ayat",
                "streat": "Naser 25",
                "address_note": "may be no",
                "longitude": 23.56656,
                "latitude": 13.56555,
                "created_at": "2022-02-12T23:45:17.000000Z",
                "updated_at": "2022-02-12T23:45:17.000000Z"
            },
            "target_location": {
                "id": 1,
                "country": "Egypt",
                "state": "Cairo",
                "city": "Giza",
                "streat": "25 mohamed mahmoad",
                "address_note": "near by mo",
                "longitude": null,
                "latitude": null,
                "radius": null,
                "created_at": "2022-02-12T23:42:59.000000Z",
                "updated_at": "2022-02-12T23:42:59.000000Z"
            }
        },
    */
}
