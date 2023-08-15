@extends('layout')
@section('meta-tag')
{{ $title ?? Auth::user()->role->name }}
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
                <form action="{{ route('department.index') }}" method="GET">
                    @csrf
                    <div class="input-group input-group-sm">
                        @include('parts.card_tool_option_per_page', ['pageData' => $pageData])
                        {{-- <input type="text" name="search" class=" mt-1 mb-1 form-control float-right" placeholder="Search"> --}}
                        <div class="input-group-append">
                            {{-- <button type="submit" class="btn btn-sm mt-1 mb-1 btn-default">
                                <i class="fas fa-search"></i>
                            </button> --}}
                            {{-- <a href="{{ route('department.create') }}"class="btn btn-sm mt-1 mb-1 btn-primary  ml-2">+ Add
                                Admins</a>
                            <a href="{{ route('department.index') }}"class="btn btn-sm mt-1 mb-1 btn-default  ml-2">All
                                Admins</a>
                            <a
                                href="{{ route('department.index', ['status' => 1]) }}"class="btn btn-sm mt-1 mb-1 btn-success mr-2 ml-2">Active
                                Admins</a>
                            <a href="{{ route('department.index', ['status' => 0]) }}"
                                class="btn btn-sm mt-1 mb-1 btn-warning">Deactive
                                Admins</a> --}}
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
                <tr class=" text-sm">
                    <th>Id</th>
                    <th>Name</th>
                    <th>Temporary id</th>
                    <th>Status</th>
                    <th class="text-center text-xs">Education</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($datas as $data)
                    <td class="text-sm text-bolder">{{ $data->login_id }}</td>
                    <td class="text-sm text-bolder">{{ $data->name }}</td>
                    <td class="text-sm text-bolder">{{ $data->student->temporary_id }}</td>
                    <td class="text-center">
                        @if ($data->status)
                            <span class="btn btn-sm mt-1 mb-1 btn-success">
                                <i class="fas fa-eye    "></i>
                            </span>
                        @else
                        <span class="btn btn-sm mt-1 mb-1 btn-danger">
                            <i class="fas fa-eye-slash"></i>
                        </span>
                        @endif
                    </td>
                    <td>
                        @if ($data->education)
                        <a href="{{ route('admission.student.education_create', $data->id) }}" class="btn btn-sm mt-1 mb-1 btn-secondary" >
                            <i class="fas fa-plus    "></i>
                        </a>
                        @else
                        <a href="{{ route('admission.student.education_create', $data->id) }}" class="btn btn-sm mt-1 mb-1 btn-info">
                            <i class="fas fa-plus    "></i>
                        </a>
                        @endif
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
