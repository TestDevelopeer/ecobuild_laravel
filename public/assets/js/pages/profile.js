let pond = null;
let assets = [];
function notification(type, message) {
	Lobibox.notify(type, {
		pauseDelayOnHover: true,
		size: 'mini',
		rounded: true,
		icon: 'fa-solid fa-triangle-exclamation',
		delayIndicator: false,
		continueDelayOnInactiveTab: false,
		position: 'top center',
		msg: message
	});
}

function fileUploaderInit() {
	FilePond.registerPlugin(
		FilePondPluginFileEncode,
		FilePondPluginFileValidateType,
		FilePondPluginFileValidateSize,
		FilePondPluginImageExifOrientation,
		FilePondPluginImagePreview
	);

	pond = FilePond.create(document.getElementById('creative-uploader'));
	pond.setOptions({
		...filepondLocale,
		acceptedFileTypes: ["image/png", "image/jpeg", "video/mp4", "video/avi", "application/msword", "text/plain"],
		server: {
			process: {
				url: './creative/process',
				onload: function (res) {
					assets.push(res);
					$('#creative-upload').addClass('btn-outline-success');
					$('#creative-upload').removeAttr('disabled');
				}
			},
			headers: {
				'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
			}
		},
		allowMultiple: true,
	});


}

$(function () {
	$('[data-bs-toggle="tooltip"]').tooltip();

	$(document).on('click', '.upload-creative', function () {
		let action = $('#creative-form').attr('action');
		if (!assets[0] || assets[0].length == 0) {
			Swal.fire({
				title: "Ошибка!",
				text: "Добавьте файлы в форму, после чего нажмите Загрузить",
				icon: "error"
			});
		} else {
			axios.post(action, { creative_assets: assets }).then(res => {
				$('#creative-upload-container').html(res.data.html);
				Swal.fire({
					title: "Успешно!",
					text: "Файлы загружены, ожидайте ответа",
					icon: "success"
				});
			}).catch(err => {
				Swal.fire({
					title: "Ошибка!",
					text: "Попробуйте загрузить файлы позже",
					icon: "error"
				});
			})
		}
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

	$(document).on('click', '.show-creative', function () {
		let id = $(this).data('test');

		$('.show-creative').removeClass('btn-success');
		$(this).addClass('btn-success');

		axios.post('/creative', { id }).then(res => {
			$('#profile-info-title').html('Креативное задание');
			$('.back-to-info').removeClass('d-none');
			$('.full-info').addClass('d-none');
			$('.other-info').html(res.data.html);
			fileUploaderInit();
		})
	});

	$(document).on('click', '.back-to-info', function () {
		$('#profile-info-title').html('Данные абитуриента');
		$(this).addClass('d-none');
		$('.show-rewards').removeClass('btn-success');
		$('.show-creative').removeClass('btn-success');
		$('.full-info').removeClass('d-none');
		$('.other-info').html('');
	});
});