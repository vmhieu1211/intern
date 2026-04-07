<?php

namespace App\Services;

use App\Models\Coupon;
use App\Models\Product;

class CartService
{
    public function get(): array
    {
        return session()->get('cart', []);
    }

    public function add(Product $product, int $quantity): void
    {
        $cart = $this->get();

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $quantity;
        } else {
            $cart[$product->id] = [
                'id'       => $product->id,
                'name'     => $product->name,
                'price'    => $product->price,
                'quantity' => $quantity,
                'image'    => $product->photos->first()->images ?? 'frontend/img/no-image.png',
            ];
        }

        session()->put('cart', $cart);
    }

    public function update(int $productId, int $quantity): void
    {
        $cart = $this->get();

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = $quantity;
            if ($cart[$productId]['quantity'] <= 0) {
                unset($cart[$productId]);
            }
        }

        session()->put('cart', $cart);
        $this->cleanCouponIfEmpty();
    }

    public function remove(int $productId): void
    {
        $cart = $this->get();
        unset($cart[$productId]);
        session()->put('cart', $cart);
        $this->cleanCouponIfEmpty();
    }

    public function clear(): void
    {
        session()->forget(['cart', 'coupon']);
    }

    public function subtotal(): float
    {
        return array_reduce($this->get(), function (float $total, array $item) {
            return $total + ($item['price'] * $item['quantity']);
        }, 0.0);
    }

    public function discount(): float
    {
        return session()->get('coupon.discount', 0);
    }

    public function total(): float
    {
        return $this->subtotal() - $this->discount();
    }

    public function getNumbers(): array
    {
        return [
            'subtotal' => $this->subtotal(),
            'discount' => $this->discount(),
            'total'    => $this->total(),
        ];
    }

    public function isEmpty(): bool
    {
        return empty($this->get());
    }

    public function applyCoupon(Coupon $coupon): void
    {
        session()->put('coupon', [
            'name'     => $coupon->code,
            'discount' => $coupon->discount($this->subtotal()),
        ]);
    }

    public function removeCoupon(): void
    {
        session()->forget('coupon');
    }

    private function cleanCouponIfEmpty(): void
    {
        if ($this->isEmpty() || $this->total() <= 0) {
            $this->removeCoupon();
        }
    }
}
