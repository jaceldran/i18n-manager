@extends('layout.master')

@section('navigation-main')
    @include('navigation')
@endsection

@section('main')
    <table>
        <thead>
            <tr class="border-b text-xs font-semibold uppercase text-center bg-gray-200 ">
                <th class="p-4">
                    Lang
                </th>
                <th class="p-r">
                    Visible
                </th>
                <th class="p-r">
                    Editable
                </th>
                <th class="p-r">
                    Count
                </th>
            </tr>
        </thead>
        <tbody id="langs-list">
            @foreach ($langs as $code => $lang)
            <tr id="{{ $code }}" class="border-b cursor-move">
                <td class="p-4">
                    <i class="fi fi-{{ $code }}"></i>
                    <span class="uppercase --text-amber-700 font-semibold">{{ $code }}</span>
                </td>
                <td class="p-4">
                    @include('components.switch', [
                        'id' => $lang['code'],
                        'name' => 'visible',
                        'checked' => $lang['visible'] ? 'checked': '',
                    ])
                </td>
                <td class="p-4">
                    @include('components.switch', [
                        'id' => $lang['code'],
                        'name' => 'editable',
                        'checked' => $lang['editable'] ? 'checked': '',
                    ])
                </td>
                <td class="p-4">
                    <span class="mx-auto flex justify-center items-center rounded-full bg-slate-200 h-8 w-8 text-xs font-semibold">
                        {{ $count[$code] ?? 0 }}
                    </span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@section('script')
    <script src="@asset('js/config.langs.js')"></script>
    <script src="@asset('js/Sortable.min.js')"></script>
    <script>
        const list = document.getElementById('langs-list');
        const sortable = new Sortable(list, {
            animation: 150,
            ghostClass: 'blue-background-class',
            onEnd: (evt) => {
                let order = [];
                const rows = document.querySelectorAll('tr', evt.target);
                rows.forEach((element, index) => {
                    if (!element.id) {
                        return;
                    }
                    order.push(element.id);
                });

                console.log('Orden', order);
            }
        });
    </script>
@endsection
