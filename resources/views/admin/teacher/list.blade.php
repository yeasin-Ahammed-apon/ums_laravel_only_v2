@extends('layout')
@section('meta-tag')
    Teacher list
@endsection
{{-- @section('breadcrumb')
    @include('parts.breadcrumb', [
        'page_title' => 'Admin list Page',
        'links' => [
            [
                'title' => 'dashboard',
                'route' => 'admin.teacher.dashboard',
                'enable' => true,
            ],
            [
                'title' => 'Admin List',
                'route' => 'admin.teacher.index',
                'enable' => false,
            ],
        ],
    ])
@endsection --}}

@section('content')
    @include('parts.title_start', [
        'title' => $title ?? 'Teacher list table',
        'color' => 'card-primary',
    ])
    <div class="card shadow ">
        <div class="card-header">
            <h3 class="card-title"> List</h3>
            <div class="card-tools">
                <form action="{{ route('admin.teacher.index') }}" method="GET">
                    @csrf
                    <div class="input-group input-group-sm">
                        @include('parts.card_tool_option_per_page', ['pageData' => $pageData])
                        <input type="text" name="search" class=" mt-1 mb-1 form-control float-right" placeholder="Search">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-sm mt-1 mb-1 btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                            <a href="{{ route('admin.teacher.create') }}"class="btn btn-sm mt-1 mb-1 btn-primary  ml-2"><i class="fa fa-plus" aria-hidden="true"></i> Add Teacher</a>
                            <a href="{{ route('admin.teacher.index') }}"class="btn btn-sm mt-1 mb-1 btn-default  ml-2">All Teacher</a>
                            <a
                                href="{{ route('admin.teacher.index', ['status' => 1]) }}"class="btn btn-sm mt-1 mb-1 btn-success mr-2 ml-2">Active
                                Teacher</a>
                            <a href="{{ route('admin.teacher.index', ['status' => 0]) }}"
                                class="btn btn-sm mt-1 mb-1 btn-warning">Deactive
                                Teacher</a>
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
                    <th>Access</th>
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
                            @if ($data->hod)<span class="text-success">Hod</span>@endif
                            @if ($data->cod)<span class="text-success">Cod</span>@endif
                            @if (!$data->cod&& !$data->hod)
                                <span class="text-secondary">
                                    No Access
                                </span>
                            @endif

                        </td>
                        <td>
                            @if ($data->user->status === 1)
                                <a href="{{ route('admin.teacher.status', $data->user->id) }}" class="btn btn-sm mt-1 mb-1 btn-outline-success"><i class="fa fa-circle" aria-hidden="true"></i>  Active</a>
                            @else
                                <a href="{{ route('admin.teacher.status', $data->user->id) }}" class="btn btn-sm mt-1 mb-1 btn-outline-secondary"><i class="fa fa-circle" aria-hidden="true"></i> Deactive</a>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.teacher.show', $data->id) }}" class="btn btn-sm mt-1 mb-1 btn-success"><i class="fa fa-eye" aria-hidden="true"></i> View</a>
                            <a href="{{ route('admin.teacher.edit', $data->id) }}" class="btn btn-sm mt-1 mb-1 btn-primary"><i class="fa fa-cogs" aria-hidden="true"></i> Edit</a>
                            <form action="{{ route('admin.teacher.destroy', $data->id) }}" method="POST"
                                class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm mt-1 mb-1 btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
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
    @include('parts.page_number_set_js', ['page_number_url' => 'admin.teacher.index'])
@endsection
