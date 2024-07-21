<!-- Repeater Items -->
<div class="items" data-group="answers">
    <div class="card">
        <div class="card-body">
            <!-- Repeater Content -->
            <div class="item-content">
                <div class="mb-3">
                    <label for="text" class="form-label">Ответ</label>
                    @error('answers.0.text')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="input-group">
                        <div class="input-group-text">
                            <input data-name="is_true" id="is_true" class="form-check-input" type="radio"
                                aria-label="Правильный ответ" @checked($answer->is_true ?? false) value="">
                        </div>
                        <input data-name="text" id="text" type="text"
                            class="form-control @error('answers.0.text') error @enderror"
                            value="{{ $answer->text ?? '' }}" placeholder="Введите ответ на вопрос">
                        @if (isset($answer))
                            <input hidden readonly data-name="answer_id" id="answer_id" type="text"
                                class="form-control" value="{{ $answer->id }}">
                        @endif
                    </div>
                </div>
            </div>
            <!-- Repeater Remove Btn -->
            <div class="repeater-remove-btn">
                <x-button class="remove-btn delete-answer" :data-answer="$answer->id ?? 0" type='button' is-outline=true
                    color='danger'>
                    Удалить
                </x-button>
            </div>
        </div>
    </div>
</div>
