<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\MenuDatatable;

use Illuminate\Http\Request;
use App\Model\Menu;
use Storage;
class MenusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MenuDatatable $admin)
    {
        return $admin->render('admin.menu.index',['title'=> trans('admin.admin_title')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.menu.create',['title'=> trans('admin.create')]);
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
            'menu_name_ar'      => 'required',
            'menu_name_en'      => 'required',
            'restaurant_id'     => 'required',
            'menu_image'        => validate_image(),
            'other_data'        => 'sometimes|nullable'
        ], [],[
            'menu_name_ar'      => trans('admin.name_ar'),
            'menu_name_en'      => trans('admin.name_en'),
            'restaurant_id'     => trans('admin.restaurant_name'),
            'menu_image'        => trans('admin.menu_image'),
            'other_data'        => trans('admin.other_data')
        ]);
        if(request()->hasFile('menu_image')) {
            
            $data['menu_image'] = up()->upload([
                // 'new_name'       => '',
                'file'          => 'menu_image',
                'path'          => 'menu_image',
                'upload_type'   => 'single',
                'delete_file'   => '',
            ]);
        }
    
        Menu::create($data);
        session()->flash('success',trans('admin.record_added'));
        return redirect(aurl('menu'));
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
        $menu = Menu::find($id);
        $title = trans('admin.edit_record');
        return view('admin.menu.edit',compact('menu','title'));
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
            'menu_name_ar'      => 'required',
            'menu_name_en'      => 'required',
            'restaurant_id'     => 'required',
            'menu_image'        => validate_image(),
            'other_data'        => 'sometimes|nullable'
        ], [],[
            'menu_name_ar'      => trans('admin.name_ar'),
            'menu_name_en'      => trans('admin.name_en'),
            'restaurant_id'     => trans('admin.restaurant_name'),
            'menu_image'        => trans('admin.menu_image'),
            'other_data'        => trans('admin.other_data')
        ]);
        if(request()->hasFile('menu_image')) {
            
            $data['menu_image'] = up()->upload([
                // 'new_name'       => '',
                'file'          => 'menu_image',
                'path'          => 'menu_image',
                'upload_type'   => 'single',
                'delete_file'   => menu::find($id)->menu_image,
            ]);
        }

        Menu::where('id', $id)->update($data);
        session()->flash('success',trans('admin.record_updated'));
        return redirect(aurl('menu'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Menu::find($id)->delete();
        session()->flash('success',trans('admin.deleted_record'));
        return redirect(aurl('menu'));
    }

    public function multi_delete()
    {
        if(is_array(request('item'))) {
            Menu::destroy(request('item'));
        } else {
            Menu::find(request('item'))->delete();
        }
        session()->flash('success',trans('admin.deleted_record'));
        return redirect(aurl('menu'));
    }

}
