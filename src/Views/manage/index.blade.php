@extends('layout.master')

@section('navigation-main')
    @include('navigation')
@endsection

@section('main')
    @foreach ($entries as $group => $words)
        @include('manage.grid', [
            'group' => $group,
            'words' => $words,
        ])
    @endforeach
@endsection

@section('script')
    <script src="@asset('js/manage.grid.js')"></script>
@endsection
