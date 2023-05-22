@extends('layout')
{{-- @section('breadcrumb')
    @include('parts.breadcrumb', [
        'page_title' => 'Admin list Page',
        'links' => [
            [
                'title' => 'dashboard',
                'route' => 'admin.teacher.dashboard',
                'enable' => true,
            ],
            [
                'title' => 'Admin List',
                'route' => 'admin.teacher.index',
                'enable' => false,
            ],
        ],
    ])
@endsection --}}
@section('meta-tag')
    Show Teacher || {{ auth()->user()->role->name }}
@endsection
@section('breadcrumb')
    @include('parts.breadcrumb')
@endsection

@section('content')
    @include('parts.title_start', [
        'title' => $title ?? 'Teacher Show Form',
        'color' => 'card-warning',
    ])
    <div class="col-12 col-sm-12 col-md-12 d-flex align-items-stretch flex-column">
        <div class="card bg-light d-flex flex-fill">

          <div class="card-body pt-0">
            <div class="row">
                <div class="col-12 col-sm-2 text-center">
                    <img src="{{ asset("users/images/".$data->user->image) }}" alt="user-avatar" class="img-circle img-fluid pt-5">
                  </div>
              <div class="col-12 col-sm-10  pt-5 pb-5 ">

                  <h2 class="lead"><b>{{ $data->user->name }}</b></h2>
                  <div class=" text-muted border-bottom-0">
                      {{ $data->user->role->name }}
                    </div>
                <p class="text-muted text-sm"><b>Full name </b> {{ $data->first_name .' '. $data->last_name  }}</p>
                <ul class="ml-4 mb-0 fa-ul text-muted">
                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Id: {{ $data->user->login_id }}</li>
                  <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Address: {{ $data->last_name }}</li>
                  <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone #: {{ $data->phone }}</li>
                  <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> email: {{ $data->email }}</li>
                </ul>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <div class="text-left">
                            @if (!$data->hod)
                                <a href="{{ route('admin.teacher.hod', $data->id) }}" class="btn btn-sm mt-1 mb-1 btn-success">Make Hod</a>
                            @endif
                            @if (!$data->cod)
                                <a href="{{ route('admin.teacher.cod', $data->id) }}" class="btn btn-sm mt-1 mb-1 btn-info">Make Cod</a>
                            @endif

                <a href="{{ route('admin.teacher.edit', $data->id) }}" class="btn btn-sm mt-1 mb-1 btn-primary">Edit</a>
                <form action="{{ route('admin.teacher.destroy', $data->id) }}" method="POST"
                    class="d-inline">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-sm mt-1 mb-1 btn-danger">Delete</button>
                </form>
            </div>
          </div>
        </div>
      </div>
    <!-- general form elements -->
    @include('parts.title_end')
@endsection
