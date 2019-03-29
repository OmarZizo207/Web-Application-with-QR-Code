<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\CategoryDatatable;

use Illuminate\Http\Request;
use App\Model\Category;
use Storage;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CategoryDatatable $admin)
    {
        return $admin->render('admin.category.index',['title'=> trans('admin.admin_title')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create',['title'=> trans('admin.create')]);
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
            'name_ar'               => 'required',
            'name_en'               => 'required',
            'restaurant_id'         => 'required|numeric',
            'menu_id'               => 'required|numeric',
            'description'           => 'sometimes|nullable',
            'other_data'            => 'sometimes|nullable'
        ], [],[
            'name_ar'               => trans('admin.name_ar'),
            'name_en'               => trans('admin.name_en'),
            'restaurant_id'         => trans('admin.restaurant_name_'.lang()),
            'menu_id'               => trans('admin.menu_name'),
            'description'           => trans('admin.description'),
            'other_data'            => trans('admin.other_data')
        ]);
    
        Category::create($data);
        session()->flash('success',trans('admin.record_added'));
        return redirect(aurl('category'));
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
        $category = Category::find($id);
        $title = trans('admin.edit_record');
        return view('admin.category.edit',compact('category','title'));
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
            'name_ar'               => 'required',
            'name_en'               => 'required',
            'restaurant_id'         => 'required|numeric',            
            'menu_id'               => 'required|numeric',
            'description'           => 'sometimes|nullable',            
            'other_data'            => 'sometimes|nullable'
        ], [],[
            'name_ar'               => trans('admin.name_ar'),
            'name_en'               => trans('admin.name_en'),
            'restaurant_id'         => trans('admin.restaurant_name_'.lang()),
            'menu_id'               => trans('admin.menu_name'),
            'description'           => trans('admin.description'),
            'other_data'            => trans('admin.other_data')
        ]);

        Category::where('id', $id)->update($data);
        session()->flash('success',trans('admin.record_updated'));
        return redirect(aurl('category'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::find($id)->delete();
        session()->flash('success',trans('admin.deleted_record'));
        return redirect(aurl('category'));
    }

    public function multi_delete()
    {
        if(is_array(request('item'))) {
            Category::destroy(request('item'));
        } else {
            Category::find(request('item'))->delete();
        }
        session()->flash('success',trans('admin.deleted_record'));
        return redirect(aurl('category'));
    }

}
