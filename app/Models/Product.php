<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'price',
        'coast',
        'category_id', 
        'branch_id', 
        'description',
        'points',
        'image',  
    ];

    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function branch(){
        return $this->belongsTo(Branch::class, 'branch_id');
    }
}
