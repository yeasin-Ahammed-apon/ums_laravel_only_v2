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
    Edit Admin
@endsection


@section('content')
    @include('parts.title_start', [
        'title' => $title ?? 'Profile',
        'color' => 'bg-info',
    ])

<h1>profile</h1>
    @include('parts.title_end')
@endsection
