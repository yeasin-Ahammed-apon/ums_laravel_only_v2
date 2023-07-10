@extends('layout')
@section('meta-tag')
    Create Inventory Categories
@endsection
@section('content')
    @include('parts.title_start', [
        'title' => $title ?? 'Inventory Categories Create Form',
        'color' => 'card-primary',
    ])
    <!-- general form elements -->
    <div class="card">
        <form action="{{ route(Auth::user()->role->name . '.library.categorie.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body row">
                {{-- name --}}
                <div class="form-group col-12 col-sm-6">
                    <label>name</label>
                    <input type="text" value="{{ old('name') }}" name="name"
                        class="form-control @error('name') is-invalid @enderror" placeholder="Enter name">
                    {!! validationError('name', $errors) !!}
                </div>
                {{-- description --}}
                <div class="form-group col-12 col-sm-6">
                    <label>description</label>
                    <input type="text" value="{{ old('description') }}" name="description"
                        class="form-control @error('description') is-invalid @enderror" placeholder="Enter description">
                    {!! validationError('description', $errors) !!}
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
