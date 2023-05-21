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
                'route' => 'hod.department.assign.dashboard',
                'enable' => true,
            ],
            [
                'title' => 'Admin List',
                'route' => 'hod.department.assign.index',
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
                <form action="{{ route('hod.department.assign.index') }}" method="GET">
                    @csrf
                    <div class="input-group input-group-sm">
                        @include('parts.card_tool_option_per_page', ['pageData' => $pageData])
                        <input type="text" name="search" class="form-control float-right" placeholder="Search">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                            <a href="{{ route('hod.department.assign.create') }}"class="btn btn-primary  ml-2">+ Add Admins</a>
                            <a href="{{ route('hod.department.assign.index') }}"class="btn btn-default  ml-2">All Admins</a>
                            <a
                                href="{{ route('hod.department.assign.index', ['status' => 1]) }}"class="btn btn-success mr-2 ml-2">Active
                                Admins</a>
                            <a href="{{ route('hod.department.assign.index', ['status' => 0]) }}"
                                class="btn btn-warning">Deactive
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

                    <th>Name</th>
                    <th>Hod</th>
                    <th>Department</th>
                    <th>Status</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $data)

                        <td>{{ $data->hod->user->name }}</td>
                        <td>{{ $data->hod->user->login_id }}</td>
                        <td>{{ $data->department->name }}</td>
                        <td>
                            @if ($data->status === 1)
                                <a href="{{ route('hod.department.assign.status', $data->id) }}" onclick="disableButton(this)" class="btn btn-outline-success">Active</a>
                            @else
                                <a href="{{ route('hod.department.assign.status', $data->id) }}" onclick="disableButton(this)" class="btn btn-outline-warning">Deactive</a>
                            @endif
                        </td>
                        <td class="text-center">
                            {{-- <a href="{{ route('hod.department.assign.show', $data->id) }}" class="btn btn-success">View</a> --}}
                            <a href="{{ route('hod.department.assign.edit', $data->id) }}" class="btn btn-primary edit"
                                >Edit</a>
                            <form action="{{ route('hod.department.assign.destroy', $data->id) }}" method="POST"
                                class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger delete"
                                onclick="disableButton(this)"
                                >Delete</button>
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
    @include('parts.page_number_set_js', ['page_number_url' => 'hod.department.assign.index'])
@endsection