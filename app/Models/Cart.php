<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'user_id', 'product_id', 'quantity',
        'start_date', 'end_date', 'delivery_option', 'delivery_details'
    ];

    protected $casts = [
        'delivery_details' => 'array',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
