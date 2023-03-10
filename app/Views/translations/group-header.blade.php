@set($toggable_id = str_replace('.', '-', $group))

<section id="header-{{ $group }}"
    class="flex justify-between items-center cursor-pointer border-b border-gray-300 mb-2 px-2 sm:px-0">

    <div id="toggler-{{ $toggable_id }}" class="toggler cursor-pointer flex-grow py-2 text-stone-700"
        data-toggle="#content-{{ $toggable_id }}">
        @if ($open)
            <i class="icon fas fa-angle-up pointer-events-none"></i>
        @else
            <i class="icon fas fa-angle-down pointer-events-none"></i>
        @endif
        <span class="pointer-events-none font-semibold ml-2 text-accent">{{ $group }}</span>
    </div>

    <button data-group="{{ $group }}" class="render-create-action cursor-pointer bg-gray-200 rounded-full h-8 w-8">
        <i class="fas fa-plus pointer-events-none"></i>
    </button>
</section>
