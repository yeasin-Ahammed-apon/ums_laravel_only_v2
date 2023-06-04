@extends('layout')
{{-- @section('breadcrumb')
    @include('parts.breadcrumb', [
        'page_title' => 'Admin list Page',
        'links' => [
            [
                'title' => 'dashboard',
                'route' => 'admin.account.dashboard',
                'enable' => true,
            ],
            [
                'title' => 'Admin List',
                'route' => 'admin.account.index',
                'enable' => false,
            ],
        ],
    ])
@endsection --}}
@section('meta-tag')
    Edit Admin
@endsection


@section('content')
    @include('parts.title_start', [
        'title' => $title ?? 'Admin Edit Form',
        'color' => 'card-warning',
    ])
    <!-- general form elements -->
    <div class="card">
        <form action="{{ route('hod.department.assign.update', $data->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body row">
                {{-- hod_id --}}
                <div class="form-group col-12 col-sm-6">
                    <label>Hod</label>
                    <select name="hod_id" class="form-control @error('hod_id') is-invalid @enderror">
                        @foreach (\App\Models\Hod::all() as $hod)
                            <option value="{{ $hod->id }}" {{ $hod->id === $data->hod_id ? 'selected' : '' }}>
                                {{ $hod->user->name }} ({{ $hod->user->login_id }})</option>
                        @endforeach
                    </select>
                    {!! validationError('hod_id', $errors) !!}
                </div>
                {{-- department_id --}}
                <div class="form-group col-12 col-sm-6">
                    <label>Department</label>
                    <select name="department_id" class="form-control @error('department_id') is-invalid @enderror">
                        @foreach (\App\Models\Deparment::all() as $department)
                            <option value="{{ $department->id }}"
                                {{ $department->id === $data->department_id ? 'selected' : '' }}>{{ $department->name }}
                            </option>
                        @endforeach
                    </select>
                    {!! validationError('department_id', $errors) !!}
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-sm mt-1 mb-1 btn-primary" onclick="disableButton(this)">Update</button>
            </div>
        </form>
    </div>
    <!-- /.card -->
    <!-- general form elements -->
    @include('parts.title_end')
@endsection
