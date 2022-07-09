window.addEventListener('DOMContentLoaded', () => {
	document.querySelectorAll('input').forEach(input => {
		input.addEventListener('change',  () => {
			const values = {
				group: input.dataset.group,
				id: input.dataset.id,
				lang: input.dataset.lang,
				value: input.value,
			};

			const url ='/api/entries';

			fetch('/api/entries', {
				method: 'PUT',
				headers: {
					'Content-Type': 'application/json'
					// 'Content-Type': 'application/x-www-form-urlencoded',
				  },
				body: JSON.stringify(values)
			})
			.then( response => {
				return response.json();
			})
			.then(response => {
				console.log(response)
			})
			.catch(err => {
				alert(err);
			});



			// const response = await fetch('/api/entries', {
			// 	method: 'PUT',
			// 	mode: 'no-cors',
			// 	headers: {
			// 		'Content-Type': 'application/json'
			// 	},
			// 	body: JSON.stringify(values)
			// });

			// const result = response.json();

		});
	});
});
