<nav class="{{$theme->navigation->main->nav}}">
    @foreach ($navigation_main as $link)
        @if ($link->active)
            <a class="{{ $theme->navigation->main->link_active }}" href="{{ $link->url }}">
            @else
                <a class="{{ $theme->navigation->main->link }}" href="{{ $link->url }}">
        @endif
        {{ $link->label }}
        </a>
    @endforeach
</nav>
