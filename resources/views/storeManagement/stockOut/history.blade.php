@extends('layout')
@section('meta-tag')
    Inventory Categories list
@endsection
@section('content')
    @include('parts.title_start', [
        'title' => $title ?? 'Inventory Categories list table',
        'color' => 'card-info',
    ])
    <div class="card shadow ">
        <div class="card-header">
            <h3 class="card-title"> List</h3>
            <div class="card-tools">
                <form action="{{ route(Auth::user()->role->name . '.inventory.item.stock_out_history') }}" method="GET">
                    @csrf
                    <div class="input-group input-group-sm">
                        @include('parts.card_tool_option_per_page', ['pageData' => $pageData])
                        <input type="text" name="search" class=" mt-1 mb-1 form-control float-right" placeholder="Search">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-sm mt-1 mb-1 btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                            <a
                                href="{{ route(Auth::user()->role->name . '.inventory.item.stock_out_history') }}"class="btn btn-sm mt-1 mb-1 btn-primary  ml-2"><i
                                    class="fa fa-plus" aria-hidden="true"></i> stock_in</a>
                            <a
                                href="{{ route(Auth::user()->role->name . '.inventory.item.stock_out_history') }}"class="btn btn-sm mt-1 mb-1 btn-default  ml-2">All
                                History</a>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="row">
        <div class="card-body table-responsive col-sm-8 col-12">
            {{-- {{ dd($datas )}} --}}
            showing {{ count($datas->items()) }} Result out of {{ $datas->total() }}
            <table class="table  table-bordered border-top">
                <thead>
                    <tr class="text-sm">
                        <th>Name</th>
                        <th>Slip</th>
                        <th>Date</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $data)
                        <td>{{ $data->user->name }}</td>
                        <td>{{ $data->slip_number }}</td>
                        <td>{{ dateTimeFormat($data->created_at) }}</td>
                        <td class="text-center">
                            {{-- info --}}
                            <button class="btn btn-sm mt-1 mb-1 btn-info" onclick="stockOuthistory(this,{{ $data->id }})"><i
                                    class="fas fa-info-circle "></i> </button>
                            {{-- edit --}}
                            {{-- <a href="{{ route(Auth::user()->role->name . '.inventory.item.edit', $data->id) }}"
                                class="btn btn-sm mt-1 mb-1 btn-primary edit"><i class="fa fa-cogs"
                                    aria-hidden="true"></i></a> --}}
                            {{-- delete --}}
                            {{-- <form action="{{ route(Auth::user()->role->name . '.inventory.item.destroy', $data->id) }}"
                                method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm mt-1 mb-1 btn-danger delete"
                                    onclick="disableButton(this)"><i class="fa fa-trash" aria-hidden="true"></i> </button>
                            </form> --}}
                        </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if ($datas->isEmpty())
                <h1 class="text-center">No Data Found</h1>
            @endif
        </div>
        <div class="card-body col-sm-4 col-12 table-responsive">
            <br>
            <div class="text-center ">
                <div class="spinner-border mt-5 text-primary" id="loading_icon" style="width: 3rem; height: 3rem;"
                    role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                {{-- <i id="loading_icon" class="fa fa-spinner fa-spin fa-5x pt-5"></i> --}}
            </div>
            <table class="table">
                <tbody class="slip_wise_info_list">

                </tbody>
            </table>

        </div>
    </div>
    {{-- {{ dd($datas) }} --}}
    <!-- /.card-body -->
    <div class="card-footer clearfix">
        <nav aria-label="Page navigation example">
            <div class="pagination">
                {{ $datas->links('pagination::bootstrap-4') }}
            </div>
        </nav>
    </div>
    </div>

    @include('parts.title_end')
@endsection
@section('scripts')
    @include('parts.page_number_set_js', ['page_number_url' => Route::currentRouteName()])
    <script>
        let infoDiv = $('.slip_wise_info_list');
        infoDiv.html(`
        <div class="text-center">
            <i class=" fas fa-info-circle fa-3x"></i>
        </div>
        <h4 class="text-center">Click Table information Icon For Details</h4>`);
        let loadingIcon = $('#loading_icon');
        loadingIcon.hide()

        function stockOuthistory(button, id) {
            setTimeout(() => {
                button.disabled = true;
            }, 1);
            setTimeout(() => {
                button.disabled = false;
            }, 1000);
            infoDiv.html('')
            loadingIcon.show()
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            $.ajax({
                url: "{{ route(Auth::user()->role->name . '.inventory.item.stock_out_history_info') }}",
                method: 'GET',
                // dataType: 'json',
                data: {
                    id
                },
                success: function(datas) {
                    loadingIcon.hide()
                    if (datas.length !== 0) {
                        let resultItem = `
                                    <tr class="text-sm bg-info">
                                        <td>Name</td>
                                        <td>Code</td>
                                        <td>Quantity</td>

                                    </tr>`;
                        datas.forEach(item => {
                            resultItem += `
                                    <tr class="text-sm">
                                        <td>${item.inventory_item.name}</td>
                                        <td>${item.inventory_item.code}</td>
                                        <td>${item.quantity}</td>
                                    </tr>
                                `;
                        });

                        infoDiv.append(resultItem);


                    } else {
                        infoDiv.html(`<h4 class="text-center">No data found</h4>`);
                    }
                },
                error: function(error) {
                    loadingIcon.hide(); // Hide the loading icon
                    console.log(error);
                }
            });
        }
    </script>
@endsection
