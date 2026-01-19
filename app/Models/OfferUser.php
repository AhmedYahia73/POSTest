<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfferUser extends Model
{
    protected $fillable = [
        'name',
        'user',
        'desciption',
        'date',
        'status',
        'total',
        'branch_id',
    ];

    public function products(){
        return $this->hasMany(OfferUProduct::class, 'offer_id');
    }

    public function branch(){
        return $this->belongsTo(Branch::class, 'branch_id');
    }
}