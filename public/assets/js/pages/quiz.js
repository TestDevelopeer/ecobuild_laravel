let reloadTry = 0;

function loadQuiz() {
	let id = $('#quiz-container').data('test');
	axios.post(`/quizzes/${id}`).then(res => {
		if (res.data.redirect) {
			location.href = res.data.redirect;
		}
		$('#quiz-container').html(res.data.html);
		$('#quiz-container .preload').unblock();
	}).catch(err => {
		if (reloadTry < 3) {
			reloadTry++;
			loadQuiz();
		} else {
			Swal.fire({
				title: "Упс...",
				text: "Не смогли загрузить вопросы, пожалуйста, обновите страницу",
				icon: "error"
			});
		}
	});
}

$(function () {
	$('#quiz-container .preload').block({
		message: 'Тестирование загружается...',
		fadeIn: 100,
		overlayCSS: {
			backgroundColor: '#1b2024',
			opacity: 0.8,
			zIndex: 1200,
			cursor: 'wait'
		},
		css: {
			border: 0,
			color: '#fff',
			zIndex: 1201,
			padding: 0,
			backgroundColor: 'transparent'
		}
	});
	loadQuiz();

	$(document).on('click', ".radio-field, .option", function () {
		$(".radio-field").parent().removeClass('active');
		$(this).parent().addClass("active");
		$('#next-quiz').removeAttr('disabled');
	});

	$(document).on('click', '#next-quiz', function () {
		$('.input-field').removeClass('bounce-left');
		$('.input-field').addClass('bounce-right');

		setTimeout(() => {
			let action = $('#quiz-form').attr('action');
			let answer_id = $('input[name=answer_id]:checked', '#quiz-form').val();
			$('#next-quiz').attr('disabled', true);
			$('#next-quiz span').addClass('spinner-border');

			axios.patch(action, { answer_id }).then(res => {
				if (res.data.redirect) {
					location.href = res.data.redirect;
				}
				$('#quiz-container').html(res.data.html);
			});
		}, 500);
	});
})