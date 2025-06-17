<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class DetailsController extends Controller
{
    public function detailsById($id)
{
    $product = Product::with('images')->findOrFail($id);
    $productImages = $product->images->pluck('path')->toArray();

    return view('pages.customer.detailsproductcatalogcust', compact('product', 'productImages'));
}

}
