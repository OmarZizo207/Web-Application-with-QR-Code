<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    protected $table = 'tables';

    protected $fillable = [
    	'table_name',
    	'restaurant_id',
    ];

    public function restaurant_id()
    {
    	return $this->hasOne('App\Model\Restaurants', 'id', 'restaurant_id');
    }
}
