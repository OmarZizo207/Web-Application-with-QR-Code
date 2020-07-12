@extends('style.index')
@section('content')
@foreach($restaurants as $restaurant)
    <div class="restaurant_image" style="margin: 200px 0 50px 0">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12" style="float: left;">
                    <img src="{{ Storage::url($restaurant->restaurant_logo) }}" style="border: solid 1px #404044;">
                    <h2> <a href="{{ url('restaurants/'.$restaurant->id) }}" target="_blank"> {{ $restaurant->restaurant_name_en }} </a></h2>
                    <p> This restaurant Discription </p>
                <p> {{ $restaurant->hotline }} </p>
                    <a href="{{ url('rate/' . $restaurant->id) }}"> Rate this restaurant </a>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12" style="float: right">
                <p style="color: #00A575; font-size: 20px;"> open </p>
                <div style="color: #FFD500">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                </div>
                <span style="color: #404044;"> (1545) </span>
            </div>
        </div>
        <div class="row" style="margin-top: 50px;">
            Address : {{ $restaurant->address }}
        </div>
    </div>
</div>
@endforeach

@endsection
