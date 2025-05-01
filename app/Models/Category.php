<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Jika kamu ingin bisa mass-assign data
    protected $fillable = ['name'];

    // Relasi: Satu kategori bisa punya banyak produk
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
