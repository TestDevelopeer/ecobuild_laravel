$(function () {
	$('[data-bs-toggle="tooltip"]').tooltip();
	$('.creative-uploader').FancyFileUpload({
		params: {
			action: 'fileuploader'
		},
		maxfilesize: 1000000
	});

	$(document).on('click', '.profile-menu-button', function () {
		let title = $(this).data('title');
		$('.breadcrumb-item.active').html(title);
	});

	$(document).on('click', '.show-rewards', function () {
		let id = $(this).data('result');

		$('.show-rewards').removeClass('btn-success');
		$(this).addClass('btn-success');

		axios.post('/reward', { id }).then(res => {
			$('#profile-info-title').html('Награды за тестирование');
			$('.back-to-info').removeClass('d-none');
			$('.full-info').addClass('d-none');
			$('.other-info').html(res.data.html);
		})
	});

	$(document).on('click', '.back-to-info', function () {
		$('#profile-info-title').html('Данные абитуриента');
		$(this).addClass('d-none');
		$('.show-rewards').removeClass('btn-success');
		$('.full-info').removeClass('d-none');
		$('.other-info').html('');
	});
});