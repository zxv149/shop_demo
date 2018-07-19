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
                        <th scope="col">訂單編號</th>
                        <th scope="col">訂購人</th>
                        <th scope="col">訂購時間</th>
                        <th scope="col">操作</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order) 
                        <tr>
                            <th class="align-middle" scope="row">{{ $order->id }}</th>
                            <td class="align-middle">{{ $order->serno }}</td>
                            <td class="align-middle">{{ $order->o_name}}</td>
                            <td class="align-middle">{{ $order->created_at}}</td>
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