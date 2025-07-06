<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Product;
use App\Models\RentalItem;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Simpan review baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'rental_item_id' => 'required|exists:rental_items,id',
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string|max:1000',
        ]);

        $user = Auth::user();

        $rentalItem = RentalItem::where('id', $request->rental_item_id)
            ->whereHas('rental', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            })
            ->firstOrFail();

        $existingReview = Review::where('user_id', $user->id)
            ->where('rental_item_id', $request->rental_item_id)
            ->first();

        if ($existingReview) {
            return back()->with('error', 'Kamu sudah memberikan review untuk produk ini.');
        }

        Review::create([
            'user_id' => $user->id,
            'product_id' => $request->product_id,
            'rental_item_id' => $request->rental_item_id,
            'rating' => $request->rating,
            'review' => $request->review,
        ]);

        return view('profile.rental-information', compact('rentalItem'));
    }

    /**
     * Tampilkan semua review (untuk admin)
     */
    public function index()
    {
        $reviews = Review::with('user', 'product')->latest()->paginate(10);
        return view('admin.reviews.index', compact('reviews'));
    }

    /**
     * Tampilkan semua review untuk 1 produk (misalnya di halaman detail produk)
     */
    public function byProduct($productId)
{
    $product = Product::findOrFail($productId);
    $reviews = Review::where('product_id', $productId)
                     ->with('user')
                     ->latest()
                     ->get();

    $reviews = $reviews->map(function ($r) {
        return [
            'username' => $r->user->name ?? 'Anonymous',
            'product' => $r->product->name ?? '-',
            'content' => $r->review,
            'date' => $r->created_at->format('d M Y'),
        ];
    });

    return view('components.review-item', compact('reviews'));
}

}
