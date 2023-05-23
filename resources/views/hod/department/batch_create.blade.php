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
    Batch Create || {{ auth()->user()->role->name }}
@endsection


@section('content')
@include('parts.hod_batch_options')
    @include('parts.title_start', [
        'title' => $title ?? 'Admin Edit Form',
        'color' => 'card-primary',
    ])
    <div class="card">
        <form action="{{ route('hod.batch.store',$department_id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body row">
                {{-- department_id --}}
                <div class="form-group col-12">
                    <label>deparment</label>
                    <select name="department_id" class="form-control @error('department_id') is-invalid @enderror">
                        @foreach (\App\Models\HodDepartmentAssign::where('hod_id', auth()->user()->hod->id)->get() as $deparment)
                            <option value="{{ $deparment->department->id }}">{{ $deparment->department->name }}</option>
                        @endforeach
                    </select>
                    {!! validationError('department_id', $errors) !!}
                </div>

                {{-- admission_start --}}
                <div class="form-group col-12 col-sm-6">
                    <label>Admission Start</label>
                    <input type="date" name="admission_start"
                        class="form-control @error('admission_start') is-invalid @enderror">
                    {!! validationError('admission_start', $errors) !!}
                </div>
                {{-- admission_end --}}
                <div class="form-group col-12 col-sm-6">
                    <label>Admission End</label>
                    <input type="date" name="admission_end"
                        class="form-control @error('admission_end') is-invalid @enderror">
                    {!! validationError('admission_end', $errors) !!}
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-sm mt-1 mb-1  btn-primary" onclick="disableButton(this)">create</button>
            </div>
        </form>
    </div>

    @include('parts.title_end')
@endsection
