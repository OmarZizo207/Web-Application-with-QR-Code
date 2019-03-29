@extends('admin.index')
@section('content')

<div class="box">
  <div class="box-header">
    <h3 class="box-title"> {{$title}} </h3>
  </div>
  <div class="box-body">
    {!! Form::open(['route' => 'tables.store']) !!}
      <div class="form-group">
        {!! Form::label('table_name',trans('admin.table_name')) !!}
        {!! Form::text('table_name',old('table_name'), ['class' => 'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('restaurant_id',trans('admin.restaurant_name')) !!}
        {!! Form::select('restaurant_id',App\Model\Restaurants::pluck('restaurant_name_'.session('lang'), 'id'), old('restaurant_id'), ['class'=>'form-control','placeholder' => trans('admin.choose_restaurant')]) !!}
      </div>      

      {!! Form::submit(trans('admin.create'),['classs' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
  </div>
</div>

@endsection