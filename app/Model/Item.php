<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'items';

    protected $fillable = [
    	'title',
    	'content',
    	'description',
        'restaurant_id',
        'menu_id',
    	'category_id',
    	'photo',
    	'price',
    	'start_at',
    	'end_at',
    	'price_offer',
    	'start_offer_at',
    	'end_offer_at',
        'calories',
    	'is_public',
    	'reason',
    	'other_data',
    ];

    public function other_data()
    {
        return $this->hasMany('App\Model\OtherData', 'item_id', 'id');
    }

    public function category_id()
    {
    	return $this->hasOne('App\Model\Category', 'id', 'category_id');
    }

    public function restaurant_id()
    {
        return $this->hasOne('App\Model\Restaurants', 'id', 'restaurant_id');
    }

    public function menu_id()
    {
        return $this->hasOne('App\Model\Menu', 'id', 'menu_id');
    }

    public function files()
    {
        return $this->hasMany('App\File', 'relation_id', 'id')->where('file_type','item');
    }

//    public function scopeWhenSearch($query, $price_from, $price_to, $category)
//    {
//        return $query->when()
//    }
}
