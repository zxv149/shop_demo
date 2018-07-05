@extends('backend.layouts.dashboard')
@section('page', 'Users')
@section('content')
<div class="container">
    <section class="page-section my-5 p-5">
        <div class="row">
        </div>
        <div class="row">
            <table class="table mt-5">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">姓名</th>
                        <th scope="col">信箱</th>
                        <th scope="col">操作</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <th class="align-middle" scope="row">{{ $user->id }}</th>
                            <td class="align-middle">{{ $user->name }}</td>
                            <td class="align-middle">{{ $user->email }}</td>
                            <td class="align-middle">
                                <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-primary">修改</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td>No user</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</div>
@endsection