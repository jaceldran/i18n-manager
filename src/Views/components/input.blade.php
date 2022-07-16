{{-- <div class="flex justify-center">
    <div class="mb-3 xl:w-96">
        <label for="exampleFormControlInput1" class="form-label inline-block mb-2 text-gray-700">Example label</label>
        <input type="text"
            class="
          form-control
          block
          w-full
          px-3
          py-1.5
          text-base
          font-normal
          text-gray-700
          bg-white bg-clip-padding
          border border-solid border-gray-300
          rounded
          transition
          ease-in-out
          m-0
          focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none
        "
            id="exampleFormControlInput1" placeholder="Example label" />
    </div>
</div> --}}


<p class="my-4">
    @isset($label)
        <label for="{{ $id ?? '' }}" class="text-gray-500 block font-medium">
            {{ $label }}
        </label>
    @endisset

    <input id="{{ $id ?? '' }}" type="{{$type ?? 'text'}}" name="{{ $name ?? '' }}" placeholder="{{ $placeholder ?? '' }}"
        value="{{ $value ?? '' }}" class="p-2 border-b w-full outline-none focus:bg-gray-100 transition
        ease-in-out {{ $input_class ?? ''}}">
</p>
