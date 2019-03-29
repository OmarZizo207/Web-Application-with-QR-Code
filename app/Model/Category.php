<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
    	'name_ar',
    	'name_en',
        'restaurant_id',
        'menu_id',
    	'description',
    	'other_data',
    ];

    public function restaurant_id()
    {
        return $this->hasOne('App\Model\Restaurants', 'id', 'restaurant_id');
    }

    public function menu_id()
    {
    	return $this->hasOne('App\Model\Menu', 'id', 'menu_id');
    }

}
