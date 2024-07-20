// Define a function to show or hide the asset question based on the selected type
let showAssetQuestion = (typeSelectId) => {
	// Check if the selected value is greater than 1
	if ($(typeSelectId).val() > 1) {
		// Show the question asset element
		$('#question_asset').removeClass('d-none');

		// Set the accept attribute of the input field based on the selected type
		if ($(typeSelectId).val() == 2) {
			// For type 2, accept images
			$('#question_asset_input').attr('accept', 'image/*');
		} else if ($(typeSelectId).val() == 3) {
			// For type 3, accept videos
			$('#question_asset_input').attr('accept', 'video/*');
		} else if ($(typeSelectId).val() == 4) {
			// For type 4, accept audio files
			$('#question_asset_input').attr('accept', 'audio/*');
		}
	} else {
		// Hide the question asset element if the selected value is 1 or less
		$('#question_asset').addClass('d-none');
	}
}

// Document ready function
$(function () {
	// Initialize tooltips
	$('[data-bs-toggle="tooltip"]').tooltip();

	// Initialize the repeater plugin
	$("#repeater").createRepeater({
		showFirstItemToDefault: false,
	});

	// Call the showAssetQuestion function initially
	showAssetQuestion('#type_id');

	// Bind a change event to the type_id element
	$(document).on('change', '#type_id', function () {
		// Call the showAssetQuestion function when the type_id element changes
		showAssetQuestion('#type_id');
	});

	// Attach an event listener to all elements with the class 'delete-question'
	$(document).on('click', '.delete-question', function () {
		// Get the question ID from the data attribute of the clicked element
		let id = $(this).data('question');

		// Display a confirmation dialog to the user
		Swal.fire({
			// Set the title of the dialog
			title: "Вы уверены?",
			// Set the text of the dialog
			text: `Удаление вопроса №${id} так же приведет к удалению всех его вариантов ответа и файлов!`,
			// Set the icon of the dialog to a warning symbol
			icon: "warning",
			// Show a cancel button
			showCancelButton: true,
			// Set the color of the confirm button
			confirmButtonColor: "#d33",
			// Set the color of the cancel button
			cancelButtonColor: "#3085d6",
			// Set the text of the confirm button
			confirmButtonText: "Да, я понимаю риски удаления!",
			// Set the text of the cancel button
			cancelButtonText: "Отмена"
		}).then((result) => {
			// Check if the user confirmed the deletion
			if (result.isConfirmed) {
				// Send a POST request to /question/delete with the question ID as data
				axios.post('/question/delete', { id }).then(res => {
					// Display a success message if the request is successful
					Swal.fire({
						title: "Успешно!",
						text: "Данный вопрос был полностью удален",
						icon: "success"
					});
				}).catch(err => {
					// Display an error message if the request fails
					Swal.fire({
						title: "Ошибка!",
						text: "Во время удаления произошла ошибка",
						icon: "error"
					});
				})
			}
		});
	});
})