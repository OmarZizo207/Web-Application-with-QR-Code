<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees';
    // public $timestamps = false;

    protected $fillable = [
    	'employee_name_ar',
    	'employee_name_en',
    	'restaurant_id',
    	'gender',
    	'position',
    	'salary',
    	'phonenumber',
    	'employee_image',
    	'other_data'
    ];

    public function restaurant_id()
    {
    	return $this->hasOne('App\Model\Restaurants', 'id', 'restaurant_id');
    }
}
