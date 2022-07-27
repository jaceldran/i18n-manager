<p class="mb-4">
    @isset($label)
        <label for="{{ $id ?? '' }}" class="text-accent block">
            {{ $label }}
        </label>
    @endisset

    <input id="{{ $id ?? '' }}" type="{{ $type ?? 'text' }}" name="{{ $name ?? '' }}"
        placeholder="{{ $placeholder ?? '' }}"
        @isset($disabled) {{ $disabled ? 'disabled' : '' }} @endisset value="{{ $value ?? '' }}"
        class="py-1 px-2 border-b w-full cursor-pointer outline-none focus:bg-white transition bg-transparent
        ease-in-out disabled:text-gray-400 disabled:cursor-not-allowed {{ $input_class ?? '' }}">
</p>
