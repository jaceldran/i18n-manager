@extends('components.modal')

@section('modal-title')
    {{ $title }}
@endsection

@section('modal-content')
    @foreach ($exports as $group => $files)
        <h2 class="font-semibold p-2 bg-gray-100">{{ $group }}</h2>
        <div class="p-2">
            @php
                $files = array_map(function ($f) {
                    return basename($f);
                }, $files);
            @endphp

            {{ implode(' / ', $files) }}
        </div>
    @endforeach
@endsection
