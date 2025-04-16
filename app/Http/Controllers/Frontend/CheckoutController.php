<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use App\Models\SystemSetting;
use App\Http\Controllers\Controller;

class CheckoutController extends Controller
{
    public function index()
    {
        $systemInfo = SystemSetting::first();

        // Lấy giỏ hàng từ session
        $cart = session()->get('cart', []);
        $discount = session()->get('coupon')['discount'] ?? 0;

        // Tính toán tổng tiền
        $newSubtotal = array_reduce($cart, function ($total, $item) {
            return $total + ($item['price'] * $item['quantity']);
        }, 0) - $discount;

        $newTotal = $newSubtotal;

        return view('checkout', compact('systemInfo'))->with([
            'cart' => $cart,
            'discount' => $discount,
            'newSubtotal' => $newSubtotal,
            'newTotal' => $newTotal,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'billing_fullname' => 'required',
            'billing_address' => 'required',
            'billing_city' => 'required',
            'billing_province' => 'required',
            'billing_phone' => 'required',
            'notes' => 'max:255',
        ]);

        // Tạo đơn hàng
        $order = Order::create([
            'order_number' => uniqid(),
            'user_id' => auth()->user()->id ?? null,
            'billing_discount' => $this->getNumbers()['discount'],
            'billing_discount_code' => session()->get('coupon')['name'] ?? null,
            'billing_subtotal' => $this->getNumbers()['newSubtotal'],
            'billing_total' => $this->getNumbers()['newTotal'],
            'billing_fullname' => $request->billing_fullname,
            'billing_address' => $request->billing_address,
            'billing_city' => $request->billing_city,
            'billing_province' => $request->billing_province,
            'billing_phone' => $request->billing_phone,
            'billing_email' => $request->billing_email,
            'notes' => $request->notes,
            'order_status_id' => $request->order_status_id ?? 1,
            'payment_method' => $request->payment_method,
        ]);

        // Cập nhật thông tin người dùng nếu đã đăng nhập
        if (auth()->check()) {
            auth()->user()->update([
                'phone' => $request->billing_phone,
                'address' => $request->billing_address,
                'city' => $request->billing_city,
                'province' => $request->billing_province,
                'notes' => $request->notes,
            ]);
        }

        // Lưu sản phẩm trong đơn hàng
        $cart = session()->get('cart', []);
        foreach ($cart as $item) {
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
            ]);
        }

        // Xóa giỏ hàng sau khi đặt hàng
        session()->forget('cart');
        session()->forget('coupon');

        return redirect()->route('my-orders.index')->with('success', "Cảm ơn $request->billing_fullname, đơn hàng của bạn đã được đặt thành công!");
    }

    private function getNumbers()
    {
        $cart = session()->get('cart', []);
        $discount = session()->get('coupon')['discount'] ?? 0;

        $newSubtotal = array_reduce($cart, function ($total, $item) {
            return $total + ($item['price'] * $item['quantity']);
        }, 0) - $discount;

        $newTotal = $newSubtotal;

        return [
            'discount' => $discount,
            'newSubtotal' => $newSubtotal,
            'newTotal' => $newTotal,
        ];
    }
}
