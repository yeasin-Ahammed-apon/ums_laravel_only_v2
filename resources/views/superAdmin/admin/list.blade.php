@extends('layout')
{{-- @section('breadcrumb')
    @include('parts.breadcrumb', [
        'page_title' => 'Admin list Page',
        'links' => [
            [
                'title' => 'dashboard',
                'route' => 'superAdmin.admin.dashboard',
                'enable' => true,
            ],
            [
                'title' => 'Admin List',
                'route' => 'superAdmin.admin.index',
                'enable' => false,
            ],
        ],
    ])
@endsection --}}
@section('breadcrumb')
    @include('parts.breadcrumb')
@endsection
@section('content')
    @include('parts.title_start', ['title' => $title ?? 'Admin list table'])

    <div class="card shadow ">
        <div class="card-header">
            <h3 class="card-title"> List</h3>
            <div class="card-tools">
                <form action="{{ route('superAdmin.admin.index') }}" method="GET">
                    @csrf
                    <div class="input-group input-group-sm">
                        <input type="text" name="search" class="form-control float-right" placeholder="Search">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                            <a href="{{ route('superAdmin.admin.index') }}"class="btn btn-primary  ml-2">All Admins</a>
                            <a
                                href="{{ route('superAdmin.admin.index', ['status' => 1]) }}"class="btn btn-success mr-2 ml-2">Active
                                Admins</a>
                            <a href="{{ route('superAdmin.admin.index', ['status' => 0]) }}"
                                class="btn btn-warning">Deactive
                                Admins</a>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Login Id</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $data)
                    <tr>
                        <td>{{ $data->first_name }} {{ $data->last_name }}</td>
                        <td>{{ $data->user->login_id }}</td>
                        <td>{{ $data->phone }}</td>
                        <td>
                            @if ($data->user->status === 1)
                                Active
                            @else
                                Deactive
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('superAdmin.admin.edit', $data->id) }}" class="btn btn-primary">Edit</a>
                            <a href="{{ route('superAdmin.admin.destroy', $data->id) }}" class="btn btn-danger">Delete</a>
                            <a href="{{ route('superAdmin.admin.show', $data->id) }}" class="btn btn-success">View</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @if ($datas->isEmpty())<h1 class="text-center text-black-50">No Data Found</h1>@endif
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
