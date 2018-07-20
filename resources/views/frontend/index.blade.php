@extends('frontend.layouts.master')
@section('title', 'Product List')
@section('content')
<!-- Image header -->
<div class="w3-display-container w3-container">
    <img src="{{ asset('/images/jeans.jpg') }}" alt="Jeans" style="width:100%">
    <div class="w3-display-topleft w3-text-white" style="padding:24px 48px">
        <h1 class="w3-jumbo w3-hide-small">New arrivals</h1>
        <h1 class="w3-hide-large w3-hide-medium">New arrivals</h1>
        <h1 class="w3-hide-small">COLLECTION 2016</h1>
        <p><a href="#anchor" class="w3-button w3-black w3-padding-large w3-large">SHOP NOW</a></p>
    </div>
</div>
<br>

<!-- Product grid -->
<div class="w3-row w3-grayscale" id="anchor">
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

{{ $products->links() }}

@endsection