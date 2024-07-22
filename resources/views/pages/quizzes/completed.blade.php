@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="alert alert-success border-0 bg-success alert-dismissible fade show">
            <div class="d-flex align-items-center">
                <div class="font-35 text-white"><i class="fa-regular fa-check-to-slot fa-2x"></i>
                </div>
                <div class="ms-3">
                    <h6 class="mb-0 text-white">Вы завершили данное тестирование!</h6>
                    <div class="text-white">Перейдите в <a href="{{ route('profile') }}">профиль</a>, чтобы получить более
                        подробную
                        информацию.</div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="/assets/js/pages/quiz.js"></script>
@endsection
