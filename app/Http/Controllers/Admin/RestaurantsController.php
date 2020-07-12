<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\RestaurantsDatatable;

use Illuminate\Http\Request;
use App\Model\Restaurants;
use Storage;
class RestaurantsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(RestaurantsDatatable $admin)
    {
        return $admin->render('admin.restaurants.index',['title'=> trans('admin.admin_title')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.restaurants.create',['title'=> trans('admin.create')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $data = $this->validate(request(),[
            'restaurant_name_ar'        => 'required',
            'restaurant_name_en'        => 'required',
            'address'                   => 'sometimes|nullable',
            'lat'                       => 'sometimes|nullable|numeric',
            'lng'                       => 'sometimes|nullable|numeric',
            'facebook_url'              => 'sometimes|nullable|url',
            'twitter_url'               => 'sometimes|nullable|url',
            'hotline'                   => 'required|numeric',
            'restaurant_logo'           => validate_image(),
            'visa'                      => 'sometimes|nullable|numeric'
        ], [],[
            'restaurant_name_ar'        => trans('admin.restaurant_name_ar'),
            'restaurant_name_en'        => trans('admin.restaurant_name_en'),
            'address'                   => trans('admin.address'),
            'lat'                       => trans('admin.lat'),
            'lng'                       => trans('admin.lng'),
            'facebook_url'              => trans('admin.facebook_url'),
            'twitter_url'               => trans('admin.twitter_url'),
            'hotline'                   => trans('admin.hotline'),
            'restaurant_logo'           => trans('admin.restaurant_logo'),
            'visa'                      => trans('admin.visa')
        ]);
        if(request()->hasFile('restaurant_logo')) {

            $data['restaurant_logo'] = up()->upload([
                // 'new_name'       => '',
                'file'          => 'restaurant_logo',
                'path'          => 'restaurants_logo',
                'upload_type'   => 'single',
                'delete_file'   => '',
            ]);
        }

        Restaurants::create($data);
        session()->flash('success',trans('admin.record_added'));
        return redirect(aurl('restaurants'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $restaurant = Restaurants::find($id);
        $title = trans('admin.edit_record');
        return view('admin.restaurants.edit',compact('restaurant','title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $data = $this->validate(request(),[
            'restaurant_name_ar'        => 'required',
            'restaurant_name_en'        => 'required',
            'address'                   => 'sometimes|nullable',
            'lat'                       => 'sometimes|nullable|numeric',
            'lng'                       => 'sometimes|nullable|numeric',
            'facebook_url'              => 'sometimes|nullable|url',
            'twitter_url'               => 'sometimes|nullable|url',
            'hotline'                   => 'required|numeric',
            'restaurant_logo'           => validate_image(),
            'visa'                      => 'sometimes|nullable|numeric'
        ], [],[
            'restaurant_name_ar'        => trans('admin.restaurant_name_ar'),
            'restaurant_name_en'        => trans('admin.restaurant_name_en'),
            'address'                   => trans('admin.address'),
            'lat'                       => trans('admin.lat'),
            'lng'                       => trans('admin.lng'),
            'facebook_url'              => trans('admin.facebook_url'),
            'twitter_url'               => trans('admin.twitter_url'),
            'hotline'                   => trans('admin.hotline'),
            'restaurant_logo'           => trans('admin.restaurant_logo'),
            'visa'                      => trans('admin.visa'),
        ]);
        if(request()->hasFile('restaurant_logo')) {

            $data['restaurant_logo'] = up()->upload([
                // 'new_name'       => '',
                'file'          => 'restaurant_logo',
                'path'          => 'restaurants_logo',
                'upload_type'   => 'single',
                'delete_file'   => Restaurants::find($id)->restaurant_logo,
            ]);
        }

        Restaurants::where('id', $id)->update($data);
        session()->flash('success',trans('admin.record_updated'));
        return redirect(aurl('restaurants'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Restaurants::find($id)->delete();
        session()->flash('success',trans('admin.deleted_record'));
        return redirect(aurl('admin'));
    }

    public function multi_delete()
    {
        if(is_array(request('item'))) {
            Restaurants::destroy(request('item'));
        } else {
            Restaurants::find(request('item'))->delete();
        }
        session()->flash('success',trans('admin.deleted_record'));
        return redirect(aurl('admin'));
    }

}
