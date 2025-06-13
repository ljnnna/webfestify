<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'details',
        'price',
        'stock_quantity',
        'status',
        'images',
    ];        

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            $product->slug = Str::slug($product->name);
        });

        static::updating(function ($product) {
            if ($product->isDirty('name')) {
                $product->slug = Str::slug($product->name);
            }
        });
    }

    public function getRouteKeyName()
    {
    return 'slug';
    }

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
        return $query->where('status', 'available');
    }
}
