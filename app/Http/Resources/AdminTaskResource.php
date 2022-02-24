<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminTaskResource extends JsonResource
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
            ],
            "target_location" => [
                "id" => $this->targetLocation->id,
                "country" => $this->targetLocation->country,
                "state" => $this->targetLocation->state,
                "city" => $this->targetLocation->city,
                "streat" => $this->targetLocation->streat,
                "address_note" => $this->targetLocation->address_note,
                "longitude" => $this->targetLocation->longitude,
                "latitude" => $this->targetLocation->latitude,
            ],
        ];
    }
}
