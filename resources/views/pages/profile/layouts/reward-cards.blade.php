<div class="row row-cols-1 g-3">
    <div class="col">
        <div class="card rounded-4 mb-0 border">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <i class="fa-regular fa-file-certificate fa-2x text-success"></i>
                </div>
                <div class="mt-4">
                    <h4 class="mb-0 fw-light">Сертификат участника</h4>
                    <p class="mb-0">За прохождение тестирования "{{ $result->test->name }}"</p>
                </div>
                <div class="d-flex align-items-center justify-content-end gap-1 mt-3">
                    <button type="button" class="btn btn-outline-success px-4 d-flex align-items-center gap-2"><i
                            class="fa-regular fa-download"></i>Скачать</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card rounded-4 mb-0 border">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    @if ($result->points < config('custom.diplom.third'))
                        <i class="fa-sharp fa-regular fa-file-lock fa-2x"></i>
                    @else
                        <img src="{{ asset("storage/{$result->test->icon}") }}" width="35" height="35"
                            alt="">
                    @endif
                </div>
                <div class="mt-4">
                    <h4 class="mb-0 fw-light">
                        Диплом
                        @if ($result->points >= config('custom.diplom.third'))
                            {{ $result->points < config('custom.diplom.second') ? 'III' : ($result->points < config('custom.diplom.first') ? 'II' : 'I') }}
                            степени
                        @endif
                    </h4>
                    @if ($result->points < config('custom.diplom.third'))
                        <p class="mb-0">Требуется минимум {{ config('custom.diplom.third') }} баллов, чтобы получить
                            диплом</p>
                    @else
                        По результатам тестирования "{{ $result->test->name }}"
                    @endif
                </div>
                <div class="d-flex align-items-center justify-content-end gap-1 mt-3">
                    @if ($result->points < config('custom.diplom.third'))
                        <button disabled type="button"
                            class="btn btn-outline-secondary px-4 d-flex align-items-center gap-2"><i
                                class="fa-solid fa-lock-keyhole"></i>Скачать</button>
                    @else
                        <button type="button" class="btn btn-outline-success px-4 d-flex align-items-center gap-2"><i
                                class="fa-regular fa-download"></i>Скачать</button>
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>
