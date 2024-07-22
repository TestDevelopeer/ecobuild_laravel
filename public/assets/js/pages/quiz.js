$(function () {
	$(document).on('click', ".radio-field, .option", function () {
		$(".radio-field").parent().removeClass('active');
		$(this).parent().addClass("active");
		$('#next-quiz').removeAttr('disabled');
	});

	$(document).on('click', '#next-quiz', function () {
		let action = $('#quiz-form').attr('action');
		let answer_id = $('input[name=answer_id]:checked', '#quiz-form').val();
		$('#next-quiz').attr('disabled', true);
		$('#next-quiz span').addClass('spinner-border');

		axios.patch(action, { answer_id }).then(res => {
			axios.get(`/tests/${res.data.test}?render=true`).then(res => {
				$('#quiz-container').html(res.data.html);
			});
		});
	});
})