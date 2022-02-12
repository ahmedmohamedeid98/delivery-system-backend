<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'trans_ref', 
        'trans_amount', 
        'trans_currency', 
        'trans_desc',
        'res_status', 
        'res_msg', 
        'trans_time',
        'payment_method', 
        'payment_card', 
        'ipn_trace'
    ];

}
