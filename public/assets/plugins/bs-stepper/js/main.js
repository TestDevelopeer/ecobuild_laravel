var stepper1
var stepper2
var stepper3
var stepper4
var stepperForm

document.addEventListener('DOMContentLoaded', function () {
	stepper1 = document.querySelector('#stepper1') != null ? new Stepper(document.querySelector('#stepper1')) : null;
	/*stepper2 = document.querySelector('#stepper2') != null ? new Stepper(document.querySelector('#stepper2'), {
		linear: false,
		animation: true,
	}) : null;*/

	stepper3 = document.querySelector('#stepper3') != null ? new Stepper(document.querySelector('#stepper3')) : null;


	/*var stepperFormEl = document.querySelector('#stepperForm')
	stepperForm = new Stepper(stepperFormEl, {
		animation: true
	})

	var btnNextList = [].slice.call(document.querySelectorAll('.btn-next-form'))
	var stepperPanList = [].slice.call(stepperFormEl.querySelectorAll('.bs-stepper-pane'))
	var inputMailForm = document.getElementById('inputMailForm')
	var inputPasswordForm = document.getElementById('inputPasswordForm')
	var form = stepperFormEl.querySelector('.bs-stepper-content form')

	btnNextList.forEach(function (btn) {
		btn.addEventListener('click', function () {
			stepperForm.next()
		})
	})

	stepperFormEl.addEventListener('show.bs-stepper', function (event) {
		form.classList.remove('was-validated')
		var nextStep = event.detail.indexStep
		var currentStep = nextStep

		if (currentStep > 0) {
			currentStep--
		}

		var stepperPan = stepperPanList[currentStep]

		if ((stepperPan.getAttribute('id') === 'test-form-1' && !inputMailForm.value.length)
			|| (stepperPan.getAttribute('id') === 'test-form-2' && !inputPasswordForm.value.length)) {
			event.preventDefault()
			form.classList.add('was-validated')
		}
	})*/
})
