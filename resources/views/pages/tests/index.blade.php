@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body overflow-auto">
            <table class="table mb-0">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Название</th>
                        <th scope="col">Дата создания</th>
                        <th scope="col">Дата редактирования</th>
                        <th scope="col">Действие</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tests as $test)
                        <tr>
                            <th scope="row">{{ $test->id }}</th>
                            <td>{{ $test->name }}</td>
                            <td>{{ $test->created_at }}</td>
                            <td>{{ $test->updated_at }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('tests.edit', ['test' => $test->id]) }}" type="button"
                                        class="btn btn-outline-primary d-flex">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <x-button class="delete-test" :data-test="$test->id" type="button" is-outline=true
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
    </div>
@endsection

@section('scripts')
    <script src="/assets/js/pages/test.js"></script>
@endsection
