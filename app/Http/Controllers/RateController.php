<?php

namespace App\Http\Controllers;

use App\Rate;
use Illuminate\Http\Request;
use App\Model\Restaurants;

class RateController extends Controller
{
    public function showRate()
    {
        $restaurant = Restaurants::findOrFail(\request()->route('restaurant_id'));
        return view('style.rate', compact('restaurant'));
    }

    public function rateRestaurant(Request $request)
    {
        $request->validate([
            'feedback'      => 'sometimes|nullable|min:10',
            'stars'         => 'required|numeric'
        ]);

        Rate::create([
            'user_id'       => auth()->user()->id,
            'restaurant_id' => $request->route('restaurant_id'),
            'feedback'      => $request->feedback,
            'stars'         => $request->stars
        ]);
        return redirect(url('/'));
    }
}
