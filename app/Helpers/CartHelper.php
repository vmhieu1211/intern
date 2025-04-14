<?php

namespace App\Helpers;

class CartHelper
{
    public static function getCart()
    {
        return session()->get('cart', []);
    }

    public static function addToCart($product, $quantity)
    {
        $cart = self::getCart();

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $quantity;
        } else {
            $cart[$product->id] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity,
                'image' => $product->photos->first()->images ?? 'frontend/img/no-image.png',
            ];
        }

        session()->put('cart', $cart);
    }

    public static function updateCart($id, $quantity)
    {
        $cart = self::getCart();

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $quantity;
            if ($cart[$id]['quantity'] <= 0) {
                unset($cart[$id]);
            }
        }

        session()->put('cart', $cart);
    }

    public static function removeFromCart($id)
    {
        $cart = self::getCart();

        if (isset($cart[$id])) {
            unset($cart[$id]);
        }

        session()->put('cart', $cart);
    }

    public static function clearCart()
    {
        session()->forget('cart');
    }

    public static function getCartTotal()
    {
        $cart = self::getCart();
        return array_reduce($cart, function ($total, $item) {
            return $total + ($item['price'] * $item['quantity']);
        }, 0);
    }
}