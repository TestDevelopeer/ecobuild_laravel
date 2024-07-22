<div @class([
    'tab-pane fade',
    'show active' => !isset($type) || $type == 'results',
]) id="primary-pills-results" role="tabpanel">
    @if ($user->results()->first())
    @else
        @include('components.alert', [
            'border' => true,
            'color' => 'primary',
            'icon' => 'fa-sharp fa-regular fa-circle-info fa-2x',
            'title' => 'Нет завершенных тестирований!',
            'text' =>
                'Ваши ответы на вопросы появятся после полного прохождения хотя бы одного <a href="#">тестирования</a>!',
        ])
    @endif
</div>
