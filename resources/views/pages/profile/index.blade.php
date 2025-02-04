@extends('layouts.app')

@section('styles')
    <link href="/assets/plugins/filepond/filepond-plugin-image-preview.min.css" rel="stylesheet">
    <link href="/assets/plugins/filepond/filepond.css" rel="stylesheet">
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
                                    'active' => ($key == 2 && !isset($type)) || $type == $button['type'],
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
                            <h5 class="mb-0 fw-bold" id="profile-info-title">Данные абитуриента</h5>
                        </div>
                        <div class="d-none back-to-info">
                            <button id="back-button" type="button"
                                class="btn btn-outline-secondary px-4 d-flex gap-2 align-items-center"><i
                                    class="fa-solid fa-arrow-left"></i>Назад</button>
                        </div>
                    </div>
                    <div class="full-info">
                        @include('pages.profile.layouts.profile-info')
                    </div>
                    <div class="other-info">

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <script src="/assets/plugins/filepond/filepond-plugin-file-encode.min.js"></script>
    <script src="/assets/plugins/filepond/filepond-plugin-file-validate-type.js"></script>
    <script src="/assets/plugins/filepond/filepond-plugin-file-validate-size.min.js"></script>
    <script src="/assets/plugins/filepond/filepond-plugin-image-exif-orientation.min.js"></script>
    <script src="/assets/plugins/filepond/filepond-plugin-image-preview.min.js"></script>
    <script src="/assets/plugins/filepond/ru-ru.js"></script>
    <script src="/assets/plugins/filepond/filepond.js"></script>
    <script src="/assets/js/pages/profile.js"></script>
    <script src="/assets/js/pages/creative.js"></script>
    @if (session('status') == 'error')
        <script>
            notification('error', "{{ session('message') }}");
        </script>
    @endif
@endsection
