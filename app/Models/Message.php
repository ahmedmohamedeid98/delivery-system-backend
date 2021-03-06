<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id',
        'reciver_id',
        'message',
        'channel_id',
        'seen'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
