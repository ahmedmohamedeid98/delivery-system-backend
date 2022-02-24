<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    public $fillable = [
        'user_id',
        'text',
        'seen',
    ];

    public function human_readable_date()
    {
        return Carbon::parse($this->attributes['created_at'])->isoFormat("Do of MMMM YYYY h:mm A");
    }
}
