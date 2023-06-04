@extends('layout')
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
        <form action="{{ route('admin.account.update', $data->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body row">
                {{-- role --}}
                <input type="hidden" name="role" value="student" class="form-control" placeholder="Enter name">
                {{-- name --}}
                <div class="form-group col-12 col-sm-6">
                    <label>name</label>
                    <input type="text" value="{{ $data->name }}" name="name"
                        class="form-control @error('name') is-invalid @enderror" placeholder="Enter name">
                    {!! validationError('name', $errors) !!}
                </div>
                {{-- first_name --}}
                <div class="form-group col-12 col-sm-6">
                    <label>first_name</label>
                    <input type="text" name="first_name"
                        class="form-control @error('first_name') is-invalid @enderror" placeholder="Enter first_name">
                    {!! validationError('first_name', $errors) !!}
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
                <button type="submit" class="btn btn-sm mt-1 mb-1 btn-primary" onclick="disableButton(this)">
                    Update
                </button>
                <a href="{{ route('admin.account.show', $data->id) }}" class="btn btn-sm mt-1 mb-1 btn-success"><i class="fa fa-eye" aria-hidden="true"></i> View</a>
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
