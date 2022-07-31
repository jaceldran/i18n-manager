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

class ToggleAction {
	static listen() {
		document.addEventListener('click', (evt) => {
			if (evt.target.classList.contains('open-all-action')) {
				document.querySelectorAll('.toggle-section').forEach((elm) => {
					elm.classList.remove('hidden');
				});
				document.querySelectorAll('.icon').forEach((icon) => {
					icon.classList.remove('fa-angle-down');
					icon.classList.add('fa-angle-up');
				});
			}
			if (evt.target.classList.contains('close-all-action')) {
				document.querySelectorAll('.toggle-section').forEach((elm) => {
					elm.classList.add('hidden');
				});
				document.querySelectorAll('.icon').forEach((icon) => {
					icon.classList.remove('fa-angle-up');
					icon.classList.add('fa-angle-down');
				});
			}
			if (evt.target.classList.contains('toggler')) {
				let toggler = evt.target;
				let toggable = document.querySelector(toggler.dataset.toggle);
				let icon = document.querySelector(`#${toggler.id} > .icon`, toggler);

				if (toggable.classList.contains('hidden')) {
					toggable.classList.remove('hidden');
					icon.classList.remove('fa-angle-down');
					icon.classList.add('fa-angle-up');
				} else {
					toggable.classList.add('hidden');
					icon.classList.remove('fa-angle-up');
					icon.classList.add('fa-angle-down');
				}
			}
		});
	}
}

class CreateAction {
	static listen() {
		this.listenShowForm();
	}

	static listenShowForm() {
		const listener = (evt) => {
			const button = evt.target;

			console.log(button);

			fetch(`/api/translations/render/create?group=${button.dataset.group}`)
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

		document.querySelectorAll(".render-create-action").forEach((button) => {
			button.removeEventListener('click', listener);
			button.addEventListener('click', listener);
		});
	}

	static listenSubmit() {
		document.querySelector('input[name=key]').focus();

		const listener = (evt) => {
			evt.preventDefault();

			fetch("/api/translations", {
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
					Element.setContent(
						`#${response.group_content_id}`,
						response.render_group_content
					);
				})
				.catch((err) => {
					alert(err);
				});
		};

		document.querySelector("#create-translation-form").removeEventListener('submit', listener);
		document.querySelector("#create-translation-form").addEventListener('submit', listener);
	}
}

class UpdateAction {
	static listen() {
		this.inputChangeListen();
		this.showFormListen();
	}

	static inputChangeListen() {
		document.querySelectorAll("input").forEach((input) => {
			const listener = () => {
				const values = {
					key: input.dataset.key,
					group: input.dataset.group,
				};
				values[input.dataset.lang] = input.value;

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
			};

			input.removeEventListener('change', listener);

			input.addEventListener("change", listener);
		});
	}

	static showFormListen() {
		document.querySelectorAll(".render-update-action").forEach((button) => {
			const listener = () => {
				fetch(`/api/translations/render/update?key=${button.dataset.key}`)
					.then((response) => {
						return response.text();
					})
					.then((html) => {
						Element.create(html);
						UpdateAction.submitListen();
					})
					.catch((err) => {
						alert(err);
					});
			};

			button.removeEventListener('click', listener);

			button.addEventListener('click', listener);
		});
	}

	static submitListen() {
		const listener = (evt) => {
			evt.preventDefault();

			fetch("/api/translations", {
				method: "PUT",
				headers: {
					"Content-Type": "application/json",
				},
				body: Element.jsonBody(evt.target),
			})
				.then((response) => {
					return response.json();
				})
				.then((response) => {
					Element.setContent(
						`#${response.group_content_id}`,
						response.render_group_content
					);
				})
				.catch((err) => {
					alert(err);
				});
		};

		document.querySelector('input[name=key]').focus();

		document.querySelector("#update-translation-form").addEventListener('submit', listener);
	}
}

class DeleteAction {
	static listen() {
		this.showFormListen();
	}

	static showFormListen() {
		document.querySelectorAll(".render-delete-action").forEach((button) => {
			const listener = () => {
				fetch(`/api/translations/render/delete?key=${button.dataset.key}`)
					.then((response) => {
						return response.text();
					})
					.then((html) => {
						Element.create(html);
						DeleteAction.submitListen();
					})
					.catch((err) => {
						alert(err);
					});
			};

			button.removeEventListener('click', listener);
			button.addEventListener('click', listener);
		});
	}

	static submitListen() {
		document.querySelector('input[name=key]').focus();

		document.querySelector("#delete-translation-form").addEventListener('submit', (evt) => {
			evt.preventDefault();

			fetch("/api/translations", {
				method: "DELETE",
				headers: {
					"Content-Type": "application/json",
				},
				body: Element.jsonBody(evt.target),
			})
				.then((response) => {
					return response.json();
				})
				.then((response) => {
					Element.setContent(
						`#${response.group_content_id}`,
						response.render_group_content
					);
				})
				.catch((err) => {
					alert(err);
				});
		});
	}
}

class DownloadAction {
	static listen() {
		document.querySelector(".download-action").addEventListener('click', () => {

			fetch("/api/translations/download")
				.then(() => {
					location.assign('/translations/download');
				})
				.catch((err) => {
					alert(err);
				});

		});
	}
}

class ExportAction {
	static listen() {
		document.querySelector(".export-action").addEventListener('click', () => {
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
		});
	}
}

class ImportAction {
	static listen() {
		this.listenShowForm();
	}

	static listenShowForm() {
		document.querySelectorAll(".import-action").forEach((button) => {
			button.addEventListener('click', () => {
				fetch("/api/translations/render/import")
					.then((response) => {
						return response.text();
					})
					.then((html) => {
						Element.create(html);
						ImportAction.listenSubmit();
					})
					.catch((err) => {
						alert(err);
					});
			})
		});
	}

	static listenSubmit() {
		document.getElementById('import-translation-form').addEventListener('submit', evt => {
			evt.preventDefault();
			let file = document.getElementById("file-input").files[0];
			let formData = new FormData();
			formData.append("file-input", file);
			fetch('/api/translations/import', {
				method: "POST",
				body: formData
			}).then(() => {
				location.reload();
			});
		});
	}
}

window.addEventListener("DOMContentLoaded", () => {
	ToggleAction.listen();
	CreateAction.listen();
	UpdateAction.listen();
	DeleteAction.listen();
	ExportAction.listen();
	ImportAction.listen();
	DownloadAction.listen();
});
