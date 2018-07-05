@extends('backend.layouts.dashboard')
@section('title', 'order List') 
@section('content')
<div class="container">
    <section class="page-section my-5 p-5">
        <div class="row">
            <table class="table mt-5">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">商品名稱</th>
                        <th scope="col">商品副標題</th>
                        <th scope="col">圖片</th>
                        <th scope="col">操作</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order) 
                        <tr>
                            <th class="align-middle" scope="row">{{ $order->id }}</th>
                            <td class="align-middle">{{ $order->title }}</td>
                            <td class="align-middle">{{ $order->subtitle }}</td>
                            <td class="align-middle"><img src="{{ asset('uploads/order/'. $order->image) }}" width="100px"></td>
                            <td class="align-middle">
                                <a href="{{ route('admin.order.edit', $order->id) }}" class="btn btn-primary">修改</a>
                                <form method="POST" action="{{ route('admin.order.destroy', $order->id) }}">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-secondary">刪除</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td>No order</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</div>
@endsection