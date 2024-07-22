<div @class([
    'tab-pane fade',
    'show active' => !isset($type) || $type == 'results',
]) id="primary-pills-results" role="tabpanel">
    @if (count($results) > 0)
        <div class="accordion" id="accordionExample">
            @foreach ($results as $res)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Тестирование "{{ $res->test->name }}"
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body overflow-auto">
                            <table class="table mb-0">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">Вопрос</th>
                                        <th scope="col">Ваш ответ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($res->quiz as $quiz)
                                        <tr>
                                            <td class="text-no-wrap">{!! $quiz->question->text !!}</td>
                                            <td class="text-no-wrap">{{ $quiz->answer->text }}</td>
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
