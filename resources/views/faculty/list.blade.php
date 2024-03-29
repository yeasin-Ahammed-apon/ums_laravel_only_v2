@extends('layout')
@section('meta-tag')
    Admin list
@endsection
{{-- @section('breadcrumb')
    @include('parts.breadcrumb', [
        'page_title' => 'Admin list Page',
        'links' => [
            [
                'title' => 'dashboard',
                'route' => 'faculty.dashboard',
                'enable' => true,
            ],
            [
                'title' => 'Admin List',
                'route' => 'faculty.index',
                'enable' => false,
            ],
        ],
    ])
@endsection --}}

@section('content')
    @include('parts.title_start', [
        'title' => $title ?? 'Admin list table',
        'color' => 'card-primary',
    ])
    <div class="card shadow ">
        <div class="card-header">
            <h3 class="card-title"> List</h3>
            <div class="card-tools">
                <form action="{{ route('faculty.index') }}" method="GET">
                    @csrf
                    <div class="input-group input-group-sm">
                        @include('parts.card_tool_option_per_page', ['pageData' => $pageData])
                        <input type="text" name="search" class=" mt-1 mb-1 form-control float-right" placeholder="Search">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-sm mt-1 mb-1 btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                            <a href="{{ route('faculty.create') }}"class="btn btn-sm mt-1 mb-1 btn-primary  ml-2"><i class="fa fa-plus" aria-hidden="true"></i> Add Admins</a>
                            <a href="{{ route('faculty.index') }}"class="btn btn-sm mt-1 mb-1 btn-default  ml-2">All Admins</a>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body ">
        <table class="table table-bordered">
            <thead>
                <tr>

                    <th>Name</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $data)
                        <td>{{ $data->name }}</td>
                        <td class="text-center">
                            <a href="{{ route('faculty.edit', $data->id) }}" class="btn btn-sm mt-1 mb-1 btn-primary edit"
                                ><i class="fa fa-cogs" aria-hidden="true"></i> Edit</a>
                            <form action="{{ route('faculty.destroy', $data->id) }}" method="POST"
                                class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm mt-1 mb-1 btn-danger delete"
                                onclick="disableButton(this)"
                                ><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
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
