<!doctype html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EcoBuild | Автор</title>
    <!--favicon-->
    <link rel="icon" href="/assets/images/favicon-32x32.png" type="image/png">
    <!-- loader-->
    <link href="/assets/css/pace.min.css" rel="stylesheet">
    <script src="/assets/js/pace.min.js"></script>

    <!--plugins-->
    <link href="/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/assets/plugins/metismenu/metisMenu.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/plugins/metismenu/mm-vertical.css">
    <!--bootstrap css-->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/fonts/fonts2.css?family=Noto+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="/assets/css/fonts/fonts.css?family=Material+Icons+Outlined" rel="stylesheet">
    <!--main css-->
    <link href="/assets/css/bootstrap-extended.css" rel="stylesheet">
    <link href="/assets/css/sass/main.css" rel="stylesheet">
    <link href="/assets/css/sass/dark-theme.css" rel="stylesheet">
    <link href="/assets/css/sass/blue-theme.css" rel="stylesheet">
    <link href="/assets/css/sass/responsive.css" rel="stylesheet">
    <link href="/assets/css/custom.css" rel="stylesheet">

</head>

<body>

    <!--authentication-->
    <div class="auth-basic-wrapper d-flex align-items-center justify-content-center">
        <div class="container-fluid my-5 my-lg-0">
            <div class="row">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5 col-xxl-4 mx-auto">
                    <div class="card rounded-4 mb-0 border-top border-4 border-primary border-gradient-1">
                        <div class="card-body p-5">
                            <h4 class="fw-bold">Авторизация</h4>
                            <p class="mb-0">Войдите в свой аккаунт, чтобы продолжить</p>

                            <div class="form-body my-5">
                                <form action="{{ route('login') }}" method="post" class="row g-3">
                                    @csrf
                                    <div class="col-12">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control @error('email') error @enderror"
                                            id="email" name="email" placeholder="name@example.com"
                                            value="{{ old('email') }}">
                                        @include('components.error-text', ['name' => 'email'])
                                    </div>
                                    <div class="col-12">
                                        <label for="password" class="form-label">Пароль</label>
                                        <div class="input-group" id="show_hide_password">
                                            <input type="password"
                                                class="form-control border-end-0 @error('email') error @enderror"
                                                id="password" placeholder="********" name="password">
                                            <a href="javascript:;"
                                                class="input-group-text bg-transparent @error('email') error @enderror"><i
                                                    class="bi bi-eye-slash-fill"></i></a>
                                        </div>
                                        @include('components.error-text', ['name' => 'password'])
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check form-switch">
                                            <input name="remember" class="form-check-input" type="checkbox"
                                                id="flexSwitchCheckChecked">
                                            <label class="form-check-label"
                                                for="flexSwitchCheckChecked">Запомнить</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-outline-success">Войти</button>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="text-start">
                                            <p class="mb-0">Нет аккаунта? <a
                                                    href="{{ route('register') }}">Регистрация</a>
                                            </p>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--end row-->
        </div>
    </div>
    <!--authentication-->


    <!--plugins-->
    <script src="/assets/js/jquery.min.js"></script>

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

</body>

</html>
