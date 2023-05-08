@extends('layout')
{{-- @section('breadcrumb')
    @include('parts.breadcrumb', [
        'page_title' => 'Admin list Page',
        'links' => [
            [
                'title' => 'dashboard',
                'route' => 'superAdmin.admin.dashboard',
                'enable' => true,
            ],
            [
                'title' => 'Admin List',
                'route' => 'superAdmin.admin.index',
                'enable' => false,
            ],
        ],
    ])
@endsection --}}
@section('meta-tag')
    User Not Found|| {{ auth()->user()->role->name }}
@endsection
@section('breadcrumb')
    @include('parts.breadcrumb')
@endsection

@section('content')
    @include('parts.title_start', [
        'title' => $title ?? ' ',
        'color' => 'card-danger',
    ])
    <h1>{{ $description }}</h1>
    @include('parts.title_end')
@endsection
