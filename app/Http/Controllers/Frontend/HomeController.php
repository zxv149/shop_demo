<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Ecpay;

class HomeController extends Controller
{
    public function index ()
    {
        $products = Product::orderBy('id')->paginate(20);
        return view('frontend.index', compact('products'));
    }

    public function Demo()
    {
        //Official Example :
        //https://github.com/ECPay/ECPayAIO_PHP/blob/master/AioSDK/example/sample_Credit_CreateOrder.php

        //基本參數(請依系統規劃自行調整)
        Ecpay::i()->Send['ReturnURL']         = "http://www.allpay.com.tw/receive.php";
        Ecpay::i()->Send['MerchantTradeNo']   = "Test".time() ;           //訂單編號
        Ecpay::i()->Send['MerchantTradeDate'] = date('Y/m/d H:i:s');      //交易時間
        Ecpay::i()->Send['TotalAmount']       = 2000;                     //交易金額
        Ecpay::i()->Send['TradeDesc']         = "good to drink" ;         //交易描述
        Ecpay::i()->Send['ChoosePayment']     = \ECPay_PaymentMethod::ALL ;     //付款方式

        //訂單的商品資料
        array_push(Ecpay::i()->Send['Items'], array('Name' => "緑界黑芝麻豆漿", 'Price' => (int)"2000",
            'Currency' => "元", 'Quantity' => (int) "1", 'URL' => "dedwed"));

        //Go to ECPay
        echo "緑界頁面導向中...";
        echo Ecpay::i()->CheckOutString();
    }

    //付款成功後緑界背景callback
    public function doneDemo(Request $request)
    {
        $arFeedback = Ecpay::i()->CheckOutFeedback($request->all());
        print Ecpay::i()->getResponse($arFeedback);
    }
}
