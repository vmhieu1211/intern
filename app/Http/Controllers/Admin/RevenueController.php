<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Http\Controllers\Controller;

class RevenueController extends Controller
{
    public function index()
    {
        // Daily revenue
        $dailyRevenue = Order::whereDate('created_at', now()->toDateString())
            ->sum('billing_total');

        // Monthly revenue
        $monthlyRevenue = Order::whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->sum('billing_total');

        // Yearly revenue
        $yearlyRevenue = Order::whereYear('created_at', now()->year)
            ->sum('billing_total');

        return view('admin.revenue.index', compact('dailyRevenue', 'monthlyRevenue', 'yearlyRevenue'));
    }
}
