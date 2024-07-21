// Function to display a success notification when a test is saved
function successSaveTest() {
	Lobibox.notify('success', {
		pauseDelayOnHover: true,
		size: 'mini',
		rounded: true,
		icon: 'bi bi-check2-circle',
		delayIndicator: false,
		continueDelayOnInactiveTab: false,
		position: 'top center',
		msg: 'Тестирование успешно сохранено'
	});
}

// Document ready function
$(function () {
	// Event listener for clicking on elements with the class "delete-test"
	$(document).on('click', '.delete-test', function () {
		// Get the test ID from the element's data attribute
		let id = $(this).data('test');

		// Display a warning modal to confirm deletion
		Swal.fire({
			title: "Вы уверены?",
			text: `Удаление теста №${id} так же приведет к удалению всех его вопросов и ответов, а так же всех результатов пользователей которые его прошли и загруженных креативных заданий!`,
			icon: "warning",
			showCancelButton: true,
			confirmButtonColor: "#d33",
			cancelButtonColor: "#3085d6",
			confirmButtonText: "Да, я понимаю риски удаления!",
			cancelButtonText: "Отмена"
		}).then((result) => {
			// If the user confirms deletion
			if (result.isConfirmed) {
				// Send a POST request to delete the test
				axios.post('/test/delete', { id }).then(res => {
					// Display a success modal if the deletion is successful
					Swal.fire({
						title: "Успешно!",
						text: "Данное тестирование было полностью удалено",
						icon: "success"
					});
					location.href = '/test/all';
				}).catch(err => {
					// Display an error modal if there's an error during deletion
					Swal.fire({
						title: "Ошибка!",
						text: "Во время удаления произошла ошибка",
						icon: "error"
					});
				})
			}
		});
	});
});