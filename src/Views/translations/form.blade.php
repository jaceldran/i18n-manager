@extends('components.modal')

@section('modal-title')
    {{ $title }}
@endsection

@section('modal-content')
    <form class="px-2" id="{{ $action }}-translation-form">
        <div class="grid grid-cols-[100px_1fr]">
            <label class="border-b py-4 flex justify-center items-center">
                <span class="uppercase rounded-full inline-block px-6 text-white bg-gray-700">key</span>
            </label>
            @switch($action)
                @case('create')
                    <input class="border-b p-4 w-full cursor-pointer outline-none font-mono font-semibold text-lg" name="key"
                        placeholder="KEY" value="{{ $group ?? null }}." />
                @break

                @case('update')
                    <input class="border-b p-4 w-full cursor-pointer outline-none font-mono font-semibold text-lg"
                        name="key" value="{{ $translation['key'] }}" />
                @break

                @default
                <input disabled class="border-b p-4 w-full cursor-not-allowed outline-none font-mono font-semibold text-lg"
                        name="key" value="{{ $translation['key'] }}" />
            @endswitch


            @foreach ($langs as $lang)
                <label class="border-b p-4 flex items-center justify-center gap-2">
                    <i class="fi fi-{{ $lang }}"></i>
                    <span class="text-sm font-semibold text-gray-500 uppercase">{{ $lang }}</span>
                </label>
                @switch($action)
                    @case('create')
                    @case('update')
                        <input class="border-b p-4 w-full cursor-pointer outline-none focus:font-semibold"
                            name="{{ $lang }}" placeholder="{{ strtoupper($lang) }}"
                            value="{{ $translation[$lang] ?? null }}" />
                    @break

                    @default
                        <input disabled class="border-b p-4 w-full cursor-not-allowed outline-none  name="{{ $lang }}"
                            value="{{ $translation[$lang] ?? null }}" />
                @endswitch
            @endforeach
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
