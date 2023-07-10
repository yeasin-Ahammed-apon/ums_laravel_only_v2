<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('institutionImage/ums.png') }}" sizes="32x32">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('meta-tag') || UMS</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="{{ asset('fonts/fonts.css') }}">
    {{-- sweet alert --}}
    <link rel="stylesheet" href="{{ asset('assets/admin_lte/plugins/sweetalert2/sweetalert2.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href={{ asset('assets/admin_lte/plugins/fontawesome-free/css/all.min.css') }}>
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href={{ asset('assets/admin_lte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}>
    <link rel="stylesheet" href={{ asset('assets/admin_lte/plugins/toastr/toastr.min.css') }}>
    <!-- Theme style -->
    <link rel="stylesheet" href={{ asset('assets/admin_lte/dist/css/adminlte.min.main.css') }}>
    {{-- <link rel="stylesheet" href={{ asset('assets/admin_lte/dist/css/adminlte.min.v1.css') }}> --}}
    <link rel="stylesheet" href={{ asset('assets/global/app.css') }}>
    @yield('css')
    <style>
        #loading-screen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #000000e3;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div id="loading-screen">
        <div class="d-flex justify-content-center">
            <div class="spinner-border text-primary" style="width: 15rem; height: 15rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </div>
    <div class="wrapper">
        @include('parts.navbar')
        @include('parts.sidebar')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="background-color: rgba(66, 1, 245, 0.192)">
            <!-- Content Header (Page header) -->
            @yield('breadcrumb')
            <!-- Main content -->
            <section class="content pb-1 ml-1 mr-1" id="animatedBox">
                <div class="row">
                    <div class="col-12">
                        <!-- Default box -->
                        @yield('content')
                        <!-- /.card -->
                    </div>
                </div>

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        @include('parts.footer')
    </div>
    <script>
        // -------------------------loading screen-----------------
        // Fade in the loading screen
        window.addEventListener('DOMContentLoaded', function() {
            var loadingScreen = document.getElementById('loading-screen');
            loadingScreen.style.opacity = '0';
            loadingScreen.style.transition = 'opacity 0.9s';
            setTimeout(function() {
                loadingScreen.style.opacity = '0';
                loadingScreen.style.transition = 'opacity 0.1s';
            }, 1000);
        });
        // Fade out and hide the loading screen when the page finishes loading
        window.addEventListener('load', function() {
            var loadingScreen = document.getElementById('loading-screen');
            loadingScreen.style.opacity = '0';

            setTimeout(function() {
                loadingScreen.style.display = 'none';
            }, 500);
        });
    </script>
    {{-- helper functions --}}
    <script src="{{ asset('js/helper.js') }}"></script>
    {{-- colorSettings --}}
    <script src="{{ asset('js/colorSettings.js') }}"></script>

    <script src="{{ asset('assets/admin_lte/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    {{-- popper --}}
    <script src="{{ asset('assets/admin_lte/plugins/popper/umd/popper.min.js') }}"></script>
    <!-- jQuery -->
    <script src={{ asset('assets/admin_lte/plugins/jquery/jquery.min.js') }}></script>
    <script src={{ asset('assets/admin_lte/plugins/toastr/toastr.min.js') }}></script>
    <!-- Bootstrap 4 -->
    <script src={{ asset('assets/admin_lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}></script>
    <!-- overlayScrollbars -->
    <script src={{ asset('assets/admin_lte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}></script>
    <!-- AdminLTE App -->
    <script src={{ asset('assets/admin_lte/dist/js/adminlte.min.js') }}></script>

    @if (session('alert'))
        <script>
            Swal.fire({
                title: "{{ session('alert')['title'] }}",
                text: "{{ session('alert')['text'] }}",
                icon: "{{ session('alert')['icon'] }}",
                // confirmButtonText: 'done'
            })
        </script>
    @endif
    @yield('scripts')
</body>

</html>
