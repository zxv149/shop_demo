<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrdersDetail;
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

    public function updateCart(Request $request)
    {
        $cart = Session::get('cart');
        $product = Product::find($request['id']);
        if (isset($cart[$request['id']]) && $request['qty'] >= 1) {
            if ($product->qty >= $request['qty']) {
                $cart[$request['id']]['qty'] = $request['qty'];
            }
            elseif ($product->qty < 1) {
                $cart[$request['id']]['qty'] = 0;
            }
        }
        Session::put('cart', $cart);

        return response()->json($cart[$request['id']]['qty']);

    }

    public function deleteCart($id)
    {
        $cart = Session::get('cart');
        unset($cart[$id]);
        Session::put('cart', $cart);
        return redirect()->back();
    }

    public function check(Request $request)
    {
        $cart = Session::get('cart');
        $payment = Session::get('payment');
        $payment = $request['payment'];
        $total = 0;
        foreach ($cart as $product) {
            $total+=$product['price']*$product['qty'];
        }
        return view('frontend.check', compact('cart', 'payment', 'total'));
    }

    public function checkout(Request $request)
    {
        $cart = Session::get('cart');
        $payment = Session::get('payment');
        $total = 0;
        $total_qty = 0;
        foreach ($cart as $product) {
            $total+=$product['price']*$product['qty'];
            $total_qty+=$product['qty'];
        }
        if ($total > 0 && is_integer($total)) {

            $order = new Order();
            $order->m_id = 1;
            $order->o_total = $total;
            $order->o_qty = $total_qty;
            $order->o_name = $request['order_name'];
            $order->address = $request['address'];
            $order->phone = $request['phone'];
            $order->remark = $request['remark'];
            $order->payment = $payment;
            if ($order->save()) {
                foreach ($cart as $product) {
                    $orderDetail = new OrdersDetail();
                    $orderDetail->o_id = $order->id;
                    $orderDetail->p_id =$product['id'];
                    $orderDetail->od_price = $product['price'];
                    $orderDetail->od_qty = $product['qty'];
                    $orderDetail->od_total = $product['price']*$product['qty'];
                    $orderDetail->save();
                }
            }

            return view('frontend.checkout');
        }
        else {
            return redirect()->route('frontend.home');
        }
    }

}
