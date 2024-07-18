@extends('layouts.app')

@section('styles')
    <link href="/assets/plugins/fancy-file-uploader/fancy_fileupload.css" rel="stylesheet">
@endsection

@section('content')
    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="card rounded-4">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between mb-3">
                        <div class="">
                            <h5 class="mb-0 fw-bold">Данные абитуриента</h5>
                        </div>
                    </div>
                    <div class="full-info">
                        <div class="card w-100 rounded-4">
                            <div class="card-body">
                                <div class="d-flex align-items-center gap-3">
                                    <div
                                        class="d-flex flex-row gap-3 align-items-center justify-content-center border p-3 rounded-3 flex-fill">
                                        <img src="/assets/images/profile/planet-earth.png" width="40" height="40"
                                            class="rounded-circle" alt="">
                                        <div class="">
                                            <h5 class="mb-0">{{ $user->result('eco')->points ?? 0 }}</h5>
                                            <p class="mb-0">Баллов по экологии</p>
                                        </div>
                                    </div>
                                    <div
                                        class="d-flex flex-row gap-2 align-items-center justify-content-center border p-3 rounded-3 flex-fill">
                                        <img src="/assets/images/profile/brick-wall.png" width="40" height="40"
                                            class="rounded-circle" alt="">
                                        <div class="">
                                            <h5 class="mb-0">{{ $user->result('build')->points ?? 0 }}</h5>
                                            <p class="mb-0">Баллов по строительству</p>
                                        </div>
                                    </div>
                                </div>
                                @if ($user->successResult())
                                    <div class="d-flex flex-column mt-3">
                                        @include('components.alert', [
                                            'border' => true,
                                            'color' => 'success',
                                            'icon' => 'fa-sharp fa-regular fa-circle-info fa-2x',
                                            'title' => 'Поздравляем!',
                                            'text' =>
                                                'Вы набрали достаточное количество баллов в одном из направлений, для того, чтобы участвовать в креативном задании!',
                                        ])
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="info-list d-flex flex-column gap-3">
                            <div class="info-list-item d-flex align-items-center gap-3"><i class="fa-light fa-user"></i>
                                <p class="mb-0">ФИО: {{ $user->surname . ' ' . $user->name . ' ' . $user->patronymic }}
                                </p>
                            </div>
                            <div class="info-list-item d-flex align-items-center gap-3"><i class="fa-light fa-envelope"></i>
                                <p class="mb-0">Email: {{ $user->email }}</p>
                            </div>
                            <div class="info-list-item d-flex align-items-center gap-3"><i class="fa-light fa-phone"></i>
                                <p class="mb-0">Телефон: {{ $user->phone }}</p>
                            </div>
                            <div class="info-list-item d-flex align-items-center gap-3"><i class="fa-light fa-city"></i>
                                <p class="mb-0">Город: {{ $user->city }}</p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card rounded-4">
                <div class="card-body">
                    <ul class="nav nav-pills mb-3" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a @class(['nav-link', 'active' => !isset($type) || $type == 'results']) data-bs-toggle="pill" href="#primary-pills-results"
                                role="tab" aria-selected="true">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class="fa-light fa-square-poll-vertical me-1 fs-6"></i>
                                    </div>
                                    <div class="tab-title">Результаты</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a @class(['nav-link', 'active' => isset($type) && $type == 'rewards']) data-bs-toggle="pill" href="#primary-pills-rewards"
                                role="tab" aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class="fa-light fa-medal me-1 fs-6"></i>
                                    </div>
                                    <div class="tab-title">Награды</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a @class(['nav-link', 'active' => isset($type) && $type == 'creative']) data-bs-toggle="pill" href="#primary-pills-creative"
                                role="tab" aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class='fa-light fa-pen-swirl me-1 fs-6'></i>
                                    </div>
                                    <div class="tab-title">Креативное задание</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a @class(['nav-link', 'active' => isset($type) && $type == 'faq']) data-bs-toggle="pill" href="#primary-pills-faq" role="tab"
                                aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class='fa-light fa-messages-question me-1 fs-6'></i>
                                    </div>
                                    <div class="tab-title">FAQ</div>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        @include('pages.profile.results')
                        @include('pages.profile.rewards')
                        @include('pages.profile.creative')
                        @include('pages.profile.faq')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="/assets/plugins/fancy-file-uploader/jquery.ui.widget.js"></script>
    <script src="/assets/plugins/fancy-file-uploader/jquery.fileupload.js"></script>
    <script src="/assets/plugins/fancy-file-uploader/jquery.iframe-transport.js"></script>
    <script src="/assets/plugins/fancy-file-uploader/jquery.fancy-fileupload.js"></script>
    <script>
        $('#upload-eco').FancyFileUpload({
            params: {
                action: 'fileuploader'
            },
            maxfilesize: 1000000
        });
        $('#upload-build').FancyFileUpload({
            params: {
                action: 'fileuploader'
            },
            maxfilesize: 1000000
        });
    </script>
@endsection
