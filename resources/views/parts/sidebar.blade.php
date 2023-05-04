@php
    // $sidebar = \App\Models\Permission::where('user_id',Auth::user()->user_id)->first();

    $sidebar = [
        [
            'title' => 'Dashboard',
            'icon' => 'fas fa-th',
            'route' => 'superAdmin.dashboard',
            'enabled' => true,
        ],
        [
            'title' => 'Profile',
            'icon' => 'fas fa-th',
            'route' => 'superAdmin.profile',
            'enabled' => true,
        ],
        [
            'title' => 'Admin',
            'icon' => 'fas fa-tachometer-alt',
            'sub_menu' => [
                [
                    'title' => 'Admin List',
                    'route' => 'superAdmin.admin.index',
                    'enabled' => true,
                ],
                [
                    'title' => 'Admin Create',
                    'route' => 'superAdmin.admin.create',
                    'enabled' => true,
                ],
            ],
            'enabled' => true,
        ],
        [
            'title' => 'Teacher',
            'icon' => 'fas fa-tachometer-alt',
            'sub_menu' => [
                [
                    'title' => 'Teacher List',
                    'route' => 'superAdmin.teacher.index',
                    'enabled' => true,
                ],
                [
                    'title' => 'Add Teacher',
                    'route' => 'superAdmin.teacher.create',
                    'enabled' => true,
                ],
            ],
            'enabled' => true,
        ],
        [
            'title' => 'Hod',
            'icon' => 'fas fa-tachometer-alt',
            'sub_menu' => [
                [
                    'title' => 'Hod List',
                    'route' => 'superAdmin.hod.index',
                    'enabled' => true,
                ],
                [
                    'title' => 'Add Hod',
                    'route' => 'superAdmin.hod.create',
                    'enabled' => true,
                ],
            ],
            'enabled' => true,
        ],
        [
            'title' => 'Cod',
            'icon' => 'fas fa-tachometer-alt',
            'sub_menu' => [
                [
                    'title' => 'Cod List',
                    'route' => 'superAdmin.cod.index',
                    'enabled' => true,
                ],
                [
                    'title' => 'Add Cod',
                    'route' => 'superAdmin.cod.create',
                    'enabled' => true,
                ],
            ],
            'enabled' => true,
        ],
        [
            'title' => 'Student',
            'icon' => 'fas fa-tachometer-alt',
            'sub_menu' => [
                [
                    'title' => 'Student List',
                    'route' => 'superAdmin.student.list',
                    'enabled' => true,
                ],
            ],
            'enabled' => true,
        ],
        [
            'title' => 'Notification',
            'icon' => 'fas fa-tachometer-alt',
            'sub_menu' => [
                [
                    'title' => 'Student List',
                    'route' => 'superAdmin.notification.superAdmin',
                    'enabled' => true,
                ],
            ],
            'enabled' => true,
        ],
    ];
    $sidebar = json_encode($sidebar);
    $sidebar = json_decode($sidebar, true);

@endphp
{{-- {{ dd($sidebar) }} --}}





<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link">
        <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                @foreach ($sidebar as $item)
                    @if ($item['enabled'])
                        <li class="nav-item">
                            @if (!isset($item['route']))
                                <a href="#" class="nav-link">
                                    <i class="{{ $item['icon'] }}"></i>
                                    <p>
                                        {{ $item['title'] }}
                                        @if (isset($item['sub_menu']))
                                            <i class="right fas fa-angle-left"></i>
                                        @endif
                                    </p>
                                </a>
                            @else
                                <a href="{{ Route::has($item['route']) ? route($item['route']) : '#' }}"
                                    class="nav-link">
                                    <i class="{{ $item['icon'] }}"></i>
                                    {{ $item['title'] }}
                                </a>
                            @endif
                            @if (isset($item['sub_menu']))
                                <ul class="nav nav-treeview">
                                    @foreach ($item['sub_menu'] as $sub_item)
                                        @if ($sub_item['enabled'])
                                            <li class="nav-item">
                                                <a href="{{ Route::has($sub_item['route']) ? route($sub_item['route']) : '#' }}"
                                                    class="nav-link">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>{{ $sub_item['title'] }}</p>
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endif
                @endforeach
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
