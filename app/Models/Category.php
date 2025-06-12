<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    // Tambahkan 'slug' ke fillable
    protected $fillable = ['name', 'slug'];

    // Relasi: Satu kategori bisa punya banyak produk
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    // Opsional: generate slug otomatis dari name
    public static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });

        static::updating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });
    }
}
