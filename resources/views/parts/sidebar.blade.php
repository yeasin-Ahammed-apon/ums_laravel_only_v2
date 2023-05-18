@php
    // $sidebar = json_decode(\App\Models\Permission::where('user_id', auth()->user()->id)->first()->sidebar, true);
    if (Auth::user()->role->name === 'superAdmin') {
        $sidebar = json_decode(superAdminSidebarOption(), true);
    }elseif (Auth::user()->role->name === 'admin') {
        $sidebar = json_decode(adminSidebarOption(), true);
    }
    elseif (Auth::user()->role->name === 'hod') {
        $sidebar = json_decode(hodSidebarOption(), true);
    }
    elseif (Auth::user()->role->name === 'cod') {
        $sidebar = json_decode(codSidebarOption(), true);
    }

@endphp
{{-- {{ dd($sidebar) }} --}}





<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('login') }}" class="brand-link">
        <img src="https://smuct.ac.bd/wp-content/uploads/2020/10/SMUCT-Logo-1-Converted.png" alt="AdminLTE Logo"
            class="brand-image img-rounded elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">SMUCT</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('users/images/' . Auth::user()->image) }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }} <br>( {{ Auth::user()->role->name }} )</a>
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
                    @if (isset($item['enabled']))
                        @if (!isset($item['route']))
                            <li class="nav-item {{ Route::is($item['sub_active_route']) ? 'menu-open' : '' }}">
                                <a href="#"
                                    class="nav-link {{ Route::is($item['sub_active_route']) ? 'active' : '' }}">
                                    <i class="{{ $item['icon'] }}"></i>
                                    <p>
                                        {{ $item['title'] }}
                                        @if (isset($item['sub_menu']))
                                            <i class="right fas fa-angle-left"></i>
                                        @endif
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    @foreach ($item['sub_menu'] as $sub_item)
                                        @if (isset($sub_item['enabled']))
                                            <li class="nav-item">
                                                <a href="{{ Route::has($sub_item['route']) ? route($sub_item['route']) : '#' }}"
                                                    class="nav-link {{ Route::is($sub_item['route']) ? 'active' : '' }}">
                                                    <i class="fa  nav-icon {{ Route::is($sub_item['route']) ? 'fa-dot-circle text-black-50' : 'fa-circle' }}"></i>
                                                    <p>{{ $sub_item['title'] }}</p>
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </li>
                        @else
                            <li class="nav-item">
                                <a href="{{ Route::has($item['route']) ? route($item['route']) : '#' }}"
                                    class="nav-link {{ Route::is($item['route']) ? 'active' : '' }}">
                                    <i class="{{ $item['icon'] }}"></i>
                                    {{ $item['title'] }}
                                </a>
                            </li>
                        @endif
                    @endif
                @endforeach
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
