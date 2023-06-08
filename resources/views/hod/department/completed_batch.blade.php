@extends('layout')
@section('meta-tag')
    Completed Batch List
@endsection
@section('content')
@include('parts.hod_batch_options')
    @include('parts.title_start', [
        'title' => 'completed Batch',
        'color' => 'card-secondary',
    ])
    <div class="card shadow ">
        <div class="card-header">
            <h3 class="card-title text-sm">completed Batch List for
                {{ \App\Models\Deparment::find($department_id)->name }}</h3>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive ">
        <table class="table  table-bordered border-top">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Admission start</th>
                    <th>Admission end</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($completed_batch as $data)
                <tr>
                    <td >{{ $data->batch_number }} batch</td>
                    <td>{{ dateFormat($data->admission_start) }}</td>
                    <td>{{ dateFormat($data->admission_end) }}</td>
                    <td class="text-center">
                        {{-- <a href="{{ route('admin.cod.show', $data->id) }}" class="btn btn-sm mt-1 mb-1 btn-success">View Students</a> --}}
                        <a href="{{ route('admin.cod.show', $data->id) }}" class="btn btn-sm mt-1 mb-1 btn-success"><i class="fas fa-eye    "></i> Students</a>
                        {{-- <a href="{{ route('admin.cod.show', $data->id) }}" class="btn btn-sm mt-1 mb-1 btn-success"><i class="fa fa-eye" aria-hidden="true"></i> View</a>
                    <a href="{{ route('admin.cod.show', $data->id) }}" class="btn btn-sm mt-1 mb-1 btn-success"><i class="fa fa-eye" aria-hidden="true"></i> View</a> --}}
                    </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @if ($completed_batch->isEmpty())
            <h1 class="text-center">No Data Found</h1>
        @endif
    </div>

    @include('parts.title_end')

@endsection
