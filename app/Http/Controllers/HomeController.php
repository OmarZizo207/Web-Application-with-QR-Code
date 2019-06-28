<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\User;
use App\Model\Restaurants;
use App\Model\Category;
use App\Model\Item;
use App\Model\Cart;
use Form;

class HomeController extends Controller
{
    public function ShowRestaurants()
    {
        $restaurants = Restaurants::all();
        return view('style.allRestaurants', ['restaurants' => $restaurants]);
    }

    public function ShowMenu($id)
    {
        $restaurant = Restaurants::find($id);
        if(!empty($restaurant)) {
            $categories = Category::where('restaurant_id', $id)->get();

           return view('style.restaurants', compact('restaurant','categories'));
        } else {
            return view('style.restaurants',trans('user_restaurant_not_found'));
        }
    }

    public function add_cart(Request $request, $id)
    {
        $item = Item::find($id);
        if(!$item) {
            abort(404);
        }

        if($request->ajax()) {
            $data = $this->validate($request,[
                'user_id'       => 'required|numeric',
                'item_id'       => 'required|numeric',
                'quantity'      => 'required|numeric|min:1',
            ], [],[
                'user_id'       => trans('user.user_id'),
                'item_id'       => trans('user.item_id'),
                'quantity'      => trans('user.quantity'),
            ]);
            Cart::create($data); 
            return response(['status' => true,'message' => trans('user.item_added')], 200);   
        } else {
            return response(['status' => false,'message' => 'failed'], 500);
        }
    }

    public function remove_cart(Request $request, $id)
    {
        if($request->ajax()) {
            Cart::find($id)->delete();
            return response(['status' => true,'message' => trans('user.item_deleted')], 200);
        }
    }

    public function show_checkout()
    {
        $carts = Cart::all();
        return view('style.checkout',['carts' => $carts]);
    }

    public function read_qrcode()
    {
        return view('style.qrpage');
    }
}
