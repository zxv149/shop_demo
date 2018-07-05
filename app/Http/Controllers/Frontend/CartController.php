<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Session;

class CartController extends Controller
{
    //
    public function index()
    {
        $cart = Session::get('cart');
        if (is_null($cart))
        {
            $cart = array();
        }
        return view('frontend.cart', compact('cart'));
    }

    public function addToCart($id)
    {
        $product = Product::find($id);
        $cart = Session::get('cart');
        $cart[$product->id] = array(
            "id" => $product->id,
            "title" => $product->title,
            "price" => $product->price,
            "image" => $product->image,
            "qty" => 1,
        );

        Session::put('cart', $cart);
        Session::flash('success','Add To Cart!');
        //dd(Session::get('cart'));
        return redirect()->back();
    }

    public function updateCart(Request $cartdata)
    {
        $cart = Session::get('cart');

        foreach ($cartdata->all() as $id => $val)
        {
            if ($val > 0) {
                $cart[$id]['qty'] += $val;
            } else {
                unset($cart[$id]);
            }
        }
        Session::put('cart', $cart);
        return redirect()->back();
    }

    public function deleteCart($id)
    {
        $cart = Session::get('cart');
        unset($cart[$id]);
        Session::put('cart', $cart);
        return redirect()->back();
    }
}
