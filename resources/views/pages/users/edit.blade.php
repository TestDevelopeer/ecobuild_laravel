@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="card rounded-4">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between mb-3">
                        <div class="">
                            <h5 class="mb-0 fw-bold" id="profile-info-title">Тестирования</h5>
                        </div>
                    </div>
                    <div class="">
                        <div class="card w-100 rounded-4">
                            <div class="card-body">
                                <div class="row">
                                    @foreach ($tests as $test)
                                        <div class="col-12 col-lg-6 mb-2">
                                            <div class="d-flex justify-content-between border p-3 rounded-3 ">
                                                <div
                                                    class="d-flex flex-row gap-3 align-items-center justify-content-center flex-fill">
                                                    <img src="{{ asset("storage/$test->icon") }}" width="40"
                                                        height="40" class="rounded-circle" alt="">
                                                    <div class="">
                                                        <h5 class="mb-0">{{ $test->resultByUser($user->id)->points ?? 0 }}
                                                            баллов</h5>
                                                        <p class="mb-0">{{ $test->name }}</p>
                                                    </div>
                                                </div>
                                                @if (isset($test->resultByUser($user->id)->points))
                                                    <div>
                                                        <button title="Сбросить тестирование" type="button"
                                                            class="btn btn-outline-warning px-4 d-flex gap-2 refresh-test"
                                                            data-test="{{ $test->id }}"><i
                                                                class="fa-solid fa-arrows-rotate"></i></button>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('users.update', ['user' => $user->id]) }}" method="post" class="row">
                            @csrf
                            @method('PATCH')
                            <div class="d-flex align-items-start justify-content-between mb-3">
                                <div class="">
                                    <h5 class="mb-0 fw-bold" id="profile-info-title">Данные пользователя</h5>
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <label class="form-label">ID</label>
                                        <input type="text" class="form-control" disabled readonly
                                            value="{{ $user->id }}">
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <label class="form-label">IP</label>
                                        <input type="text" class="form-control" disabled readonly
                                            value="{{ $user->ip }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="col-12 mb-2">
                                    <label class="form-label">Фамилия</label>
                                    @error('surname')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <input type="text" class="form-control" name="surname"
                                        value="{{ old('surname') ?? $user->surname }}">
                                </div>
                                <div class="col-12 mb-2">
                                    <label class="form-label">Имя</label>
                                    @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <input type="text" class="form-control" name="name"
                                        value="{{ old('name') ?? $user->name }}">
                                </div>
                                <div class="col-12 mb-2">
                                    <label class="form-label">Отчество</label>
                                    @error('patronymic')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <input type="text" class="form-control" name="patronymic"
                                        value="{{ old('patronymic') ?? $user->patronymic }}">
                                </div>
                                <div class="col-12 mb-2">
                                    <label class="form-label">Город</label>
                                    @error('city')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <input type="text" class="form-control" name="city"
                                        value="{{ old('city') ?? $user->city }}">
                                </div>
                                <div class="col-12 mb-2">
                                    <label class="form-label">Телефон</label>
                                    @error('phone')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <input type="text" class="form-control phone-mask" name="phone"
                                        value="{{ old('phone') ?? $user->phone }}">
                                </div>
                                <div class="col-12 mb-2">
                                    <label class="form-label">Email</label>
                                    @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <input type="text" class="form-control" name="email"
                                        value="{{ old('email') ?? $user->email }}">
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="col-12 mb-2">
                                    <label class="form-label">Учебное заведение</label>.
                                    @error('school')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <input type="text" class="form-control" name="school"
                                        value="{{ old('school') ?? $user->school }}">
                                </div>
                                <div class="col-12 mb-2">
                                    <label class="form-label">Класс/курс</label>
                                    @error('classroom')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <input type="text" class="form-control" name="classroom"
                                        value="{{ old('classroom') ?? $user->classroom }}">
                                </div>
                                <div class="col-12 mb-2">
                                    <label class="form-label">Преподаватель</label>.
                                    @error('teacher')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <input type="text" class="form-control" name="teacher"
                                        value="{{ old('teacher') ?? $user->teacher }}">
                                </div>
                                <div class="col-12 mb-2">
                                    <label class="form-label">Должность</label>
                                    @error('teacher_job')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <input type="text" class="form-control" name="teacher_job"
                                        value="{{ old('teacher_job') ?? $user->teacher_job }}">
                                </div>
                                <div class="col-12 mb-2">
                                    <label class="form-label">Соц. сеть</label>
                                    <input type="text" class="form-control" name="link"
                                        value="{{ old('link') ?? $user->link }}">
                                </div>
                                <div class="col-12 mb-2">
                                    <label class="form-label">Роль</label>
                                    @error('role')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <select class="form-select" name="role">
                                        <option class="bg-secondary text-white" readonly selected
                                            value="{{ $user->role }}">
                                            {{ $user->role == 'admin' ? 'Администратор' : 'Пользователь' }}
                                        </option>
                                        <option value="{{ $user->role == 'admin' ? 'user' : 'admin' }}">
                                            {{ $user->role == 'admin' ? 'Пользователь' : 'Администратор' }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 mt-4">
                                <div class="d-md-flex d-grid align-items-center justify-content-between gap-3">
                                    <x-button type='submit' is-outline=true color='success'>
                                        <i class="fa-solid fa-floppy-disk"></i>
                                        Сохранить
                                    </x-button>
                                    <x-button class="delete-user" type='button' :data-user="$user->id" is-outline=true
                                        color="danger">
                                        <i class="fa-solid fa-trash"></i>
                                        Удалить
                                    </x-button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card rounded-4">
                <div class="card-body">
                    <ul class="nav nav-pills mb-3" role="tablist">
                        @foreach ($menuButtons as $key => $button)
                            <li class="nav-item" role="presentation">
                                <a @class(['nav-link profile-menu-button', 'active' => $key == 0]) data-bs-toggle="pill" data-title="{{ $button['title'] }}"
                                    href="#primary-pills-{{ $button['type'] }}" role="tab" aria-selected="false">
                                    <div class="d-flex align-items-center">
                                        <div class="tab-icon"><i class="{{ $button['icon'] }} me-1 fs-6"></i>
                                        </div>
                                        <div class="tab-title">{{ $button['title'] }}</div>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        @foreach ($menuButtons as $menu)
                            @include('pages.users.tabs.' . $menu['type'])
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="/assets/js/pages/user.js"></script>
    <script src="/assets/js/pages/creative.js"></script>
    @if (session('status') == 'success')
        <script>
            successSaveTest("{{ session('message') }}");
        </script>
    @endif
@endsection
