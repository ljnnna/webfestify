<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $totalOrders = Order::count();
        $completedOrders = Order::where('status', 'Completed')->count();
        $onProgressOrders = Order::where('status', 'Pending')->count(); // asumsi: 'Pending' == On Progress
        $canceledOrders = Order::where('status', 'Canceled')->count();

        $orders = Order::orderBy('user_id')
                       ->orderBy('product_id')
                       ->orderBy('status')
                       ->orderBy('order_date', 'desc')
                       ->get();

        return view('admin.orders', compact(
            'totalOrders',
            'completedOrders',
            'onProgressOrders',
            'canceledOrders',
            'orders'
        ));
    }
}
