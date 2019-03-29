<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menus';

    protected $fillable = [
    	'menu_name_ar',
    	'menu_name_en',
    	'restaurant_id',
    	'menu_image',
    	'other_data'
    ];

    public function restaurant_id()
    {
    	return $this->hasOne('App\Model\Restaurants', 'id', 'restaurant_id');
    }
}
