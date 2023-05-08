@extends('layout')
{{-- @section('breadcrumb')
    @include('parts.breadcrumb', [
        'page_title' => 'Admin list Page',
        'links' => [
            [
                'title' => 'dashboard',
                'route' => 'admin.admission.dashboard',
                'enable' => true,
            ],
            [
                'title' => 'Admin List',
                'route' => 'admin.admission.index',
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
        <form action="{{ route('admin.admission.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body row">
                {{-- role --}}
                <input type="hidden" name="role" value="admission" class="form-control" placeholder="Enter name">
                {{-- name --}}
                <div class="form-group col-12 col-sm-6">
                    <label>name</label>
                    <input type="text" value="{{ old('name') }}" name="name"
                        class="form-control @error('name') is-invalid @enderror" placeholder="Enter name">
                    {!! validationError('name', $errors) !!}
                </div>
                {{-- first_name --}}
                <div class="form-group col-12 col-sm-6">
                    <label>first_name</label>
                    <input type="text" value="{{ old('first_name') }}" name="first_name"
                        class="form-control @error('first_name') is-invalid @enderror" placeholder="Enter first_name">
                    {!! validationError('first_name', $errors) !!}
                </div>
                {{-- last_name --}}
                <div class="form-group col-12 col-sm-6">
                    <label>last_name</label>
                    <input type="text" value="{{ old('last_name') }}" name="last_name"
                        class="form-control @error('last_name') is-invalid @enderror" placeholder="Enter last_name">
                    {!! validationError('last_name', $errors) !!}
                </div>
                {{-- phone --}}
                <div class="form-group col-12 col-sm-6">
                    <label>phone</label>
                    <input type="telephone" value="{{ old('phone') }}" name="phone"
                        class="form-control @error('phone') is-invalid @enderror" placeholder="Enter phone">
                    {!! validationError('telephone', $errors) !!}
                </div>
                {{-- address --}}
                <div class="form-group col-12 col-sm-6">
                    <label>address</label>
                    <input type="text" value="{{ old('address') }}" name="address"
                        class="form-control @error('address') is-invalid @enderror" placeholder="Enter address">
                    {!! validationError('address', $errors) !!}
                </div>
                {{-- password --}}
                <div class="form-group col-12 col-sm-6">
                    <label>password</label>
                    <input type="password" value="{{ old('password') }}" name="password"
                        class="form-control @error('password') is-invalid @enderror" placeholder="Enter password">
                    {!! validationError('password', $errors) !!}
                </div>
                {{-- email --}}
                <div class="form-group col-12 col-sm-6">
                    <label>email</label>
                    <input type="email" value="{{ old('email') }}" name="email"
                        class="form-control @error('email') is-invalid @enderror" placeholder="Enter email">
                    {!! validationError('email', $errors) !!}
                </div>
                {{-- image --}}
                <div class="form-group col-12 col-sm-6">
                    <label>image</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" name="image"
                                class="custom-file-input @error('image') is-invalid @enderror"
                                accept="image/png, image/jpeg, image/jpg"
                                onchange="previewImage(event)"
                                >
                            <label class="custom-file-label">Choose Image</label>
                        </div>
                    </div>
                    <div class="mt-2">
                        <img id="image-preview" src="" alt="Image Preview" style="max-width: 200px; max-height: 200px;">
                    </div>
                    {!! validationError('image', $errors) !!}
                </div>
            </div>
            <div class="card-footer" onclick="disableButton(this)">
                <button type="submit" class="btn  btn-primary">Create</button>
            </div>
        </form>
    </div>
    <!-- /.card -->
    <!-- general form elements -->
    @include('parts.title_end')
@endsection
@section('scripts')
<script>
    document.getElementById('image-preview').style.display = 'none';
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
