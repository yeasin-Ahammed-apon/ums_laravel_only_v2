@extends('layout')
{{-- @section('breadcrumb')
    @include('parts.breadcrumb', [
        'page_title' => 'Admin list Page',
        'links' => [
            [
                'title' => 'dashboard',
                'route' => 'superAdmin.hod.dashboard',
                'enable' => true,
            ],
            [
                'title' => 'Admin List',
                'route' => 'superAdmin.hod.index',
                'enable' => false,
            ],
        ],
    ])
@endsection --}}
@section('meta-tag')
    Edit Admin || {{ auth()->user()->role->name }}
@endsection


@section('content')
    @include('parts.title_start', [
        'title' => $title ?? 'Admin Edit Form',
        'color' => 'card-warning',
    ])
    <!-- general form elements -->
    <div class="card">
        <form action="{{ route('superAdmin.hod.update', $data->user_id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body row">
                {{-- role --}}
                <input type="hidden" name="role" value="hod" class="form-control" placeholder="Enter name">
                {{-- name --}}
                <div class="form-group col-12 col-sm-6">
                    <label>name</label>
                    <input type="text" value="{{ $data->user->name }}" name="name"
                        class="form-control @error('name') is-invalid @enderror" placeholder="Enter name">
                    {!! validationError('name', $errors) !!}
                </div>
                {{-- first_name --}}
                <div class="form-group col-12 col-sm-6">
                    <label>first_name</label>
                    <input type="text" value="{{ $data->first_name }}" name="first_name"
                        class="form-control @error('first_name') is-invalid @enderror" placeholder="Enter first_name">
                    {!! validationError('first_name', $errors) !!}
                </div>
                {{-- last_name --}}
                <div class="form-group col-12 col-sm-6">
                    <label>last_name</label>
                    <input type="text" value="{{ $data->last_name }}" name="last_name"
                        class="form-control @error('last_name') is-invalid @enderror" placeholder="Enter last_name">
                    {!! validationError('last_name', $errors) !!}
                </div>
                {{-- gender_id --}}
                <div class="form-group col-12 col-sm-6">
                    <label>gender</label>
                    <select name="gender_id" class="form-control @error('gender_id') is-invalid @enderror">
                        @foreach (\App\Models\Gender::all() as $gender)
                            <option value="{{ $gender->id }}" {{ $data->gender_id == $gender->id ? 'selected' : '' }}>
                                {{ $gender->name }}</option>
                        @endforeach
                    </select>
                    {!! validationError('gender_id', $errors) !!}
                </div>
                {{-- phone --}}
                <div class="form-group col-12 col-sm-6">
                    <label>phone</label>
                    <input type="telephone" value="{{ $data->phone }}" name="phone"
                        class="form-control @error('phone') is-invalid @enderror" placeholder="Enter phone">
                    {!! validationError('telephone', $errors) !!}
                </div>
                {{-- address --}}
                <div class="form-group col-12 col-sm-6">
                    <label>address</label>
                    <input type="text" value="{{ $data->address }}" name="address"
                        class="form-control @error('address') is-invalid @enderror" placeholder="Enter address">
                    {!! validationError('address', $errors) !!}
                </div>
                {{-- email --}}
                <div class="form-group col-12 col-sm-6">
                    <label>Status</label>
                    <select name="status" class="form-control select2 @error('status') is-invalid @enderror">
                        @if ($data->user->status === 1)
                            <option value="{{ $data->user->status }}" selected="selected">Active</option>
                            <option value="0">Deactive</option>
                        @endif
                        @if ($data->user->status === 0)
                            <option value="{{ $data->user->status }}" selected="selected">Deactive</option>
                            <option value="1">Active</option>
                        @endif
                    </select>
                    {!! validationError('address', $errors) !!}
                </div>
                {{-- password --}}
                <div class="form-group col-12 col-sm-6">
                    <label>password</label>

                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                        placeholder="Enter password">
                    {!! validationError('password', $errors) !!}
                    <p>don't wirite if u don't want to change password</p>
                </div>
                {{-- email --}}
                <div class="form-group col-12 col-sm-6">
                    <label>email</label>
                    <input type="email" value="{{ $data->email }}" name="email"
                        class="form-control @error('email') is-invalid @enderror" placeholder="Enter email">
                    {!! validationError('email', $errors) !!}
                </div>
                {{-- department_id --}}
                <div class="form-group col-12 col-sm-6">
                    <label>department</label>
                    <select name="department_id" class="form-control @error('department_id') is-invalid @enderror">
                        @foreach (\App\Models\Deparment::all() as $department)
                            <option value="{{ $department->id }}"
                                {{ $data->department_id == $department->id ? 'selected' : '' }}>{{ $department->name }}
                            </option>
                        @endforeach
                    </select>
                    {!! validationError('department_id', $errors) !!}
                </div>
                {{-- image --}}
                <div class="form-group col-12 col-sm-6">
                    <label>image</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" name="image"
                                class="custom-file-input @error('image') is-invalid @enderror"
                                accept="image/png, image/jpeg, image/jpg" onchange="previewImage(event)">
                            <label class="custom-file-label">Choose Image</label>
                        </div>
                    </div>
                    <div class="mt-2">
                        <img id="image-preview" src="{{ asset('users/images/' . $data->user->image) }}" alt="Image Preview"
                            style="max-width: 200px; max-height: 200px;">
                    </div>
                    {!! validationError('image', $errors) !!}
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-sm mt-1 mb-1 btn-primary">
                    Update
                </button>
                <a href="{{ route('superAdmin.hod.show', $data->id) }}" class="btn btn-sm mt-1 mb-1 btn-success">View</a>
            </div>
        </form>
    </div>
    <!-- /.card -->
    <!-- general form elements -->
    @include('parts.title_end')
@endsection
@section('scripts')
    <script>
        // document.getElementById('image-preview').style.display = 'none';
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('image-preview');
                output.style.display = 'block'
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection
