@extends('backend.layouts.dashboard')

@section('title', 'order Edit') 

@section('content')

<div class="container">
    
    <section class="page-section my-5 p-5">

        <form method="POST" action="{{ route('admin.order.update',  $order->id) }}" enctype="multipart/form-data">

            {{ csrf_field() }}

            {{ method_field('PUT') }}

            <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="title">訂單編號</label>
                <div class="col-sm-10">
                    <p>{{$order->serno}}</p>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="title">訂購人</label>
                <div class="col-sm-10">
                    <p>{{$order->o_name}}</p>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="title">地址</label>
                <div class="col-sm-10">
                    <p>{{$order->address}}</p>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="title">電話</label>
                <div class="col-sm-10">
                    <p>{{$order->phone}}</p>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="title">付款方式</label>
                <div class="col-sm-10">
                    <p>{{$order->payment}}</p>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="title">訂購時間</label>
                <div class="col-sm-10">
                    <p>{{$order->created_at}}</p>
                </div>
            </div>

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
                @forelse ($order->details as $detail)
                    <tr>
                        <td class="align-middle"><img src="{{ asset('uploads/product/'. $detail->product->image) }}" width="100px"></td>
                        <td class="align-middle">{{ $detail->product->title }}</td>
                        <td class="align-middle" >{{ $detail->od_price }}</td>
                        <td class="align-middle">{{ $detail->od_qty }}</td>
                        <td class="align-middle" >{{ $detail->od_total }}</td>
                    </tr>

                @empty
                    <tr>
                        <td>No Product</td>
                    </tr>
                @endforelse
                </tbody>
                <tr>
                    <td class="align-middle"></td>
                    <td class="align-middle"></td>
                    <td class="align-middle"></td>
                    <td class="align-middle"></td>
                    <td class="align-middle" >{{ $order->o_total }}</td>
                </tr>
            </table>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="title">訂單狀態</label>
                <div class="col-sm-10">
                    <select name="status" id="status">
                        <option value="0">未付款</option>
                        <option {{ $order->status == 1 ? 'selected' : '' }} value="1">以付款</option>
                    </select>
                </div>
            </div>

            <div class="form-group row justify-content-end">
                <div class="col-sm-1">
                    <button type="submit" class="btn btn-primary">更新</button>
                </div>
            </div>
            
        </form>

    </section>
    
</div>


@endsection