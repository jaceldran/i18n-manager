@extends('layout.app')

@section('navigation-main')
    @include('navigation.main')
@endsection

@section('main')
    <div class="markdown">
        {!! $readme !!}
    </div>
@endsection

@section('style')
    <link rel="stylesheet" href="@asset('css/markdown.css')">
@endsection
