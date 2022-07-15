<nav class="{{$theme->navigation->config->nav}}">
    @foreach ($navigation_config as $link)
        @if ($link->active)
            <a class="{{ $theme->navigation->config->link_active }}" href="{{ $link->url }}">
            @else
                <a class="{{ $theme->navigation->config->link }}" href="{{ $link->url }}">
        @endif
        {{ $link->label }}
        </a>
    @endforeach
</nav>