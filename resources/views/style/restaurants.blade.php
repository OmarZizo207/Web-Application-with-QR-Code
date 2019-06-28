@extends('style.index')
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
    },
  });
 </script>

 <script type="text/javascript">
//  $(".update-cart").click(function (e) {
        //    e.preventDefault();
 
        //    var ele = $(this);
 
        //     $.ajax({
        //        url: '{{ url('update-cart') }}',
        //        method: "patch",
        //        data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id"), quantity: ele.parents("tr").find(".quantity").val()},
        //        success: function (response) {
        //            window.location.reload();
        //        }
        //     });
        // });

   $(document).ready(function(){
      
      <?php $max_items = count(App\Model\Item::all());
        for($i = 0; $i < $max_items; $i++) { ?>
    $('#successMsg_<?php echo $i; ?>').hide();

    $(document).on('click', '#add_to_cart_<?php echo $i ?>', function() {
        // e.preventDefault();

      <?php $user_id = !empty(auth()->user()->id) ? auth()->user()->id : 0; ?>
      let user_id = {{ $user_id }};
        if(user_id === 0) {
            $('#failed_message_<?php echo $i; ?>').append('{{ trans('user.login_please') }}');
            $('#failed_message_<?php echo $i; ?>').show();
        }
      let item_id_<?php echo $i; ?> = $('#item_id_<?php echo $i; ?>').val();
      let quantity_<?php echo $i; ?> = $('#quantity_<?php echo $i; ?>').val();

      $.ajax({
        url: '<?php echo url('add_to_cart'); ?>/' + item_id_<?php echo $i; ?>, 
        dataType: 'json',
        type: 'post',
        data: {
          "_token": '{{ csrf_token() }}',
          "user_id": user_id,
          "item_id": item_id_<?php echo $i; ?>,
          "quantity": quantity_<?php echo $i; ?>,
        }, success: function(){
              $('#successMsg_<?php echo $i; ?>').append('{{ trans('user.item_added') }}');
              $('#successMsg_<?php echo $i; ?>').show();
        },
      });
      return false;
    });
    <?php } ?>
   });

</script>
@endpush

<div class="restaurant_image" style="margin: 200px 0 50px 0">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-12" style="float: left;">
        <img src="{{ Storage::url($restaurant->restaurant_logo) }}" style="border: solid 1px #404044;">
        <h2> {{ $restaurant->restaurant_name_en }} </h2>
        <p> This restaurant Discription </p>
        <p> {{ $restaurant->hotline }} </p>
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
      <div class="col-lg-12 col-lg-12 col-sm-12">
        <div class="form-group">
          <div id="us1" style="width: 100%; height: 400px;"></div>
        </div>
      </div>    
    </div>
  </div>
</div>

        <!--================End Our feature Area =================-->
        <section class="most_popular_item_area" style="background-image: url('{{ url('design/style') }}/img/popular_menu_bg.jpg'); background-repeat: no-repeat;background-position: center center; background-size: cover;">
            <div class="container">
                <div class="s_white_title">
                    <h3>Most Popular</h3>
                    <h2>Today's Menu</h2>
                </div>
                <div class="popular_filter">
                    <ul>
                      <li class="active" data-filter="*"><a href="">All</a></li>
                      @foreach($categories as $category)
                        <li data-filter=".{{ strtolower(str_replace(' ','_',$category->name_en)) }}"><a href="">{{ $category->name_en }}</a></li>
                      @endforeach
                    </ul>
                </div>

                <div class="p_recype_item_main">
                    <div class="row p_recype_item_active">
                      <?php $count_items = 0; ?>
                      @foreach($categories as $category)
                          @foreach(App\Model\Item::where('category_id', $category->id)->get() as $item)
                        <div class="col-md-12 col-lg-6 {{strtolower(str_replace(' ','_', $category->name_en))}}">
                            <div class="media">
                                <div class="media-left" style="width: 50px;height: 50px;">
                                    <img src="{{ Storage::url($item->photo) }}" alt="meal_image">
                                </div>
                                <div class="media-body">
                                  <input type="hidden" name="item_id" id="item_id_<?php echo $count_items; ?>" value="{{ $item->id }}">
                                    <a href="{{ url('$item->id') }}"><h3>{{ $item->title }}</h3></a>
                                    <h4>{{ $item->price }} L.E</h4>
                                    <label style="margin-left: 120px;"> Quantity </label> 
                                    <input type="number" name="quantity" id="quantity_<?php echo $count_items; ?>" style="width: 40px; float: right;margin-top: 10px;margin-right: 30px">

                                    <p> {{ $item->description }} </p>
                                    <a class="read_mor_btn" id="add_to_cart_<?php echo $count_items; ?>" href="#"> <i class="fa fa-cart"></i> Add To Cart</a>
                                    <ul>
                                        <li><a href="#"><i class="fa fa-star"></i></a></li>
                                        <li><a href="#"><i class="fa fa-star"></i></a></li>
                                        <li><a href="#"><i class="fa fa-star"></i></a></li>
                                        <li><a href="#"><i class="fa fa-star"></i></a></li>
                                        <li><a href="#"><i class="fa fa-star-half-o"></i></a></li>
                                    </ul>
                                    <div id="successMsg_<?php echo $count_items; ?>" class='alert alert-success' style='display: none'></div>
                                    <div id="failed_message_<?php echo $count_items; ?>" class='alert alert-danger' style='display: none'></div>
                                </div>
                            </div>
                        </div>
                          <?php $count_items++; ?>
                          @endforeach
                      @endforeach
                    </div>
                </div>
            </div>
        </section>
        <!--================End Our feature Area =================-->
@endsection
