@extends('frontend.layouts.master')
@section('title', 'Product List')
@section('content')

<!-- Product grid -->
<div class="w3-row w3-grayscale">
    @forelse ($products as $product)
    <div class="w3-col l3 s6">
        <div class="w3-container">
            <div class="w3-display-container">
                <img src="{{ asset('uploads/product/'. $product->image) }}" style="width:205px; height: 160px;">
                <span class="w3-tag w3-display-topleft"></span>
                <div class="w3-display-middle w3-display-hover">
                    <a href="{{ route('product.show', $product->id) }}" class="w3-button w3-black">Buy now <i class="fa fa-shopping-cart"></i></a>
                </div>
            </div>
            <p>{{ $product->title }}<br><b>$NT {{ $product->price }}</b></p>
        </div>
    </div>
    @empty
    <h1>No Product</h1>
    @endforelse

</div>
@endsection