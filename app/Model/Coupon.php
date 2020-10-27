<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $table = 'coupons';

    protected $fillable = [
        'title',
        'value'
    ];
}
