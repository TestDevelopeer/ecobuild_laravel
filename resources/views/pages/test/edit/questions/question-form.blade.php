<div class="card">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between mb-4">
            @if ($questionEdit != null)
                <h5>Редактировать вопрос №{{ $questionEdit->id }}</h5>
                <a href="{{ route('test.edit', ['id' => $test->id]) }}" class="btn btn-secondary px-4">Отмена</a>
            @else
                <h5>Добавить новый вопрос</h5>
            @endif
        </div>
        <form action="{{ $questionEdit != null ? route('question.save') : route('question.add') }}" method="post"
            class="row mt-4" enctype="multipart/form-data">
            @csrf
            <input type="text" readonly hidden name="test_id" value="{{ $test->id }}">
            @if ($questionEdit != null)
                <input type="text" readonly hidden id="question_id" name="question_id"
                    value="{{ $questionEdit->id }}">
            @endif
            <div class="col-12 mb-4">
                <label for="type_id" class="form-label">Тип вопроса</label>
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
                @include('pages.test.edit.questions.question-asset')
            </div>
            <div class="col-12 mb-4 d-none" id="question_asset">
                <label for="question_asset" class="form-label">Выберите файл для вопроса</label>
                @error('question_assets')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <input class="form-control" type="file" id="question_asset_input" name="question_assets[]"
                    accept="image/*, video/*, audio/*" multiple>
            </div>
            <div class="col-12">
                <label for="text" class="form-label">Текст вопроса</label>
                @error('text')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <textarea class="form-control @error('text') error @enderror" name="text" id="text"
                    placeholder="Введите текст вопроса" rows="3">{{ old('text') != null ? old('text') : (isset($questionEdit->text) ? $questionEdit->text : '') }}</textarea>
            </div>
            <div class="col-12 mt-4">
                @include('pages.test.edit.answers.answer-form')
            </div>
            <div class="col-12 mt-4">
                <div class="d-flex align-items-center justify-content-between">
                    @if ($questionEdit != null)
                        <x-button type='submit' is-outline=true color='success'>
                            <i class="fa-solid fa-floppy-disk"></i>
                            Сохранить вопрос
                        </x-button>
                        <x-button class="delete-question" type='button' :data-question="$questionEdit->id" :data-test="$test->id"
                            is-outline=true color="danger">
                            <i class="fa-solid fa-trash"></i>
                            Удалить вопрос
                        </x-button>
                    @else
                        <x-button type='submit' is-outline=true color='primary'>
                            <i class="fa-solid fa-circle-plus"></i>
                            Создать вопрос
                        </x-button>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>
