@extends('layout')
@section('meta-tag')
    Edit Inventory Categories
@endsection
@section('content')
    @include('parts.title_start', [
        'title' => $title ?? 'Inventory Categories Edit Form',
        'color' => 'card-warning',
    ])
    <!-- general form elements -->
    <div class="card">
        <form action="{{ route(Auth::user()->role->name . '.library.book.update', $data->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body row">
                {{-- name --}}
                <div class="form-group col-12 col-sm-6">
                    <label>name</label>
                    <input type="text" value="{{ $data->name }}" name="name"
                        class="form-control @error('name') is-invalid @enderror" placeholder="Enter name">
                    {!! validationError('name', $errors) !!}
                </div>
                {{-- code --}}
                <div class="form-group col-12 col-sm-6">
                    <label>code</label>
                    <input type="text" value="{{ $data->code }}" name="code"
                        class="form-control @error('code') is-invalid @enderror" placeholder="Enter code">
                    {!! validationError('code', $errors) !!}
                </div>
                {{-- description --}}
                <div class="form-group col-12 col-sm-6">
                    <label>description</label>
                    <input type="text" value="{{ $data->description }}" name="description"
                        class="form-control @error('description') is-invalid @enderror" placeholder="Enter description">
                    {!! validationError('description', $errors) !!}
                </div>
                {{-- library_categorie_id --}}
                <div class="form-group col-12 col-sm-6">
                    <label>inventory categories</label>
                    <select name="library_categorie_id"
                        class="form-control @error('library_categorie_id') is-invalid @enderror">
                        @foreach (\App\Models\LibraryCategories::all() as $libraryCategories)
                            <option value="{{ $libraryCategories->id }}"
                                {{ $libraryCategories->id === $data->library_categorie_id ? 'selected' : '' }}>
                                {{ $libraryCategories->name }}
                            </option>
                        @endforeach
                    </select>
                    {!! validationError('library_categorie_id', $errors) !!}
                </div>
                {{-- department_id --}}
                <div class="form-group col-12 col-sm-6">
                    <label>Department</label>
                    <select name="department_id" class="form-control @error('department_id') is-invalid @enderror">
                        @foreach (\App\Models\Deparment::all() as $department)
                            <option value="{{ $department->id }}"
                                {{ $department->id === $data->department_id ? 'selected' : '' }}>{{ $department->name }}
                            </option>
                        @endforeach
                    </select>
                    {!! validationError('department_id', $errors) !!}
                </div>
                {{-- author --}}
                <div class="form-group col-12 col-sm-6">
                    <label>author</label>
                    <input type="text" value="{{ $data->author }}" name="author"
                        class="form-control @error('author') is-invalid @enderror" placeholder="Enter author">
                    {!! validationError('author', $errors) !!}
                </div>
                {{-- publisher --}}
                <div class="form-group col-12 col-sm-6">
                    <label>publisher</label>
                    <input type="text" value="{{ $data->publisher }}" name="publisher"
                        class="form-control @error('publisher') is-invalid @enderror" placeholder="Enter publisher">
                    {!! validationError('publisher', $errors) !!}
                </div>
                {{-- isbn --}}
                <div class="form-group col-12 col-sm-6">
                    <label>isbn</label>
                    <input type="text" value="{{ $data->isbn }}" name="isbn"
                        class="form-control @error('isbn') is-invalid @enderror" placeholder="Enter isbn">
                    {!! validationError('isbn', $errors) !!}
                </div>
                {{-- reck --}}
                <div class="form-group col-12 col-sm-6">
                    <label>reck</label>
                    <input type="number" value="{{ $data->reck }}" name="reck"
                        class="form-control @error('reck') is-invalid @enderror" placeholder="Enter reck">
                    {!! validationError('reck', $errors) !!}
                </div>
                {{-- status --}}
                <div class="form-group col-12 col-sm-6">
                    <label>Status</label>
                    <select name="status" class="form-control select2 @error('status') is-invalid @enderror">
                        @if ($data->status === 1)
                            <option value="{{ $data->status }}" selected="selected">Active</option>
                            <option value="0">Deactive</option>
                        @endif
                        @if ($data->status === 0)
                            <option value="{{ $data->status }}" selected="selected">Deactive</option>
                            <option value="1">Active</option>
                        @endif
                    </select>
                    {!! validationError('status', $errors) !!}
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
                        <img id="image-preview" src="{{ asset('library/' . $data->image) }}" alt="Image Preview"
                            style="max-width: 200px; max-height: 200px;">
                    </div>
                    {!! validationError('image', $errors) !!}
                </div>

            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-sm mt-1 mb-1 btn-primary" onclick="disableButton(this)">
                    Update
                </button>
                {{-- <a href="{{ route(Auth::user()->role->name.'.account.show', $data->id) }}" class="btn btn-sm mt-1 mb-1 btn-success"><i class="fa fa-eye" aria-hidden="true"></i> View</a> --}}
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
