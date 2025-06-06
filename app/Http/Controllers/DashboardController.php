<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use App\Models\Review;
use App\Models\Report;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung total produk
        $total_product = Product::count();

        // Hitung order berdasarkan status (asumsi ada field 'status' di tabel orders)
        $order_new = Order::where('status', 'new')->count();
        $order_progress = Order::where('status', 'progress')->count();
        $order_done = Order::where('status', 'done')->count();

        // Produk tersedia dan disewa (asumsi field 'status' di tabel products)
        $product_available = Product::where('status', 'available')->count();
        $product_rented = Product::where('status', 'rented')->count();

        // Total customer (asumsi role user customer adalah 'customer')
        $total_customers = User::where('usertype', 'customer')->count();

        // Review terbaru
        $reviews = Review::with(['user', 'product'])->latest()->take(5)->get();

        return view('admin.dashboardfestify', compact(
            'total_product',
            'order_new',
            'order_progress',
            'order_done',
            'product_available',
            'product_rented',
            'total_customers',
            'reviews'
        ));
    }
}
