<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\SystemSetting;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;

class WishlistController extends Controller
{
    public function index()
    {
        $systemInfo = SystemSetting::first();
        $mightAlsoLike = Product::inRandomOrder()->take(4)->get();

        return view('wishlist', compact('mightAlsoLike', 'systemInfo'));
    }

    public function store(Request $request)
    {
        Cart::instance('wishlist')->add($request->id, $request->name, $request->quantity, $request->price)->associate('App\Models\Product');

        return redirect()->back()->with('success', "$request->name added to your wishlist successfully!");
    }

    public function update(Request $request, $id)
    {
        Cart::instance('wishlist')->update($id, $request->quantity);


        return redirect()->route('wishlist.index')->with('success', "Item updated successfully!");
    }

    public function destroy($id)
    {
        Cart::instance('wishlist')->remove($id);
        return redirect()->back()->with('success', "Item removed successfully!");
    }
}
