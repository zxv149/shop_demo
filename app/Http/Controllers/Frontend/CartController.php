<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrdersDetail;
use Illuminate\Support\Facades\Auth;
use Session;
use Ecpay;

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

    public function payment(Request $request)
    {
        $payment = Session::get('payment');
        Session::put('payment', $request->post('payment'));
        return response()->json($request->post('payment'));
    }

    public function check()
    {
        $cart = Session::get('cart');
        $payment = Session::get('payment');
        $total = 0;
        foreach ($cart as $product) {
            $total+=$product['price']*$product['qty'];
        }
        return view('frontend.check', compact('cart', 'payment', 'total'));
    }

    public function checkout(Request $request)
    {
        $cart = Session::get('cart');
        $payment = Session::get('payment', 'cash');
        $total = 0;
        $total_qty = 0;
        foreach ($cart as $product) {
            $total+=$product['price']*$product['qty'];
            $total_qty+=$product['qty'];
        }
        if ($total > 0 && is_integer($total)) {

            $order = new Order();
            $order->m_id = Auth::id();
            $order->serno = date("YmdHis").rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9);
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
                    $orderDetail->p_id = $product['id'];
                    $orderDetail->od_price = $product['price'];
                    $orderDetail->od_qty = $product['qty'];
                    $orderDetail->od_total = $product['price']*$product['qty'];
                    $orderDetail->save();
                }

                if ($payment == 'card') {

                    try {
                        //Official Example :
                        //https://github.com/ECPay/ECPayAIO_PHP/blob/master/AioSDK/example/sample_Credit_CreateOrder.php

                        //基本參數(請依系統規劃自行調整)
                        Ecpay::i()->Send['ReturnURL']         = "http://www.allpay.com.tw/receive.php";
                        Ecpay::i()->Send['ClientBackURL']         = route('home');
                        Ecpay::i()->Send['MerchantTradeNo']   = $order->serno ;           //訂單編號
                        Ecpay::i()->Send['MerchantTradeDate'] = date('Y/m/d H:i:s');      //交易時間
                        Ecpay::i()->Send['TotalAmount']       = $order->o_total;                     //交易金額
                        Ecpay::i()->Send['TradeDesc']         = "Test Order" ;         //交易描述
                        Ecpay::i()->Send['ChoosePayment']     = \ECPay_PaymentMethod::ALL ;     //付款方式

                        //訂單的商品資料
                        foreach ($cart as $product) {
                            array_push(Ecpay::i()->Send['Items'], array('Name' => $product['title'], 'Price' => (int)$product['price'],
                                'Currency' => "元", 'Quantity' => (int)$product['qty'], 'URL' => "dedwed"));
                        }


                        //Go to ECPay
                        echo "緑界頁面導向中...";
                        echo Ecpay::i()->CheckOutString();

                    } catch (Exception $e) {
                        // todo Exception

                    }

                }

            }

            $request->session()->forget('cart');
            $request->session()->forget('payment');
            return view('frontend.checkout');
        }
        else {
            return redirect()->route('home');
        }
    }

}
