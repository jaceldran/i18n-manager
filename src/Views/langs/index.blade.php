@extends('layout.master')

@section('navigation-main')
    @include('navigation.main')
@endsection

@section('main')

<table class="w-full sm:w-auto">
    <thead>
        <tr class="border-b text-xs  uppercase text-center bg-gray-100">
            <th class="px-6 py-4 font-medium">
               Lang
            </th>
            <th class="px-6 py-4 font-medium">
                Visible
            </th>
            <th class="px-6 py-4 font-medium">
                Editable
            </th>
            {{-- <th class="px-6 py-4 font-medium">
                JSON export path
            </th>
            <th class="px-6 py-4 font-medium">
                PHP export path
            </th> --}}
            <th class="px-6 py-4 font-medium">
                Count
            </th>
        </tr>
    </thead>
    <tbody id="langs-list">
        @foreach ($langs as $code => $lang)
            <tr id="{{ $code }}" class="border-b cursor-move">
                <td class="px-6 py-4 whitespace-nowrap --bg-gray-100">
                    <i class="fi fi-{{ $code }}"></i>
                    <kbd class="ml-2 uppercase text-amber-700">{{ $code }}</kbd>
                </td>
                <td class="px-6 py-4">
                    @include('components.switch', [
                        'id' => $lang['code'],
                        'name' => 'visible',
                        'checked' => $lang['visible'] ? 'checked' : '',
                    ])
                </td>
                <td class="px-6 py-4">
                    @include('components.switch', [
                        'id' => $lang['code'],
                        'name' => 'editable',
                        'checked' => $lang['editable'] ? 'checked' : '',
                    ])
                </td>
                {{-- <td class="px-6 py-4">
                   <kbd class="p-1 text-gray-500 --bg-gray-100">{{ $paths->export_json }}/{{ $code }}.json</kbd>
                </td>
                <td class="px-6 py-4">
                    <kbd class="p-1 text-gray-500 --bg-gray-100">{{ $paths->export_php }}/{{ $code }}.php</kbd>
                </td> --}}
                <td class="px-6 py-4">
                    <span
                        class="mx-auto flex justify-center items-center rounded-full bg-slate-800 text-white h-6 w-6 text-xs font-semibold">
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

                fetch("/api/langs/order", {
                        method: "PUT",
                        headers: {
                            "Content-Type": "application/json",
                        },
                        body: JSON.stringify(order),
                    })
                    .then((response) => {
                        return response.json();
                    })
                    .then((response) => {
                        console.log(response);
                    })
                    .catch((err) => {
                        alert(err);
                    });
            }
        });
    </script>
@endsection
