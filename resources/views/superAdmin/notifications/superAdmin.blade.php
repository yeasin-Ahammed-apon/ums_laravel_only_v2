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
                'route' => 'superAdmin.hod.dashboard',
                'enable' => true,
            ],
            [
                'title' => 'Admin List',
                'route' => 'superAdmin.hod.index',
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
                <form action="{{ route('superAdmin.hod.index') }}" method="GET">
                    @csrf
                    <div class="input-group input-group-sm">
                        <input type="text" name="search" class="form-control float-right" placeholder="Search">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                            <a href="{{ route('superAdmin.hod.create') }}"class="btn btn-primary  ml-2">+ Add Hod</a>
                            <a href="{{ route('superAdmin.hod.index') }}"class="btn btn-default  ml-2">All Hod</a>
                            <a
                                href="{{ route('superAdmin.hod.index', ['status' => 1]) }}"class="btn btn-success mr-2 ml-2">Active
                                Hod</a>
                            <a href="{{ route('superAdmin.hod.index', ['status' => 0]) }}"
                                class="btn btn-warning">Deactive
                                Hod</a>
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
                    <th>By </th>
                    <th>Action</th>
                    <th>Description</th>
                    <th>Seen</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $data)
                        <td>{{ $data->user_id }}</td>
                        <td>{{ $data->action }}</td>
                        <td>{{ $data->description }}</td>
                        <td>
                            @if ($data->seen)
                                Read
                            @else
                                Unread
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('superAdmin.hod.edit', $data->id) }}" class="btn btn-primary">Edit</a>
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
