<nav class="font-semibold flex">
    @foreach ($navigation as $link)
        @if ($link['active'])
            <a class="p-4 bg-amber-400 text-slate-800" href="{{ $link['url'] }}">
            @else
                <a class="p-4" href="{{ $link['url'] }}">
        @endif
        {{ $link['label'] }}
        </a>
    @endforeach
</nav>
