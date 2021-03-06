<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public $table = "profile";
    public $primaryKey = "user_id";


    protected $fillable = [
        'user_id',
        'about',
        'gender',
        'identity_status',
        'country',
        'state',
        'city',
        'phone',
        'total_rate',
        'success_rate',
        'connects',
        'earning_amount',
        'spent_amount',
        'total_orders_amount'
    ];
}
