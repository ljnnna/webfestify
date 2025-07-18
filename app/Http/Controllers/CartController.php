<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Cart;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::with('product')->where('user_id', Auth::id())->get();
        return view('pages.customer.cart-page', compact('cart'));
    }

    public function add(Request $request, $slug)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must login to add items to cart.');
        }
    
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'delivery_option' => 'required|in:pickup,delivery',
        ]);
    
        if ($validated['delivery_option'] === 'delivery') {
            $request->validate([
                'recipient_name' => 'required|string|max:100',
                'phone' => 'required|digits_between:10,13',
                'address' => 'required|string|max:255',
            ]);
        }
    
        $product = Product::where('slug', $slug)->firstOrFail();
    
        // Update jika cart sudah ada
        $cartItem = Cart::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'product_id' => $product->id,
            ],
            [
                'quantity' => $validated['quantity'],
                'start_date' => $validated['start_date'],
                'end_date' => $validated['end_date'],
                'delivery_option' => $validated['delivery_option'],
                'delivery_details' => $validated['delivery_option'] === 'delivery' ? json_encode([
                    'recipient_name' => $request->recipient_name,
                    'phone' => $request->phone,
                    'address' => $request->address,
                ]) : null,
            ]
        );
    
        return redirect()->route('cart')->with('success', 'Cart updated successfully.');
    }

    public function processPendingCart()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        $pendingData = session()->get('pending_cart_data');
        
        if (!$pendingData) {
            return redirect()->route('catalog');
        }
        
        $request = new Request($pendingData);
        session()->forget('pending_cart_data');
        
        return $this->add($request, $pendingData['slug']);
    }

    public function remove($slug)
    {
        $user = Auth::user();
    
        $product = Product::where('slug', $slug)->firstOrFail();
    
        Cart::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->delete();
    
        return redirect()->route('cart')->with('success', 'Product removed from cart.');
    }
    
    public function updateDelivery(Request $request, $slug)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$slug])) {
            $cart[$slug]['delivery_option'] = $request->input('delivery_option', 'pickup');
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Delivery option updated.');
    }

    // ✅ PERBAIKAN: Hapus method paymentPage() yang tidak digunakan
    // karena sudah ada di PaymentController::checkoutFromCart()
}