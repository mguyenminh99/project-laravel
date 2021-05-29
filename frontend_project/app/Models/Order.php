<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'full_name',
        'address',
        'mobile',
        'email',
        'note',
        'total_price',
        'payment_status',
        'coupon',
        'discount'
    ];
}
