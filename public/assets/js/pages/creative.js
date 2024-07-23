$(function () {
	$(document).on('click', '#creative-archive', function () {
		let creativeId = $(this).data('creative');
		let userId = $(this).data('user');

		axios.post('/creative/archive', { creativeId, userId }).then(res => {
			$('#archive-link').attr('href', res.data.link);
			$('#archive-link').click();
		})
	})
});