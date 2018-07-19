@extends('backend.layouts.dashboard')

@section('title', 'Product Edit') 

@section('content')

<div class="container">
    
    <section class="page-section my-5 p-5">

        <form method="POST" action="{{ route('admin.product.update',  $product->id) }}" enctype="multipart/form-data">

            {{ csrf_field() }}

            {{ method_field('PUT') }}

            <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="title">商品名稱</label>
                <div class="col-sm-8">
                    <input class="form-control" type="text" name="title" value="{{$product->title}}">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="title">類別</label>
                <div class="col-sm-8">
                    <select class="form-control" name="category">
                        @forelse ($categorys as $category)
                            <option {{ $category->id == $product->category_id ? 'selected="selected"' : '' }} value="{{ $category->id }}">{{ $category->title }}</option>
                        @empty

                        @endforelse
                        <option {{ 0 == $product->category_id ? 'selected="selected"' : '' }} value="0">其他</option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="title">價格</label>
                <div class="col-sm-8">
                    <input class="form-control" type="number" name="price" value="{{$product->price}}">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="title">數量</label>
                <div class="col-sm-8">
                    <input class="form-control" type="number" name="qty" value="{{$product->qty}}">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="description">商品描述</label>
                <div class="col-sm-8">
                    <textarea class="form-control" type="text" name="description" rows="5">{{$product->description}}</textarea>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="image">圖片</label>
                <div class="col-sm-8">
                    <input class="form-control" type="file" name="image">
                </div>
                <div>
                    <img src="{{ asset('uploads/product/' . $product->image) }}" class="mt-3" style="display:block; margin: auto; height: 100%; width: 200px; object-fit: contain" onerror="this.src='{{ asset('uploads/product/default.jpg') }}'">
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