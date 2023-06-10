<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'start_date',
        'expiry_date',
        'discount_price',
        'status',
    ];

    protected $dates = [
        'start_date',
        'expiry_date',
    ];
}

