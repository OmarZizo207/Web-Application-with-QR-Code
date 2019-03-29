<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\TableDatatable;

use Illuminate\Http\Request;
use App\Model\Table;
use Storage;
class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TableDatatable $admin)
    {
        return $admin->render('admin.table.index',['title'=> trans('admin.admin_title')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.table.create',['title'=> trans('admin.create')]);
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
            'table_name'               => 'required',
            'restaurant_id'            => 'required',
        ], [],[
            'table_name'               => trans('admin.table_name'),
            'restaurant_id'            => trans('admin.restaurant_name'),
        ]);
        Table::create($data);
        session()->flash('success',trans('admin.record_added'));
        return redirect(aurl('tables'));
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
        $table = Table::find($id);
        $title = trans('admin.edit_record');
        return view('admin.table.edit',compact('table','title'));
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
            'table_name'               => 'required',
            'restaurant_id'            => 'required',
        ], [],[
            'table_name'               => trans('admin.table_name'),
            'restaurant_id'            => trans('admin.restaurant_id'),
        ]);

        Table::where('id', $id)->update($data);
        session()->flash('success',trans('admin.record_updated'));
        return redirect(aurl('tables'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Table::find($id)->delete();
        session()->flash('success',trans('admin.deleted_record'));
        return redirect(aurl('tables'));
    }

    public function multi_delete()
    {
        if(is_array(request('item'))) {
            Table::destroy(request('item'));
        } else {
            Table::find(request('item'))->delete();
        }
        session()->flash('success',trans('admin.deleted_record'));
        return redirect(aurl('tables'));
    }

}
