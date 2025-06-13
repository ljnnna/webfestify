<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'details',
        'price',
        'stock_quantity',
        'status',
    ];        

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot('quantity')->withTimestamps();
    }

    public function images()
    {
    return $this->hasMany(ProductImage::class);
    }

    // Relasi untuk gambar utama (gambar pertama)
    public function mainImage()
    {
        return $this->hasOne(ProductImage::class)->oldest('created_at');
    }

    // Tambahkan accessor untuk main image URL
    public function getMainImageUrlAttribute()
    {
        if ($this->mainImage) {
            return asset('storage/' . $this->mainImage->path);
        }
        return asset('images/no-image.jpg'); // gambar default
    }

    public function scopeActive($query)
    {
    return $query->where('status', 'available'); // atau 1 kalau boolean
    }



}
