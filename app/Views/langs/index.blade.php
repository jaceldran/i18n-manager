@extends('layout.app')

@section('navigation-main')
    @include('navigation.main')
@endsection

@section('actions-bar')
    @include('langs.actions')
@endsection

@section('main')
    <table class="w-full sm:w-auto shadow-sm" aria-label="langs list">
        <thead class="bg-gray-100">
            <tr class="border-b text-xs  uppercase text-center">
                <th class="px-8 py-4 font-semibold">
                    Lang
                </th>
                <th class="px-8 py-4 font-semibold">
                    Visible
                </th>
                <th class="px-8 py-4 font-semibold">
                    Editable
                </th>
                <th class="px-8 py-4 font-semibold">
                    Count
                </th>
                <th></th>
            </tr>
        </thead>
        <tbody id="langs-list" class="bg-gray-50">
            @foreach ($langs as $key => $lang)
                <tr id="{{ $key }}" class="border-b cursor-move group">
                    <td class="px-8 py-4 whitespace-nowrap font-medium">
                        <i class="fi fi-{{ $key }}"></i>
                        <kbd class="ml-2 uppercase text-amber-700">{{ $key }}</kbd>
                    </td>
                    <td class="px-8 py-4">
                        @include('components.switch', [
                            'id' => $lang['key'],
                            'name' => 'visible',
                            'checked' => $lang['visible'] ? 'checked' : '',
                        ])
                    </td>
                    <td class="px-8 py-4">
                        @include('components.switch', [
                            'id' => $lang['key'],
                            'name' => 'editable',
                            'checked' => $lang['editable'] ? 'checked' : '',
                        ])
                    </td>
                    <td class="px-8 py-4 text-center font-serif">
                        {{ $count[$key] ?? 0 }}
                    </td>
                    <td class="cursor-pointer px-4 py-4 delete-lang-action" data-key="{{ $key }}">
                        <button class="pointer-events-none rounded-full h-8 w-8 --bg-gray-200">
                            <i class="text-transparent fas fa-trash pointer-events-none group-hover:text-gray-500"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@section('script')
    <script src="@asset('js/Sortable.min.js')"></script>
    <script src="@asset('js/langs.js')"></script>
@endsection
