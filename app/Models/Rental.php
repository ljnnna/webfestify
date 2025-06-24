<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    protected $fillable = [
        'user_id', 'status', // sesuaikan dengan kolommu
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rentalItems()
    {
        return $this->hasMany(RentalItem::class);
    }
}
