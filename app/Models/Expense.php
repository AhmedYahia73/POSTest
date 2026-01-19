<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = [
        'category_id',
        'description',
        'price',
        'branch_id',
    ];

    public function category(){
        return $this->belongsTo(ExpenseCategory::class, 'category_id');
    }

    public function branch(){
        return $this->belongsTo(Branch::class, 'branch_id');
    }
}
