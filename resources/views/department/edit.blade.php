@extends('layout')
@section('meta-tag')
    Edit Admin || {{ auth()->user()->role->name }}
@endsection
@section('content')
    @include('parts.title_start', [
        'title' => $title ?? 'Admin Edit Form',
        'color' => 'card-warning',
    ])
    <!-- general form elements -->
    <div class="card">
        <form action="{{ route('department.update',$data->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body row">
                <input type="hidden" value="{{ $data->id }}" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter name">
                {{-- name --}}
                <div class="form-group col-12 col-sm-6">
                    <label>name</label>
                    <input type="text" value="{{ $data->name }}" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter name">
                    {!! validationError('name', $errors) !!}
                </div>
                {{-- faculty_id --}}
                <div class="form-group col-12 col-sm-6">
                    <label>Faculty</label>
                    <select name="faculty_id" class="form-control @error('faculty_id') is-invalid @enderror">
                        @foreach (\App\Models\Faculty::all() as $faculty)
                            <option value="{{ $faculty->id }}" {{ $data->faculty_id == $faculty->id ? 'selected' : '' }}>{{ $faculty->name }}</option>
                        @endforeach
                    </select>
                    {!! validationError('faculty_id', $errors) !!}
                </div>
                {{-- program_id --}}
                <div class="form-group col-12 col-sm-6">
                    <label>Program</label>
                    <select name="program_id" class="form-control @error('program_id') is-invalid @enderror">
                        @foreach (\App\Models\Program::all() as $program)
                            <option value="{{ $program->id }}" {{ $data->program_id == $program->id ? 'selected' : '' }}>{{ $program->name }}</option>
                        @endforeach
                    </select>
                    {!! validationError('program_id', $errors) !!}
                </div>
                {{-- duration_year --}}
                <div class="form-group col-12 col-sm-6">
                    <label>duration_year</label>
                    <input type="text"  name="duration_year" value="{{ $data->departmentCourseFeeInfo->duration_year }}"
                        class="form-control @error('duration_year') is-invalid @enderror" placeholder="Enter duration_year">
                    {!! validationError('duration_year', $errors) !!}
                </div>
                {{-- duration_semester --}}
                <div class="form-group col-12 col-sm-6">
                    <label>duration_semester</label>
                    <input type="text"  name="duration_semester" value="{{ $data->departmentCourseFeeInfo->duration_semester }}"
                        class="form-control @error('duration_semester') is-invalid @enderror"
                        placeholder="Enter duration_semester">
                    {!! validationError('duration_semester', $errors) !!}
                </div>
                {{-- credit --}}
                <div class="form-group col-12 col-sm-6">
                    <label>credit</label>
                    <input type="text"  name="credit" value="{{ $data->departmentCourseFeeInfo->credit }}"
                        class="form-control @error('credit') is-invalid @enderror" placeholder="Enter credit">
                    {!! validationError('credit', $errors) !!}
                </div>
                {{-- admission_fee --}}
                <div class="form-group col-12 col-sm-6">
                    <label>admission_fee</label>
                    <input type="text"  name="admission_fee" value="{{ $data->departmentCourseFeeInfo->admission_fee }}"
                        class="form-control @error('admission_fee') is-invalid @enderror" placeholder="Enter admission_fee">
                    {!! validationError('admission_fee', $errors) !!}
                </div>
                {{-- session_fee --}}
                <div class="form-group col-12 col-sm-6">
                    <label>session_fee</label>
                    <input type="text"  name="session_fee" value="{{ $data->departmentCourseFeeInfo->session_fee }}"
                        class="form-control @error('session_fee') is-invalid @enderror" placeholder="Enter session_fee">
                    {!! validationError('session_fee', $errors) !!}
                </div>
                {{-- per_credit_fee --}}
                <div class="form-group col-12 col-sm-6">
                    <label>per_credit_fee</label>
                    <input type="text"  name="per_credit_fee" value="{{ $data->departmentCourseFeeInfo->per_credit_fee }}"
                        class="form-control @error('per_credit_fee') is-invalid @enderror"
                        placeholder="Enter per_credit_fee">
                    {!! validationError('per_credit_fee', $errors) !!}
                </div>

                {{-- total_fee --}}
                <div class="form-group col-12 col-sm-6">
                    <label>total_fee</label>
                    <input type="text"  name="total_fee" value="{{ $data->departmentCourseFeeInfo->total_fee }}"
                        class="form-control @error('total_fee') is-invalid @enderror"
                        placeholder="Enter total_fee">
                    {!! validationError('total_fee', $errors) !!}
                </div>
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
                    {!! validationError('address', $errors) !!}
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
@section('scripts')
    <script>
        function getTotal() {
            const form = document.querySelector('form');
            const fieldNames = [
                'duration_semester',
                'credit',
                'admission_fee',
                'session_fee',
                'per_credit_fee',
            ];
            const fieldValues = [];
            for (const fieldName of fieldNames) {
                const field = form.querySelector(`input[name="${fieldName}"]`);
                fieldValues[fieldName] = parseInt(field.value) || 0;
            }
            let total_fee =  (fieldValues['admission_fee']) +
                            (fieldValues['session_fee']*fieldValues['duration_semester'])+
                            (fieldValues['credit']*fieldValues['per_credit_fee']);
            form.querySelector(`input[name="total_fee"]`).value = total_fee;
        }
    </script>
@endsection
