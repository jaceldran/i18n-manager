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

document.addEventListener('click', (evt) => {
	// if (evt.target.id === 'modal' || evt.target.classList.contains('close-modal')) {
	// 	Element.destroy('#modal');
	// }

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


window.addEventListener("DOMContentLoaded", () => {
	document.querySelectorAll(".render-create-action").forEach((button) => {
		button.addEventListener('click', () => {
			fetch(`/api/translations/render/create?group=${button.dataset.group}`)
				.then((response) => {
					return response.text();
				})
				.then((html) => {
					Element.create(html);
					CreateTranslationListener();
				})
				.catch((err) => {
					alert(err);
				});
		});
	});

	document.querySelectorAll(".render-delete-action").forEach((button) => {
		button.addEventListener('click', () => {
			fetch(`/api/translations/render/delete?key=${button.dataset.key}`)
				.then((response) => {
					return response.text();
				})
				.then((html) => {
					Element.create(html);
					DeleteTranslationListener();
				})
				.catch((err) => {
					alert(err);
				});
		});
	});

	document.querySelectorAll(".render-update-action").forEach((button) => {
		button.addEventListener('click', () => {
			fetch(`/api/translations/render/update/?key=${button.dataset.key}`)
				.then((response) => {
					return response.text();
				})
				.then((html) => {
					Element.create(html);
					UpdateTranslationListener();
				})
				.catch((err) => {
					alert(err);
				});
		});
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
			fetch("/api/translations/render/import")
				.then((response) => {
					return response.text();
				})
				.then((html) => {
					Element.create(html);
					ImportListener();
				})
				.catch((err) => {
					alert(err);
				});
		})
	});

	document.querySelectorAll("input").forEach((input) => {
		input.addEventListener("change", () => {
			const values = {
				key: input.dataset.key
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
		});
	});
});

const CreateTranslationListener = () => {
	document.querySelector('input[name=key]').focus();

	document.querySelector("#create-translation-form").addEventListener('submit', (evt) => {
		evt.preventDefault();

		let values = {};
		for (let e of evt.target.elements) {
			if (e.type === 'text' || e.type === 'hidden') {
				values[e.name] = e.value;
			}
		}

		fetch("/api/translations", {
			method: "PUT",
			headers: {
				"Content-Type": "application/json",
			},
			body: JSON.stringify(values),
		})
			.then(() => {
				Element.destroy('#modal');
			})
			.catch((err) => {
				alert(err);
			});
	});
};

const UpdateTranslationListener = () => {
	document.querySelector('input[name=key]').focus();

	document.querySelector("#update-translation-form").addEventListener('submit', (evt) => {
		evt.preventDefault();

		let values = {};
		for (let e of evt.target.elements) {
			if (e.type === 'text' || e.type === 'hidden') {
				values[e.name] = e.value;
			}
		}

		console.log('** update.submit **');

		fetch("/api/translations", {
			method: "POST",
			headers: {
				"Content-Type": "application/json",
			},
			body: JSON.stringify(values),
		})
			.then(() => {
				Element.destroy('#modal');
			})
			.catch((err) => {
				alert(err);
			});
	});
};

const DeleteTranslationListener = () => {
	document.querySelector("#delete-translation-form").addEventListener('submit', (evt) => {
		evt.preventDefault();

		let values = {};
		for (let e of evt.target.elements) {
			if (e.type === 'text' || e.type === 'hidden') {
				values[e.name] = e.value;
			}
		}

		fetch("/api/translations", {
			method: "DELETE",
			headers: {
				"Content-Type": "application/json",
			},
			body: JSON.stringify(values),
		})
			.then(() => {
				Element.destroy('#modal');
			})
			.catch((err) => {
				alert(err);
			});
	});
};

const ImportListener = () => {
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
};
