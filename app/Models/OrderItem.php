<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $guarded = [];

    // Item ini produk apa?
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
