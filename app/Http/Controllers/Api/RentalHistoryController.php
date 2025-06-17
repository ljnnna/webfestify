<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RentalHistoryController extends Controller
{
    /**
     * Get rental history for authenticated user
     */
    public function index(Request $request)
    {
        try {
            $userId = Auth::id(); // Dapatkan user ID dari yang sedang login
            
            return $this->getRentalHistoryByUserId($userId);
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve rental history',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get rental history by user ID (untuk testing)
     */
    public function testGetRentalHistory($userId)
    {
        try {
            return $this->getRentalHistoryByUserId($userId);
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve rental history',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Private method untuk mengambil rental history
     */
    private function getRentalHistoryByUserId($userId)
    {
        // Query dengan Query Builder Laravel
        $results = DB::table('orders as o')
            ->join('order_items as oi', 'o.id', '=', 'oi.order_id')
            ->join('products as p', 'oi.product_id', '=', 'p.id')
            ->select([
                'o.id as order_id',
                'o.order_code',
                'o.total_amount',
                'o.status',
                'o.start_date',
                'o.end_date',
                'o.payment_status',
                'o.notes',
                'o.created_at',
                'oi.product_id',
                'oi.quantity',
                'oi.unit_price',
                'oi.subtotal',
                'p.name as product_name',
                'p.image as product_image',
                'p.description as product_description'
            ])
            ->where('o.user_id', $userId)
            ->orderBy('o.created_at', 'desc')
            ->get();

        if ($results->isEmpty()) {
            return response()->json([
                'status' => 'success',
                'data' => [],
                'message' => 'No rental history found',
                'empty' => true
            ]);
        }

        // Group data berdasarkan order_id
        $groupedData = $results->groupBy('order_id')->map(function ($orderItems, $orderId) {
            $firstItem = $orderItems->first();
            
            return [
                'order_id' => $orderId,
                'order_code' => $firstItem->order_code,
                'total_amount' => $firstItem->total_amount,
                'status' => $firstItem->status,
                'start_date' => $firstItem->start_date,
                'end_date' => $firstItem->end_date,
                'payment_status' => $firstItem->payment_status,
                'notes' => $firstItem->notes,
                'created_at' => $firstItem->created_at,
                'products' => $orderItems->map(function ($item) {
                    return [
                        'product_id' => $item->product_id,
                        'product_name' => $item->product_name,
                        'product_image' => $item->product_image,
                        'product_description' => $item->product_description,
                        'quantity' => $item->quantity,
                        'unit_price' => $item->unit_price,
                        'subtotal' => $item->subtotal
                    ];
                })->toArray()
            ];
        })->values();

        return response()->json([
            'status' => 'success',
            'data' => $groupedData,
            'message' => 'Rental history retrieved successfully',
            'empty' => false
        ]);
    }

    /**
     * Show specific rental history
     */
    public function show($id)
    {
        try {
            $userId = Auth::id();
            
            $order = DB::table('orders as o')
                ->join('order_items as oi', 'o.id', '=', 'oi.order_id')
                ->join('products as p', 'oi.product_id', '=', 'p.id')
                ->select([
                    'o.id as order_id',
                    'o.order_code',
                    'o.total_amount',
                    'o.status',
                    'o.start_date',
                    'o.end_date',
                    'o.payment_status',
                    'o.notes',
                    'o.created_at',
                    'oi.product_id',
                    'oi.quantity',
                    'oi.unit_price',
                    'oi.subtotal',
                    'p.name as product_name',
                    'p.image as product_image',
                    'p.description as product_description'
                ])
                ->where('o.id', $id)
                ->where('o.user_id', $userId)
                ->get();

            if ($order->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Order not found'
                ], 404);
            }

            $firstItem = $order->first();
            $orderData = [
                'order_id' => $firstItem->order_id,
                'order_code' => $firstItem->order_code,
                'total_amount' => $firstItem->total_amount,
                'status' => $firstItem->status,
                'start_date' => $firstItem->start_date,
                'end_date' => $firstItem->end_date,
                'payment_status' => $firstItem->payment_status,
                'notes' => $firstItem->notes,
                'created_at' => $firstItem->created_at,
                'products' => $order->map(function ($item) {
                    return [
                        'product_id' => $item->product_id,
                        'product_name' => $item->product_name,
                        'product_image' => $item->product_image,
                        'product_description' => $item->product_description,
                        'quantity' => $item->quantity,
                        'unit_price' => $item->unit_price,
                        'subtotal' => $item->subtotal
                    ];
                })->toArray()
            ];

            return response()->json([
                'status' => 'success',
                'data' => $orderData,
                'message' => 'Order retrieved successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve order',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}