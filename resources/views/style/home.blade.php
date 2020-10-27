@extends('style.index')
@section('content')

@push('js')
<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('change', '.select_r', function() {
      var option = $(this).val();
      $(".form_id").attr("action", "restaurants/" + option);  
    });
});
</script>
@endpush
        <!--================Slider Area =================-->
        <section class="slider_area" style="background-image: url('{{ url('design/style') }}/img/home-slider/slider1.jpg'); background-repeat: no-repeat;background-size: cover;background-position: center center;">
            <div class=slider_inner>
                <div class="rev_slider fullwidthabanner"  data-version="5.3.0.2" id="home-slider">
                    <ul> 
                        <li data-slotamount="7" data-easein="Power4.easeInOut" data-easeout="Power4.easeInOut" data-masterspeed="600" data-rotate="0" data-saveperformance="off">
                            <!-- MAIN IMAGE -->
                            
                            <!-- LAYERS -->

                            <!-- LAYER NR. 1 -->
                            <div class="slider_text_box">
                               <div class="tp-caption bg_box" 
                                    data-width="none"
                                    data-height="none"
                                    data-whitespace="nowrap"
                                    data-x="center" 
                                    data-y="['350','350','300','250','0']"
                                    data-fontsize="['55']" 
                                    data-lineheight="['60']" 
                                    data-transform_idle="o:1;"
                                    data-transform_in="y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;s:1500;e:Power4.easeInOut;" 
                                    data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" 
                                    data-mask_in="x:0px;y:0px;" 
                                    data-mask_out="x:inherit;y:inherit;" 
                                    data-start="2000" 
                                    data-splitin="none" 
                                    data-splitout="none" 
                                    data-responsive_offset="on">
                                </div>
                                <div class="tp-caption first_text" 
                                    data-x="center" 
                                    data-y="center" 
                                    data-voffset="['-20']"
                                    data-Hoffset="['0']"
                                    data-fontsize="['42','42','42','42','25']"
                                    data-lineheight="['52','52','52','52','35']"
                                    data-width="none"
                                    data-height="none"
                                    data-transform_idle="o:1;"
                                    data-whitespace="nowrap"
                                    data-transform_in="x:[105%];z:0;rX:45deg;rY:0deg;rZ:90deg;sX:1;sY:1;skX:0;skY:0;s:2000;e:Power4.easeInOut;" 
                                    data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" 
                                    data-mask_in="x:0px;y:0px;s:inherit;e:inherit;" 
                                    data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" 
                                    data-start="1000" 
                                    data-splitin="none" 
                                    data-splitout="none" 
                                    data-responsive_offset="on" 
                                    data-elementdelay="0.05" >Welcome To Our
                                </div>
                                <div class="tp-caption secand_text" 
                                    data-x="center" 
                                    data-y="center" 
                                    data-voffset="['45']"
                                    data-Hoffset="['0']"
                                    data-fontsize="['36']"
                                    data-lineheight="['42']"
                                    data-width="none"
                                    data-height="none"
                                    data-transform_idle="o:1;"
                                    data-whitespace="nowrap"
                                    data-transform_in="x:[105%];z:0;rX:45deg;rY:0deg;rZ:90deg;sX:1;sY:1;skX:0;skY:0;s:2000;e:Power4.easeInOut;" 
                                    data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" 
                                    data-mask_in="x:0px;y:0px;s:inherit;e:inherit;" 
                                    data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" 
                                    data-start="1000" 
                                    data-splitin="none" 
                                    data-splitout="none" 
                                    data-responsive_offset="on" 
                                    data-elementdelay="0.05" >food order
                                </div>
                                  <form method="post" class="form_id" action="">
                                <div class="tp-caption third_text" 
                                    data-x="center" 
                                    data-y="center" 
                                    data-voffset="['100']"
                                    data-Hoffset="['0']"
                                    data-fontsize="['24','24','24','24','16']"
                                    data-lineheight="['34','34','34','34','26']"
                                    data-width="none"
                                    data-height="none"
                                    data-transform_idle="o:1;"
                                    data-whitespace="nowrap"
                                    data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;" 
                                    data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" 
                                    data-mask_in="x:0px;y:[100%];s:inherit;e:inherit;" 
                                    data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" 
                                    data-start="1200" 
                                    data-splitin="none" 
                                    data-splitout="none" 
                                    data-responsive_offset="on" 
                                    data-elementdelay="0.05" >
                                    @csrf
                                    <div class="form-group" style="margin-top: 30px;">
                                      {!! Form::select('restaurant_id', App\Model\Restaurants::pluck('restaurant_name_'.session('lang'), 'id'), old('restaurant_id'), ['class'=>'form-control select_r','placeholder' => trans('user.choose_restaurant')]) !!}
                                    </div>
                                    <input type="submit" value="{{ trans('user.search_restaurant') }}" class="btn btn-outline-white px-5 py-3" style="font-weight: bold;font-size: 20px;background-color: #8A0D0B;color: #FFF">
                                </div>
                                <div class="tp-caption btn_text" 
                                    data-x="center" 
                                    data-y="center" 
                                    data-voffset="['180']"
                                    data-Hoffset="['0']"
                                    data-fontsize="['16.75']"
                                    data-lineheight="['26']"
                                    data-width="none"
                                    data-height="none"
                                    data-transform_idle="o:1;"
                                    data-whitespace="nowrap"
                                    data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;" 
                                    data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" 
                                    data-mask_in="x:0px;y:[100%];s:inherit;e:inherit;" 
                                    data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" 
                                    data-start="1200" 
                                    data-splitin="none" 
                                    data-splitout="none" 
                                    data-responsive_offset="on" 
                                    data-elementdelay="0.05" >
                                </div>
                                  </form>
                            </div>
                        </li>
                    </ul> 
                </div><!-- END REVOLUTION SLIDER -->
            </div>
        </section>
        <!--================End Slider Area =================-->

        <!--================Recent Blog Area =================-->
        <section class="recent_bloger_area">
            <div class="container">
                <div class="s_black_title">
                    <h3>News</h3>
                    <h2 class="download_text">Download our app is the best way to order your favourite Food</h2>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="recent_blog_item">
                            <div class="recent_blog_text">
                                <div class="recent_blog_text_inner">
                                    <h6><a href="#"><i class="fab fa-android"></i> Android</a></h6>
                                    <a href="blog-details.html"><h5> Download From Here </h5></a>
                                    <p>We hope that will statisfy you expectations.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="recent_blog_item">
                            <div class="recent_blog_text">
                                <div class="recent_blog_text_inner">
                                    <h6><a href="#"><i class="fab fa-apple"></i> Ios</a></h6>
                                    <a href="blog-details.html" disabled><h5>Download From Here</h5></a>
                                    <p> We seek to expand our branches so will be available soon.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================End Recent Blog Area =================-->

        <!--================Service Area =================-->
        <section class="service_area">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <div class="service_item">
                            <img src="{{ url('design/style') }}/img/service-icon/service-1.png" alt="">
                            <h3>Pizzas</h3>
                            <p>Lorem ipsum dolor sit amet, cont tempor incididunt ut labore dolor adipiscing elit, sed do eiusmod et  magna aliquaquat officia.</p>
                            <a class="read_mor_btn" href="#">Read More</a>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="service_item">
                            <img src="{{ url('design/style') }}/img/service-icon/service-2.png" alt="">
                            <h3>Coffee</h3>
                            <p>Lorem ipsum dolor sit amet, cont tempor incididunt ut labore dolor adipiscing elit, sed do eiusmod et  magna aliquaquat officia.</p>
                            <a class="read_mor_btn" href="#">Read More</a>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="service_item">
                            <img src="{{ url('design/style') }}/img/service-icon/service-3.png" alt="">
                            <h3>Burgers</h3>
                            <p>Lorem ipsum dolor sit amet, cont tempor incididunt ut labore dolor adipiscing elit, sed do eiusmod et  magna aliquaquat officia.</p>
                            <a class="read_mor_btn" href="#">Read More</a>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="service_item">
                            <img src="{{ url('design/style') }}/img/service-icon/service-4.png" alt="">
                            <h3>Drinks</h3>
                            <p>Lorem ipsum dolor sit amet, cont tempor incididunt ut labore dolor adipiscing elit, sed do eiusmod et  magna aliquaquat officia.</p>
                            <a class="read_mor_btn" href="#">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================End Service Area =================-->

@endsection