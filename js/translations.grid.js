const Toggle = (uuid) => {
	const target = document.querySelector(`.toggle-${uuid}`);
	if (target.classList.contains('hidden')) {
		target.classList.remove('hidden');
	} else {
		target.classList.add('hidden');
	}
}


class Element
{
	static destroy(selector)
	{
		const target = document.querySelector(selector);
		target.parentNode.removeChild(modal);
	}

	static create(html)
	{
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

	document.querySelectorAll(".open-all-action").forEach((button) => {
		button.addEventListener('click', () => {
			document.querySelectorAll('.toggle-section').forEach((elm)=>{
				elm.classList.remove('hidden');
			});
		})
	});

	document.querySelectorAll(".close-all-action").forEach((button) => {
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
