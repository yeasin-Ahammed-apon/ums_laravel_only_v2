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
@section('meta-tag') Create Admin || {{ auth()->user()->role->name }} @endsection
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
        <form action="{{ route('superAdmin.admin.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body row">
                {{-- role --}}
                <input type="hidden" name="role" value="admin" class="form-control"  placeholder="Enter name">
                {{-- name --}}
                <div class="form-group col-12 col-sm-6">
                    <label >name</label>
                    <input type="text" name="name" class="form-control"  placeholder="Enter name">
                </div>
                {{-- first_name --}}
                <div class="form-group col-12 col-sm-6">
                    <label >first_name</label>
                    <input type="text" name="first_name" class="form-control"  placeholder="Enter first_name">
                </div>
                {{-- last_name --}}
                <div class="form-group col-12 col-sm-6">
                    <label >last_name</label>
                    <input type="text" name="last_name" class="form-control"  placeholder="Enter last_name">
                </div>
                {{-- phone --}}
                <div class="form-group col-12 col-sm-6">
                    <label >phone</label>
                    <input type="telephone" name="phone" class="form-control"  placeholder="Enter phone">
                </div>
                {{-- address --}}
                <div class="form-group col-12 col-sm-6">
                    <label >address</label>
                    <input type="text" name="address" class="form-control"  placeholder="Enter address">
                </div>
                {{-- password --}}
                <div class="form-group col-12 col-sm-6">
                    <label >password</label>
                    <input type="password" name="password" class="form-control"  placeholder="Enter password">
                </div>
                {{-- email --}}
                <div class="form-group col-12 col-sm-6">
                    <label >email</label>
                    <input type="email" name="email" class="form-control"  placeholder="Enter email">
                </div>
                {{-- image --}}
                <div class="form-group col-12 col-sm-6">
                        <label >image</label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" name="image" class="custom-file-input" accept="image/png, image/jpeg, image/jpg">
                            <label class="custom-file-label">Choose Image</label>
                          </div>
                        </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn  btn-primary">Submit</button>
            </div>
        </form>
    </div>
    <!-- /.card -->

    <!-- general form elements -->
    @include('parts.title_end')
@endsection
