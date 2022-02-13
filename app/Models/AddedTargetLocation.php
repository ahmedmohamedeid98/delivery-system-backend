<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddedTargetLocation extends Model
{
    use HasFactory;

    public function targetLocation()
    {
        return $this->hasOne(TargetLocation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public $table = "user_add_target_location";
    public $primaryKey = ['user_id', 'target_location_id'];
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'target_location_id'
    ];
}
