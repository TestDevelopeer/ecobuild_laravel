<!-- Repeater Html Start -->
<div id="repeater">
    <!-- Repeater Heading -->
    <div class="d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Ответы на вопрос</h5>
    </div>

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
                                    aria-label="Правильный ответ" value="">
                            </div>
                            <input data-name="text" id="text" type="text" class="form-control"
                                aria-label="Text input with radio button">
                        </div>
                    </div>
                </div>
                <!-- Repeater Remove Btn -->
                <div class="repeater-remove-btn">
                    <button class="btn btn-danger remove-btn px-4">
                        Удалить
                    </button>
                </div>
            </div>
        </div>
    </div>


</div>
<!-- Repeater End -->
