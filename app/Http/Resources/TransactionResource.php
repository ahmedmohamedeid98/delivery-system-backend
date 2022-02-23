<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
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
            'trans_ref' => $this->trans_ref,
            'user_id' => $this->user_id,
            'task_id' => $this->task_id,
            'trans_amount' => $this->trans_amount,
            'trans_currency' => $this->trans_currency,
            'trans_desc' => $this->trans_desc,
            'trans_type' => $this->trans_type,
            'res_status' => $this->res_status,
            'res_msg' => $this->res_msg,
            'trans_time' => $this->trans_time,
            'payment_method' => $this->payment_method,
            'payment_card' => $this->payment_card,
            'ipn_trace' => $this->ipn_trace
        ];
    }
}
