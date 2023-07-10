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
        <form action="{{ route(Auth::user()->role->name . '.library.book.copy.store') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div class="card-body row">
                {{-- id --}}
                <input type="hidden" name="id" value="{{ $data->id }}">
                {{-- code --}}
                <div class="form-group col-12 col-sm-6">
                    <label>code</label>
                    <input type="text" value="{{ old('code') }}" name="code"
                        class="form-control @error('code') is-invalid @enderror" placeholder="Enter code">
                    {!! validationError('code', $errors) !!}
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
