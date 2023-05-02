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
    Edit Admin || {{ auth()->user()->role->name }}
@endsection
@section('breadcrumb')
    @include('parts.breadcrumb')
@endsection

@section('content')
    @include('parts.title_start', [
        'title' => $title ?? 'Admin Edit Form',
        'color' => 'card-warning',
    ])
    <!-- general form elements -->
    <div class="card">
        <form action="{{ route('superAdmin.admin.update', $data->user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body row">
                {{-- role --}}
                <input type="hidden" name="role" value="admin" class="form-control" placeholder="Enter name">
                {{-- name --}}
                <div class="form-group col-12 col-sm-6">
                    <label>name</label>
                    <input type="text" name="name" class="form-control" value="{{ $data->user->name }}"
                        placeholder="Enter name">
                </div>
                {{-- first_name --}}
                <div class="form-group col-12 col-sm-6">
                    <label>first_name</label>
                    <input type="text" name="first_name" class="form-control" value="{{ $data->first_name }}"
                        placeholder="Enter first_name">
                </div>
                {{-- last_name --}}
                <div class="form-group col-12 col-sm-6">
                    <label>last_name</label>
                    <input type="text" name="last_name" class="form-control" value="{{ $data->last_name }}"
                        placeholder="Enter last_name">
                </div>
                {{-- phone --}}
                <div class="form-group col-12 col-sm-6">
                    <label>phone</label>
                    <input type="telephone" name="phone" class="form-control" value="{{ $data->phone }}"
                        placeholder="Enter phone">
                </div>
                {{-- address --}}
                <div class="form-group col-12 col-sm-6">
                    <label>address</label>
                    <input type="text" name="address" class="form-control" value="{{ $data->address }}"
                        placeholder="Enter address">
                </div>
                {{-- password --}}
                <div class="form-group col-12 col-sm-6">
                    <label>password</label>

                    <input type="password" value="" name="password" class="form-control" placeholder="Enter password">
                    <label>give new password if u want to change . other wise don't insert</label>
                </div>
                {{-- email --}}
                <div class="form-group col-12 col-sm-6">
                    <label>email</label>
                    <input type="email" name="email" class="form-control" value="{{ $data->email }}"
                        placeholder="Enter email">
                </div>
                {{-- email --}}
                <div class="form-group col-12 col-sm-6">
                    <label>Status</label>
                    <select name="status" class="form-control select2">
                        @if ($data->user->status === 1)
                            <option value="{{ $data->user->status }}" selected="selected">Active</option>
                            <option value="0" >Deactive</option>
                        @endif
                        @if ($data->user->status === 0)
                            <option value="{{ $data->user->status }}" selected="selected">Deactive</option>
                            <option value="1" >Active</option>
                        @endif
                    </select>
                </div>
                {{-- image --}}
                <div class="form-group col-12 col-sm-6">
                    an image preview will be shown here
                    <img src="cscs" alt="{{ $data->user->image }}">
                    <label>image</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" name="image" class="custom-file-input"
                                accept="image/png, image/jpeg, image/jpg">
                            <label class="custom-file-label">Choose Image</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">
                    Update
                </button>
            </div>
        </form>
    </div>
    <!-- /.card -->

    <!-- general form elements -->
    @include('parts.title_end')
@endsection
