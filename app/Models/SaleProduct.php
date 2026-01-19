<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleProduct extends Model
{
    protected $fillable = [
        'sale_id',
        'product_id',
        'price',
        'quantity',
    ];

    public function products(){
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function sales(){
        return $this->belongsTo(Sale::class, 'sale_id');
    }
}
