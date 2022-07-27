@extends('components.toolbar')

@section('toolbar-content')
    <nav class="flex uppercase text-sm font-medium pb-4">
        @foreach ($navigation_config as $link)
            @if ($link->active)
                <a class="flex-1 px-8 py-2 text-center border-b-4 bg-gray-100 border-gray-400" href="{{ $link->url }}">
                @else
                    <a class="flex-1 px-8 py-2 text-center border-b  hover:bg-gray-100" href="{{ $link->url }}">
            @endif
            {{ $link->label }}
            </a>
        @endforeach
    </nav>
@endsection
