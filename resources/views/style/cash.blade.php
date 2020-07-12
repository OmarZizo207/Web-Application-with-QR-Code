@extends('style.index')
@section('content')
    <!--================Banner Area =================-->
    <section class="banner_area" style="background-image: url('{{ url('design/style') }}/img/banner/banner-bg-1.jpg');">
        <div class="container">
            <div class="banner_content">
                <h4>Checkout</h4>
                <a href="#">Home</a>
                <a class="active" href="{{ url('/checkout') }}">Checkout</a>
            </div>
        </div>
    </section>
    <!--================End Banner Area =================-->

    <table class="table" style="margin: 50px 0px">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col"> Item Name </th>
            <th scope="col"> Quantity </th>
            <th scope="col"> Price </th>
        </tr>
        </thead>
        <tbody>
        @php $total_price = 0; @endphp
        @foreach($carts as $index => $cart)
        <tr>
            <th scope="row"> {{ $index }} </th>
            <td> {{ $cart->items->title }} </td>
            <td> {{ $cart->quantity }} </td>
            <td> {{ $cart->quantity * $cart->items->price }} </td>
        </tr>
            @php $total_price+= $cart->quantity * $cart->items->price @endphp
        @endforeach
        <tr>
            <td></td>
            <td></td>
            <td>Total Price</td>
            <td> {{ $total_price }} </td>
        </tr>
        </tbody>
    </table>



    <div id='paid' class='paid' style="text-align: center; margin: 30px">
        <svg  id='icon-paid' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 310.277 310.277" style="enable-background:new 0 0 310.277 310.277;" xml:space="preserve" width="180px" height="180px">
            <g>
                <path d="M155.139,0C69.598,0,0,69.598,0,155.139c0,85.547,69.598,155.139,155.139,155.139   c85.547,0,155.139-69.592,155.139-155.139C310.277,69.598,240.686,0,155.139,0z M144.177,196.567L90.571,142.96l8.437-8.437   l45.169,45.169l81.34-81.34l8.437,8.437L144.177,196.567z" fill="#3ac569"/>
            </g>
        </svg>
        <h2> Pay Cash, please <a href="{{ url('/add_orders') }}">Click here to confirm the order</a> </h2>
        <h2>Thank you!</h2>
    </div>


@endsection
