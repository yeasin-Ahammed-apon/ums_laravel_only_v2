@extends('layout')
@section('meta-tag')
    Edit Department || {{ auth()->user()->role->name }}
@endsection
@section('content')
    @include('parts.title_start', [
        'title' => $title ?? 'Department Edit Form',
        'color' => 'card-warning',
    ])
    <div class="col-12 col-sm-12 col-md-12 d-flex align-items-stretch flex-column">
        <div class="card bg-light d-flex flex-fill">

          <div class="card-body pt-0">
            <div class="row">
              <div class="col-12 col-sm-10  pt-5 pb-5 ">

                  <h2 class="lead"><b>{{ $data->name }}</b></h2>
                <ul class="ml-4 mb-0 fa-ul text-muted">
                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> faculty: {{ $data->faculty->name }}</li>
                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> program: {{ $data->program->name }}</li>
                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> year: {{ $data->departmentCourseFeeInfo->duration_year }}</li>
                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> semester: {{ $data->departmentCourseFeeInfo->duration_semester }}</li>
                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> credit: {{ $data->departmentCourseFeeInfo->credit }}</li>
                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> admission_fee: {{ $data->departmentCourseFeeInfo->admission_fee }}</li>
                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> session_fee: {{ $data->departmentCourseFeeInfo->session_fee }}</li>
                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> per_credit_fee: {{ $data->departmentCourseFeeInfo->per_credit_fee }}</li>
                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> total_fee: {{ $data->departmentCourseFeeInfo->total_fee }}</li>
                </ul>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <div class="text-right">
                <a href="{{ route('department.edit', $data->id) }}" class="btn btn-sm mt-1 mb-1 btn-primary"><i class="fa fa-cogs" aria-hidden="true"></i> Edit</a>
                <form action="{{ route('department.destroy', $data->id) }}" method="POST"
                    class="d-inline">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-sm mt-1 mb-1 btn-danger"
                    onclick="disableButton(this)"
                    ><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
                </form>
            </div>
          </div>
        </div>
      </div>
    <!-- general form elements -->
    @include('parts.title_end')
@endsection
