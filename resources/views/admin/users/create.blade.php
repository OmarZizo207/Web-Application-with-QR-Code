@extends('admin.index')
@section('content')

<div class="box">
  <div class="box-header">
    <h3 class="box-title"> {{$title}} </h3>
  </div>
  <div class="box-body">
    {!! Form::open(['route' => 'users.store']) !!}
      <div class="form-group">
        {!! Form::label('name',trans('admin.user_name')) !!}
        {!! Form::text('name',old('name'), ['class' => 'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('email',trans('admin.user_email')) !!}
        {!! Form::email('email',old('email'), ['class' => 'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('password',trans('admin.user_password')) !!}
        {!! Form::password('password', ['class' => 'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('phone_number',trans('admin.phone_number')) !!}
        {!! Form::text('phone_number', old('phone_number'), ['class' => 'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('level',trans('admin.user_level')) !!}
        {!! Form::select('level', ['user'=> trans('admin.user'), 'vendor'=> trans('admin.vendor'), 'company'=> trans('admin.company')], old('level') ,['class' => 'form-control','placeholder' => 'Choose Level']) !!}
      </div>
      {!! Form::submit(trans('admin.create_user'),['classs' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
  </div>
</div>

@endsection