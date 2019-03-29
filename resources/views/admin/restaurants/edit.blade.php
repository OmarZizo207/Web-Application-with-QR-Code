@extends('admin.index')
@section('content')

@push('js')
 <script type="text/javascript" src='https://maps.google.com/maps/api/js?libraries=places&key=AIzaSyBwxuW2cdXbL38w9dcPOXfGLmi1J7AVVB8'></script>
 <script type="text/javascript" src="{{ url('design/AdminLTE/dist/js/locationpicker.jquery.js') }}"></script>
<?php
?>
 <script type="text/javascript">
   $('#us1').locationpicker({
    location: {
      latitude: {{ $restaurant->lat }},
      longitude: {{ $restaurant->lng }}, 
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
    {!! Form::open(['url' => aurl('restaurants/'.$restaurant->id), 'files' => true,'method' => 'put']) !!}

      <input type="hidden" name="lat" value="{{ old('lat') }}" id='lat'>
      <input type="hidden" name="lng" value="{{ old('lng') }}" id='lng'> 
      
      <div class="form-group">
        {!! Form::label('restaurant_name_ar',trans('admin.restaurant_name_ar')) !!}
        {!! Form::text('restaurant_name_ar',$restaurant->restaurant_name_ar, ['class' => 'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('restaurant_name_en',trans('admin.restaurant_name_en')) !!}
        {!! Form::text('restaurant_name_en',$restaurant->restaurant_name_en, ['class' => 'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('address',trans('admin.address')) !!}
        {!! Form::text('address',$restaurant->address, ['class' => 'form-control']) !!}
      </div>

      <div class="form-group">
        <div id="us1" style="width: 100%; height: 400px;"></div>
      </div>

      <div class="form-group">
        {!! Form::label('facebook_url',trans('admin.facebook_url')) !!}
        {!! Form::text('facebook_url',$restaurant->twitter_url, ['class' => 'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('twitter_url',trans('admin.twitter_url')) !!}
        {!! Form::text('twitter_url', $restaurant->twitter_url, ['class' => 'form-control']) !!}
      </div>

      <div class="form-group">
        {!! Form::label('hotline',trans('admin.hotline')) !!}
        {!! Form::text('hotline',$restaurant->hotline, ['class' => 'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('restaurant_logo',trans('admin.restaurant_logo')) !!}
        {!! Form::file('restaurant_logo', ['class' => 'form-control']) !!}
      @if(!empty(restaurants()->restaurant_logo))
        <img src="{{ Storage::url(restaurants()->restaurant_logo) }}" 
              style="height: 100px;width: 100px;border-radius: 50%; margin-top: 10px; " />
      @endif
      </div>
      {!! Form::submit(trans('admin.save_record'),['classs' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
  </div>
</div>

@endsection