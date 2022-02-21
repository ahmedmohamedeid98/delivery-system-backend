<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    use HasFactory;

    public $fillable = [
        "full_name",
        "email",
        "phone",
        "subject",
        "message"
    ];
}
