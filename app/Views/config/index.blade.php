@extends('layout.app')

@section('navigation-main')
    @include('navigation.main')
@endsection

@section('actions-bar')
    @include('config.navigation')
@endsection

@section('main')
    @yield('config_content')
@endsection
