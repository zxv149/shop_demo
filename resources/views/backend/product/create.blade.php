@extends('backend.layouts.dashboard')

@section('title', 'Product Create') 

@section('content')

<div class="container">

    <section class="page-section my-5 p-5">
    
        <form method="POST" action="{{ route('admin.product.store') }}" enctype="multipart/form-data">

            {{ csrf_field() }}

            <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="title">商品名稱</label>
                <div class="col-sm-8">
                    <input class="form-control" type="text" name="title">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="title">類別</label>
                <div class="col-sm-8">
                    <select class="form-control" name="category">
                        @forelse ($categorys as $category)
                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                        @empty

                        @endforelse
                        <option value="0">其他</option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="subtitle">商品價格</label>
                <div class="col-sm-8">
                    <input class="form-control" type="number" name="price">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="subtitle">數量</label>
                <div class="col-sm-8">
                    <input class="form-control" type="number" name="qty">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="description">商品描述</label>
                <div class="col-sm-8">
                    <textarea class="form-control" type="text" name="description" rows="5"></textarea>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="image">圖片</label>
                <div class="col-sm-8">
                    <input class="form-control" type="file" name="image">
                </div>
                {{--  <img src="http://via.placeholder.com/1200x600" class="mt-3" style="height: 100%; width: 100%; object-fit: contain">  --}}
            </div>

            <div class="form-group row justify-content-end">
                <div class="col-sm-1">
                    <button type="submit" class="btn btn-primary">新增</button>
                </div>
            </div>
            
        </form>

    </section>
   
</div>


@endsection