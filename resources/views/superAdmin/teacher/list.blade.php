@extends('layout')
@section('meta-tag')
    Teacher list || {{ auth()->user()->role->name }}
@endsection
{{-- @section('breadcrumb')
    @include('parts.breadcrumb', [
        'page_title' => 'Admin list Page',
        'links' => [
            [
                'title' => 'dashboard',
                'route' => 'superAdmin.teacher.dashboard',
                'enable' => true,
            ],
            [
                'title' => 'Admin List',
                'route' => 'superAdmin.teacher.index',
                'enable' => false,
            ],
        ],
    ])
@endsection --}}
@section('breadcrumb')
    @include('parts.breadcrumb')
@endsection
@section('content')
    @include('parts.title_start', [
        'title' => $title ?? 'Teacher list table',
        'color' => 'card-primary',
    ])
    <div class="card shadow ">
        <div class="card-header">
            <h3 class="card-title"> List</h3>
            <div class="card-tools">
                <form action="{{ route('superAdmin.teacher.index') }}" method="GET">
                    @csrf
                    <div class="input-group input-group-sm">
                        <input type="text" name="search" class="form-control float-right" placeholder="Search">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                            <a href="{{ route('superAdmin.teacher.create') }}"class="btn btn-primary  ml-2">+ Add Teacher</a>
                            <a href="{{ route('superAdmin.teacher.index') }}"class="btn btn-default  ml-2">All Teacher</a>
                            <a
                                href="{{ route('superAdmin.teacher.index', ['status' => 1]) }}"class="btn btn-success mr-2 ml-2">Active
                                Teacher</a>
                            <a href="{{ route('superAdmin.teacher.index', ['status' => 0]) }}"
                                class="btn btn-warning">Deactive
                                Teacher</a>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>image</th>
                    <th>Name</th>
                    <th>Full Name</th>
                    <th>Login Id</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $data)
                        <td width="10%">
                                <img src="{{ asset('users/images/'.$data->user->image) }}" class="img-fluid mx-auto d-block"  alt="Image">
                        </td>
                        <td>{{ $data->user->name }}</td>
                        <td>{{ $data->first_name }} {{ $data->last_name }}</td>
                        <td>{{ $data->user->login_id }}</td>
                        <td>{{ $data->phone }}</td>
                        <td>
                            @if ($data->user->status === 1)
                                <a href="{{ route('superAdmin.teacher.status', $data->user->id) }}" class="btn btn-outline-success">Active</a>
                            @else
                                <a href="{{ route('superAdmin.teacher.status', $data->user->id) }}" class="btn btn-outline-warning">Deactive</a>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('superAdmin.teacher.show', $data->id) }}" class="btn btn-success">View</a>
                            <a href="{{ route('superAdmin.teacher.edit', $data->id) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('superAdmin.teacher.destroy', $data->id) }}" method="POST"
                                class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @if ($datas->isEmpty())
            <h1 class="text-center text-black-50">No Data Found</h1>
        @endif
    </div>
    <!-- /.card-body -->
    <div class="card-footer clearfix">
        <nav aria-label="Page navigation example">
            <div class="pagination">
                {{ $datas->links('pagination::bootstrap-4') }}
            </div>
        </nav>
    </div>
    </div>

    @include('parts.title_end')
@endsection
