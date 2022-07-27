@extends('layout.app')

@section('navigation-main')
    @include('navigation.main')
@endsection

@section('main')
    <div class="h-screen flex justify-center items-center">

        <div class="absolute left-0 right-0 pt-6 ">
            <div class="container mx-auto">
                <div class="ml-24">
                    <span class="tracking-tighter font-ser font-bold text-4xl text-amber-600">i18n</span>
                    <div class="text-black tracking-tighter font-extrabold text-9xl -translate-y-8">
                        <span class="stroke">manager</span></div>
                </div>
            </div>
        </div>

        <div id="color-quote">
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
            /* background-color: #111827; */
            background: linear-gradient(to bottom, #111827, #222, #333);
            /* background: linear-gradient(to bottom, #111827, #bbb, #ccc, #ddd, #eee); */
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
    <script>
        class Player {
            static colors = [
                '#fff',
                '#ff9',
                '#fcc',
            ];

            static rotates = [
                'rotate(0deg)',
                'rotate(5deg)',
                'rotate(-5deg)',
                'rotate(3deg)',
                'rotate(-3deg)',
            ];

            static translates = [
                'translateY(.5rem)',
                'translateY(-.5rem)',
                'translateX(.5rem)',
                'translateX(-.5rem)',
            ];

            static backgrounds = [
                'rgba(0, 0, 0, .85)',
                'rgba(50, 50, 50, .85)',
                'rgba(153, 102, 51, .85)',
                'rgba(150, 0, 0, .85)',
                'rgba(255, 51, 0, .85)',
                'rgba(255, 0, 102, .85)',
                'rgba(102, 0, 204, .85)',
                'rgba(0, 102, 255, .85)',
                'rgba(0, 102, 153, .85)',
                'rgba(204, 0, 204, .85)',
                'rgba(51, 153, 102, .85)',
                'rgba(150, 150, 0, .85)',
                'rgba(102, 102, 51, .85)'
            ]

            static transform(transforms) {
                return transforms.join(' ');
            }

            static randomBackground() {
                return this.backgrounds[this.random(0, this.backgrounds.length)];
            }

            static randomColor() {
                return this.colors[this.random(0, this.colors.length)];
            }

            static randomRotate() {
                return this.rotates[this.random(0, this.rotates.length)];
            }

            static randomTranslate() {
                return this.translates[this.random(0, this.translates.length)];
            }

            static random(min, max) { // min incluido, max excluido
                var rand = Math.random() * (max - min) + min;
                rand = Math.floor(rand);
                return rand;
            }

            static async fetch() {
                const response = await fetch('https://colorquotes.zentric.es/colorquote');
                const json = await response.json();
                return json;
            }

            static intro() {

            }
        }

        const container = document.querySelector('#color-quote');
        const quote = document.querySelector('#quote');
        const source = document.querySelector('#source');

        let bg_quote, bg_source, transalte;

        // Player.fetch().then(q => {
        //     bg_quote = Player.randomBackground();
        //     bg_source = Player.randomBackground();

        //     quote.innerText = q.quote;
        //     quote.style.backgroundColor = bg_quote;
        //     quote.style.transform = Player.transform([
        //         Player.randomRotate()
        //     ]);
        //     quote.style.color = Player.randomColor();

        //     source.innerText = q.source;
        //     source.style.backgroundColor = bg_source;
        //     source.style.transform = Player.transform([
        //         Player.randomRotate(),
        //         'translateY(-1rem)'
        //     ]);
        //     source.style.color = Player.randomColor();

        //     setTimeout(() => {
        //         container.style.transform = Player.transform([
        //         Player.randomTranslate()
        //     ]);
        //     }, 300);
        // });

        // setInterval(() => {
        //     Player.fetch().then(q => {
        //         bg_quote = Player.randomBackground();
        //         bg_source = Player.randomBackground();

        //         quote.innerText = q.quote;
        //         quote.style.backgroundColor = bg_quote;
        //         quote.style.transform = Player.randomTransform();
        //         quote.style.color = Player.randomColor();

        //         source.innerText = q.source;
        //         source.style.backgroundColor = bg_source;
        //         source.style.transform = Player.randomTransform() + ' translateY(-1rem)';
        //         source.style.color = Player.randomColor();

        //         setTimeout(() => {
        //             bg_quote = 'transparent';
        //             bg_source = 'transparent';

        //             quote.style.color = 'transparent';
        //             quote.style.backgroundColor = bg_quote;

        //             source.style.color = 'transparent';
        //             source.style.backgroundColor = bg_source;
        //         }, 13000);
        //     });
        // }, 15000);
    </script>
@endsection
