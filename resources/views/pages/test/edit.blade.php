@extends('layouts.app')

@section('styles')
    <link href="/assets/plugins/lightbox/css/lightbox.min.css" rel="stylesheet">
@endsection

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
                                        <div class="d-flex align-items-center flex-wrap justify-content-center">
                                            <img src="{{ asset("storage/$test->icon") }}"
                                                class="rounded-circle p-1 border mb-2" width="40" height="40"
                                                alt="{{ $test->icon }}">
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
            @include('pages.test.questions.question-form')
        </div>
        <div class="col-12">
            @include('pages.test.questions.all-questions')
        </div>
    </div>
@endsection

@section('scripts')
    <script src="/assets/plugins/form-repeater/repeater.js"></script>
    <script src="/assets/plugins/lightbox/js/lightbox.min.js"></script>
    <script src="/assets/js/pages/test.js"></script>
    <script src="/assets/js/pages/question.js"></script>
    @if (session('status') == 'success')
        <script>
            successSaveTest();
        </script>
    @endif
@endsection
