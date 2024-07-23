<div class="card w-100 rounded-4">
    <div class="card-body">
        @if ($user->succesResultsForCreative()->first())
            <div class="d-flex flex-column">
                @include('components.alert', [
                    'border' => true,
                    'color' => 'success',
                    'icon' => 'fa-sharp fa-regular fa-circle-info fa-2x',
                    'title' => 'Поздравляем!',
                    'text' =>
                        'Вы набрали достаточное количество баллов в одном из направлений, для того, чтобы принять участие в креативном задании!',
                ])
            </div>
        @endif
        <div class="row">
            @foreach ($tests as $test)
                <div class="col-12 col-lg-6 mb-2">
                    <div
                        class="d-flex flex-row gap-3 align-items-center justify-content-center border p-3 rounded-3 flex-fill">
                        <img src="{{ asset("storage/$test->icon") }}" width="40" height="40" class="rounded-circle"
                            alt="">
                        <div class="">
                            <h5 class="mb-0">{{ $test->resultByUser(Auth::id())->points ?? 0 }} баллов</h5>
                            <p class="mb-0">{{ $test->name }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<div class="info-list d-flex flex-column gap-3">
    <div class="info-list-item d-flex align-items-center gap-3"><i class="fa-solid fa-user"></i>
        <p class="mb-0">ФИО: {{ $user->surname . ' ' . $user->name . ' ' . $user->patronymic }}
        </p>
    </div>
    <div class="info-list-item d-flex align-items-center gap-3"><i class="fa-solid fa-envelope"></i>
        <p class="mb-0">Email: {{ $user->email }}</p>
    </div>
    <div class="info-list-item d-flex align-items-center gap-3"><i class="fa-solid fa-phone"></i>
        <p class="mb-0">Телефон: {{ $user->phone }}</p>
    </div>
    <div class="info-list-item d-flex align-items-center gap-3"><i class="fa-solid fa-city"></i>
        <p class="mb-0">Город: {{ $user->city }}</p>
    </div>
    <div class="info-list-item d-flex align-items-center gap-3"><i class="fa-solid fa-calendar-days"></i>
        <p class="mb-0">Дата регистрации: {{ $user->created_at }}</p>
    </div>
</div>
