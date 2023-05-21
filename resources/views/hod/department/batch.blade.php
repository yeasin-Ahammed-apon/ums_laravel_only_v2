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
@section('breadcrumb')
    @include('parts.breadcrumb')
@endsection

@section('content')
<div class="mt-5 mb-5 card p-2">
    <div>
        <a href="{{ route('hod.batch.create',$department_id) }}" class="btn btn-primary">
            <i class="fa fa-plus" aria-hidden="true"></i>
            create
        </a>
    </div>
</div>
    @include('parts.title_start', [
        'title' => 'Active Batch',
        'color' => 'card-warning',
    ])
    <div class="card shadow ">
        <div class="card-header">
            <h3 class="card-title">Active Batch List for {{ \App\Models\Deparment::find($department_id)->name }}</h3>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive ">
        <table class="table  table-bordered border-top">
            <thead>
                <tr>
                    <th>Name</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $data)
                    <td>{{ $data->batch_number }} batch</td>
                    <td class="text-center">
                        <a href="{{ route('admin.cod.show', $data->id) }}" class="btn btn-success">View</a>
                        {{-- <a href="{{ route('admin.cod.show', $data->id) }}" class="btn btn-success">View</a>
                        <a href="{{ route('admin.cod.show', $data->id) }}" class="btn btn-success">View</a> --}}
                    </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @if ($datas->isEmpty())
            <h1 class="text-center text-black-50">No Data Found</h1>
        @endif
    </div>
    </div>

    @include('parts.title_end')
@endsection
