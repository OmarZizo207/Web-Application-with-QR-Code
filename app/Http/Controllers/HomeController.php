<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use App\model\Orders;
use App\Model\Table;
use Illuminate\Http\Request;
use App\User;
use App\Model\Restaurants;
use App\Model\Category;
use App\Model\Item;
use App\Model\Cart;
use Form;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function ShowRestaurants()
    {
        $restaurants = Restaurants::all();
        return view('style.allRestaurants', ['restaurants' => $restaurants]);
    }

    public function ShowMenu($id, Request $request)
    {
        $restaurant = Restaurants::find($id);
        if(!empty($restaurant)) {

            $price_from = \request('price_from') ?? 0;
            $price_to = \request('price_to') ?? 100000;

            $query = Item::query()->where('restaurant_id', $restaurant->id);

            if($request->price_from != '') {
                $query->whereBetween('price', [$price_from, $price_to]);
            }
            if($request->category_id != '') {
                $query->where('category_id', $request->category_id);
            }

            $items = $query->paginate(20);

            $categories = Category::where('restaurant_id', $restaurant->id)->get();

           return view('style.restaurants', compact('restaurant','items', 'categories'));
        } else {
            return view('style.restaurants',trans('user_restaurant_not_found'));
        }
    }

    public function add_cart(Request $request, $id)
    {
        $item = Item::findOrFail($id);
        $userCart = Cart::with('items')->where('user_id', auth()->user()->id)->get();

        if($request->ajax()) {
            if(count($userCart) > 0) {
                foreach ($userCart as $cart) {
                    if($cart->items->restaurant_id != $item->restaurant_id) {
                        return response(['status' => false,'message' => trans('user.make_checkout')], 500);
                        break;
                    }
                }
            }

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

    public function show_checkout(Request $request)
    {
        $carts = Cart::where('user_id', auth()->user()->id)->with('items')->get();

        foreach ($carts as $cart) {
            $restaurant_id = $cart->items->restaurant_id;
            break;
        }

        $restaurant = Restaurants::findOrFail($restaurant_id);
        $tables = Table::where('restaurant_id', $restaurant_id)->get();

        if($restaurant->visa == 1) {
            return view('style.checkout',['carts' => $carts, 'tables' => $tables]);
        }
        return view('style.cash', ['carts' => $carts, 'tables' => $tables]);
    }

    public function addOrders()
    {
        $carts = Cart::where('user_id', auth()->user()->id)->get();
        foreach ($carts as $cart) {
            Orders::create([
                'user_id'   => $cart->user_id,
                'item_id'   => $cart->item_id,
                'quantity'  => $cart->quantity,
                'table'     => \request('table')
            ]);
            $cart->delete();
        }
        session()->flash('success', 'Order Created Successfully');
        return redirect('/');
    }

    public function read_qrcode()
    {
        return view('style.qrpage');
    }


}
