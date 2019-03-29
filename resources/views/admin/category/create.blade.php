@extends('admin.index')
@section('content')

<div class="box">
  <div class="box-header">
    <h3 class="box-title"> {{$title}} </h3>
  </div>
  <div class="box-body">
    {!! Form::open(['route' => 'category.store','files' => true]) !!}
      <div class="form-group">
        {!! Form::label('name_ar',trans('admin.name_ar')) !!}
        {!! Form::text('name_ar',old('name_ar'), ['class' => 'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('name_en',trans('admin.name_en')) !!}
        {!! Form::text('name_en',old('name_en'), ['class' => 'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('restaurant_id',trans('admin.restaurant_name')) !!}
        {!! Form::select('restaurant_id',App\Model\Restaurants::pluck('restaurant_name_'.session('lang'), 'id'), old('restaurant_id'), ['class'=>'form-control','placeholder' => trans('admin.choose_restaurant')]) !!}
      </div> 
      <div class="form-group">
        {!! Form::label('menu_id',trans('admin.menu_name')) !!}
        {!! Form::select('menu_id',App\Model\Menu::pluck('menu_name_'.session('lang'), 'id'), old('menu_id'), ['class'=>'form-control','placeholder' => trans('admin.choose_menu')]) !!}
      </div>      
      <div class="form-group">
        {!! Form::label('description',trans('admin.description')) !!}
        {!! Form::text('description',old('description'), ['class' => 'form-control']) !!}
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