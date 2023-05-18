@extends('layout')
{{-- @section('breadcrumb')
    @include('parts.breadcrumb', [
        'page_title' => 'Admin list Page',
        'links' => [
            [
                'title' => 'dashboard',
                'route' => 'hod.admin.dashboard',
                'enable' => true,
            ],
            [
                'title' => 'Admin List',
                'route' => 'hod.admin.index',
                'enable' => false,
            ],
        ],
    ])
@endsection --}}
@section('meta-tag')
    Edit Admin || {{ auth()->user()->role->name }}
@endsection
@section('breadcrumb')
    @include('parts.breadcrumb')
@endsection
@section('css')
    <style>
        .box {
            color: black;
            text-decoration: none;
        }

        .info-box:hover,
        .info-box-text:hover {
            color: white;
            background: rgb(45, 45, 151);
        }

        .dashboard_icon_color {
            color: rgb(255, 255, 255)
        }

        @media (max-width: 767.98px) {
            .border-right {
                border-right:none !important;
            }
        }
    </style>
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
        <h5 class="text-left pb-2" style="border-bottom: 4px solid rgba(7, 10, 177, 0.562)">Create User</h5>
        <div class="row">
            <a href="{{ route('hod.cod.create') }}" class=" col-12 col-sm-6 col-md-3 box">
                <div class="info-box ">
                    <span class="info-box-icon elevation-1" style="background: {{ random_rgb_color() }}">
                        <i class="fas fa-user-plus dashboard_icon_color"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{ Str::upper('cod') }} Create</span>
                    </div>
                </div>
            </a>
            <a href="{{ route('hod.teacher.create') }}" class=" col-12 col-sm-6 col-md-3 box">
                <div class="info-box ">
                    <span class="info-box-icon elevation-1" style="background: {{ random_rgb_color() }}">
                        <i class="fas fa-user-plus dashboard_icon_color"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{ Str::upper('teacher') }} Create</span>
                    </div>
                </div>
            </a>
        </div>
        <h5 class="text-left pb-2" style="border-bottom: 4px solid rgba(7, 10, 177, 0.562)">User List</h5>
        <div class="row">
            <a href="{{ route('hod.cod.index') }}" class=" col-12 col-sm-6 col-md-3 box">
                <div class="info-box ">
                    <span class="info-box-icon elevation-1" style="background: {{ random_rgb_color() }}">

                        <i class="fas fa-list dashboard_icon_color"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{ Str::upper('cod') }} List</span>
                    </div>
                </div>
            </a>
            <a href="{{ route('hod.teacher.index') }}" class=" col-12 col-sm-6 col-md-3 box">
                <div class="info-box ">
                    <span class="info-box-icon elevation-1" style="background: {{ random_rgb_color() }}">
                        <i class="fas fa-list dashboard_icon_color"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{ Str::upper('teacher') }} List</span>
                    </div>
                </div>
            </a>
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
