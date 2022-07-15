@extends('layout.master')

@section('navigation-main')
    @include('navigation.main')
@endsection

@section('main')
    @include('config.navigation')

    @yield('config_content')
@endsection
