<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\EmployeeDatatable;

use Illuminate\Http\Request;
use App\Model\Employee;
use Storage;
class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(EmployeeDatatable $admin)
    {
        return $admin->render('admin.employee.index',['title'=> trans('admin.admin_title')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.employee.create',['title'=> trans('admin.create')]);
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
            'employee_name_ar'      => 'required',
            'employee_name_en'      => 'required',
            'restaurant_id'         => 'required',
            'gender'                => 'required',
            'position'              => 'required',
            'salary'                => 'required|numeric',
            'phonenumber'           => 'required|numeric',
            'employee_image'        => validate_image(),
            'other_data'            => 'sometimes|nullable'
        ], [],[
            'employee_name_ar'      => trans('admin.name_ar'),
            'employee_name_en'      => trans('admin.name_en'),
            'restaurant_id'         => trans('admin.restaurant_name'),
            'gender'                => trans('admin.gender'),
            'position'              => trans('admin.position'),
            'salary'                => trans('admin.salary'),
            'phonenumber'           => trans('admin.phonenumber'),
            'employee_image'        => trans('admin.employee_image'),
            'other_data'            => trans('admin.other_data')
        ]);
        if(request()->hasFile('employee_image')) {
            
            $data['employee_image'] = up()->upload([
                // 'new_name'       => '',
                'file'          => 'employee_image',
                'path'          => 'employee_image',
                'upload_type'   => 'single',
                'delete_file'   => '',
            ]);
        }
    
        Employee::create($data);
        session()->flash('success',trans('admin.record_added'));
        return redirect(aurl('employee'));
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
        $employee = Employee::find($id);
        $title = trans('admin.edit_record');
        return view('admin.employee.edit',compact('employee','title'));
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
            'employee_name_ar'      => 'required',
            'employee_name_en'      => 'required',
            'phonenumber'           => 'required|numeric',
            'restaurant_id'         => 'required',
            'gender'                => 'required',
            'position'              => 'required',
            'salary'                => 'required|numeric',
            'employee_image'        => validate_image(),
            'other_data'            => 'sometimes|nullable'
        ], [],[
            'employee_name_ar'      => trans('admin.name_ar'),
            'employee_name_en'      => trans('admin.name_en'),
            'phonenumber'           => trans('admin.phonenumber'),
            'restaurant_id'         => trans('admin.restaurant_name'),
            'gender'                => trans('admin.gender'),
            'position'              => trans('admin.position'),
            'salary'                => trans('admin.salary'),
            'employee_image'        => trans('admin.employee_image'),
            'other_data'            => trans('admin.other_data')
        ]);
        if(request()->hasFile('employee_image')) {
            
            $data['employee_image'] = up()->upload([
                // 'new_name'       => '',
                'file'          => 'employee_image',
                'path'          => 'employee_image',
                'upload_type'   => 'single',
                'delete_file'   => Employee::find($id)->employee_image,
            ]);
        }

        Employee::where('id', $id)->update($data);
        session()->flash('success',trans('admin.record_updated'));
        return redirect(aurl('employee'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Employee::find($id)->delete();
        session()->flash('success',trans('admin.deleted_record'));
        return redirect(aurl('employee'));
    }

    public function multi_delete()
    {
        if(is_array(request('item'))) {
            Employee::destroy(request('item'));
        } else {
            Employee::find(request('item'))->delete();
        }
        session()->flash('success',trans('admin.deleted_record'));
        return redirect(aurl('employee'));
    }

}
