@extends('layout')
@section('meta-tag')
{{ $title ?? Auth::user()->role->name }}
@endsection
@section('content')
    @include('parts.title_start', [
        'title' => $title ?? 'Profile',
        'color' => 'bg-info',
    ])

<h1>profile</h1>
    @include('parts.title_end')
@endsection
