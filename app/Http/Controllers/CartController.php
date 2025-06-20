<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // ← WAJIB ini
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
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

        $product = Product::with('images')->where('slug', $slug)->firstOrFail();
        $quantity = (int) $validated['quantity'];

        $cart = session()->get('cart', []);

        if (isset($cart[$slug])) {
            // Update all necessary fields
            $cart[$slug]['quantity'] = $quantity;
            $cart[$slug]['start_date'] = $validated['start_date'];
            $cart[$slug]['end_date'] = $validated['end_date'];
            $cart[$slug]['delivery_option'] = $validated['delivery_option'];
        
            if ($validated['delivery_option'] === 'delivery') {
                $cart[$slug]['delivery_details'] = [
                    'recipient_name' => $request->input('recipient_name'),
                    'phone' => $request->input('phone'),
                    'address' => $request->input('address'),
                ];
            } else {
                unset($cart[$slug]['delivery_details']);
            }
        } else {
            $cart[$slug] = [
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->first_image_url,
                'quantity' => $quantity,
                'slug' => $slug,
                'start_date' => $validated['start_date'],
                'end_date' => $validated['end_date'],
                'delivery_option' => $validated['delivery_option'],
            ];
        
            if ($validated['delivery_option'] === 'delivery') {
                $cart[$slug]['delivery_details'] = [
                    'recipient_name' => $request->input('recipient_name'),
                    'phone' => $request->input('phone'),
                    'address' => $request->input('address'),
                ];
            }
        }
        

        $message = isset($cart[$slug]) ? 'Cart updated successfully.' : 'Product added to cart.';
        session()->put('cart', $cart);
        return redirect()->route('cart')->with('success', $message);

    }

    

    public function remove($slug)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$slug])) {
            unset($cart[$slug]);
            session()->put('cart', $cart);
        }

        logger()->info('Cart after remove:', $cart);

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

}
