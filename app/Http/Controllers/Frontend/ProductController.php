<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function show($id)
    {
        $product = Product::find($id);
        return view('frontend.product', compact('product'));
    }

    public function search(Request $request)
    {
        $word = $request->get('word');
        $products = Product::where('title', 'LIKE', '%' . $word . '%')->paginate(20);
        return view('frontend.search', compact('products'));
    }
}
