$(function () {
	$('#feedbackModal').on('shown.bs.modal', function () {
		$('#message').trigger('focus')
	})
	$(document).on('click', '.feedback-modal', function () {
		axios.post('/feedback/check').then(res => {
			$('#feedbackModal').modal('show');
		}).catch(err => {
			Swal.fire({
				title: "Внимание!",
				icon: "info",
				html: `Вы уже отправляли недавно обращение. Пожалуйста, дождитесь ответа, или воспользуйтесь разделом <a href='/contact'>Контакты</a>`,
			});
		});
	})
	$(document).on('click', '#send-feedback', function () {
		let action = $('#feedback-form').attr('action');
		let data = $('#feedback-form').serializeArray().reduce(function (obj, item) {
			obj[item.name] = item.value;
			return obj;
		}, {});
		$('.error-text').remove();
		$('.form-control.error').removeClass('error');
		axios.post('/feedback', data).then(res => {
			$('#feedbackModal').modal('hide');
			Swal.fire(
				'Успешно!',
				'Спасибо за обращение, мы обязательно с Вами свяжемся',
				'success'
			);
		}).catch(err => {
			let validate = err.response.data.errors;
			for (const key in validate) {
				$('#' + key).addClass('error');
				$(`<span class='error-text'>${validate[key]}</span>`).insertAfter('#' + key);
			}
		})
	})

	$(document).on('click', '.read-feedback', function () {
		let that = this;
		let feedbackId = $(that).data('feedback');

		axios.post('/feedbacks/read', { feedbackId }).then(res => {
			$(that).addClass('text-dark');
		})
	})
});