@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body overflow-auto">
            <div class="accordion mb-4" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button @class(['accordion-button', 'collapsed' => $search == null]) type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseTwo" aria-expanded="{{ $search != null ? 'true' : 'false' }}"
                            aria-controls="collapseTwo">
                            Поиск пользователей
                        </button>
                    </h2>
                    <div id="collapseTwo" @class(['accordion-collapse collapse', 'show' => $search != null]) aria-labelledby="headingTwo"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <form action="{{ route('users.index') }}">
                                <div class="row mb-4">
                                    <div class="col-12 col-lg-4">
                                        <label for="surname" class="form-label">Фамилия</label>
                                        <input type="text" class="form-control" id="surname" name="search[surname]"
                                            value="{{ $search['surname'] ?? '' }}">
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <label for="name" class="form-label">Имя</label>
                                        <input type="text" class="form-control" id="name" name="search[name]"
                                            value="{{ $search['name'] ?? '' }}">
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <label for="patronymic" class="form-label">Отчество</label>
                                        <input type="text" class="form-control" id="patronymic" name="search[patronymic]"
                                            value="{{ $search['patronymic'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-12 col-lg-4">
                                        <label for="phone" class="form-label">Телефон</label>
                                        <input type="text" class="form-control" id="phone" name="search[phone]"
                                            value="{{ $search['phone'] ?? '' }}">
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="text" class="form-control" id="email" name="search[email]"
                                            value="{{ $search['email'] ?? '' }}">
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <label for="city" class="form-label">Город</label>
                                        <input type="text" class="form-control" id="city" name="search[city]"
                                            value="{{ $search['city'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 mt-4 d-flex justify-content-between">
                                        <button type="submit" class="btn btn-inverse-primary px-5">Поиск</button>
                                        <a href="{{ route('users.index') }}" type="button"
                                            class="btn btn-inverse-danger px-5">Сбросить</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <table class="table mb-0">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">ФИО</th>
                        <th scope="col">Телефон</th>
                        <th scope="col">Почта</th>
                        <th scope="col">Город</th>
                        <th scope="col">Дата регистрации</th>
                        <th scope="col">Действие</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <th scope="row">{{ $user->id }}</th>
                            <td><span @class([
                                'active' => $search != null && $search['surname'] == $user->surname,
                            ])>{{ $user->surname }}</span> <span
                                    @class([
                                        'active' => $search != null && $search['name'] == $user->name,
                                    ])>{{ $user->name }}</span> <span
                                    @class([
                                        'active' => $search != null && $search['patronymic'] == $user->patronymic,
                                    ])>{{ $user->patronymic }}</span></td>
                            <td><span @class([
                                'active' => $search != null && $search['phone'] == $user->phone,
                            ])>{{ $user->phone }}</span></td>
                            <td><span @class([
                                'active' => $search != null && $search['email'] == $user->email,
                            ])>{{ $user->email }}</span></td>
                            <td><span @class([
                                'active' => $search != null && $search['city'] == $user->city,
                            ])>{{ $user->city }}</span></td>
                            <td>{{ $user->created_at }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('users.edit', ['user' => $user->id]) }}" type="button"
                                        class="btn btn-outline-primary d-flex">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <x-button class="delete-user" :data-user="$user->id" type="button" is-outline=true
                                        color='danger'>
                                        <i class="fa-solid fa-trash"></i>
                                    </x-button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-2 d-flex justify-content-center">
            {{ $users->appends(request()->query())->links() }}
        </div>
    </div>
@endsection

@section('scripts')
    <script src="/assets/js/pages/user.js"></script>
@endsection
