<!doctype html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EcoBuild | Регистрация</title>
    <!--favicon-->
    <link rel="icon" href="/assets/images/favicon-32x32.png" type="image/png">
    <!-- loader-->
    <link href="/assets/css/pace.min.css" rel="stylesheet">
    <script src="/assets/js/pace.min.js"></script>

    <!--plugins-->
    <link href="/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/assets/plugins/metismenu/metisMenu.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/plugins/metismenu/mm-vertical.css">
    <link rel="stylesheet" type="text/css" href="/assets/plugins/simplebar/css/simplebar.css">
    <link href="/assets/plugins/bs-stepper/css/bs-stepper.css" rel="stylesheet">
    <!--bootstrap css-->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/fonts2.css?family=Noto+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="/assets/fonts.css?family=Material+Icons+Outlined" rel="stylesheet">
    <!--main css-->
    <link href="/assets/css/bootstrap-extended.css" rel="stylesheet">
    <link href="/sass/main.css" rel="stylesheet">
    <link href="/sass/dark-theme.css" rel="stylesheet">
    <link href="/sass/blue-theme.css" rel="stylesheet">
    <link href="/sass/responsive.css" rel="stylesheet">

    <link href="/assets/css/custom.css" rel="stylesheet">
</head>

<body class="bg-register">


    <!--authentication-->

    <div class="container-fluid my-5">
        <div class="row">
            <div class="col-12 col-md-8 col-lg-6 mx-auto">
                <div class="card rounded-4 mb-0 border-top border-4 border-primary border-gradient-1">
                    <div class="card-body p-5">
                        <h4 class="fw-bold">Регистрация</h4>
                        <p class="mb-0">Создайте новый аккаунт, чтобы продолжить</p>

                        <div class="form-body my-4">
                            <div id="stepper2" class="bs-stepper">
                                <div class="card">

                                    <div class="card-header">
                                        <div class="d-lg-flex flex-lg-row align-items-lg-center justify-content-lg-between"
                                            role="tablist">
                                            <div class="step" data-target="#test-nl-1">
                                                <div class="step-trigger" role="tab" id="stepper2trigger1"
                                                    aria-controls="test-nl-1">
                                                    <div class="bs-stepper-circle"><i
                                                            class='material-icons-outlined'>account_circle</i>
                                                    </div>
                                                    <div class="">
                                                        <h5 class="mb-0 steper-title">Основное</h5>
                                                        <p class="mb-0 steper-sub-title">Информация о себе</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="bs-stepper-line"></div>
                                            <div class="step" data-target="#test-nl-2">
                                                <div class="step-trigger" role="tab" id="stepper2trigger3"
                                                    aria-controls="test-nl-2">
                                                    <div class="bs-stepper-circle"><i
                                                            class='material-icons-outlined'>school</i></div>
                                                    <div class="">
                                                        <h5 class="mb-0 steper-title">Образование</h5>
                                                        <p class="mb-0 steper-sub-title">Место учебы</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="bs-stepper-line"></div>
                                            <div class="step" data-target="#test-nl-3">
                                                <div class="step-trigger" role="tab" id="stepper2trigger2"
                                                    aria-controls="test-nl-3">
                                                    <div class="bs-stepper-circle"><i
                                                            class='material-icons-outlined'>contact_page</i>
                                                    </div>
                                                    <div class="">
                                                        <h5 class="mb-0 steper-title">Аккаунт</h5>
                                                        <p class="mb-0 steper-sub-title">Данные для входа</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="bs-stepper-content">
                                            <form id="register-form" action="{{ route('register') }}" method="POST">
                                                @csrf
                                                <div id="test-nl-1" role="tabpanel" class="bs-stepper-pane"
                                                    aria-labelledby="stepper2trigger1">
                                                    <div class="row g-3">
                                                        <div class="col-12 col-lg-4">
                                                            <label class="form-label">Фамилия</label>
                                                            <input id="surname" type="text" class="form-control"
                                                                name="surname" value="{{ old('surname') }}">
                                                        </div>
                                                        <div class="col-12 col-lg-4">
                                                            <label class="form-label">Имя</label>
                                                            <input id="name" type="text" class="form-control"
                                                                name="name" value="{{ old('name') }}">
                                                        </div>
                                                        <div class="col-12 col-lg-4">
                                                            <label class="form-label">Отчество</label>
                                                            <input id="patronymic" type="text"
                                                                class="form-control" name="patronymic"
                                                                value="{{ old('patronymic') }}">
                                                        </div>
                                                        <div class="col-12 col-lg-6">
                                                            <label class="form-label">Город</label>
                                                            <input id="city" type="text" class="form-control"
                                                                name="city" value="{{ old('city') }}">
                                                        </div>
                                                        <div class="col-12 col-lg-6">
                                                            <label class="form-label">Телефон</label>
                                                            <input id="phone" type="text"
                                                                class="form-control phone-mask" name="phone"
                                                                value="{{ old('phone') }}">
                                                        </div>
                                                        <div class="col-12">
                                                            <label class="form-label">Соц. сеть</label>
                                                            <input type="text" class="form-control"
                                                                placeholder="Ссылка на аккаунт в соц. сети"
                                                                name="link" value="{{ old('link') }}">
                                                        </div>
                                                        <div class="col-12 col-lg-6">
                                                            <button type="button" class="btn btn-success px-4"
                                                                onclick="stepper2.next()">Далее<i
                                                                    class='bx bx-right-arrow-alt ms-2'></i></button>
                                                        </div>
                                                    </div><!---end row-->
                                                </div>
                                                <div id="test-nl-2" role="tabpanel" class="bs-stepper-pane"
                                                    aria-labelledby="stepper2trigger3">
                                                    <div class="row g-3">
                                                        <div class="col-12 col-lg-6">
                                                            <label class="form-label">Учебное заведение</label>
                                                            <input id="school" type="text" class="form-control"
                                                                name="school" value="{{ old('school') }}">
                                                        </div>
                                                        <div class="col-12 col-lg-6">
                                                            <label class="form-label">Класс/Курс</label>
                                                            <input id="classroom" type="number" class="form-control"
                                                                name="classroom" value="{{ old('classroom') }}">
                                                        </div>
                                                        <div class="col-12 col-lg-6">
                                                            <label class="form-label">ФИО руководителя</label>
                                                            <input id="teacher" type="text" class="form-control"
                                                                name="teacher" value="{{ old('teacher') }}">
                                                        </div>
                                                        <div class="col-12 col-lg-6">
                                                            <label class="form-label">Должность руководителя</label>
                                                            <input id="teacher_job" type="text"
                                                                class="form-control" name="teacher_job"
                                                                value="{{ old('teacher_job') }}">
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="d-flex align-items-center gap-3">
                                                                <button type="button" class="btn btn-secondary px-4"
                                                                    onclick="stepper2.previous()"><i
                                                                        class='bx bx-left-arrow-alt me-2'></i>Назад</button>
                                                                <button type="button" class="btn btn-success px-4"
                                                                    onclick="stepper2.next()">Далее<i
                                                                        class='bx bx-right-arrow-alt ms-2'></i></button>
                                                            </div>
                                                        </div>
                                                    </div><!---end row-->
                                                </div>
                                                <div id="test-nl-3" role="tabpanel" class="bs-stepper-pane"
                                                    aria-labelledby="stepper2trigger2">
                                                    <div class="row g-3">
                                                        <div class="col-12">
                                                            <label class="form-label">E-mail</label>
                                                            <input id="email" type="text" class="form-control"
                                                                placeholder="name@example.ru" name="email"
                                                                value="{{ old('email') }}">
                                                        </div>
                                                        <div class="col-12 col-lg-6">
                                                            <label class="form-label">Пароль</label>
                                                            <input id="password" type="password"
                                                                class="form-control" placeholder="******"
                                                                name="password">
                                                        </div>
                                                        <div class="col-12 col-lg-6">
                                                            <label class="form-label">Повторите пароль</label>
                                                            <input id="password_confirmation" type="password"
                                                                class="form-control" placeholder="******"
                                                                name="password_confirmation">
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox"
                                                                    id="policy_check" name="policy_check">
                                                                <label class="form-check-label" for="policy_check">Я
                                                                    даю согласие на
                                                                    обработку персональных данных и соглашаюсь с
                                                                    <a href="#">политикой
                                                                        конфиденциальности</a></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="d-flex align-items-center gap-3">
                                                                <button type="button" class="btn btn-secondary px-4"
                                                                    onclick="stepper2.previous()"><i
                                                                        class='bx bx-left-arrow-alt me-2'></i>Назад</button>
                                                                <button id="register" type="button"
                                                                    class="btn btn-success px-4">Зарегистрироваться</button>
                                                            </div>
                                                        </div>
                                                    </div><!---end row-->
                                                </div>
                                            </form>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="text-start">
                                <p class="mb-0">Уже есть аккаунт? <a href={{ route('login') }}>Войти</a></p>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div><!--end row-->
    </div>

    <!--authentication-->



    @vite(['resources/js/app.js'])
    <!--plugins-->
    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/jquery.maskedinput.min.js"></script>

    <script src="/assets/plugins/metismenu/metisMenu.min.js"></script>
    <script src="/assets/plugins/bs-stepper/js/bs-stepper.min.js"></script>
    <script src="/assets/plugins/simplebar/js/simplebar.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("bi-eye-slash-fill");
                    $('#show_hide_password i').removeClass("bi-eye-fill");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("bi-eye-slash-fill");
                    $('#show_hide_password i').addClass("bi-eye-fill");
                }
            });
        });
    </script>
    <script src="/assets/js/pages/register.js"></script>
</body>

</html>
