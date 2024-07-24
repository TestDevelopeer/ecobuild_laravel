<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Maxton | Bootstrap 5 Admin Dashboard Template</title>
    <link href="/assets/css/all.min.css" rel="stylesheet" type="text/css">
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
    <!--bootstrap css-->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/fonts/fonts2.css?family=Noto+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="/assets/css/fonts/fonts.css?family=Material+Icons+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="/assets/plugins/notifications/css/lobibox.min.css">
    <!--main css-->
    <link href="/assets/css/bootstrap-extended.css" rel="stylesheet">
    <link href="/assets/css/sass/main.css" rel="stylesheet">
    <link href="/assets/css/sass/dark-theme.css" rel="stylesheet">
    <link href="/assets/css/sass/blue-theme.css" rel="stylesheet">
    <link href="/assets/css/sass/semi-dark.css" rel="stylesheet">
    <link href="/assets/css/sass/bordered-theme.css" rel="stylesheet">
    <link href="/assets/css/sass/responsive.css" rel="stylesheet">
    <link href="/assets/css/custom.css" rel="stylesheet">

    @yield('styles')
</head>

<body>

    <!--start header-->
    <header class="top-header">
        <nav class="navbar navbar-expand align-items-center justify-content-between gap-4">
            <div class="btn-toggle">
                <a href="javascript:;"><i class="material-icons-outlined">menu</i></a>
            </div>

            <ul class="navbar-nav gap-1 nav-right-links align-items-center">
                <li class="nav-item dropdown">
                    <a href="javascrpt:;" class="dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">
                        <img src="/assets/images/avatars/01.png" class="rounded-circle p-1 border" width="45"
                            height="45" alt="">
                    </a>
                    <div class="dropdown-menu dropdown-user dropdown-menu-end shadow">
                        <a class="dropdown-item  gap-2 py-2" href="{{ route('profile') }}">
                            <div class="text-center">
                                <img src="/assets/images/avatars/01.png" class="rounded-circle p-1 shadow mb-3"
                                    width="90" height="90" alt="">
                                <h5 class="user-name mb-0 fw-bold">{{ Auth::user()->name }}
                                    {{ Auth::user()->patronymic }}</h5>
                            </div>
                        </a>
                        <hr class="dropdown-divider">
                        <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="{{ route('profile') }}"><i
                                class="fa-light fa-user"></i>Профиль</a>
                        <a class="dropdown-item d-flex align-items-center gap-2 py-2"
                            href="{{ route('profile', ['type' => 'faq']) }}"><i
                                class="fa-light fa-messages-question"></i>FAQ</a>

                        <hr class="dropdown-divider">
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button type="submit" class="dropdown-item d-flex align-items-center gap-2 py-2"><i
                                    class="fa-light fa-person-to-door"></i>Выход</button>
                        </form>

                    </div>
                </li>
            </ul>

        </nav>
    </header>
    <!--end top header-->


    @include('layouts.sidebar')

    <!--start main wrapper-->
    <main class="main-wrapper">
        <div class="main-content">
            @include('components.breadcrumb')


            @yield('content')

            <div class="modal fade" id="feedbackModal">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header border-bottom-0 py-2 bg-primary">
                            <h5 class="modal-title text-white">Обратная связь</h5>
                            <a href="javascript:;" class="primaery-menu-close" data-bs-dismiss="modal">
                                <i class="material-icons-outlined">close</i>
                            </a>
                        </div>
                        <div class="modal-body">
                            <div class="form-body">
                                <form id="feedback-form" action="{{ route('feedback.create') }}" method="post"
                                    class="row g-3">
                                    <div class="col-md-6">
                                        <label for="email" class="form-label">Email</label>
                                        <input readonly type="text" class="form-control" id="email"
                                            name="email" placeholder="Ваш email" value="{{ Auth::user()->email }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="phone" class="form-label">Телефон</label>
                                        <input readonly type="text" class="form-control phone-mask" id="phone"
                                            name="phone" placeholder="Ваш телефон"
                                            value="{{ Auth::user()->phone }}">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="message" class="form-label">Сообщение</label>
                                        <textarea class="form-control" id="message" name="message" placeholder="Ваше сообщение..." rows="3"></textarea>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="d-md-flex d-grid align-items-center gap-3">
                                            <button id="send-feedback" type="button"
                                                class="btn btn-primary px-4">Отправить</button>
                                            <button type="button" class="btn btn-secondary px-4"
                                                data-bs-dismiss="modal">Отмена</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!--end main wrapper-->

    <!--start overlay-->
    <div class="overlay btn-toggle"></div>
    <!--end overlay-->

    @include('layouts.footer')

    <!--start cart-->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasCart">
        <div class="offcanvas-header border-bottom h-70">
            <h5 class="mb-0" id="offcanvasRightLabel">8 New Orders</h5>
            <a href="javascript:;" class="primaery-menu-close" data-bs-dismiss="offcanvas">
                <i class="material-icons-outlined">close</i>
            </a>
        </div>
        <div class="offcanvas-body p-0">
            <div class="order-list">
                <div class="order-item d-flex align-items-center gap-3 p-3 border-bottom">
                    <div class="order-img">
                        <img src="/assets/images/orders/01.png" class="img-fluid rounded-3" width="75"
                            alt="">
                    </div>
                    <div class="order-info flex-grow-1">
                        <h5 class="mb-1 order-title">White Men Shoes</h5>
                        <p class="mb-0 order-price">$289</p>
                    </div>
                    <div class="d-flex">
                        <a class="order-delete"><span class="material-icons-outlined">delete</span></a>
                        <a class="order-delete"><span class="material-icons-outlined">visibility</span></a>
                    </div>
                </div>

                <div class="order-item d-flex align-items-center gap-3 p-3 border-bottom">
                    <div class="order-img">
                        <img src="/assets/images/orders/02.png" class="img-fluid rounded-3" width="75"
                            alt="">
                    </div>
                    <div class="order-info flex-grow-1">
                        <h5 class="mb-1 order-title">Red Airpods</h5>
                        <p class="mb-0 order-price">$149</p>
                    </div>
                    <div class="d-flex">
                        <a class="order-delete"><span class="material-icons-outlined">delete</span></a>
                        <a class="order-delete"><span class="material-icons-outlined">visibility</span></a>
                    </div>
                </div>

                <div class="order-item d-flex align-items-center gap-3 p-3 border-bottom">
                    <div class="order-img">
                        <img src="/assets/images/orders/03.png" class="img-fluid rounded-3" width="75"
                            alt="">
                    </div>
                    <div class="order-info flex-grow-1">
                        <h5 class="mb-1 order-title">Men Polo Tshirt</h5>
                        <p class="mb-0 order-price">$139</p>
                    </div>
                    <div class="d-flex">
                        <a class="order-delete"><span class="material-icons-outlined">delete</span></a>
                        <a class="order-delete"><span class="material-icons-outlined">visibility</span></a>
                    </div>
                </div>

                <div class="order-item d-flex align-items-center gap-3 p-3 border-bottom">
                    <div class="order-img">
                        <img src="/assets/images/orders/04.png" class="img-fluid rounded-3" width="75"
                            alt="">
                    </div>
                    <div class="order-info flex-grow-1">
                        <h5 class="mb-1 order-title">Blue Jeans Casual</h5>
                        <p class="mb-0 order-price">$485</p>
                    </div>
                    <div class="d-flex">
                        <a class="order-delete"><span class="material-icons-outlined">delete</span></a>
                        <a class="order-delete"><span class="material-icons-outlined">visibility</span></a>
                    </div>
                </div>

                <div class="order-item d-flex align-items-center gap-3 p-3 border-bottom">
                    <div class="order-img">
                        <img src="/assets/images/orders/05.png" class="img-fluid rounded-3" width="75"
                            alt="">
                    </div>
                    <div class="order-info flex-grow-1">
                        <h5 class="mb-1 order-title">Fancy Shirts</h5>
                        <p class="mb-0 order-price">$758</p>
                    </div>
                    <div class="d-flex">
                        <a class="order-delete"><span class="material-icons-outlined">delete</span></a>
                        <a class="order-delete"><span class="material-icons-outlined">visibility</span></a>
                    </div>
                </div>

                <div class="order-item d-flex align-items-center gap-3 p-3 border-bottom">
                    <div class="order-img">
                        <img src="/assets/images/orders/06.png" class="img-fluid rounded-3" width="75"
                            alt="">
                    </div>
                    <div class="order-info flex-grow-1">
                        <h5 class="mb-1 order-title">Home Sofa Set </h5>
                        <p class="mb-0 order-price">$546</p>
                    </div>
                    <div class="d-flex">
                        <a class="order-delete"><span class="material-icons-outlined">delete</span></a>
                        <a class="order-delete"><span class="material-icons-outlined">visibility</span></a>
                    </div>
                </div>

                <div class="order-item d-flex align-items-center gap-3 p-3 border-bottom">
                    <div class="order-img">
                        <img src="/assets/images/orders/07.png" class="img-fluid rounded-3" width="75"
                            alt="">
                    </div>
                    <div class="order-info flex-grow-1">
                        <h5 class="mb-1 order-title">Black iPhone</h5>
                        <p class="mb-0 order-price">$1049</p>
                    </div>
                    <div class="d-flex">
                        <a class="order-delete"><span class="material-icons-outlined">delete</span></a>
                        <a class="order-delete"><span class="material-icons-outlined">visibility</span></a>
                    </div>
                </div>

                <div class="order-item d-flex align-items-center gap-3 p-3 border-bottom">
                    <div class="order-img">
                        <img src="/assets/images/orders/08.png" class="img-fluid rounded-3" width="75"
                            alt="">
                    </div>
                    <div class="order-info flex-grow-1">
                        <h5 class="mb-1 order-title">Goldan Watch</h5>
                        <p class="mb-0 order-price">$689</p>
                    </div>
                    <div class="d-flex">
                        <a class="order-delete"><span class="material-icons-outlined">delete</span></a>
                        <a class="order-delete"><span class="material-icons-outlined">visibility</span></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="offcanvas-footer h-70 p-3 border-top">
            <div class="d-grid">
                <button type="button" class="btn btn-grd btn-grd-primary" data-bs-dismiss="offcanvas">View
                    Products</button>
            </div>
        </div>
    </div>
    <!--end cart-->

    @vite(['resources/js/app.js'])
    <!--bootstrap js-->
    <script src="/assets/js/bootstrap.bundle.min.js"></script>

    <!--plugins-->
    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/jquery.maskedinput.min.js"></script>
    <!--plugins-->
    <script src="/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <script src="/assets/plugins/metismenu/metisMenu.min.js"></script>
    <script src="/assets/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="/assets/plugins/peity/jquery.peity.min.js"></script>
    <script src="/assets/js/swal.min.js"></script>
    <script src="/assets/plugins/notifications/js/notifications.min.js"></script>
    <script>
        $(".data-attributes span").peity("donut")
    </script>
    <script src="/assets/js/main.js"></script>
    <script src="/assets/js/feedback.js"></script>

    @yield('scripts')

</body>

</html>
