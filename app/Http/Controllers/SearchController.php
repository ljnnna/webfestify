<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $productName = $request->input('product');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $products = Product::query();

        if ($productName) {
            $products->where('name', 'like', '%' . $productName . '%');
        }

        if ($startDate && $endDate) {
            // Sesuaikan nama kolom jika kamu punya kolom ketersediaan
            $products->whereDate('available_from', '<=', $startDate)
                     ->whereDate('available_until', '>=', $endDate);
        }

        $results = $products->get();

        return view('pages.customer.searchpage', compact('results'));
    }
}
