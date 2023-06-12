@extends('layout')
@section('meta-tag')
    Education Information and Add form
@endsection
@section('content')
{{-------------- Education Information List------------------------------------------------------------- --}}
    @include('parts.title_start', [
        'title' => $title ?? 'Education Information List',
        'color' => 'card-info',
    ])
    <div class="card-body table-responsive ">
        <table class="table  table-bordered border-top">
            <thead>
                <tr class=" text-sm">
                    <th>Title</th>
                    <th>Board</th>
                    <th>Result</th>
                    <th>Year</th>
                    <th>Session</th>
                    <th>Pdf</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach (\App\Models\EducationInfo::where('user_id', $data->id)->get() as $value)
                    {{-- {{ dd($value) }} --}}
                    <td class="text-sm text-bolder">{{ $value->title }}</td>
                    <td>{{ \App\Models\Board::find($value->board_id)->name }}</td>
                    <td>{{ $value->result }}</td>
                    <td>{{ dateFormat($value->year) }}</td>
                    <td>{{ dateFormat($value->session)}}</td>
                    <td>
                        <a href="{{ asset("users/education/".$value->pdf) }}" target="_blank"
                            class="btn btn-sm mt-1 mb-1 btn-info">
                            <i class="fas fa-file-pdf    "></i>
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('admission.student.education_create', $value->id) }}"
                            class="btn btn-sm mt-1 mb-1 btn-primary">
                            <i class="fas fa-cogs    "></i>
                        </a>
                        <a href="{{ route('admission.student.education_create', $value->id) }}"
                            class="btn btn-sm mt-1 mb-1 btn-danger">
                            <i class="fas fa-trash    "></i>
                        </a>
                    </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        @if (\App\Models\EducationInfo::where('user_id', $data->id)->get()->isEmpty())
            <h1 class="text-center">No Data Found</h1>
        @endif
    </div>
    @include('parts.title_end')

{{-------------- Education Information Create From------------------------------------------------------------- --}}
    @include('parts.title_start', [
        'title' => $title ?? 'Education Information Create Form',
        'color' => 'card-primary',
        ])
    <form action="{{ route('admission.student.education_store', $data->id) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        <div class="card-body " id="education_info">
            <div class="row">
                {{-- title --}}
                <div class="form-group col-12 col-sm-6">
                    <label>title</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                        placeholder="Enter title">
                    {!! validationError('title', $errors) !!}
                </div>
                {{-- result --}}
                <div class="form-group col-12 col-sm-6">
                    <label>result</label>
                    <input type="number" step="any" name="result" class="form-control @error('result') is-invalid @enderror"
                        placeholder="Enter result">
                    {!! validationError('result', $errors) !!}
                </div>
                {{-- board_id --}}
                <div class="form-group col-12 col-sm-6">
                    <label>Board</label>
                    <select name="board_id" class="form-control @error('board_id') is-invalid @enderror">
                        @foreach (\App\Models\Board::all() as $board)
                            <option value="{{ $board->id }}">{{ $board->name }}</option>
                        @endforeach
                    </select>
                    {!! validationError('board_id', $errors) !!}
                </div>
                {{-- year --}}
                <div class="form-group col-12 col-sm-6">
                    <label>year</label>
                    <input type="date" name="year" class="form-control @error('year') is-invalid @enderror"
                        placeholder="Enter year">
                    {!! validationError('year', $errors) !!}
                </div>
                {{-- session --}}
                <div class="form-group col-12 col-sm-6">
                    <label>session</label>
                    <input type="date" name="session" class="form-control @error('session') is-invalid @enderror"
                        placeholder="Enter session">
                    {!! validationError('session', $errors) !!}
                </div>
                {{-- image --}}
                <div class="form-group col-12 col-sm-6">
                    <label>Pdf</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" name="pdf" id="pdf-input"
                                class="custom-file-input @error('pdf') is-invalid @enderror" accept="application/pdf">
                            <label class="custom-file-label" id="pdf-label">Choose Pdf</label>
                        </div>
                    </div>
                    {!! validationError('pdf', $errors) !!}
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-sm mt-1 mb-1  btn-primary" onclick="disableButton(this)">
                <i class="fas fa-plus    "></i>
                Create
            </button>
        </div>
    </form>
    @include('parts.title_end')
@endsection

@section("scripts")
<script>
     const pdfInput = document.getElementById('pdf-input');
    const pdfLabel = document.getElementById('pdf-label');

    pdfInput.addEventListener('change', function() {
        const fileName = this.files[0].name;
        pdfLabel.textContent = fileName;
    });
</script>
@endsection
