@push('js')
    <script>
        $(document).ready(function(){
            <?php
            if(!empty(auth()->user()->id)) {
            $max_carts = count(App\Model\Cart::where('user_id', auth()->user()->id)->get());
                for($i = 0; $i < $max_carts; $i++) { ?>
                $('#successMsg_<?php echo $i; ?>').hide();
                    $(document).on('click', '#remove_cart_<?php echo $i; ?>', function () {
                    var cart_id_<?php echo $i; ?> = $('#cart_id_<?php echo $i; ?>').val();

                    $.ajax({
                       url: '{{ url('remove_cart') }}/' + cart_id_<?php echo $i; ?>,
                        type: 'post',
                        dataType: 'json',
                        data: {
                           '_token': '{{ csrf_token() }}',
                            'cart_id': cart_id_<?php echo $i; ?>,
                        },
                        success: function(){
                           $('#remove_cart_<?php echo $i; ?>').hide();
                            $('#successMsg_<?php echo $i; ?>').show();
                            $('#successMsg_<?php echo $i; ?>').append('{{ trans('user.item_deleted') }}');
                            $('#cart_{{ $i }}').fadeOut(500);
                        },
                    });
                 return false;
                });
            <?php } }?>
        });
    </script>
@endpush
    <body>
       
        <div id="preloader">
            <div class="loader absolute-center">
                <div class="loader__box"><b class="top"></b></div>
                <div class="loader__box"><b class="top"></b></div>
                <div class="loader__box"><b class="top"></b></div>
                <div class="loader__box"><b class="top"></b></div>
            </div>
        </div>

        <!--================ Frist hader Area =================-->
        <div class="first_header">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="header_contact_details">
                            <a href="#"><i class="fa fa-phone"></i>+1 (168) 314 5016</a>
                            <a href="#"><i class="far fa-envelope"></i>+1 (168) 314 5016</a>
                        </div>
                    </div>
                    <div class="col-md-4">

                    </div>
                    <div class="col-md-4">
                        <div class="header_social">
                            <ul>
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--================End Footer Area =================-->

         <!--================End Footer Area =================-->
        <header class="main_menu_area" id="header">
            <nav class="navbar navbar-default">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#"><img src="{{ Storage::url(setting()->logo) }}" alt=""></a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right">
                            <li class="{{ active_nav('')[0] }}"><a href="{{ url('') }}"> <i class="fa fa-home"></i> {{ trans('user.home') }}</a></li>
                            <li class="{{ active_nav('restaurants')[0] }}"><a href="{{ url('restaurants') }}"> <i class="fas fa-utensils"></i> {{ trans('user.restaurants') }}</a></li>
                            <li class="{{ active_nav('about')[0] }}"><a href="{{ url('about') }}"><i class="fa fa-info"></i> {{ trans('user.about_us') }}</a></li>
                            <li class="{{ active_nav('contact-us')[0] }}"><a href="{{ url('contact-us') }}"> <i class="fa fa-phone"></i> {{ trans('user.contact_us') }}</a></li>

                            @if(Auth::check())
                                <li class="dropdown submenu">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-sign-in-alt"></i> <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{ url('logout') }}"><i class="fas fa-sign-in-alt"></i> {{ trans('user.logout') }} </a></li>
                                    </ul>
                                </li>
                            @else
                            <li class="dropdown submenu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-sign-in-alt"></i> <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ url('login') }}"><i class="fas fa-sign-in-alt"></i> {{ trans('user.login') }}</a></li>
                                    <li><a href="{{ url('signup') }}"> <i class="fas fa-user-plus"></i> {{ trans('user.signup') }}</a></li>
                                </ul>
                            </li>
                            @endif                            

                            <li>
                                <a href="#" id="cart"><i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                    <span class="badge">
                                     <?php
                                        if(!empty(auth()->user()->id)) {
                                            $cart_number = count(App\Model\Cart::where('user_id', auth()->user()->id)->get());
                                            echo $cart_number;
                                        } else {
                                            echo 0;
                                        }
                                     ?>
                                    </span> </a>
                            </li>
                            
                            <li class="dropdown submenu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-globe"></i> <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ url('lang/ar') }}"><i class="fa fa-flag"></i>عربي</a></li>
                                    <li><a href="{{ url('lang/en') }}"><i class="fa fa-flag"></i>English</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>

            <div class="container">
                <div class="shopping-cart" id="load_cart" style="display: none;">
                    <div class="shopping-cart-header">
                        <i class="fa fa-shopping-cart cart-icon"></i>
                            <span class="badge">
                                <?php
                                if(empty(auth()->user()->id)) {
                                    echo 0;
                                } else {
                                $cart_number = count(App\Model\Cart::where('user_id', auth()->user()->id)->get());
                                    echo $cart_number;
                                }
                                ?>
                            </span>
                        <div class="shopping-cart-total">
                            <span class="lighter-text">{{ trans('user.total_price') }}:</span>
                            <span class="main-color-text">
                                <?php
                                $total_price = 0;
                                if(!empty(auth()->user()->id)) {
                                    foreach(App\Model\Cart::where('user_id', auth()->user()->id)->get() as $cart_item){
                                        $item_price = item_price($cart_item->item_id);
                                        $item_quantity = $cart_item->quantity;
                                        $total_price += $item_quantity * $item_price;
                                    }
                                    echo $total_price;
                                } else {
                                    echo 0;
                                }
                                ?>
                            </span>
                        </div>
                    </div> <!--end shopping-cart-header -->

                    <ul class="shopping-cart-items">

                    <?php $count_carts = 0;
                    if(!empty(auth()->user()->id)){ ?>
                    @foreach(App\Model\Cart::where('user_id', auth()->user()->id)->get() as $cart_item)
                        <?php $details = item_details($cart_item->item_id); ?>
                        <li class="clearfix" id="cart_{{ $count_carts }}">
                            <input type="hidden" name="cart_id" id="cart_id_<?php echo $count_carts; ?>" value="{{ $cart_item->id }}">
                            <img src="{{ Storage::url($details->photo) }}" alt="item1" />
                            <span class="item-name"> {{ $details->title }} </span>
                            <span class="item-price">{{ $details->price }}</span>
                            <span class="item-quantity">{{ trans('user.quantity') }}: {{ $cart_item->quantity }}</span> <br>
                            <span class="item-price">{{ trans('user.total') }} : {{ $details->price *  $cart_item->quantity  }}</span> <br>
                            <a href="{{ url('remove_cart/'.$cart_item->id) }}" class="btn btn-danger" id="remove_cart_<?php echo $count_carts; ?>"><i class="fas fa-trash"></i></a>
                            <div id="successMsg_<?php echo $count_carts; ?>" class='alert alert-danger' style="display: none"></div>
                        </li>
                         <?php $count_carts++; ?>
                    @endforeach
                    <?php } else {
                            echo 'Empty Cart';
                        } ?>
                    </ul>

                    <a href="{{ url('checkout') }}" class="button">Checkout</a>
                </div> <!--end shopping-cart -->
            </div> <!--end container -->
        </header>
        <!--================End Footer Area =================-->
