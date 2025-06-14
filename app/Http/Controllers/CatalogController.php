<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index()
    {
    $products = Product::with('mainImage')->get();
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
