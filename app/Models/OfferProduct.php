<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfferProduct extends Model
{
    protected $fillable = [
        'offer_id',
        'product_id',
        'price',
        'quantity',
    ];

    public function products(){
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function offer(){
        return $this->belongsTo(OfferSupplier::class, 'offer_id');
    }
}
