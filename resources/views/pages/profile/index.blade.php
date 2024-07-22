@extends('layouts.app')

@section('styles')
    <link href="/assets/plugins/fancy-file-uploader/fancy_fileupload.css" rel="stylesheet">
@endsection

@section('content')
    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="card rounded-4">
                <div class="card-body">
                    <ul class="nav nav-pills mb-3" role="tablist">
                        @foreach ($menuButtons as $key => $button)
                            <li class="nav-item" role="presentation">
                                <a @class([
                                    'nav-link profile-menu-button',
                                    'active' => ($key == 0 && !isset($type)) || $type == $button['type'],
                                ]) data-bs-toggle="pill" data-title="{{ $button['title'] }}"
                                    href="#primary-pills-{{ $button['type'] }}" role="tab" aria-selected="false">
                                    <div class="d-flex align-items-center">
                                        <div class="tab-icon"><i class="{{ $button['icon'] }} me-1 fs-6"></i>
                                        </div>
                                        <div class="tab-title">{{ $button['title'] }}</div>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        @foreach ($menuButtons as $menu)
                            @include('pages.profile.tabs.' . $menu['type'])
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
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
                                @if ($user->succesResultsForCreative()->first())
                                    <div class="d-flex flex-column">
                                        @include('components.alert', [
                                            'border' => true,
                                            'color' => 'success',
                                            'icon' => 'fa-sharp fa-regular fa-circle-info fa-2x',
                                            'title' => 'Поздравляем!',
                                            'text' =>
                                                'Вы набрали достаточное количество баллов в одном из направлений, для того, чтобы принять участие в креативном задании!',
                                        ])
                                    </div>
                                @endif
                                <div class="row">
                                    @foreach ($tests as $test)
                                        <div class="col-12 col-lg-6 mb-2">
                                            <div
                                                class="d-flex flex-row gap-3 align-items-center justify-content-center border p-3 rounded-3 flex-fill">
                                                <img src="{{ asset("storage/$test->icon") }}" width="40" height="40"
                                                    class="rounded-circle" alt="">
                                                <div class="">
                                                    <h5 class="mb-0">{{ $test->resultByUser()->points ?? 0 }} баллов</h5>
                                                    <p class="mb-0">{{ $test->name }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="info-list d-flex flex-column gap-3">
                            <div class="info-list-item d-flex align-items-center gap-3"><i class="fa-solid fa-user"></i>
                                <p class="mb-0">ФИО: {{ $user->surname . ' ' . $user->name . ' ' . $user->patronymic }}
                                </p>
                            </div>
                            <div class="info-list-item d-flex align-items-center gap-3"><i class="fa-solid fa-envelope"></i>
                                <p class="mb-0">Email: {{ $user->email }}</p>
                            </div>
                            <div class="info-list-item d-flex align-items-center gap-3"><i class="fa-solid fa-phone"></i>
                                <p class="mb-0">Телефон: {{ $user->phone }}</p>
                            </div>
                            <div class="info-list-item d-flex align-items-center gap-3"><i class="fa-solid fa-city"></i>
                                <p class="mb-0">Город: {{ $user->city }}</p>
                            </div>
                            <div class="info-list-item d-flex align-items-center gap-3"><i
                                    class="fa-solid fa-calendar-days"></i>
                                <p class="mb-0">Дата регистрации: {{ $user->created_at }}</p>
                            </div>
                        </div>
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
    <script src="/assets/js/pages/profile.js"></script>
@endsection
