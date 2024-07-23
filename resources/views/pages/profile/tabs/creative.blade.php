<div @class([
    'tab-pane fade',
    'show active' => isset($type) && $type == 'creative',
]) id="primary-pills-creative" role="tabpanel">
    @if ($user->succesResultsForCreative()->first())
        <div class="row">
            <div class="col-12 d-flex">
                <div class="">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <h5 class="mb-0">Поздравляем, <span class="fw-600">{{ $user->name }}</span>
                        </h5>
                        <img src="/assets/images/apps/party-popper.png" width="24" height="24" alt="">
                    </div>
                    <p class="mb-4">Вы прошли во второй тур.</p>
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
    @else
        @include('components.alert', [
            'border' => true,
            'color' => 'primary',
            'icon' => 'fa-sharp fa-regular fa-circle-info fa-2x',
            'title' => 'Не набрано требуемое количество баллов',
            'text' => 'К сожалению, Вы не набрали достаточного количества баллов для участия в креативном задании',
        ])
    @endif
</div>
