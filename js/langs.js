// TODO: llevar a script común para reutilizar
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

	static jsonBody(element) {
		let values = {};
		for (let e of element.elements) {
			if (e.type === 'text' || e.type === 'hidden') {
				values[e.name] = e.value;
			}
		}

		return JSON.stringify(values);
	}

	static setContent(selector, content) {
		Element.destroy('#modal');
		const target = document.querySelector(selector);
		target.innerHTML = content;
		UpdateAction.listen();
		CreateAction.listen();
		DeleteAction.listen();
	}
}

class CreateAction {
	static listen() {
		this.listenShowForm();
	}

	static listenShowForm() {
		const listener = () => {
			fetch(`/api/langs/render/create`)
			.then((response) => {
				return response.text();
			})
			.then((html) => {
				Element.create(html);
				CreateAction.listenSubmit();
			})
			.catch((err) => {
				alert(err);
			});
		};

		document.querySelectorAll(".add-lang-action").forEach((button) => {
			button.removeEventListener('click', listener);
			button.addEventListener('click', listener);
		});
	}

	static listenSubmit() {
		document.querySelector('input[name=key]').focus();

		const listener = (evt) => {
			evt.preventDefault();

			fetch("/api/langs", {
				method: "POST",
				headers: {
					"Content-Type": "application/json",
				},
				body: Element.jsonBody(evt.target),
			})
				.then((response) => {
					return response.json();
				})
				.then((response) => {
					location.reload();
				})
				.catch((err) => {
					alert(err);
				});
		};

		document.querySelector("#create-lang-form").removeEventListener('submit', listener);
		document.querySelector("#create-lang-form").addEventListener('submit', listener);
	}
}

class DeleteAction {
	static listen() {
		document.querySelectorAll(".delete-lang-action").forEach((button) => {
			const listener = () => {
				fetch("/api/langs", {
					method: "DELETE",
					headers: {
						"Content-Type": "application/json",
					},
					body: JSON.stringify({
						key: button.dataset.key
					}),
				})
					.then((response) => {
						return response.json();
					})
					.then((response) => {
						location.reload()
					})
					.catch((err) => {
						alert(err);
					});
			};

			button.removeEventListener('click', listener);
			button.addEventListener('click', listener);
		});
	}
}


window.addEventListener("DOMContentLoaded", () => {
	CreateAction.listen();
	DeleteAction.listen();


	document.querySelectorAll("input[type=checkbox]").forEach((input) => {
		input.addEventListener("change", () => {
			const values = { key: input.id };
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
