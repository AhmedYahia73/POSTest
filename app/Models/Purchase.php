<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = [
        'invoice_number',
        'image',
        'supplier',
        'desciption',
        'date', 
        'total',
        'branch_id',
    ];

    public function products(){
        return $this->hasMany(PurchaseProduct::class, 'purchase_id');
    }

    public function branch(){
        return $this->belongsTo(Branch::class, 'branch_id');
    }
}
