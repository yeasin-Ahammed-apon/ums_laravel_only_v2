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
        <form action="{{ route(Auth::user()->role->name . '.library.issue.store', $data->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body row">
                {{-- taken_by --}}
                <div class="form-group col-12 col-sm-6">
                    <label>Taken By</label>
                    <input type="text" value="{{ $data->taken_by->name }}"  class="form-control" disabled>
                </div>
                {{-- given_by --}}
                <div class="form-group col-12 col-sm-6">
                    <label>Given By</label>
                    <input type="text" value="{{ $data->user->name }}"  class="form-control " disabled>
                </div>
                {{-- Book Name --}}
                <div class="form-group col-12 col-sm-6">
                    <label>Book Name</label>
                    <input type="text" value="{{ $data->library_book->name }}" class="form-control" disabled>
                </div>
                {{-- description --}}
                <div class="form-group col-12 col-sm-6">
                    <label>Book Copy Code</label>
                    <input type="text" value="{{ $data->library_book_copy->code }}" class="form-control" disabled>
                </div>
                {{-- issue_date --}}
                <div class="form-group col-12 col-sm-6">
                    <label>issue_date</label>
                    <input type="date" value="{{ $data->issue_date }}" class="form-control" disabled>
                </div>
                {{-- expected_return_date --}}
                <div class="form-group col-12 col-sm-6">
                    <label>expected_return_date</label>
                    <input type="date" value="{{ $data->expected_return_date }}" class="form-control" disabled>
                </div>
                {{-- return_date --}}
                <div class="form-group col-12 col-sm-6">
                    <label>return_date</label>
                    <input type="date"  name="return_date" onblur="activeUpdateButton()" value="{{ $data->return_date }}"
                        class="form-control @error('return_date') is-invalid @enderror" placeholder="Enter return_date">
                    {!! validationError('return_date', $errors) !!}
                </div>
                {{-- return_in_what_condition --}}
                <div class="form-group col-12 col-sm-6">
                    <label>return_in_what_condition</label>
                    <input type="text" name="return_in_what_condition" class="form-control @error('return_in_what_condition') is-invalid @enderror" placeholder="Enter return_in_what_condition" onblur="activeUpdateButton()">
                    {!! validationError('return_in_what_condition', $errors) !!}
                </div>
                {{-- fine --}}
                <div class="form-group col-12 col-sm-6">
                    <label>fine</label>
                    <input type="number" value="{{ $data->fine }}" name="fine" class="form-control @error('fine') is-invalid @enderror" placeholder="Enter fine" onblur="activeUpdateButton()">
                    {!! validationError('fine', $errors) !!}
                </div>
                {{-- status
                <div class="form-group col-12 col-sm-6">
                    <label>Status</label>
                    <select name="status" class="form-control select2 @error('status') is-invalid @enderror" onblur="activeUpdateButton()">
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
                </div> --}}
            </div>
            <div class="card-footer">
                @if ($data->status)
                <button type="submit" class="btn btn-sm mt-1 mb-1 btn-primary activeUpdateButton"  onclick="disableButton(this)">
                    Update
                </button>
                @endif

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
        let button = document.querySelector('.activeUpdateButton');
            button.disabled = true;
        function activeUpdateButton(){
            let button = document.querySelector('.activeUpdateButton');
            button.disabled = false;

        }
    </script>
@endsection
