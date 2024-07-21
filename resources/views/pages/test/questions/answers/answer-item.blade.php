<!-- Repeater Items -->
<div class="items" data-group="answers">
    <div class="card">
        <div class="card-body">
            <!-- Repeater Content -->
            <div class="item-content">
                <div class="mb-3">
                    <label for="text" class="form-label">Ответ</label>
                    <div class="input-group">
                        <div class="input-group-text">
                            <input data-name="is_true" id="is_true" class="form-check-input" type="radio"
                                aria-label="Правильный ответ" @checked($answer->is_true ?? false) value="">
                        </div>
                        <input data-name="text" id="text" type="text" class="form-control"
                            value="{{ $answer->text ?? '' }}">
                        @if (isset($answer->id))
                            <input hidden readonly data-name="answer_id" id="answer_id" type="text"
                                class="form-control" value="{{ $answer->id }}">
                        @endif
                    </div>
                </div>
            </div>
            <!-- Repeater Remove Btn -->
            <div class="repeater-remove-btn">
                <button data-answer="{{ $answer->id ?? 0 }}" class="btn btn-danger remove-btn px-4 delete-answer">
                    Удалить
                </button>
            </div>
        </div>
    </div>
</div>
