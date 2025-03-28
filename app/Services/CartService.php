<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Session;

class CartService
{
    public function get()
    {
        return Session::get('cart', []);
    }

    public function add($id, $name, $quantity, $price)
    {
        $cart = $this->get();

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $quantity;
        } else {
            $cart[$id] = compact('id', 'name', 'quantity', 'price');
        }

        Session::put('cart', $cart);
    }

    public function update($id, $quantity)
    {
        $cart = $this->get();

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $quantity;
        }

        Session::put('cart', $cart);
    }

    public function remove($id)
    {
        $cart = $this->get();
        unset($cart[$id]);
        Session::put('cart', $cart);
    }

    public function clear()
    {
        Session::forget('cart');
    }
}
