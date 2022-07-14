window.addEventListener("DOMContentLoaded", () => {

	document.querySelectorAll("input[type=checkbox]").forEach((input) => {

		// const values = {
		// 	id: input.id,
		// 	name: input.name,
		// 	checked: input.checked,
		// 	value: input.value,
		// };
		// console.table(values);

		input.addEventListener("change", () => {

			const values = {
				id: input.id,
				name: input.name,
				checked: input.checked,
				value: input.value,
			};

			console.table(values);


			// fetch("/api/langs", {
			// 	method: "PUT",
			// 	headers: {
			// 		"Content-Type": "application/json",
			// 	},
			// 	body: JSON.stringify(values),
			// })
			// 	.then((response) => {
			// 		return response.json();
			// 	})
			// 	.then((response) => {
			// 		console.log(response);
			// 	})
			// 	.catch((err) => {
			// 		alert(err);
			// 	});
		});

	});
});
