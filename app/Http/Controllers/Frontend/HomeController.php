<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;

class HomeController extends Controller
{
    public function index ()
    {
        $products = Product::orderBy('id')->paginate(20);
        return view('frontend.index', compact('products'));
    }
}
