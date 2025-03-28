<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Models\SystemSetting;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{

    public function index()
    {
        // Cart::destroy();
        $systemInfo = SystemSetting::first();
        $mightAlsoLike = Product::inRandomOrder()->with('photos')->take(4)->get();
        $discount = session()->get('coupon')['discount'] ?? 0;
        $newSubtotal = Cart::subtotal() - $discount;
        $newTotal = $newSubtotal;
        return view('cart', compact('mightAlsoLike', 'systemInfo'))->with([
            'discount' => $discount,
            'newSubtotal' => $newSubtotal,
            'newTotal' => $newTotal,
        ]);
    }

    public function store(Request $request)
    {
        // Lấy sản phẩm từ cơ sở dữ liệu
        $product = Product::find($request->id);

        // Kiểm tra số lượng sản phẩm có đủ không
        if ($product->quantity < $request->quantity) {
            return redirect()->back()->with('error', "Không đủ số lượng sản phẩm trong kho.");
        }

        // Thêm sản phẩm vào giỏ hàng
        $duplicates = Cart::search(function ($cartItem, $rowId) use ($request) {
            return $cartItem->id === $request->id;
        });

        if ($duplicates->isNotEmpty()) {
            return redirect()->route('cart.index')->with('success', "$request->name đã có trong giỏ hàng!");
        }

        Cart::add($request->id, $request->name, $request->quantity, $request->price)
            ->associate('App\Models\Product');

        // Trừ số lượng sản phẩm trong kho
        $product->decrement('quantity', $request->quantity);

        return redirect()->route('cart.index')->with('success', "$request->name đã được thêm vào giỏ hàng!");
    }

    public function update(Request $request, $id)
    {
        Cart::update($id, $request->quantity);
        return redirect()->route('cart.index')->with('success', "Item updated successfully!");
    }

    public function destroy($id)
    {
        Cart::remove($id);
        // Check if the cart is empty or if the coupon should be removed
        if (Cart::count() == 0 || (session()->has('coupon') && Cart::subtotal() < session('coupon')['minimum_amount'])) {
            session()->forget('coupon'); // Remove the coupon from the session
        }
        return redirect()->back()->with('success', "Item removed successfully!");
    }
}
