@extends('layout')
@section('meta-tag')
{{ $title ?? Auth::user()->role->name }}
@endsection
@section('content')
    @include('parts.title_start', [
        'title' => $title ?? 'Temporary Student list table',
        'color' => 'card-primary',
    ])
    <div class="card shadow ">
        <div class="card-header">
            <h3 class="card-title"> List</h3>
            <div class="card-tools">
                <form action="{{ route('admin.account.index') }}" method="GET">
                    @csrf
                    <div class="input-group input-group-sm">
                        @include('parts.card_tool_option_per_page', ['pageData' => $pageData])
                        <input type="text" name="search" class=" mt-1 mb-1 form-control float-right" placeholder="Search">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-sm mt-1 mb-1 btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                            <a href="{{ route('admin.account.create') }}"class="btn btn-sm mt-1 mb-1 btn-primary  ml-2"><i
                                    class="fa fa-plus" aria-hidden="true"></i> Add Student</a>
                            <a
                                href="{{ route('admin.account.index', ['status' => 1]) }}"class="btn btn-sm mt-1 mb-1 btn-success mr-2 ml-2">Not
                                Complete
                                Admins</a>
                            <a href="{{ route('admin.account.index', ['status' => 0]) }}"
                                class="btn btn-sm mt-1 mb-1 btn-warning">Complete
                                Admins</a>
                            <a type="button" class="btn btn-sm mt-1 mb-1 ml-1 btn-info" data-toggle="modal"
                                data-target="#modal-default">
                                <i class="fas fa-info-circle"></i>
                            </a>
                            @include('parts.info', [
                                'datas' => [
                                    [
                                        'info' => 'Active button red means , Admission closed',
                                        'color' => 'bg-danger',
                                    ],
                                    [
                                        'info' =>
                                            'Admission End field red means, Admission time end long time a go.',
                                        'color' => 'bg-danger',
                                    ],
                                ],
                            ])
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
                <tr class="text-sm">
                    <th>Name</th>
                    <th>Id</th>
                    <th>Admission End</th>
                    <th>Batch</th>
                    <th>Fee</th>
                    <th>Fee Given</th>
                    <th>Status</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $data)
                    <td class="text-sm">{{ $data->name }}</td>
                    <td class="text-sm">{{ $data->temporary_id }}</td>
                    @if (Carbon\Carbon::parse($data->batch->admission_end)->lessThan(Carbon\Carbon::now()))
                        <td class="bg-danger text-sm">{{ dateFormat($data->batch->admission_end) }}</td>
                    @else
                        <td class="text-sm">{{ dateFormat($data->batch->admission_end) }}</td>
                    @endif
                    <td class="text-sm">{{ $data->batch->department->name }}
                        {{ ordinalFormat($data->batch->batch_number) }}</td>
                    <td class="text-sm text-bold">{{ number_format($data->admission_fee, 2) }} tk.</td>
                    <td class="text-sm">{{ number_format($data->admission_fee_given, 3) }} tk.</td>
                    <td>
                        {{-- if admission not close --}}
                        @if (!$data->batch->admission_close)
                        {{-- if all fee given --}}
                            @if ($data->admission_fee_given >= $data->admission_fee)
                                <a href="{{ route('admission.student.create', $data->id) }}" onclick="disableButton(this)"
                                    class="btn btn-sm mt-1 mb-1 btn-outline-success "><i class="fa fa-circle"
                                        aria-hidden="true"></i> Active</a>
                            @else
                                <a onclick="disableButton(this)"
                                    class="btn btn-sm mt-1 mb-1 btn-outline-success disabled "><i class="fa fa-circle"
                                        aria-hidden="true"></i> Active</a>
                            @endif
                        @else
                            <a onclick="disableButton(this)" class="btn btn-sm mt-1 mb-1 btn-danger disabled"><i
                                    class="fa fa-circle" aria-hidden="true"></i> Active</a>
                        @endif
                    </td>
                    <td class="text-center">
                        {{-- view --}}
                        <a href="{{ route('admission.temporaryStudent.show', $data->id) }}"
                            class="btn btn-sm mt-1 mb-1 btn-success"><i class="fa fa-eye" aria-hidden="true"></i></a>
                        {{-- edit --}}
                        <a href="{{ route('admin.account.edit', $data->id) }}" class="btn btn-sm mt-1 mb-1 btn-primary"><i
                                class="fa fa-cogs" aria-hidden="true"></i>
                        </a>
                        {{-- delete --}}
                        <a href="{{ route('admin.account.edit', $data->id) }}" class="btn btn-sm mt-1 mb-1 btn-danger"><i
                                class="fas fa-trash"></i>
                        </a>
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
