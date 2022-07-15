@extends('layout.master')

@section('navigation-main')
    @include('navigation.main')
@endsection

@section('main')
    @include('config.navigation')

    @include('config.paths')

	<hr class="my-8">

    @include('config.langs')

@endsection
