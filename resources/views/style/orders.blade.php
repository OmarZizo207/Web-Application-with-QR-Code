@extends('style.index')
@section('content')
    <!--================Banner Area =================-->
    <section class="banner_area" style="background-image: url('{{ url('design/style') }}/img/banner/banner-bg-1.jpg');">
        <div class="container">
            <div class="banner_content">
                <h4> Orders </h4>
                <a href="#">Home</a>
                <a class="active" href="{{ url('/orders') }}">Checkout</a>
            </div>
        </div>
    </section>
    <!--================End Banner Area =================-->

    <h2 style="text-align: center; padding-top: 30px"> Here is {{ auth()->user()->name }} Orders</h2>

    <table class="table" style="margin: 50px 0px">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col"> Item Name </th>
            <th scope="col"> Quantity </th>
            <th scope="col"> Price </th>
            <th scope="col"> Table # </th>
            <th scope="col"> Date </th>
        </tr>
        </thead>
        <tbody>
        @php $total_price = 0; @endphp
        @foreach($orders as $index => $order)
            <tr>
                <th scope="row"> {{ $index }} </th>
                <td> {{ $order->items->title }} </td>
                <td> {{ $order->quantity }} </td>
                <td> {{ $order->quantity * $order->items->price }} </td>
                <td> {{ $order->table }} </td>
                <td> {{ $order->created_at }} </td>
            </tr>
            @php $total_price+= $order->quantity * $order->items->price @endphp
        @endforeach
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>Total Price</td>
            <td> {{ $total_price }} </td>
            <td></td>
        </tr>
        </tbody>
    </table>


@endsection
