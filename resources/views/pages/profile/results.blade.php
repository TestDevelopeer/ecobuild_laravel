<div @class([
    'tab-pane fade',
    'show active' => !isset($type) || $type == 'results',
]) id="primary-pills-results" role="tabpanel">
    @if ($user->result('eco'))
    @else
        @include('components.alert', [
            'border' => true,
            'color' => 'primary',
            'icon' => 'fa-sharp fa-regular fa-circle-info fa-2x',
            'title' => 'Нет ответов по экологии!',
            'text' =>
                'Ваши ответы на вопросы по экологии появятся после полного прохождения <a href="#">тестирования</a>!',
        ])
    @endif
    @if ($user->result('build'))
    @else
        @include('components.alert', [
            'border' => true,
            'color' => 'primary',
            'icon' => 'fa-sharp fa-regular fa-circle-info fa-2x',
            'title' => 'Нет ответов по строительству!',
            'text' =>
                'Ваши ответы на вопросы по строительству появятся после полного прохождения <a href="#">тестирования</a>!',
        ])
    @endif
</div>
