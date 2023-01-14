@extends('components.toolbar')

@section('toolbar-content')
    @foreach ($groups as $index => $group)
        <div class="flex gap-4">
            @foreach ($group as $key => $action)
                @if (@isset($action->url))
                    <a class="py-4 font-medium text-sm inline-block leading-tight" target="_blank" href="{{ $action->url }}">
                        <span class="text-blue-600">{{ $action->label }}</span>
                        @isset($action->icon)
                            <i class="{{ $action->icon }}"></i>
                        @endisset
                    </a>
                @else
                    <button
                        class="{{ $key }}-action inline-block text-sm uppercase py-4 font-medium leading-tight focus:outline-none focus:ring-0 transition duration-150 ease-in-out w-full whitespace-nowrap
                        text-gray-600 {{ $action->class ?? '' }}">
                        @isset($action->icon)
                            <i class="pointer-events-none {{ $action->icon }}" style="{{ $action->icon_style ?? '' }}"></i>
                        @endisset
                        {{ $action->label }}
                    </button>
                @endif
            @endforeach
        </div>
    @endforeach
@endsection
