@extends('backend.layouts.dashboard')
@section('title', 'Category List') 
@section('content')
<div class="container">
    <section class="page-section my-5 p-5">
        <div class="row">
            <div class="col-sm-1">
                <a href="{{ route('admin.category.create') }}" class="btn btn-primary">新增類別</a>
            </div>
        </div>
        <div class="row">
            <table class="table mt-5">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">類別</th>
                        <th scope="col">操作</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categorys as $category) 
                        <tr>
                            <th class="align-middle" scope="row">{{ $category->id }}</th>
                            <td class="align-middle">{{ $category->title }}</td>
                            <td class="align-middle">
                                <a href="{{ route('admin.category.edit', $category->id) }}" class="btn btn-primary">修改</a>
                                <form method="POST" action="{{ route('admin.category.destroy', $category->id) }}">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-secondary">刪除</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td>No category</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</div>
@endsection