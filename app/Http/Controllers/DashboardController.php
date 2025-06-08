<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use App\Models\Review;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public static function getDashboardData()
    {
        $total_product = Product::count();

        $order_new = Order::where('status', 'new')->count();
        $order_progress = Order::where('status', 'progress')->count();
        $order_done = Order::where('status', 'done')->count();

        $product_available = Product::where('status', 'available')->count();
        $product_rented = Product::where('status', 'rented')->count();

        $total_customers = User::where('usertype', 'customer')->count();

        $reviews = Review::with(['user', 'product'])->latest()->take(5)->get();

        return [
            'total_product' => $total_product,
            'order_new' => $order_new,
            'order_progress' => $order_progress,
            'order_done' => $order_done,
            'product_available' => $product_available,
            'product_rented' => $product_rented,
            'total_customers' => $total_customers,
            'reviews' => $reviews,
        ];
    }

    public function index()
    {
        $data = self::getDashboardData();
        return view('admin.dashboardfestify', $data);
    }
}
