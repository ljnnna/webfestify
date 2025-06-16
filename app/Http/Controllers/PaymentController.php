<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class PaymentController extends Controller
{
    public function payment()
    {
        $rentalData = session('rental_data');
        
        if (!$rentalData) {
            return redirect()->route('catalog')->with('error', 'No rental data found.');
        }

        $product = Product::with('images')->findOrFail($rentalData['product_id']);
        
        // Calculate pricing
        $subtotal = $product->price * $rentalData['quantity'] * $rentalData['rental_days'];
        $serviceFee = 5000; // Fixed service fee
        $deposit = $subtotal * 0.5; // 50% deposit
        $shippingCost = $rentalData['delivery_option'] === 'delivery' ? 20000 : 0;
        $total = $subtotal + $serviceFee + $deposit + $shippingCost;

        $paymentData = [
            'product' => $product,
            'rental_data' => $rentalData,
            'pricing' => [
                'subtotal' => $subtotal,
                'service_fee' => $serviceFee,
                'deposit' => $deposit,
                'shipping_cost' => $shippingCost,
                'total' => $total
            ]
        ];


        return view('pages.customer.paymentcust', compact('paymentData'));
    }
}
