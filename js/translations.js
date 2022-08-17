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
			if (e.name && (e.type === 'text' || e.type === 'hidden')) {
				values[e.name] = e.value;
			}
		}

		return JSON.stringify(values);
	}

	static setContent(selector, content) {
		const target = document.querySelector(selector);
		target.innerHTML = content;
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
		document.addEventListener('click', (evt) => {
			if (evt.target.classList.contains('render-create-action')) {
				CreateAction.showForm(evt);
			}
		});

		document.addEventListener('submit', (evt) => {
			if (evt.target.id === 'create-translation-form') {
				CreateAction.submitForm(evt);
			}
		});
	}

	static showForm(evt) {
		fetch(`/api/translations/render/create?group=${evt.target.dataset.group}`)
			.then((response) => {
				return response.text();
			})
			.then((html) => {
				Element.create(html);
			})
			.catch((err) => {
				alert(err);
			});
	}

	static submitForm(evt) {
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
				Element.destroy('#modal');
				Element.setContent(
					`#${response.group_content_id}`,
					response.render_group_content
				);
			})
			.catch((err) => {
				alert(err);
			});
	}
}

class UpdateAction {
	static listen() {
		document.addEventListener('click', (evt) => {
			if (evt.target.classList.contains('render-update-action')) {
				UpdateAction.showForm(evt);
			}
		});

		document.addEventListener('change', (evt) => {
			if (evt.target.classList.contains('live-input')) {
				UpdateAction.liveUpdate(evt);
			}
		});

		document.addEventListener('submit', (evt) => {
			if (evt.target.id === 'update-translation-form') {
				UpdateAction.submitForm(evt);
			}
		});
	}

	static showForm(evt) {
		fetch(`/api/translations/render/update?key=${evt.target.dataset.key}`)
			.then((response) => {
				return response.text();
			})
			.then((html) => {
				Element.create(html);
			})
			.catch((err) => {
				alert(err);
			});
	}

	static submitForm(evt) {
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
				Element.destroy('#modal');
				Element.setContent(
					`#${response.group_content_id}`,
					response.render_group_content
				);
			})
			.catch((err) => {
				alert(err);
			});
	}

	static liveUpdate(evt) {
		const input = evt.target;
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
	}
}

class DeleteAction {
	static listen() {
		document.addEventListener('click', (evt) => {
			if (evt.target.classList.contains('render-delete-action')) {
				DeleteAction.showForm(evt);
			}
		});

		document.addEventListener('submit', (evt) => {
			if (evt.target.id === 'delete-translation-form') {
				DeleteAction.submitForm(evt);
			}
		});
	}

	static showForm(evt) {
		fetch(`/api/translations/render/delete?key=${evt.target.dataset.key}`)
			.then((response) => {
				return response.text();
			})
			.then((html) => {
				Element.create(html);
			})
			.catch((err) => {
				alert(err);
			});
	}

	static submitForm(evt) {
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
				Element.destroy('#modal');
				Element.setContent(
					`#${response.group_content_id}`,
					response.render_group_content
				);
			})
			.catch((err) => {
				alert(err);
			});
	}
}

class DownloadAction {
	static listen() {
		document.querySelector(".download-action").addEventListener('click', () => {
			fetch("/api/translations/download")
				.then(() => {
					location.href = '/translations/download';
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
