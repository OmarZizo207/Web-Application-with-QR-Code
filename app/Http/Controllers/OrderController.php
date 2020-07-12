<?php

namespace App\Http\Controllers;

use App\model\Orders;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function showOrders()
    {
        $orders = Orders::with('items')->where('user_id', auth()->user()->id)->paginate(20);

        return view('style.orders', compact('orders'));
    }
}
