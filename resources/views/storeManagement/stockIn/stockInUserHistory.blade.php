@extends('layout')
@section('meta-tag')
    Inventory Categories list
@endsection
@section('content')
    @include('parts.title_start', [
        'title' => $title ?? 'Inventory Categories list table',
        'color' => 'card-info',
    ])
    
    <!-- /.card-header -->
    <div class="card-body table-responsive ">
        showing {{ count($datas->items()) }} Result out of {{ $datas->total() }}
        <table class="table  table-bordered border-top">
            <thead>
                <tr class="text-sm">
                    <th>user Name</th>
                    <th>Created _at</th>
                    <th>slip number</th>
                    <th>Items</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $data)
                    <tr class="text-sm">
                        <td>{{ $user->name }}</td>
                        <td>{{ dateTimeFormat($data->created_at) }}</td>
                        <td>{{ $data->slip_number }}</td>
                        <td class="p-1 bg-info" style="border: 2px solid black">
                            <ul class="p-0">
                                @foreach ($data->inventoryStockInHistory as $item)
                                    <li class=" p-0 border-bottom border-white" style="list-style-type:none">
                                        {{ $item->inventory_item->name }} [Q:{{ $item->quantity }}]
                                        [P:{{ $item->price }}]</li>
                                    {{-- <li>{{ $item->quantity }}</li> --}}
                                @endforeach
                            </ul>
                        </td>
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
@section('scripts')
    @include('parts.page_number_set_js', ['page_number_url' => Route::currentRouteName()])
@endsection
