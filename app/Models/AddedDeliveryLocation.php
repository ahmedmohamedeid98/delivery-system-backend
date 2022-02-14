<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddedDeliveryLocation extends Model
{
    use HasFactory;



    public $table = "user_add_delivery_location";
    public $primaryKey = ['user_id', 'delivery_location_id'];
    public $incrementing = false;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'delivery_location_id'
    ];
}
