<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // SOLUSI: Tambahkan baris ini.
    // Ini artinya: "Izinkan semua kolom diisi secara massal"
    protected $guarded = [];

    // ATAU jika ingin spesifik (pilih salah satu cara), pakai yang ini:
    // protected $fillable = ['name', 'category', 'price', 'image'];
}   
