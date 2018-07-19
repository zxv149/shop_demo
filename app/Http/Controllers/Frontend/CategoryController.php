<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;

class CategoryController extends Controller
{
    public function show($id)
    {
        $products = Product::where('category_id',$id)->get();
        return view('frontend.category', compact('products'));
    }
}
