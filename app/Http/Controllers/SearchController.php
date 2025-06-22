<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        // Validasi jika ada tanggal
        if ($request->filled('start_date') || $request->filled('end_date')) {
            $request->validate([
                'start_date' => 'nullable|date',
                'end_date' => 'nullable|date|after_or_equal:start_date',
            ]);
        }

        $productName = $request->input('query');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $category = $request->input('category');
        $maxPrice = $request->input('max_price');

        $products = Product::query()->with('category');

        // Jika hanya cari nama (tanpa tanggal)
        if ($productName && !$startDate && !$endDate) {
            $products->where('name', 'like', '%' . $productName . '%');
        }

        // Jika cari nama + tanggal
        elseif ($productName && $startDate && $endDate) {
            $products->where(function ($query) use ($productName, $startDate, $endDate) {
                $query->where(function ($q) use ($productName, $startDate, $endDate) {
                    $q->where('name', 'like', '%' . $productName . '%')
                      ->whereDate('available_from', '<=', $startDate)
                      ->whereDate('available_until', '>=', $endDate);
                })->orWhere(function ($q) use ($productName) {
                    // Produk tanpa batas tanggal, tapi nama tetap harus cocok
                    $q->where('name', 'like', '%' . $productName . '%')
                      ->whereNull('available_from')
                      ->whereNull('available_until');
                });
            });
        }

        if ($category) {
            $products->whereHas('category', function ($q) use ($category) {
                $q->where('name', $category);
            });
        }

                // Filter berdasarkan harga maksimum
         if ($maxPrice) {
            $products->where('price', '<=', $maxPrice);
        }

        elseif ($productName) {
            $products->where('name', 'like', '%' . $productName . '%');
        }

        $products = $products->get();
        return view('pages.customer.searchpage', compact('products'));
        
    }
}
