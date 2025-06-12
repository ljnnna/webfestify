<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index()
    {
        $products = Product::with('images')->get();
        $categories = Category::all();
        return view('pages.customer.catalogcustomer', compact('products', 'categories'));
    }
}
