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
                'route' => 'hod.hod.dashboard',
                'enable' => true,
            ],
            [
                'title' => 'Admin List',
                'route' => 'hod.hod.index',
                'enable' => false,
            ],
        ],

    ])
@endsection --}}

@section('content')
    @include('parts.title_start', [
        'title' => $title ?? 'Account Notification list table',
        'color' => 'card-primary',
    ])
    <div class="card shadow ">
        <div class="card-header">
            <h3 class="card-title"> List
            </h3>
            <div class="card-tools">
                <form action="{{ route('hod.notification.teacher') }}" method="GET">
                    @csrf
                    <div class="input-group input-group-sm">
                        @include('parts.card_tool_option_per_page',['pageData'=>$pageData])
                        <input type="text" name="search" class=" mt-1 mb-1 form-control float-right" placeholder="Search">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-sm mt-1 mb-1 btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                            <a href="{{ route('hod.notification.teacher') }}"class="btn btn-sm mt-1 mb-1 btn-default  ml-2">All
                                Notification</a>
                            <a
                                href="{{ route('hod.notification.teacher', ['seen' => 0]) }}"class="btn btn-sm mt-1 mb-1 btn-success  ml-2">All
                                Unseen Notification</a>
                            <a onclick="disableButton(this)"
                                href="{{ route('hod.notification.teacher', ['seen' => 1]) }}"class="btn btn-sm mt-1 mb-1 btn-secondary  ml-2">All
                                Seen Notification</a>
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
                    <th>
                        <input type="checkbox" id="selectAll">
                    </th>
                    <th>Action By</th>
                    <th>Action</th>
                    <th>Description</th>
                    <th>Seen</th>
                    <th>Seen By</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $data)
                    @include('parts.table_checkinput',$data)
                    <td>{{ $data->user->name }} ({{ $data->user->role->name }})
</td>
                    <td>{{ $data->action }}</td>
                    <td>{{ $data->description }}</td>
                    <td>
                        @if ($data->seen)
                            <span class="btn btn-sm mt-1 mb-1 btn-secondary">Unread</span>
                        @else
                            <a href="{{ route('hod.notification.teacher', [
                                'id' => $data->id,
                                'type' => 'read',
                            ]) }}"
                                class="btn btn-sm mt-1 mb-1 btn-success">Read</a>
                        @endif
                    </td>
                    <td>
                        @if ($data->seen_by !== 0)
                            {{ \App\Models\User::where('id', $data->seen_by)->first()->name }}
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
@section('scripts')
    @include('parts.multiple_check_js',['multiple_check_url'=>'hod.notification.teacher'])
    @include('parts.page_number_set_js',['page_number_url'=>'hod.notification.teacher'])
@endsection
