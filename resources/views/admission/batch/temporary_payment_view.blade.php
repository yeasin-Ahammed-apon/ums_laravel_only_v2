@extends('layout')
@section('meta-tag')
    Temporary Student Detail || {{ auth()->user()->role->name }}
@endsection
@section('content')
    <link rel="stylesheet" href="{{ asset('assets/admin_lte/dist/css/adminlte.min.css') }}">
    <div class="container-fluid bg-white mt-3">
        <div class="border-bottom border-dark mb-2">
            {{-- ------------------------- part 1------------------------------------------------------------- --}}
        <div class=" row">
            <div class="col-2 m-auto">
                <img src="{{ asset('institutionImage/image.png') }}" alt="" width="50%">
            </div>
            <div class="col-8 text-center">
                <span class="text-bold">shanto mariam university of creative technology</span> <br>
                <span>Plot# 06, Road/Avenue# 06, Sector# 17/H-1, Uttara, Dhaka-1230</span><br>
                <span class="text-sm">Money Receipt</span><br>
                <span class="text-xs">Student Copy</span>

            </div>
            <div class="col-2 m-auto">
                <img src="{{ asset('institutionImage/image.png') }}" alt="" width="50%">
            </div>
        </div>
        {{-- ------------------------- part 2------------------------------------------------------------- --}}
        <div class="row text-center">
            <div class="col-4">
                <span class="text-xs">Printed at: {{ Carbon\Carbon::now()->format('Y/m/d h:i A') }}</span>
            </div>
            <div class="col-4">
                <span class="text-xs">SACNT/000/000000</span>
            </div>
            <div class="col-4">
                <span class="text-xs">Printed by: {{Auth::user()->name }}</span>
            </div>
        </div>
        </div>

    </div>
    {{-- out of count --}}
    <a href="{{ route('admission.batch.temporary.view.student.print', $temporaryStudent->id) }}" class="btn btn-danger"> <i
            class="fa fa-eye" aria-hidden="true"></i></a>
@endsection
