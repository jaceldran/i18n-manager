@extends('components.modal')

@section('modal-title')
    {{ $title }}
@endsection

@section('modal-content')
    {{-- <pre>{{ print_r($translation, 1) }}</pre> --}}
    <form class="px-2" id="{{ $action }}-lang-form">
        <div class="grid grid-cols-[100px_1fr]">
            <label class="border-b py-4 flex justify-center items-center">
                <span class="uppercase rounded-full inline-block px-6 text-white bg-gray-700">lang</span>
            </label>
            <input class="border-b p-4 w-full cursor-pointer outline-none font-mono font-semibold text-lg" name="key"
                placeholder="LANG" />
        </div>

        <div class="my-4 flex justify-between items-center gap-2">
            @include('components.button', [
                'type' => 'button',
                'label' => 'Cancel',
                'button_apply' => null,
                'button_icon' => null,
                'button_extra_class' => 'close-modal',
            ])

            @include('components.button', [
                'type' => 'submit',
                'label' => $button,
                'button_apply' => $button_apply ?? null,
                'button_icon' => $button_icon ?? null,
            ])
        </div>
    </form>
@endsection
