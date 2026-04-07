<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Coupon;
use App\Services\CartService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CouponsController extends Controller
{
    public function __construct(private CartService $cart) {}

    public function store(Request $request)
    {
        $coupon = Coupon::where('code', $request->coupon_code)->first();

        if (! $coupon) {
            return redirect()->route('cart.index')->withErrors('Mã giảm giá không hợp lệ. Vui lòng thử lại.');
        }

        $this->cart->applyCoupon($coupon);

        return redirect()->route('cart.index')->with('success', 'Áp dụng mã giảm giá thành công!');
    }

    public function destroy()
    {
        $this->cart->removeCoupon();

        return redirect()->route('cart.index')->with('success', 'Đã xóa mã giảm giá.');
    }
}
