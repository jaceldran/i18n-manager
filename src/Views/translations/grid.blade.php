@set($uuid = uniqid())

@switch($visible_langs)
    @case(1)
        @set($grid_cols = 'grid-cols-1 grid-cols-1')
    @break

    @case(2)
        @set($grid_cols = 'sm:grid-cols-2 md:grid-cols-2')
    @break

    @case(3)
        @set($grid_cols = 'sm:grid-cols-2 md:grid-cols-3')
    @break

    @case(4)
        @set($grid_cols = 'sm:grid-cols-2 md:grid-cols-4')
    @break

    @case(5)
        @set($grid_cols = 'sm:grid-cols-2 md:grid-cols-5')
    @break

    @case(6)
        @set($grid_cols = 'sm:grid-cols-2 md:grid-cols-6')
    @break

    @default
        @set($grid_cols = 'sm:grid-cols-2 md:grid-cols-4')
@endswitch

<section id="section-{{ $uuid }}"
    class="flex justify-between items-center cursor-pointer border-b border-gray-300 mb-2 px-2 sm:px-0">

    <div id="toggler-{{ $uuid }}" class="toggler cursor-pointer flex-grow py-2 text-stone-700" data-toggle=".toggle-section-{{ $uuid }}">
        {{-- <i class="icon fas fa-angle-down"></i> --}}
        <i class="icon fas fa-angle-up"></i>
        <span class=" font-semibold ml-2 text-accent">{{ $group }}</span>
    </div>

    <button data-group="{{ $group }}" class="render-create-action cursor-pointer bg-gray-200 rounded-full h-8 w-8">
        <i class="fas fa-plus"></i>
    </button>
</section>

<section class="toggle-section toggle-section-{{ $uuid }} --hidden my-2 mb-4 px-2 sm:px-0">
    @foreach ($entries as $key => $entry)
        <div id="row-{{ uniqid() }}" class="flex border-b border-dotted border-gray-500 mb-1 pb-1 group">
            <label
                class="text-gray-600 cursor-pointer pr-4 py-1 w-40 overflow-hidden overflow-ellipsis font-semibold whitespace-nowrap">
                <button class="render-update-action hover:underline" data-key="{{ "$group.$key" }}">
                    {{ $key }}
                </button>
            </label>

            <div class="grid w-full {{ $grid_cols }}">
                @foreach ($entry['translations'] as $lang => $translation)
                    @if ($langs[$lang]['visible'])
                        <p class="mr-1">
                            <input
                                class="rounded-md bg-transparent outline-none hover:bg-gray-50 focus:bg-white cursor-pointer w-full px-2 py-1 disabled:cursor-not-allowed disabled:hover:bg-transparent"
                                {{ $langs[$lang]['editable'] ? '' : 'disabled' }} value="{{ $translation ?? '' }}"
                                placeholder="{{ strtoupper($lang) }}"
                                data-key="{{ $group }}.{{ $key }}" data-lang="{{ $lang }}">
                        </p>
                    @endif
                @endforeach
            </div>

            <div>
                <button data-key="{{ "$group.$key" }}"
                    class="render-delete-action cursor-pointer text-transparent h-8 w-8 group-hover:text-gray-500">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        </div>
    @endforeach

</section>
