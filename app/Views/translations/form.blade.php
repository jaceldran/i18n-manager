@extends('components.modal')

@section('modal-title')
    {{ $title }}
@endsection

@section('modal-content')
    {{-- <pre>
    {{ print_r($translation, 1) }}
    {{ print_r($langs, 1) }}
</pre> --}}

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
                    <input class="border-b p-4 w-full cursor-pointer outline-none font-mono font-semibold text-lg" name="key"
                        value="{{ $translation['key'] }}" />
                @break

                @default
                    <input disabled class="border-b p-4 w-full cursor-not-allowed outline-none font-mono font-semibold text-lg"
                        name="key" value="{{ $translation['key'] }}" />
            @endswitch


            @foreach ($langs as $key => $lang)
                <label class="border-b p-4 flex items-center justify-center gap-2">
                    <i class="fi fi-{{ $key }}"></i>
                    <span class="text-sm font-semibold text-gray-500 uppercase">{{ $key }}</span>
                </label>
                @switch($action)
                    @case('create')
                        <input class="border-b p-4 w-full cursor-pointer outline-none focus:font-semibold"
                            name="{{ $key }}" placeholder="{{ strtoupper($key) }}" value="" />
                    @break

                    @case('update')
                        <input type="hidden" name="group" value="{{ $translation['group'] }}" />

                        <input class="border-b p-4 w-full cursor-pointer outline-none focus:font-semibold"
                            name="{{ $key }}" placeholder="{{ strtoupper($key) }}"
                            value="{{ $translation[$key] ?? '' }}" />
                    @break

                    @default
                        <input type="hidden" name="group" value="{{ $translation['group'] }}" />

                        <input disabled class="border-b p-4 w-full cursor-not-allowed outline-none  name="{{ $key }}"
                            value="{{ $translation[$key] ?? '' }}" />
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
