<div class="flex justify-center">

    <div class="form-check form-switch">

        <input id="{{ $id }}" {{ $checked }} @isset($name) name="{{ $name }}" @endisset
            class="form-check-input appearance-none w-9 -ml-10 rounded-full float-left h-5 align-top bg-no-repeat bg-contain bg-gray-300 focus:outline-none cursor-pointer shadow-sm"
            type="checkbox" role="switch">

        @isset($label)
        <label class="form-check-label inline-block text-gray-800" for="{{ $id }}">
            {{ $label }}
        </label>
        @endisset

    </div>

</div>
