@extends('layout')
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
