<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseProduct extends Model
{
    protected $fillable = [
        'purchase_id',
        'product_id',
        'price',
        'quantity',
    ];

    public function products(){
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function purchase(){
        return $this->belongsTo(Purchase::class, 'purchase_id');
    }
}
