$(function () {
	document.querySelector('#stepper2').addEventListener('show.bs-stepper', function (event) {
		// You can call prevent to stop the rendering of your step
		// event.preventDefault()
		let from = event.detail.from + 1;
		let data = {};

		$('#test-nl-' + from).find('input').each(function () {
			// добавим новое свойство к объекту $data
			// имя свойства – значение атрибута name элемента
			// значение свойства – значение свойство value элемента
			data[this.name] = $(this).val();
		});

		console.log(data)
	});

	$(document).on('click', '#register', function () {
		let action = $('#register-form').attr('action');
		let data = $('#register-form').serializeArray().reduce(function (obj, item) {
			obj[item.name] = item.value;
			return obj;
		}, {});
		console.log(data);
	});
});