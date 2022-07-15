<table class="">
    <thead>
        <tr class="border-b text-xs font-semibold uppercase text-center bg-gray-100 ">
            <th class="px-6 py-4">
                Lang
            </th>
            <th class="px-6 py-4">
                Visible
            </th>
            <th class="px-6 py-4">
                Editable
            </th>
            <th class="px-6 py-4">
                Count
            </th>
        </tr>
    </thead>
    <tbody id="langs-list">
        @foreach ($langs as $code => $lang)
            <tr id="{{ $code }}" class="border-b cursor-move">
                <td class="px-6 py-4 whitespace-nowrap bg-gray-100">
                    <i class="fi fi-{{ $code }}"></i>
                    <span class="ml-2 uppercase text-amber-700 font-semibold">{{ $code }}</span>
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
                <td class="px-6 py-4">
                    <span
                        class="mx-auto flex justify-center items-center rounded-full bg-slate-200 h-8 w-8 text-xs font-semibold">
                        {{ $count[$code] ?? 0 }}
                    </span>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>


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
