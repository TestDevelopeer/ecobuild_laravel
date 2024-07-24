function successSaveTest(text) {
	Lobibox.notify('success', {
		pauseDelayOnHover: true,
		size: 'mini',
		rounded: true,
		icon: 'fa-solid fa-check',
		delayIndicator: false,
		continueDelayOnInactiveTab: false,
		position: 'top center',
		msg: text
	});
}

$(function () {
	$('[data-bs-toggle="tooltip"]').tooltip();

	$(document).on('click', '.show-creative', function () {
		let testId = $(this).data('test');
		let userId = $(this).data('user');

		$('.show-creative').removeClass('btn-success');
		$(this).addClass('btn-success');

		axios.post('/creative', { id: testId, userId }).then(res => {
			$('#user-creative').html(res.data.html);
		})
	});

	$(document).on('click', '.send-comment', function () {
		let creativeUpload = $(this).data('creative');

		axios.post('/creative/comment', { creativeUpload, comment: $('#comment').val() }).then(res => {
			successSaveTest(res.data.message);
		})
	});
})