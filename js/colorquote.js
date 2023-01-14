class Colorquote {
    static interval = null;

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
        'rgba(0, 0, 0, .70)',
        'rgba(50, 50, 50, .70)',
        'rgba(153, 102, 51, .70)',
        'rgba(150, 0, 0, .70)',
        'rgba(255, 51, 0, .70)',
        'rgba(255, 0, 102, .70)',
        'rgba(102, 0, 204, .70)',
        'rgba(0, 102, 255, .70)',
        'rgba(0, 102, 153, .70)',
        'rgba(204, 0, 204, .70)',
        'rgba(51, 153, 102, .70)',
        'rgba(150, 150, 0, .70)',
        'rgba(102, 102, 51, .70)'
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

    static fetchFirst(settings) {
        let bg_quote, bg_source, translate;
        const { container, quote, source } = settings;

        this.fetch().then(q => {
            bg_quote = this.randomBackground();
            bg_source = this.randomBackground();

            quote.innerText = q.quote;
            quote.style.backgroundColor = bg_quote;
            quote.style.transform = this.transform([
                this.randomRotate()
            ]);
            quote.style.color = this.randomColor();

            source.innerText = q.source;
            source.style.backgroundColor = bg_source;
            source.style.transform = this.transform([
                this.randomRotate(),
                'translateY(-1rem)'
            ]);
            source.style.color = this.randomColor();

            setTimeout(() => {
                container.style.opacity = '0';
            }, 14000);
        });

    }

    static stop() {
        window.clearInterval(this.interval);
    }

    static play(settings) {
        let bg_quote, bg_source, translate;
        const { container, quote, source } = settings;

        this.stop();
        this.fetchFirst(settings);

        this.interval = setInterval(() => {
            this.fetch().then(q => {
                container.style.opacity = '1';

                bg_quote = this.randomBackground();
                bg_source = this.randomBackground();

                quote.innerText = q.quote;
                quote.style.backgroundColor = bg_quote;
                quote.style.transform = this.transform([
                    this.randomRotate()
                ]);
                quote.style.color = this.randomColor();

                source.innerText = q.source;
                source.style.backgroundColor = bg_source;
                source.style.transform = this.transform([
                    this.randomRotate(),
                    'translateY(-1rem)'
                ]);
                source.style.color = this.randomColor();

                setTimeout(() => {
                    container.style.opacity = '0';
                    container.style.transform = this.transform([
                        this.randomTranslate()
                    ]);
                }, 14000);
            });

        }, 15000);
    }
}