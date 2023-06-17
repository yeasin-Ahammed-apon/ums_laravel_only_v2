@extends('layout')
@section('meta-tag')
    Admin list
@endsection
@section('content')
    @include('parts.title_start', [
        'title' => $title ?? 'Admin list table',
        'color' => 'card-primary',
    ])
    <div class="card shadow ">
        <div class="card-header">
            <h3 class="card-title"> List</h3>
            <div class="card-tools">
                <form action="{{ route(Auth::user()->role->name.'.admin.index') }}" method="GET">
                    @csrf
                    <div class="input-group input-group-sm">
                        @include('parts.card_tool_option_per_page', ['pageData' => $pageData])
                        <input type="text" name="search" class=" mt-1 mb-1 form-control float-right" placeholder="Search">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-sm mt-1 mb-1 btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive ">
        <table class="table  table-bordered border-top">
            <thead>
                <tr>
                    <th>image</th>
                    <th>Name</th>
                    <th>Full Name</th>
                    <th>Login Id</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $data)
                    <td width="10%">
                        <img src="{{ asset('users/images/' . $data->user->image) }}" class="img-fluid mx-auto d-block"
                            alt="Image">
                    </td>
                    <td>{{ $data->user->name }}</td>
                    <td>{{ $data->first_name }} {{ $data->last_name }}</td>
                    <td>{{ $data->user->login_id }}</td>
                    <td>{{ $data->phone }}</td>
                    <td >
                        @if ($data->user->status === 1)
                            <button class="btn btn-sm mt-1 mb-1 btn-outline-success" disabled>Active</button>
                        @else
                            <button  class="btn btn-sm mt-1 mb-1 btn-outline-warning" disabled>Deactive</button>
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{{ route(Auth::user()->role->name.'.admin.restore', $data->id) }}" class="btn btn-sm mt-1 mb-1 btn-primary">Restore</a>
                        <a href="{{ route(Auth::user()->role->name.'.admin.forcedelete', $data->id) }}" class="btn btn-sm mt-1 mb-1 btn-danger">Force Delete</a>
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
