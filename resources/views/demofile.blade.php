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
    <link rel="stylesheet" href={{ asset('assets/admin_lte/dist/css/adminlte.min.css') }}>
    <link rel="stylesheet" href={{ asset('assets/global/app.css') }}>
    @yield('css')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="container">
        <h1>Stock Out</h1>
        <form method="POST" action="{{ route('stock.out') }}">
            @csrf
            <div class="form-group">
                <label for="user_id">User ID:</label>
                <input type="text" id="user_id" name="user_id" class="form-control" required>
            </div>
            <div id="stock_outs_container">
                <div class="stock_out_item">
                    <div class="form-group">
                        <label for="product_id_1">Product ID:</label>
                        <input type="text" id="product_id_1" name="stock_outs[0][product_id]" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="quantity_1">Quantity:</label>
                        <input type="number" id="quantity_1" name="stock_outs[0][quantity]" class="form-control" required>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-primary" id="add_stock_out">Add Stock Out</button>
            <button type="submit" class="btn btn-success">Stock Out</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var stockOutsContainer = document.getElementById('stock_outs_container');
            var addStockOutBtn = document.getElementById('add_stock_out');
            var stockOutCount = 1;

            addStockOutBtn.addEventListener('click', function() {
                var stockOutItem = document.createElement('div');
                stockOutItem.classList.add('stock_out_item');
                stockOutItem.innerHTML = `
                    <div class="form-group">
                        <label for="product_id_${stockOutCount}">Product ID:</label>
                        <input type="text" id="product_id_${stockOutCount}" name="stock_outs[${stockOutCount}][product_id]" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="quantity_${stockOutCount}">Quantity:</label>
                        <input type="number" id="quantity_${stockOutCount}" name="stock_outs[${stockOutCount}][quantity]" class="form-control" required>
                    </div>
                `;
                stockOutsContainer.appendChild(stockOutItem);
                stockOutCount++;
            });
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
</body>

</html>
