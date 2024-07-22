@extends('layouts.app')

@section('styles')
    <link href="/assets/plugins/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/quiz/quiz.css">
@endsection

@section('content')
    <div class="row" id="quiz-container">
        @if (isset($questionsForQuiz) && $questionsForQuiz == 0)
            <div class="alert alert-border-warning alert-dismissible fade show">
                <div class="d-flex align-items-center">
                    <div class="font-35 text-warning"><span class="material-icons-outlined fs-2">report_problem</span>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0 text-warning">Что-то пошло не так...</h6>
                        <div class="">У данного тестирования нет вопросов :(</div>
                    </div>
                </div>
            </div>
        @else
            @include('pages.quizzes.quiz-template')
        @endif
    </div>
@endsection

@section('scripts')
    <script src="/assets/plugins/lightbox/js/lightbox.min.js"></script>
    <script src="/assets/js/pages/quiz.js"></script>
@endsection
