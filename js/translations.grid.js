window.addEventListener("DOMContentLoaded", () => {
	document.querySelectorAll("input").forEach((input) => {
		input.addEventListener("change", () => {
			const values = {
				id: input.dataset.id,
				lang: input.dataset.lang,
				value: input.value,
			};

			fetch("/api/translations", {
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
