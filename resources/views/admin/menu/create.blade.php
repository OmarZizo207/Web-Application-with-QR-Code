@extends('admin.index')
@section('content')

<div class="box">
  <div class="box-header">
    <h3 class="box-title"> {{$title}} </h3>
  </div>
  <div class="box-body">
    {!! Form::open(['route' => 'menu.store','files' => true]) !!}
      <div class="form-group">
        {!! Form::label('menu_name_ar',trans('admin.name_ar')) !!}
        {!! Form::text('menu_name_ar',old('menu_name_ar'), ['class' => 'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('menu_name_en',trans('admin.name_en')) !!}
        {!! Form::text('menu_name_en',old('menu_name_en'), ['class' => 'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('restaurant_id',trans('admin.restaurant_name')) !!}
        {!! Form::select('restaurant_id',App\Model\Restaurants::pluck('restaurant_name_'.session('lang'), 'id'), old('restaurant_id'), ['class'=>'form-control','placeholder'=>trans('admin.choose_restaurant')]) !!}
      </div>      
      <div class="form-group">
        {!! Form::label('menu_image',trans('admin.menu_image')) !!}
        {!! Form::file('menu_image', ['class' => 'form-control']) !!}
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