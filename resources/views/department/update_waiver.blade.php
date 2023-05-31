@extends('layout')
@section('meta-tag')
    Edit Department || {{ auth()->user()->role->name }}
@endsection
@section('content')
    @include('parts.title_start', [
        'title' => $title ?? 'Department Edit Form',
        'color' => 'card-warning',
    ])
    <!-- general form elements -->
    <div class="card">
        <form action="{{ route('department.waiver.update',$data->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body row">
                <input type="hidden" value="{{ $data->id }}" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter name">
                {{-- level1 --}}
                <div class="form-group col-12 col-sm-6">
                    <label>GPA -3.50 to 3.99</label>
                    <input type="text" value="{{ $data->level1 }}" name="level1" class="form-control @error('level1') is-invalid @enderror" placeholder="Enter level1">
                    {!! validationError('level1', $errors) !!}
                </div>
                {{-- level2 --}}
                <div class="form-group col-12 col-sm-6">
                    <label>GPA- 4.00 to 4.49</label>
                    <input type="text" value="{{ $data->level2 }}" name="level2" class="form-control @error('level2') is-invalid @enderror" placeholder="Enter level2">
                    {!! validationError('level2', $errors) !!}
                </div>
                {{-- level3 --}}
                <div class="form-group col-12 col-sm-6">
                    <label>GPA- 4.50 to 4.99</label>
                    <input type="text" value="{{ $data->level3 }}" name="level3" class="form-control @error('level3') is-invalid @enderror" placeholder="Enter level3">
                    {!! validationError('level3', $errors) !!}
                </div>
                {{-- level4 --}}
                <div class="form-group col-12 col-sm-6">
                    <label>GPA- 5.00</label>
                    <input type="text" value="{{ $data->level4 }}" name="level4" class="form-control @error('level4') is-invalid @enderror" placeholder="Enter level4">
                    {!! validationError('level4', $errors) !!}
                </div>
                {{-- level5 --}}
                <div class="form-group col-12 col-sm-6">
                    <label>Golden 5.00</label>
                    <input type="text" value="{{ $data->level5 }}" name="level5" class="form-control @error('level5') is-invalid @enderror" placeholder="Enter level5">
                    {!! validationError('level5', $errors) !!}
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-sm mt-1 mb-1 btn-primary" onclick="disableButton(this)">Update</button>
                <span class="btn btn-sm mt-1 mb-1 btn-info" onclick="getTotal()">Get Total</span>
            </div>
        </form>
    </div>
    <!-- /.card -->
    <!-- general form elements -->
    @include('parts.title_end')
@endsection
