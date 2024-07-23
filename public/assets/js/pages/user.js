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
		let id = $(this).data('test');

		$('.show-creative').removeClass('btn-success');
		$(this).addClass('btn-success');

		axios.post('/creative', { id }).then(res => {
			$('#user-creative').html(res.data.html);
		})
	});
})