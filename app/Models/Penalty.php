<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penalty extends Model
{
    protected $fillable = ['order_id', 'description', 'amount', 'notes'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}

