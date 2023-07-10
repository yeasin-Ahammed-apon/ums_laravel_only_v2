@extends('layout')
@section('meta-tag')
    Show Inventory Categories
@endsection
@section('content')
    @include('parts.title_start', [
        'title' => $title ?? 'Inventory Categories Show',
        'color' => 'card-info',
    ])
    <div class="col-12 col-sm-12 col-md-12 d-flex align-items-stretch flex-column">
        <div class="card bg-light d-flex flex-fill">

          <div class="card-body pt-0">
            <div class="row">
                {{-- <div class="col-12 col-sm-2 text-center">
                    <img src="{{ asset("users/images/".$data->image) }}" alt="user-avatar" class="img-circle img-fluid pt-5">
                </div> --}}
              {{-- <div class="col-12 col-sm-10  pt-5 pb-5 ">

                  <h2 class="lead"><b>{{ $data->name }}</b></h2>
                  <div class=" text-muted border-bottom-0">
                      {{ $data->role->name }}
                    </div>
                <p class="text-muted text-sm"><b>Full name </b> {{ $data->first_name .' '. $data->last_name  }}</p> --}}
                <ul class="ml-4 mb-0 fa-ul text-muted">
                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Name: {{ $data->name }}</li>
                  <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Description: {{ $data->description }}</li>
                  <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Status #:  {{ ($data->status ) ? 'Active' : 'Dective' }}</li>
                  <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Created by: {{ $data->user->name }}</li>
                </ul>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <div class="text-right">
                <a href="{{ route(Auth::user()->role->name.'.library.categorie.edit', $data->id) }}" class="btn btn-sm mt-1 mb-1 btn-primary"><i class="fa fa-cogs" aria-hidden="true"></i> Edit</a>
                <form action="{{ route(Auth::user()->role->name.'.library.categorie.destroy', $data->id) }}" method="POST"
                    class="d-inline">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-sm mt-1 mb-1 btn-danger"
                    onclick="disableButton(this)"
                    ><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
                </form>
            </div>
          </div>
        </div>
      </div>
    <!-- general form elements -->
    @include('parts.title_end')
@endsection
