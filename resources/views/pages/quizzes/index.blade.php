@extends('layouts.app')

@section('styles')
    <link href="/assets/plugins/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/quiz/quiz.css">
@endsection

@section('content')
    <div class="row" id="quiz-container" data-test="{{ $test->id }}">
        <div class="preload"></div>
    </div>
@endsection

@section('scripts')
    <script src="/assets/plugins/lightbox/js/lightbox.min.js"></script>
    <script src="/assets/plugins/blockui/jquery.blockUI.min.js"></script>

    <script src="/assets/js/pages/quiz.js"></script>
@endsection
