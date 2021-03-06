<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['bail', 'required', 'string', 'max:255'],
            // 'task_status' => ['nullable', Rule::in([1, 2, 3])],
            'description' => ['required', 'string', 'max:1200'],
            'budget' => ['required', 'integer'],
            'order_cost' => ['nullable', 'integer'],
            'payment_method' => ['required', 'integer', Rule::in([0, 1])],
            'required_invoice' => ['required', 'boolean'],
            'note' => ['nullable', 'string'],
            'order_status' => ['nullable', 'integer', Rule::in([0, 1, 2, 3])],
            'travel_status' => ['nullable', 'integer', Rule::in([0, 1, 2, 3])],
            'delivery_date' => ['required', 'date'],
            'delivery_location_id' => ['required', 'integer', 'exists:user_add_delivery_location'],
            'target_location_id' => ['required', 'integer', 'exists:user_add_target_location'],
            'paid_service' => ['nullable', 'integer'],
            'paid_order' => ['nullable', 'integer'],
            'paid_both' => ['nullable', 'integer']
        ];
    }
}

/*
title,task_status,description,budget,payment_method,required_invoice,delivery_date,delivery_location_id,target_location_id
note,
            'task_status',
            'description',
            'budget',
            'order_cost',
            'payment_method',
            'required_invoice',
            'note',
            'order_status',
            'travel_status',
            'delivery_date',
            'delivery_location_id',
            'target_location_id',
            'paid_service' => ['nullable', 'integer'],
            'paid_order' => ['nullable', 'integer'],
            'paid_both' => 
*/