<button id="{{$id ?? 'button-'.uniqid() }}" type="button"
    class="inline-block text-sm px-6 py-2.5 font-medium leading-tight uppercase rounded shadow-md  hover:shadow-lg focus:shadow-lg focus:outline-none focus:ring-0  active:shadow-lg transition duration-150 ease-in-out w-full {{ $button_class ?? 'bg-gray-500 text-white hover:bg-gray-600 focus:bg-gray-600 active:bg-gray-700' }} {{$button_extra_class ?? ''}}">
    @isset($icon)
        {!! $icon !!}
    @endisset
    {{ $label ?? 'Submit' }}
</button>
