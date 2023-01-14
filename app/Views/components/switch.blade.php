<p class="flex justify-center">
    <input type="checkbox" id="{{ $id }}" {{ $checked }}
        @isset($name) name="{{ $name }}" @endisset
        class="
        appearance-none
        cursor-pointer
        rounded-full
        h-5
        w-9
        flex
        items-center
        justify-start
        border-2
        border-gray-300
        bg-gray-300
        shadow-sm

        after:content-[' ']
        after:h-3.5
        after:w-3.5
        after:bg-white
        after:rounded-full

        checked:border-blue-500
        checked:bg-blue-500
        checked:justify-end
        ">
</p>
