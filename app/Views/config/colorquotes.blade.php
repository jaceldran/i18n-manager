@extends('config.index')

@section('config_content')
    <div style="height: calc(100vh - 200px)" class="flex justify-center items-center">

        <div id="intro" class="container mx-auto">
            <div class="ml-24">
                <span class="tracking-tighter font-ser font-extrabold text-4xl text-amber-600"
                    style="font-family:'Fjalla One'">i18n</span>
                <div class="text-black tracking-tighter font-extrabold text-9xl -translate-y-8">
                    <span class="stroke">manager</span>
                </div>
            </div>
        </div>

        <div id="color-quote" class="mx-auto">
            <span id="quote"></span>
            <span id="source"></span>
        </div>
    </div>
@endsection

@section('style')
    <style>
        #intro {
            opacity: 1;
            transition-property: all;
            transition-timing-function: ease;
            transition-duration: 750ms;
        }

        .stroke {
            -webkit-text-fill-color: transparent;
            -webkit-text-stroke-width: 2px;
            -webkit-text-stroke-color: #aaa;
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
            /* box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px; */
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
            /* box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px; */
            border-radius: .5rem;
        }

        .opacity-0 {
            opacity: 0;
        }

        .opacity-1 {
            opacity: 1;
        }
    </style>
@endsection

@section('script')
    <script src="@asset('js/colorquote.js')"></script>
    <script>
        const settings = {
            container: document.querySelector('#color-quote'),
            quote: document.querySelector('#quote'),
            source: document.querySelector('#source')
        };

        //Colorquote.fetchAndWrite(settings);

        setTimeout(() => {
            const intro = document.querySelector('#intro');
            intro.style.opacity = '0';
            setTimeout(() => {
                intro.style.display = 'none';
            }, 1000);
        }, 14000);


        Colorquote.play(settings);
    </script>
@endsection
