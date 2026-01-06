<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;

    protected $guarded = []; // Izinkan semua kolom diisi

    // 1 Item di keranjang PASTI adalah 1 Produk
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // 1 Item di keranjang PASTI punya 1 User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
