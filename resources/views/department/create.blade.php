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
    Create Admin || {{ auth()->user()->role->name }}
@endsection
@section('breadcrumb')
    @include('parts.breadcrumb')
@endsection

@section('content')
    @include('parts.title_start', [
        'title' => $title ?? 'Admin Create Form',
        'color' => 'card-primary',
    ])
    <!-- general form elements -->
    <div class="card">
        <form action="{{ route('department.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body row">
                {{-- name --}}
                <div class="form-group col-12 col-sm-6">
                    <label>name</label>
                    <input type="text" value="{{ old('name') }}" name="name"
                        class="form-control @error('name') is-invalid @enderror" placeholder="Enter name">
                    {!! validationError('name', $errors) !!}
                </div>
                {{-- faculty_id --}}
                <div class="form-group col-12 col-sm-6">
                    <label>Faculty</label>
                    <select name="faculty_id" class="form-control @error('faculty_id') is-invalid @enderror">
                        @foreach (\App\Models\Faculty::all() as $faculty)
                            <option value="{{ $faculty->id }}">{{ $faculty->name }}</option>
                        @endforeach
                    </select>
                    {!! validationError('faculty_id', $errors) !!}
                </div>
                {{-- program_id --}}
                <div class="form-group col-12 col-sm-6">
                    <label>Program</label>
                    <select name="program_id" class="form-control @error('program_id') is-invalid @enderror">
                        @foreach (\App\Models\Program::all() as $program)
                            <option value="{{ $program->id }}">{{ $program->name }}</option>
                        @endforeach
                    </select>
                    {!! validationError('program_id', $errors) !!}
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary" onclick="disableButton(this)">Create</button>
            </div>
        </form>
    </div>

    <!-- /.card -->
    <!-- general form elements -->
    @include('parts.title_end')
@endsection
