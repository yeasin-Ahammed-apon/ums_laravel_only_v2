<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="https://smuct.ac.bd/wp-content/uploads/2021/05/cropped-icon-32x32.png" sizes="32x32">
    <title>@yield('title')</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href={{ asset('assets/admin_lte/plugins/fontawesome-free/css/all.min.css') }}>
    <link rel="stylesheet" href={{ asset('assets/admin_lte/dist/css/adminlte.min.css') }}>
    <link rel="stylesheet" href={{ asset('assets/global/app.css') }}>
    @yield('css')
</head>

<body>

        @yield('invoice')
    @yield('scripts')
    <script>
        // window.print();
    </script>
</body>

</html>
