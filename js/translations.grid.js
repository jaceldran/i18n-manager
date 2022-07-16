const Toggle = (uuid) => {
	const target = document.querySelector(`.toggle-${uuid}`);
	if (target.classList.contains('hidden')) {
		target.classList.remove('hidden');
	} else {
		target.classList.add('hidden');
	}
}

window.addEventListener("DOMContentLoaded", () => {
	document.querySelectorAll(".add-group").forEach((button) => {
		button.addEventListener('click', () => {
			alert('add translations group');
		})
	});

	document.querySelectorAll(".toggle-all-open").forEach((button) => {
		button.addEventListener('click', () => {
			document.querySelectorAll('.toggle-section').forEach((elm)=>{
				elm.classList.remove('hidden');
			});
		})
	});

	document.querySelectorAll(".toggle-all-close").forEach((button) => {
		button.addEventListener('click', () => {
			document.querySelectorAll('.toggle-section').forEach((elm)=>{
				elm.classList.add('hidden');
			});
		})
	});

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
