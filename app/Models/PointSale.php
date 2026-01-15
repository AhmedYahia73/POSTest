<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PointSale extends Model
{
    protected $fillable = [
        'name',
        'branch_id',
        'tax', 
     ];

    public function branch(){
        return $this->belongsTo(Branch::class, 'branch_id');
    }
}
