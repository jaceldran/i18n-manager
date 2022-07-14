window.addEventListener("DOMContentLoaded", () => {
	document.querySelectorAll("input[type=checkbox]").forEach((input) => {
		input.addEventListener("change", () => {
			const values = {id: input.id};
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
});
