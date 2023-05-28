@extends('layout')
@section('meta-tag')
    Batch Information || {{ auth()->user()->role->name }}
@endsection
@section('content')
    @include('parts.title_start', [
        'title' => $title ?? 'Batch Information',
        'color' => 'card-info',
    ])
    <div class="col-12 col-sm-12 col-md-12 d-flex align-items-stretch flex-column">
        <div class="card bg-light d-flex flex-fill">
            <div class="card-body pt-0">
                <div class="row">
                    <div class="col-12 col-sm-10  pt-5 pb-5 ">
                        <h2 class="lead"><b>{{ $data->department->name }}</b></h2>
                        <h2 class="lead"><b>{{ ordinalFormat($data->batch_number) }} batch</b></h2>
                        <ul class="ml-4 mb-0 fa-ul text-muted">
                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span>
                                duration_year: {{ $data->batchPaymentInfo->duration_year }}</li>
                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span>
                                duration_semester: {{ $data->batchPaymentInfo->duration_semester }}</li>
                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> credit:
                                {{ $data->batchPaymentInfo->credit }}</li>
                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span>
                                admission_fee: {{ $data->batchPaymentInfo->admission_fee }}</li>
                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span>
                                session_fee: {{ $data->batchPaymentInfo->session_fee }}</li>
                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span>
                                per_credit_fee: {{ $data->batchPaymentInfo->per_credit_fee }}</li>
                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> total_fee:
                                {{ $data->batchPaymentInfo->total_fee }}</li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    {{-- ssc --}}
                    <div class="form-group col-12 col-sm-5">
                        <label>ssc</label>
                        <input type="number" name="ssc" class="form-control" placeholder="Enter ssc">
                    </div>
                    {{-- hsc --}}
                    <div class="form-group col-12 col-sm-5">
                        <label>hsc</label>
                        <input type="number" name="hsc" class="form-control" placeholder="Enter hsc">
                    </div>
                    <div class="form-group col-12 col-sm-2 text-center">
                        <label class=" d-block">Golden</label>
                        <input type="checkbox" id="goldenCheckbox" class="form-check-input">
                    </div>
                    <div class="form-group col-12 col-sm-4">
                        <label>Waiver</label>
                        <div class="row">
                            <input type="number" name="waiver" class="form-control col-10">
                            <span class="col-2">%</span>
                        </div>
                    </div>
                </div>
                <button class="btn btn-info" data-id={{ $data->batch_waiver }} id="checkWaiverBtn">check waiver</button>
            </div>
            <div class="card-footer">
            <div class="text-right">
                <a href="{{ route('admission.batch.temporary.add.student', $data->id) }}" class="btn btn-sm mt-1 mb-1 btn-primary">
                    <i class="fa fa-plus" aria-hidden="true"></i> Add</a>
            </div>
          </div>
        </div>
    </div>
    <!-- general form elements -->
    @include('parts.title_end')
@endsection
@section('scripts')
    <script>
        let selectors = (name) => document.querySelector(name);
        const checkWaiverBtn = selectors('#checkWaiverBtn');
        checkWaiverBtn.addEventListener('click', function() {
            const sscValue = parseInt(selectors('input[name="ssc"]').value);
            const hscValue = parseInt(selectors('input[name="hsc"]').value);
            const waiverValue = selectors('input[name="waiver"]');
            const goldenCheckbox = document.getElementById('goldenCheckbox').checked;
            const gpa = (sscValue + hscValue) / 2;
            let value = JSON.parse(checkWaiverBtn.dataset.id)
            checkGPA(gpa);
            function checkGPA(gpa) {
                if (gpa >= 3.50 && gpa < 3.99) waiverValue.value = value.level1
                else if (gpa >= 4.0 && gpa < 4.49) waiverValue.value = value.level2
                else if (gpa >= 4.50 && gpa < 4.99) waiverValue.value = value.level3
                else if (gpa === 5)
                    if (goldenCheckbox) waiverValue.value = value.level5
                    else waiverValue.value = value.level4
                else waiverValue.value = 0;
            }
        })
    </script>
@endsection
