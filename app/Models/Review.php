<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    protected $fillable = [
        'user_id', 'product_id', 'return_product_id', 'order_product_id', 'rating', 'review'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function returnProduct() {
        return $this->belongsTo(ReturnProduct::class);
    }
}
