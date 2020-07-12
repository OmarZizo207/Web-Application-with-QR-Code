<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\AdminDatatable;

use Illuminate\Http\Request;
use App\Admin;

class AdminController extends Controller
{
    public function index(AdminDatatable $admin)
    {
        return $admin->render('admin.admins.index',['title'=> trans('admin.admin_title')]);
    }

    public function create()
    {
        return view('admin.admins.create',['title'=> trans('admin.create_admin')]);
    }

    public function store()
    {
        $data = $this->validate(request(),[
            'name'      => 'required',
            'email'     => 'required|email|unique:admins',
            'password'  => 'required|min:6'
        ], [],[
            'name'      => trans('admin.name'),
            'email'     => trans('admin.email'),
            'password'  => trans('admin.password'),
        ]);
        $data['password'] = bcrypt(request('password'));

        Admin::create($data);
        session()->flash('success',trans('admin.record_added'));
        return redirect(aurl('admin'));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $admin = Admin::find($id);
        $title = trans('admin.edit_record');
        return view('admin.admins.edit',compact('admin','title'));
    }

    public function update($id)
    {
        $data = $this->validate(request(),[
            'name'      => 'required',
            'email'     => 'required|email|unique:admins,email,'.$id,
            'password'  => 'sometimes|nullable|min:6'
        ], [],[
            'name'      => trans('admin.name'),
            'email'     => trans('admin.email'),
            'password'  => trans('admin.password'),
        ]);
        if(request()->has('password')) {
            $data['password'] = bcrypt(request('password'));
        }

        Admin::where('id', $id)->update($data);
        session()->flash('success',trans('admin.record_updated'));
        return redirect(aurl('admin'));
    }

    public function destroy($id)
    {
        Admin::find($id)->delete();
        session()->flash('success',trans('admin.deleted_record'));
        return redirect(aurl('admin'));
    }

    public function multi_delete()
    {
        if(is_array(request('item'))) {
            Admin::destroy(request('item'));
        } else {
            Admin::find(request('item'))->delete();
        }
        session()->flash('success',trans('admin.deleted_record'));
        return redirect(aurl('admin'));
    }

}
