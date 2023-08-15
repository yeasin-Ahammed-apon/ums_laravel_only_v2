@extends('InvoiceLayout')
@section('title')
{{ $title ?? Auth::user()->role->name }}
@endsection
@section('invoice')
    <div class="invoice">
        <div class="paymenyt">
            <div class="row text-center">
                <div class="col-2 m-auto">
                    <img src="{{ asset('institutionImage/image.png') }}" alt="Logo" width="50%" class="img-fluid">
                </div>
                <div class="col-8">
                    <h3>Shanto-Mariam University of Creative Technology</h3>
                    <p class="fs-4">Plot# 06, Road/Avenue# 06, Sector# 17/H-1, Uttara, Dhaka-1230, Bangladesh</p>
                    <p class="fs-2">Money Receipt</p>
                </div>
                <div class="col-2 m-auto">
                    <img src="{{ asset('institutionImage/image.png') }}" alt="Logo" width="50%" class="img-fluid">
                </div>
            </div>

            <!-- Other divs for invoice content -->
            <div class="row text-sm">
                <div class="col-4">
                    <p>Printed at: <span id="printed-time">{{ Carbon\Carbon::now()->format('d F, g:i:s A') }}</span></p>
                </div>
                <div class="col-4">
                    <p>Sacnt: <span id="sacnt-time">{{ Str::uuid() }}</span></p>
                </div>
                <div class="col-4">
                    <p>Printed by: {{ Auth::user()->name }} ({{Auth::user()->role->name  }})</p>
                </div>
            </div>
            <hr>
            <div class="row text-sm">
                <div class="col-3">
                    <p>User ID: {{ $data->temporary_id }}</p>
                </div>
                <div class="col-3">
                    <p>Name: {{ $data->name }}</p>
                </div>
                <div class="col-3">
                    <p>Department Name: {{ $data->batch->department->name }}</p>
                </div>
                <div class="col-3">
                    <p>Program Name: {{ $data->batch->department->program->name }}</p>
                </div>
                <div class="col-3">
                    <p>slip ID: {{ $data->id }}</p>
                </div>
                <div class="col-3">
                    <p>Created By: {{ App\Models\User::find($data->created_by)->name }} ({{App\Models\User::find($data->created_by)->role->name }})</p>
                </div>
                <div class="col-3">
                    <p>Created at: {{ Carbon\Carbon::parse($data->created_at)->format('d F, g:i:s A') }}</p>
                </div>
            </div>

            <div class="row fs-09 font-weight-bold">
                <div class="col-12">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td>Name</td>
                                <td>{{ $data->name }}</td>
                            </tr>
                            <tr>
                                <td>Temporary ID</td>
                                <td>{{ $data->temporary_id }}</td>
                            </tr>
                            <tr>
                                <td>Admission Fee Given</td>
                                <td>{{ $data->admission_fee_given }} tk</td>
                            </tr>
                            <tr>
                                <td>Total Amount</td>
                                <td>{{ $data->admission_fee_given }} tk</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row text-center" style="padding-top: 60px;">
                <div class="col-4">
                    <!-- Empty Part -->
                </div>
                <div class="col-4 signature-placeholder">
                    <p class="signature-text fs-08">
                        {{ Auth::user()->name }} <br>
                        (Collected by)
                    </p>
                </div>
                <div class="col-4 signature-placeholder">
                    <p class="signature-text fs-08">Add name if it has to <br> (Checked by)</p>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('css')
    <style>
        .signature-text {
            border-top: 1px dotted black;
            margin-left: 40px;
            margin-right: 40px;
        }

        .invoice {
            margin-top: 10px;
            border: 1px dotted black;
        }

        .paymenyt {
            border-color: black;
            margin: 10px;
            padding: 10px;

        }

        .invoice {
            line-height: normal;
        }
    </style>
@endsection
