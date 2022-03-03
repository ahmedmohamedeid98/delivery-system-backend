<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EDeleiveryFailure extends Model
{
    use HasFactory;
    public $table = "failures";

    public $fillable = [
        'failure'
    ];
}
