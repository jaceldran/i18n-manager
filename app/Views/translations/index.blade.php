@extends('layout.app')

@section('navigation-main')
    @include('navigation.main')
@endsection

@section('actions-bar')
    @include('translations.actions')
@endsection

@section('main')
    @foreach ($translations as $group => $translations)
        @include('translations.group-header', [
            'group' => $group,
            'translations' => $translations,
            'open' => false,
        ])

        @include('translations.group-content', [
            'group' => $group,
            'translations' => $translations,
            'open' => false,
        ])
    @endforeach
@endsection

@section('script')
    <script src="@asset('js/translations.js')"></script>
@endsection
