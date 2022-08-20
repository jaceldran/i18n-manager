<button id="{{ $id ?? 'button-' . uniqid() }}" type="{{ $type ?? 'button' }}"
    class="inline-block px-6 py-2.5 font-medium leading-tight rounded shadow-sm hover:shadow-md focus:shadow-lg focus:outline-none focus:ring-0  active:shadow-lg transition duration-150 ease-in-out w-full whitespace-nowrap {{ $button_apply ?? 'bg-blue-500 text-white hover:bg-blue-500/95 focus:bg-blue-600 active:bg-blue-600' }} {{ $button_extra_class ?? '' }}">

    @isset($button_icon)
        <span class="mr-2">{!! $button_icon !!}</span>
    @endisset

    <span>{{ $label ?? 'Submit' }}</span>
</button>