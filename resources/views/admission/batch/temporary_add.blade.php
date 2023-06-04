@extends('layout')
@section('meta-tag')
    Student temporary adding form
@endsection
@section('breadcrumb')
    @include('parts.breadcrumb')
@endsection
@section('content')
    @include('parts.title_start', [
        'title' => $title ?? 'Admin Edit Form',
        'color' => 'card-info',
    ])
    <div class="card">
        <form action="{{ route('admission.batch.temporary.store.student',$data->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <h5 class="shadow p-2">Department: {{ $data->department->name }} --------- Batch : {{ ordinalFormat($data->batch_number) }}</h5>
            <div class="card-body row">
                {{-- name --}}
                <div class="form-group col-12 col-sm-6">
                    <label>name</label>
                    <input type="text" value="{{ old('name') }}" name="name"
                        class="form-control @error('name') is-invalid @enderror" placeholder="Enter name">
                    {!! validationError('name', $errors) !!}
                </div>
                {{-- admission_discount --}}
                <div class="form-group col-12 col-sm-6">
                    <label>admission_discount</label>
                    <input type="number" value="{{ old('admission_discount') }}" name="admission_discount"
                        class="form-control @error('admission_discount') is-invalid @enderror" placeholder="Enter admission_discount">
                    {!! validationError('admission_discount', $errors) !!}
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-sm mt-1 mb-1 btn-primary"
                    onclick="disableButton(this)">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                    Create</button>
            </div>
        </form>
    </div>
    @include('parts.title_end')
@endsection
