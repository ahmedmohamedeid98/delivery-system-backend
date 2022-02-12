<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
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
        'user_id',
        'delivery_location_id',
        'target_location_id',
        'paid_service',
        'paid_order',
        'paid_both'
    ];
}
