const Toggle = (uuid) => {
	const target = document.querySelector(`.toggle-${uuid}`);
	const icon = document.querySelector(`#${uuid} .icon`);
	if (target.classList.contains('hidden')) {
		target.classList.remove('hidden');
		icon.classList.remove('fa-angle-down');
		icon.classList.add('fa-angle-up');
	} else {
		target.classList.add('hidden');
		icon.classList.remove('fa-angle-up');
		icon.classList.add('fa-angle-down');
	}
}


class Element {
	static destroy(selector) {
		const target = document.querySelector(selector);
		target.parentNode.removeChild(modal);
	}

	static create(html) {
		const container = document.createElement('div');
		container.innerHTML = html;
		document.body.appendChild(container);
	}
}

window.addEventListener("DOMContentLoaded", () => {
	document.querySelectorAll(".add-group-action").forEach((button) => {
		button.addEventListener('click', () => {
			alert('add translations group');
		})
	});

	document.querySelectorAll(".export-action").forEach((button) => {
		button.addEventListener('click', () => {
			fetch("/api/translations/export")
				.then((response) => {
					return response.text();
				})
				.then((html) => {
					Element.create(html);
				})
				.catch((err) => {
					alert(err);
				});
		})
	});

	document.querySelectorAll(".import-action").forEach((button) => {
		button.addEventListener('click', () => {
			fetch("/api/translations/import")
				.then((response) => {
					return response.text();
				})
				.then((html) => {
					Element.create(html);

					document.querySelectorAll(".upload-csv-action").forEach((button) => {
						button.addEventListener('click', () => {
							let file = document.getElementById("file-input").files[0];
							let formData = new FormData();
							formData.append("file-input", file);
							fetch('/api/translations/csv', {
								method: "POST",
								body: formData
							});
						})
					});
				})
				.catch((err) => {
					alert(err);
				});
		})
	});

	document.querySelectorAll(".open-all-action").forEach((button) => {
		button.addEventListener('click', () => {
			document.querySelectorAll('.toggle-section').forEach((elm) => {
				elm.classList.remove('hidden');
			});
			document.querySelectorAll('.icon').forEach((icon) => {
				icon.classList.remove('fa-angle-down');
				icon.classList.add('fa-angle-up');
			});
		})
	});

	document.querySelectorAll(".close-all-action").forEach((button) => {
		button.addEventListener('click', () => {
			document.querySelectorAll('.toggle-section').forEach((elm) => {
				elm.classList.add('hidden');
			});
			document.querySelectorAll('.icon').forEach((icon) => {
				icon.classList.remove('fa-angle-up');
				icon.classList.add('fa-angle-down');
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
