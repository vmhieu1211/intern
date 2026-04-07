<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function __construct(private CartService $cart) {}

    public function index()
    {
        $mightAlsoLike = Product::inRandomOrder()->with('photos')->take(4)->get();

        return view('cart', [
            'cart'        => $this->cart->get(),
            'discount'    => $this->cart->discount(),
            'newSubtotal' => $this->cart->subtotal(),
            'newTotal'    => $this->cart->total(),
            'mightAlsoLike' => $mightAlsoLike,
        ]);
    }

    public function store(Request $request)
    {
        $product = Product::findOrFail($request->id);

        if ($product->quantity < $request->quantity) {
            return redirect()->back()->with('error', 'Không đủ số lượng sản phẩm trong kho.');
        }

        $this->cart->add($product, (int) $request->quantity);

        return redirect()->route('cart.index')->with('success', "$product->name đã được thêm vào giỏ hàng!");
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        if ($request->quantity > $product->quantity) {
            return redirect()->back()->with('error', 'Không đủ số lượng sản phẩm trong kho.');
        }

        $this->cart->update((int) $id, (int) $request->quantity);

        return redirect()->route('cart.index')->with('success', 'Số lượng sản phẩm đã được cập nhật!');
    }

    public function destroy($id)
    {
        $this->cart->remove((int) $id);

        return redirect()->back()->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng!');
    }
}
