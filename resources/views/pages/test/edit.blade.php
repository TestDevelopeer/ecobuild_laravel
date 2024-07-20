@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-body p-4">
                    <h5 class="mb-4">Редактировать тестирование №{{ $test->id }}</h5>
                    <form action="{{ route('test.save') }}" method="post" class="row g-3" enctype="multipart/form-data">
                        @csrf
                        <input type="text" readonly name="id" hidden value="{{ $test->id }}">
                        <div class="row">
                            <div class="col-12 mb-4">
                                <label for="name" class="form-label">Название</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    placeholder="Введите название тестирования" value="{{ $test->name }}">
                            </div>
                            <div class="col-12">
                                <div class="card radius-10 rounded-4">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ config('custom.tests.path') . $test->id }}/icon/{{ $test->icon }}"
                                                class="rounded-circle p-1 border" width="40" height="40"
                                                alt="...">
                                            <div class="flex-grow-1 ms-3">
                                                <p class="mt-0">Выберите иконку тестирования для личного кабинета
                                                    пользователя</p>
                                                <input class="form-control" name="icon" type="file" id="icon"
                                                    accept=".png">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="submit" class="btn btn-primary px-4">Сохранить тест</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-body p-4">
                    <h5 class="mb-4">Добавить новый вопрос</h5>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('question.add') }}" method="post" class="row mt-4"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="text" readonly hidden name="test_id" value="{{ $test->id }}">
                        <div class="col-12 mb-4">
                            <label for="type_id" class="form-label">Тип вопроса {{ old('type_id') }}</label>
                            <select id="type_id" name="type_id" class="form-select">
                                @foreach ($questionTypes as $type)
                                    <option {{ old('type_id') == $type->id ? 'selected' : '' }}
                                        value="{{ $type->id }}">
                                        {{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 mb-4 d-none" id="question_asset">
                            <label for="question_asset" class="form-label">Выберите файл для вопроса</label>
                            <input class="form-control" type="file" id="question_asset_input" name="question_asset"
                                accept="image/*, video/*, audio/*">
                        </div>
                        <div class="col-12">
                            <label for="text" class="form-label">Текст вопроса</label>
                            <textarea class="form-control" name="text" id="text" placeholder="Введите текст вопроса" rows="3">{{ old('text') }}</textarea>
                        </div>
                        <div class="col-12 mt-4">
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
                                                            <input data-name="is_true" id="is_true"
                                                                class="form-check-input" type="radio"
                                                                aria-label="Правильный ответ" value="">
                                                        </div>
                                                        <input data-name="text" id="text" type="text"
                                                            class="form-control"
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
                        </div>
                        <div class="col-12 mt-4">
                            <div class="d-flex align-items-center justify-content-between">
                                <button type="button" class="btn btn-primary repeater-add-btn px-4">Добавить новый
                                    ответ</button>
                                <button type="submit" class="btn btn-success px-4">Сохранить вопрос</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-4">Все вопросы данного теста</h5>
                    <table class="table mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Текст</th>
                                <th scope="col">Тип</th>
                                <th scope="col">Дата создания</th>
                                <th scope="col">Дата редактирования</th>
                                <th scope="col">Действие</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($questions as $question)
                                <tr>
                                    <th scope="row">{{ $question->id }}</th>
                                    <td class="question-text" data-bs-toggle="tooltip" data-bs-placement="right"
                                        title="{{ $question->text }}">{{ $question->text }}</td>
                                    <td>{{ $question->type->name }}</td>
                                    <td>{{ $question->created_at }}</td>
                                    <td>{{ $question->updated_at }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="#" type="button" class="btn btn-outline-primary d-flex">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <button data-question="{{ $question->id }}" type="button"
                                                class="btn btn-outline-danger d-flex delete-question">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>
                <div class="mt-2 d-flex justify-content-center">
                    {{ $questions->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="/assets/plugins/form-repeater/repeater.js"></script>
    <script src="/assets/js/pages/test.js"></script>
    <script src="/assets/js/pages/question.js"></script>
    @if (session('status') == 'success')
        <script>
            successSaveTest();
        </script>
    @endif
@endsection
