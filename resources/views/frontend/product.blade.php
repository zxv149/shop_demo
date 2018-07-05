@extends('frontend.layouts.master')
@section('title', 'Product List')
@section('content')
<div class="row my-4">
    <div class="col-lg-8">
        <img class="img-fluid rounded img-responsive" src="{{ asset('uploads/product/'. $product->image) }}" alt="">
    </div>
    <!-- /.col-lg-8 -->
    <div class="col-lg-4">
        <h1>{{ $product->title }}</h1>
        <p>$NT {{ $product->price }}</p>
        <form method="POST" action="{{ route('cart.add', $product->id) }}">
            {{ csrf_field() }}
            {{ method_field('POST') }}
            <button class="btn btn-primary btn-lg">Add to Cart!</button>
        </form>
    </div>
    <!-- /.col-md-4 -->
</div>

<div class="bg-faded p-5 rounded">
    <p class="mb-0">
        {!! $product->description !!}
    </p>
</div>
@endsection