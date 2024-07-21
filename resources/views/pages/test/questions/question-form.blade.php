<div class="card">
    <div class="card-body p-4">
        <h5 class="mb-4">
            {{ isset($questionEdit->id) ? "Редактировать вопрос №$questionEdit->id" : 'Добавить новый вопрос' }}
        </h5>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ isset($questionEdit->type_id) ? route('question.save') : route('question.add') }}" method="post"
            class="row mt-4" enctype="multipart/form-data">
            @csrf
            <input type="text" readonly hidden name="test_id" value="{{ $test->id }}">
            @if (isset($questionEdit->type_id))
                <input type="text" readonly hidden id="question_id" name="question_id"
                    value="{{ $questionEdit->id }}">
            @endif
            <div class="col-12 mb-4">
                <label for="type_id" class="form-label">Тип вопроса {{ old('type_id') }}</label>
                <select id="type_id" name="type_id" class="form-select">
                    @foreach ($questionTypes as $type)
                        <option
                            {{ old('type_id') == $type->id || (isset($questionEdit->type_id) && $questionEdit->type_id == $type->id) ? 'selected' : '' }}
                            value="{{ $type->id }}">
                            {{ $type->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 mb-4" id="question-assets_block">
                @include('pages.test.questions.question-asset')
            </div>
            <div class="col-12 mb-4 d-none" id="question_asset">
                <label for="question_asset" class="form-label">Выберите файл для вопроса</label>
                <input class="form-control" type="file" id="question_asset_input" name="question_assets[]"
                    accept="image/*, video/*, audio/*" multiple>
            </div>
            <div class="col-12">
                <label for="text" class="form-label">Текст вопроса</label>
                <textarea class="form-control" name="text" id="text" placeholder="Введите текст вопроса" rows="3">{{ old('text') != null ? old('text') : (isset($questionEdit->text) ? $questionEdit->text : '') }}</textarea>
            </div>
            <div class="col-12 mt-4">
                @include('pages.test.questions.answers.answer-form')
                <button type="button"
                    class="btn btn-outline-primary repeater-add-btn px-4 d-flex gap-2 justify-content-center align-items-center w-100 mb-4">
                    <i class="fa-solid fa-circle-plus"></i>
                    Добавить новый ответ
                </button>
            </div>
            <div class="col-12 mt-4">
                <div class="d-flex align-items-center justify-content-between">
                    <button type="submit" @class([
                        'btn px-4 d-flex gap-2 justify-content-center align-items-center',
                        'btn-outline-success' => isset($questionEdit->id),
                        'btn-outline-primary' => !isset($questionEdit->id),
                    ])>
                        @if (isset($questionEdit->id))
                            <i class="fa-solid fa-floppy-disk"></i>
                            Сохранить вопрос
                        @else
                            <i class="fa-solid fa-circle-plus"></i>
                            Создать вопрос
                        @endif
                    </button>
                    @if (isset($questionEdit->id))
                        @include('components.button', [
                            'data' => [
                                'question' => $questionEdit->id,
                                'test' => $test->id,
                            ],
                            'outline' => true,
                            'style' => 'danger',
                            'classes' => 'delete-question',
                            'icon' => 'fa-solid fa-trash',
                            'text' => 'Удалить вопрос',
                        ])
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>
