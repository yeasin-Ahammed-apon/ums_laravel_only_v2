@extends('layout')
@section('meta-tag')
    Temporary Student Payment History
@endsection

@section('content')
    @include('parts.title_start', [
        'title' => $title ?? 'Temporary Student Payment History table',
        'color' => 'card-primary',
    ])
    <div class="card shadow ">
        <div class="card-header">
            <h3 class="card-title"> List</h3>
            <div class="card-tools">
                <form action="{{ route('admin.account.index') }}" method="GET">
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
                <tr class="text-sm">
                    <th>Temporary id</th>
                    <th>Name</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Recived by</th>
                    <th>Reciver id</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $data)
                    <td class="text-sm">{{ $data->temporary_student->temporary_id }}</td>
                    <td class="text-sm">{{ $data->temporary_student->name }}</td>
                    <td class="text-sm text-bold">{{ number_format($data->amount, 2) }} tk.</td>
                    <td class="text-sm">{{ Carbon\Carbon::parse($data->created_at)->format('d F, g:i:s A') }}</td>
                    <td class="text-sm">{{ $data->account_name }}</td>
                    <td class="text-sm">{{ $data->account_id }}</td>

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
    @include('parts.page_number_set_js', ['page_number_url' => Route::currentRouteName()])
@endsection
