@set($uuid = 'section-' . uniqid())

<section
    id="{{ $uuid }}"
    class="flex justify-between items-center font-medium --outline uppercase cursor-pointer border-b-2 border-gray-300 mb-2">

    <div class="cursor-pointer flex-grow" onclick="Toggle('{{ $uuid }}')">
        <i class="fas fa-angle-down"></i>
        <span class="ml-2 uppercase">{{ $group }}</span>
    </div>
    <button class="cursor-pointer --bg-slate-50 rounded-full h-8 w-8"
        onclick="alert('EN DESARROLLO\nAñadir entrada al grupo *{{ $group }}* ')">
        <i class="fas fa-plus"></i>
    </button>

</section>

<section class="toggle-section toggle-{{ $uuid }} hidden --outline my-2 mb-4">

    @foreach ($entries as $code => $entry)
        <div class="flex border-b mb-1 pb-1">
            <label
                class="text-slate-600 cursor-pointer pr-4 py-2 w-40 overflow-hidden overflow-ellipsis font-semibold whitespace-nowrap">
                <span class="text-amber-700">
                    {{ $code }}
                </span>
            </label>

            <div class="grid w-full sm:grid-cols-2 md:grid-cols-4">

                @foreach ($entry['translations'] as $lang => $translation)
                    @if ($langs[$lang]['visible'])
                        <p class="mr-1">
                            <input
                                class="rounded-md bg-transparent outline-none hover:bg-slate-100 focus:bg-slate-200 cursor-pointer w-full px-2 py-2 disabled:cursor-not-allowed disabled:hover:bg-transparent"
                                {{ $langs[$lang]['editable'] ? '' : 'disabled' }} value="{{ $translation ?? '' }}"
                                placeholder="{{ strtoupper($lang) }}"
                                data-id="{{ $group }}.{{ $code }}" data-lang="{{ $lang }}">
                        </p>
                    @endif
                @endforeach

            </div>
        </div>
    @endforeach

</section>
