<?php

use Illuminate\Support\Facades\Route;

use App\Models\Category;
use App\Models\Product;

Route::get('/admin/point_of_sales/{id}', function ($id) {
    $categories = Category::all();
    $products = Product::
    where("branch_id", $id)
    ->get();
    return view('pos', compact("categories", "products"));
});
