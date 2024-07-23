<div @class(['tab-pane fade']) id="primary-pills-creative" role="tabpanel">
    @if (count($creatives) > 0)
        <div class="row">
            <div class="col-12 d-flex">
                <div class="">
                    <h5 class="mb-4 fw-bold">Выберите тестирование по которому отобразить задание</h5>
                    <div class="row row-cols-auto g-2">
                        @foreach ($user->succesResultsForCreative()->get() as $result)
                            <div class="col">
                                <button type="button" class="btn btn-outline-secondary show-creative"
                                    data-test="{{ $result->test->id }}">{{ $result->test->name }}</button>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12" id="user-creative">

            </div>
        </div>
    @else
        @include('components.alert', [
            'border' => true,
            'color' => 'primary',
            'icon' => 'fa-sharp fa-regular fa-circle-info fa-2x',
            'title' => 'Нет загруженных заданий!',
            'text' => 'Пользователь не выполнил ни одного креативного задания',
        ])
    @endif
</div>
