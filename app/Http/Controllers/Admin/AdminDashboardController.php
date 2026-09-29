<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;

class AdminDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        $stats = [
            'total_users'      => User::where('is_admin', false)->count(),
            'total_bookings'   => Booking::count(),
            'total_orders'     => Order::count(),
            'total_products'   => Product::count(),
            'pending_bookings' => Booking::where('status', 'pending')->count(),
            'pending_orders'   => Order::where('status', 'pending')->count(),
            'revenue_bookings' => Booking::where('status', 'completed')->sum('total_price'),
            'revenue_orders'   => Order::where('status', 'completed')->sum('total_price'),
        ];

        $recent_bookings = Booking::with(['user', 'studioSession'])->latest()->take(5)->get();
        $recent_orders   = Order::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recent_bookings', 'recent_orders'));
    }
}