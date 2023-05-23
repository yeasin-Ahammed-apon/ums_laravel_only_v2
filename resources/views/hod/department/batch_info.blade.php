@extends('layout')
@section('meta-tag')
    Edit Admin || {{ auth()->user()->role->name }}
@endsection
@section('content')
    @include('parts.title_start', [
        'title' => $title ?? 'Admin Edit Form',
        'color' => 'card-warning',
    ])
    <div class="col-12 col-sm-12 col-md-12 d-flex align-items-stretch flex-column">
        <div class="card bg-light d-flex flex-fill">
          <div class="card-body pt-0">
            <div class="row">
              <div class="col-12 col-sm-10  pt-5 pb-5 ">
                  <h2 class="lead"><b>{{\App\Models\Deparment::findOrFail($department_id)->name }}</b></h2>
                  <h2 class="lead"><b>{{ ordinalFormat($data->batch_number) }} batch</b></h2>
                <ul class="ml-4 mb-0 fa-ul text-muted">
                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> duration_year: {{ $data->batchPaymentInfo->duration_year}}</li>
                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> duration_semester: {{ $data->batchPaymentInfo->duration_semester}}</li>
                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> credit: {{ $data->batchPaymentInfo->credit}}</li>
                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> admission_fee: {{ $data->batchPaymentInfo->admission_fee}}</li>
                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> session_fee: {{ $data->batchPaymentInfo->session_fee}}</li>
                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> per_credit_fee: {{ $data->batchPaymentInfo->per_credit_fee}}</li>
                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> total_fee: {{ $data->batchPaymentInfo->total_fee}}</li>
                </ul>
              </div>
            </div>
          </div>
          {{-- <div class="card-footer">
            <div class="text-right">
                <a href="{{ route('department.edit', $data->id) }}" class="btn btn-sm mt-1 mb-1 btn-primary">Edit</a>
                <form action="{{ route('department.destroy', $data->id) }}" method="POST"
                    class="d-inline">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-sm mt-1 mb-1 btn-danger"
                    onclick="disableButton(this)"
                    >Delete</button>
                </form>
            </div>
          </div> --}}
        </div>
      </div>
    <!-- general form elements -->
    @include('parts.title_end')
@endsection
