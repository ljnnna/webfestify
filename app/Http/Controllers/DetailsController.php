<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class DetailsController extends Controller
{
    public function details($slug)
    {
        $product = Product::with('images')->where('slug', $slug)->firstOrFail();
        return view('pages.customer.detailsproductcatalogcust', compact('product'));
    }
}
