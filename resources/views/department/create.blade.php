@extends('layout')
@section('meta-tag')
{{ $title ?? Auth::user()->role->name }}
@endsection
@section('content')
    @include('parts.title_start', [
        'title' => $title ?? 'Department Create Form',
        'color' => 'card-primary',
    ])
    <div class="card">
        <form action="{{ route('department.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body row">
                {{-- name --}}
                <div class="form-group col-12 col-sm-6">
                    <label>name</label>
                    <input type="text" value="{{ old('name') }}" name="name"
                        class="form-control @error('name') is-invalid @enderror" placeholder="Enter name">
                    {!! validationError('name', $errors) !!}
                </div>
                {{-- faculty_id --}}
                <div class="form-group col-12 col-sm-6">
                    <label>Faculty</label>
                    <select name="faculty_id" class="form-control @error('faculty_id') is-invalid @enderror">
                        @foreach (\App\Models\Faculty::all() as $faculty)
                            <option value="{{ $faculty->id }}">{{ $faculty->name }}</option>
                        @endforeach
                    </select>
                    {!! validationError('faculty_id', $errors) !!}
                </div>
                {{-- program_id --}}
                <div class="form-group col-12 col-sm-6">
                    <label>Program</label>
                    <select name="program_id" class="form-control @error('program_id') is-invalid @enderror">
                        @foreach (\App\Models\Program::all() as $program)
                            <option value="{{ $program->id }}">{{ $program->name }}</option>
                        @endforeach
                    </select>
                    {!! validationError('program_id', $errors) !!}
                </div>
                {{-- duration_year --}}
                <div class="form-group col-12 col-sm-6">
                    <label>duration_year</label>
                    <input type="text" value="{{ old('duration_year') }}" name="duration_year"
                        class="form-control @error('duration_year') is-invalid @enderror" placeholder="Enter duration_year">
                    {!! validationError('duration_year', $errors) !!}
                </div>
                {{-- duration_semester --}}
                <div class="form-group col-12 col-sm-6">
                    <label>duration_semester</label>
                    <input type="text" value="{{ old('duration_semester') }}" name="duration_semester"
                        class="form-control @error('duration_semester') is-invalid @enderror"
                        placeholder="Enter duration_semester">
                    {!! validationError('duration_semester', $errors) !!}
                </div>
                {{-- credit --}}
                <div class="form-group col-12 col-sm-6">
                    <label>credit</label>
                    <input type="text" value="{{ old('credit') }}" name="credit"
                        class="form-control @error('credit') is-invalid @enderror" placeholder="Enter credit">
                    {!! validationError('credit', $errors) !!}
                </div>
                {{-- admission_fee --}}
                <div class="form-group col-12 col-sm-6">
                    <label>admission_fee</label>
                    <input type="text" value="{{ old('admission_fee') }}" name="admission_fee"
                        class="form-control @error('admission_fee') is-invalid @enderror" placeholder="Enter admission_fee">
                    {!! validationError('admission_fee', $errors) !!}
                </div>
                {{-- session_fee --}}
                <div class="form-group col-12 col-sm-6">
                    <label>session_fee</label>
                    <input type="text" value="{{ old('session_fee') }}" name="session_fee"
                        class="form-control @error('session_fee') is-invalid @enderror" placeholder="Enter session_fee">
                    {!! validationError('session_fee', $errors) !!}
                </div>
                {{-- per_credit_fee --}}
                <div class="form-group col-12 col-sm-6">
                    <label>per_credit_fee</label>
                    <input type="text" value="{{ old('per_credit_fee') }}" name="per_credit_fee"
                        class="form-control @error('per_credit_fee') is-invalid @enderror"
                        placeholder="Enter per_credit_fee">
                    {!! validationError('per_credit_fee', $errors) !!}
                </div>

                {{-- total_fee --}}
                <div class="form-group col-12 col-sm-6">
                    <label>total_fee</label>
                    <input type="text" value="{{ old('total_fee') }}" name="total_fee"
                        class="form-control @error('total_fee') is-invalid @enderror"
                        placeholder="Enter total_fee">
                    {!! validationError('total_fee', $errors) !!}
                </div>

            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-sm mt-1 mb-1 btn-primary"
                    onclick="disableButton(this)">Create</button>
                <span class="btn btn-sm mt-1 mb-1 btn-info" onclick="getTotal()">Get Total</span>
            </div>
        </form>
    </div>
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
