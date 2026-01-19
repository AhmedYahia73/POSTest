<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfferSupplier extends Model
{
    protected $fillable = [
        'name',
        'supplier',
        'desciption',
        'date',
        'status',
        'total',
        'branch_id',
    ];

    public function products(){
        return $this->hasMany(OfferProduct::class, 'offer_id');
    }

    public function branch(){
        return $this->belongsTo(Branch::class, 'branch_id');
    }
}
