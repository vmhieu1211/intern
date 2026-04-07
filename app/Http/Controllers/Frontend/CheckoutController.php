<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Requests\CheckoutRequest;
use App\Services\CartService;
use App\Services\OrderService;
use App\Http\Controllers\Controller;

class CheckoutController extends Controller
{
    public function __construct(
        private CartService  $cart,
        private OrderService $orderService,
    ) {}

    public function index()
    {
        return view('checkout', [
            'cart'        => $this->cart->get(),
            'discount'    => $this->cart->discount(),
            'newSubtotal' => $this->cart->subtotal(),
            'newTotal'    => $this->cart->total(),
        ]);
    }

    public function store(CheckoutRequest $request)
    {
        $order = $this->orderService->createFromCart($request, $this->cart);

        return redirect()
            ->route('my-orders.index')
            ->with('success', "Cảm ơn {$request->billing_fullname}, đơn hàng của bạn đã được đặt thành công!");
    }
}
