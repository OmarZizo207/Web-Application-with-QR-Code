<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Restaurants extends Model
{
    protected $table = 'restaurants';

    protected $fillable = [
    	'restaurant_name_ar',
    	'restaurant_name_en',
    	'address',
    	'lat',
    	'lng',
    	'facebook_url',
    	'twitter_url',
    	'hotline',
    	'restaurant_logo',
        'visa'

    ];

}
