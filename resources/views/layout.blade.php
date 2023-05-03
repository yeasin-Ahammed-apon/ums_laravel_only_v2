<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('meta-tag') || UMS</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    {{-- sweet alert --}}
    <link rel="stylesheet" href="{{ asset('assets/admin_lte/plugins/sweetalert2/sweetalert2.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href={{ asset('assets/admin_lte/plugins/fontawesome-free/css/all.min.css') }}>
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href={{ asset('assets/admin_lte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}>
    <!-- Theme style -->
    <link rel="stylesheet" href={{ asset('assets/admin_lte/dist/css/adminlte.min.css') }}>
    <link rel="stylesheet" href={{ asset('assets/global/app.css') }}>

</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <!-- Site wrapper -->
    <div class="wrapper">
        @include('parts.navbar')
        @include('parts.sidebar')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            @yield('breadcrumb')
            <!-- Main content -->
            <section class="content">
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
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    {{-- sweet alert --}}
    <script src="{{ asset('assets/admin_lte/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    {{-- popper --}}
    <script src="{{ asset('assets/admin_lte/plugins/popper/umd/popper.min.js') }}"></script>
    <!-- jQuery -->
    <script src={{ asset('assets/admin_lte/plugins/jquery/jquery.min.js') }}></script>
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
