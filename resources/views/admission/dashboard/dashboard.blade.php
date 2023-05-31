@extends('layout')
@section('meta-tag')
    Dashboard || {{ auth()->user()->role->name }}
@endsection
@section('css')
@endsection
@section('content')
    @include('parts.title_start', [
        'title' => $title ?? 'Important Link',
        'color' => 'card-primary',
    ])
    <div>
        <div class="row">
            <a href="{{ route('admission.batch.open.list') }}" class=" col-12 col-sm-6 col-md-3 box">
                <div class="info-box ">
                    <span class="info-box-icon elevation-1" style="background: {{ random_rgb_color() }}">
                        <i class="fas fa-envelope dashboard_icon_color"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text text-xs"> Admission Open Batches</span>
                        <span class="info-box-number">
                            {{ count(App\Models\Batch::where('status', 0)->get()) }}
                        </span>
                    </div>
                </div>
            </a>
            <a href="{{ route('admission.batch.temporary.list.student') }}" class=" col-12 col-sm-6 col-md-3 box">
                <div class="info-box ">
                    <span class="info-box-icon elevation-1" style="background: {{ random_rgb_color() }}">
                        <i class="fas fa-envelope dashboard_icon_color"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text text-xs">Unactive Temporary student</span>
                        <span class="info-box-number">
                            {{ count(App\Models\TemporaryStudent::where('status',1)->get()) }}
                        </span>
                    </div>
                </div>
            </a>
        </div>
    </div>
    @include('parts.title_end')
    {{------------------------------------------ Admission Open Batch ------------------------------------------------------------- --}}
    @include('parts.title_start', [
        'title' => $title ?? 'Admission Open Batch',
        'color' => 'card-primary',
    ])
    <div class="card shadow ">
        <div class="card-header">
            <h3 class="card-title"> List</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive ">
            <table class="table  table-bordered border-top">
                <thead>
                    <tr class=" text-sm">
                        <th>Name</th>
                        <th>Batch</th>
                        <th class="text-xs">Admit</th>
                        <th class="text-xs">Semester</th>
                        <th>Start</th>
                        <th>End</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>

                        @foreach ($datas as $data)
                            <td class="text-sm text-bolder">{{ $data->department->name }}</td>
                            <td>{{ ordinalFormat($data->batch_number) }}</td>
                            <td>{{ $data->total_student }}</td>
                            <td>{{ $data->total_semester }}</td>
                            <td >{{ $data->admission_start }}</td>
                            <td>{{ $data->admission_end }}</td>
                            <td>
                                <a href="{{ route('admission.batch.info', $data->id) }}" class="btn btn-sm mt-1 mb-1 btn-info">
                                   <i class="fa fa-info-circle" aria-hidden="true"></i> Batch Info</a>
                                <a href="{{ route('admission.batch.temporary.add.student', $data->id) }}" class="btn btn-sm mt-1 mb-1 btn-primary">
                                    <i class="fa fa-plus" aria-hidden="true"></i> Add</a>
                            </td>
                            </tr>
                        @endforeach

                </tbody>
            </table>
            @if ($datas->isEmpty())
            <h1 class="text-center text-black-50">No Data Found</h1>
        @endif
        </div>
    </div>
    @include('parts.title_end')

    <div class="card-footer m-auto shadow mb-5" style="background: rgb(87, 87, 87);color:white">
        <div class="row">
            <div class="col-sm-3 col-12">
                <div class="description-block border-right">
                    {{-- <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 17%</span> --}}
                    <h5 class="description-header"> {{ App\Models\User::count() }} </h5>
                    <span class="description-text">Total User</span>
                </div>
                <!-- /.description-block -->
            </div>
            <div class="col-sm-3 col-12">
                <div class="description-block border-right">
                    {{-- <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 17%</span> --}}
                    <h5 class="description-header"> {{ App\Models\User::where('status', 1)->count() }} </h5>
                    <span class="description-text">Total Active User</span>
                </div>
                <!-- /.description-block -->
            </div>
            <div class="col-sm-3 col-12">
                <div class="description-block border-right">
                    {{-- <span class="description-percentage text-warning"><i class="fas fa-caret-left"></i> 0%</span> --}}
                    <h5 class="description-header">
                        {{ App\Models\User::where('role_id', App\Models\Role::where('name', 'student')->first()->id)->where('status', 1)->count() }}
                    </h5>
                    <span class="description-text">Total Active student</span>
                </div>
                <!-- /.description-block -->
            </div>
            <!-- /.col -->
            @php
                // Get the current year
                $currentYear = Carbon\Carbon::now()->year;
                // Set the start and end dates of the year
                $startDate = Carbon\Carbon::createFromDate($currentYear, 1, 1)->startOfDay();
                $endDate = Carbon\Carbon::createFromDate($currentYear, 12, 31)->endOfDay();
                // Count the number of users created between the start and end dates
                $userCount = App\Models\User::whereBetween('created_at', [$startDate, $endDate])
                    ->where('role_id', App\Models\Role::where('name', 'student')->first()->id)
                    ->count();
            @endphp
            <div class="col-sm-3 col-12">
                <div class="description-block ">
                    {{-- <span class="description-percentage text-warning"><i class="fas fa-caret-left"></i> 0%</span> --}}
                    <h5 class="description-header">
                        {{ $userCount }}
                    </h5>
                    <span class="description-text">This year total admitted student </span>
                </div>
                <!-- /.description-block -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
@endsection
