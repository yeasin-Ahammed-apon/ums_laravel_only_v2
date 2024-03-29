@extends('layout')
{{-- @section('breadcrumb')
    @include('parts.breadcrumb', [
        'page_title' => 'Admin list Page',
        'links' => [
            [
                'title' => 'dashboard',
                'route' => 'superAdmin.account.dashboard',
                'enable' => true,
            ],
            [
                'title' => 'Admin List',
                'route' => 'superAdmin.account.index',
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
        <form action="{{ route('faculty.update', $data->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body row">
                {{-- role --}}
                <input type="hidden" name="role" value="account" class="form-control" placeholder="Enter name">
                {{-- name --}}
                <div class="form-group col-12 col-sm-6">
                    <label>name</label>
                    <input type="text" value="{{ $data->name }}" name="name"
                        class="form-control @error('name') is-invalid @enderror" placeholder="Enter name">
                    {!! validationError('name', $errors) !!}
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-sm mt-1 mb-1 btn-primary"
                onclick="disableButton(this)"
                >
                    Update
                </button>
            </div>
        </form>
    </div>
    <!-- /.card -->
    <!-- general form elements -->
    @include('parts.title_end')
@endsection
