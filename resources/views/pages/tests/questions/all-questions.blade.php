<div class="card">
    <div class="card-body overflow-auto">
        <h5 class="mb-4">Все вопросы данного теста</h5>
        <table class="table mb-0">
            <thead class="table-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Текст</th>
                    <th scope="col">Тип</th>
                    <th scope="col">Дата создания</th>
                    <th scope="col">Дата редактирования</th>
                    <th scope="col">Действие</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($questions as $question)
                    <tr @class([
                        'edited' => $questionEdit != null && $questionEdit->id == $question->id,
                    ])>
                        <th scope="row">{{ $question->id }}</th>
                        <td class="question-text" data-bs-toggle="tooltip" data-bs-placement="right"
                            title="{{ $question->text }}">{{ $question->text }}</td>
                        <td>{{ $question->type->name }}</td>
                        <td>{{ $question->created_at }}</td>
                        <td>{{ $question->updated_at }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('tests.edit', ['test' => $test->id, 'question' => $question->id, 'page' => request()->page]) }}"
                                    type="button" class="btn btn-outline-primary d-flex">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <x-button class='delete-question' :data-question="$question->id" type='button' is-outline=true
                                    color='danger'>
                                    <i class="fa-solid fa-trash"></i>
                                </x-button>

                            </div>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>

    </div>
    <div class="mt-2 d-flex justify-content-center">
        {{ $questions->appends(request()->query())->links() }}
    </div>
</div>
