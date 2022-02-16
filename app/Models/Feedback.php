<?php

namespace App\Models;

use App\Traits\HasCompositePrimaryKeyTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory, HasCompositePrimaryKeyTrait;

    public $table = "feedback";
    public $primaryKey = ['sender_id', 'reciver_id', 'task_id'];
    public $incrementing = false;

    public $fillable = [
        'sender_id',
        'reciver_id',
        'task_id',
        'rate',
        'content',
    ];
}
