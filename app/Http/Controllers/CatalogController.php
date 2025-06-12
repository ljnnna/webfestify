<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index()
{
    $products = \App\Models\Product::with('images')->latest()->get();
    $categories = Category::all();

    return view('pages.customer.catalogcustomer', compact('products', 'categories'));
}


    public function byCategory(Category $category)
    {
        $products = $category->products()->with('images')->latest()->get();
        $categories = Category::all(); // jika ingin tampilkan semua kategori untuk navigasi

        return view('pages.customer.catalogcustomer', compact('products', 'category', 'categories'));
    }
}
