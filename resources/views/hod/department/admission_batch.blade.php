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
@section('meta-tag')
    Active Batch || {{ auth()->user()->role->name }}
@endsection


@section('content')
@include('parts.hod_batch_options')
    @include('parts.title_start', [
        'title' => 'Admission Open Batch',
        'color' => 'card-info',
    ])
    <div class="card shadow ">
        <div class="card-header">
            <h3 class="card-title text-sm">Admission Open Batch List for
                {{ \App\Models\Deparment::find($department_id)->name }}</h3>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive ">
        <table class="table  table-bordered border-top">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Total Student</th>
                    <th>Total Semester</th>
                    <th>Admission start</th>
                    <th>Admission end</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($admission_batch as $data)
                    <td>{{ ordinalFormat($data->batch_number)}} batch</td>
                    <td>{{ $data->total_student }}</td>
                    <td>{{ $data->batchPaymentInfo->duration_semester }}</td>
                    <td>{{ dateFormat($data->admission_start) }}</td>
                    @if (Carbon\Carbon::parse($data->admission_end)->lessThan(Carbon\Carbon::now()))
                    <td class="bg-danger">{{ dateFormat($data->admission_end) }}</td>
                    @else
                    <td>{{ dateFormat($data->admission_end) }}</td>
                    @endif
                    <td class="text-center">
                        {{-- <a href="{{ route('admin.cod.show', $data->id) }}" class="btn btn-sm mt-1 mb-1 btn-success">View Students</a> --}}
                        <a href="{{ route('admin.cod.show', $data->id) }}" class="btn btn-sm mt-1 mb-1 btn-info">View Students</a>
                        <a href="{{ route('hod.batch.active', [$department_id,$data->id]) }}" class="btn btn-sm mt-1 mb-1 btn-success">Active</a>
                        {{-- <a href="{{ route('admin.cod.show', $data->id) }}" class="btn btn-sm mt-1 mb-1 btn-success"><i class="fa fa-eye" aria-hidden="true"></i> View</a>
                    <a href="{{ route('admin.cod.show', $data->id) }}" class="btn btn-sm mt-1 mb-1 btn-success"><i class="fa fa-eye" aria-hidden="true"></i> View</a> --}}
                    </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @if ($admission_batch->isEmpty())
            <h1 class="text-center text-black-50">No Data Found</h1>
        @endif
    </div>

    @include('parts.title_end')

@endsection