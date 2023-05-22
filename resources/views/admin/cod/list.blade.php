@extends('layout')
@section('meta-tag')
    Admin list || {{ auth()->user()->role->name }}
@endsection
{{-- @section('breadcrumb')
    @include('parts.breadcrumb', [
        'page_title' => 'Admin list Page',
        'links' => [
            [
                'title' => 'dashboard',
                'route' => 'admin.cod.dashboard',
                'enable' => true,
            ],
            [
                'title' => 'Admin List',
                'route' => 'admin.cod.index',
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
        'title' => $title ?? 'Admin list table',
        'color' => 'card-primary',
    ])
    <div class="card shadow ">
        <div class="card-header">
            <h3 class="card-title"> List</h3>
            <div class="card-tools">
                <form action="{{ route('admin.cod.index') }}" method="GET">
                    @csrf
                    <div class="input-group input-group-sm">
                        @include('parts.card_tool_option_per_page', ['pageData' => $pageData])
                        <input type="text" name="search" class="form-control float-right" placeholder="Search">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-sm mt-1 mb-1 btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                            <a href="{{ route('admin.cod.create') }}"class="btn btn-sm mt-1 mb-1 btn-primary  ml-2">+ Add Admins</a>
                            <a href="{{ route('admin.cod.index') }}"class="btn btn-sm mt-1 mb-1 btn-default  ml-2">All Admins</a>
                            <a href="{{ route('admin.cod.index', ['status' => 1]) }}"class="btn btn-sm mt-1 mb-1 btn-success mr-2 ml-2">Active
                                Admins</a>
                            <a href="{{ route('admin.cod.index', ['status' => 0]) }}" class="btn btn-sm mt-1 mb-1 btn-warning">Deactive
                                Admins</a>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive ">
        <table class="table  table-bordered border-top">
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
                        <img src="{{ asset('users/images/' . $data->user->image) }}" class="img-fluid mx-auto d-block"
                            alt="Image">
                    </td>
                    <td>{{ $data->user->name }}</td>
                    <td>{{ $data->first_name }} {{ $data->last_name }}</td>
                    <td>{{ $data->user->login_id }}</td>
                    <td>{{ $data->phone }}</td>
                    <td>
                        @if ($data->user->status === 1)
                            <a href="{{ route('admin.cod.status', $data->user->id) }}" onclick="disableButton(this)"
                                class="btn btn-sm mt-1 mb-1 btn-outline-success">Active</a>
                        @else
                            <a href="{{ route('admin.cod.status', $data->user->id) }}" onclick="disableButton(this)"
                                class="btn btn-sm mt-1 mb-1 btn-outline-warning">Deactive</a>
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{{ route('admin.cod.show', $data->id) }}" class="btn btn-sm mt-1 mb-1 btn-success">View</a>
                        <a href="{{ route('admin.cod.edit', $data->id) }}" class="btn btn-sm mt-1 mb-1 btn-primary">Edit</a>
                        <form action="{{ route('admin.cod.destroy', $data->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm mt-1 mb-1 btn-danger" onclick="disableButton(this)">Delete</button>
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
@section('scripts')
    @include('parts.page_number_set_js', ['page_number_url' => 'admin.cod.index'])
@endsection
