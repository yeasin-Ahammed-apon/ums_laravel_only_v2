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
        <form action="{{ route(Auth::user()->role->name . '.inventory.item.update', $data->id) }}" method="POST"
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
                {{-- description --}}
                <div class="form-group col-12 col-sm-6">
                    <label>description</label>
                    <input type="text" value="{{ $data->description }}" name="description"
                        class="form-control @error('description') is-invalid @enderror" placeholder="Enter description">
                    {!! validationError('description', $errors) !!}
                </div>
                {{-- code --}}
                <div class="form-group col-12 col-sm-6">
                    <label>code</label>
                    <input type="text" value="{{ $data->code }}" name="code"
                        class="form-control @error('code') is-invalid @enderror" placeholder="Enter code">
                    {!! validationError('code', $errors) !!}
                </div>
                {{-- inventory_categories_id --}}
                <div class="form-group col-12 col-sm-6">
                    <label>inventory categories</label>
                    <select name="inventory_categories_id" class="form-control @error('inventory_categories_id') is-invalid @enderror">
                        @foreach (\App\Models\InventoryCategories::all() as $InventoryCategories)
                            <option value="{{ $InventoryCategories->id }}"
                                {{ $InventoryCategories->id === $data->inventory_categories_id ? 'selected' : '' }}>{{ $InventoryCategories->name }}
                            </option>
                        @endforeach
                    </select>
                    {!! validationError('inventory_categories_id', $errors) !!}
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
