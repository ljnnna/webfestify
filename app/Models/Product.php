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
        'images',
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

    public function scopeActive($query)
    {
    return $query->where('status', 'available'); // atau 1 kalau boolean
    }



}
