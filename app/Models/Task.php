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

    public function deliveryLocation()
    {
        return $this->belongsTo(DeliveryLocation::class);
    }

    public function targetLocation()
    {
        return $this->belongsTo(TargetLocation::class);
    }

    public function feedback()
    {
        return $this->hasMany(Feedback::class);
    }

    public function offers()
    {
        return $this->hasMany(UserRequestTask::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }


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
        'paid_both',
        'complete_code'
    ];
}
