<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;

class CouponsController extends Controller
{
    public function store(Request $request)
    {
        $coupon = Coupon::where('code', $request->coupon_code)->first();

        if (!$coupon) {
            return redirect()->route('cart.index')->withErrors('Invalid coupon code. Please try agan.');
        }

        session()->put('coupon', [
            'name' => $coupon->code,
            'discount' => $coupon->discount(Cart::subtotal()),
        ]);
        return redirect()->route('cart.index')->with('success', 'Coupon applied successfully');
    }


    public function destroy()
    {
        session()->forget('coupon');

        session()->flash('success', 'Coupon removed successfully');

        return redirect()->route('cart.index');
    }
}
