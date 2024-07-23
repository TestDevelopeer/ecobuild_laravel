<div @class([
    'tab-pane fade',
    'show active' => !isset($type) || $type == 'results',
]) id="primary-pills-results" role="tabpanel">
    @if (count($results) > 0)
        <div class="accordion" id="accordionExample">
            @foreach ($results as $res)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading{{ $res->test->id }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse{{ $res->test->id }}" aria-expanded="false"
                            aria-controls="collapse{{ $res->test->id }}">
                            Тестирование "{{ $res->test->name }}"
                        </button>
                    </h2>
                    <div id="collapse{{ $res->test->id }}" class="accordion-collapse collapse"
                        aria-labelledby="heading{{ $res->test->id }}" data-bs-parent="#accordionExample">
                        <div class="accordion-body overflow-auto">
                            <table class="table mb-0">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">ID вопроса</th>
                                        <th scope="col">Вопрос</th>
                                        <th scope="col">Ответ пользователя</th>
                                        <th scope="col">Дата</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($res->quiz as $quiz)
                                        <tr>
                                            <td>{{ $quiz->question_id }}</td>
                                            <td class="question-text" data-bs-toggle="tooltip" data-bs-placement="right"
                                                title="{{ $quiz->question->text }}">{{ $quiz->question->text }}</td>
                                            <td class="question-text" data-bs-toggle="tooltip" data-bs-placement="right"
                                                title="{{ $quiz->answer->text }}">{{ $quiz->answer->text }}</td>
                                            <td>{{ $quiz->created_at }}</td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
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
