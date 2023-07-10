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
                <form action="{{ route(Auth::user()->role->name . '.library.book.index') }}" method="GET">
                    @csrf
                    <div class="input-group input-group-sm">
                        @include('parts.card_tool_option_per_page', ['pageData' => $pageData])
                        <input type="text" name="search" class=" mt-1 mb-1 form-control float-right" placeholder="Search">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-sm mt-1 mb-1 btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                            <a
                                href="{{ route(Auth::user()->role->name . '.library.book.create') }}"class="btn btn-sm mt-1 mb-1 btn-primary  ml-2"><i
                                    class="fa fa-plus" aria-hidden="true"></i> Add Categories</a>
                            <a
                                href="{{ route(Auth::user()->role->name . '.library.book.index') }}"class="btn btn-sm mt-1 mb-1 btn-default  ml-2">All
                                Categories</a>
                            <a
                                href="{{ route(Auth::user()->role->name . '.library.book.index', ['status' => 1]) }}"class="btn btn-sm mt-1 mb-1 btn-success mr-2 ml-2">Active
                                Categories</a>
                            <a href="{{ route(Auth::user()->role->name . '.library.book.index', ['status' => 0]) }}"
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
        <table class="table  table-bordered border-top">
            <thead>
                <tr class="text-xs">
                    <th>image</th>
                    <th>Name</th>
                    <th>Code</th>
                    <th>Categories</th>
                    <th>Department</th>
                    <th>author</th>
                    <th>stock_in</th>
                    <th>stock_out</th>
                    <th>publisher</th>
                    <th>reck</th>
                    <th>Status</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $data)
                    <tr class="text-xs">
                        <td width="10%">
                            <img src="{{ asset('library/' . $data->image) }}" class="img-fluid mx-auto d-block"
                                alt="Image">
                        </td>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->code }}</td>
                        <td>{{ $data->library_categorie->name }}</td>
                        <td>{{ $data->department->name }}</td>
                        <td>{{ $data->author }}</td>
                        <td>{{ $data->stock_in }}</td>
                        <td>{{ $data->stock_out }}</td>
                        <td>{{ $data->publisher }}</td>
                        <td>{{ $data->reck }}</td>
                        <td>
                            @if ($data->status)
                                {{-- active --}}
                                <a href="{{ route(Auth::user()->role->name . '.library.book.status', $data->id) }}"
                                    onclick="disableButton(this)" class="btn btn-sm mt-1 mb-1 btn-outline-success"><i
                                        class="fa fa-circle" aria-hidden="true"></i> </a>
                            @else
                                {{-- deactive --}}
                                <a href="{{ route(Auth::user()->role->name . '.library.book.status', $data->id) }}"
                                    onclick="disableButton(this)" class="btn btn-sm mt-1 mb-1 btn-outline-secondary"><i
                                        class="fa fa-circle" aria-hidden="true"></i> </a>
                            @endif
                        </td>
                        <td class="text-center">
                            {{-- add--}}
                            <a href="{{ route(Auth::user()->role->name . '.library.book.copy.create', ['id'=>$data->id]) }}"
                                class="btn btn-sm mt-1 mb-1 btn-primary">
                                <i class="fas fa-plus-square    "></i>
                             </a>
                            {{-- view --}}
                            <a href="{{ route(Auth::user()->role->name . '.library.book.show', $data->id) }}"
                                class="btn btn-sm mt-1 mb-1 btn-info"><i class="fas fa-info-circle "></i> </a>
                            {{-- edit --}}
                            <a href="{{ route(Auth::user()->role->name . '.library.book.edit', $data->id) }}"
                                class="btn btn-sm mt-1 mb-1 btn-primary edit"><i class="fa fa-cogs"
                                    aria-hidden="true"></i></a>
                            {{-- delete --}}
                            <form action="{{ route(Auth::user()->role->name . '.library.book.destroy', $data->id) }}"
                                method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm mt-1 mb-1 btn-danger delete"
                                    onclick="disableButton(this)"><i class="fa fa-trash" aria-hidden="true"></i> </button>
                            </form>
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
