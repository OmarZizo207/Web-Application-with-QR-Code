<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $table = 'orders';

    protected $fillable = [
    	'user_id',
    	'item_id',
    	'quantity',
        'table',
        'status'
    ];

    public function items()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
