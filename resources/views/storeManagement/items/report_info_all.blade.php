@extends('layout')
@section('meta-tag')
    Inventory Categories list
@endsection
@section('content')
    @include('parts.title_start', [
        'title' => $title ?? 'Inventory Categories list table',
        'color' => 'card-info',
    ])
    <div class="row">
        {{-- in start --}}
        <div class="col-4">
            <div class="card-body table-responsive ">
                {{-- {{ dd($datas )}} --}}
                showing {{ count($stockIn->items()) }} Result out of {{ $stockIn->total() }}
                <table class="table  table-bordered border-top">
                    <thead>
                        <tr class="text-sm">
                            {{-- <th>stock_in_slip_id</th> --}}
                            <th>quantity</th>
                            <th>price</th>
                            <th>created at</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stockIn as $data)
                            <tr class="text-sm">
                                {{-- <td>{{ $data->stock_in_slip_id }}</td> --}}
                                <td>{{ $data->quantity }}</td>
                                <td>{{ $data->price ?? '' }}</td>
                                <td>{{ dateTimeFormat($data->created_at) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @if ($stockIn->isEmpty())
                    <h1 class="text-center">No Data Found</h1>
                @endif
            </div>
            <div class="card-footer clearfix">
                <nav aria-label="Page navigation example">
                    <div class="pagination">
                        {{ $stockIn->appends(['stock_in'=>$stockIn->currentPage()])->links('pagination::bootstrap-4') }}
                    </div>
                </nav>
            </div>
        </div>
        {{-- Out start --}}

            <div class="col-4">
                <div class="card-body table-responsive ">
                    {{-- {{ dd($datas )}} --}}
                    showing {{ count($stockOut->items()) }} Result out of {{ $stockOut->total() }}
                    <table class="table  table-bordered border-top">
                        <thead>
                            <tr class="text-sm">
                                {{-- <th>stock_in_slip_id</th> --}}
                                <th>quantity</th>
                                <th>price</th>
                                <th>created at</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($stockOut as $data)
                                <tr class="text-sm">
                                    {{-- <td>{{ $data->stock_in_slip_id }}</td> --}}
                                    <td>{{ $data->quantity }}</td>
                                    <td>{{ $data->price ?? '' }}</td>
                                    <td>{{ dateTimeFormat($data->created_at) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if ($stockOut->isEmpty())
                        <h1 class="text-center">No Data Found</h1>
                    @endif
                </div>
                <div class="card-footer clearfix">
                    <nav aria-label="Page navigation example">
                        <div class="pagination">
                            {{ $stockOut->appends(['stock_out'=>$stockOut->currentPage()])->links('pagination::bootstrap-4') }}
                        </div>
                    </nav>
                </div>
            </div>

        {{-- return start --}}

            <div class="col-4">
                <div class="card-body table-responsive ">
                    {{-- {{ dd($datas )}} --}}
                    showing {{ count($stockReturn->items()) }} Result out of {{ $stockReturn->total() }}
                    <table class="table  table-bordered border-top">
                        <thead>
                            <tr class="text-sm">
                                {{-- <th>stock_in_slip_id</th> --}}
                                <th>quantity</th>
                                <th>price</th>
                                <th>created at</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($stockReturn as $data)
                                <tr class="text-sm">
                                    {{-- <td>{{ $data->stock_in_slip_id }}</td> --}}
                                    <td>{{ $data->quantity }}</td>
                                    <td>{{ $data->price ?? '' }}</td>
                                    <td>{{ dateTimeFormat($data->created_at) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if ($stockReturn->isEmpty())
                        <h1 class="text-center">No Data Found</h1>
                    @endif
                </div>
                <div class="card-footer clearfix">
                    <nav aria-label="Page navigation example">
                        <div class="pagination">
                            {{ $stockReturn->appends(['stock_return'=>$stockReturn->currentPage()])->links('pagination::bootstrap-4') }}
                        </div>
                    </nav>
                </div>
            </div>

    </div>
    @include('parts.title_end')
@endsection
