@extends('layout')
@section('meta-tag')
{{ $title ?? Auth::user()->role->name }}
@endsection
@section('content')
    @include('parts.title_start', [
        'title' => $title ?? 'Department list table',
        'color' => 'card-primary',
    ])
    <div class="card shadow ">
        <div class="card-header">
            <h3 class="card-title"> List</h3>
            <div class="card-tools">
                <form action="{{ route('department.index') }}" method="GET">
                    @csrf
                    <div class="input-group input-group-sm">
                        @include('parts.card_tool_option_per_page', ['pageData' => $pageData])
                        <input type="text" name="search" class=" mt-1 mb-1 form-control float-right" placeholder="Search">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-sm mt-1 mb-1 btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                            <a href="{{ route('department.create') }}"class="btn btn-sm mt-1 mb-1 btn-primary  ml-2">+ Add Department</a>
                            <a href="{{ route('department.index') }}"class="btn btn-sm mt-1 mb-1 btn-default  ml-2">All Department</a>
                            <a
                                href="{{ route('department.index', ['status' => 1]) }}"class="btn btn-sm mt-1 mb-1 btn-success mr-2 ml-2">Active
                                Department</a>
                            <a href="{{ route('department.index', ['status' => 0]) }}"
                                class="btn btn-sm mt-1 mb-1 btn-warning">Deactive
                                Department</a>
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
                    <th>program</th>
                    <th>faculty</th>
                    <th>Status</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $data)

                        <td class="text-sm">{{ $data->name }}</td>
                        <td class="text-sm">{{ $data->faculty->name }}</td>
                        <td class="text-sm">{{ $data->program->name }}</td>
                        <td>
                            @if ($data->status === 1)
                                <a href="{{ route('department.status', $data->id) }}" onclick="disableButton(this)" class="btn btn-sm mt-1 mb-1 btn-outline-success"><i class="fa fa-circle" aria-hidden="true"></i>  Active</a>
                            @else
                                <a href="{{ route('department.status', $data->id) }}" onclick="disableButton(this)" class="btn btn-sm mt-1 mb-1 btn-outline-secondary"><i class="fa fa-circle" aria-hidden="true"></i> Deactive</a>
                            @endif
                        </td>
                        <td class="text-center">
                            {{-- <a href="{{ route('department.show', $data->id) }}" class="btn btn-sm mt-1 mb-1 btn-success"><i class="fa fa-eye" aria-hidden="true"></i> View</a> --}}
                            <a href="{{ route('department.show', $data->id) }}" class="btn btn-sm mt-1 mb-1 btn-info edit">
                                <i class="fa fa-info-circle" aria-hidden="true"></i>
                                Info</a>
                            <a href="{{ route('department.edit', $data->id) }}" class="btn btn-sm mt-1 mb-1 btn-primary edit"
                                >
                                <i class="fa fa-cog" aria-hidden="true"></i>
                                Edit</a>
                                <a href="{{ route('department.waiver.edit', $data->departmentWaiver->id) }}" class="btn btn-sm mt-1 mb-1 btn-primary edit"
                                    >
                                    <i class="fa fa-cog" aria-hidden="true"></i>
                                    Waiver</a>
                            <form action="{{ route('department.destroy', $data->id) }}" method="POST"
                                class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm mt-1 mb-1 btn-danger delete"
                                onclick="disableButton(this)"
                                >
                                <i class="fa fa-trash" aria-hidden="true"></i>
                                Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @if ($datas->isEmpty())
            <h1 class="text-center">No Data Found</h1>
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
    @include('parts.page_number_set_js', ['page_number_url' => Route::currentRouteName()])
@endsection
