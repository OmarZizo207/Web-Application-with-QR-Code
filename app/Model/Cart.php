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

    public function items()
    {
        return $this->belongsTo(Item::class, 'item_id');
//        return $this->hasMany(Item::class, 'id','item_id');
    }
}
