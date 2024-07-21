<!-- Repeater Html Start -->
<div id="repeater">
    <!-- Repeater Heading -->
    <div class="d-flex align-items-center justify-content-between flex-wrap">
        <h5 class="mb-4">Ответы на вопрос</h5>
    </div>
    @if (isset($questionEdit->id))
        @each('pages.test.questions.answers.answer-item', $questionEdit->answers, 'answer')
    @else
        @include('pages.test.questions.answers.answer-item')
    @endif
</div>
<!-- Repeater End -->
