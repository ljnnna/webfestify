<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class WelcomeController extends Controller
{

    public function welcome()
    {
$products = Product::with('images') // <-- penting!
            ->where('status', 'available')
            ->orderBy('created_at', 'desc')
            ->take(8)
            ->get();

    return view('welcome', compact('products')); // <-- pastikan ini sesuai dengan variabel di view
    }
    
}

