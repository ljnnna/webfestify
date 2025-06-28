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
        'available_from',           
        'available_until',          
        'max_rent_duration',        
    ];        

    protected static function boot()
    {
        parent::boot();
    
        static::creating(function ($product) {
            if (!$product->slug) {
                $product->slug = Str::slug($product->name);
            }
        
            // Fallback jika controller tidak set
            if (!$product->available_from) {
                $product->available_from = now();
            }
        
            if (!$product->available_until && $product->max_rent_duration) {
                $product->available_until = $product->available_from
                    ? \Carbon\Carbon::parse($product->available_from)->copy()->addDays($product->max_rent_duration)
                    : now()->addDays($product->max_rent_duration);
            }
        });
        
    
        static::updating(function ($product) {
            if ($product->isDirty('name')) {
                $product->slug = Str::slug($product->name);
            }
    
            // Jika max_rent_duration diubah, update juga available_until
            if ($product->isDirty('max_rent_duration') && $product->available_from) {
                $product->available_until = \Carbon\Carbon::parse($product->available_from)
                    ->addDays($product->max_rent_duration);
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

    public function getFirstImageUrlAttribute()
    {
        return $this->images->first()?->path 
            ? asset('storage/' . $this->images->first()->path)
            : asset('images/default.png');
    }

    public function getAvailableStockAttribute()
    {
        return $this->stock_quantity - $this->stock_rented;
    }

}
