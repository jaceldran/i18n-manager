window.addEventListener("DOMContentLoaded", () => {
	document.querySelectorAll("input[type=checkbox]").forEach((input) => {
		input.addEventListener("change", () => {
			const values = { id: input.id };
			values[input.name] = input.checked;

			fetch("/api/langs", {
				method: "PUT",
				headers: {
					"Content-Type": "application/json",
				},
				body: JSON.stringify(values),
			})
				.then((response) => {
					return response.json();
				})
				.then((response) => {
					console.log(response);
				})
				.catch((err) => {
					alert(err);
				});
		});
	});


	const list = document.getElementById('langs-list');
	const sortable = new Sortable(list, {
		animation: 150,
		ghostClass: 'blue-background-class',
		onEnd: (evt) => {
			let order = [];
			const rows = document.querySelectorAll('tr', evt.target);
			rows.forEach((element, index) => {
				if (!element.id) {
					return;
				}
				order.push(element.id);
			});

			fetch("/api/langs/order", {
				method: "PUT",
				headers: {
					"Content-Type": "application/json",
				},
				body: JSON.stringify(order),
			})
				.then((response) => {
					return response.json();
				})
				.then((response) => {
					console.log(response);
				})
				.catch((err) => {
					alert(err);
				});
		}
	});
});
