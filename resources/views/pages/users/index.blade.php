@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body overflow-auto">
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
                            <td>{{ $user->surname }} {{ $user->name }} {{ $user->patronymic }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->city }}</td>
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
