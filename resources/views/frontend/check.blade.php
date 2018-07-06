@extends('frontend.layouts.master')
@section('title', 'Product List')
@section('content')
    <div class="container">
        <section class="page-section my-5 p-5">
            <div class="row">
                <table class="table mt-5">
                    <thead>
                    <tr>
                        <th scope="col">圖片</th>
                        <th scope="col">商品名稱</th>
                        <th scope="col">價格</th>
                        <th scope="col">數量</th>
                        <th scope="col">小計</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($cart as $product)
                        <tr>
                            <td class="align-middle"><img src="{{ asset('uploads/product/'. $product['image']) }}" width="100px"></td>
                            <td class="align-middle">{{ $product['title'] }}</td>
                            <td class="align-middle" id="price_{{ $product['id'] }}">{{ $product['price'] }}</td>
                            <td class="align-middle" id="qty_{{ $product['id'] }}">{{ $product['qty'] }}</td>
                            <td class="align-middle" id="count_{{ $product['id'] }}">{{ $product['price']*$product['qty'] }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td>No Product</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>



            </div>

            @if (count($cart) >= 1)
                <div class="">
                    <form method="POST" action="{{ route('cart.checkout') }}">
                        {{ csrf_field() }}
                        {{ method_field('POST') }}
                        <div class="form-control">
                            <div class="payment">
                                <label for="payment">付款方式：</label>
                                <p>{{ 'card' == $payment ? '線上刷卡' : '貨到付款' }}</p>
                            </div>
                            <div class="total">
                                <label for="total">總計：</label>
                                <p>{{ $total }} $NT</p>
                            </div>
                        </div>
                        <br>
                        <div class="form-control">
                            <label for="order_name">訂購人姓名：</label>
                            <input required class="form-control" type="text" id="order_name" name="order_name">
                            <label for="order_name">訂購人地址：</label>
                            <input required class="form-control" type="text" id="address" name="address">
                            <label for="order_name">訂購人電話：</label>
                            <input required class="form-control" type="text" id="phone" name="phone">
                            <label for="order_name">備註：</label>
                            <textarea class="form-control" type="text" id="remark" name="remark"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary pull-right">確認</button>
                    </form>
                </div>

            @else

            @endif

        </section>
    </div>
@endsection
