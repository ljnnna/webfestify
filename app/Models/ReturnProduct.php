<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'order_product_id',
        'product_id',
        'user_id',
        'quantity_returned',
        'return_status',
        'return_processed_at',
        'return_completed_at',
        'product_condition',
        'condition_before',
        'condition_after',
        'condition_notes',
        'penalty_amount',
        'refund_amount',
        'processed_by'
    ];

    protected $casts = [
        'condition_before' => 'array',
        'condition_after' => 'array',
        'return_processed_at' => 'datetime',
        'return_completed_at' => 'datetime',
        'penalty_amount' => 'decimal:2',
        'refund_amount' => 'decimal:2'
    ];

    // Relasi ke Order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Relasi ke OrderProduct
    public function orderProduct()
    {
        return $this->belongsTo(OrderProduct::class);
    }

    // Relasi ke Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Relasi ke User (yang melakukan return)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
}
