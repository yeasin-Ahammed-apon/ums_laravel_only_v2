@extends('layout')
@section('meta-tag')
    Something went wrong
@endsection
@section('content')
    @include('parts.title_start', [
        'title' => $title ?? 'Error ',
        'color' => 'card-danger',
    ])
    <h1>{{ $description ?? 'Something went wrong , plz connect with your devloper' }}</h1>
    @include('parts.title_end')
@endsection
