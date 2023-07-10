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
                <form action="{{ route(Auth::user()->role->name . '.library.issue.list') }}" method="GET">
                    @csrf
                    <div class="input-group input-group-sm">
                        @include('parts.card_tool_option_per_page', ['pageData' => $pageData])
                        <input type="text" name="search" class=" mt-1 mb-1 form-control float-right" placeholder="Search">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-sm mt-1 mb-1 btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                            <a
                                href="{{ route(Auth::user()->role->name . '.library.issue.book') }}"class="btn btn-sm mt-1 mb-1 btn-primary  ml-2"><i
                                    class="fa fa-plus" aria-hidden="true"></i> Add Categories</a>
                            <a
                                href="{{ route(Auth::user()->role->name . '.library.issue.list') }}"class="btn btn-sm mt-1 mb-1 btn-default  ml-2">All
                                Categories</a>
                            <a
                                href="{{ route(Auth::user()->role->name . '.library.issue.list', ['status' => 1]) }}"class="btn btn-sm mt-1 mb-1 btn-success mr-2 ml-2">Active
                                Categories</a>
                            <a href="{{ route(Auth::user()->role->name . '.library.issue.list', ['status' => 0]) }}"
                                class="btn btn-sm mt-1 mb-1 btn-warning">Deactive
                                Categories</a>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive ">
        {{-- {{ dd($datas )}} --}}
        showing {{ count($datas->items()) }} Result out of {{ $datas->total() }}
        <table class="table  table-bordered border-top text-sm">
            <thead>
                <tr>
                    <th>Take By</th>
                    <th>Book</th>
                    <th>Book Copy</th>
                    <th>issue condition</th>
                    <th>issue_date</th>
                    <th>expected_return_date</th>
                    <th>return_date</th>
                    <th>return condition</th>
                    <th>fine</th>
                    <th>created by</th>
                    <th>Status</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $data)
                    <tr
                    @if ($data->expected_return_date < Carbon\Carbon::now())
                        @if ($data->status)
                            class="bg-danger"
                        @endif

                         @endif>
                        <td>{{ $data->taken_by->name }}</td>
                        <td>{{ $data->library_book->name }}</td>
                        <td>{{ $data->library_book_copy->code }}</td>
                        <td>{{ $data->issue_in_what_condition }}</td>
                        <td>{{ dateFormat($data->issue_date) }}</td>
                        <td>{{ dateFormat($data->expected_return_date) }}</td>
                        <td>{{ $data->return_date ? dateFormat($data->return_date) : '...' }}</td>
                        <td>{{ $data->return_in_what_condition ?? '...' }}</td>
                        <td>{{ $data->fine }} tk</td>
                        <td>{{ $data->user->name }}</td>
                        <td>
                            @if ($data->status)
                                {{-- active --}}
                                <a onclick="disableButton(this)" class="btn btn-sm mt-1 mb-1 btn-outline-success"><i
                                        class="fa fa-circle" aria-hidden="true"></i> </a>
                            @else
                                {{-- deactive --}}
                                <a onclick="disableButton(this)" class="btn btn-sm mt-1 mb-1 btn-outline-secondary"><i
                                        class="fa fa-circle" aria-hidden="true"></i> </a>
                            @endif
                        </td>
                        <td class="text-center">
                            {{-- edit --}}
                            <a href="{{ route(Auth::user()->role->name . '.library.issue.edit', $data->id) }}"
                                class="btn btn-sm mt-1 mb-1 btn-primary edit"><i class="fa fa-cogs"
                                    aria-hidden="true"></i></a>
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
    </div>

    @include('parts.title_end')
@endsection
@section('scripts')
    @include('parts.page_number_set_js', ['page_number_url' => Route::currentRouteName()])
@endsection
