@extends('layout.app')

@section('navigation-main')
    @include('navigation.main')
@endsection

@section('main')
    <h1 class="text-2xl mb-4">sandbox</h1>
    <pre>
        {{ print_r($all, 1) }}
    </pre>
@endsection
