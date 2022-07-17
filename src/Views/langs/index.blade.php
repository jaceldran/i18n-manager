@extends('layout.master')

@section('navigation-main')
    @include('navigation.main')
@endsection

@section('actions-bar')
    @include('langs.actions')
@endsection

@section('main')
    <table class="w-full sm:w-auto" aria-label="langs list">
        <thead>
            <tr class="border-b text-xs  uppercase text-center bg-gray-100">
                <th class="px-8 py-4 font-medium">
                    Lang
                </th>
                <th class="px-8 py-4 font-medium">
                    Visible
                </th>
                <th class="px-8 py-4 font-medium">
                    Editable
                </th>
                <th class="px-8 py-4 font-medium">
                    Count
                </th>
                <th></th>
            </tr>
        </thead>
        <tbody id="langs-list">
            @foreach ($langs as $code => $lang)
                <tr id="{{ $code }}" class="border-b cursor-move">
                    <td class="px-8 py-4 whitespace-nowrap --bg-gray-50">
                        <i class="fi fi-{{ $code }}"></i>
                        <kbd class="ml-2 uppercase text-amber-700">{{ $code }}</kbd>
                    </td>
                    <td class="px-8 py-4">
                        @include('components.switch', [
                            'id' => $lang['code'],
                            'name' => 'visible',
                            'checked' => $lang['visible'] ? 'checked' : '',
                        ])
                    </td>
                    <td class="px-8 py-4">
                        @include('components.switch', [
                            'id' => $lang['code'],
                            'name' => 'editable',
                            'checked' => $lang['editable'] ? 'checked' : '',
                        ])
                    </td>
                    <td class="px-8 py-4">
                        <span
                            class="mx-auto flex justify-center items-center rounded-full bg-slate-800 text-white h-6 w-6 text-xs font-semibold">
                            {{ $count[$code] ?? 0 }}
                        </span>
                    </td>
                    <td class="--bg-gray-50 cursor-pointer px-4 py-4 text-gray-400 delete-lang-action" data-lang="{{ $code }}">
                        <button class="pointer-events-none">
                            <i class="fas fa-trash pointer-events-none"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@section('script')
    <script src="@asset('js/Sortable.min.js')"></script>
    <script src="@asset('js/config.langs.js')"></script>
@endsection
