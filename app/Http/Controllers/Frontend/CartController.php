<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Models\SystemSetting;
use App\Models\Product;
use App\Helpers\CartHelper;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function index()
    {
        // session()->forget('coupon');
        $systemInfo = SystemSetting::first();
        $mightAlsoLike = Product::inRandomOrder()->with('photos')->take(4)->get();
        $cart = CartHelper::getCart();
        $discount = session()->get('coupon')['discount'] ?? 0;
        $newSubtotal = CartHelper::getCartTotal() - $discount;
        $newTotal = $newSubtotal;

        return view('cart', compact('mightAlsoLike', 'systemInfo', 'cart', 'discount', 'newSubtotal', 'newTotal'));
    }

    public function store(Request $request)
    {
        $product = Product::find($request->id);

        if ($product->quantity < $request->quantity) {
            return redirect()->back()->with('error', "Không đủ số lượng sản phẩm trong kho.");
        }

        CartHelper::addToCart($product, $request->quantity);
        $product->decrement('quantity', $request->quantity);

        return redirect()->route('cart.index')->with('success', "$product->name đã được thêm vào giỏ hàng!");
    }

    public function update(Request $request, $id)
    {
        CartHelper::updateCart($id, $request->quantity);
        return redirect()->route('cart.index')->with('success', "Item updated successfully!");
    }

    public function destroy($id)
    {
        CartHelper::removeFromCart($id);

        if (empty(CartHelper::getCart()) || (session()->has('coupon') && CartHelper::getCartTotal() < session('coupon')['minimum_amount'])) {
            session()->forget('coupon');
        }

        return redirect()->back()->with('success', "Item removed successfully!");
    }
}
