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
    @include('parts.title_start', [
        'title' => 'Active Batch',
        'color' => 'card-warning',
    ])
    <div class="card shadow ">
        <div class="card-header">
            <h3 class="card-title">Active Batch List</h3>
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
                    <td>{{ $data->department->name }}</td>
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
