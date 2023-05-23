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
        'title' => 'Active Batch',
        'color' => 'card-success',
    ])
    <div class="card shadow ">
        <div class="card-header">
            <h3 class="card-title text-sm">Active Batch List for
                {{ \App\Models\Deparment::find($department_id)->name }}</h3>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive ">
        <table class="table  table-bordered border-top">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Current Semester</th>
                    <th>Total Student</th>
                    <th>Total Semester</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($active_batch as $data)
                    <td>{{ ordinalFormat($data->batch_number) }} batch</td>

                    @if ($data->total_semester === $data->semester)
                        {{-- if semester complete  --}}
                        <td class="bg-warning">{{ ordinalFormat($data->semester) }}</td>
                    @else
                        <td>{{ ordinalFormat($data->semester) }}</td>
                    @endif
                    <td>{{ $data->total_student }}</td>
                    <td>{{ $data->total_semester }}</td>
                    <td class="text-center">
                        {{-- <a href="{{ route('admin.cod.show', $data->id) }}" class="btn btn-sm mt-1 mb-1 btn-success">View Students</a> --}}
                        <a href="{{ route('admin.cod.show', $data->id) }}" class="btn btn-sm mt-1 mb-1 btn-info">
                            <i class="fa fa-info-circle" aria-hidden="true"></i>
                            Batch Info</a>
                        <a href="{{ route('admin.cod.show', $data->id) }}" class="btn btn-sm mt-1 mb-1 btn-success">View
                            Students</a>
                        @if ($data->total_semester === $data->semester){{-- if semester complete  --}}
                        <a href="{{ route('hod.batch.completed', [$department_id,$data->id]) }}" class="btn btn-sm mt-1 mb-1 btn-secondary">Make
                            it complete</a>

                        @else
                        <a  class="btn btn-sm mt-1 mb-1 btn-secondary disabled " >Make
                            it complete</a>
                        @endif
                        {{-- <a href="{{ route('admin.cod.show', $data->id) }}" class="btn btn-sm mt-1 mb-1 btn-success">View</a>
                    <a href="{{ route('admin.cod.show', $data->id) }}" class="btn btn-sm mt-1 mb-1 btn-success">View</a> --}}
                    </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @if ($active_batch->isEmpty())
            <h1 class="text-center text-black-50">No Data Found</h1>
        @endif
    </div>
@endsection
