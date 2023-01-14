@extends('layout.app')

@section('navigation-main')
    @include('navigation.main')
@endsection

@section('main')
    <div class="h-screen flex justify-center items-center">
        <div id="intro" class="cursor-default fixed left-[25%] right-[25%]">
            <div class="container mx-auto w-auto">
                <span class="tracking-tighter font-ser font-bold text-4xl text-amber-600  font-fjalla-one">i18n</span>
                <div class="text-black font-extrabold text-9xl -translate-x-1 -translate-y-12" style="font-family:sans-serif">
                    <span class="stroke">man<span id="button-play">a</span>ger</span>
                </div>
            </div>
        </div>

        <div id="color-quote" class="cursor-default">
            <span id="quote"></span>
            <span id="source"></span>
        </div>
    </div>
@endsection

@section('style')
    <style>
        html,
        body,
        main {
            overflow: hidden;
            background: linear-gradient(to bottom, #111827, #222, #333);
        }

        #intro {
            opacity: 1;
            transition-property: all;
            transition-timing-function: ease;
            transition-duration: 750ms;
        }

        .stroke {
            -webkit-text-fill-color: transparent;
            -webkit-text-stroke-width: 2px;
            -webkit-text-stroke-color: white;
        }

        #color-quote {
            font-family: 'Fjalla One', Roboto, georgia, serif;
            font-size: xx-large;
            display: flex;
            flex-direction: column;
            transition-property: all;
            transition-timing-function: ease;
            transition-duration: 750ms;
        }

        #quote {
            max-width: 75%;
            margin: 0 auto;
            padding: 1rem;
            transition-property: all;
            transition-timing-function: ease;
            transition-duration: 1s;
            color: transparent;
            border-radius: .5rem;
        }

        #source {
            display: inline-block;
            width: auto;
            margin: 0 auto;
            padding: 1rem;
            transition-property: all;
            transition-timing-function: ease;
            transition-duration: 1s;
            color: transparent;
            border-radius: .5rem;
        }
    </style>
@endsection

@section('script')
    <script src="@asset('js/colorquote.js')"></script>
    <script>
        const settings = {
            container: document.querySelector('#color-quote'),
            quote: document.querySelector('#quote'),
            source: document.querySelector('#source'),
            intro: document.querySelector('#intro'),
            button_play: document.querySelector('#button-play'),
        };

        const playListener = () => {
            console.log('** click play')
            settings.intro.style.opacity = '0';
            settings.intro.classList.add('pointer-events-none');
            settings.container.style.opacity = '1';
            settings.container.classList.remove('pointer-events-none');
            Colorquote.play(settings);
        };

        const stopListener = () => {
            console.log('** click stop')
            Colorquote.stop();
            settings.container.style.opacity = '0';
            settings.container.classList.add('pointer-events-none');
            settings.intro.style.opacity = '1';
            settings.intro.classList.remove('pointer-events-none');
        };

        settings.button_play.addEventListener('click', playListener);
        settings.container.addEventListener('click', stopListener);
    </script>
@endsection
