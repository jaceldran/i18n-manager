class Colorquote {

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

	static fetchAndWrite(settings, callback) {
		const {container, quote, source} = settings;
		let bg_quote, bg_source, translate;

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

			if (callback) {
				callback(settings);
			}

			// setTimeout(() => {
			// 	bg_quote = 'transparent';
			// 	bg_source = 'transparent';

			// 	quote.style.color = 'transparent';
			// 	quote.style.backgroundColor = bg_quote;

			// 	source.style.color = 'transparent';
			// 	source.style.backgroundColor = bg_source;

			// 	container.style.transform = this.transform([
			// 		this.randomTranslate()
			// 	]);
			// }, 14000);
		});

	}

	static play(settings) {
		let bg_quote, bg_source, translate;

		const {container, quote, source} = settings;

		setInterval(() => {
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
                    bg_quote = 'transparent';
                    bg_source = 'transparent';

                    quote.style.color = 'transparent';
                    quote.style.backgroundColor = bg_quote;

                    source.style.color = 'transparent';
                    source.style.backgroundColor = bg_source;

					container.style.transform = this.transform([
						this.randomTranslate()
					]);
                }, 14000);
            });

        }, 15000);
	}
}