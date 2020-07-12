@extends('style.index')
@section('content')

    <!--================Banner Area =================-->
    <section class="banner_area" style="background-image: url('{{ url('design/style') }}/img/banner/banner-bg-1.jpg');">
        <div class="container">
            <div class="banner_content">
                <h4>Rate Restaurant</h4>
                <a href="{{ url('/') }}">Home</a>
                <a class="active" href="{{ url('rate/'. $restaurant->id) }}"> Rate {{ $restaurant->restaurant_name_en }}</a>
            </div>
        </div>
    </section>
    <!--================End Banner Area =================-->

    <!--================Contact Area =================-->
    <section class="contact_area">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="contact_details">
                        <h3 class="contact_title">Feedback Info</h3>
                        <p>There are many variations of passages of Lorem Ipsum available, but the majori have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a pas of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        <div class="media">
                            <div class="media-left">
                                <i class="fa fa-map-marker"></i>
                            </div>
                            <div class="media-body">
                                <h4>Address</h4>
                                <h5>{{ $restaurant->address }}</h5>
                            </div>
                        </div>
                        <div class="media">
                            <div class="media-left">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="media-body">
                                <h4>Phone</h4>
                                <h5>{{ $restaurant->hotline }}</h5>
                            </div>
                        </div>
                        <div class="media">
                            <div class="media-left">
                                <i class="far fa-envelope"></i>
                            </div>
                            <div class="media-body">
                                <h4>Social Media links</h4>
                                <a href="{{ $restaurant->facebook_url }}"> <i class="fab fa-facebook-f fa-2x"></i> </a>
                                <a href="{{ $restaurant->twitter_url }}"> <i class="fab fa-twitter fa-2x"></i> </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row contact_form_area">
                        <h3 class="contact_title">Send Message</h3>
                        @include('admin.layouts.message')
                        <form action="{{ url('rate/' . $restaurant->id ) }}" method="post" id="contactForm">

                            @csrf

                            <div class="form-group col-md-12">
                                <option value=""> Choose stars rate </option>
                                <select class="form-control" name="stars">
                                    @for($i = 1; $i < 6; $i++)
                                    <option value="{{ $i }}" {{ $i == old('stars') ? 'selected' : '' }}> {{ $i }} Star</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="form-group col-md-12">
                                <textarea class="form-control" id="message" name="feedback" placeholder="Write Feedback">{{ old('feedback') }}</textarea>
                            </div>
                            <div class="form-group col-md-12">
                                <button class="btn btn-default submit_btn" type="submit">Send Feedback</button>
                            </div>
                        </form>
                        <div id="success">
                            <p>Your text message sent successfully!</p>
                        </div>
                        <div id="error">
                            <p>Sorry! Message not sent. Something went wrong!!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Contact Area =================-->

@endsection
