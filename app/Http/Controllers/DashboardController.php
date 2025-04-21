<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
{
    $total_product = DB::table('products')->count();
    $total_sewa = DB::table('orders')->count();
    $total_customers = DB::table('users')->where('role', 2)->count();
    $total_reports = DB::table('reports')->count(); // Jika 'laporan' = sewa

    return view('dashboardfestify', compact(
        'total_product',
        'total_sewa',
        'total_customers',
        'total_reports'
    ));
}
}
