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
        <ul class="list-group">
            <li class="list-group-item">User Id : {{ $data->temporary_id }}</li>
            <li class="list-group-item">Name : {{ $data->name }}</li>
            <li class="list-group-item">Admission Fee : {{ $data->admission_fee }}</li>
          </ul>
        <form action="{{ route('account.batch.temporary.student.pay.update', $data->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body row">
                {{-- admission_fee_given --}}
                <div class="form-group col-12 col-sm-6">
                    <label>admission_fee_given</label>
                    <input type="telephone" value="{{ $data->admission_fee_given }}" name="admission_fee_given"
                        class="form-control @error('admission_fee_given') is-invalid @enderror" placeholder="Enter admission_fee_given">
                    {!! validationError('admission_fee_given', $errors) !!}
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-sm mt-1 mb-1 btn-primary" onclick="disableButton(this)">
                    Update
                </button>
            </div>
        </form>
    </div>
    <!-- /.card -->
    <!-- general form elements -->
    @include('parts.title_end')
@endsection
