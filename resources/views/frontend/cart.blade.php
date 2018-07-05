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
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($cart as $product)
                        <tr>
                            <td class="align-middle"><img src="{{ asset('uploads/product/'. $product['image']) }}" width="100px"></td>
                            <td class="align-middle">{{ $product['title'] }}</td>
                            <td class="align-middle">{{ $product['price'] }}</td>
                            <td class="align-middle">{{ $product['qty'] }}</td>
                            <td class="align-middle">
                                <form method="POST" action="{{ route('cart.delete', $product['id']) }}">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-secondary">刪除</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td>No Product</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </div>
@endsection