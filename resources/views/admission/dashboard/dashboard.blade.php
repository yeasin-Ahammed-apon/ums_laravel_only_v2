@extends('layout')
@section('meta-tag')
    Edit Admin || {{ auth()->user()->role->name }}
@endsection

@section('css')
@endsection
@section('content')
    @include('parts.title_start', [
        'title' => $title ?? 'Important Link',
        'color' => 'card-primary',
    ])
    <div>
        <h5 class="text-left pb-2" style="border-bottom: 4px solid rgba(7, 10, 177, 0.562)">Notifications</h5>
        <div class="row">
            <a href="{{ route('hod.notification.cod', ['seen' => '0']) }}" class=" col-12 col-sm-6 col-md-3 box">
                <div class="info-box ">
                    <span class="info-box-icon elevation-1" style="background: rgb(0, 146, 127)">
                        <i class="fas fa-envelope dashboard_icon_color"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{ Str::upper('cod') }} Notification</span>
                        <span class="info-box-number">
                            {{ count(App\Models\EmployeesNotification::where('seen', 0)->where('role', 'cod')->get()) }}
                        </span>
                    </div>
                </div>
            </a>
            <a href="{{ route('hod.notification.teacher', ['seen' => '0']) }}" class=" col-12 col-sm-6 col-md-3 box">
                <div class="info-box ">
                    <span class="info-box-icon elevation-1" style="background: rgb(0, 146, 127)">
                        <i class="fas fa-envelope dashboard_icon_color"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{ Str::upper('teacher') }} Notification</span>
                        <span class="info-box-number">
                            {{ count(App\Models\EmployeesNotification::where('seen', 0)->where('role', 'teacher')->get()) }}
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
                        <th>Total admit</th>
                        <th>Semester</th>
                        <th>Start</th>
                        <th>End</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (\App\Models\Batch::where('status', 0)->count() !== 0)
                        @foreach (\App\Models\Batch::where('status', 0)->get() as $data)
                            <td class="text-sm text-bolder">{{ $data->department->name }}</td>
                            <td>{{ $data->total_student }}</td>
                            <td>{{ $data->total_semester }}</td>
                            <td>{{ $data->admission_start }}</td>
                            <td>{{ $data->admission_end }}</td>
                            <td>
                                <a href="{{ route('admission.batch.info', $data->id) }}" class="btn btn-sm mt-1 mb-1 btn-info">Batch Info</a>
                            </td>
                            </tr>
                        @endforeach
                    @else
                        <h1 class="text-center text-black-50">No Data Found</h1>
                    @endif
                </tbody>
            </table>
            {{-- @if ($datas->isEmpty())

        @endif --}}
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