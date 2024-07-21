
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

$(function () {
	$(document).on('click', '.delete-test', function () {
		let id = $(this).data('test');

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
			if (result.isConfirmed) {
				axios.delete(`/tests/${id}`).then(res => {
					Swal.fire({
						title: "Успешно!",
						text: "Данное тестирование было полностью удалено",
						icon: "success"
					});
					location.href = '/tests';
				}).catch(err => {
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