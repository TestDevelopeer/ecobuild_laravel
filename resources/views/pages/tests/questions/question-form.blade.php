<div class="card">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between mb-4">
            @if ($questionEdit != null)
                <h5>Редактировать вопрос №{{ $questionEdit->id }}</h5>
                <a href="{{ route('tests.edit', ['test' => $test->id]) }}" class="btn btn-secondary px-4">Отмена</a>
            @else
                <h5>Добавить новый вопрос</h5>
            @endif
        </div>
        <form
            action="{{ $questionEdit != null ? route('questions.update', ['question' => $questionEdit->id]) : route('tests.questions.store', ['test' => $test->id]) }}"
            method="post" class="row mt-4" enctype="multipart/form-data" id="question-form">
            @if ($questionEdit != null)
                @method('PATCH')
            @endif
            @csrf
            <div class="col-12 mb-4">
                <label for="type_id" class="form-label">Тип вопроса</label>
                <select id="type_id" name="type_id" class="form-select">
                    @foreach ($questionTypes as $type)
                        <option
                            {{ old('type_id') == $type->id || ($questionEdit != null && $questionEdit->type_id == $type->id) ? 'selected' : '' }}
                            value="{{ $type->id }}">
                            {{ $type->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 mb-4" id="question-assets_block">
                @include('pages.tests.questions.question-asset')
            </div>
            <div class="col-12 mb-4 d-none" id="question_asset">
                <label for="question_asset" class="form-label">Выберите файл для вопроса</label>

                <input class="form-control" type="file" id="question_asset_input" name="question_assets[]"
                    accept="image/*, video/*, audio/*" multiple>
                @include('components.error-text', ['name' => 'question_assets'])
            </div>
            <div class="col-12 mb-4">
                <label for="text" class="form-label">Текст вопроса</label>
                @include('components.error-text', ['name' => 'text'])
                <div id="editor" class="form-control @error('text') error @enderror">
                    {!! old('html') != null ? old('html') : $questionEdit->html ?? '' !!}</div>
                <textarea hidden rows="1" name="text" id="text"></textarea>
                <textarea hidden rows="1" name="html" id="html"></textarea>
            </div>
            <div class="col-12 mt-4">
                @include('pages.tests.questions.answers.answer-form')
            </div>
            <div class="col-12 mt-4">
                <div class="d-flex align-items-center justify-content-between">
                    @if ($questionEdit != null)
                        <x-button type='button' is-outline=true color='success' class="save-question">
                            <i class="fa-solid fa-floppy-disk"></i>
                            Сохранить вопрос
                        </x-button>
                        <x-button class="delete-question" type='button' :data-question="$questionEdit->id" is-outline=true
                            color="danger">
                            <i class="fa-solid fa-trash"></i>
                            Удалить вопрос
                        </x-button>
                    @else
                        <x-button type='button' is-outline=true color='primary' class="save-question">
                            <i class="fa-solid fa-message-plus"></i>
                            Создать вопрос
                        </x-button>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>
