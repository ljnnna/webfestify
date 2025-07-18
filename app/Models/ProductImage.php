<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'path'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Akses: $image->image_url
    public function getImageUrlAttribute()
    {
        return asset('storage/product_images/' . $this->path);
    }
}
