<?php

namespace App\Models;
use App\Models\ReturnProduct;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $fillable = [
        'order_id', 'product_id', 'quantity', 'unit_price', 'subtotal'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function penalties()
    {
        return $this->hasMany(Penalty::class);
    }

    public function returnProduct()
    {
        return $this->hasOne(ReturnProduct::class, 'order_product_id');
    }

    protected $casts = [
        'condition_photos' => 'array',
    ];
    
}
