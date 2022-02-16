<?php

namespace App\Models;

use App\Traits\HasCompositePrimaryKeyTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRequestTask extends Model
{
    use HasFactory, HasCompositePrimaryKeyTrait;
    public $table = "user_request_tasks";
    protected $primaryKey = ['task_id', 'user_id'];

    public $incrementing = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'task_id',
        'user_id',
        'approve_status',
        'bid',
        'letter',
        'created_at',
        'updated_at'
    ];
}
