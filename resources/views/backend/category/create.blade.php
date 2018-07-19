@extends('backend.layouts.dashboard')

@section('title', 'Category Create') 

@section('content')

<div class="container">

    <section class="page-section my-5 p-5">
    
        <form method="POST" action="{{ route('admin.category.store') }}" enctype="multipart/form-data">

            {{ csrf_field() }}

            <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="title">類別名稱</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="title">
                </div>
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