@set($uuid = 'section-' . uniqid())

@switch($visible_langs)
    @case(1)
        @set($grid_cols='grid-cols-1 grid-cols-1')
        @break
    @case(2)
        @set($grid_cols='sm:grid-cols-2 md:grid-cols-2')
        @break
    @case(3)
        @set($grid_cols='sm:grid-cols-2 md:grid-cols-3')
        @break
    @case(4)
        @set($grid_cols='sm:grid-cols-2 md:grid-cols-4')
        @break
    @case(5)
        @set($grid_cols='sm:grid-cols-2 md:grid-cols-5')
        @break
    @case(6)
        @set($grid_cols='sm:grid-cols-2 md:grid-cols-6')
        @break
    @default
        @set($grid_cols='sm:grid-cols-2 md:grid-cols-4')
@endswitch

<section id="{{ $uuid }}"
    class="flex justify-between items-center cursor-pointer border-b border-gray-300 mb-2">

    <div class="cursor-pointer flex-grow py-2 text-stone-700" onclick="Toggle('{{ $uuid }}')">
        <i class="icon fas fa-angle-down"></i>
        <span class=" font-semibold ml-2  text-base">{{ $group }}</span>
    </div>
    <button class="cursor-pointer --bg-slate-50 rounded-full --h-8 --w-8"
        onclick="alert('EN DESARROLLO\nAñadir entrada al grupo *{{ $group }}* ')">
        <i class="fas fa-plus"></i>
    </button>

</section>

<section class="toggle-section toggle-{{ $uuid }} hidden my-2 mb-4">

    @foreach ($entries as $key => $entry)
        <div class="flex border-b border-dotted border-gray-500 mb-1 pb-1">
            <label
                class="text-slate-600 cursor-pointer pr-4 py-2 w-40 overflow-hidden overflow-ellipsis font-semibold whitespace-nowrap">
                <span class="text-accent">
                    {{ $key }}
                </span>
            </label>

            <div class="grid w-full {{ $grid_cols }}">
                @foreach ($entry['translations'] as $lang => $translation)
                    @if ($langs[$lang]['visible'])
                        <p class="mr-1">
                            <input
                                class="rounded-md bg-transparent outline-none hover:bg-slate-100 focus:bg-slate-200 cursor-pointer w-full px-2 py-2 disabled:cursor-not-allowed disabled:hover:bg-transparent"
                                {{ $langs[$lang]['editable'] ? '' : 'disabled' }} value="{{ $translation ?? '' }}"
                                placeholder="{{ strtoupper($lang) }}"
                                data-id="{{ $group }}.{{ $key }}" data-lang="{{ $lang }}">
                        </p>
                    @endif
                @endforeach
            </div>
        </div>
    @endforeach

</section>
