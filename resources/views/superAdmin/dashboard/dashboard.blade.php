@extends('layout')
@section('meta-tag')
    Dashboard
@endsection
@section('content')
    @include('parts.title_start', [
        'title' => $title ?? 'Important Link',
        'color' => 'card-primary',
    ])
    <div>
        <h5 class="text-left pb-2" style="border-bottom: 4px solid rgba(7, 10, 177, 0.562)">Notifications</h5>
        <div class="row">
            <a href="{{ route('superAdmin.notification.admin', ['seen' => '0']) }}" class=" col-12 col-sm-6 col-md-3 box">
                <div class="info-box ">
                    <span class="info-box-icon elevation-1" style="background: rgb(13, 199, 13)">
                        <i class="fas fa-envelope dashboard_icon_color"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{ Str::upper('Admin') }} Notification</span>
                        <span class="info-box-number">
                            {{ count(App\Models\EmployeesNotification::where('seen', 0)->where('role', 'admin')->get()) }}
                        </span>
                    </div>
                </div>
            </a>
            <a href="{{ route('superAdmin.notification.hod', ['seen' => '0']) }}" class=" col-12 col-sm-6 col-md-3 box">
                <div class="info-box ">
                    <span class="info-box-icon elevation-1" style="background: rgb(218, 25, 25)">
                        <i class="fas fa-envelope dashboard_icon_color"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{ Str::upper('Hod') }} Notification</span>
                        <span class="info-box-number">
                            {{ count(App\Models\EmployeesNotification::where('seen', 0)->where('role', 'hod')->get()) }}
                        </span>
                    </div>
                </div>
            </a>
            <a href="{{ route('superAdmin.notification.cod', ['seen' => '0']) }}" class=" col-12 col-sm-6 col-md-3 box">
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
            <a href="{{ route('superAdmin.notification.account', ['seen' => '0']) }}"
                class=" col-12 col-sm-6 col-md-3 box">
                <div class="info-box ">
                    <span class="info-box-icon elevation-1" style="background: rgb(255, 14, 175)">
                        <i class="fas fa-envelope dashboard_icon_color"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{ Str::upper('account') }} Notification</span>
                        <span class="info-box-number">
                            {{ count(App\Models\EmployeesNotification::where('seen', 0)->where('role', 'account')->get()) }}
                        </span>
                    </div>
                </div>
            </a>
            <a href="{{ route('superAdmin.notification.admission', ['seen' => '0']) }}"
                class=" col-12 col-sm-6 col-md-3 box">
                <div class="info-box ">
                    <span class="info-box-icon elevation-1" style="background: rgb(232, 255, 26)">
                        <i class="fas fa-envelope dashboard_icon_color"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{ Str::upper('admission') }} Notification</span>
                        <span class="info-box-number">
                            {{ count(App\Models\EmployeesNotification::where('seen', 0)->where('role', 'admission')->get()) }}
                        </span>
                    </div>
                </div>
            </a>
        </div>
        <h5 class="text-left pb-2" style="border-bottom: 4px solid rgba(7, 10, 177, 0.562)">Create User</h5>
        <div class="row">
            <a href="{{ route('superAdmin.admin.create') }}" class=" col-12 col-sm-6 col-md-3 box">
                <div class="info-box ">
                    <span class="info-box-icon elevation-1" style="background: {{ random_rgb_color() }}">
                        <i class="fas fa-user-plus dashboard_icon_color"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{ Str::upper('Admin') }} Create</span>
                    </div>
                </div>
            </a>
            <a href="{{ route('superAdmin.hod.create') }}" class=" col-12 col-sm-6 col-md-3 box">
                <div class="info-box ">
                    <span class="info-box-icon elevation-1" style="background: {{ random_rgb_color() }}">
                        <i class="fas fa-user-plus dashboard_icon_color"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{ Str::upper('Hod') }} Create</span>
                    </div>
                </div>
            </a>
            <a href="{{ route('superAdmin.cod.create') }}" class=" col-12 col-sm-6 col-md-3 box">
                <div class="info-box ">
                    <span class="info-box-icon elevation-1" style="background: {{ random_rgb_color() }}">
                        <i class="fas fa-user-plus dashboard_icon_color"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{ Str::upper('cod') }} Create</span>
                    </div>
                </div>
            </a>
            <a href="{{ route('superAdmin.account.create') }}" class=" col-12 col-sm-6 col-md-3 box">
                <div class="info-box ">
                    <span class="info-box-icon elevation-1" style="background: {{ random_rgb_color() }}">
                        <i class="fas fa-user-plus dashboard_icon_color"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{ Str::upper('account') }} Create</span>
                    </div>
                </div>
            </a>
            <a href="{{ route('superAdmin.admission.create') }}" class=" col-12 col-sm-6 col-md-3 box">
                <div class="info-box ">
                    <span class="info-box-icon elevation-1" style="background: {{ random_rgb_color() }}">
                        <i class="fas fa-user-plus dashboard_icon_color"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{ Str::upper('admission') }} Create</span>
                    </div>

                </div>
            </a>
        </div>
        <h5 class="text-left pb-2" style="border-bottom: 4px solid rgba(7, 10, 177, 0.562)">User List</h5>
        <div class="row">
            <a href="{{ route('superAdmin.admin.index') }}" class=" col-12 col-sm-6 col-md-3 box">
                <div class="info-box ">
                    <span class="info-box-icon elevation-1" style="background: {{ random_rgb_color() }}">

                        <i class="fas fa-list dashboard_icon_color"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{ Str::upper('Admin') }} List</span>
                    </div>
                </div>
            </a>
            <a href="{{ route('superAdmin.hod.index') }}" class=" col-12 col-sm-6 col-md-3 box">
                <div class="info-box ">
                    <span class="info-box-icon elevation-1" style="background: {{ random_rgb_color() }}">

                        <i class="fas fa-list dashboard_icon_color"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{ Str::upper('Hod') }} List</span>
                    </div>
                </div>
            </a>
            <a href="{{ route('superAdmin.cod.index') }}" class=" col-12 col-sm-6 col-md-3 box">
                <div class="info-box ">
                    <span class="info-box-icon elevation-1" style="background: {{ random_rgb_color() }}">

                        <i class="fas fa-list dashboard_icon_color"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{ Str::upper('cod') }} List</span>
                    </div>
                </div>
            </a>
            <a href="{{ route('superAdmin.account.index') }}" class=" col-12 col-sm-6 col-md-3 box">
                <div class="info-box ">
                    <span class="info-box-icon elevation-1" style="background: {{ random_rgb_color() }}">

                        <i class="fas fa-list dashboard_icon_color"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{ Str::upper('account') }} List</span>
                    </div>
                </div>
            </a>
            <a href="{{ route('superAdmin.admission.index') }}" class=" col-12 col-sm-6 col-md-3 box">
                <div class="info-box ">
                    <span class="info-box-icon elevation-1" style="background: {{ random_rgb_color() }}">

                        <i class="fas fa-list dashboard_icon_color"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{ Str::upper('admission') }} List</span>
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
