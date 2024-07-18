@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row g-3 row-cols-1 row-cols-lg-4">
                <div class="col">
                    <div class="d-flex align-items-start gap-3 border p-3 rounded">
                        <div class="detail-icon fs-5">
                            <i class="fa-light fa-envelope"></i>
                        </div>
                        <div class="detail-info">
                            <h6 class="fw-bold mb-1">Email</h6>
                            <a href="mailto:n.stuzhenko@mail.ru" class="mb-0">n.stuzhenko@mail.ru</a>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="d-flex align-items-start gap-3 border p-3 rounded">
                        <div class="detail-icon fs-5">
                            <i class="fa-light fa-phone"></i>
                        </div>
                        <div class="detail-info">
                            <h6 class="fw-bold mb-1">Телефон</h6>
                            <a href="tel:+79185293694" class="mb-0">+7(918)529-36-94</a>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="d-flex align-items-start gap-3 border p-3 rounded">
                        <div class="detail-icon fs-5">
                            <i class="fa-light fa-link"></i>
                        </div>
                        <div class="detail-info">
                            <h6 class="fw-bold mb-1">Сайт</h6>
                            <a href="https://www.sssu.ru/" target="_blank" class="mb-0">www.sssu.ru</a>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="d-flex align-items-start gap-3 border p-3 rounded">
                        <div class="detail-icon fs-5">
                            <i class="fa-light fa-map-location-dot"></i>
                        </div>
                        <div class="detail-info">
                            <h6 class="fw-bold mb-1">Адрес</h6>
                            <a href="https://yandex.ru/maps/-/CDSW7P3D" target="_blank" class="mb-0">ул. Шевченко, 147,
                                Шахты</a>
                        </div>
                    </div>
                </div>
            </div><!--end row-->
        </div>
    </div>
@endsection
