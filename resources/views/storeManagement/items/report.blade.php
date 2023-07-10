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
        <table class="table  table-bordered border-top">
            <thead>
                <tr class="text-sm">
                    <th>Name</th>
                    <th>Code</th>
                    <th>Categories</th>
                    <th>1 month report</th>
                    <th>3 month report</th>
                    <th>6 month report</th>
                    <th>1 year report</th>
                    <th>2 year report</th>
                    <th>all time report</th>

                </tr>
            </thead>
            <tbody>
                {{-- stock_in --}}
                <tr class="text-sm">
                    <td>{{ $data->name }}</td>
                    <td>{{ $data->code }}</td>
                    <td>{{ $data->inventory_categories->name }}</td>
                    @foreach([ 30 =>'1M', 90=>'3 M',180=> '6 M',365 =>'1 Y',730 =>'2 Y',0 =>'All'] as $index => $duration)
                        <td class="text-center text-xs">
                            <a href="{{ route(Auth::user()->role->name . '.inventory.item.report_info', [$data->id,$index,'stock_in']) }}"
                                class="btn btn-sm mt-1 mb-1 btn-success">
                                {{ $duration }} in
                             </a>
                        </td>
                    @endforeach
                </tr>
                {{-- stock_out --}}
                <tr class="text-sm">
                    <td>{{ $data->name }}</td>
                    <td>{{ $data->inventory_categories->name }}</td>
                    <td>{{ $data->code }}</td>
                    @foreach([ 30 =>'1M', 90=>'3 M',180=> '6 M',365 =>'1 Y',730 =>'2 Y',0 =>'All'] as $index => $duration)
                        <td class="text-center text-xs">
                            <a href="{{ route(Auth::user()->role->name . '.inventory.item.report_info', [$data->id,$index,'stock_out']) }}"
                                class="btn btn-sm mt-1 mb-1 btn-danger">
                                {{ $duration }} out
                             </a>
                        </td>
                    @endforeach
                </tr>
                {{-- stock_return --}}
                <tr class="text-sm">
                    <td>{{ $data->name }}</td>
                    <td>{{ $data->inventory_categories->name }}</td>
                    <td>{{ $data->code }}</td>
                    @foreach([ 30 =>'1M', 90=>'3 M',180=> '6 M',365 =>'1 Y',730 =>'2 Y',0 =>'All'] as $index => $duration)
                        <td class="text-center text-xs">
                            <a href="{{ route(Auth::user()->role->name . '.inventory.item.report_info', [$data->id,$index,'stock_return']) }}"
                                class="btn btn-sm mt-1 mb-1 btn-info">
                                {{ $duration }} return
                             </a>
                        </td>
                    @endforeach
                </tr>
                {{-- stock_all --}}
                <tr class="text-sm">
                    <td>{{ $data->name }}</td>
                    <td>{{ $data->inventory_categories->name }}</td>
                    <td>{{ $data->code }}</td>
                    @foreach([ 30 =>'1M', 90=>'3 M',180=> '6 M',365 =>'1 Y',730 =>'2 Y',0 =>'All'] as $index => $duration)
                        <td class="text-center text-xs">
                            <a href="{{ route(Auth::user()->role->name . '.inventory.item.report_info', [$data->id,$index,'stock_all']) }}"
                                class="btn btn-sm mt-1 mb-1 btn-warning">
                                {{ $duration }} return
                             </a>
                        </td>
                    @endforeach
                </tr>
            </tbody>
        </table>
    </div>
    @include('parts.title_end')
@endsection
