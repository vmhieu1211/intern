<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProfileController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        $orders        = auth()->user()->orders()->orderBy('created_at', 'DESC')->paginate(10);
        $recentlyViewed = Product::inRandomOrder()->take(4)->get();

        return view('profile.index', compact('orders', 'recentlyViewed'));
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);

        $this->authorize('view', $order);

        $products      = $order->products()->get();
        $recentlyViewed = Product::inRandomOrder()->take(4)->get();

        return view('profile.show', compact('order', 'recentlyViewed', 'products'));
    }

    public function edit()
    {
        $user = auth()->user();

        return view('profile.edit', compact('user'));
    }

    public function update(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users,email,' . auth()->id(),
            'password' => 'sometimes|nullable|string|min:8|confirmed',
        ]);

        $user  = auth()->user();
        $input = $request->except(['password', 'password_confirmation']);

        $user->fill($input)->save();

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
            $user->save();
        }

        return redirect()->back()->with('success', 'Cập nhật thông tin thành công.');
    }
}
