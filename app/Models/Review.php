<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'user_id', 'product_id', 'rental_id', 'rating', 'review'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function rental() {
        return $this->belongsTo(Rental::class);
    }

    public function rentalItems()
    {
    return $this->hasMany(RentalItem::class);
    }
}
