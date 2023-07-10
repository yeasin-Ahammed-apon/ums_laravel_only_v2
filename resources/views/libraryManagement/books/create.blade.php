@extends('layout')
@section('meta-tag')
    Create Inventory Item
@endsection
@section('content')
    @include('parts.title_start', [
        'title' => $title ?? 'Inventory Item Create Form',
        'color' => 'card-primary',
    ])
    <!-- general form elements -->
    <div class="card">
        <form action="{{ route(Auth::user()->role->name . '.library.book.store') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div class="card-body row">
                {{-- name --}}
                <div class="form-group col-12 col-sm-6">
                    <label>name</label>
                    <input type="text" value="{{ old('name') }}" name="name"
                        class="form-control @error('name') is-invalid @enderror" placeholder="Enter name">
                    {!! validationError('name', $errors) !!}
                </div>
                {{-- author --}}
                <div class="form-group col-12 col-sm-6">
                    <label>author</label>
                    <input type="text" value="{{ old('author') }}" name="author"
                        class="form-control @error('author') is-invalid @enderror" placeholder="Enter author">
                    {!! validationError('author', $errors) !!}
                </div>
                {{-- publisher --}}
                <div class="form-group col-12 col-sm-6">
                    <label>publisher</label>
                    <input type="text" value="{{ old('publisher') }}" name="publisher"
                        class="form-control @error('publisher') is-invalid @enderror" placeholder="Enter publisher">
                    {!! validationError('publisher', $errors) !!}
                </div>
                {{-- isbn --}}
                <div class="form-group col-12 col-sm-6">
                    <label>isbn</label>
                    <input type="text" value="{{ old('isbn') }}" name="isbn"
                        class="form-control @error('isbn') is-invalid @enderror" placeholder="Enter isbn">
                    {!! validationError('isbn', $errors) !!}
                </div>
                {{-- reck --}}
                <div class="form-group col-12 col-sm-6">
                    <label>reck</label>
                    <input type="number" value="{{ old('reck') }}" name="reck"
                        class="form-control @error('reck') is-invalid @enderror" placeholder="Enter reck">
                    {!! validationError('reck', $errors) !!}
                </div>
                {{-- description --}}
                <div class="form-group col-12 col-sm-6">
                    <label>description</label>
                    <input type="text" value="{{ old('description') }}" name="description"
                        class="form-control @error('description') is-invalid @enderror" placeholder="Enter description">
                    {!! validationError('description', $errors) !!}
                </div>
                {{-- code --}}
                <div class="form-group col-12 col-sm-6">
                    <label>code</label>
                    <input type="text" value="{{ old('code') }}" name="code"
                        class="form-control @error('code') is-invalid @enderror" placeholder="Enter code">
                    {!! validationError('code', $errors) !!}
                </div>
                {{-- library_categorie_id --}}
                <div class="form-group col-12 col-sm-6">
                    <label>Inventory Categories</label>
                    <select name="library_categorie_id" class="form-control @error('library_categorie_id') is-invalid @enderror">
                        @foreach (\App\Models\LibraryCategories::all() as $libraryCategories)
                            <option value="{{ $libraryCategories->id }}">{{ $libraryCategories->name }}</option>
                        @endforeach
                    </select>
                    {!! validationError('library_categorie_id', $errors) !!}
                </div>
                {{-- department_id --}}
                <div class="form-group col-12 col-sm-6">
                    <label>Inventory Categories</label>
                    <select name="department_id" class="form-control @error('department_id') is-invalid @enderror">
                        @foreach (\App\Models\Deparment::all() as $deparment)
                            <option value="{{ $deparment->id }}">{{ $deparment->name }}</option>
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
                        <img id="image-preview" src="" alt="Image Preview"
                            style="max-width: 200px; max-height: 200px;">
                    </div>
                    {!! validationError('image', $errors) !!}
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-sm mt-1 mb-1  btn-primary"
                    onclick="disableButton(this)">Create</button>
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
