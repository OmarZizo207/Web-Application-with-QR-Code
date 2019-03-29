@extends('admin.index')
@section('content')

<div class="box">
  <div class="box-header">
    <h3 class="box-title"> {{$title}} </h3>
  </div>
  <div class="box-body">
    {!! Form::open(['url' => aurl('users/'.$user->id),'method'=>'put']) !!}
      <div class="form-group">
        {!! Form::label('name',trans('admin.user_name')) !!}
        {!! Form::text('name',$user->name, ['class' => 'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('email',trans('admin.user_email')) !!}
        {!! Form::email('email',$user->email, ['class' => 'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('password',trans('admin.user_password')) !!}
        {!! Form::password('password', ['class' => 'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('phone_number',trans('admin.phone_number')) !!}
        {!! Form::text('phone_number', $user->phone_number, ['class' => 'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('level',trans('admin.user_level')) !!}
        {!! Form::select('level', ['user'=> trans('admin.user'), 'vendor'=> trans('admin.vendor'), 'company'=> trans('admin.company')], $user->level ,['class' => 'form-control','placeholder' => '.........']) !!}
      </div>
      {!! Form::submit(trans('admin.save_record'),['classs' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
  </div>
</div>

@endsection