@extends('layouts.app')

@section('styles')
    <link href="/assets/plugins/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link href="/assets/plugins/quill/quill.snow.css" rel="stylesheet">
@endsection

@section('content')
    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-body p-4">
                    <h5 class="mb-4">Редактировать тестирование №{{ $test->id }}</h5>
                    <form action="{{ route('tests.update', ['test' => $test->id]) }}" method="post" class="row g-3"
                        enctype="multipart/form-data">
                        @method('PATCH')
                        @csrf
                        <input type="text" readonly name="id" hidden value="{{ $test->id }}">
                        <div class="row">
                            <div class="col-12 mb-4">
                                <label for="name" class="form-label">Название</label>
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <input type="text" class="form-control @error('name') error @enderror" name="name"
                                    id="name" placeholder="Введите название тестирования" value="{{ $test->name }}">
                            </div>
                            <div class="col-12">
                                <div class="card radius-10 rounded-4">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center flex-wrap justify-content-center">
                                            <img src="{{ asset("storage/$test->icon") }}"
                                                class="rounded-circle p-1 border mb-2" width="40" height="40"
                                                alt="{{ $test->icon }}">
                                            <div class="flex-grow-1 ms-3">
                                                <p class="mt-0">Выберите иконку для личного кабинета
                                                    пользователя</p>
                                                <input class="form-control" name="icon" type="file" id="icon"
                                                    accept="image/*">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mb-4">
                                <div class="card radius-10 rounded-4">
                                    <div class="card-body">
                                        <div class="col-12 mb-4">
                                            <label for="icon" class="form-label">Выберите сертификат за участие</label>
                                            <a data-lightbox="image-reward" data-title="Сертификат участника"
                                                href="{{ asset("storage/{$test->certificate}") }}">
                                                <img class="test-reward mb-4"
                                                    src="{{ asset("storage/{$test->certificate}") }}" alt="Сертификат">
                                            </a>
                                            @error('certificate')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                            <input class="form-control" name="certificate" type="file" id="certificate"
                                                value="{{ old('certificate') }}" accept="image/*">
                                        </div>
                                        <div class="accordion" id="accordionCertificateConfig">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingTwo">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#collapseCertificateConfig" aria-expanded="false"
                                                        aria-controls="collapseCertificateConfig">
                                                        Настройки
                                                        сертификата
                                                    </button>
                                                </h2>
                                                <div id="collapseCertificateConfig" class="accordion-collapse collapse"
                                                    aria-labelledby="headingTwo"
                                                    data-bs-parent="#accordionCertificateConfig">
                                                    <div class="accordion-body">
                                                        <div class="col-12" id="config-{{ $certificateConfig->id }}">
                                                            <div class="row mb-2">
                                                                <div class="col-md-6">
                                                                    <label class="form-label">Отступ ФИО по X</label>
                                                                    <div class="input-group">
                                                                        <input type="number" class="form-control"
                                                                            name="x_coord" placeholder="Введите X"
                                                                            id="x_certificate"
                                                                            value="{{ $certificateConfig->x_coord }}">
                                                                        <button
                                                                            class="btn btn-outline-secondary center-coords"
                                                                            data-type="certificate"
                                                                            data-test="{{ $test->id }}" data-coord="x"
                                                                            type="button">По
                                                                            центру</button>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="form-label">Отступ ФИО по Y</label>
                                                                    <div class="input-group">
                                                                        <input type="number" class="form-control"
                                                                            name="y_coord" placeholder="Введите Y"
                                                                            id="y_certificate"
                                                                            value="{{ $certificateConfig->y_coord }}">
                                                                        <button
                                                                            class="btn btn-outline-secondary center-coords"
                                                                            data-type="certificate"
                                                                            data-test="{{ $test->id }}"
                                                                            data-coord="y" type="button">По
                                                                            центру</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-4">
                                                                <div class="col-md-6">
                                                                    <label class="form-label">Размер шрифта</label>
                                                                    <input type="number" class="form-control"
                                                                        name="font_size"
                                                                        placeholder="Ведите размер шрифта"
                                                                        value="{{ $certificateConfig->font_size }}">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="form-label">Цвет шрифта (HEX
                                                                        формат)</label>
                                                                    <input type="text" class="form-control"
                                                                        name="font_color" placeholder="Ведите цвет шрифта"
                                                                        value="{{ $certificateConfig->font_color }}">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-12 d-flex justify-content-between">
                                                                    <button type="button"
                                                                        class="btn btn-success px-5 raised save-config"
                                                                        data-config="{{ $certificateConfig->id }}">Сохранить</button>
                                                                    <button type="button"
                                                                        class="btn btn-secondary px-5 raised preview-config"
                                                                        data-test="{{ $test->id }}"
                                                                        data-type="certificate">Предпросмотр</button>
                                                                    <a class="d-none preview-link"
                                                                        data-lightbox="reward-preview" href=""></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mb-4">
                                <div class="card radius-10 rounded-4">
                                    <div class="card-body">
                                        <div class="col-12 mb-4">
                                            <label for="diplom" class="form-label">Выберите диплом за результат</label>
                                            <a data-lightbox="image-reward" data-title="Диплом участника"
                                                href="{{ asset("storage/{$test->diplom}") }}">
                                                <img class="test-reward  mb-4"
                                                    src="{{ asset("storage/{$test->diplom}") }}" alt="Диплом">
                                            </a>
                                            @error('diplom')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                            <input class="form-control" name="diplom" type="file" id="diplom"
                                                value="{{ old('diplom') }}" accept="image/*">
                                        </div>
                                        <div class="accordion" id="accordionDiplomConfig">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingThree">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseDiplomConfig"
                                                        aria-expanded="false" aria-controls="collapseDiplomConfig">
                                                        Настройки
                                                        диплома
                                                    </button>
                                                </h2>
                                                <div id="collapseDiplomConfig" class="accordion-collapse collapse"
                                                    aria-labelledby="headingThree"
                                                    data-bs-parent="#accordionDiplomConfig">
                                                    <div class="accordion-body">
                                                        <div class="col-12" id="config-{{ $diplomConfig->id }}">
                                                            <div class="row mb-2">
                                                                <div class="col-md-6">
                                                                    <label class="form-label">Отступ степени (I, II, II) по
                                                                        X</label>
                                                                    <div class="input-group">
                                                                        <input type="number" class="form-control"
                                                                            name="x_degree_coord" placeholder="Введите X"
                                                                            id="x_degree_diplom"
                                                                            value="{{ $diplomConfig->x_degree_coord }}">
                                                                        <button
                                                                            class="btn btn-outline-secondary center-coords"
                                                                            data-type="diplom"
                                                                            data-test="{{ $test->id }}"
                                                                            data-coord="x_degree" type="button">По
                                                                            центру</button>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="form-label">Отступ степени (I, II, II) по
                                                                        Y</label>
                                                                    <div class="input-group">
                                                                        <input type="number" class="form-control"
                                                                            name="y_degree_coord" placeholder="Введите Y"
                                                                            id="y_degree_diplom"
                                                                            value="{{ $diplomConfig->y_degree_coord }}">
                                                                        <button
                                                                            class="btn btn-outline-secondary center-coords"
                                                                            data-type="diplom"
                                                                            data-test="{{ $test->id }}"
                                                                            data-coord="y_degree" type="button">По
                                                                            центру</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-4">
                                                                <div class="col-md-6">
                                                                    <label class="form-label">Размер шрифта степени</label>
                                                                    <input type="number" class="form-control"
                                                                        name="degree_font_size"
                                                                        placeholder="Ведите размер шрифта"
                                                                        value="{{ $diplomConfig->degree_font_size }}">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="form-label">Цвет шрифта степени (HEX
                                                                        формат)</label>
                                                                    <input type="text" class="form-control"
                                                                        name="degree_font_color"
                                                                        placeholder="Ведите цвет шрифта"
                                                                        value="{{ $diplomConfig->degree_font_color }}">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-2">
                                                                <div class="col-md-6">
                                                                    <label class="form-label">Отступ ФИО по X</label>
                                                                    <div class="input-group">
                                                                        <input type="number" class="form-control"
                                                                            name="x_coord" placeholder="Введите X"
                                                                            id="x_diplom"
                                                                            value="{{ $diplomConfig->x_coord }}">
                                                                        <button
                                                                            class="btn btn-outline-secondary center-coords"
                                                                            data-type="diplom"
                                                                            data-test="{{ $test->id }}"
                                                                            data-coord="x" type="button">По
                                                                            центру</button>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="form-label">Отступ ФИО по Y</label>
                                                                    <div class="input-group">
                                                                        <input type="number" class="form-control"
                                                                            name="y_coord" placeholder="Введите Y"
                                                                            id="y_diplom"
                                                                            value="{{ $diplomConfig->y_coord }}">
                                                                        <button
                                                                            class="btn btn-outline-secondary center-coords"
                                                                            data-type="diplom"
                                                                            data-test="{{ $test->id }}"
                                                                            data-coord="y" type="button">По
                                                                            центру</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-4">
                                                                <div class="col-md-6">
                                                                    <label class="form-label">Размер шрифта</label>
                                                                    <input type="number" class="form-control"
                                                                        name="font_size"
                                                                        placeholder="Ведите размер шрифта"
                                                                        value="{{ $diplomConfig->font_size }}">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="form-label">Цвет шрифта (HEX
                                                                        формат)</label>
                                                                    <input type="text" class="form-control"
                                                                        name="font_color" placeholder="Ведите цвет шрифта"
                                                                        value="{{ $diplomConfig->font_color }}">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-12 d-flex justify-content-between">
                                                                    <button type="button"
                                                                        class="btn btn-success px-5 raised save-config"
                                                                        data-config="{{ $diplomConfig->id }}">Сохранить</button>
                                                                    <button type="button"
                                                                        class="btn btn-secondary px-5 raised preview-config"
                                                                        data-test="{{ $test->id }}"
                                                                        data-type="diplom">Предпросмотр</button>
                                                                    <a class="d-none preview-link"
                                                                        data-lightbox="reward-preview" href=""></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <x-button type='submit' is-outline=true color='success'>
                                        <i class="fa-solid fa-floppy-disk"></i>
                                        Сохранить тест
                                    </x-button>
                                    <x-button class="delete-test" type='button' :data-test="$test->id" is-outline=true
                                        color="danger">
                                        <i class="fa-solid fa-trash"></i>
                                        Удалить тест
                                    </x-button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            @include('pages.tests.questions.question-form')
        </div>
        <div class="col-12">
            @include('pages.tests.questions.all-questions')
        </div>
    </div>
@endsection

@section('scripts')
    <script src="/assets/plugins/form-repeater/repeater.js"></script>
    <script src="/assets/plugins/lightbox/js/lightbox.min.js"></script>
    <script src="/assets/plugins/quill/quill.js"></script>
    <script src="/assets/js/pages/test.js"></script>
    <script src="/assets/js/pages/question.js"></script>
    @if (session('status') == 'success')
        <script>
            successSaveTest();
        </script>
    @endif
@endsection
