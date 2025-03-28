<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Models\SystemSetting;
use App\Services\CartService;
use App\Http\Controllers\Controller;
use App\Models\Product;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index()
    {
        // $this->cartService->clear();
        $systemInfo = SystemSetting::first();
        $mightAlsoLike = Product::inRandomOrder()->with('photos')->take(4)->get();
        $cart = $this->cartService->get();
        $subtotal = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));
        $discount = session()->get('coupon')['discount'] ?? 0;
        $newSubtotal = $subtotal - $discount;
        $newTotal = $newSubtotal;
        return view('cart', compact('mightAlsoLike', 'systemInfo', 'cart'))
            ->with([
                'discount' => $discount,
                'newSubtotal' => $newSubtotal,
                'newTotal' => $newTotal,
            ]);
    }

    public function store(Request $request)
    {
        $product = Product::find($request->id);
        if ($product->quantity < $request->quantity) {
            return redirect()->back()->with('error', "Không đủ số lượng sản phẩm trong kho.");
        }

        $this->cartService->add($request->id, $request->name, $request->quantity, $request->price);
        $product->decrement('quantity', $request->quantity);

        return redirect()->route('cart.index')->with('success', "$request->name đã được thêm vào giỏ hàng!");
    }

    public function update(Request $request, $id)
    {
        $this->cartService->update($id, $request->quantity);
        return redirect()->route('cart.index')->with('success', "Item updated successfully!");
    }

    public function destroy($id)
    {
        $this->cartService->remove($id);
        return redirect()->back()->with('success', "Item removed successfully!");
    }
}
