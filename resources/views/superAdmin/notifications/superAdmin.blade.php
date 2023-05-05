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
                'route' => 'superAdmin.hod.dashboard',
                'enable' => true,
            ],
            [
                'title' => 'Admin List',
                'route' => 'superAdmin.hod.index',
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
            <h3 class="card-title"> List
            </h3>
            <div class="card-tools">
                <form action="{{ route('superAdmin.notification.superAdmin') }}" method="GET">
                    @csrf
                    <div class="input-group input-group-sm">
                        <div class="input-group-append" id="actionOption" style="display: none">
                            <span class="btn btn-secondary  mr-2" onclick="read()">Make All Seen</span>
                        </div>
                        <input type="text" name="search" class="form-control float-right" placeholder="Search">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                            <a href="{{ route('superAdmin.notification.superAdmin') }}"class="btn btn-default  ml-2">All
                                Notification</a>
                            <a
                                href="{{ route('superAdmin.notification.superAdmin', ['seen' => 0]) }}"class="btn btn-success  ml-2">All
                                Unseen Notification</a>
                            <a
                                href="{{ route('superAdmin.notification.superAdmin', ['seen' => 1]) }}"class="btn btn-secondary  ml-2">All
                                Seen Notification</a>
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
                    <th>
                        <input type="checkbox" id="selectAll">
                        <div class="d-inline">
                        </div>
                    </th>
                    <th>By </th>
                    <th>Action</th>
                    <th>Description</th>
                    <th>Seen</th>
                    <th>Seen By</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $data)
                    <td>
                        @if ($data->seen)
                            <div class="form-check">
                                <input type="checkbox" value="{{ $data->id }}" class="form-check-input" disabled>
                            </div>
                        @else
                            <div class="form-check">
                                <input type="checkbox" name="checked" value="{{ $data->id }}"
                                    class="checkbox-select form-check-input" onclick="checking()">
                            </div>
                        @endif
                    </td>
                    <td>{{ $data->user->name }}</td>
                    <td>{{ $data->action }}</td>
                    <td>{{ $data->description }}</td>
                    <td>
                        @if ($data->seen)
                            <span class="btn btn-secondary">Unread</span>
                        @else
                            <a href="{{ route('superAdmin.notification.superAdmin', [
                                'id' => $data->id,
                                'type' => 'read',
                            ]) }}"
                                class="btn btn-success">Read</a>
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
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        $(document).ready(function() {
            // Select/Deselect all checkboxes
            // document.querySelector('#actionOption').style.display = 'none'
            $('#selectAll').click(function(event) {
                if (this.checked) {
                    document.querySelector('#actionOption').style.display = 'block'
                    $('.checkbox-select').each(function() {
                        this.checked = true;
                    });
                } else {
                    document.querySelector('#actionOption').style.display = 'none'
                    $('.checkbox-select').each(function() {
                        this.checked = false;
                    });
                }
            });
        });

        function read() {
            var checkboxes = document.getElementsByClassName('checkbox-select');
            var selectedValues = [];
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].checked) {
                    selectedValues.push(checkboxes[i].value);
                }
            }
            if (selectedValues) {
                axios({
                        method: 'get',
                        url: {{ route('superAdmin.notification.superAdmin') }},
                        checkboxData: selectedValues
                    })
                    .then(function(response) {
                        console.log(response.data);
                    })
                    .catch(function(error) {
                        console.error(error);
                    });
            }
        }

        function checking() {
            var checkboxes = document.getElementsByClassName('checkbox-select');
            var selectedValues = [];
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].checked) {
                    selectedValues.push(checkboxes[i].value);
                }
            }
            if (selectedValues.length) {
                document.querySelector('#actionOption').style.display = 'block'
            } else {
                document.querySelector('#actionOption').style.display = 'none'
            }
        }
    </script>
@endsection
