<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;

class NotificationController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'orderProducts'])->latest()->take(5)->get();
        $newOrderCount = Order::where('created_at', '>=', now()->subHours(3))->count();

        return view('components.navbaradmin', compact('orders'));
    }
}
