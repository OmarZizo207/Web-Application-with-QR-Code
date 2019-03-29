@extends('admin.index')
@section('content')

<div class="box">
  <div class="box-header">
    <h3 class="box-title"> {{$title}} </h3>
  </div>
  <div class="box-body">
    {!! Form::open(['route' => 'employee.store','files' => true]) !!}
      <div class="form-group">
        {!! Form::label('employee_name_ar',trans('admin.name_ar')) !!}
        {!! Form::text('employee_name_ar',old('employee_name_ar'), ['class' => 'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('employee_name_en',trans('admin.name_en')) !!}
        {!! Form::text('employee_name_en',old('employee_name_en'), ['class' => 'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('restaurant_id',trans('admin.restaurant_name')) !!}
        {!! Form::select('restaurant_id',App\Model\Restaurants::pluck('restaurant_name_'.session('lang'), 'id'), old('restaurant_id'), ['class'=>'form-control','placeholder'=>trans('admin.choose_restaurant')]) !!}
      </div>      
      <div class="form-group">
        {!! Form::label('gender',trans('admin.gender')) !!}
        {!! Form::select('gender',['male' => trans('admin.male'),'female' => trans('admin.female')], old('gender'), ['class' => 'form-control', 'placeholder' => trans('admin.choose_gender')]) !!}
      </div>
      <div class="form-group">
        {!! Form::label('position',trans('admin.position')) !!}
        {!! Form::select('position',['manager' => trans('admin.manager'), 'supervisor' => trans('admin.supervisor'), 'bar' => trans('admin.bar'), 'chief' => trans('admin.chief')], old('position'), ['class' => 'form-control', 'placeholder' => trans('admin.choose_position')]) !!}
      </div>
      <div class="form-group">
        {!! Form::label('salary',trans('admin.salary')) !!}
        {!! Form::text('salary',old('salary'), ['class' => 'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('phonenumber',trans('admin.phonenumber')) !!}
        {!! Form::text('phonenumber',old('phonenumber'), ['class' => 'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('employee_image',trans('admin.employee_image')) !!}
        {!! Form::file('employee_image', ['class' => 'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('other_data',trans('admin.other_data')) !!}
        {!! Form::textarea('other_data' ,old('other_data') , ['class' => 'form-control', 'placeholder' => trans('admin.other_data')]) !!}
      </div>
      {!! Form::submit(trans('admin.create'),['classs' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
  </div>
</div>

@endsection