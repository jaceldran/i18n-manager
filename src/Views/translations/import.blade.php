@extends('components.modal')



@section('modal-title')
    {{ $title }}
@endsection

@section('modal-content')
    <form id="import-translation-form">
        <p class="p-4">
            {{-- <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300" for="file_input">Upload file</label> --}}
            <input id="file-input" name="file-input" type="file"
                class="block w-full text-base text-amber-800 bg-gray-100 rounded-full border cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
        </p>

        <p class="pb-4 px-4">
            @include('components.button', [
                'type' => 'submit',
                'label' => 'Upload',
            ])
        </p>
    </form>
@endsection
