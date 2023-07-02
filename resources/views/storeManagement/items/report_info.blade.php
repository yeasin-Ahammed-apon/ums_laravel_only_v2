@extends('layout')
@section('meta-tag')
    Inventory Categories list
@endsection
@section('content')
    @include('parts.title_start', [
        'title' => $title ?? 'Inventory Categories list table',
        'color' => 'card-info',
    ])
    <div class="card-body table-responsive ">
        {{-- {{ dd($datas )}} --}}
        showing {{ count($datas->items()) }} Result out of {{ $datas->total() }}
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
                @foreach ($datas as $data)
                    <tr class="text-sm">
                        {{-- <td>{{ $data->stock_in_slip_id }}</td> --}}
                        <td>{{ $data->quantity }}</td>
                        <td>{{ $data->price ?? '' }}</td>
                        <td>{{ dateTimeFormat($data->created_at) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @if ($datas->isEmpty())
            <h1 class="text-center">No Data Found</h1>
        @endif
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
    @include('parts.title_end')
@endsection
