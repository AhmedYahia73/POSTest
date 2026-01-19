<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'invoice_number',
        'image',
        'user',
        'desciption',
        'date', 
        'total',
        'branch_id',
    ];

    public function products(){
        return $this->hasMany(SaleProduct::class, 'sale_id');
    }

    public function branch(){
        return $this->belongsTo(Branch::class, 'branch_id');
    }
}
