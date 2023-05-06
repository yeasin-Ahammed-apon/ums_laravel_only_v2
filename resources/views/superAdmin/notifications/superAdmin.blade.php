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
                        {{-- {{  dd($pageData) }} --}}
                        <div class="input-group-append" id="actionOption" style="display: none">
                            <span class="btn btn-secondary  mr-2" onclick="read()">Make <span class="totalCheck"></span>
                                Seen</span>
                        </div>
                        <div class="input-group-append p-0 m-0 mr-2">
                            <select id="pageData" onchange="pageNumberSet()">
                                @foreach ([10, 20, 30, 40, 50] as $pData)
                                    <option value="{{ $pData }}" @if ($pData === $pageData) selected @endif>
                                        {{ $pData }} Per Page</option>
                                @endforeach
                            </select>
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
                                <input type="checkbox" value="{{ $data->id }}" class="form-check-input" checked
                                    disabled>
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
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const selectAll = selector("#selectAll");
            const checkboxes = document.querySelectorAll(".checkbox-select");
            selectAll.addEventListener("click", function(event) {
                checkboxes.forEach(function(checkbox) {
                    checkbox.checked = selectAll.checked;
                });
                checking();
            });
        });

        function read() {
            var checkboxes = document.getElementsByClassName('checkbox-select');
            var selectedValues = [];
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].checked) selectedValues.push(checkboxes[i].value);
            }
            if (selectedValues) {
                $.ajax({
                    type: 'GET',
                    url: "{{ route('superAdmin.notification.superAdmin') }}",
                    data: {
                        _token: '{{ csrf_token() }}',
                        selectedValues,
                    },
                    success: function(data) {
                        if (data.status === 'success') window.location.reload()
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        console.error(errorThrown);
                    }
                });

            }
        }

        function read() {
            var checkboxes = document.getElementsByClassName('checkbox-select');
            var selectedValues = [];
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].checked) selectedValues.push(checkboxes[i].value);
            }
            if (selectedValues) {
                $.ajax({
                    type: 'GET',
                    url: "{{ route('superAdmin.notification.superAdmin') }}",
                    data: {
                        _token: '{{ csrf_token() }}',
                        selectedValues,
                    },
                    success: function(data) {
                        if (data) window.location.reload()
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        console.error(errorThrown);
                    }
                });

            }
        }

        function checking() {
            var checkboxes = document.getElementsByClassName('checkbox-select');
            var selectedValues = [];
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].checked) selectedValues.push(checkboxes[i].value);
            }
            if (selectedValues.length) {
                selector('#actionOption').style.display = 'block'
                selector('.totalCheck').innerText = selectedValues.length
            } else {
                selector('#actionOption').style.display = 'none'
            }
        }

        function pageNumberSet() {
            var pageData = document.getElementById("pageData").value;
            $.ajax({
                type: 'GET',
                url: "{{ route('superAdmin.notification.superAdmin') }}",
                data: {
                    _token: '{{ csrf_token() }}',
                    pageData,
                },
                success: function(data) {
                    if (data) {
                        var url = new URL(window.location.href);
                        url.searchParams.set('pageData', pageData);
                        window.location.href = url.href;
                    }
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.error(errorThrown);
                }
            });
        }
    </script>
@endsection
