$(function () {
	stepper2 = document.querySelector('#stepper2') != null ? new Stepper(document.querySelector('#stepper2'), {
		linear: false,
		animation: true,
	}) : null;

	let isStepValidated = false;

	document.querySelector('#stepper2').addEventListener('show.bs-stepper', function (event) {
		let from = event.detail.from + 1;
		let to = event.detail.to + 1;
		if (!isStepValidated && from < to) {
			event.preventDefault()
			console.log(event);

			let data = {};

			$('#test-nl-' + from).find('input').each(function () {
				data[this.name] = $(this).val();
			});
			$('.error-text').remove();
			$('.form-control.error').removeClass('error');

			axios.post('/register/validate', { step: from, data }).then(res => {
				isStepValidated = true;
				stepper2.next();
			}).catch(err => {
				let validate = err.response.data.errors;
				for (const key in validate) {
					$('#' + key).addClass('error');
					$(`<span class='error-text'>${validate[key]}</span>`).insertAfter('#' + key);
				}
			})
		}
		isStepValidated = false;
	});

	$(document).on('click', '#register', function () {
		let action = $('#register-form').attr('action');
		let data = $('#register-form').serializeArray().reduce(function (obj, item) {
			obj[item.name] = item.value;
			return obj;
		}, {});

		axios.post(action, data).then(res => {
			alert('success');
		}).catch(err => {
			let validate = err.response.data.errors;
			for (const key in validate) {
				$('#' + key).addClass('error');
				$(`<span class='error-text'>${validate[key]}</span>`).insertAfter('#' + key);
			}
		})
	});
});