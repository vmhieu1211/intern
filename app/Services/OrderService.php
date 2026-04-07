<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderService
{
    public function createFromCart(Request $request, CartService $cart): Order
    {
        $numbers = $cart->getNumbers();

        $order = Order::create([
            'order_number'         => uniqid(),
            'user_id'              => auth()->id(),
            'billing_discount'     => $numbers['discount'],
            'billing_discount_code'=> session()->get('coupon.name'),
            'billing_subtotal'     => $numbers['subtotal'],
            'billing_total'        => $numbers['total'],
            'billing_fullname'     => $request->billing_fullname,
            'billing_address'      => $request->billing_address,
            'billing_city'         => $request->billing_city,
            'billing_province'     => $request->billing_province,
            'billing_phone'        => $request->billing_phone,
            'billing_email'        => $request->billing_email,
            'notes'                => $request->notes,
            'order_status_id'      => 1,
            'payment_method'       => $request->payment_method,
        ]);

        foreach ($cart->get() as $item) {
            OrderProduct::create([
                'order_id'   => $order->id,
                'product_id' => $item['id'],
                'quantity'   => $item['quantity'],
            ]);

            Product::where('id', $item['id'])->decrement('quantity', $item['quantity']);
        }

        $cart->clear();

        return $order;
    }
}
