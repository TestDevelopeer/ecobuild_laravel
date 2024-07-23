<div @class([
    'tab-pane fade',
    'show active' => isset($type) && $type == 'rewards',
]) id="primary-pills-rewards" role="tabpanel">
    @if (count($results) > 0)
        <h5 class="mb-4 fw-bold">Выберите тестирование по которому отобразить награды</h5>
        <div class="row row-cols-auto g-2">
            @foreach ($results as $result)
                <div class="col">
                    <button type="button" class="btn btn-outline-secondary show-rewards"
                        data-result="{{ $result->id }}">{{ $result->test->name }}</button>
                </div>
            @endforeach
        </div>
    @else
        @include('components.alert', [
            'border' => true,
            'color' => 'primary',
            'icon' => 'fa-sharp fa-regular fa-circle-info fa-2x',
            'title' => 'Не найдено пройденных тестирований',
            'text' => 'Пройдите хотя бы одно тестирование, чтобы получить награду',
        ])
    @endif
</div>
