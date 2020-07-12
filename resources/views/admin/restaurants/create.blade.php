@extends('admin.index')
@section('content')

@push('js')
 <script type="text/javascript" src='https://maps.google.com/maps/api/js?libraries=places&key=AIzaSyBwxuW2cdXbL38w9dcPOXfGLmi1J7AVVB8'></script>
 <script type="text/javascript" src="{{ url('design/AdminLTE/dist/js/locationpicker.jquery.js') }}"></script>
<?php
$lat = !empty(old('lat')) ? old('lat') : '30.034024628931657';
$lng = !empty(old('lng')) ? old('lng') : '31.24238681793213';
?>
 <script type="text/javascript">
   $('#us1').locationpicker({
    location: {
      latitude: {{ $lat }},
      longitude: {{ $lng }},
    },
    radius: 300,
    markerIcon: '{{ url("design/AdminLTE/dist/img/map_marker.png") }}',
    inputBinding: {
        latitudeInput: $('#lat'),
        longitudeInput: $('#lng'),
        // radiusInput: $('#us1-radius'),
        locationNameInput: $('#address'),
    },
    enableAutocomplete: true
  });
 </script>
@endpush


<div class="box">
  <div class="box-header">
    <h3 class="box-title"> {{$title}} </h3>
  </div>
  <div class="box-body">
    {!! Form::open(['route' => 'restaurants.store','files' => true]) !!}

      <input type="hidden" name="lat" value="{{ old('lat') }}" id='lat'>
      <input type="hidden" name="lng" value="{{ old('lng') }}" id='lng'>

      <div class="form-group">
        {!! Form::label('restaurant_name_ar',trans('admin.restaurant_name_ar')) !!}
        {!! Form::text('restaurant_name_ar',old('restaurant_name_ar'), ['class' => 'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('restaurant_name_en',trans('admin.restaurant_name_en')) !!}
        {!! Form::text('restaurant_name_en',old('restaurant_name_en'), ['class' => 'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('address',trans('admin.address')) !!}
        {!! Form::text('address',old('address'), ['class' => 'form-control']) !!}
      </div>

      <div class="form-group">
        <div id="us1" style="width: 100%; height: 400px;"></div>
      </div>

      <div class="form-group">
        {!! Form::label('facebook_url',trans('admin.facebook_url')) !!}
        {!! Form::text('facebook_url',old('facebook'), ['class' => 'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('twitter_url',trans('admin.twitter_url')) !!}
        {!! Form::text('twitter_url',old('twitter'), ['class' => 'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('hotline',trans('admin.hotline')) !!}
        {!! Form::text('hotline',old('hotline'), ['class' => 'form-control']) !!}
      </div>
      <div class="form-group">
          {!! Form::label('visa',trans('admin.visa_avaliable')) !!}
          {!! Form::select('visa',[1 => trans('admin.yes'),0 => trans('admin.no')], old('visa'), ['class' => 'form-control visa']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('restaurant_logo',trans('admin.restaurant_logo')) !!}
        {!! Form::file('restaurant_logo', ['class' => 'form-control']) !!}
      </div>
      {!! Form::submit(trans('admin.create_admin'),['classs' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
  </div>
</div>

@endsection
