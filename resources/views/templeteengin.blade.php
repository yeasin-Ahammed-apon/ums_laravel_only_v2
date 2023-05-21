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
    Edit Admin || {{ auth()->user()->role->name }}
@endsection
@section('breadcrumb')
    @include('parts.breadcrumb')
@endsection

@section('content')
    @include('parts.title_start', [
        'title' => $title ?? 'Admin Edit Form',
        'color' => 'card-warning',
    ])
    {{-- let go --}}
    <!-- general form elements -->
    @include('parts.title_end')
@endsection
{{-- this react package version 18,axios v-1.4.0 , if you need it then use it , other wise delete it  --}}
@section("scripts")
<script src="{{ asset('react18/react@18.js') }}"></script>
<script src="{{ asset('react18/react-dom@18.js') }}"></script>
<script src="{{ asset('axios/axios@1.4.0.js') }}"></script>
@endsection
