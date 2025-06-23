<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RentalItem extends Model
{
    protected $fillable = [
        'rental_id',
        'product_id',
        'rental_days',
        'price',
        // tambahkan field lain jika ada
    ];

    public function rental()
    {
        return $this->belongsTo(Rental::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function review()
    {
        return $this->hasOne(Review::class, 'product_id', 'product_id')
            ->whereColumn('rental_id', 'rental_items.rental_id')
            ->where('user_id', auth()->id());
    }
}
