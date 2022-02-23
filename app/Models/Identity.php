<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Identity extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'identity_front',
        'identity_back',
        'identity_selfy'
    ];

    public function human_readable_date()
    { //dddd Do of MMMM YYYY h:mm:ss A
        return Carbon::parse($this->attributes['created_at'])->isoFormat("Do of MMMM YYYY");
    }
}
