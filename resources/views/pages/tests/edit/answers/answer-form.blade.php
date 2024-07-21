<!-- Repeater Html Start -->
<div id="repeater">
    <!-- Repeater Heading -->
    <div class="d-flex align-items-center justify-content-between flex-wrap">
        <h5 class="mb-4">Ответы на вопрос {{ $questionEdit != null ? "№$questionEdit->id" : '' }}</h5>
    </div>
    @if ($questionEdit != null)
        @each('pages.tests.edit.answers.answer-item', $questionEdit->answers, 'answer')
    @else
        @include('pages.tests.edit.answers.answer-item')
    @endif
</div>
<!-- Repeater End -->
<x-button class="repeater-add-btn w-100 mb-4" type='button' is-outline=true color='primary'>
    <i class="fa-solid fa-circle-plus"></i>
    Добавить новый ответ
</x-button>
