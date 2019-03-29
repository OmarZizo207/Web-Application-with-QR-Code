<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'carts';

    protected $fillable = [
    	'item_id',
    	'quantity',
    	'user_id'
    ];
}
