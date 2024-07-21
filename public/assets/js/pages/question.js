
let showAssetQuestion = (typeSelectId) => {
	let type_id = $(typeSelectId).val();
	if (type_id > 1) {
		$('#question_asset').removeClass('d-none');
		if ($('#question_id').length > 0) {
			axios.post('/questions/assets/get', { type_id, id: $('#question_id').val() }).then(res => {
				if (res.data.assets) {
					$('#question-assets_block').html(res.data.assets);
				} else {
					$('#question-assets_block').html('');
				}
			})
		}
		if (type_id == 2) {
			$('#question_asset_input').attr('accept', 'image/*');
		} else if (type_id == 3) {
			$('#question_asset_input').attr('accept', 'video/*');
		} else if (type_id == 4) {
			$('#question_asset_input').attr('accept', 'audio/*');
		}
	} else {
		$('#question_asset').addClass('d-none');
	}
}

$(function () {
	$('[data-bs-toggle="tooltip"]').tooltip();

	$("#repeater").createRepeater({
		showFirstItemToDefault: true,
	});

	showAssetQuestion('#type_id');

	$(document).on('change', '#type_id', () => showAssetQuestion('#type_id'));

	$(document).on('click', '.delete-question', function () {
		let id = $(this).data('question');
		Swal.fire({
			title: "Вы уверены?",
			text: `Удаление вопроса №${id} так же приведет к удалению всех его вариантов ответа и файлов!`,
			icon: "warning",
			showCancelButton: true,
			confirmButtonColor: "#d33",
			cancelButtonColor: "#3085d6",
			confirmButtonText: "Да, я понимаю риски удаления!",
			cancelButtonText: "Отмена"
		}).then((result) => {
			if (result.isConfirmed) {
				axios.delete(`/questions/${id}`).then(res => {
					Swal.fire({
						title: "Успешно!",
						text: "Данный вопрос был полностью удален",
						icon: "success"
					});
					location.href = `/tests/${res.data.test_id}/edit`;
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

	$(document).on('click', '.delete-question-asset', function () {
		let that = this;
		let path = $(that).data('path');
		axios.post('/questions/assets/delete', { path }).then(res => {

			$(that).parent().parent().remove();
			$('[data-bs-toggle="tooltip"]').tooltip();
		}).catch(err => {

		});
	});
	$(document).on('click', '.delete-answer', function () {
		let id = $(this).data('answer');
		axios.post('/answer/delete', { id });
	});
})