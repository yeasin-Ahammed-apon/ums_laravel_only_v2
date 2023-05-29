@extends('layout')
@section('meta-tag')
    Admission open batch list || {{ auth()->user()->role->name }}
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
                    <th>Name</th>
                    <th>Batch</th>
                    <th class="text-xs">Admit</th>
                    <th class="text-xs">Semester</th>
                    <th>Start</th>
                    <th>End</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($datas as $data)
                    <td class="text-sm text-bolder">{{ $data->department->name }}</td>
                    <td>{{ ordinalFormat($data->batch_number) }}</td>
                    <td>{{ $data->total_student }}</td>
                    <td>{{ $data->total_semester }}</td>
                    <td>{{ $data->admission_start }}</td>
                    <td>{{ $data->admission_end }}</td>
                    <td>
                        <a href="{{ route('admission.batch.info', $data->id) }}" class="btn btn-sm mt-1 mb-1 btn-info">
                            <i class="fa fa-info-circle" aria-hidden="true"></i> Batch Info</a>
                        <a href="{{ route('admission.batch.temporary.add.student', $data->id) }}"
                            class="btn btn-sm mt-1 mb-1 btn-primary">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add</a>
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
    @include('parts.page_number_set_js', ['page_number_url' => 'admission.batch.open.list'])
@endsection
