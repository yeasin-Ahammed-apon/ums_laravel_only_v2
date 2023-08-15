@extends('layout')
@section('meta-tag')
{{ $title ?? Auth::user()->role->name }}
@endsection
@section('content')
    @include('parts.title_start', [
        'title' => $title ?? 'Admin Create Form',
        'color' => 'card-primary',
    ])
    <!-- general form elements -->
    <div class="card">
        <form action="{{ route('faculty.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body row">
                {{-- role --}}
                <input type="hidden" name="role" value="account" class="form-control" placeholder="Enter name">
                {{-- name --}}
                <div class="form-group col-12">
                    <label>name</label>
                    <input type="text" value="{{ old('name') }}" name="name"
                        class="form-control @error('name') is-invalid @enderror" placeholder="Enter name">
                    {!! validationError('name', $errors) !!}
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-sm mt-1 mb-1  btn-primary" onclick="disableButton(this)">Create</button>
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
