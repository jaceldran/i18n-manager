@extends('layout.master')

@section('navigation-main')
    @include('navigation')
@endsection

@section('main')
    @foreach ($translations as $group => $entries)
        @include('translations.grid', [
            'group' => $group,
            'entries' => $entries,
        ])
    @endforeach
@endsection

@section('script')
    <script src="@asset('js/translations.grid.js')"></script>
@endsection
