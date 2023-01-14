@set($toggable_id = str_replace('.', '-', $group))

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

<section id="content-{{ $toggable_id }}" class="toggle-section my-2 mb-4 px-2 sm:px-0 {{ $open ? '' : 'hidden' }}">
    @foreach ($translations as $key => $translation)
        <div class="flex border-b border-dotted border-gray-500 mb-1 pb-1 group">
            <label
                class="text-gray-600 cursor-pointer pr-4 py-1 w-40 overflow-hidden overflow-ellipsis font-semibold whitespace-nowrap">
                <button class="render-update-action hover:underline focus:outline-none focus:underline"
                    data-key="{{ "$group.$key" }}">
                    {{ $key }}
                </button>
            </label>

            <div class="grid w-full {{ $grid_cols }}">
                @foreach ($translation['translations'] as $lang => $translation)
                    @if (isset($langs[$lang]) && $langs[$lang]['visible'])
                        <p class="mr-1">
                            <input
                                class="live-input rounded-md
                                outline-none
                                bg-transparent
                                hover:bg-gray-50
                                hover:outline-1
                                focus:outline-1
                                hover:outline-gray-300
                                focus:outline-gray-300
                                focus:bg-white
                                cursor-pointer
                                w-full
                                px-2
                                py-1
                                disabled:cursor-not-allowed
                                disabled:bg-transparent
                                disabled:hover:outline-none
                                disabled:hover:bg-transparent
                                disabled:text-gray-600"
                                {{ $langs[$lang]['editable'] ? '' : 'disabled' }} value="{{ $translation ?? '' }}"
                                placeholder="{{ strtoupper($lang) }}" data-key="{{ $group }}.{{ $key }}"
                                data-lang="{{ $lang }}">
                        </p>
                    @endif
                @endforeach
            </div>

            <div>
                <button tabindex="-1" data-key="{{ "$group.$key" }}"
                    class="render-delete-action cursor-pointer text-transparent h-8 w-8 group-hover:text-gray-500">
                    <i class="fas fa-trash pointer-events-none"></i>
                </button>
            </div>
        </div>
    @endforeach

</section>
