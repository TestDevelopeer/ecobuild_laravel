$(function () {
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
});