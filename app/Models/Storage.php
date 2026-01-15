<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Storage extends Model
{
    protected $fillable = [
        'name',
        'main', 
        'branch_id',   
    ];

    public function branch(){
        return $this->belongsTo(Branch::class, 'branch_id');
    }
}
