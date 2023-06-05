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

        <div class="card-body table-responsive ">
            <table class="table  table-bordered border-top">
                <thead>
                    <tr>
                        <th>User Id</th>
                        <th >Name</th>
                        <th >Admission Fee</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $data->temporary_id }}</td>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->admission_fee }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <form action="{{ route('account.temporary.payment.update', $data->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body row">
                <div class="form-group col-12 col-sm-6">
                    <label for="admission_fee_given">Admission Fee Given</label>
                    <input type="telephone" value="{{ $data->admission_fee_given }}" name="admission_fee_given"
                        class="form-control @error('admission_fee_given') is-invalid @enderror" id="admission_fee_given" placeholder="Enter admission_fee_given">
                    {!! validationError('admission_fee_given', $errors) !!}
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-sm mt-1 mb-1 btn-primary" onclick="disableButton(this)">
                    Update
                </button>
            </div>
        </form>

    <!-- /.card -->
    <!-- general form elements -->
    @include('parts.title_end')
@endsection
