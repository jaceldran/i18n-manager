@extends('components.toolbar')

@section('toolbar-content')
    @foreach ($groups as $index => $group)
        <div class="flex gap-4">
            @foreach ($group as $key => $action)
                <button
                    class="{{ $key }}-action inline-block text-sm uppercase py-4 font-medium leading-tight focus:outline-none focus:ring-0  transition duration-150 ease-in-out w-full whitespace-nowrap
                    text-gray-600">
                    @isset($action->icon)
                        <i class="{{ $action->icon }}"></i>
                    @endisset
                    {{ $action->label }}
                </button>
            @endforeach
        </div>
    @endforeach
@endsection
