$(document).ready(function () {
	addSignoutButton();

	let apiUrl = 'http://localhost:3000/api/recipes';
	let queryString = window.location.search;
	let urlParams = new URLSearchParams(queryString);
	let recipeId = urlParams.getAll('item')[0];
	var token = localStorage.getItem('token');

	axios
		.get(`${apiUrl}/${recipeId}`, {
			headers: { Authorization: `Bearer ${token}` },
		})
		.then((response) => {
			const recipe = response.data.data;

			if (response.data.isUser) {
				$('#author').text('You are the author');

				if (token) {
					var url = window.location.href;
					var urlObject = new URL(url);
					var idValue = urlObject.searchParams.get('item');
					var recipeId = parseInt(idValue);
					const btns = `
						<div id="detailBtns">
							<button data-id="${recipe.id}" class="btn btn-secondary update-btn" data-bs-toggle="modal" data-bs-target="#modal-update" id="editBtn">Edit</button>
							<button data-id="${recipe.id}" class="btn btn-danger btn-delete" id="deleteBtn">Delete</button>
						</div>
					`;
					$('#btns').append(btns);
				}
			}
		})
		.catch((error) =>
			console.error(
				'Error fetching recipe information:',
				error
			)
		);
});
