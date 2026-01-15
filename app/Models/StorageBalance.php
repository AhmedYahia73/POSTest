<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StorageBalance extends Model
{
    protected $fillable = [
        'storage_id',
        'product_id',
        'quantity',
    ];

    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function storage(){
        return $this->belongsTo(Storage::class, 'storage_id');
    }
}
