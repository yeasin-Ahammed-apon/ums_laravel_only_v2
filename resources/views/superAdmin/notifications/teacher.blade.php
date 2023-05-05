@extends('layout')
@section('meta-tag')
    Admin list || {{ auth()->user()->role->name }}
@endsection
{{-- @section('breadcrumb')
    @include('parts.breadcrumb', [
        'page_title' => 'Admin list Page',
        'links' => [
            [
                'title' => 'dashboard',
                'route' => 'superAdmin.teacher.dashboard',
                'enable' => true,
            ],
            [
                'title' => 'Admin List',
                'route' => 'superAdmin.teacher.index',
                'enable' => false,
            ],
        ],
    ])
@endsection --}}
@section('breadcrumb')
    @include('parts.breadcrumb')
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
                <form action="{{ route('superAdmin.notification.teacher') }}" method="GET">
                    @csrf
                    <div class="input-group input-group-sm">
                        <input type="text" name="search" class="form-control float-right" placeholder="Search">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                            <a href="{{ route('superAdmin.notification.teacher') }}"class="btn btn-default  ml-2">All Notification</a>
                            <a href="{{ route('superAdmin.notification.teacher',['seen'=>0]) }}"class="btn btn-success  ml-2">All Unseen Notification</a>
                            <a href="{{ route('superAdmin.notification.teacher',['seen'=>1]) }}"class="btn btn-secondary  ml-2">All Seen Notification</a>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>By </th>
                    <th>Action</th>
                    <th>Description</th>
                    <th>Seen</th>
                    <th>Seen By</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $data)
                        <td>{{ $data->user->name }}</td>
                        <td>{{ $data->action }}</td>
                        <td>{{ $data->description }}</td>
                        <td>
                            @if ($data->seen)
                            <span class="btn btn-secondary">Unread</span>
                            @else
                            <a href="{{ route('superAdmin.notification.teacher', [
                                'id'=>$data->id,
                                'type'=>'read'
                                ]) }}" class="btn btn-success">Read</a>
                            @endif
                        </td>
                        <td>
                            @if ($data->seen_by !== 0)
                                {{ \App\Models\User::where('id',$data->seen_by)->first()->name }}
                            @else
                                ....
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @if ($datas->isEmpty())
            <h1 class="text-center text-black-50">No Data Found</h1>
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
